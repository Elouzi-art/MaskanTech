@extends('layouts.maskan')
@section('title', 'MaskanTech — Logements à louer')

@section('styles')
/* Layout */
.props-wrap { display: flex; min-height: calc(100vh - 73px); }

/* Sidebar */
.props-sidebar {
    width: 270px; min-width: 270px;
    border-right: 1px solid #ede9e3;
    padding: 32px 24px;
    position: sticky; top: 73px;
    height: calc(100vh - 73px);
    overflow-y: auto;
}
.sidebar-heading {
    font-family: 'Playfair Display', serif;
    font-size: 17px; font-weight: 700; color: #1a1a1a;
    margin-bottom: 24px; padding-bottom: 16px;
    border-bottom: 1px solid #ede9e3;
}
.filter-group { margin-bottom: 18px; }
.filter-label {
    display: block; font-size: 10px; color: #aaa;
    letter-spacing: 2px; text-transform: uppercase;
    font-weight: 500; margin-bottom: 7px;
}
.filter-group input,
.filter-group select {
    width: 100%; padding: 10px 12px;
    border: 1.5px solid #e8e3db; border-radius: 8px;
    font-size: 13px; font-family: 'DM Sans', sans-serif;
    color: #1a1a1a; outline: none; transition: border-color 0.2s;
    background: #fff; box-sizing: border-box;
}
.filter-group input:focus,
.filter-group select:focus { border-color: #C8873A; }
.price-row { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
.filter-btn {
    width: 100%; padding: 11px;
    background: #1a1a1a; color: #fff; border: none;
    border-radius: 8px; font-size: 13px; font-weight: 500;
    cursor: pointer; font-family: 'DM Sans', sans-serif;
    transition: background 0.2s; margin-top: 4px;
}
.filter-btn:hover { background: #C8873A; }
.reset-link {
    display: block; text-align: center; margin-top: 10px;
    font-size: 12px; color: #aaa; text-decoration: none; transition: color 0.2s;
}
.reset-link:hover { color: #C8873A; }

/* Main */
.props-main { flex: 1; padding: 32px 36px; }
.props-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 28px;
}
.props-title { font-family: 'Playfair Display', serif; font-size: 26px; font-weight: 700; color: #1a1a1a; }
.props-count { font-size: 13px; color: #888; margin-top: 4px; }
.publish-btn {
    padding: 11px 20px; background: #1a1a1a; color: #fff;
    border-radius: 8px; font-size: 13px; font-weight: 500;
    text-decoration: none; transition: background 0.2s; white-space: nowrap;
}
.publish-btn:hover { background: #C8873A; }

/* Grid */
.props-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
@media(max-width: 1200px) { .props-grid { grid-template-columns: repeat(2, 1fr); } }
@media(max-width: 900px)  { .props-sidebar { display: none; } .props-grid { grid-template-columns: 1fr 1fr; } }
@media(max-width: 640px)  { .props-grid { grid-template-columns: 1fr; } .props-main { padding: 20px 16px; } }

/* Card */
.prop-card {
    border-radius: 12px; overflow: hidden;
    border: 1px solid #ede9e3; background: #fff;
    transition: transform 0.25s, box-shadow 0.25s;
}
.prop-card:hover { transform: translateY(-4px); box-shadow: 0 14px 36px rgba(0,0,0,0.09); }
.prop-img { height: 195px; position: relative; background: #f5f2ee; }
.prop-img img { width: 100%; height: 100%; object-fit: cover; }
.prop-img-placeholder { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 6px; }
.prop-img-placeholder span { font-size: 11px; color: #bbb; }
.prop-badges { position: absolute; top: 10px; left: 10px; display: flex; gap: 5px; flex-wrap: wrap; }
.prop-badge { font-size: 10px; font-weight: 500; padding: 3px 9px; border-radius: 20px; }
.badge-available { background: #d1fae5; color: #065f46; }
.badge-rented    { background: #fed7aa; color: #9a3412; }
.badge-student   { background: #dbeafe; color: #1e40af; }
.badge-pro       { background: #ede9fe; color: #5b21b6; }
.prop-fav { position: absolute; top: 10px; right: 10px; }
.prop-fav button {
    width: 34px; height: 34px; border-radius: 50%;
    background: rgba(255,255,255,0.92); border: none;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; font-size: 15px; transition: all 0.2s;
}
.prop-fav button:hover { transform: scale(1.1); background: #fff; }
.prop-body { padding: 16px 18px; }
.prop-price { font-family: 'Playfair Display', serif; font-size: 21px; font-weight: 700; color: #C8873A; }
.prop-price span { font-size: 12px; font-family: 'DM Sans', sans-serif; font-weight: 300; color: #aaa; }
.prop-title-card { font-size: 14px; font-weight: 500; color: #1a1a1a; margin: 6px 0 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.prop-loc-card { font-size: 12px; color: #999; margin-bottom: 12px; }
.prop-meta { display: flex; gap: 12px; margin-bottom: 14px; flex-wrap: wrap; }
.prop-meta span { font-size: 11px; color: #666; display: flex; align-items: center; gap: 3px; }
.prop-views { margin-left: auto; font-size: 11px; color: #bbb; }
.prop-cta {
    display: block; text-align: center; padding: 9px;
    background: #1a1a1a; color: #fff; border-radius: 8px;
    font-size: 12px; font-weight: 500; text-decoration: none;
    transition: background 0.2s;
}
.prop-cta:hover { background: #C8873A; }

/* Vide */
.empty-state {
    grid-column: 1/-1; text-align: center; padding: 64px 24px;
}
.empty-state p { font-size: 15px; color: #888; margin-bottom: 12px; }
.empty-state a { font-size: 13px; color: #C8873A; text-decoration: none; }
.empty-state a:hover { text-decoration: underline; }

/* Pagination */
.pagination { display: flex; justify-content: center; gap: 6px; margin-top: 32px; }
.pagination a, .pagination span {
    padding: 8px 14px; border-radius: 8px; font-size: 13px;
    border: 1.5px solid #e8e3db; text-decoration: none; color: #555; transition: all 0.2s;
}
.pagination a:hover { border-color: #C8873A; color: #C8873A; }
.pagination span.current { background: #1a1a1a; color: #fff; border-color: #1a1a1a; }
.pagination span.disabled { color: #ccc; cursor: default; }
@endsection

@section('content')
<div class="props-wrap">

    {{-- SIDEBAR FILTRES --}}
    <aside class="props-sidebar">
        <div class="sidebar-heading">Filtrer</div>

        <form method="GET" action="{{ route('properties.index') }}" id="filter-form">

            <div class="filter-group">
                <span class="filter-label">Mot-clé</span>
                <input type="text" name="q" value="{{ request('q') }}"
                       placeholder="Titre, ville, description...">
            </div>

            <div class="filter-group">
                <span class="filter-label">Type de bien</span>
                <select name="type">
                    <option value="">Tous les types</option>
                    @foreach(['house' => 'Maison', 'apartment' => 'Appartement', 'land' => 'Terrain', 'office' => 'Bureau'] as $val => $lbl)
                    <option value="{{ $val }}" {{ request('type') === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <span class="filter-label">Ville</span>
                <input type="text" name="city" value="{{ request('city') }}"
                       placeholder="Casablanca, Marrakech...">
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
                    @foreach([1,2,3,4,5] as $n)
                    <option value="{{ $n }}" {{ request('bedrooms') == $n ? 'selected' : '' }}>{{ $n }}+</option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <span class="filter-label">Statut</span>
                <select name="status">
                    <option value="">Tous</option>
                    <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>Disponible</option>
                    <option value="rented"    {{ request('status') === 'rented'    ? 'selected' : '' }}>Loué</option>
                </select>
            </div>

            @if(auth()->user()?->isAdmin() || auth()->user()?->isAgent())
            <div class="filter-group">
                <span class="filter-label">Audience cible</span>
                <select name="audience">
                    <option value="">Toutes</option>
                    <option value="all"          {{ request('audience') === 'all'          ? 'selected' : '' }}>Tout le monde</option>
                    <option value="student"      {{ request('audience') === 'student'      ? 'selected' : '' }}>Étudiants</option>
                    <option value="professional" {{ request('audience') === 'professional' ? 'selected' : '' }}>Professionnels</option>
                </select>
            </div>
            @endif

            <div class="filter-group">
                <span class="filter-label">Trier par</span>
                <select name="sort">
                    <option value="latest"     {{ request('sort') === 'latest'     ? 'selected' : '' }}>Plus récents</option>
                    <option value="price_asc"  {{ request('sort') === 'price_asc'  ? 'selected' : '' }}>Prix croissant</option>
                    <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                    <option value="area_desc"  {{ request('sort') === 'area_desc'  ? 'selected' : '' }}>Surface</option>
                </select>
            </div>

            <button type="submit" class="filter-btn">Appliquer les filtres</button>
            <a href="{{ route('properties.index') }}" class="reset-link">Réinitialiser les filtres</a>
        </form>
    </aside>

    {{-- MAIN --}}
    <main class="props-main">
        <div class="props-header">
            <div>
                <div class="props-title">Logements à louer</div>
                <div class="props-count">{{ $properties->total() }} annonce(s) trouvée(s)</div>
            </div>
            @can('create', \App\Models\Property::class)
            <a href="{{ route('properties.create') }}" class="publish-btn">+ Publier une annonce</a>
            @endcan
        </div>

        <div class="props-grid">
            @forelse($properties as $property)
            <div class="prop-card">

                {{-- Image --}}
                <div class="prop-img">
                    @if($property->primaryImage)
                        <img src="{{ Storage::url($property->primaryImage->image_path) }}"
                             alt="{{ $property->title }}">
                    @else
                        <div class="prop-img-placeholder">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1"><path d="M3 21V9l9-7 9 7v12H3z"/><path d="M9 21v-6h6v6"/></svg>
                            <span>Aucune photo</span>
                        </div>
                    @endif

                    <div class="prop-badges">
                        <span class="prop-badge {{ $property->status === 'available' ? 'badge-available' : 'badge-rented' }}">
                            {{ $property->status === 'available' ? 'Disponible' : 'Loué' }}
                        </span>
                        @if($property->target_audience === 'student')
                            <span class="prop-badge badge-student">🎓 Étudiant</span>
                        @elseif($property->target_audience === 'professional')
                            <span class="prop-badge badge-pro">💼 Pro</span>
                        @endif
                    </div>

                    @auth
                    <div class="prop-fav">
                        <form method="POST" action="{{ route('favorites.toggle', $property) }}">
                            @csrf
                            <button type="submit" title="Favori">
                                {{ $property->isFavoritedBy(auth()->user()) ? '❤️' : '🤍' }}
                            </button>
                        </form>
                    </div>
                    @endauth
                </div>

                {{-- Body --}}
                <div class="prop-body">
                    <div class="prop-price">
                        {{ number_format($property->price, 0, ',', ' ') }} MAD
                        <span>/ mois</span>
                    </div>
                    <div class="prop-title-card">{{ $property->title }}</div>
                    <div class="prop-loc-card">📍 {{ $property->city }}</div>
                    <div class="prop-meta">
                        @if($property->bedrooms)
                            <span>🛏 {{ $property->bedrooms }} ch.</span>
                        @endif
                        @if($property->bathrooms)
                            <span>🚿 {{ $property->bathrooms }} sdb.</span>
                        @endif
                        @if($property->area)
                            <span>📐 {{ $property->area }} m²</span>
                        @endif
                        <span class="prop-views">👁 {{ $property->views_count }}</span>
                    </div>
                    <a href="{{ route('properties.show', $property) }}" class="prop-cta">
                        Voir l'annonce →
                    </a>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <p>Aucun logement trouvé avec ces critères.</p>
                <a href="{{ route('properties.index') }}">Réinitialiser les filtres</a>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($properties->hasPages())
        <div class="pagination">
            @if($properties->onFirstPage())
                <span class="disabled">←</span>
            @else
                <a href="{{ $properties->previousPageUrl() }}">←</a>
            @endif

            @foreach($properties->getUrlRange(max(1, $properties->currentPage()-2), min($properties->lastPage(), $properties->currentPage()+2)) as $page => $url)
                @if($page == $properties->currentPage())
                    <span class="current">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach

            @if($properties->hasMorePages())
                <a href="{{ $properties->nextPageUrl() }}">→</a>
            @else
                <span class="disabled">→</span>
            @endif
        </div>
        @endif
    </main>
</div>
@endsection
