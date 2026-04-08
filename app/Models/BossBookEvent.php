<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BossBookEvent extends Model
{
    protected $table = 'Boss_bookEvent';

    protected $fillable = [
        'booking_id',
        'event_name',
        'runner_name',
        'whatsapp_number',
        'email',
        'origin_city',
        'referral_code',
        'referral_discount',
        'price_before_discount',
        'hotel_star',
        'night_count',
        'package_name',
        'package_type',
        'package_price',
        'twin_price',
        'single_price',
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
        'total_price',
        'payment_status',
        'payment_method',
        'doku_payment_id',
        'doku_invoice_number',
        'doku_url',
        'doku_raw_response',
        'payment_url',
        'payment_expired_at',
        'payment_completed_at',
        'paid_at',
        'last_status_check',
        'authorization_code',
        'card_info',
    ];

    protected $casts = [
        'checkin_date' => 'date',
        'checkout_date' => 'date',
        'flight_booking' => 'boolean',
        'hydration_pack' => 'boolean',
        'late_checkout' => 'boolean',
        'early_checkin' => 'boolean',
        'package_price' => 'integer',
        'twin_price' => 'integer',
        'single_price' => 'integer',
        'addons_total' => 'integer',
        'total_price' => 'integer',
        'payment_expired_at' => 'datetime',
        'payment_completed_at' => 'datetime',
        'paid_at' => 'datetime',
        'last_status_check' => 'datetime',
    ];

    public function scopePending($query)
    {
        return $query->where('payment_status', 'pending');
    }

    public function scopeSuccessful($query)
    {
        return $query->where('payment_status', 'success');
    }

    public function isPending()
    {
        return $this->payment_status === 'pending';
    }

    public function isSuccess()
    {
        return $this->payment_status === 'success';
    }

    public function isExpired()
    {
        return $this->payment_status === 'expired' ||
            ($this->payment_expired_at && now()->gt($this->payment_expired_at));
    }

    public function generateBookingId()
    {
        return 'BOOK-' . strtoupper(uniqid());
    }
}
