<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $table = 'boss_subscribers';

    protected $fillable = ['email'];

    protected $casts = [
        'subscribed_at' => 'datetime',
    ];
}
