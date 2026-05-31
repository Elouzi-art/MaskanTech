@extends('layouts.maskan')

@section('title', 'MaskanTech — {{ $property->title }}')

@section('styles')
        .detail-wrap { max-width: 1200px; margin: 0 auto; padding: 40px 48px; }

        .breadcrumb { display: flex; align-items: center; gap: 8px; margin-bottom: 28px; font-size: 13px; color: #888; }
        .breadcrumb a { color: #888; text-decoration: none; transition: color 0.2s; }
        .breadcrumb a:hover { color: #C8873A; }
        .breadcrumb-sep { color: #ccc; }
        .breadcrumb-current { color: #1a1a1a; font-weight: 500; }

        .detail-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px; }
        .detail-header-left { flex: 1; }
        .detail-badges { display: flex; gap: 8px; margin-bottom: 12px; flex-wrap: wrap; }
        .detail-badge { font-size: 12px; font-weight: 500; padding: 5px 12px; border-radius: 20px; }
        .badge-type { background: #f0ede8; color: #1a1a1a; }
        .badge-student { background: #185FA5; color: #fff; }
        .badge-available { background: #eaf3de; color: #27500A; }
        .badge-rented { background: #fee; color: #c00; }
        .badge-featured { background: #C8873A; color: #fff; }
        .detail-title { font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 700; color: #1a1a1a; margin-bottom: 8px; line-height: 1.2; }
        .detail-loc { font-size: 15px; color: #888; }
        .detail-header-right { text-align: right; }
        .detail-price { font-family: 'Playfair Display', serif; font-size: 36px; font-weight: 700; color: #C8873A; }
        .detail-price span { font-size: 15px; font-family: 'DM Sans', sans-serif; font-weight: 300; color: #999; }
        .detail-views { font-size: 12px; color: #aaa; margin-top: 6px; }

        .gallery { display: grid; grid-template-columns: 2fr 1fr; grid-template-rows: 280px 180px; gap: 8px; border-radius: 16px; overflow: hidden; margin-bottom: 40px; }
        .gallery-main { grid-row: 1 / 3; background-size: cover; background-position: center; position: relative; background-color: #f0ede8; }
        .gallery-img { background-size: cover; background-position: center; background-color: #f0ede8; }
        .gallery-overlay {
            position: absolute; bottom: 16px; right: 16px;
            background: rgba(0,0,0,0.6); color: #fff;
            padding: 8px 16px; border-radius: 8px; font-size: 13px; cursor: pointer;
        }

        .detail-content { display: grid; grid-template-columns: 1fr 360px; gap: 40px; }

        .prop-stats { display: flex; gap: 32px; background: #fafaf8; border: 1px solid #ede9e3; border-radius: 12px; padding: 24px; margin-bottom: 32px; }
        .prop-stat { text-align: center; }
        .prop-stat-icon { font-size: 24px; margin-bottom: 8px; }
        .prop-stat-value { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: #1a1a1a; }
        .prop-stat-label { font-size: 12px; color: #888; margin-top: 4px; }

        .section-title { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; color: #1a1a1a; margin: 28px 0 16px; padding-bottom: 12px; border-bottom: 1px solid #f0ede8; }
        .detail-desc { font-size: 15px; color: #555; line-height: 1.8; }

        .features-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 12px; }
        .feature-item { display: flex; align-items: center; gap: 10px; background: #fafaf8; border: 1px solid #ede9e3; border-radius: 8px; padding: 12px 14px; }
        .feature-icon { font-size: 18px; }
        .feature-text { font-size: 13px; color: #555; }

        .map-placeholder { background: #f0ede8; border-radius: 12px; height: 200px; display: flex; align-items: center; justify-content: center; color: #888; font-size: 15px; }

        .similar-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 20px; margin-top: 16px; }
        .similar-card { border-radius: 10px; overflow: hidden; border: 1px solid #ede9e3; transition: transform 0.2s; }
        .similar-card:hover { transform: translateY(-3px); }
        .similar-img { height: 140px; background-size: cover; background-position: center; background-color: #f0ede8; }
        .similar-body { padding: 14px 16px; }
        .similar-price { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; color: #C8873A; }
        .similar-title { font-size: 13px; font-weight: 500; color: #1a1a1a; margin: 4px 0; }
        .similar-loc { font-size: 12px; color: #999; }

        .contact-card { background: #fff; border: 1px solid #ede9e3; border-radius: 16px; padding: 28px; position: sticky; top: 100px; }
        .contact-card-price { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; color: #C8873A; margin-bottom: 20px; }
        .contact-card-price span { font-size: 14px; font-family: 'DM Sans', sans-serif; font-weight: 300; color: #999; }
        .contact-divider { height: 1px; background: #f0ede8; margin: 20px 0; }
        .owner-label { font-size: 11px; color: #888; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 12px; }
        .owner-card { display: flex; align-items: center; gap: 14px; }
        .owner-avatar { width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg, #C8873A, #E8A855); display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: 700; color: #fff; }
        .owner-name { font-size: 14px; font-weight: 500; color: #1a1a1a; }
        .owner-verified { font-size: 12px; color: #27500A; margin-top: 2px; }
        .owner-since { font-size: 11px; color: #aaa; }
        .contact-btn { display: block; width: 100%; padding: 13px; border-radius: 8px; font-size: 14px; font-weight: 500; text-align: center; text-decoration: none; cursor: pointer; font-family: 'DM Sans', sans-serif; border: none; margin-bottom: 10px; transition: all 0.2s; }
        .btn-primary-gold { background: #C8873A; color: #fff; }
        .btn-primary-gold:hover { background: #b07530; }
        .btn-dark { background: #1a1a1a; color: #fff; }
        .btn-dark:hover { background: #C8873A; }
        .btn-outline { background: transparent; border: 1.5px solid #e8e3db; color: #555; }
        .btn-outline:hover { border-color: #C8873A; color: #C8873A; }
        .contact-note { font-size: 12px; color: #aaa; text-align: center; margin-top: 12px; line-height: 1.6; }

        /* MODAL RENDEZ-VOUS */
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center; }
        .modal-overlay.open { display: flex; }
        .modal { background: #fff; border-radius: 16px; padding: 32px; width: 100%; max-width: 480px; }
        .modal-title { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; margin-bottom: 20px; }
        .modal-close { float: right; background: none; border: none; font-size: 20px; cursor: pointer; color: #888; }
@endsection

@section('content')

{{-- INCRÉMENTER VUES --}}
<script>
    fetch('{{ route('properties.views', $property) }}', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
    });
</script>

<div class="detail-wrap">

    {{-- BREADCRUMB --}}
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Accueil</a>
        <span class="breadcrumb-sep">›</span>
        <a href="{{ route('properties.index') }}">Logements</a>
        <span class="breadcrumb-sep">›</span>
        <span class="breadcrumb-current">{{ $property->title }}</span>
    </div>

    {{-- HEADER --}}
    <div class="detail-header">
        <div class="detail-header-left">
            <div class="detail-badges">
                <span class="detail-badge badge-type">{{ ucfirst($property->type) }}</span>
                @if($property->status === 'available')
                    <span class="detail-badge badge-available">✅ Disponible</span>
                @else
                    <span class="detail-badge badge-rented">❌ Loué</span>
                @endif
                @if($property->target_audience === 'student')
                    <span class="detail-badge badge-student">🎓 Étudiant accepté</span>
                @endif
                @if($property->is_featured)
                    <span class="detail-badge badge-featured">⭐ En vedette</span>
                @endif
            </div>
            <h1 class="detail-title">{{ $property->title }}</h1>
            <p class="detail-loc">📍 {{ $property->address }}, {{ $property->city }}</p>
        </div>
        <div class="detail-header-right">
            <div class="detail-price">
                {{ number_format($property->price, 0, ',', ' ') }} MAD
                <span>/ mois</span>
            </div>
            <div class="detail-views">👁 {{ $property->views_count }} vues</div>
        </div>
    </div>

    {{-- GALLERY --}}
    <div class="gallery">
        <div class="gallery-main" style="
            @if($property->images->first())
                background-image: url('{{ Storage::url($property->images->first()->image_path) }}')
            @endif
        ">
            <div class="gallery-overlay">📷 {{ $property->images->count() }} photo(s)</div>
        </div>
        @foreach($property->images->skip(1)->take(2) as $image)
        <div class="gallery-img" style="background-image: url('{{ Storage::url($image->image_path) }}')"></div>
        @endforeach
        @for($i = $property->images->skip(1)->count(); $i < 2; $i++)
        <div class="gallery-img"></div>
        @endfor
    </div>

    {{-- CONTENT --}}
    <div class="detail-content">

        {{-- LEFT --}}
        <div class="detail-left">

            {{-- STATS --}}
            <div class="prop-stats">
                @if($property->bedrooms)
                <div class="prop-stat">
                    <div class="prop-stat-icon">🛏</div>
                    <div class="prop-stat-value">{{ $property->bedrooms }}</div>
                    <div class="prop-stat-label">Chambre(s)</div>
                </div>
                @endif
                @if($property->bathrooms)
                <div class="prop-stat">
                    <div class="prop-stat-icon">🚿</div>
                    <div class="prop-stat-value">{{ $property->bathrooms }}</div>
                    <div class="prop-stat-label">Salle(s) de bain</div>
                </div>
                @endif
                @if($property->area)
                <div class="prop-stat">
                    <div class="prop-stat-icon">📐</div>
                    <div class="prop-stat-value">{{ (int)$property->area }}</div>
                    <div class="prop-stat-label">m²</div>
                </div>
                @endif
                @if($property->rooms)
                <div class="prop-stat">
                    <div class="prop-stat-icon">🏠</div>
                    <div class="prop-stat-value">{{ $property->rooms }}</div>
                    <div class="prop-stat-label">Pièce(s)</div>
                </div>
                @endif
            </div>

            {{-- DESCRIPTION --}}
            <div class="section-title">Description</div>
            <div class="detail-desc">{{ $property->description }}</div>

            {{-- ÉQUIPEMENTS --}}
            @if($property->features->count() > 0)
            <div class="section-title">Équipements</div>
            <div class="features-grid">
                @foreach($property->features as $feature)
                <div class="feature-item">
                    <span class="feature-icon">✅</span>
                    <span class="feature-text">{{ $feature->name }}</span>
                </div>
                @endforeach
            </div>
            @endif

            {{-- LOCALISATION --}}
            <div class="section-title">Localisation</div>
            <div class="map-placeholder">
                🗺️ {{ $property->address }}, {{ $property->city }} — Carte interactive disponible bientôt
            </div>

            {{-- ANNONCES SIMILAIRES --}}
            @php
                $similar = \App\Models\Property::where('city', $property->city)
                    ->where('id', '!=', $property->id)
                    ->limit(3)->get();
            @endphp
            @if($similar->count() > 0)
            <div class="section-title">Annonces similaires</div>
            <div class="similar-grid">
                @foreach($similar as $sim)
                <a href="{{ route('properties.show', $sim) }}" class="similar-card" style="text-decoration:none;">
                    <div class="similar-img" style="
                        @if($sim->primaryImage)
                            background-image: url('{{ Storage::url($sim->primaryImage->image_path) }}')
                        @endif
                    "></div>
                    <div class="similar-body">
                        <div class="similar-price">{{ number_format($sim->price, 0, ',', ' ') }} MAD</div>
                        <div class="similar-title">{{ $sim->title }}</div>
                        <div class="similar-loc">📍 {{ $sim->city }}</div>
                    </div>
                </a>
                @endforeach
            </div>
            @endif

        </div>

        {{-- RIGHT --}}
        <div class="detail-right">
            <div class="contact-card">
                <div class="contact-card-price">
                    {{ number_format($property->price, 0, ',', ' ') }} MAD
                    <span>/ mois</span>
                </div>

                <div class="contact-divider"></div>

                <div class="owner-section">
                    <div class="owner-label">Propriétaire / Agent</div>
                    <div class="owner-card">
                        <div class="owner-avatar">
                            {{ strtoupper(substr($property->user->name, 0, 2)) }}
                        </div>
                        <div>
                            <div class="owner-name">{{ $property->user->name }}</div>
                            <div class="owner-verified">✅ Profil vérifié</div>
                            <div class="owner-since">Membre depuis {{ $property->user->created_at->format('Y') }}</div>
                        </div>
                    </div>
                </div>

                <div class="contact-divider"></div>

                @auth
                    @if($property->status === 'available')
                        <button onclick="document.getElementById('modal-rdv').classList.add('open')" class="contact-btn btn-primary-gold">
                            📅 Demander un rendez-vous
                        </button>
                    @endif
                    <a href="{{ route('messages.show', $property->user) }}" class="contact-btn btn-dark">
                        💬 Envoyer un message
                    </a>
                    <form action="{{ route('favorites.toggle', $property) }}" method="POST">
                        @csrf
                        <button type="submit" class="contact-btn btn-outline">
                            {{ $property->favoritedBy->contains(auth()->id()) ? '❤️ Retirer des favoris' : '🤍 Ajouter aux favoris' }}
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="contact-btn btn-primary-gold">
                        🔐 Connectez-vous pour contacter
                    </a>
                    <p class="contact-note">Créez un compte gratuit pour accéder à toutes les fonctionnalités.</p>
                @endauth
            </div>
        </div>
    </div>
</div>

{{-- MODAL RENDEZ-VOUS --}}
@auth
<div class="modal-overlay" id="modal-rdv">
    <div class="modal">
        <button class="modal-close" onclick="document.getElementById('modal-rdv').classList.remove('open')">✕</button>
        <div class="modal-title">📅 Demander un rendez-vous</div>

        @if(session('success'))
            <div style="background:#eaf3de;color:#27500A;padding:12px;border-radius:8px;margin-bottom:16px;font-size:13px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="property_id" value="{{ $property->id }}">

            <div class="mk-form-group">
                <label>Date souhaitée</label>
                <input type="date" name="date" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
            </div>
            <div class="mk-form-group">
                <label>Heure</label>
                <input type="time" name="time" required>
            </div>
            <div class="mk-form-group">
                <label>Message (optionnel)</label>
                <textarea name="message" rows="3" style="width:100%;padding:12px;border:1.5px solid #e8e3db;border-radius:8px;font-family:'DM Sans',sans-serif;font-size:14px;outline:none;resize:vertical;" placeholder="Précisez vos questions..."></textarea>
            </div>
            <button type="submit" class="contact-btn btn-primary-gold" style="margin-top:8px;">
                Envoyer la demande
            </button>
        </form>
    </div>
</div>
@endauth

@endsection