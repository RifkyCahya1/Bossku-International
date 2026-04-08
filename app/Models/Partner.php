<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PartnershipApplication extends Model
{
    protected $table = 'partnership_applications';

    protected $fillable = [
        'nama',
        'perusahaan',
        'email',
        'whatsapp',
        'kota',
        'nomor_rekening',
        'nama_rekening',
        'nama_bank',
        'value',
        'agreements',
        'status',
        'admin_notes',
        'processed_at',
        'processed_by'
    ];

    protected $casts = [
        'agreements' => 'array',
        'processed_at' => 'datetime',
    ];

    public function processor(): BelongsTo
    {
        return $this->belongsTo(BossUser::class, 'processed_by');
    }
}
