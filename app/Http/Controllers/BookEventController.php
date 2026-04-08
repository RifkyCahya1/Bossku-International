<?php

namespace App\Http\Controllers;

use App\Models\BossBookEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BookEventController extends Controller
{
    public function index(Request $request)
    {
        // Package details sesuai dengan halaman utama
        $packages = [
            'basic' => [
                'name' => 'Runner Basic Stay',
                'price' => 1600000,
                'features' => [
                    'Airport Shuttle',
                    'Welcome Kit',
                    'Hotel (3 nights)',
                    '1 Pre Race Dinner'
                ],
                'description' => 'For independent runners who only need a solid base',
                'best_for' => 'Experienced runners · Running communities · Those with their own transport plan'
            ],
            'comfort' => [
                'name' => 'Runner Comfort Logistics',
                'price' => 1850000,
                'features' => [
                    'Airport Shuttle',
                    'Welcome Kit',
                    'Transport Drop Point (Motorbike)',
                    'Hotel',
                    '1 Pre Race Dinner'
                ],
                'description' => 'For first-timers & out-of-town runners',
                'best_for' => 'First-time marathoners · Runners new to the city · Stress-free planners'
            ],
            'premium' => [
                'name' => 'Runner Premium Assist',
                'price' => 3950000,
                'features' => [
                    'All Runner Comfort Logistics',
                    'Priority coordination & faster response window',
                    'Dedicated staff contact',
                    'Personalized departure timing plan'
                ],
                'description' => 'For runners who need higher coordination certainty',
                'best_for' => 'Elite athletes · VIP runners · Public figures · Time-sensitive schedules'
            ],
            'flash-deal' => [
                'name' => 'Runner Flash Deal',
                'price' => 1060000,
                'features' => [
                    'Airport Shuttle',
                    'Welcome Kit',
                    'Hotel (3 nights)',
                    '1 Pre Race Dinner'
                ],
                'description' => 'Because on race day, certainty matters.',
                'best_for' => 'Limited slots available'
            ]
        ];

        $selectedPackage = $request->query('package', 'comfort');
        $event = $request->query('event', 'jakarta');
        $participants = $request->query('participants', 1);

        // Validasi package
        if (!array_key_exists($selectedPackage, $packages)) {
            $selectedPackage = 'comfort';
        }

        return view('bookingevent', compact('packages', 'selectedPackage', 'event', 'participants'));
    }
}
