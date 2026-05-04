@extends('layouts.app')
@section('title', 'Biens immobiliers')

@section('sidebar')

    <x-sidebar-label label="Filtrer les biens" />

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

        {{-- Prix --}}
        <div>
            <label class="text-[9px] tracking-[.1em] text-dark-dim uppercase block mb-1">Prix (MAD)</label>
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

        {{-- Statut --}}
        <div>
            <label class="text-[9px] tracking-[.1em] text-dark-dim uppercase block mb-1">Statut</label>
            <select name="status" class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                <option value="">Tous</option>
                @foreach(['available' => 'Disponible', 'sold' => 'Vendu', 'rented' => 'Loué'] as $val => $lbl)
                <option value="{{ $val }}" {{ request('status') === $val ? 'selected' : '' }}>{{ $lbl }}</option>
                @endforeach
            </select>
        </div>

        {{-- Tri --}}
        <div>
            <label class="text-[9px] tracking-[.1em] text-dark-dim uppercase block mb-1">Trier par</label>
            <select name="sort" class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                <option value="latest"     {{ request('sort') === 'latest'     ? 'selected' : '' }}>Plus récents</option>
                <option value="price_asc"  {{ request('sort') === 'price_asc'  ? 'selected' : '' }}>Prix croissant</option>
                <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
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
            <h1 class="text-base font-medium text-white tracking-wider">Biens immobiliers</h1>
            <p class="text-[10px] text-dark-muted tracking-wider mt-0.5">{{ $properties->total() }} résultats trouvés</p>
        </div>
        @can('create', App\Models\Property::class)
        <a href="{{ route('properties.create') }}"
           class="flex items-center gap-1.5 text-xs border border-indigo-700 text-indigo-400 hover:bg-indigo-950 px-3 py-1.5 rounded-sm transition-colors tracking-wider">
            <svg class="w-3 h-3" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 1v10M1 6h10"/></svg>
            PUBLIER
        </a>
        @endcan
    </div>

    {{-- Grille des biens --}}
    <div class="grid grid-cols-3 gap-2.5">
        @forelse($properties as $property)
        <div class="bg-dark-card2 border border-dark-border rounded-sm overflow-hidden group">
            {{-- Image --}}
            <div class="relative">
                @if($property->primaryImage)
                <img src="{{ Storage::url($property->primaryImage->image_path) }}"
                     class="w-full h-32 object-cover group-hover:opacity-90 transition-opacity">
                @else
                <div class="w-full h-32 bg-dark-card3 flex items-center justify-center">
                    <svg class="w-8 h-8 text-dark-dim" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                        <path d="M3 21V9l9-7 9 7v12H3z"/><path d="M9 21v-6h6v6"/>
                    </svg>
                </div>
                @endif
                <div class="absolute top-2 left-2">
                    <x-status-badge :status="$property->status" />
                </div>
                @auth
                <form method="POST" action="{{ route('favorites.toggle', $property) }}" class="absolute top-2 right-2">
                    @csrf
                    <button type="submit" class="w-6 h-6 bg-dark-card/80 border border-dark-border rounded-sm flex items-center justify-center hover:bg-dark-card transition-colors">
                        <svg class="w-3 h-3 {{ $property->isFavoritedBy(auth()->user()) ? 'text-red-400 fill-red-400' : 'text-dark-muted' }}"
                             viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M6 10l-4-4a2 2 0 012-3 2 2 0 014 1 2 2 0 014-1 2 2 0 012 3z"/>
                        </svg>
                    </button>
                </form>
                @endauth
            </div>

            {{-- Infos --}}
            <div class="p-2.5">
                <p class="text-[12px] text-dark-text font-medium truncate">{{ $property->title }}</p>
                <p class="text-[10px] text-dark-muted mt-0.5 flex items-center gap-1">
                    <svg class="w-2.5 h-2.5" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M6 1C4.3 1 3 2.3 3 4c0 2.5 3 7 3 7s3-4.5 3-7c0-1.7-1.3-3-3-3z"/><circle cx="6" cy="4" r="1"/>
                    </svg>
                    {{ $property->city }}
                </p>
                <p class="text-[13px] text-indigo-400 font-medium mt-1.5">
                    {{ number_format($property->price, 0, ',', ' ') }} MAD
                </p>
                <div class="flex items-center gap-3 mt-1.5 text-[10px] text-dark-dim">
                    @if($property->bedrooms)
                    <span>{{ $property->bedrooms }} ch.</span>
                    @endif
                    @if($property->area)
                    <span>{{ $property->area }} m²</span>
                    @endif
                    <span class="capitalize">{{ $property->type }}</span>
                </div>
                <a href="{{ route('properties.show', $property) }}"
                   class="block w-full text-center text-[10px] border border-dark-border hover:border-indigo-700 hover:text-indigo-400 text-dark-muted py-1.5 rounded-sm transition-colors mt-2.5 tracking-wider">
                    VOIR LE BIEN
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-3 bg-dark-card border border-dark-border rounded-sm p-12 text-center">
            <p class="text-dark-muted text-xs tracking-wider">Aucun bien correspond à vos critères</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-2">
        {{ $properties->withQueryString()->links('partials.pagination') }}
    </div>

</div>
@endsection
