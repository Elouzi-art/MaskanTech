@extends('layouts.app')
@section('title', 'Gestion des annonces')

@section('content')
<div class="p-3 flex flex-col gap-3">

    <div>
        <h1 class="text-base font-medium text-white tracking-wider">Toutes les annonces</h1>
        <p class="text-[10px] text-dark-muted tracking-wider mt-0.5">{{ $properties->total() }} annonce(s)</p>
    </div>

    <div class="bg-dark-card border border-dark-border rounded-sm overflow-hidden">
        <table class="w-full text-xs font-mono">
            <thead>
                <tr class="border-b border-dark-border">
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Annonce</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Agent</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Ville</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Loyer</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Audience</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Statut</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Vues</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($properties as $property)
                <tr class="border-b border-dark-border hover:bg-dark-card3 transition-colors">
                    <td class="px-3 py-2">
                        <a href="{{ route('properties.show', $property) }}"
                           class="text-dark-text hover:text-indigo-300 transition-colors tracking-wide truncate block max-w-[180px]">
                            {{ $property->title }}
                        </a>
                        <p class="text-[10px] text-dark-dim">{{ ucfirst($property->type) }}</p>
                    </td>
                    <td class="px-3 py-2 text-dark-muted text-[10px]">{{ $property->user->name }}</td>
                    <td class="px-3 py-2 text-dark-muted text-[10px]">{{ $property->city }}</td>
                    <td class="px-3 py-2 text-dark-text">{{ number_format($property->price, 0, ',', ' ') }} MAD</td>
                    <td class="px-3 py-2">
                        <span class="text-[9px] tracking-wider px-1.5 py-0.5 rounded-sm
                            @if(($property->target_audience ?? 'all') === 'student')   bg-blue-950 text-blue-400 border border-blue-800
                            @elseif(($property->target_audience ?? 'all') === 'professional') bg-purple-950 text-purple-400 border border-purple-800
                            @else bg-dark-card3 text-dark-muted border border-dark-border
                            @endif">
                            @if(($property->target_audience ?? 'all') === 'student')   ÉTUDIANT
                            @elseif(($property->target_audience ?? 'all') === 'professional') PRO
                            @else TOUS
                            @endif
                        </span>
                    </td>
                    <td class="px-3 py-2">
                        <span class="text-[9px] tracking-wider px-1.5 py-0.5 rounded-sm
                            {{ $property->status === 'available' ? 'bg-green-950 text-green-400 border border-green-800' : 'bg-orange-950 text-orange-400 border border-orange-800' }}">
                            {{ $property->status === 'available' ? 'DISPO' : 'LOUÉ' }}
                        </span>
                    </td>
                    <td class="px-3 py-2 text-dark-muted text-[10px]">{{ $property->views_count }}</td>
                    <td class="px-3 py-2">
                        <div class="flex gap-2">
                            <a href="{{ route('properties.edit', $property) }}"
                               class="text-[10px] text-indigo-400 hover:text-indigo-300 transition-colors tracking-wider">MODIFIER</a>
                            <form method="POST" action="{{ route('properties.destroy', $property) }}">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Supprimer cette annonce ?')"
                                        class="text-[10px] text-red-400 hover:text-red-300 transition-colors tracking-wider">
                                    ✕
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-3 py-8 text-center text-dark-muted text-[11px] tracking-wider">Aucune annonce.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($properties->hasPages())
    <div class="flex justify-center gap-1">
        @if(!$properties->onFirstPage())
            <a href="{{ $properties->previousPageUrl() }}" class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border rounded-sm hover:border-dark-border2 hover:text-dark-text transition-colors">←</a>
        @endif
        @if($properties->hasMorePages())
            <a href="{{ $properties->nextPageUrl() }}" class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border rounded-sm hover:border-dark-border2 hover:text-dark-text transition-colors">→</a>
        @endif
    </div>
    @endif

</div>
@endsection
