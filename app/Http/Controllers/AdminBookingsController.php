<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\BossBookEvent;
use Illuminate\Http\Request;

class AdminBookingsController extends Controller
{
    public function index()
    {
        return view('admin.booking');
    }

    // Endpoint JSON untuk SPA fetch
    public function data(Request $request)
    {
        $type = $request->get('type', 'all');
        $page = $request->get('page', 1);

        $result = [];

        if ($type === 'all' || $type === 'tour') {
            $payments = Payment::latest()->paginate(10, ['*'], 'tour_page', $type === 'all' ? 1 : $page);
            $result['tour'] = [
                'data'         => $payments->items(),
                'current_page' => $payments->currentPage(),
                'last_page'    => $payments->lastPage(),
                'total'        => $payments->total(),
                'from'         => $payments->firstItem() ?? 0,
                'to'           => $payments->lastItem() ?? 0,
            ];
        }

        if ($type === 'all' || $type === 'event') {
            $events = BossBookEvent::latest()->paginate(10, ['*'], 'event_page', $type === 'all' ? 1 : $page);
            $result['event'] = [
                'data'         => $events->items(),
                'current_page' => $events->currentPage(),
                'last_page'    => $events->lastPage(),
                'total'        => $events->total(),
                'from'         => $events->firstItem() ?? 0,
                'to'           => $events->lastItem() ?? 0,
            ];
        }

        return response()->json($result);
    }

    public function updateStatus($id, $status)
    {
        Payment::where('id', $id)->update(['status' => strtoupper($status)]);
        return back();
    }

    public function updateEventStatus($id, $status)
    {
        BossBookEvent::where('id', $id)->update(['payment_status' => strtolower($status)]);
        return back();
    }
}
