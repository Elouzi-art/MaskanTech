<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'slug', 'description', 'price', 'area',
        'type', 'rooms', 'bedrooms', 'bathrooms', 'address', 'city',
        'postal_code', 'year_built', 'status', 'is_featured',
        'video_url', 'target_audience',
        // 'views_count' géré par increment(), pas besoin dans fillable
    ];

    protected $casts = [
        'price'       => 'decimal:2',
        'area'        => 'decimal:2',
        'is_featured' => 'boolean',
    ];

    /**
     * Statuts disponibles — LOCATION UNIQUEMENT (pas de vente).
     */
    const STATUSES = [
        'available' => 'Disponible',
        'rented'    => 'Loué',
    ];

    /**
     * Audiences cibles pour une annonce.
        * "all" = visible par tous, "student" = uniquement pour étudiants, "professional" = uniquement pour clients professionnels.     
     */
    const AUDIENCES = [
        'all'          => 'Tout le monde',
        'student'      => 'Étudiants uniquement',
        'professional' => 'Professionnels uniquement',
    ];

    // ── Slug auto ─────────────────────────────────────────────────────────

    protected static function booted(): void
    {
        static::creating(function (Property $property) {
            if (empty($property->slug)) {
                $property->slug = static::uniqueSlug($property->title);
            }
        });
    }

    public static function uniqueSlug(string $title): string
    {
        $slug  = Str::slug($title);
        $count = static::where('slug', 'like', "$slug%")->count();
        return $count ? "$slug-$count" : $slug;
    }

    // ── Relations ─────────────────────────────────────────────────────────

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   

    public function images()
    {
    return $this->hasMany(PropertyImage::class)
        ->orderBy('is_primary', 'desc')
        ->orderBy('order');            // ← nom réel dans la migration
    }

    public function primaryImage()
    {
    return $this->hasOne(PropertyImage::class)
        ->where('is_primary', true)
        ->orderBy('order');            // ← nom réel dans la migration
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    // ── Scopes ────────────────────────────────────────────────────────────

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope pour filtrer selon le rôle/audience de l'utilisateur connecté.
     * Un étudiant ne voit que les annonces "all" ou "student".
     */
    public function scopeForUser($query, ?User $user)
    {
        if (! $user || $user->isAdmin() || $user->isAgent() || $user->isOwner()) {
            return $query; // tout voir
        }

        if ($user->isStudent()) {
            return $query->whereIn('target_audience', ['all', 'student']);
        }

        // client professionnel
        return $query->whereIn('target_audience', ['all', 'professional']);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['q'] ?? null, fn($q, $v) =>
            $q->where(fn($sub) =>
                $sub->where('title', 'like', "%$v%")
                    ->orWhere('description', 'like', "%$v%")
                    ->orWhere('address', 'like', "%$v%")
            )
        );

        $query->when($filters['type']      ?? null, fn($q, $v) => $q->where('type', $v));
        $query->when($filters['city']      ?? null, fn($q, $v) => $q->where('city', 'like', "%$v%"));
        $query->when($filters['status']    ?? null, fn($q, $v) => $q->where('status', $v));
        $query->when($filters['price_min'] ?? null, fn($q, $v) => $q->where('price', '>=', $v));
        $query->when($filters['price_max'] ?? null, fn($q, $v) => $q->where('price', '<=', $v));
        $query->when($filters['bedrooms']  ?? null, fn($q, $v) => $q->where('bedrooms', '>=', $v));
        $query->when($filters['audience']  ?? null, fn($q, $v) => $q->where('target_audience', $v));

        $sort = $filters['sort'] ?? 'latest';
        match ($sort) {
            'price_asc'  => $query->orderBy('price'),
            'price_desc' => $query->orderByDesc('price'),
            'area_desc'  => $query->orderByDesc('area'),
            default      => $query->latest(),
        };

        return $query;
    }

    // ── Helpers ───────────────────────────────────────────────────────────

    /**
     * ✅ Fix N+1 : utilise la relation déjà chargée si disponible
     * au lieu de faire une requête SQL par propriété.
     */
    public function isFavoritedBy(?User $user): bool
    {
        if (! $user) return false;

        // Si la relation favoritedBy est déjà chargée (eager load), on l'utilise
        if ($this->relationLoaded('favoritedBy')) {
            return $this->favoritedBy->contains('id', $user->id);
        }

        return $this->favoritedBy()->where('user_id', $user->id)->exists();
    }

    public function getAudienceLabelAttribute(): string
    {
        return self::AUDIENCES[$this->target_audience ?? 'all'] ?? 'Tout le monde';
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status ?? 'available'] ?? ucfirst($this->status);
    }

   
}
