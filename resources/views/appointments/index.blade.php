@extends('layouts.app')
@section('title', 'Mes rendez-vous')

@section('content')
<div class="p-3 flex flex-col gap-3">

    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-base font-medium text-white tracking-wider">Rendez-vous</h1>
            <p class="text-[10px] text-dark-muted tracking-wider mt-0.5">
                {{ $appointments->total() }} rendez-vous
            </p>
        </div>
    </div>

    @if(session('success'))
        <div class="text-green-400 text-[10px] tracking-wider border border-green-800 bg-green-950 px-3 py-2 rounded-sm">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if($appointments->isEmpty())
        <div class="bg-dark-card border border-dark-border rounded-sm p-8 text-center">
            <p class="text-dark-muted text-sm tracking-wider">Aucun rendez-vous.</p>
        </div>
    @else
        <div class="flex flex-col gap-2">
            @foreach($appointments as $appointment)
            <div class="bg-dark-card border border-dark-border rounded-sm p-3 flex flex-col gap-2">

                <div class="flex items-start justify-between gap-3">

                    {{-- Infos bien --}}
                    <div class="flex flex-col gap-0.5 min-w-0">
                        <a href="{{ route('properties.show', $appointment->property) }}"
                           class="text-xs text-white font-medium tracking-wide hover:text-indigo-400 transition-colors truncate">
                            {{ $appointment->property->title }}
                        </a>
                        <p class="text-[10px] text-dark-muted tracking-wider">
                            {{ $appointment->property->city }}
                        </p>
                    </div>

                    {{-- Badge statut --}}
                    <span class="shrink-0 text-[9px] tracking-wider px-2 py-0.5 rounded-sm font-mono
                        @switch($appointment->status)
                            @case('pending')    bg-yellow-950 text-yellow-400 border border-yellow-800 @break
                            @case('confirmed')  bg-green-950  text-green-400  border border-green-800  @break
                            @case('refused')    bg-red-950    text-red-400    border border-red-800    @break
                            @case('completed')  bg-dark-card3 text-dark-muted border border-dark-border @break
                        @endswitch
                    ">
                        @switch($appointment->status)
                            @case('pending')   EN ATTENTE @break
                            @case('confirmed') CONFIRMÉ   @break
                            @case('refused')   REFUSÉ     @break
                            @case('completed') TERMINÉ    @break
                        @endswitch
                    </span>
                </div>

                {{-- Date / heure --}}
                <div class="flex gap-4 text-[10px] text-dark-muted tracking-wider border-t border-dark-border pt-2">
                    <span>📅 {{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }}</span>
                    <span>🕐 {{ $appointment->time }}</span>

                    {{-- Interlocuteur selon le rôle --}}
                    @if(auth()->user()->isAdmin())
                        <span class="ml-auto">Client : {{ $appointment->client->name }}</span>
                    @elseif(auth()->user()->isAgent())
                        <span class="ml-auto">Client : {{ $appointment->client->name }}</span>
                    @else
                        <span class="ml-auto">Agent : {{ $appointment->agent->name }}</span>
                    @endif
                </div>

                @if($appointment->message)
                <p class="text-[10px] text-dark-dim font-mono leading-relaxed border-t border-dark-border pt-2">
                    {{ $appointment->message }}
                </p>
                @endif

                {{-- Actions selon le rôle --}}
                <div class="flex gap-2 border-t border-dark-border pt-2">

                    {{-- Agent / Admin : changer le statut --}}
                    @if((auth()->user()->isAgent() && $appointment->agent_id === auth()->id())
                        || auth()->user()->isAdmin())

                        @if($appointment->status === 'pending')
                        <form method="POST" action="{{ route('appointments.status', $appointment) }}">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="confirmed">
                            <button type="submit"
                                    class="text-[10px] border border-green-800 text-green-400 hover:bg-green-950 px-3 py-1 rounded-sm transition-colors font-mono tracking-wider">
                                CONFIRMER
                            </button>
                        </form>
                        <form method="POST" action="{{ route('appointments.status', $appointment) }}">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="refused">
                            <button type="submit"
                                    class="text-[10px] border border-red-800 text-red-400 hover:bg-red-950 px-3 py-1 rounded-sm transition-colors font-mono tracking-wider">
                                REFUSER
                            </button>
                        </form>
                        @endif

                        @if($appointment->status === 'confirmed')
                        <form method="POST" action="{{ route('appointments.status', $appointment) }}">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="completed">
                            <button type="submit"
                                    class="text-[10px] border border-dark-border text-dark-muted hover:border-dark-border2 hover:text-dark-text px-3 py-1 rounded-sm transition-colors font-mono tracking-wider">
                                MARQUER TERMINÉ
                            </button>
                        </form>
                        @endif
                    @endif

                    {{-- Client : annuler si pending --}}
                    @if(auth()->user()->isClient() || auth()->user()->isStudent() || auth()->user()->isOwner())
                        @if($appointment->status === 'pending')
                        <form method="POST" action="{{ route('appointments.destroy', $appointment) }}">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="text-[10px] border border-dark-border text-dark-muted hover:border-red-800 hover:text-red-400 px-3 py-1 rounded-sm transition-colors font-mono tracking-wider"
                                    onclick="return confirm('Annuler ce rendez-vous ?')">
                                ANNULER
                            </button>
                        </form>
                        @endif
                    @endif

                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($appointments->hasPages())
        <div class="flex justify-center gap-1 pt-2">
            @if($appointments->onFirstPage())
                <span class="px-3 py-1.5 text-[10px] text-dark-dim border border-dark-border rounded-sm">←</span>
            @else
                <a href="{{ $appointments->previousPageUrl() }}"
                   class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border rounded-sm hover:border-dark-border2 hover:text-dark-text transition-colors">←</a>
            @endif

            @foreach($appointments->getUrlRange(max(1, $appointments->currentPage()-2), min($appointments->lastPage(), $appointments->currentPage()+2)) as $page => $url)
                @if($page == $appointments->currentPage())
                    <span class="px-3 py-1.5 text-[10px] text-white border border-indigo-700 bg-indigo-950 rounded-sm">{{ $page }}</span>
                @else
                    <a href="{{ $url }}"
                       class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border rounded-sm hover:border-dark-border2 hover:text-dark-text transition-colors">{{ $page }}</a>
                @endif
            @endforeach

            @if($appointments->hasMorePages())
                <a href="{{ $appointments->nextPageUrl() }}"
                   class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border rounded-sm hover:border-dark-border2 hover:text-dark-text transition-colors">→</a>
            @else
                <span class="px-3 py-1.5 text-[10px] text-dark-dim border border-dark-border rounded-sm">→</span>
            @endif
        </div>
        @endif
    @endif

</div>
@endsection
