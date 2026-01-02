<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use Carbon\Carbon;

class AdminLeadsController extends Controller
{

    public function lead()
    {
        // TOTAL
        $totalLeads = Lead::count();

        // BULAN INI
        $now = now();

        $lastMonthDate = now()->subMonth();

        $thisMonth = Lead::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        $lastMonth = Lead::whereMonth('created_at', $lastMonthDate->month)
            ->whereYear('created_at', $lastMonthDate->year)
            ->count();


        $trendNew = $lastMonth > 0
            ? round((($thisMonth - $lastMonth) / $lastMonth) * 100)
            : ($thisMonth > 0 ? 100 : 0);


        // QUALIFIED
        $qualified = Lead::where('status', 'Qualified')->count();

        // CONVERTED
        $converted = Lead::where('status', 'Converted')->count();


        $leads = Lead::with('handler')
            ->latest()
            ->limit(50)
            ->get()
            ->map(function ($lead) {
                return [
                    'id'              => $lead->id,
                    'name'            => $lead->full_name,
                    'email'           => $lead->email,
                    'phone'           => $lead->phone,
                    'company'         => $lead->company,
                    'source'          => $lead->source,
                    'interest'        => $lead->interest,
                    'lead_type'       => $lead->lead_type,
                    'priority'        => $lead->priority,
                    'status'          => $lead->status,
                    'estimated_value' => $lead->estimated_value,
                    'internal_notes'  => $lead->internal_notes,
                    'handled_by'      => $lead->handler?->name ?? '—',
                    'last_contact'    => $lead->last_contact_at
                        ? Carbon::parse($lead->last_contact_at)->diffForHumans()
                        : '—',
                ];
            });


        return view('admin.leads', [
            'stats' => [
                [
                    'label' => 'Total Leads',
                    'value' => $totalLeads,
                    'trend' => 0,
                ],
                [
                    'label' => 'New This Month',
                    'value' => $thisMonth,
                    'trend' => $trendNew,
                ],
                [
                    'label' => 'Qualified',
                    'value' => $qualified,
                    'trend' => 0,
                ],
                [
                    'label' => 'Converted',
                    'value' => $converted,
                    'trend' => 0,
                ],
            ],

            'leads' => $leads,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => ['required', 'regex:/^\+\d{8,15}$/'],
            'company' => 'nullable|string',
            'interest' => 'nullable|string',
            'lead_type' => 'required|in:B2C,B2B',
            'priority' => 'required|in:Low,Medium,High',
            'estimated_value' => 'nullable|numeric',
            'source' => 'nullable|string',
            'internal_notes' => 'nullable|string',
        ]);

        Lead::create(array_merge($data, [
            'assigned_to' => $request->user()?->id,
            'first_contact_at' => now(),
            'last_contact_at'  => now(),
            'ip_address'       => $request->ip(),
            'user_agent'       => $request->userAgent(),
        ]));


        return back()->with('success', 'Lead berhasil ditambahkan');
    }

    public function contact(Lead $lead, Request $request)
    {
        if (! $request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $lead->update([
            'last_contact_at' => now(),
            'handled_by'      => $request->user()->id,
        ]);

        return response()->json(['success' => true]);
    }



    public function updateStatus(Request $request, Lead $lead)
    {
        $request->validate([
            'status' => 'required|in:New,Contacted,Qualified,Converted,Lost'
        ]);

        $lead->update([
            'status' => $request->status
        ]);

        return response()->json(['success' => true]);
    }
}
