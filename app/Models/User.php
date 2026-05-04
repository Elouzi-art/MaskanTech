<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'address', 'avatar',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // ── Helpers de rôle ───────────────────────────────────────────────────

    public function isAdmin(): bool  { return $this->role === 'admin'; }
    public function isAgent(): bool  { return $this->role === 'agent'; }
    public function isClient(): bool { return $this->role === 'client'; }

    // ── Relations ─────────────────────────────────────────────────────────

    /** Biens publiés par cet agent */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    /** Favoris du client */
    public function favorites()
    {
        return $this->belongsToMany(Property::class, 'favorites')->withTimestamps();
    }

    /** Rendez-vous en tant que client */
    public function appointmentsAsClient()
    {
        return $this->hasMany(Appointment::class, 'client_id');
    }

    /** Rendez-vous en tant qu'agent */
    public function appointmentsAsAgent()
    {
        return $this->hasMany(Appointment::class, 'agent_id');
    }

    /** Messages envoyés */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /** Messages reçus */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    /** Notifications */
    public function appNotifications()
    {
        return $this->hasMany(Notification::class);
    }

    // ── Accesseurs utiles ─────────────────────────────────────────────────

    /** Nombre de messages non lus — utilisé dans la navbar */
    public function getUnreadMessagesCountAttribute(): int
    {
        return $this->receivedMessages()->where('is_read', false)->count();
    }

    public function getAvatarUrlAttribute(): string
    {
        return $this->avatar
            ? \Storage::url($this->avatar)
            : 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&background=1a1a1a&color=d0d0d0';
    }
}
