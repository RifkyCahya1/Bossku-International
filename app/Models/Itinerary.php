<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Itinerary extends Model
{
    use SoftDeletes;

    protected $table = 'itineraries';

    protected $fillable = [
        'code',
        'title',
        'slug',
        'description',
        'duration_days',
        'start_date',
        'end_date',
        'start_location',
        'end_location',
        'waypoints',
        'selected_places',
        'total_distance',
        'total_duration',
        'status',
        'created_by'
    ];

    protected $casts = [
        'waypoints' => 'array',
        'selected_places' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'total_distance' => 'decimal:2',
        'total_duration' => 'decimal:2'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($itinerary) {
            if (empty($itinerary->code)) {
                $itinerary->code = 'ITR-' . strtoupper(Str::random(8));
            }
            if (empty($itinerary->slug)) {
                $itinerary->slug = Str::slug($itinerary->title);
            }
        });
    }

    public function days()
    {
        return $this->hasMany(ItineraryDay::class)->orderBy('day_number');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
