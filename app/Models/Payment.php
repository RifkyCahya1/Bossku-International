<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'invoice_number',
        'name',
        'email',
        'phone',
        'tour_name',
        'date',
        'guests',
        'total',
        'status',
    ];
}
