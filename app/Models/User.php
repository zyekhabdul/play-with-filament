<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // if using auth
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_name',
        'username',
        'email',
        'password',
        'role',
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
        return (string) ($this->attributes['user_name'] ?? $this->attributes['username'] ?? $this->attributes['email'] ?? '');
    }

    /**
     * Payments made by this user (treasurer/admin who recorded payment)
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id', 'user_id');
    }
}
