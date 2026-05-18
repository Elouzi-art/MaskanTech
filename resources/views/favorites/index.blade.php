@extends('layouts.maskan')
@section('title', 'MaskanTech — Mes favoris')

@section('styles')
.fav-wrap { max-width: 1100px; margin: 0 auto; padding: 40px 24px; }
.fav-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; }
.fav-title { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; color: #1a1a1a; }
.fav-count { font-size: 14px; color: #888; margin-top: 4px; }
.fav-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
@media(max-width:1000px) { .fav-grid { grid-template-columns: repeat(2, 1fr); } }
@media(max-width:640px)  { .fav-grid { grid-template-columns: 1fr; } .fav-wrap { padding: 24px 16px; } }

/* Card */
.fav-card { border-radius: 12px; overflow: hidden; border: 1px solid #ede9e3; background: #fff; transition: transform 0.25s, box-shadow 0.25s; }
.fav-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(0,0,0,0.09); }
.fav-img { height: 190px; position: relative; background: #f5f2ee; overflow: hidden; }
.fav-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
.fav-card:hover .fav-img img { transform: scale(1.04); }
.fav-img-placeholder { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 6px; }
.fav-img-placeholder span { font-size: 12px; color: #bbb; }
.fav-badge { position: absolute; top: 10px; left: 10px; font-size: 11px; font-weight: 500; padding: 3px 9px; border-radius: 20px; }
.badge-available { background: #d1fae5; color: #065f46; }
.badge-rented    { background: #fed7aa; color: #9a3412; }

/* Bouton retirer favori */
.fav-remove { position: absolute; top: 10px; right: 10px; width: 32px; height: 32px; border-radius: 50%; background: rgba(255,255,255,0.92); border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 14px; transition: all 0.2s; }
.fav-remove:hover { background: #fff; transform: scale(1.1); }

.fav-body { padding: 16px 18px; }
.fav-price { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; color: #C8873A; }
.fav-price span { font-size: 12px; font-family: 'DM Sans', sans-serif; font-weight: 300; color: #aaa; }
.fav-title-card { font-size: 14px; font-weight: 500; color: #1a1a1a; margin: 6px 0 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.fav-loc { font-size: 12px; color: #999; margin-bottom: 12px; }
.fav-meta { display: flex; gap: 10px; margin-bottom: 14px; flex-wrap: wrap; }
.fav-meta span { font-size: 11px; color: #666; }
.fav-cta { display: block; text-align: center; padding: 9px; background: #1a1a1a; color: #fff; border-radius: 8px; font-size: 12px; font-weight: 500; text-decoration: none; transition: background 0.2s; }
.fav-cta:hover { background: #C8873A; }

/* Vide */
.fav-empty { text-align: center; padding: 72px 24px; }
.fav-empty-icon { font-size: 56px; margin-bottom: 16px; }
.fav-empty-title { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: #1a1a1a; margin-bottom: 8px; }
.fav-empty p { font-size: 14px; color: #888; margin-bottom: 24px; }
.fav-empty a { display: inline-block; padding: 12px 28px; background: #1a1a1a; color: #fff; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; transition: background 0.2s; }
.fav-empty a:hover { background: #C8873A; }

/* Pagination */
.pagination { display: flex; justify-content: center; gap: 6px; margin-top: 36px; }
.pagination a, .pagination span { padding: 8px 14px; border-radius: 8px; font-size: 13px; border: 1.5px solid #e8e3db; text-decoration: none; color: #555; transition: all 0.2s; }
.pagination a:hover { border-color: #C8873A; color: #C8873A; }
.pagination span.current { background: #1a1a1a; color: #fff; border-color: #1a1a1a; }
.pagination span.disabled { color: #ccc; }
@endsection

@section('content')
<div class="fav-wrap">

    <div class="fav-header">
        <div>
            <div class="fav-title">❤️ Mes favoris</div>
            <div class="fav-count">{{ $favorites->total() }} bien(s) sauvegardé(s)</div>
        </div>
        <a href="{{ route('properties.index') }}"
           style="padding:10px 20px;border:1.5px solid #e8e3db;border-radius:8px;font-size:13px;color:#555;text-decoration:none;transition:all 0.2s"
           onmouseover="this.style.borderColor='#C8873A';this.style.color='#C8873A'"
           onmouseout="this.style.borderColor='#e8e3db';this.style.color='#555'">
            ← Retour aux biens
        </a>
    </div>

    @if($favorites->isEmpty())
    <div class="fav-empty">
        <div class="fav-empty-icon">🏠</div>
        <div class="fav-empty-title">Aucun favori pour l'instant</div>
        <p>Explorez nos annonces et sauvegardez celles qui vous intéressent.</p>
        <a href="{{ route('properties.index') }}">Parcourir les logements</a>
    </div>
    @else
    <div class="fav-grid">
        @foreach($favorites as $property)
        <div class="fav-card">

            {{-- Image --}}
            <div class="fav-img">
                @if($property->primaryImage)
                    <img src="{{ Storage::url($property->primaryImage->image_path) }}" alt="{{ $property->title }}">
                @else
                    <div class="fav-img-placeholder">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1"><path d="M3 21V9l9-7 9 7v12H3z"/><path d="M9 21v-6h6v6"/></svg>
                        <span>Aucune photo</span>
                    </div>
                @endif

                <span class="fav-badge {{ $property->status === 'available' ? 'badge-available' : 'badge-rented' }}">
                    {{ $property->status === 'available' ? 'Disponible' : 'Loué' }}
                </span>

                {{-- Retirer des favoris --}}
                <form method="POST" action="{{ route('favorites.toggle', $property) }}" style="position:absolute;top:10px;right:10px">
                    @csrf
                    <button type="submit" class="fav-remove" title="Retirer des favoris">💔</button>
                </form>
            </div>

            {{-- Corps --}}
            <div class="fav-body">
                <div class="fav-price">
                    {{ number_format($property->price, 0, ',', ' ') }} MAD
                    <span>/ mois</span>
                </div>
                <div class="fav-title-card">{{ $property->title }}</div>
                <div class="fav-loc">📍 {{ $property->city }}</div>
                <div class="fav-meta">
                    @if($property->bedrooms) <span>🛏 {{ $property->bedrooms }} ch.</span> @endif
                    @if($property->bathrooms) <span>🚿 {{ $property->bathrooms }} sdb.</span> @endif
                    @if($property->area) <span>📐 {{ $property->area }} m²</span> @endif
                </div>
                <a href="{{ route('properties.show', $property) }}" class="fav-cta">Voir l'annonce →</a>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($favorites->hasPages())
    <div class="pagination">
        @if($favorites->onFirstPage())
            <span class="disabled">←</span>
        @else
            <a href="{{ $favorites->previousPageUrl() }}">←</a>
        @endif

        @foreach($favorites->getUrlRange(max(1,$favorites->currentPage()-2), min($favorites->lastPage(),$favorites->currentPage()+2)) as $page => $url)
            @if($page == $favorites->currentPage())
                <span class="current">{{ $page }}</span>
            @else
                <a href="{{ $url }}">{{ $page }}</a>
            @endif
        @endforeach

        @if($favorites->hasMorePages())
            <a href="{{ $favorites->nextPageUrl() }}">→</a>
        @else
            <span class="disabled">→</span>
        @endif
    </div>
    @endif
    @endif

</div>
@endsection
