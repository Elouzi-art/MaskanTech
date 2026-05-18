@extends('layouts.app')
@section('title', 'Mon Espace')

@section('sidebar')

    <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase mb-2 px-1">Mon activité</div>
    <div class="grid grid-cols-2 gap-1.5 mb-4">
        @foreach([
            ['Favoris',   $stats['favorites'],    'sauvegardés'],
            ['Visites',   $stats['appointments'], 'demandées'],
            ['Messages',  $stats['messages'],     'envoyés'],
            ['Consultés', $stats['viewed'],       'biens vus'],
        ] as [$lbl, $val, $sub])
        <div class="bg-dark-card3 border border-dark-border rounded-sm p-2.5">
            <div class="text-[9px] tracking-[.1em] text-dark-dim uppercase">{{ $lbl }}</div>
            <div class="text-xl font-bold text-white mt-1">{{ $val }}</div>
            <div class="text-[10px] text-dark-dim mt-0.5">{{ $sub }}</div>
        </div>
        @endforeach
    </div>

    <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase mb-2 px-1">Navigation</div>
    <div class="flex flex-col gap-1 mb-4">
        @foreach([
            ['Rechercher un bien',  'properties.index',   'M3 5h6M3 8h4M1 2h10v8H1z'],
            ['Mes favoris',         'favorites.index',    'M6 10l-4-4a2 2 0 012-3 2 2 0 014 1 2 2 0 014-1 2 2 0 012 3z'],
            ['Mes rendez-vous',     'appointments.index', 'M1 2h10v9H1zM1 5h10M4 1v2M8 1v2'],
            ['Mes messages',        'messages.index',     'M1 2h10v7H1zM1 2l5 4 5-4'],
        ] as [$label, $route, $path])
        <a href="{{ route($route) }}"
           class="flex items-center gap-2 text-xs text-dark-muted hover:text-dark-text py-2 border-b border-dark-border/30 last:border-0 transition-colors">
            <svg class="w-3 h-3 shrink-0" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="{{ $path }}"/>
            </svg>
            {{ $label }}
        </a>
        @endforeach
    </div>

    <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase mb-2 px-1">Consultés récemment</div>
    @forelse($recentlyViewed as $property)
    <div class="py-1.5 border-b border-dark-border/40 last:border-0">
        <a href="{{ route('properties.show', $property) }}" class="text-[11px] text-dark-muted hover:text-dark-text transition-colors block truncate">
            {{ Str::limit($property->title, 28) }}
        </a>
        <p class="text-[10px] text-dark-dim">{{ $property->city }}</p>
    </div>
    @empty
    <p class="text-[11px] text-dark-dim">Aucune consultation récente</p>
    @endforelse

@endsection

@section('content')
<div class="p-3 flex flex-col gap-3">

    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-base font-medium text-white tracking-wider">Mon espace</h1>
            <p class="text-[10px] text-dark-muted tracking-wider mt-0.5">Bienvenue, {{ auth()->user()->name }}</p>
        </div>
        <a href="{{ route('properties.index') }}"
           class="text-xs border border-indigo-700 text-indigo-400 hover:bg-indigo-950 px-3 py-1.5 rounded-sm transition-colors tracking-wider">
            RECHERCHER UN BIEN
        </a>
    </div>

    {{-- Favoris --}}
    <div>
        <div class="flex items-center justify-between mb-2">
            <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase">Mes favoris</div>
            <a href="{{ route('favorites.index') }}" class="text-[10px] text-indigo-400 hover:text-indigo-300">Voir tout →</a>
        </div>
        <div class="grid grid-cols-2 gap-2">
            @forelse($favorites as $property)
            <div class="bg-dark-card2 border border-dark-border rounded-sm overflow-hidden">
                @if($property->primaryImage)
                <img src="{{ Storage::url($property->primaryImage->image_path) }}" class="w-full h-24 object-cover">
                @else
                <div class="w-full h-24 bg-dark-card3 flex items-center justify-center">
                    <svg class="w-6 h-6 text-dark-dim" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1">
                        <path d="M1 9V5l5-4 5 4v4H8V7H4v2H1z"/>
                    </svg>
                </div>
                @endif
                <div class="p-2.5">
                    <p class="text-[12px] text-dark-text font-medium truncate">{{ $property->title }}</p>
                    <p class="text-[10px] text-dark-muted mt-0.5">{{ $property->city }}</p>
                    <p class="text-[11px] text-indigo-400 mt-1">{{ number_format($property->price, 0, ',', ' ') }} MAD/mois</p>
                    <div class="flex items-center justify-between mt-2">
                        <span class="text-[9px] px-2 py-0.5 rounded-sm tracking-wider font-mono
                            {{ $property->status === 'available' ? 'bg-green-950 text-green-400 border border-green-800' : 'bg-orange-950 text-orange-400 border border-orange-800' }}">
                            {{ $property->status === 'available' ? 'DISPO' : 'LOUÉ' }}
                        </span>
                        <a href="{{ route('properties.show', $property) }}" class="text-[10px] text-dark-muted hover:text-dark-text transition-colors">Voir →</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-2 bg-dark-card border border-dark-border rounded-sm p-6 text-center">
                <p class="text-dark-muted text-xs tracking-wider">Aucun favori sauvegardé</p>
                <a href="{{ route('properties.index') }}" class="inline-block mt-2 text-xs text-indigo-400 hover:underline">Explorer les biens →</a>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Mes RDV --}}
    <div>
        <div class="flex items-center justify-between mb-2">
            <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase">Mes rendez-vous</div>
            <a href="{{ route('appointments.index') }}" class="text-[10px] text-indigo-400 hover:text-indigo-300">Voir tout →</a>
        </div>
        <div class="flex flex-col gap-1.5">
            @forelse($myAppointments as $apt)
            <div class="bg-dark-card2 border border-dark-border rounded-sm p-2.5 flex items-center justify-between gap-3">
                <div class="min-w-0">
                    <p class="text-[12px] text-dark-text truncate">{{ $apt->property->title }}</p>
                    <p class="text-[10px] text-dark-muted mt-0.5">
                        {{ \Carbon\Carbon::parse($apt->date)->format('d/m/Y') }} — {{ $apt->time }}
                        &nbsp;·&nbsp; Agent : {{ $apt->agent->name }}
                    </p>
                </div>
                <span class="text-[9px] px-2 py-0.5 rounded-sm tracking-wider font-mono shrink-0
                    @switch($apt->status)
                        @case('pending')   bg-yellow-950 text-yellow-400 border border-yellow-800 @break
                        @case('confirmed') bg-green-950 text-green-400 border border-green-800 @break
                        @case('refused')   bg-red-950 text-red-400 border border-red-800 @break
                        @case('completed') bg-dark-card3 text-dark-muted border border-dark-border @break
                    @endswitch">
                    {{ strtoupper($apt->status) }}
                </span>
            </div>
            @empty
            <p class="text-[11px] text-dark-dim py-2">Aucun rendez-vous</p>
            @endforelse
        </div>
    </div>

</div>
@endsection
