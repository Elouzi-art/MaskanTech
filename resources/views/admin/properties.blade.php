@extends('layouts.admin')
@section('title', 'Gestion des annonces')

@section('content')
<div class="p-4 flex flex-col gap-4">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-sm font-medium text-white tracking-widest">ANNONCES</h1>
            <p class="text-[10px] text-dark-muted tracking-wider mt-0.5">{{ $properties->total() }} annonce(s) au total</p>
        </div>
        <form method="GET" action="{{ route('admin.properties') }}" class="flex gap-2">
            <select name="status" onchange="this.form.submit()"
                class="bg-dark-card3 border border-dark-border text-dark-text text-[11px] px-2.5 py-1.5 rounded-sm focus:outline-none focus:border-indigo-700 font-mono tracking-wider">
                <option value="">Tous les statuts</option>
                <option value="pending"  {{ request('status') === 'pending'  ? 'selected' : '' }}>En attente</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approuvées</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejetées</option>
            </select>
        </form>
    </div>

    <div class="bg-dark-card border border-dark-border rounded-sm overflow-hidden">
        <table class="w-full text-xs font-mono">
            <thead>
                <tr class="border-b border-dark-border bg-dark-card2">
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2.5">Annonce</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2.5">Propriétaire</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2.5">Ville</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2.5">Loyer</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2.5">Validation</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2.5">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($properties as $property)
                <tr class="border-b border-dark-border hover:bg-dark-card3 transition-colors">
                    <td class="px-3 py-2.5">
                        <a href="{{ route('properties.show', $property) }}"
                           class="text-dark-text hover:text-indigo-300 transition-colors truncate block max-w-[180px] text-[11px]">
                            {{ $property->title }}
                        </a>
                        <p class="text-[9px] text-dark-dim mt-0.5">{{ ucfirst($property->type) }} · {{ $property->created_at->format('d/m/Y') }}</p>
                    </td>
                    <td class="px-3 py-2.5">
                        <div class="flex items-center gap-1.5">
                            <span class="text-[11px] text-dark-muted">{{ $property->user->name }}</span>
                            @if($property->user->is_verified)
                                <span title="Propriétaire vérifié" class="text-blue-400 text-[10px]">✓</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-3 py-2.5 text-dark-muted text-[11px]">{{ $property->city }}</td>
                    <td class="px-3 py-2.5 text-dark-text text-[11px]">{{ number_format($property->price, 0, ',', ' ') }} MAD</td>
                    <td class="px-3 py-2.5">
                        @php $s = $property->approval_status ?? 'pending'; @endphp
                        <span class="text-[9px] tracking-wider px-1.5 py-0.5 rounded-sm
                            @if($s === 'approved') bg-green-950 text-green-400 border border-green-800
                            @elseif($s === 'rejected') bg-red-950 text-red-400 border border-red-800
                            @else bg-orange-950 text-orange-400 border border-orange-800 @endif">
                            @if($s === 'approved') APPROUVÉE
                            @elseif($s === 'rejected') REJETÉE
                            @else EN ATTENTE @endif
                        </span>
                        @if($s === 'rejected' && $property->rejection_reason)
                            <p class="text-[9px] text-red-400 mt-0.5 max-w-[120px] truncate" title="{{ $property->rejection_reason }}">
                                {{ $property->rejection_reason }}
                            </p>
                        @endif
                    </td>
                    <td class="px-3 py-2.5">
                        {{-- Conteneur relatif pour positionner la modale correctement --}}
                        <div class="relative flex items-center gap-2" x-data="{ rejectOpen: false }">

                            @if($s !== 'approved')
                            <form method="POST" action="{{ route('admin.properties.approve', $property) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="text-[10px] text-green-400 hover:text-green-300 transition-colors tracking-wider">APPROUVER</button>
                            </form>
                            @endif

                            @if($s !== 'rejected')
                            <button @click="rejectOpen = !rejectOpen"
                                class="text-[10px] text-orange-400 hover:text-orange-300 transition-colors tracking-wider">
                                REJETER
                            </button>
                            @endif

                            <form method="POST" action="{{ route('admin.properties.destroy', $property) }}">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Supprimer cette annonce ?')"
                                    class="text-[10px] text-red-400 hover:text-red-300 transition-colors">✕</button>
                            </form>

                            {{-- Modale rejet — positionnée par rapport au conteneur relatif --}}
                            <div x-show="rejectOpen" @click.away="rejectOpen = false"
                                 class="absolute right-0 top-6 z-20 bg-dark-card border border-dark-border rounded-sm p-3 w-64 shadow-xl fade-in">
                                <p class="text-[10px] text-white tracking-wider mb-2">Motif de rejet (optionnel)</p>
                                <form method="POST" action="{{ route('admin.properties.reject', $property) }}">
                                    @csrf @method('PATCH')
                                    <textarea name="reason" rows="2"
                                        class="w-full bg-dark-card3 border border-dark-border text-dark-text text-[11px] px-2 py-1.5 rounded-sm focus:outline-none focus:border-red-800 resize-none font-mono"
                                        placeholder="Ex: Photos insuffisantes..."></textarea>
                                    <div class="flex gap-2 mt-2">
                                        <button type="submit"
                                            class="flex-1 text-[10px] text-red-400 border border-red-900 hover:border-red-700 py-1.5 rounded-sm transition-colors tracking-wider">
                                            CONFIRMER
                                        </button>
                                        <button type="button" @click="rejectOpen = false"
                                            class="flex-1 text-[10px] text-dark-muted border border-dark-border hover:border-dark-border2 py-1.5 rounded-sm transition-colors tracking-wider">
                                            ANNULER
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-3 py-10 text-center text-dark-muted text-[11px] tracking-wider">Aucune annonce.</td>
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