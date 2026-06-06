@extends('layouts.admin')
@section('title', 'Tableau de bord')

@section('content')
<div class="p-4 flex flex-col gap-4">

    <div>
        <h1 class="text-sm font-medium text-white tracking-widest">TABLEAU DE BORD</h1>
        <p class="text-[10px] text-dark-muted tracking-wider mt-0.5">Vue d'ensemble de la plateforme</p>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
        @php
        $cards = [
            ['label'=>'Utilisateurs',        'value'=>$stats['users'],      'color'=>'text-white',      'border'=>'border-dark-border'],
            ['label'=>'Annonces totales',     'value'=>$stats['properties'], 'color'=>'text-white',      'border'=>'border-dark-border'],
            ['label'=>'En attente validation','value'=>$stats['pending'],    'color'=>'text-orange-400', 'border'=>'border-orange-900'],
            ['label'=>'Propriétaires',        'value'=>$stats['owners'],     'color'=>'text-yellow-400', 'border'=>'border-dark-border'],
            ['label'=>'Non vérifiés',         'value'=>$stats['unverified'], 'color'=>'text-red-400',    'border'=>'border-red-900'],
            ['label'=>'Messages non lus',     'value'=>$stats['contacts'],   'color'=>'text-blue-400',   'border'=>'border-dark-border'],
        ];
        @endphp

        @foreach($cards as $card)
        <div class="bg-dark-card border {{ $card['border'] }} rounded-sm p-3 flex flex-col gap-1">
            <p class="text-[9px] text-dark-dim tracking-[.15em] uppercase">{{ $card['label'] }}</p>
            <p class="text-2xl font-bold {{ $card['color'] }} font-mono">{{ $card['value'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Actions rapides --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div class="bg-dark-card border border-dark-border rounded-sm p-3">
            <p class="text-[9px] text-dark-dim tracking-[.15em] uppercase mb-2">Actions rapides</p>
            <div class="flex flex-col gap-1.5">
                <a href="{{ route('admin.properties', ['status' => 'pending']) }}"
                   class="flex items-center justify-between px-3 py-2 bg-dark-card3 border border-orange-900 rounded-sm hover:border-orange-700 transition-colors group">
                    <span class="text-[11px] text-dark-muted group-hover:text-white tracking-wider transition-colors">Valider les annonces en attente</span>
                    <span class="text-[9px] text-orange-400">{{ $stats['pending'] }} →</span>
                </a>
                <a href="{{ route('admin.users', ['role' => 'owner']) }}"
                   class="flex items-center justify-between px-3 py-2 bg-dark-card3 border border-yellow-900 rounded-sm hover:border-yellow-700 transition-colors group">
                    <span class="text-[11px] text-dark-muted group-hover:text-white tracking-wider transition-colors">Vérifier les propriétaires</span>
                    <span class="text-[9px] text-yellow-400">{{ $stats['unverified'] }} →</span>
                </a>
                <a href="{{ route('admin.contacts') }}"
                   class="flex items-center justify-between px-3 py-2 bg-dark-card3 border border-dark-border rounded-sm hover:border-dark-border2 transition-colors group">
                    <span class="text-[11px] text-dark-muted group-hover:text-white tracking-wider transition-colors">Lire les messages de contact</span>
                    <span class="text-[9px] text-blue-400">{{ $stats['contacts'] }} →</span>
                </a>
            </div>
        </div>
        <div class="bg-dark-card border border-dark-border rounded-sm p-3">
            <p class="text-[9px] text-dark-dim tracking-[.15em] uppercase mb-2">Système</p>
            <div class="flex flex-col gap-2">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] text-dark-muted">Statut</span>
                    <div class="flex items-center gap-1.5">
                        <div class="w-1.5 h-1.5 rounded-full bg-green-500 pulse-dot"></div>
                        <span class="text-[10px] text-green-400">OPÉRATIONNEL</span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-[10px] text-dark-muted">Administrateur</span>
                    <span class="text-[10px] text-white">{{ auth()->user()->name }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-[10px] text-dark-muted">Heure</span>
                    <span class="text-[10px] text-dark-text">{{ now()->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
.pulse-dot { animation: pulse 2s infinite; }
@keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.3} }
</style>
@endsection