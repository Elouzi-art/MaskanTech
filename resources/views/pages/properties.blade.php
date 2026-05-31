@extends('layouts.maskan')
@section('title', 'MaskanTech — Logements à louer')

@section('styles')
        .page-wrap { display: flex; min-height: calc(100vh - 73px); }

        /* SIDEBAR FILTRES */
        .sidebar {
            width: 280px; min-width: 280px;
            border-right: 1px solid #f0ede8;
            padding: 32px 28px;
            position: sticky; top: 73px;
            height: calc(100vh - 73px);
            overflow-y: auto;
        }
        .sidebar-title {
            font-family: 'Playfair Display', serif;
            font-size: 18px; font-weight: 700; color: #1a1a1a;
            margin-bottom: 24px;
        }
        .filter-group { margin-bottom: 24px; }
        .filter-label {
            font-size: 11px; color: #888; letter-spacing: 2px;
            text-transform: uppercase; font-weight: 500; margin-bottom: 10px; display: block;
        }
        .filter-group input, .filter-group select {
            width: 100%; padding: 11px 14px;
            border: 1.5px solid #e8e3db; border-radius: 8px;
            font-size: 13px; font-family: 'DM Sans', sans-serif;
            color: #1a1a1a; outline: none; transition: border-color 0.2s;
        }
        .filter-group input:focus, .filter-group select:focus { border-color: #C8873A; }
        .price-row { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
        .filter-btn {
            width: 100%; padding: 12px;
            background: #1a1a1a; color: #fff; border: none;
            border-radius: 8px; font-size: 13px; font-weight: 500;
            cursor: pointer; font-family: 'DM Sans', sans-serif;
            transition: background 0.2s; margin-top: 8px;
        }
        .filter-btn:hover { background: #C8873A; }
        .reset-btn {
            width: 100%; padding: 10px;
            background: transparent; color: #888; border: 1.5px solid #e8e3db;
            border-radius: 8px; font-size: 13px; cursor: pointer;
            font-family: 'DM Sans', sans-serif; transition: all 0.2s; margin-top: 8px;
        }
        .reset-btn:hover { border-color: #C8873A; color: #C8873A; }

        /* MAIN */
        .main { flex: 1; padding: 32px 40px; }
        .main-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 28px;
        }
        .main-title { font-family: 'Playfair Display', serif; font-size: 26px; font-weight: 700; color: #1a1a1a; }
        .main-count { font-size: 14px; color: #888; margin-top: 4px; }

        /* GRID */
        .properties-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }

        /* PROPERTY CARD */
        .prop-card {
            border-radius: 12px; overflow: hidden;
            border: 1px solid #ede9e3;
            transition: transform 0.25s, box-shadow 0.25s;
            background: #fff;
        }
        .prop-card:hover { transform: translateY(-5px); box-shadow: 0 16px 40px rgba(0,0,0,0.1); }
        .prop-img {
            height: 200px; background-size: cover; background-position: center;
            position: relative; background-color: #f0ede8;
        }
        .prop-badges { position: absolute; top: 12px; left: 12px; display: flex; gap: 6px; flex-wrap: wrap; }
        .prop-badge {
            font-size: 11px; font-weight: 500; padding: 4px 10px;
            border-radius: 20px; background: #fff; color: #1a1a1a;
        }
        .prop-badge-student { background: #185FA5; color: #fff; }
        .prop-badge-gold { background: #C8873A; color: #fff; }
        .prop-favorite {
            position: absolute; top: 12px; right: 12px;
            width: 34px; height: 34px; border-radius: 50%;
            background: rgba(255,255,255,0.9); border: none;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 16px; transition: all 0.2s;
        }
        .prop-favorite:hover { background: #fff; transform: scale(1.1); }
        .prop-body { padding: 18px 20px; }
        .prop-price { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: #C8873A; }
        .prop-price span { font-size: 13px; font-family: 'DM Sans', sans-serif; font-weight: 300; color: #999; }
        .prop-title { font-size: 15px; font-weight: 500; color: #1a1a1a; margin: 6px 0 4px; }
        .prop-loc { font-size: 13px; color: #999; margin-bottom: 12px; }
        .prop-details { display: flex; gap: 16px; margin-bottom: 16px; flex-wrap: wrap; }
        .prop-detail { font-size: 12px; color: #666; display: flex; align-items: center; gap: 4px; }
        .prop-actions { display: flex; gap: 8px; }
        .prop-btn-primary {
            flex: 1; padding: 10px; background: #1a1a1a; color: #fff;
            border: none; border-radius: 7px; font-size: 13px; font-weight: 500;
            cursor: pointer; font-family: 'DM Sans', sans-serif;
            transition: background 0.2s; text-decoration: none; text-align: center;
        }
        .prop-btn-primary:hover { background: #C8873A; }
        .prop-btn-outline {
            padding: 10px 14px; border: 1.5px solid #e8e3db; color: #555;
            border-radius: 7px; font-size: 13px; cursor: pointer;
            background: transparent; font-family: 'DM Sans', sans-serif;
            transition: all 0.2s;
        }
        .prop-btn-outline:hover { border-color: #C8873A; color: #C8873A; }

        /* EMPTY */
        .empty-state {
            text-align: center; padding: 80px 20px; color: #888;
        }
        .empty-icon { font-size: 64px; margin-bottom: 16px; }
        .empty-text { font-size: 16px; margin-bottom: 8px; color: #1a1a1a; }
        .empty-sub { font-size: 14px; margin-bottom: 24px; }

        /* PAGINATION */
        .pagination-wrap { margin-top: 40px; display: flex; justify-content: center; gap: 8px; }
@endsection

@section('content')
<div class="page-wrap">

    {{-- SIDEBAR FILTRES --}}
    <div class="sidebar">
        <div class="sidebar-title">Filtrer</div>

        <form method="GET" action="{{ route('properties.index') }}">

            @auth
                @if(auth()->user()->role === 'student')
                <div class="filter-group">
                    <label class="filter-label">
                        <input type="checkbox" name="audience" value="student"
                            {{ request('audience') === 'student' ? 'checked' : '' }}>
                        Annonces étudiants uniquement
                    </label>
                </div>
                @endif
            @endauth

            <div class="filter-group">
                <span class="filter-label">Mot-clé</span>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Titre, ville...">
            </div>

            <div class="filter-group">
                <span class="filter-label">Type de bien</span>
                <select name="type">
                    <option value="">Tous les types</option>
                    <option value="apartment" {{ request('type') === 'apartment' ? 'selected' : '' }}>Appartement</option>
                    <option value="house" {{ request('type') === 'house' ? 'selected' : '' }}>Maison</option>
                    <option value="studio" {{ request('type') === 'studio' ? 'selected' : '' }}>Studio</option>
                    <option value="room" {{ request('type') === 'room' ? 'selected' : '' }}>Chambre</option>
                    <option value="colocation" {{ request('type') === 'colocation' ? 'selected' : '' }}>Colocation</option>
                </select>
            </div>

            <div class="filter-group">
                <span class="filter-label">Ville</span>
                <input type="text" name="city" value="{{ request('city') }}" placeholder="Casablanca, Marrakech...">
            </div>

            <div class="filter-group">
                <span class="filter-label">Loyer / mois (MAD)</span>
                <div class="price-row">
                    <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Min">
                    <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Max">
                </div>
            </div>

            <div class="filter-group">
                <span class="filter-label">Chambres min.</span>
                <select name="bedrooms">
                    <option value="">Peu importe</option>
                    <option value="1" {{ request('bedrooms') == 1 ? 'selected' : '' }}>1+</option>
                    <option value="2" {{ request('bedrooms') == 2 ? 'selected' : '' }}>2+</option>
                    <option value="3" {{ request('bedrooms') == 3 ? 'selected' : '' }}>3+</option>
                    <option value="4" {{ request('bedrooms') == 4 ? 'selected' : '' }}>4+</option>
                </select>
            </div>

            <button type="submit" class="filter-btn">Appliquer les filtres</button>
            <a href="{{ route('properties.index') }}" class="reset-btn" style="display:block;text-align:center;text-decoration:none;margin-top:8px;">Réinitialiser</a>
        </form>
    </div>

    {{-- MAIN --}}
    <div class="main">
        <div class="main-header">
            <div>
                <div class="main-title">Logements à louer</div>
                <div class="main-count">{{ $properties->total() }} annonce(s) trouvée(s)</div>
            </div>
            <form method="GET" action="{{ route('properties.index') }}">
                @foreach(request()->except('sort') as $key => $val)
                    <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                @endforeach
                <select name="sort" class="sort-select" onchange="this.form.submit()">
                    <option value="" {{ !request('sort') ? 'selected' : '' }}>Plus récents</option>
                    <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                    <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                </select>
            </form>
        </div>

        {{-- GRILLE DES ANNONCES --}}
        @if($properties->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">🏠</div>
                <div class="empty-text">Aucune annonce trouvée</div>
                <div class="empty-sub">Essayez de modifier vos filtres</div>
                <a href="{{ route('properties.index') }}" class="mk-btn-gold">Voir toutes les annonces</a>
            </div>
        @else
            <div class="properties-grid">
                @foreach($properties as $property)
                <div class="prop-card">

                    {{-- IMAGE --}}
                    <div class="prop-img" style="
                        @if($property->primaryImage)
                            background-image: url('{{ Storage::url($property->primaryImage->image_path) }}')
                        @else
                            background-color: #f0ede8;
                        @endif
                    ">
                        <div class="prop-badges">
                            <span class="prop-badge">{{ ucfirst($property->type) }}</span>
                            @if($property->audience === 'student')
                                <span class="prop-badge prop-badge-student">🎓 Étudiant</span>
                            @endif
                            @if($property->status === 'rented')
                                <span class="prop-badge prop-badge-gold">Loué</span>
                            @endif
                        </div>

                        {{-- BOUTON FAVORI --}}
                        @auth
                            <form action="{{ route('favorites.toggle', $property) }}" method="POST" style="position:absolute;top:12px;right:12px;">
                                @csrf
                                <button type="submit" class="prop-favorite">
                                    {{ $property->favoritedBy->contains(auth()->id()) ? '❤️' : '🤍' }}
                                </button>
                            </form>
                        @endauth
                    </div>

                    {{-- BODY --}}
                    <div class="prop-body">
                        <div class="prop-price">
                            {{ number_format($property->price, 0, ',', ' ') }} MAD
                            <span>/ mois</span>
                        </div>
                        <div class="prop-title">{{ $property->title }}</div>
                        <div class="prop-loc">📍 {{ $property->city }} @if($property->area) · {{ $property->area }}m²@endif</div>
                        <div class="prop-details">
                            @if($property->bedrooms)
                                <span class="prop-detail">🛏 {{ $property->bedrooms }} chambre(s)</span>
                            @endif
                            @if($property->bathrooms)
                                <span class="prop-detail">🚿 {{ $property->bathrooms }} sdb</span>
                            @endif
                        </div>
                        <div class="prop-actions">
                            <a href="{{ route('properties.show', $property) }}" class="prop-btn-primary">Voir le détail</a>
                            @auth
                                <button class="prop-btn-outline" onclick="window.location='{{ route('messages.show', $property->user) }}'">
                                    💬
                                </button>
                            @endauth
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- PAGINATION --}}
            <div class="pagination-wrap">
                {{ $properties->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection