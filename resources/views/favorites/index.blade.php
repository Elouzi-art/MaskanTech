@extends('layouts.app')
@section('title', 'Mes favoris')

@section('content')
<div class="p-3 flex flex-col gap-3">

    <div>
        <h1 class="text-base font-medium text-white tracking-wider">Mes favoris</h1>
        <p class="text-[10px] text-dark-muted tracking-wider mt-0.5">{{ $favorites->total() }} logement(s) sauvegardé(s)</p>
    </div>

    @if($favorites->isEmpty())
        <div class="bg-dark-card border border-dark-border rounded-sm p-8 text-center">
            <p class="text-dark-muted text-sm tracking-wider">Aucun favori pour le moment.</p>
            <a href="{{ route('properties.index') }}" class="text-[10px] text-indigo-400 hover:text-indigo-300 mt-2 inline-block">Parcourir les logements →</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3">
            @foreach($favorites as $property)
            <div class="bg-dark-card border border-dark-border rounded-sm overflow-hidden hover:border-dark-border2 transition-colors group">

                {{-- Image --}}
                <div class="relative h-36 bg-dark-card3 overflow-hidden">
                    @if($property->primaryImage)
                        <img src="{{ Storage::url($property->primaryImage->image_path) }}"
                             alt="{{ $property->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="text-dark-dim text-[10px] tracking-wider">AUCUNE IMAGE</span>
                        </div>
                    @endif

                    {{-- Badge audience --}}
                    @if(($property->target_audience ?? 'all') !== 'all')
                    <div class="absolute top-2 left-2">
                        <span class="text-[9px] tracking-wider px-2 py-0.5 rounded-sm font-mono
                            {{ $property->target_audience === 'student' ? 'bg-blue-950 text-blue-400 border border-blue-800' : 'bg-purple-950 text-purple-400 border border-purple-800' }}">
                            {{ $property->target_audience === 'student' ? 'ÉTUDIANT' : 'PRO' }}
                        </span>
                    </div>
                    @endif

                    {{-- Retirer des favoris --}}
                    <form method="POST" action="{{ route('favorites.toggle', $property) }}" class="absolute top-2 right-2">
                        @csrf
                        <button type="submit"
                                class="w-7 h-7 bg-dark-card border border-red-800 rounded-sm flex items-center justify-center hover:bg-red-950 transition-colors"
                                title="Retirer des favoris">
                            <svg class="w-3.5 h-3.5 text-red-400 fill-current" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M6 10.5S1 7 1 3.5a2.5 2.5 0 015 0 2.5 2.5 0 015 0C11 7 6 10.5 6 10.5z"/>
                            </svg>
                        </button>
                    </form>
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
                        <span class="text-[9px] tracking-wider px-1.5 py-0.5 rounded-sm font-mono
                            {{ $property->status === 'available' ? 'bg-green-950 text-green-400 border border-green-800' : 'bg-orange-950 text-orange-400 border border-orange-800' }}">
                            {{ $property->status === 'available' ? 'DISPO' : 'LOUÉ' }}
                        </span>
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
        @if($favorites->hasPages())
        <div class="flex justify-center gap-1 pt-2">
            @if($favorites->onFirstPage())
                <span class="px-3 py-1.5 text-[10px] text-dark-dim border border-dark-border rounded-sm">←</span>
            @else
                <a href="{{ $favorites->previousPageUrl() }}" class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border rounded-sm hover:border-dark-border2 hover:text-dark-text transition-colors">←</a>
            @endif
            @if($favorites->hasMorePages())
                <a href="{{ $favorites->nextPageUrl() }}" class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border rounded-sm hover:border-dark-border2 hover:text-dark-text transition-colors">→</a>
            @else
                <span class="px-3 py-1.5 text-[10px] text-dark-dim border border-dark-border rounded-sm">→</span>
            @endif
        </div>
        @endif
    @endif

</div>
@endsection
