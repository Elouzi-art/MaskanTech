@extends('layouts.admin')
@section('title', 'Tableau de bord')

@section('content')
<div class="p-6 flex flex-col gap-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-sm font-medium text-white tracking-widest">TABLEAU DE BORD</h1>
            <p class="text-[10px] text-dark-muted tracking-wider mt-0.5">
                Vue globale de MaskanTech — {{ now()->translatedFormat('l d F Y') }}
            </p>
        </div>
        <a href="{{ route('admin.users') }}"
           class="text-[10px] text-indigo-400 hover:text-indigo-300 border border-indigo-900 hover:border-indigo-700 px-3 py-1.5 rounded-sm transition-colors tracking-wider">
            GÉRER LES UTILISATEURS →
        </a>
    </div>

    {{-- STATS LIGNE 1 --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        <div class="bg-dark-card border border-dark-border rounded-sm p-4">
            <p class="text-[9px] text-dark-dim tracking-[.15em] uppercase mb-2">Utilisateurs</p>
            <p class="text-2xl font-bold text-white">{{ $stats['users'] }}</p>
            <p class="text-[10px] text-dark-muted mt-1">{{ $stats['owners'] }} propriétaires</p>
        </div>
        <div class="bg-dark-card border border-dark-border rounded-sm p-4">
            <p class="text-[9px] text-dark-dim tracking-[.15em] uppercase mb-2">Annonces</p>
            <p class="text-2xl font-bold text-white">{{ $stats['properties'] }}</p>
            @if($stats['pending'] > 0)
                <p class="text-[10px] text-orange-400 mt-1">⚠ {{ $stats['pending'] }} en attente</p>
            @else
                <p class="text-[10px] text-green-400 mt-1">✓ Tout validé</p>
            @endif
        </div>
        <div class="bg-dark-card border border-dark-border rounded-sm p-4">
            <p class="text-[9px] text-dark-dim tracking-[.15em] uppercase mb-2">Prop. non vérifiés</p>
            <p class="text-2xl font-bold text-white">{{ $stats['unverified'] }}</p>
            @if($stats['unverified'] > 0)
                <p class="text-[10px] text-yellow-400 mt-1">⚠ À vérifier</p>
            @else
                <p class="text-[10px] text-green-400 mt-1">✓ Tous vérifiés</p>
            @endif
        </div>
        <div class="bg-dark-card border border-dark-border rounded-sm p-4">
            <p class="text-[9px] text-dark-dim tracking-[.15em] uppercase mb-2">Messages non lus</p>
            <p class="text-2xl font-bold text-white">{{ $stats['contacts'] }}</p>
            <p class="text-[10px] text-dark-muted mt-1">messages de contact</p>
        </div>
    </div>

    {{-- ALERTES ACTIVES --}}
    @if($stats['pending'] > 0 || $stats['unverified'] > 0)
    <div class="bg-dark-card border border-dark-border rounded-sm p-4 flex flex-col gap-2">
        <p class="text-[9px] text-dark-dim tracking-[.15em] uppercase mb-1">ACTIONS REQUISES</p>
        @if($stats['pending'] > 0)
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-orange-400"></span>
                <span class="text-[11px] text-dark-text">{{ $stats['pending'] }} annonce(s) en attente de validation</span>
            </div>
            <a href="{{ route('admin.properties') }}?status=pending"
               class="text-[10px] text-orange-400 hover:text-orange-300 tracking-wider transition-colors">VOIR →</a>
        </div>
        @endif
        @if($stats['unverified'] > 0)
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-yellow-400"></span>
                <span class="text-[11px] text-dark-text">{{ $stats['unverified'] }} propriétaire(s) non vérifiés</span>
            </div>
            <a href="{{ route('admin.users') }}?role=owner"
               class="text-[10px] text-yellow-400 hover:text-yellow-300 tracking-wider transition-colors">VOIR →</a>
        </div>
        @endif
    </div>
    @endif

    {{-- ANNONCES RÉCENTES --}}
    @php
        $recentProps = \App\Models\Property::with('user')->latest()->take(8)->get();
    @endphp
    <div class="bg-dark-card border border-dark-border rounded-sm overflow-hidden">
        <div class="px-4 py-3 border-b border-dark-border flex items-center justify-between">
            <p class="text-[9px] text-dark-dim tracking-[.15em] uppercase">Annonces récentes</p>
            <a href="{{ route('admin.properties') }}" class="text-[10px] text-indigo-400 hover:text-indigo-300 transition-colors tracking-wider">VOIR TOUT →</a>
        </div>
        <table class="w-full text-xs font-mono">
            <thead>
                <tr class="border-b border-dark-border bg-dark-card2">
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-4 py-2.5">Annonce</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-4 py-2.5">Propriétaire</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-4 py-2.5">Ville</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-4 py-2.5">Validation</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-4 py-2.5">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentProps as $prop)
                <tr class="border-b border-dark-border hover:bg-dark-card3 transition-colors">
                    <td class="px-4 py-3 text-[11px] text-dark-text">{{ Str::limit($prop->title, 35) }}</td>
                    <td class="px-4 py-3 text-[11px] text-dark-muted">{{ $prop->user->name ?? '—' }}</td>
                    <td class="px-4 py-3 text-[11px] text-dark-muted">{{ $prop->city }}</td>
                    <td class="px-4 py-3">
                        @php $s = $prop->approval_status ?? 'pending'; @endphp
                        @if($s === 'approved')
                            <span class="text-[9px] bg-green-950 text-green-400 border border-green-800 px-1.5 py-0.5 rounded-sm">APPROUVÉE</span>
                        @elseif($s === 'rejected')
                            <span class="text-[9px] bg-red-950 text-red-400 border border-red-800 px-1.5 py-0.5 rounded-sm">REJETÉE</span>
                        @else
                            <span class="text-[9px] bg-orange-950 text-orange-400 border border-orange-800 px-1.5 py-0.5 rounded-sm">EN ATTENTE</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.properties') }}"
                           class="text-[10px] text-indigo-400 hover:text-indigo-300 transition-colors tracking-wider">GÉRER</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-dark-muted text-[11px]">Aucune annonce.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PROPRIÉTAIRES NON VÉRIFIÉS --}}
    @if($stats['unverified'] > 0)
    @php
        $unverified = \App\Models\User::where('role','owner')->where('is_verified',false)->latest()->take(5)->get();
    @endphp
    <div class="bg-dark-card border border-dark-border rounded-sm overflow-hidden">
        <div class="px-4 py-3 border-b border-dark-border flex items-center justify-between">
            <p class="text-[9px] text-dark-dim tracking-[.15em] uppercase">Propriétaires à vérifier</p>
            <a href="{{ route('admin.users') }}?role=owner" class="text-[10px] text-yellow-400 hover:text-yellow-300 transition-colors tracking-wider">VOIR TOUT →</a>
        </div>
        <table class="w-full text-xs font-mono">
            <thead>
                <tr class="border-b border-dark-border bg-dark-card2">
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-4 py-2.5">Propriétaire</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-4 py-2.5">Email</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-4 py-2.5">Inscrit le</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-4 py-2.5">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($unverified as $owner)
                <tr class="border-b border-dark-border hover:bg-dark-card3 transition-colors">
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-sm bg-dark-card3 border border-dark-border flex items-center justify-center text-[9px] text-white shrink-0">
                                {{ strtoupper(substr($owner->name, 0, 2)) }}
                            </div>
                            <span class="text-[11px] text-dark-text">{{ $owner->name }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-[11px] text-dark-muted">{{ $owner->email }}</td>
                    <td class="px-4 py-3 text-[10px] text-dark-dim">{{ $owner->created_at->format('d/m/Y') }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.users.show', $owner) }}"
                           class="text-[10px] text-indigo-400 hover:text-indigo-300 transition-colors tracking-wider">VOIR PROFIL →</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

</div>
@endsection