<?php

namespace App\Http\Controllers;

use App\Models\Itinerary;
use App\Models\ItineraryDay;
use App\Models\ListTempat;
use App\Models\ListTempatCoord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ItineraryBuilderController extends Controller
{
    public function user_index()
    {
        $itineraries = \App\Models\Itinerary::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('services', compact('itineraries'));
    }

    public function index()
    {
        $itineraries = Itinerary::with('creator')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.tours', compact('itineraries'));
    }

    public function create()
    {
        return view('admin.Component.builder');
    }

    public function edit($id)
    {
        $itinerary = Itinerary::with('days')->findOrFail($id);
        return view('admin.Component.builder', compact('itinerary'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_days' => 'required|integer|min:1|max:30',
            'start_location' => 'nullable|string',
            'end_location' => 'nullable|string',
            'waypoints' => 'nullable|array',
            'selected_places' => 'nullable|array'
        ]);

        DB::beginTransaction();

        try {
            $itinerary = Itinerary::create([
                'title' => $request->title,
                'description' => $request->description,
                'duration_days' => $request->duration_days,
                'start_location' => $request->start_location,
                'end_location' => $request->end_location,
                'waypoints' => $request->waypoints,
                'selected_places' => $request->selected_places,
                'total_distance' => $request->total_distance,
                'total_duration' => $request->total_duration,
                'created_by' => Auth::id(),
                'status' => 'draft'
            ]);

            // Create days if waypoints exist
            if ($request->waypoints && count($request->waypoints) > 0) {
                $placesPerDay = ceil(count($request->waypoints) / $request->duration_days);
                $dayPlaces = array_chunk($request->waypoints, $placesPerDay);

                foreach ($dayPlaces as $dayIndex => $places) {
                    ItineraryDay::create([
                        'itinerary_id' => $itinerary->id,
                        'day_number' => $dayIndex + 1,
                        'title' => "Day " . ($dayIndex + 1),
                        'places' => $places,
                        'description' => "Tour day " . ($dayIndex + 1)
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Itinerary created successfully',
                'data' => $itinerary
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create itinerary: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $itinerary = Itinerary::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_days' => 'required|integer|min:1|max:30',
            'waypoints' => 'nullable|array',
            'selected_places' => 'nullable|array'
        ]);

        $itinerary->update([
            'title' => $request->title,
            'description' => $request->description,
            'duration_days' => $request->duration_days,
            'start_location' => $request->start_location,
            'end_location' => $request->end_location,
            'waypoints' => $request->waypoints,
            'selected_places' => $request->selected_places,
            'total_distance' => $request->total_distance,
            'total_duration' => $request->total_duration
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Itinerary updated successfully',
            'data' => $itinerary
        ]);
    }

    private array $cityAliases = [
        ['bali', 'denpasar', 'badung', 'gianyar', 'tabanan', 'buleleng', 'klungkung', 'karangasem', 'jembrana', 'bangli'],
        ['yogyakarta', 'jogja', 'yogya', 'sleman', 'bantul'],
        ['jakarta', 'dki', 'jakpus', 'jaksel', 'jakut', 'jakbar', 'jaktim'],
        ['surabaya', 'sidoarjo', 'gresik'],
        ['lombok', 'mataram', 'nusa tenggara barat', 'ntb'],
        ['flores', 'labuan bajo', 'manggarai'],
    ];

    private function resolveSearchTerms(string $input): array
    {
        $lower = strtolower(trim($input));
        foreach ($this->cityAliases as $group) {
            if (in_array($lower, $group, true)) {
                return $group;
            }
        }
        return [$lower];
    }

    public function getPlaces(Request $request)
    {
        $query = ListTempat::query()
            ->select('list_tempat.*')
            ->join('list_tempat_coords', 'list_tempat_coords.tempat_id', '=', 'list_tempat.id');

        if ($request->search) {
            $terms = $this->resolveSearchTerms($request->search);

            $query->where(function ($q) use ($terms) {
                foreach ($terms as $term) {
                    $like    = "%{$term}%";
                    // Word-boundary regex: cocok "bali" tapi tidak "balikpapan"
                    $regex   = '[[:<:]]' . preg_quote($term, '/') . '[[:>:]]';

                    $q->orWhereRaw('LOWER(list_tempat.tempat)              REGEXP ?', [$regex])
                        ->orWhereRaw('LOWER(list_tempat.city)                REGEXP ?', [$regex])
                        ->orWhereRaw('LOWER(list_tempat.negara)              REGEXP ?', [$regex])
                        ->orWhereRaw('LOWER(list_tempat.tempat2)             LIKE ?',   [$like])  // address boleh LIKE biasa
                        ->orWhereRaw('LOWER(list_tempat_coords.addr_city)    REGEXP ?', [$regex])
                        ->orWhereRaw('LOWER(list_tempat_coords.addr_country) REGEXP ?', [$regex]);
                }
            });
        }

        if ($request->kota) {
            $query->where(function ($q) use ($request) {
                $q->where('list_tempat.city', $request->kota)
                    ->orWhere('list_tempat_coords.addr_city', $request->kota);
            });
        }

        if ($request->kategori) {
            $query->where('list_tempat.negara', $request->kategori);
        }

        $places = $query->limit(200)->get();

        // Ambil koordinat via eager load tetap pakai relasi
        $ids = $places->pluck('id');
        $coords = \App\Models\ListTempatCoord::whereIn('tempat_id', $ids)
            ->get()
            ->keyBy('tempat_id');

        $formattedPlaces = $places->map(function ($place) use ($coords) {
            $coord = $coords->get($place->id);
            return [
                'id'          => $place->id,
                'name'        => $place->tempat,
                'description' => $place->keterangan,
                'category'    => $place->negara,
                'city'        => $place->city ?: ($coord->addr_city ?? null),
                'address'     => $place->tempat2,
                'price'       => $place->price,
                'hours'       => null,
                'lat'         => $coord ? (float) $coord->lat : null,
                'lng'         => $coord ? (float) $coord->lon : null,
                'has_coord'   => $coord !== null,
            ];
        });

        return response()->json($formattedPlaces);
    }

    public function getCities()
    {
        try {
            // Ambil dari list_tempat.city
            $citiesFromTempat = ListTempat::select('city as nama')
                ->whereNotNull('city')
                ->where('city', '!=', '')
                ->distinct()
                ->pluck('nama');

            // Ambil dari list_tempat_coords.addr_city
            $citiesFromCoords = ListTempatCoord::select('addr_city as nama')
                ->whereNotNull('addr_city')
                ->where('addr_city', '!=', '')
                ->distinct()
                ->pluck('nama');

            // Gabung & deduplicate
            $merged = $citiesFromTempat
                ->merge($citiesFromCoords)
                ->unique()
                ->sort()
                ->values()
                ->map(fn($c) => ['city' => $c]);

            return response()->json($merged);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getCategories()
    {
        try {
            // Pakai 'negara' sebagai pengganti kategori
            $categories = ListTempat::select('negara')
                ->whereNotNull('negara')
                ->where('negara', '!=', '')
                ->distinct()
                ->orderBy('negara')
                ->get();

            return response()->json($categories);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function calculateRoute(Request $request)
    {
        $waypoints = $request->waypoints;

        if (!$waypoints || count($waypoints) < 2) {
            return response()->json([
                'success' => false,
                'message' => 'Minimal 2 titik untuk menghitung rute'
            ]);
        }

        $placeIds = collect($waypoints)->pluck('id')->toArray();
        $places   = ListTempat::with('coordinate')->whereIn('id', $placeIds)->get();

        $coordinates = [];
        foreach ($waypoints as $waypoint) {
            $place = $places->firstWhere('id', $waypoint['id']);
            if ($place && $place->coordinate) {
                $coordinates[] = [
                    'lat'  => (float) $place->coordinate->lat,  // ← kolom: lat
                    'lng'  => (float) $place->coordinate->lon,  // ← kolom: lon
                    'name' => $place->tempat                    // ← kolom: tempat
                ];
            }
        }

        if (count($coordinates) < 2) {
            return response()->json([
                'success' => false,
                'message' => 'Koordinat tidak cukup untuk menghitung rute'
            ]);
        }

        $totalDistance  = 0;
        $routeSegments  = [];

        for ($i = 0; $i < count($coordinates) - 1; $i++) {
            $distance       = $this->calculateDistance(
                $coordinates[$i]['lat'],
                $coordinates[$i]['lng'],
                $coordinates[$i + 1]['lat'],
                $coordinates[$i + 1]['lng']
            );
            $totalDistance += $distance;
            $duration       = $distance / 40;

            $routeSegments[] = [
                'from'             => $coordinates[$i]['name'],
                'to'               => $coordinates[$i + 1]['name'],
                'distance_km'      => round($distance, 2),
                'duration_hours'   => round($duration, 1),
                'duration_minutes' => round($duration * 60)
            ];
        }

        return response()->json([
            'success'              => true,
            'total_distance_km'    => round($totalDistance, 2),
            'total_duration_hours' => round($totalDistance / 40, 1),
            'route_segments'       => $routeSegments,
            'coordinates'          => $coordinates
        ]);
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // km

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    public function publish($id)
    {
        $itinerary = Itinerary::findOrFail($id);
        $itinerary->update(['status' => 'published']);

        return response()->json([
            'success' => true,
            'message' => 'Itinerary published successfully'
        ]);
    }

    public function toggleStatus(Request $request, $id)
    {
        // Cek role
        $user = Auth::user();
        if (!in_array($user->role, ['admin', 'superadmin'])) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak memiliki akses'
            ], 403);
        }

        $itinerary = Itinerary::findOrFail($id);

        $request->validate([
            'status' => 'required|in:draft,published,archived'
        ]);

        $itinerary->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diubah ke ' . ucfirst($request->status),
            'status'  => $itinerary->status
        ]);
    }

    public function destroy($id)
    {
        $itinerary = Itinerary::findOrFail($id);
        $itinerary->delete();

        return response()->json([
            'success' => true,
            'message' => 'Itinerary deleted successfully'
        ]);
    }
}
