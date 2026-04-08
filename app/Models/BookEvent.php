<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'event_name',
        'runner_name',
        'whatsapp_number',
        'email',
        'origin_city',
        'referral_code',
        'hotel_star',
        'package_type',
        'package_name',
        'package_price',
        'checkin_date',
        'checkout_date',
        'room_type',
        'flight_booking',
        'hydration_pack',
        'hydration_pack_price',
        'late_checkout',
        'early_checkin',
        'extra_notes',
        'addons_total',
        'total_amount',
        'payment_status',
        'doku_invoice_number',
        'doku_url'
    ];

    protected $casts = [
        'checkin_date' => 'date',
        'checkout_date' => 'date',
        'flight_booking' => 'boolean',
        'hydration_pack' => 'boolean',
        'late_checkout' => 'boolean',
        'early_checkin' => 'boolean',
        'package_price' => 'decimal:2',
        'addons_total' => 'decimal:2',
        'total_amount' => 'decimal:2'
    ];
}
