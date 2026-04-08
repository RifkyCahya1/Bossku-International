<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partnership extends Model
{

    protected $table = 'boss_partnerships';

    protected $fillable = [
        'nama',
        'perusahaan',
        'email',
        'whatsapp',
        'kota',
        'nama_bank',
        'nomor_rekening',
        'nama_rekening',
        'value',
        'referral_code',
        'status',
        'agr_accuracy',
        'agr_contact',
        'agr_terms',
        'email_sent_at',
        'wa_sent_at',
    ];

    protected $casts = [
        'agr_accuracy'   => 'boolean',
        'agr_contact'    => 'boolean',
        'agr_terms'      => 'boolean',
        'email_sent_at'  => 'datetime',
        'wa_sent_at'     => 'datetime',
    ];
}
