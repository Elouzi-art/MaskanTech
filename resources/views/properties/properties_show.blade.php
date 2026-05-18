@extends('layouts.maskan')
@section('title', $property->title . ' — MaskanTech')

@section('styles')
.show-wrap { max-width: 1100px; margin: 0 auto; padding: 40px 24px; display: grid; grid-template-columns: 1fr 360px; gap: 32px; align-items: start; }
.show-left { display: flex; flex-direction: column; gap: 24px; }
.show-right { display: flex; flex-direction: column; gap: 20px; position: sticky; top: 89px; }

/* Breadcrumb */
.breadcrumb { font-size: 12px; color: #888; display: flex; align-items: center; gap: 8px; margin-bottom: 8px; }
.breadcrumb a { color: #888; text-decoration: none; transition: color 0.2s; }
.breadcrumb a:hover { color: #C8873A; }
.breadcrumb span { color: #ccc; }

/* Galerie */
.gallery-main { border-radius: 12px; overflow: hidden; background: #f5f2ee; height: 380px; position: relative; }
.gallery-main img { width: 100%; height: 100%; object-fit: cover; }
.gallery-thumbs { display: flex; gap: 8px; margin-top: 10px; overflow-x: auto; }
.gallery-thumb { width: 80px; height: 56px; border-radius: 8px; overflow: hidden; border: 2px solid transparent; cursor: pointer; shrink: 0; transition: border-color 0.2s; flex-shrink: 0; }
.gallery-thumb.active, .gallery-thumb:hover { border-color: #C8873A; }
.gallery-thumb img { width: 100%; height: 100%; object-fit: cover; }
.gallery-placeholder { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 8px; }
.gallery-placeholder svg { opacity: 0.3; }
.gallery-placeholder span { font-size: 12px; color: #aaa; }

/* Badges galerie */
.gallery-badges { position: absolute; top: 14px; left: 14px; display: flex; gap: 6px; flex-wrap: wrap; z-index: 2; }
.badge { font-size: 11px; font-weight: 500; padding: 4px 10px; border-radius: 20px; }
.badge-available { background: #d1fae5; color: #065f46; }
.badge-rented { background: #fed7aa; color: #9a3412; }
.badge-featured { background: #C8873A; color: #fff; }

/* Cards --*/
.show-card { background: #fff; border: 1px solid #ede9e3; border-radius: 12px; padding: 24px; }
.show-card-title { font-size: 11px; color: #aaa; letter-spacing: 2px; text-transform: uppercase; font-weight: 500; margin-bottom: 16px; }
.detail-row { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #f5f2ee; font-size: 13px; }
.detail-row:last-child { border-bottom: none; }
.detail-row .key { color: #888; }
.detail-row .val { color: #1a1a1a; font-weight: 500; }

/* Prix */
.price-big { font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 700; color: #C8873A; line-height: 1; }
.price-sub { font-size: 13px; color: #888; margin-top: 4px; }
.prop-title-main { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px; }
.prop-loc { font-size: 13px; color: #888; display: flex; align-items: center; gap: 5px; margin-top: 8px; }

/* Description */
.description-text { font-size: 14px; color: #444; line-height: 1.8; }

/* Features */
.features-grid { display: flex; flex-wrap: wrap; gap: 8px; }
.feature-tag { background: #f5f2ee; border: 1px solid #ede9e3; border-radius: 20px; padding: 5px 12px; font-size: 12px; color: #555; }

/* Agent */
.agent-card { display: flex; align-items: center; gap: 14px; }
.agent-avatar { width: 48px; height: 48px; border-radius: 10px; background: #1a1a1a; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: 600; flex-shrink: 0; }
.agent-name { font-size: 14px; font-weight: 600; color: #1a1a1a; }
.agent-phone { font-size: 12px; color: #888; margin-top: 2px; }
.msg-btn { display: block; text-align: center; margin-top: 12px; padding: 10px; border: 1.5px solid #e8e3db; border-radius: 8px; font-size: 13px; color: #555; text-decoration: none; transition: all 0.2s; cursor: pointer; }
.msg-btn:hover { border-color: #C8873A; color: #C8873A; }

/* Formulaire RDV */
.rdv-card { background: #1a1a1a; border-radius: 12px; padding: 24px; }
.rdv-title { font-size: 15px; font-weight: 600; color: #fff; margin-bottom: 16px; }
.rdv-input { width: 100%; padding: 11px 14px; background: #242424; border: 1.5px solid #333; border-radius: 8px; font-size: 13px; color: #fff; outline: none; transition: border-color 0.2s; margin-bottom: 10px; box-sizing: border-box; }
.rdv-input:focus { border-color: #C8873A; }
.rdv-input::placeholder { color: #555; }
.rdv-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
.rdv-btn { width: 100%; padding: 13px; background: #C8873A; color: #fff; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; margin-top: 4px; transition: background 0.2s; }
.rdv-btn:hover { background: #b5762e; }
.rdv-login { display: block; text-align: center; padding: 13px; border: 1.5px solid #333; border-radius: 8px; color: #aaa; font-size: 13px; text-decoration: none; transition: all 0.2s; }
.rdv-login:hover { border-color: #C8873A; color: #C8873A; }

/* Favoris flottant */
.fav-btn { position: absolute; top: 14px; right: 14px; z-index: 2; width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.9); border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 18px; transition: all 0.2s; }
.fav-btn:hover { background: #fff; transform: scale(1.1); }

/* Vues counter */
.views-chip { display: inline-flex; align-items: center; gap: 5px; font-size: 12px; color: #888; margin-top: 8px; }

@media(max-width: 900px) {
    .show-wrap { grid-template-columns: 1fr; }
    .show-right { position: static; }
}
@endsection

@section('content')
<div class="show-wrap">

    {{-- COLONNE GAUCHE --}}
    <div class="show-left">

        {{-- Breadcrumb --}}
        <div class="breadcrumb">
            <a href="{{ route('properties.index') }}">Biens</a>
            <span>/</span>
            <span style="color:#1a1a1a">{{ Str::limit($property->title, 50) }}</span>
        </div>

        {{-- Galerie --}}
        <div x-data="{ active: 0 }">
            <div class="gallery-main">
                @if($property->images->isNotEmpty())
                    @foreach($property->images as $i => $img)
                    <img src="{{ Storage::url($img->image_path) }}"
                         alt="{{ $property->title }}"
                         x-show="active === {{ $i }}"
                         style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
                    @endforeach
                @else
                    <div class="gallery-placeholder">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#999" stroke-width="1">
                            <path d="M3 21V9l9-7 9 7v12H3z"/><path d="M9 21v-6h6v6"/>
                        </svg>
                        <span>Aucune photo disponible</span>
                    </div>
                @endif

                {{-- Badges statut --}}
                <div class="gallery-badges">
                    <span class="badge {{ $property->status === 'available' ? 'badge-available' : 'badge-rented' }}">
                        {{ $property->status === 'available' ? '✓ Disponible' : '⊘ Loué' }}
                    </span>
                    @if($property->is_featured)
                        <span class="badge badge-featured">★ En vedette</span>
                    @endif
                    @if($property->target_audience !== 'all')
                        <span class="badge" style="background:#e0edff;color:#1a4a8a">
                            {{ $property->target_audience === 'student' ? '🎓 Étudiants' : '💼 Professionnels' }}
                        </span>
                    @endif
                </div>

                {{-- Favori --}}
                @auth
                <form method="POST" action="{{ route('favorites.toggle', $property) }}" style="position:absolute;top:14px;right:14px;z-index:2;">
                    @csrf
                    <button type="submit" class="fav-btn" title="Ajouter aux favoris">
                        {{ $property->isFavoritedBy(auth()->user()) ? '❤️' : '🤍' }}
                    </button>
                </form>
                @endauth
            </div>

            {{-- Miniatures --}}
            @if($property->images->count() > 1)
            <div class="gallery-thumbs">
                @foreach($property->images as $i => $img)
                <div class="gallery-thumb" :class="active === {{ $i }} ? 'active' : ''" @click="active = {{ $i }}">
                    <img src="{{ Storage::url($img->image_path) }}" alt="">
                </div>
                @endforeach
            </div>
            @endif
        </div>

        {{-- Titre + prix (mobile) --}}
        <div class="show-card" style="display:none" id="mobile-price">
            {{-- visible uniquement sur mobile via CSS --}}
        </div>

        {{-- Description --}}
        <div class="show-card">
            <div class="show-card-title">Description</div>
            <p class="description-text">{{ $property->description }}</p>
            <div class="views-chip">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                {{ $property->views_count }} vue(s)
            </div>
        </div>

        {{-- Caractéristiques --}}
        <div class="show-card">
            <div class="show-card-title">Détails</div>
            @foreach([
                ['Type',            ucfirst($property->type)],
                ['Surface',         $property->area ? $property->area.' m²' : '—'],
                ['Pièces',          $property->rooms   ?: '—'],
                ['Chambres',        $property->bedrooms ?: '—'],
                ['Salles de bain',  $property->bathrooms ?: '—'],
                ['Année construction', $property->year_built ?: '—'],
                ['Localisation',    $property->address.', '.$property->city.($property->postal_code ? ' '.$property->postal_code : '')],
            ] as [$k, $v])
            <div class="detail-row">
                <span class="key">{{ $k }}</span>
                <span class="val">{{ $v }}</span>
            </div>
            @endforeach
        </div>

        {{-- Équipements --}}
        @if(isset($property->features) && $property->features->count() > 0)
        <div class="show-card">
            <div class="show-card-title">Équipements</div>
            <div class="features-grid">
                @foreach($property->features as $feature)
                <span class="feature-tag">{{ ucfirst($feature->name) }}</span>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Vidéo --}}
        @if($property->video_url)
        <div class="show-card">
            <div class="show-card-title">Vidéo de présentation</div>
            <a href="{{ $property->video_url }}" target="_blank" rel="noopener"
               style="display:inline-flex;align-items:center;gap:8px;color:#C8873A;font-size:14px;text-decoration:none;">
                ▶ Voir la vidéo de présentation
            </a>
        </div>
        @endif

    </div>

    {{-- COLONNE DROITE --}}
    <div class="show-right">

        {{-- Prix & Titre --}}
        <div class="show-card">
            <div class="price-big">{{ number_format($property->price, 0, ',', ' ') }} MAD</div>
            <div class="price-sub">par mois</div>
            <div class="prop-title-main" style="margin-top:16px">{{ $property->title }}</div>
            <div class="prop-loc">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#C8873A" stroke-width="2"><path d="M12 2C8.7 2 6 4.7 6 8c0 5.3 6 14 6 14s6-8.7 6-14c0-3.3-2.7-6-6-6z"/><circle cx="12" cy="8" r="2"/></svg>
                {{ $property->address }}, {{ $property->city }}
                @if($property->postal_code) {{ $property->postal_code }} @endif
            </div>
        </div>

        {{-- Agent --}}
        <div class="show-card">
            <div class="show-card-title">Votre contact</div>
            <div class="agent-card">
                <div class="agent-avatar">{{ strtoupper(substr($property->user->name, 0, 2)) }}</div>
                <div>
                    <div class="agent-name">{{ $property->user->name }}</div>
                    @if($property->user->phone)
                    <div class="agent-phone">📞 {{ $property->user->phone }}</div>
                    @endif
                </div>
            </div>
            @auth
            @if(auth()->id() !== $property->user_id)
            <a href="{{ route('messages.show', $property->user) }}" class="msg-btn">
                💬 Envoyer un message
            </a>
            @endif
            @endauth
        </div>

        {{-- Formulaire RDV — tous les rôles "locataires" --}}
        @auth
            @if(auth()->user()->canRent() && auth()->id() !== $property->user_id && $property->status === 'available')
            <div class="rdv-card">
                <div class="rdv-title">📅 Demander une visite</div>
                <form method="POST" action="{{ route('appointments.store') }}">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                    <div class="rdv-row">
                        <input type="date" name="date" required
                               min="{{ now()->addDay()->format('Y-m-d') }}"
                               class="rdv-input" style="margin-bottom:0">
                        <input type="time" name="time" required
                               class="rdv-input" style="margin-bottom:0">
                    </div>
                    <textarea name="message" rows="2"
                              placeholder="Message optionnel pour l'agent..."
                              class="rdv-input" style="margin-top:10px;resize:none"></textarea>
                    <button type="submit" class="rdv-btn">Planifier la visite</button>
                </form>
            </div>
            @elseif(auth()->user()->isAgent() || auth()->user()->isAdmin())
            {{-- Agent/Admin : boutons de gestion --}}
            <div class="show-card" style="display:flex;flex-direction:column;gap:10px">
                <div class="show-card-title">Gestion</div>
                <a href="{{ route('properties.edit', $property) }}"
                   style="display:block;text-align:center;padding:11px;background:#1a1a1a;color:#fff;border-radius:8px;text-decoration:none;font-size:13px;font-weight:500;transition:background 0.2s"
                   onmouseover="this.style.background='#C8873A'" onmouseout="this.style.background='#1a1a1a'">
                    ✏️ Modifier cette annonce
                </a>
                <form method="POST" action="{{ route('properties.destroy', $property) }}">
                    @csrf @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Supprimer définitivement cette annonce ?')"
                            style="width:100%;padding:11px;border:1.5px solid #fca5a5;color:#f87171;border-radius:8px;background:transparent;font-size:13px;cursor:pointer;transition:all 0.2s"
                            onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='transparent'">
                        🗑 Supprimer l'annonce
                    </button>
                </form>
            </div>
            @endif
        @else
            <div class="rdv-card">
                <div class="rdv-title">Intéressé par ce bien ?</div>
                <p style="font-size:13px;color:#aaa;margin-bottom:16px">Connectez-vous pour demander une visite ou contacter l'agent.</p>
                <a href="{{ route('login') }}" class="rdv-login" style="display:block;text-align:center;padding:13px;border:1.5px solid #333;border-radius:8px;color:#aaa;font-size:13px;text-decoration:none;background:transparent">
                    Se connecter
                </a>
                <a href="{{ route('register') }}" class="rdv-btn" style="display:block;text-align:center;text-decoration:none;margin-top:8px;padding:13px;background:#C8873A;color:#fff;border-radius:8px;font-size:13px;font-weight:600">
                    Créer un compte gratuit
                </a>
            </div>
        @endauth

    </div>
</div>
@endsection

@push('scripts')
<script>
{{-- CORRECTION : route corrigée properties.views (avec s) --}}
fetch('{{ route('properties.views', $property) }}', {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
});
</script>
@endpush
