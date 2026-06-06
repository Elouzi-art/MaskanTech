@extends('layouts.admin')
@section('title', 'Profil — ' . $user->name)

@section('content')
<div class="p-4 flex flex-col gap-4 max-w-3xl">

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.users') }}" class="text-[10px] text-dark-muted hover:text-dark-text transition-colors tracking-wider">← RETOUR</a>
        <span class="text-dark-dim">/</span>
        <p class="text-[10px] text-dark-dim tracking-wider">{{ $user->name }}</p>
    </div>

    {{-- Header utilisateur --}}
    <div class="bg-dark-card border border-dark-border rounded-sm p-4 flex items-start justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-sm bg-dark-card3 border border-dark-border flex items-center justify-center text-lg font-bold text-white">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </div>
            <div>
                <div class="flex items-center gap-2 flex-wrap">
                    <h1 class="text-sm font-medium text-white tracking-wider">{{ $user->name }}</h1>
                    @if($user->is_verified)
                        <span class="text-[9px] bg-blue-950 text-blue-400 border border-blue-800 px-1.5 py-0.5 rounded-sm tracking-wider">✓ PROPRIÉTAIRE VÉRIFIÉ</span>
                    @endif
                    <span class="text-[9px] tracking-wider px-1.5 py-0.5 rounded-sm
                        @if($user->role === 'admin')   bg-red-950 text-red-400 border border-red-800
                        @elseif($user->role === 'agent')   bg-indigo-950 text-indigo-400 border border-indigo-800
                        @elseif($user->role === 'student') bg-blue-950 text-blue-400 border border-blue-800
                        @elseif($user->role === 'owner')   bg-yellow-950 text-yellow-400 border border-yellow-800
                        @else bg-dark-card3 text-dark-muted border border-dark-border @endif">
                        {{ $user->role_label }}
                    </span>
                </div>
                <p class="text-[10px] text-dark-muted mt-0.5">Inscrit le {{ $user->created_at->format('d/m/Y') }}</p>
            </div>
        </div>

        {{-- Actions vérification --}}
        @if($user->role === 'owner' && $user->id !== auth()->id())
        <div class="flex flex-col gap-2">
            @if(!$user->is_verified)
            <form method="POST" action="{{ route('admin.users.verify', $user) }}">
                @csrf @method('PATCH')
                <button type="submit"
                    class="px-3 py-1.5 text-[11px] text-blue-400 border border-blue-900 hover:border-blue-700 rounded-sm transition-colors tracking-wider w-full">
                    ✓ VÉRIFIER CE PROPRIÉTAIRE
                </button>
            </form>
            @else
            <div class="px-3 py-1.5 text-[11px] text-green-400 border border-green-900 rounded-sm text-center tracking-wider">
                ✓ Vérifié le {{ $user->verified_at?->format('d/m/Y') }}
            </div>
            <form method="POST" action="{{ route('admin.users.unverify', $user) }}">
                @csrf @method('PATCH')
                <button type="submit"
                    class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border hover:border-dark-border2 rounded-sm transition-colors tracking-wider w-full">
                    Retirer la vérification
                </button>
            </form>
            @endif
        </div>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

        {{-- Informations personnelles --}}
        <div class="bg-dark-card border border-dark-border rounded-sm p-3 flex flex-col gap-2">
            <p class="text-[9px] text-dark-dim tracking-[.15em] uppercase pb-1 border-b border-dark-border">Informations personnelles</p>
            @php
            $infos = [
                'Email'       => $user->email,
                'Téléphone'   => $user->phone ?? '—',
                'Adresse'     => $user->address ?? '—',
                'Université'  => $user->university ?? '—',
                'Filière'     => $user->field_of_study ?? '—',
                'Email vérifié' => $user->email_verified_at ? $user->email_verified_at->format('d/m/Y') : 'Non vérifié',
            ];
            @endphp
            @foreach($infos as $label => $value)
            <div class="flex items-start justify-between gap-2">
                <span class="text-[10px] text-dark-dim shrink-0">{{ $label }}</span>
                <span class="text-[10px] text-dark-text text-right">{{ $value }}</span>
            </div>
            @endforeach
        </div>

        {{-- Document CIN --}}
        <div class="bg-dark-card border border-dark-border rounded-sm p-3 flex flex-col gap-2">
            <p class="text-[9px] text-dark-dim tracking-[.15em] uppercase pb-1 border-b border-dark-border">Document d'identité (CIN)</p>
            @if($user->cin_document)
                @php
                    $ext = strtolower(pathinfo($user->cin_document, PATHINFO_EXTENSION));
                    $isImage = in_array($ext, ['jpg','jpeg','png','webp']);
                    $url = \Storage::url($user->cin_document);
                @endphp
                @if($isImage)
                    <a href="{{ $url }}" target="_blank" class="block">
                        <img src="{{ $url }}" alt="CIN" class="w-full rounded-sm border border-dark-border hover:border-indigo-700 transition-colors">
                    </a>
                @else
                    <a href="{{ $url }}" target="_blank"
                       class="flex items-center gap-2 px-3 py-2 bg-dark-card3 border border-dark-border rounded-sm hover:border-indigo-700 transition-colors group">
                        <svg class="w-4 h-4 text-dark-muted group-hover:text-indigo-400 transition-colors" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M4 1h6l4 4v10H4V1z"/><path d="M10 1v4h4"/>
                        </svg>
                        <span class="text-[11px] text-dark-muted group-hover:text-indigo-400 transition-colors tracking-wider">Voir le document</span>
                    </a>
                @endif
                <p class="text-[9px] text-dark-dim">Document téléversé</p>
            @else
                <div class="flex items-center justify-center py-6 border border-dashed border-dark-border rounded-sm">
                    <p class="text-[10px] text-dark-dim tracking-wider">Aucun document fourni</p>
                </div>
                @if($user->role === 'owner' && !$user->is_verified)
                    <p class="text-[9px] text-orange-400">⚠ Ce propriétaire n'a pas encore téléversé son CIN.</p>
                @endif
            @endif
        </div>
    </div>

    {{-- Annonces du propriétaire --}}
    @if($user->properties->count() > 0)
    <div class="bg-dark-card border border-dark-border rounded-sm overflow-hidden">
        <div class="px-3 py-2 border-b border-dark-border">
            <p class="text-[9px] text-dark-dim tracking-[.15em] uppercase">Annonces publiées ({{ $user->properties->count() }})</p>
        </div>
        <table class="w-full text-xs font-mono">
            <thead>
                <tr class="border-b border-dark-border bg-dark-card2">
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Titre</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Ville</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Prix</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Validation</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user->properties as $prop)
                <tr class="border-b border-dark-border hover:bg-dark-card3 transition-colors">
                    <td class="px-3 py-2">
                        <a href="{{ route('properties.show', $prop) }}"
                           class="text-dark-text hover:text-indigo-300 transition-colors text-[11px] truncate block max-w-[200px]">
                            {{ $prop->title }}
                        </a>
                    </td>
                    <td class="px-3 py-2 text-dark-muted text-[11px]">{{ $prop->city }}</td>
                    <td class="px-3 py-2 text-dark-text text-[11px]">{{ number_format($prop->price, 0, ',', ' ') }} MAD</td>
                    <td class="px-3 py-2">
                        @php $s = $prop->approval_status ?? 'pending'; @endphp
                        <span class="text-[9px] px-1.5 py-0.5 rounded-sm
                            @if($s === 'approved') bg-green-950 text-green-400 border border-green-800
                            @elseif($s === 'rejected') bg-red-950 text-red-400 border border-red-800
                            @else bg-orange-950 text-orange-400 border border-orange-800 @endif">
                            @if($s === 'approved') APPROUVÉE @elseif($s === 'rejected') REJETÉE @else EN ATTENTE @endif
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

</div>
@endsection