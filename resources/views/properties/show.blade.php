@extends('layouts.app')
@section('title', $property->title)

@section('content')
<div class="p-4 max-w-5xl mx-auto flex flex-col gap-4">

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-[10px] text-dark-muted tracking-wider">
        <a href="{{ route('properties.index') }}" class="hover:text-dark-text transition-colors">BIENS</a>
        <span class="text-dark-dim">/</span>
        <span class="text-dark-text">{{ strtoupper(Str::limit($property->title, 40)) }}</span>
    </div>

    <div class="grid grid-cols-3 gap-4">

        {{-- Colonne gauche : galerie + infos --}}
        <div class="col-span-2 flex flex-col gap-3">

            {{-- Galerie --}}
            <div x-data="{ active: 0 }">
                {{-- Image principale --}}
                <div class="relative bg-dark-card border border-dark-border rounded-sm overflow-hidden" style="height: 320px;">
                    @foreach($property->images as $i => $img)
                    <img src="{{ Storage::url($img->image_path) }}"
                         x-show="active === {{ $i }}"
                         class="w-full h-full object-cover fade-in">
                    @endforeach
                    @if($property->images->isEmpty())
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-dark-dim" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.8">
                            <path d="M3 21V9l9-7 9 7v12H3z"/><path d="M9 21v-6h6v6"/>
                        </svg>
                    </div>
                    @endif
                    <div class="absolute top-3 left-3 flex gap-1.5">
                        <x-status-badge :status="$property->status" />
                        @if($property->is_featured)
                        <span class="bg-amber-950 text-amber-400 border border-amber-800 text-[9px] px-2 py-0.5 rounded-sm tracking-wider">EN VEDETTE</span>
                        @endif
                    </div>
                </div>
                {{-- Miniatures --}}
                @if($property->images->count() > 1)
                <div class="flex gap-1.5 mt-1.5 overflow-x-auto">
                    @foreach($property->images as $i => $img)
                    <button @click="active = {{ $i }}"
                            :class="active === {{ $i }} ? 'border-indigo-600' : 'border-dark-border'"
                            class="w-16 h-11 rounded-sm border overflow-hidden shrink-0 transition-colors">
                        <img src="{{ Storage::url($img->image_path) }}" class="w-full h-full object-cover">
                    </button>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- Description --}}
            <div class="bg-dark-card border border-dark-border rounded-sm p-4">
                <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase mb-2">Description</div>
                <p class="text-sm text-dark-text leading-relaxed">{{ $property->description }}</p>
            </div>

            {{-- Caractéristiques --}}
            @if($property->features->count() > 0)
            <div class="bg-dark-card border border-dark-border rounded-sm p-4">
                <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase mb-3">Équipements</div>
                <div class="flex flex-wrap gap-2">
                    @foreach($property->features as $feature)
                    <span class="bg-dark-card3 border border-dark-border text-[10px] text-dark-muted px-2.5 py-1 rounded-sm tracking-wider">
                        {{ ucfirst($feature->name) }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Vidéo --}}
            @if($property->video_url)
            <div class="bg-dark-card border border-dark-border rounded-sm p-4">
                <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase mb-2">Vidéo de présentation</div>
                <a href="{{ $property->video_url }}" target="_blank"
                   class="text-indigo-400 text-xs hover:underline flex items-center gap-1.5">
                    <svg class="w-3 h-3" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5">
                        <polygon points="3,1 11,6 3,11"/>
                    </svg>
                    Voir la vidéo
                </a>
            </div>
            @endif

        </div>

        {{-- Colonne droite : prix + détails + RDV --}}
        <div class="flex flex-col gap-3">

            {{-- Prix & titre --}}
            <div class="bg-dark-card border border-dark-border rounded-sm p-4">
                <h1 class="text-sm font-medium text-white tracking-wide leading-snug">{{ $property->title }}</h1>
                <p class="text-2xl text-indigo-400 font-bold mt-2">{{ number_format($property->price, 0, ',', ' ') }} MAD</p>
                <p class="text-[10px] text-dark-muted mt-1 flex items-center gap-1">
                    <svg class="w-2.5 h-2.5" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M6 1C4.3 1 3 2.3 3 4c0 2.5 3 7 3 7s3-4.5 3-7c0-1.7-1.3-3-3-3z"/>
                    </svg>
                    {{ $property->address }}, {{ $property->city }} {{ $property->postal_code }}
                </p>
            </div>

            {{-- Détails techniques --}}
            <div class="bg-dark-card border border-dark-border rounded-sm p-4">
                <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase mb-3">Détails</div>
                @foreach([
                    ['Type',           ucfirst($property->type)],
                    ['Surface',        $property->area ? $property->area.' m²' : '—'],
                    ['Pièces',         $property->rooms ?: '—'],
                    ['Chambres',       $property->bedrooms ?: '—'],
                    ['Salles de bain', $property->bathrooms ?: '—'],
                    ['Année',          $property->year_built ?: '—'],
                    ['Statut',         ucfirst($property->status)],
                    ['Vues',           $property->views_count],
                ] as [$k, $v])
                <div class="flex justify-between py-1.5 border-b border-dark-border/40 last:border-0 text-xs">
                    <span class="text-dark-muted">{{ $k }}</span>
                    <span class="text-dark-text">{{ $v }}</span>
                </div>
                @endforeach
            </div>

            {{-- Agent --}}
            <div class="bg-dark-card border border-dark-border rounded-sm p-4">
                <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase mb-3">Agent</div>
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-sm bg-dark-card3 border border-dark-border flex items-center justify-center text-xs text-white font-medium">
                        {{ strtoupper(substr($property->user->name, 0, 2)) }}
                    </div>
                    <div>
                        <p class="text-xs text-dark-text">{{ $property->user->name }}</p>
                        @if($property->user->phone)
                        <p class="text-[10px] text-dark-muted">{{ $property->user->phone }}</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Formulaire RDV --}}
            @auth
            @if(auth()->user()->role === 'client')
            <div class="bg-dark-card border border-dark-border rounded-sm p-4">
                <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase mb-3">Demander une visite</div>
                <form method="POST" action="{{ route('appointments.store') }}" class="flex flex-col gap-2">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                    <input type="hidden" name="agent_id"    value="{{ $property->user_id }}">

                    <input type="date" name="date" required min="{{ now()->addDay()->format('Y-m-d') }}"
                           class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">

                    <input type="time" name="time" required
                           class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">

                    <textarea name="message" rows="2" placeholder="Message optionnel..."
                              class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm placeholder-dark-dim focus:outline-none focus:border-indigo-700 font-mono resize-none"></textarea>

                    <button type="submit"
                            class="w-full text-xs bg-indigo-950 border border-indigo-700 text-indigo-300 hover:bg-indigo-900 py-2 rounded-sm transition-colors tracking-widest font-mono mt-1">
                        PLANIFIER LA VISITE
                    </button>
                </form>
            </div>
            @endif
            @else
            <a href="{{ route('login') }}"
               class="block w-full text-center text-xs border border-indigo-700 text-indigo-400 hover:bg-indigo-950 py-2.5 rounded-sm transition-colors tracking-wider">
                CONNEXION POUR VISITER
            </a>
            @endauth

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Incrémenter le compteur de vues
fetch('{{ route('properties.views', $property) }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }});
</script>
@endpush
