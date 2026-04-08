<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BossUser extends Authenticatable implements FilamentUser
{
    protected $table = 'boss_users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'id_level',
        'partner_id',
        'managed_by'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'id_level' => 'integer',
    ];

    // Role check methods
    public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPartner(): bool
    {
        return $this->role === 'partner';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    // Relationships
    public function partner(): BelongsTo
    {
        return $this->belongsTo(PartnershipApplication::class, 'partner_id');
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(BossUser::class, 'managed_by');
    }

    public function managedUsers(): HasMany
    {
        return $this->hasMany(BossUser::class, 'managed_by');
    }

    // Filament panel access logic
    public function canAccessPanel(Panel $panel): bool
    {
        $panelId = $panel->getId();

        return match ($panelId) {
            'superadmin' => $this->isSuperAdmin() || $this->isAdmin(),
            'partner' => $this->isPartner(),
            'user' => $this->isUser(),
            default => false,
        };
    }

    // Level access (jika diperlukan)
    public function getLevelNameAttribute(): string
    {
        return match ($this->id_level) {
            1 => 'Basic',
            2 => 'Premium',
            3 => 'VIP',
            default => 'Unknown',
        };
    }
}
