<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingEvent extends Model
{

    use HasFactory;

    protected $fillable = [
        'booking_reference',
        'full_name',
        'email',
        'phone',
        'nationality',
        'id_card_number',
        'event',
        'package',
        'participant_count',
        'arrival_date',
        'departure_date',
        'special_requests',
        'emergency_contact_name',
        'emergency_contact_phone',
        'payment_method',
        'total_amount',
        'status',
        'terms_accepted'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            $booking->booking_reference = 'RDL-' . strtoupper(uniqid());
            $booking->status = 'pending';
        });
    }
}
