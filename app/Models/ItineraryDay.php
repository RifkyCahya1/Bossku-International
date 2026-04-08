<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItineraryDay extends Model
{
    protected $table = 'itinerary_days';

    protected $fillable = [
        'itinerary_id',
        'day_number',
        'title',
        'description',
        'places',
        'route_data'
    ];

    protected $casts = [
        'places' => 'array',
        'route_data' => 'array'
    ];

    public function days()
    {
        return $this->hasMany(ItineraryDay::class)->orderBy('day_number');
    }

    public function itinerary()
    {
        return $this->belongsTo(Itinerary::class);
    }
}
