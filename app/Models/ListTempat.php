<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListTempat extends Model
{
    protected $table = 'list_tempat';

    protected $fillable = [
        'continent',
        'negara',
        'city',
        'tempat',
        'tempat2',
        'keterangan',
        'kurs',
        'price',
        'chd',
        'infant',
        'senior',
        'junior'
    ];

    public function coordinate()
    {
        return $this->hasOne(ListTempatCoord::class, 'tempat_id', 'id');
    }
}
