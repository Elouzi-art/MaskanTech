@extends('layouts.app')
@section('title', 'Logements à louer')

@section('sidebar')

    <x-sidebar-label label="Filtrer les logements" />

    <form method="GET" action="{{ route('properties.index') }}" class="flex flex-col gap-3" id="filter-form">

        {{-- Recherche --}}
        <div>
            <label class="text-[9px] tracking-[.1em] text-dark-dim uppercase block mb-1">Mot-clé</label>
            <input type="text" name="q" value="{{ request('q') }}"
                   placeholder="Titre, ville, description..."
                   class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm placeholder-dark-dim focus:outline-none focus:border-indigo-700 font-mono">
        </div>

        {{-- Type de bien --}}
        <div>
            <label class="text-[9px] tracking-[.1em] text-dark-dim uppercase block mb-1">Type</label>
            <select name="type" class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                <option value="">Tous les types</option>
                @foreach(['house' => 'Maison', 'apartment' => 'Appartement', 'land' => 'Terrain', 'office' => 'Bureau'] as $val => $lbl)
                <option value="{{ $val }}" {{ request('type') === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                @endforeach
            </select>
        </div>

        {{-- Ville --}}
        <div>
            <label class="text-[9px] tracking-[.1em] text-dark-dim uppercase block mb-1">Ville</label>
            <input type="text" name="city" value="{{ request('city') }}"
                   placeholder="Casablanca, Marrakech..."
                   class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm placeholder-dark-dim focus:outline-none focus:border-indigo-700 font-mono">
        </div>

        {{-- Prix loyer --}}
        <div>
            <label class="text-[9px] tracking-[.1em] text-dark-dim uppercase block mb-1">Loyer/mois (MAD)</label>
            <div class="flex gap-1.5">
                <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Min"
                       class="w-1/2 bg-dark-card3 border border-dark-border text-dark-text text-xs px-2 py-2 rounded-sm placeholder-dark-dim focus:outline-none focus:border-indigo-700 font-mono">
                <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Max"
                       class="w-1/2 bg-dark-card3 border border-dark-border text-dark-text text-xs px-2 py-2 rounded-sm placeholder-dark-dim focus:outline-none focus:border-indigo-700 font-mono">
            </div>
        </div>

        {{-- Chambres --}}
        <div>
            <label class="text-[9px] tracking-[.1em] text-dark-dim uppercase block mb-1">Chambres min.</label>
            <select name="bedrooms" class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                <option value="">Peu importe</option>
                @foreach([1,2,3,4,5] as $n)
                <option value="{{ $n }}" {{ request('bedrooms') == $n ? 'selected' : '' }}>{{ $n }}+</option>
                @endforeach
            </select>
        </div>

        {{-- Statut (location only) --}}
        <div>
            <label class="text-[9px] tracking-[.1em] text-dark-dim uppercase block mb-1">Statut</label>
            <select name="status" class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                <option value="">Tous</option>
                <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>Disponible</option>
                <option value="rented"    {{ request('status') === 'rented'    ? 'selected' : '' }}>Loué</option>
            </select>
        </div>

        {{-- Audience (visible uniquement aux agents/admin) --}}
        @if(auth()->user()?->isAdmin() || auth()->user()?->isAgent())
        <div>
            <label class="text-[9px] tracking-[.1em] text-dark-dim uppercase block mb-1">Audience cible</label>
            <select name="audience" class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                <option value="">Toutes</option>
                <option value="all"          {{ request('audience') === 'all'          ? 'selected' : '' }}>Tout le monde</option>
                <option value="student"      {{ request('audience') === 'student'      ? 'selected' : '' }}>Étudiants</option>
                <option value="professional" {{ request('audience') === 'professional' ? 'selected' : '' }}>Professionnels</option>
            </select>
        </div>
        @endif

        {{-- Tri --}}
        <div>
            <label class="text-[9px] tracking-[.1em] text-dark-dim uppercase block mb-1">Trier par</label>
            <select name="sort" class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                <option value="latest"     {{ request('sort') === 'latest'     ? 'selected' : '' }}>Plus récents</option>
                <option value="price_asc"  {{ request('sort') === 'price_asc'  ? 'selected' : '' }}>Loyer croissant</option>
                <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Loyer décroissant</option>
                <option value="area_desc"  {{ request('sort') === 'area_desc'  ? 'selected' : '' }}>Surface</option>
            </select>
        </div>

        <button type="submit"
                class="w-full text-xs border border-indigo-700 text-indigo-400 hover:bg-indigo-950 py-2 rounded-sm transition-colors tracking-widest font-mono">
            FILTRER
        </button>
        <a href="{{ route('properties.index') }}"
           class="text-center text-[10px] text-dark-muted hover:text-dark-text transition-colors tracking-wider">
            Réinitialiser
        </a>
    </form>

@endsection

@section('content')
<div class="p-3 flex flex-col gap-3">

    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-base font-medium text-white tracking-wider">Logements à louer</h1>
            <p class="text-[10px] text-dark-muted tracking-wider mt-0.5">{{ $properties->total() }} annonce(s) trouvée(s)</p>
        </div>
        @can('create', \App\Models\Property::class)
        <a href="{{ route('properties.create') }}"
           class="text-xs border border-indigo-700 text-indigo-400 hover:bg-indigo-950 px-3 py-1.5 rounded-sm transition-colors tracking-wider font-mono">
            + PUBLIER
        </a>
        @endcan
    </div>

    @if($properties->isEmpty())
        <div class="bg-dark-card border border-dark-border rounded-sm p-8 text-center">
            <p class="text-dark-muted text-sm tracking-wider">Aucun logement trouvé.</p>
            <a href="{{ route('properties.index') }}" class="text-[10px] text-indigo-400 hover:text-indigo-300 mt-2 inline-block">Réinitialiser les filtres</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3">
            @foreach($properties as $property)
            <div class="bg-dark-card border border-dark-border rounded-sm overflow-hidden hover:border-dark-border2 transition-colors group">

                {{-- Image --}}
                <div class="relative h-40 bg-dark-card3 overflow-hidden">
                    @if($property->primaryImage)
                        <img src="{{ Storage::url($property->primaryImage->image_path) }}"
                             alt="{{ $property->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="text-dark-dim text-[10px] tracking-wider">AUCUNE IMAGE</span>
                        </div>
                    @endif

                    {{-- Statut badge --}}
                    <div class="absolute top-2 left-2">
                        <span class="text-[9px] tracking-wider px-2 py-0.5 rounded-sm font-mono
                            {{ $property->status === 'available' ? 'bg-green-950 text-green-400 border border-green-800' : 'bg-orange-950 text-orange-400 border border-orange-800' }}">
                            {{ $property->status === 'available' ? 'DISPONIBLE' : 'LOUÉ' }}
                        </span>
                    </div>

                    {{-- Badge audience --}}
                    @if(($property->target_audience ?? 'all') !== 'all')
                    <div class="absolute top-2 right-2">
                        <span class="text-[9px] tracking-wider px-2 py-0.5 rounded-sm font-mono
                            {{ $property->target_audience === 'student' ? 'bg-blue-950 text-blue-400 border border-blue-800' : 'bg-purple-950 text-purple-400 border border-purple-800' }}">
                            {{ $property->target_audience === 'student' ? 'ÉTUDIANT' : 'PRO' }}
                        </span>
                    </div>
                    @endif

                    {{-- Favori --}}
                    @auth
                    <form method="POST" action="{{ route('favorites.toggle', $property) }}" class="absolute bottom-2 right-2">
                        @csrf
                        <button type="submit"
                                class="w-7 h-7 bg-dark-card border border-dark-border rounded-sm flex items-center justify-center hover:border-red-700 transition-colors">
                            <svg class="w-3.5 h-3.5 {{ $property->isFavoritedBy(auth()->user()) ? 'text-red-400 fill-current' : 'text-dark-muted' }}"
                                 viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M6 10.5S1 7 1 3.5a2.5 2.5 0 015 0 2.5 2.5 0 015 0C11 7 6 10.5 6 10.5z"/>
                            </svg>
                        </button>
                    </form>
                    @endauth
                </div>

                {{-- Infos --}}
                <div class="p-3 flex flex-col gap-2">
                    <div>
                        <h3 class="text-xs text-white font-medium tracking-wide truncate">{{ $property->title }}</h3>
                        <p class="text-[10px] text-dark-muted tracking-wider mt-0.5">{{ $property->city }}</p>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-sm font-bold text-white tracking-wider">
                            {{ number_format($property->price, 0, ',', ' ') }} MAD
                            <span class="text-[10px] text-dark-muted font-normal">/mois</span>
                        </span>
                    </div>

                    <div class="flex gap-3 text-[10px] text-dark-muted tracking-wider border-t border-dark-border pt-2">
                        @if($property->bedrooms)
                            <span>{{ $property->bedrooms }} ch.</span>
                        @endif
                        @if($property->bathrooms)
                            <span>{{ $property->bathrooms }} sdb.</span>
                        @endif
                        @if($property->area)
                            <span>{{ $property->area }} m²</span>
                        @endif
                        <span class="ml-auto">{{ $property->views_count }} vues</span>
                    </div>

                    <a href="{{ route('properties.show', $property) }}"
                       class="text-center text-[10px] tracking-widest text-indigo-400 border border-indigo-900 hover:bg-indigo-950 py-1.5 rounded-sm transition-colors font-mono">
                        VOIR L'ANNONCE →
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($properties->hasPages())
        <div class="flex justify-center gap-1 pt-2">
            @if($properties->onFirstPage())
                <span class="px-3 py-1.5 text-[10px] text-dark-dim border border-dark-border rounded-sm">←</span>
            @else
                <a href="{{ $properties->previousPageUrl() }}" class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border rounded-sm hover:border-dark-border2 hover:text-dark-text transition-colors">←</a>
            @endif

            @foreach($properties->getUrlRange(max(1, $properties->currentPage()-2), min($properties->lastPage(), $properties->currentPage()+2)) as $page => $url)
                @if($page == $properties->currentPage())
                    <span class="px-3 py-1.5 text-[10px] text-white border border-indigo-700 bg-indigo-950 rounded-sm">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border rounded-sm hover:border-dark-border2 hover:text-dark-text transition-colors">{{ $page }}</a>
                @endif
            @endforeach

            @if($properties->hasMorePages())
                <a href="{{ $properties->nextPageUrl() }}" class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border rounded-sm hover:border-dark-border2 hover:text-dark-text transition-colors">→</a>
            @else
                <span class="px-3 py-1.5 text-[10px] text-dark-dim border border-dark-border rounded-sm">→</span>
            @endif
        </div>
        @endif
    @endif

</div>
@endsection
