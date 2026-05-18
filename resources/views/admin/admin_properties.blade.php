@extends('layouts.app')
@section('title', 'Admin — Gestion des biens')

@section('content')
<div class="p-3 flex flex-col gap-3">

    {{-- Header --}}
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-base font-medium text-white tracking-wider">Biens immobiliers</h1>
            <p class="text-[10px] text-dark-muted tracking-wider mt-0.5">{{ $properties->total() }} annonce(s) en base</p>
        </div>
        <a href="{{ route('properties.create') }}"
           class="text-xs border border-indigo-700 text-indigo-400 hover:bg-indigo-950 px-3 py-1.5 rounded-sm transition-colors tracking-wider font-mono">
            + NOUVELLE ANNONCE
        </a>
    </div>

    @if(session('success'))
        <div class="text-green-400 text-[10px] tracking-wider border border-green-800 bg-green-950 px-3 py-2 rounded-sm">
            ✓ {{ session('success') }}
        </div>
    @endif

    {{-- Tableau --}}
    <div class="bg-dark-card border border-dark-border rounded-sm overflow-hidden">
        <table class="w-full text-xs font-mono">
            <thead>
                <tr class="border-b border-dark-border">
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Bien</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Agent</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Prix</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Statut</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Audience</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Vues</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Ajouté</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($properties as $property)
                <tr class="border-b border-dark-border hover:bg-dark-card3 transition-colors">

                    {{-- Bien --}}
                    <td class="px-3 py-2">
                        <div class="flex items-center gap-2">
                            @if($property->primaryImage)
                                <img src="{{ Storage::url($property->primaryImage->image_path) }}"
                                     class="w-10 h-7 object-cover rounded-sm shrink-0 border border-dark-border">
                            @else
                                <div class="w-10 h-7 bg-dark-card3 border border-dark-border rounded-sm shrink-0 flex items-center justify-center">
                                    <span class="text-dark-dim text-[8px]">—</span>
                                </div>
                            @endif
                            <div class="min-w-0">
                                <a href="{{ route('properties.show', $property) }}"
                                   class="text-dark-text hover:text-indigo-400 transition-colors truncate block max-w-[180px]">
                                    {{ $property->title }}
                                </a>
                                <span class="text-[10px] text-dark-dim">{{ $property->city }}</span>
                            </div>
                        </div>
                    </td>

                    {{-- Agent --}}
                    <td class="px-3 py-2 text-dark-muted">{{ $property->user->name }}</td>

                    {{-- Prix --}}
                    <td class="px-3 py-2 text-white font-bold">
                        {{ number_format($property->price, 0, ',', ' ') }}
                        <span class="text-[10px] text-dark-dim font-normal">MAD</span>
                    </td>

                    {{-- Statut --}}
                    <td class="px-3 py-2">
                        <span class="text-[9px] tracking-wider px-2 py-0.5 rounded-sm font-mono
                            {{ $property->status === 'available' ? 'bg-green-950 text-green-400 border border-green-800' : 'bg-orange-950 text-orange-400 border border-orange-800' }}">
                            {{ $property->status === 'available' ? 'DISPONIBLE' : 'LOUÉ' }}
                        </span>
                    </td>

                    {{-- Audience --}}
                    <td class="px-3 py-2">
                        @if($property->target_audience === 'all')
                            <span class="text-[10px] text-dark-dim">Tous</span>
                        @elseif($property->target_audience === 'student')
                            <span class="text-[9px] tracking-wider px-2 py-0.5 rounded-sm font-mono bg-blue-950 text-blue-400 border border-blue-800">ÉTUDIANT</span>
                        @else
                            <span class="text-[9px] tracking-wider px-2 py-0.5 rounded-sm font-mono bg-purple-950 text-purple-400 border border-purple-800">PRO</span>
                        @endif
                    </td>

                    {{-- Vues --}}
                    <td class="px-3 py-2 text-dark-muted">{{ $property->views_count }}</td>

                    {{-- Date --}}
                    <td class="px-3 py-2 text-dark-muted text-[10px]">{{ $property->created_at->format('d/m/Y') }}</td>

                    {{-- Actions --}}
                    <td class="px-3 py-2">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('properties.edit', $property) }}"
                               class="text-[10px] text-indigo-400 hover:text-indigo-300 transition-colors tracking-wider">
                                ÉDITER
                            </a>
                            <form method="POST" action="{{ route('properties.destroy', $property) }}">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Supprimer « {{ addslashes($property->title) }} » ?')"
                                        class="text-[10px] text-red-400 hover:text-red-300 transition-colors tracking-wider">
                                    ✕
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-3 py-8 text-center text-dark-muted text-[11px] tracking-wider">
                        Aucun bien enregistré.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($properties->hasPages())
    <div class="flex justify-center gap-1">
        @if(!$properties->onFirstPage())
            <a href="{{ $properties->previousPageUrl() }}"
               class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border rounded-sm hover:border-dark-border2 hover:text-dark-text transition-colors">←</a>
        @endif
        @foreach($properties->getUrlRange(max(1,$properties->currentPage()-2), min($properties->lastPage(),$properties->currentPage()+2)) as $page => $url)
            @if($page == $properties->currentPage())
                <span class="px-3 py-1.5 text-[10px] text-white border border-indigo-700 bg-indigo-950 rounded-sm">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border rounded-sm hover:border-dark-border2 hover:text-dark-text transition-colors">{{ $page }}</a>
            @endif
        @endforeach
        @if($properties->hasMorePages())
            <a href="{{ $properties->nextPageUrl() }}"
               class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border rounded-sm hover:border-dark-border2 hover:text-dark-text transition-colors">→</a>
        @endif
    </div>
    @endif

</div>
@endsection
