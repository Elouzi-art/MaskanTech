@extends('layouts.app')
@section('title', 'Dashboard Agent')

@section('sidebar')

    <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase mb-2 px-1">Mes statistiques</div>
    <div class="grid grid-cols-2 gap-1.5 mb-4">
        @foreach([
            ['Mes biens',  $stats['my_properties'],   'publiés'],
            ['Vues',       $stats['total_views'],      'total'],
            ['RDV',        $stats['appointments'],     'ce mois'],
            ['Favoris',    $stats['favorites_count'],  'sur mes biens'],
        ] as [$lbl, $val, $sub])
        <div class="bg-dark-card3 border border-dark-border rounded-sm p-2.5">
            <div class="text-[9px] tracking-[.1em] text-dark-dim uppercase">{{ $lbl }}</div>
            <div class="text-xl font-bold text-white mt-1">{{ $val }}</div>
            <div class="text-[10px] text-dark-dim mt-0.5">{{ $sub }}</div>
        </div>
        @endforeach
    </div>

    <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase mb-2 px-1">Actions rapides</div>
    <div class="flex flex-col gap-1.5 mb-4">
        <a href="{{ route('properties.create') }}"
           class="flex items-center gap-2 text-xs text-dark-muted hover:text-dark-text border border-dark-border hover:border-dark-dim px-3 py-2 rounded-sm transition-colors">
            <svg class="w-3 h-3" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 1v10M1 6h10"/></svg>
            Publier un bien
        </a>
        <a href="{{ route('appointments.index') }}"
           class="flex items-center gap-2 text-xs text-dark-muted hover:text-dark-text border border-dark-border hover:border-dark-dim px-3 py-2 rounded-sm transition-colors">
            <svg class="w-3 h-3" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="1" y="2" width="10" height="9" rx="1"/><path d="M1 5h10M4 1v2M8 1v2"/></svg>
            Calendrier des visites
        </a>
        <a href="{{ route('messages.index') }}"
           class="flex items-center gap-2 text-xs text-dark-muted hover:text-dark-text border border-dark-border hover:border-dark-dim px-3 py-2 rounded-sm transition-colors">
            <svg class="w-3 h-3" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 2h10v7H1z"/><path d="M1 2l5 4 5-4"/></svg>
            Messages
            @if($stats['unread_messages'] > 0)
                <span class="ml-auto bg-red-900 text-red-300 border border-red-700 text-[9px] px-1.5 rounded-sm">{{ $stats['unread_messages'] }}</span>
            @endif
        </a>
    </div>

    <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase mb-2 px-1">RDV à venir</div>
    @forelse($upcomingAppointments as $apt)
    <div class="py-1.5 border-b border-dark-border/40 last:border-0">
        <p class="text-[11px] text-dark-text truncate">{{ $apt->property->title }}</p>
        <p class="text-[10px] text-dark-muted mt-0.5">
            {{ \Carbon\Carbon::parse($apt->date)->format('d/m') }} — {{ $apt->time }}
        </p>
        <span class="text-[9px] px-2 py-0.5 rounded-sm tracking-wider font-mono
            {{ $apt->status === 'confirmed' ? 'bg-green-950 text-green-400 border border-green-800' : 'bg-yellow-950 text-yellow-400 border border-yellow-800' }}">
            {{ strtoupper($apt->status) }}
        </span>
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
            <svg class="w-3 h-3" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 1v10M1 6h10"/></svg>
            NOUVEAU BIEN
        </a>
    </div>

    <div class="flex flex-col gap-2">
        @forelse($myProperties as $property)
        <div class="bg-dark-card2 border border-dark-border rounded-sm p-3 flex items-center justify-between gap-3">
            <div class="flex items-center gap-3 min-w-0">
                @if($property->primaryImage)
                <img src="{{ Storage::url($property->primaryImage->image_path) }}"
                     class="w-14 h-10 object-cover rounded-sm border border-dark-border shrink-0">
                @else
                <div class="w-14 h-10 bg-dark-card3 border border-dark-border rounded-sm flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-dark-dim" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M1 9V5l5-4 5 4v4H8V7H4v2H1z"/></svg>
                </div>
                @endif
                <div class="min-w-0">
                    <p class="text-[13px] text-dark-text font-medium truncate">{{ $property->title }}</p>
                    <p class="text-[10px] text-dark-muted mt-0.5">{{ $property->city }} — {{ number_format($property->price, 0, ',', ' ') }} MAD/mois</p>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-[9px] px-2 py-0.5 rounded-sm tracking-wider font-mono
                            {{ $property->status === 'available' ? 'bg-green-950 text-green-400 border border-green-800' : 'bg-orange-950 text-orange-400 border border-orange-800' }}">
                            {{ $property->status === 'available' ? 'DISPONIBLE' : 'LOUÉ' }}
                        </span>
                        <span class="text-[9px] text-dark-dim">{{ $property->views_count }} vues</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <a href="{{ route('properties.edit', $property) }}"
                   class="text-[10px] text-dark-muted hover:text-dark-text border border-dark-border hover:border-dark-dim px-2 py-1 rounded-sm transition-colors">
                    Modifier
                </a>
                <a href="{{ route('properties.show', $property) }}"
                   class="text-[10px] text-indigo-400 hover:text-indigo-300 border border-indigo-800 hover:border-indigo-600 px-2 py-1 rounded-sm transition-colors">
                    Voir
                </a>
                <form method="POST" action="{{ route('properties.destroy', $property) }}">
                    @csrf @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Supprimer cette annonce ?')"
                            class="text-[10px] text-red-400 hover:text-red-300 px-2 py-1 transition-colors">
                        ✕
                    </button>
                </form>
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

    @if($myProperties->hasPages())
    <div class="flex justify-center gap-1 pt-1">
        @if(!$myProperties->onFirstPage())
            <a href="{{ $myProperties->previousPageUrl() }}" class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border rounded-sm hover:border-dark-border2 transition-colors">←</a>
        @endif
        @if($myProperties->hasMorePages())
            <a href="{{ $myProperties->nextPageUrl() }}" class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border rounded-sm hover:border-dark-border2 transition-colors">→</a>
        @endif
    </div>
    @endif

</div>
@endsection
