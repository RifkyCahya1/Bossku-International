<?php

namespace App\Http\Controllers;

use App\Models\BossBookEvent;
use App\Models\Payment; // Note: Nama modelnya Payment, bukan BossPayment
use App\Models\Subscriber;
use App\Models\BossUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Get current authenticated user
        $currentUser = Auth::user();

        // Data untuk KPI Cards
        // Total Revenue dari booking yang sukses
        $totalRevenue = BossBookEvent::successful()
            ->sum('total_price') ?? 0;

        // Active Projects (booking dengan status pending/success yang checkin_date masih akan datang)
        $activeProjects = BossBookEvent::whereIn('payment_status', ['pending', 'success'])
            ->where('checkin_date', '>=', now())
            ->count();

        // Outstanding Payment (total dari booking yang masih pending)
        $outstandingPayment = BossBookEvent::pending()
            ->sum('total_price') ?? 0;

        // Overdue invoices (booking pending dengan checkin_date sudah lewat)
        $overdueInvoices = BossBookEvent::pending()
            ->where('checkin_date', '<', now())
            ->count();

        // Data untuk tabel Active Projects
        $activeProjectsList = BossBookEvent::whereIn('payment_status', ['pending', 'success'])
            ->where('checkin_date', '>=', now())
            ->orderBy('checkin_date')
            ->take(5)
            ->get()
            ->map(function ($booking) {
                // Hitung progress berdasarkan payment_status
                $progress = $booking->payment_status === 'success' ? 100 : ($booking->payment_status === 'pending' ? 50 : 25);

                $statusClass = match ($booking->payment_status) {
                    'success' => 'emerald',
                    'pending' => 'gold',
                    'expired' => 'smoke',
                    default => 'sapphire'
                };

                $status = match ($booking->payment_status) {
                    'success' => 'Completed',
                    'pending' => 'Active',
                    'expired' => 'Expired',
                    default => 'Draft'
                };

                return [
                    'id' => $booking->id,
                    'name' => $booking->event_name ?? $booking->package_name,
                    'client' => $booking->runner_name ?? 'No Name',
                    'value' => 'Rp ' . number_format($booking->total_price ?? 0, 0, ',', '.'),
                    'status' => $status,
                    'statusClass' => $statusClass,
                    'progress' => $progress,
                    'date' => $booking->checkin_date ? $booking->checkin_date->format('d M Y') : 'TBA'
                ];
            });

        // Data untuk Recent Payments dari tabel payments
        $recentPayments = Payment::orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($payment) {
                return [
                    'id' => $payment->id,
                    'name' => $payment->tour_name ?? 'Tour Payment',
                    'date' => $payment->created_at->format('d M Y'),
                    'amount' => '+ Rp ' . number_format($payment->total ?? 0, 0, ',', '.'),
                    'type' => 'in' // Default incoming
                ];
            });

        // Data untuk Chart (Revenue per bulan dari BossBookEvent)
        $chartData = [];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        // Hitung max revenue untuk skala chart
        $monthlyRevenues = [];
        foreach (range(1, 12) as $month) {
            $revenue = BossBookEvent::successful()
                ->whereMonth('checkin_date', $month)
                ->whereYear('checkin_date', now()->year)
                ->sum('total_price') ?? 0;
            $monthlyRevenues[$month] = $revenue;
        }
        $maxRevenue = max($monthlyRevenues) ?: 1; // Hindari division by zero

        foreach (range(1, 12) as $month) {
            $revenue = $monthlyRevenues[$month];
            $percentage = $maxRevenue > 0 ? round(($revenue / $maxRevenue) * 100) : 0;

            $chartData[] = [
                'label' => $months[$month - 1],
                'h' => min($percentage, 100),
                'active' => $month === now()->month,
                'revenue' => $revenue
            ];
        }

        // Data untuk Projects Full List (halaman Projects)
        $projectsFull = BossBookEvent::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($booking) {
                $paidPercentage = $booking->payment_status === 'success' ? 100 : ($booking->payment_status === 'pending' ? 50 : 0);

                $statusClass = match ($booking->payment_status) {
                    'success' => 'emerald',
                    'pending' => 'gold',
                    'expired' => 'smoke',
                    default => 'sapphire'
                };

                $status = match ($booking->payment_status) {
                    'success' => 'Completed',
                    'pending' => 'Active',
                    'expired' => 'Expired',
                    default => 'Draft'
                };

                return [
                    'id' => $booking->booking_id ?? 'PRJ-' . str_pad($booking->id, 3, '0', STR_PAD_LEFT),
                    'name' => $booking->event_name ?? $booking->package_name,
                    'type' => $booking->package_type ?? 'Regular Package',
                    'client' => $booking->runner_name ?? 'No Name',
                    'date' => $booking->checkin_date ? $booking->checkin_date->format('d M Y') : 'TBA',
                    'value' => 'Rp ' . number_format($booking->total_price ?? 0, 0, ',', '.'),
                    'vendors' => rand(2, 4), // Ini bisa dikembangkan jika ada relasi ke vendor
                    'paid' => $paidPercentage,
                    'status' => $status,
                    'statusClass' => $statusClass
                ];
            });

        // Data untuk recent subscribers
        $recentSubscribers = Subscriber::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Data untuk CRM Pipeline (menggunakan data subscribers dan bookings)
        $leadCount = Subscriber::count();
        $proposalCount = BossBookEvent::pending()->count();
        $dealCount = BossBookEvent::successful()->count();
        $completedCount = BossBookEvent::successful()
            ->where('checkout_date', '<', now())
            ->count();

        return view('dashboard', compact(
            'totalRevenue',
            'activeProjects',
            'outstandingPayment',
            'overdueInvoices',
            'activeProjectsList',
            'recentPayments',
            'chartData',
            'projectsFull',
            'recentSubscribers',
            'currentUser',
            'leadCount',
            'proposalCount',
            'dealCount',
            'completedCount'
        ));
    }

    // Method untuk membuat project baru (booking baru)
    public function storeProject(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'client' => 'required|string|max:255',
            'date' => 'required|date',
            'value' => 'required|numeric',
            'type' => 'required|string',
            'description' => 'nullable|string',
            'email' => 'nullable|email',
            'whatsapp' => 'nullable|string'
        ]);

        // Generate booking ID
        $bookingId = 'BOOK-' . strtoupper(uniqid());

        $booking = BossBookEvent::create([
            'booking_id' => $bookingId,
            'event_name' => $validated['name'],
            'runner_name' => $validated['client'],
            'email' => $validated['email'] ?? null,
            'whatsapp_number' => $validated['whatsapp'] ?? null,
            'checkin_date' => $validated['date'],
            'total_price' => $validated['value'],
            'package_type' => $validated['type'],
            'extra_notes' => $validated['description'] ?? null,
            'payment_status' => 'pending',
            'package_name' => $validated['name'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Project berhasil dibuat',
            'data' => $booking
        ]);
    }

    // Method untuk mendapatkan detail project
    public function getProject($id)
    {
        $project = BossBookEvent::findOrFail($id);

        // Cari payment terkait jika ada
        $payments = Payment::where('tour_id', $project->id)
            ->orWhere('email', $project->email)
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'project' => $project,
                'payments' => $payments
            ]
        ]);
    }

    // Method untuk dashboard stats (API)
    public function getStats()
    {
        $stats = [
            'revenue_mtd' => BossBookEvent::successful()
                ->whereMonth('checkin_date', now()->month)
                ->whereYear('checkin_date', now()->year)
                ->sum('total_price'),
            'active_projects' => BossBookEvent::whereIn('payment_status', ['pending', 'success'])
                ->where('checkin_date', '>=', now())
                ->count(),
            'outstanding' => BossBookEvent::pending()->sum('total_price'),
            'overdue_invoices' => BossBookEvent::pending()
                ->where('checkin_date', '<', now())
                ->count(),
            'total_subscribers' => Subscriber::count(),
            'conversion_rate' => $this->calculateConversionRate()
        ];

        return response()->json($stats);
    }

    // Hitung conversion rate dari subscribers ke bookings
    private function calculateConversionRate()
    {
        $totalSubscribers = Subscriber::count();
        if ($totalSubscribers === 0) return 0;

        $totalBookings = BossBookEvent::count();
        return round(($totalBookings / $totalSubscribers) * 100);
    }

    // Method untuk mendapatkan data subscribers
    public function getSubscribers()
    {
        $subscribers = Subscriber::orderBy('created_at', 'desc')->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $subscribers
        ]);
    }

    // Method untuk menambah subscriber baru
    public function storeSubscriber(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:boss_subscribers,email'
        ]);

        $subscriber = Subscriber::create([
            'email' => $validated['email']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Subscriber berhasil ditambahkan',
            'data' => $subscriber
        ]);
    }
}
