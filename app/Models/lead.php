<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'full_name',
        'email',
        'phone',
        'company',
        'interest',
        'lead_type',
        'priority',
        'status',
        'assigned_to',
        'estimated_value',
        'currency',
        'source',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'first_contact_at',
        'last_contact_at',
        'next_follow_up_at',
        'internal_notes',
        'ip_address',
        'handled_by',
        'user_agent'
    ];

    public function handler()
    {
        return $this->belongsTo(User::class, 'handled_by');
    }

    protected $casts = [
        'first_contact_at' => 'datetime',
        'last_contact_at' => 'datetime',
        'next_follow_up_at' => 'datetime',
        'estimated_value' => 'decimal:2'
    ];

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
