@extends('layouts.app')
@section('title', 'Dashboard Agent')

@section('sidebar')

    <x-sidebar-label label="Mes statistiques" />
    <div class="grid grid-cols-2 gap-1.5">
        <x-metric-card label="Mes biens"  :value="$stats['my_properties']"   sub="publiés" />
        <x-metric-card label="Vues"       :value="$stats['total_views']"      sub="total" />
        <x-metric-card label="RDV"        :value="$stats['appointments']"     sub="ce mois" />
        <x-metric-card label="Favoris"    :value="$stats['favorites_count']"  sub="sur mes biens" />
    </div>

    <x-sidebar-label label="Actions rapides" />
    <div class="flex flex-col gap-1.5">
        <a href="{{ route('properties.create') }}"
           class="flex items-center gap-2 text-xs text-dark-muted hover:text-dark-text border border-dark-border hover:border-dark-dim px-3 py-2 rounded-sm transition-colors">
            <svg class="w-3 h-3" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M6 1v10M1 6h10"/>
            </svg>
            Publier un bien
        </a>
        <a href="{{ route('appointments.index') }}"
           class="flex items-center gap-2 text-xs text-dark-muted hover:text-dark-text border border-dark-border hover:border-dark-dim px-3 py-2 rounded-sm transition-colors">
            <svg class="w-3 h-3" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5">
                <rect x="1" y="2" width="10" height="9" rx="1"/><path d="M1 5h10M4 1v2M8 1v2"/>
            </svg>
            Calendrier des visites
        </a>
        <a href="{{ route('messages.index') }}"
           class="flex items-center gap-2 text-xs text-dark-muted hover:text-dark-text border border-dark-border hover:border-dark-dim px-3 py-2 rounded-sm transition-colors">
            <svg class="w-3 h-3" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M1 2h10v7H1z"/><path d="M1 2l5 4 5-4"/>
            </svg>
            Messages
            @if($stats['unread_messages'] > 0)
                <span class="ml-auto bg-red-900 text-red-300 border border-red-700 text-[9px] px-1.5 rounded-sm">
                    {{ $stats['unread_messages'] }}
                </span>
            @endif
        </a>
    </div>

    <x-sidebar-label label="RDV à venir" />
    @forelse($upcomingAppointments as $apt)
    <div class="py-1.5 border-b border-dark-border/40 last:border-0">
        <p class="text-[11px] text-dark-text">{{ $apt->property->title }}</p>
        <p class="text-[10px] text-dark-muted mt-0.5">{{ $apt->date->format('d/m') }} — {{ $apt->time }}</p>
        <x-status-badge :status="$apt->status" />
    </div>
    @empty
    <p class="text-[11px] text-dark-dim">Aucun RDV à venir</p>
    @endforelse

@endsection

@section('content')
<div class="p-3 flex flex-col gap-3">

    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-base font-medium text-white tracking-wider">Mes annonces</h1>
            <p class="text-[10px] text-dark-muted tracking-wider mt-0.5">Bonjour, {{ auth()->user()->name }}</p>
        </div>
        <a href="{{ route('properties.create') }}"
           class="flex items-center gap-1.5 text-xs border border-indigo-700 text-indigo-400 hover:bg-indigo-950 px-3 py-1.5 rounded-sm transition-colors tracking-wider">
            <svg class="w-3 h-3" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M6 1v10M1 6h10"/>
            </svg>
            NOUVEAU BIEN
        </a>
    </div>

    {{-- Liste des biens --}}
    <div class="flex flex-col gap-2">
        @forelse($myProperties as $property)
        <div class="bg-dark-card2 border border-dark-border rounded-sm p-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                @if($property->primaryImage)
                <img src="{{ Storage::url($property->primaryImage->image_path) }}"
                     class="w-14 h-10 object-cover rounded-sm border border-dark-border">
                @else
                <div class="w-14 h-10 bg-dark-card3 border border-dark-border rounded-sm flex items-center justify-center">
                    <svg class="w-4 h-4 text-dark-dim" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.2">
                        <path d="M1 9V5l5-4 5 4v4H8V7H4v2H1z"/>
                    </svg>
                </div>
                @endif
                <div>
                    <p class="text-[13px] text-dark-text font-medium">{{ $property->title }}</p>
                    <p class="text-[10px] text-dark-muted mt-0.5">{{ $property->city }} — {{ number_format($property->price, 0, ',', ' ') }} MAD</p>
                    <div class="flex items-center gap-2 mt-1">
                        <x-status-badge :status="$property->status" />
                        <span class="text-[9px] text-dark-dim">{{ $property->views_count }} vues</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('properties.edit', $property) }}"
                   class="text-[10px] text-dark-muted hover:text-dark-text border border-dark-border hover:border-dark-dim px-2 py-1 rounded-sm transition-colors">
                    Modifier
                </a>
                <a href="{{ route('properties.show', $property) }}"
                   class="text-[10px] text-indigo-400 hover:text-indigo-300 border border-indigo-800 hover:border-indigo-600 px-2 py-1 rounded-sm transition-colors">
                    Voir
                </a>
            </div>
        </div>
        @empty
        <div class="bg-dark-card border border-dark-border rounded-sm p-8 text-center">
            <p class="text-dark-muted text-xs tracking-wider">Aucun bien publié pour l'instant</p>
            <a href="{{ route('properties.create') }}" class="inline-block mt-3 text-xs text-indigo-400 hover:text-indigo-300 underline">
                Publier votre premier bien →
            </a>
        </div>
        @endforelse
    </div>

    {{ $myProperties->links('partials.pagination') }}

</div>
@endsection
