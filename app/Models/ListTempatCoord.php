<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListTempatCoord extends Model
{
    protected $table = 'list_tempat_coords';

    protected $fillable = [
        'tempat_id',
        'lat',
        'lon',
        'addr_name',
        'addr_city',
        'addr_country'
    ];
}
