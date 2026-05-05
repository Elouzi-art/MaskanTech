@extends('layouts.app')
@section('title', 'Rendez-vous')

@section('content')
<div class="p-3 flex flex-col gap-3">

    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-base font-medium text-white tracking-wider">Rendez-vous</h1>
            <p class="text-[10px] text-dark-muted tracking-wider mt-0.5">{{ $appointments->total() }} rendez-vous</p>
        </div>
    </div>

    @if($appointments->isEmpty())
        <div class="bg-dark-card border border-dark-border rounded-sm p-8 text-center">
            <p class="text-dark-muted text-sm tracking-wider">Aucun rendez-vous pour le moment.</p>
            <a href="{{ route('properties.index') }}" class="text-[10px] text-indigo-400 hover:text-indigo-300 mt-2 inline-block">Parcourir les logements</a>
        </div>
    @else
        <div class="flex flex-col gap-2">
            @foreach($appointments as $appointment)
            <div class="bg-dark-card border border-dark-border rounded-sm p-3 flex flex-col gap-2">

                <div class="flex items-start justify-between gap-3">
                    {{-- Infos bien --}}
                    <div class="flex-1 min-w-0">
                        <a href="{{ route('properties.show', $appointment->property) }}"
                           class="text-xs text-white font-medium tracking-wide hover:text-indigo-300 transition-colors truncate block">
                            {{ $appointment->property->title }}
                        </a>
                        <p class="text-[10px] text-dark-muted tracking-wider mt-0.5">{{ $appointment->property->city }}</p>
                    </div>

                    {{-- Statut --}}
                    <span class="text-[9px] tracking-wider px-2 py-0.5 rounded-sm font-mono shrink-0
                        @if($appointment->status === 'confirmed')  bg-green-950 text-green-400 border border-green-800
                        @elseif($appointment->status === 'refused') bg-red-950 text-red-400 border border-red-800
                        @elseif($appointment->status === 'completed') bg-dark-card3 text-dark-muted border border-dark-border
                        @else bg-yellow-950 text-yellow-400 border border-yellow-800
                        @endif">
                        @if($appointment->status === 'confirmed')  CONFIRMÉ
                        @elseif($appointment->status === 'refused') REFUSÉ
                        @elseif($appointment->status === 'completed') TERMINÉ
                        @else EN ATTENTE
                        @endif
                    </span>
                </div>

                <div class="flex flex-wrap gap-4 text-[10px] text-dark-muted tracking-wider">
                    <span>📅 {{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}</span>
                    <span>🕐 {{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}</span>
                    @if(auth()->user()->isAdmin() || auth()->user()->isAgent())
                        <span>👤 {{ $appointment->client->name }}
                            @if($appointment->client->isStudent())
                                <span class="text-blue-400">[ÉTUDIANT]</span>
                            @endif
                        </span>
                    @else
                        <span>🏠 Agent : {{ $appointment->agent->name }}</span>
                    @endif
                </div>

                @if($appointment->message)
                <p class="text-[10px] text-dark-muted border-l-2 border-dark-border2 pl-2 italic">{{ $appointment->message }}</p>
                @endif

                {{-- Actions agent/admin --}}
                @if((auth()->user()->isAgent() && $appointment->agent_id === auth()->id()) || auth()->user()->isAdmin())
                    @if($appointment->status === 'pending')
                    <div class="flex gap-2 pt-1">
                        <form method="POST" action="{{ route('appointments.status', $appointment) }}">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="confirmed">
                            <button type="submit"
                                    class="text-[10px] tracking-wider border border-green-800 text-green-400 hover:bg-green-950 px-3 py-1 rounded-sm transition-colors font-mono">
                                CONFIRMER
                            </button>
                        </form>
                        <form method="POST" action="{{ route('appointments.status', $appointment) }}">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="refused">
                            <button type="submit"
                                    class="text-[10px] tracking-wider border border-red-800 text-red-400 hover:bg-red-950 px-3 py-1 rounded-sm transition-colors font-mono">
                                REFUSER
                            </button>
                        </form>
                    </div>
                    @elseif($appointment->status === 'confirmed')
                    <form method="POST" action="{{ route('appointments.status', $appointment) }}" class="pt-1">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="completed">
                        <button type="submit"
                                class="text-[10px] tracking-wider border border-dark-border text-dark-muted hover:border-dark-border2 hover:text-dark-text px-3 py-1 rounded-sm transition-colors font-mono">
                            MARQUER TERMINÉ
                        </button>
                    </form>
                    @endif
                @endif

                {{-- Annulation client --}}
                @if(auth()->user()->canRent() && $appointment->client_id === auth()->id() && $appointment->status === 'pending')
                <form method="POST" action="{{ route('appointments.destroy', $appointment) }}" class="pt-1">
                    @csrf @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Annuler ce rendez-vous ?')"
                            class="text-[10px] tracking-wider text-red-400 hover:text-red-300 transition-colors font-mono">
                        Annuler la demande
                    </button>
                </form>
                @endif

            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($appointments->hasPages())
        <div class="flex justify-center gap-1 pt-2">
            @if($appointments->onFirstPage())
                <span class="px-3 py-1.5 text-[10px] text-dark-dim border border-dark-border rounded-sm">←</span>
            @else
                <a href="{{ $appointments->previousPageUrl() }}" class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border rounded-sm hover:border-dark-border2 hover:text-dark-text transition-colors">←</a>
            @endif
            @if($appointments->hasMorePages())
                <a href="{{ $appointments->nextPageUrl() }}" class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border rounded-sm hover:border-dark-border2 hover:text-dark-text transition-colors">→</a>
            @else
                <span class="px-3 py-1.5 text-[10px] text-dark-dim border border-dark-border rounded-sm">→</span>
            @endif
        </div>
        @endif
    @endif

</div>
@endsection
