@extends('layouts.admin')
@section('title', 'Utilisateurs')

@section('content')
<div class="p-4 flex flex-col gap-4">

    <div class="flex items-center justify-between gap-3">
        <div>
            <h1 class="text-sm font-medium text-white tracking-widest">UTILISATEURS</h1>
            <p class="text-[10px] text-dark-muted tracking-wider mt-0.5">{{ $users->total() }} compte(s) enregistré(s)</p>
        </div>
        <form method="GET" action="{{ route('admin.users') }}" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..."
                class="bg-dark-card3 border border-dark-border text-dark-text text-[11px] px-2.5 py-1.5 rounded-sm focus:outline-none focus:border-indigo-700 font-mono w-36 placeholder-dark-dim tracking-wider">
            <select name="role" onchange="this.form.submit()"
                class="bg-dark-card3 border border-dark-border text-dark-text text-[11px] px-2.5 py-1.5 rounded-sm focus:outline-none focus:border-indigo-700 font-mono tracking-wider">
                <option value="">Tous les rôles</option>
                <option value="admin"   {{ request('role') === 'admin'   ? 'selected' : '' }}>Admin</option>
                <option value="owner"   {{ request('role') === 'owner'   ? 'selected' : '' }}>Propriétaire</option>
                <option value="tenant"  {{ request('role') === 'tenant'  ? 'selected' : '' }}>Locataire</option>
                <option value="student" {{ request('role') === 'student' ? 'selected' : '' }}>Étudiant</option>
                <option value="agent"   {{ request('role') === 'agent'   ? 'selected' : '' }}>Agent</option>
            </select>
        </form>
    </div>

    <div class="bg-dark-card border border-dark-border rounded-sm overflow-hidden">
        <table class="w-full text-xs font-mono">
            <thead>
                <tr class="border-b border-dark-border bg-dark-card2">
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2.5">Utilisateur</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2.5">Email</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2.5">Rôle</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2.5">Vérifié</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2.5">Inscrit</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2.5">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                <tr class="border-b border-dark-border hover:bg-dark-card3 transition-colors">
                    <td class="px-3 py-2.5">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-sm bg-dark-card3 border border-dark-border flex items-center justify-center text-[10px] text-white shrink-0">
                                {{ strtoupper(substr($u->name, 0, 2)) }}
                            </div>
                            <div>
                                <div class="flex items-center gap-1">
                                    <span class="text-dark-text text-[11px]">{{ $u->name }}</span>
                                    @if($u->is_verified)
                                        <span class="text-[9px] bg-blue-950 text-blue-400 border border-blue-800 px-1 py-0.5 rounded-sm tracking-wider">✓ VÉRIFIÉ</span>
                                    @endif
                                </div>
                                @if($u->phone)
                                    <p class="text-[9px] text-dark-dim">{{ $u->phone }}</p>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-3 py-2.5 text-dark-muted text-[11px]">{{ $u->email }}</td>
                    <td class="px-3 py-2.5">
                        <span class="text-[9px] tracking-wider px-1.5 py-0.5 rounded-sm
                            @if($u->role === 'admin')   bg-red-950 text-red-400 border border-red-800
                            @elseif($u->role === 'agent')   bg-indigo-950 text-indigo-400 border border-indigo-800
                            @elseif($u->role === 'student') bg-blue-950 text-blue-400 border border-blue-800
                            @elseif($u->role === 'owner')   bg-yellow-950 text-yellow-400 border border-yellow-800
                            @else bg-dark-card3 text-dark-muted border border-dark-border @endif">
                            {{ $u->role_label }}
                        </span>
                    </td>
                    <td class="px-3 py-2.5">
                        @if($u->role === 'owner')
                            @if($u->is_verified)
                                <span class="text-[9px] text-green-400">✓ {{ $u->verified_at?->format('d/m/Y') }}</span>
                            @else
                                <span class="text-[9px] text-yellow-400">Non vérifié</span>
                            @endif
                        @else
                            <span class="text-[9px] text-dark-dim">—</span>
                        @endif
                    </td>
                    <td class="px-3 py-2.5 text-dark-muted text-[10px]">{{ $u->created_at->format('d/m/Y') }}</td>
                    <td class="px-3 py-2.5">
                        <div class="flex items-center gap-2 flex-wrap">
                            {{-- Voir détail --}}
                            <a href="{{ route('admin.users.show', $u) }}"
                               class="text-[10px] text-indigo-400 hover:text-indigo-300 transition-colors tracking-wider">DÉTAIL</a>

                            @if($u->id !== auth()->id())
                                {{-- Vérifier / Dévérifier propriétaire uniquement --}}
                                @if($u->role === 'owner')
                                    @if(!$u->is_verified)
                                    <form method="POST" action="{{ route('admin.users.verify', $u) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="text-[10px] text-green-400 hover:text-green-300 transition-colors tracking-wider">VÉRIFIER</button>
                                    </form>
                                    @else
                                    <form method="POST" action="{{ route('admin.users.unverify', $u) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="text-[10px] text-dark-muted hover:text-dark-text transition-colors tracking-wider">RETIRER</button>
                                    </form>
                                    @endif
                                @endif

                                {{-- Supprimer --}}
                                <form method="POST" action="{{ route('admin.users.destroy', $u) }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Supprimer {{ $u->name }} ?')"
                                        class="text-[10px] text-red-400 hover:text-red-300 transition-colors">✕</button>
                                </form>
                            @else
                                <span class="text-[10px] text-dark-dim">Vous</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-3 py-10 text-center text-dark-muted text-[11px] tracking-wider">Aucun utilisateur trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
    <div class="flex justify-center gap-1">
        @if(!$users->onFirstPage())
            <a href="{{ $users->previousPageUrl() }}" class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border rounded-sm hover:border-dark-border2 hover:text-dark-text transition-colors">←</a>
        @endif
        @if($users->hasMorePages())
            <a href="{{ $users->nextPageUrl() }}" class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border rounded-sm hover:border-dark-border2 hover:text-dark-text transition-colors">→</a>
        @endif
    </div>
    @endif

</div>
@endsection