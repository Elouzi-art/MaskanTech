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
        'postal_code', 'year_built', 'status', 'is_featured', 'video_url',
    ];

    protected function casts(): array
    {
        return [
            'price'       => 'decimal:2',
            'area'        => 'decimal:2',
            'is_featured' => 'boolean',
        ];
    }

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
        $slug = Str::slug($title);
        $count = static::where('slug', 'like', "$slug%")->count();
        return $count ? "$slug-$count" : $slug;
    }

    // ── Relations ─────────────────────────────────────────────────────────

    /** Agent propriétaire du bien */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** Toutes les images */
    public function images()
    {
        return $this->hasMany(PropertyImage::class)->orderBy('order_position');
    }

    /** Image principale */
    public function primaryImage()
    {
        return $this->hasOne(PropertyImage::class)->where('is_primary', true)->orderBy('order_position');
    }

    /** Caractéristiques (many-to-many) */
    public function features()
    {
        return $this->belongsToMany(PropertyFeature::class, 'property_feature_property');
    }

    /** Utilisateurs ayant mis en favori */
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    /** Rendez-vous liés à ce bien */
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

    /** Vérifie si un utilisateur donné a mis ce bien en favori */
    public function isFavoritedBy(?User $user): bool
    {
        if (! $user) return false;
        return $this->favoritedBy()->where('user_id', $user->id)->exists();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
