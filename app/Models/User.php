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

    public function isAdmin(): bool   { return $this->role === 'admin'; }
    public function isAgent(): bool   { return $this->role === 'agent'; }
    public function isClient(): bool  { return $this->role === 'client'; }
    public function isStudent(): bool { return $this->role === 'student'; }
    /** Un propriétaire peut aussi louer (accès favoris + RDV comme client) */
    public function isOwner(): bool   { return $this->role === 'owner'; }

    /**
     * Vrai pour tous les rôles qui peuvent consulter/réserver des logements.
     * owner, client, student peuvent tous prendre des RDV et mettre en favoris.
     */
    public function canRent(): bool
    {
        return in_array($this->role, ['client', 'student', 'owner']);
    }

    /**
     * Libellé lisible du rôle.
     */
    public function getRoleLabelAttribute(): string
    {
        return match ($this->role) {
            'admin' => 'Administrateur',
            'agent' => 'Agent',
            'client' => 'Locataire',
            'student' => 'Étudiant',
            'owner' => 'Propriétaire',
            default => ucfirst($this->role),
        };
    }

    // ── Relations ─────────────────────────────────────────────────────────

    /** Biens publiés par cet agent/propriétaire */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    /** Favoris (accessible à client, student, owner) */
    public function favorites()
    {
        return $this->belongsToMany(Property::class, 'favorites')->withTimestamps();
    }

    /** Rendez-vous en tant que locataire */
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

    // ── Accesseurs ────────────────────────────────────────────────────────

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
