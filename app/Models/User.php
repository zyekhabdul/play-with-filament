<?php

namespace App\Models;

use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // if using auth
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name',
        'username',
        'role',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Compatibility: provide a `name` attribute used by Filament.
     * Filament expects `$user->getAttributeValue('name')` to be a string.
     * Map our `user_name` / `username` / `email` to `name`.
     */
    public function getNameAttribute(): string
    {
        return (string) ($this->attributes['name'] ?? $this->attributes['username'] ?? $this->attributes['email'] ?? '');
    }

    /**
     * Payments made by this user (treasurer/admin who recorded payment)
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id', 'user_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Cek panel ID (lihat di config/filament.php)
        $panelId = $panel->getId();

        // Jika panel admin, hanya role admin
        if ($panelId === 'admin') {
            return $this->role === 'admin';
        }

        // Jika panel user, hanya role user
        if ($panelId === 'user') {
            return $this->role === 'user';
        }

        // Default
        return true;
    }
}
