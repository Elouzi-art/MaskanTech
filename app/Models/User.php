<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'address',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    // ── Rôles ─────────────────────────────────────────────────────────────

    const ROLES = [
        'admin'  => 'Administrateur',
        'agent'  => 'Agent',
        'client' => 'Locataire',
        'student'=> 'Étudiant',
        'owner'  => 'Propriétaire',
    ];

    public function isAdmin():   bool { return $this->role === 'admin'; }
    public function isAgent():   bool { return $this->role === 'agent'; }
    public function isClient():  bool { return $this->role === 'client'; }
    public function isStudent(): bool { return $this->role === 'student'; }
    public function isOwner():   bool { return $this->role === 'owner'; }

    /**
     * Peut louer (voir le formulaire RDV) : client, student, owner.
     */
    public function canRent(): bool
    {
        return in_array($this->role, ['client', 'student', 'owner']);
    }

    public function getRoleLabelAttribute(): string
    {
        return self::ROLES[$this->role] ?? ucfirst($this->role);
    }

    // ── Relations ─────────────────────────────────────────────────────────

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Property::class, 'favorites')->withTimestamps();
    }

    /**
     * RDV en tant que client (locataire/étudiant/propriétaire).
     */
    public function appointmentsAsClient()
    {
        return $this->hasMany(Appointment::class, 'client_id');
    }

    /**
     * RDV en tant qu'agent.
     */
    public function appointmentsAsAgent()
    {
        return $this->hasMany(Appointment::class, 'agent_id');
    }

    /**
     * Messages envoyés.
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Messages reçus.
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    // ── Helpers ───────────────────────────────────────────────────────────

    /**
     * Nombre de messages non lus (utilisé dans la navbar).
     */
    public function getUnreadMessagesCountAttribute(): int
    {
        return $this->receivedMessages()->where('is_read', false)->count();
    }
}
