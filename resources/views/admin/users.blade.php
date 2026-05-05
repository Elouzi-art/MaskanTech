@extends('layouts.app')
@section('title', 'Gestion des utilisateurs')

@section('content')
<div class="p-3 flex flex-col gap-3">

    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-base font-medium text-white tracking-wider">Utilisateurs</h1>
            <p class="text-[10px] text-dark-muted tracking-wider mt-0.5">{{ $users->total() }} compte(s) enregistré(s)</p>
        </div>
        {{-- Filtre rôle --}}
        <form method="GET" action="{{ route('admin.users') }}" class="flex gap-2 items-center">
            <select name="role" onchange="this.form.submit()"
                    class="bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-1.5 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                <option value="">Tous les rôles</option>
                <option value="admin"   {{ request('role') === 'admin'   ? 'selected' : '' }}>Admin</option>
                <option value="agent"   {{ request('role') === 'agent'   ? 'selected' : '' }}>Agent</option>
                <option value="client"  {{ request('role') === 'client'  ? 'selected' : '' }}>Locataire</option>
                <option value="student" {{ request('role') === 'student' ? 'selected' : '' }}>Étudiant</option>
                <option value="owner"   {{ request('role') === 'owner'   ? 'selected' : '' }}>Propriétaire</option>
            </select>
        </form>
    </div>

    <div class="bg-dark-card border border-dark-border rounded-sm overflow-hidden">
        <table class="w-full text-xs font-mono">
            <thead>
                <tr class="border-b border-dark-border">
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Utilisateur</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Email</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Rôle</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Inscrit</th>
                    <th class="text-left text-[9px] text-dark-dim tracking-[.15em] uppercase px-3 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                <tr class="border-b border-dark-border hover:bg-dark-card3 transition-colors">
                    <td class="px-3 py-2">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-sm bg-dark-card3 border border-dark-border flex items-center justify-center text-[10px] text-white shrink-0">
                                {{ strtoupper(substr($u->name, 0, 2)) }}
                            </div>
                            <span class="text-dark-text">{{ $u->name }}</span>
                        </div>
                    </td>
                    <td class="px-3 py-2 text-dark-muted">{{ $u->email }}</td>
                    <td class="px-3 py-2">
                        <span class="text-[9px] tracking-wider px-2 py-0.5 rounded-sm
                            @if($u->role === 'admin')   bg-red-950 text-red-400 border border-red-800
                            @elseif($u->role === 'agent')   bg-indigo-950 text-indigo-400 border border-indigo-800
                            @elseif($u->role === 'student') bg-blue-950 text-blue-400 border border-blue-800
                            @elseif($u->role === 'owner')   bg-yellow-950 text-yellow-400 border border-yellow-800
                            @else bg-dark-card3 text-dark-muted border border-dark-border
                            @endif">
                            {{ $u->role_label }}
                        </span>
                    </td>
                    <td class="px-3 py-2 text-dark-muted text-[10px]">{{ $u->created_at->format('d/m/Y') }}</td>
                    <td class="px-3 py-2">
                        @if($u->id !== auth()->id())
                        <div class="flex items-center gap-2" x-data="{ open: false }">
                            {{-- Changer rôle --}}
                            <button @click="open = !open"
                                    class="text-[10px] text-dark-muted hover:text-dark-text transition-colors tracking-wider">
                                RÔLE ▾
                            </button>
                            <div x-show="open" @click.away="open = false"
                                 class="absolute z-10 bg-dark-card border border-dark-border rounded-sm mt-1 w-36 fade-in">
                                @foreach(['admin' => 'Admin', 'agent' => 'Agent', 'client' => 'Locataire', 'student' => 'Étudiant', 'owner' => 'Propriétaire'] as $role => $label)
                                <form method="POST" action="{{ route('admin.users.role', $u) }}">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="role" value="{{ $role }}">
                                    <button type="submit"
                                            class="w-full text-left px-3 py-1.5 text-[10px] text-dark-muted hover:text-dark-text hover:bg-dark-card3 transition-colors {{ $u->role === $role ? 'text-white' : '' }}">
                                        {{ $label }}
                                    </button>
                                </form>
                                @endforeach
                            </div>

                            {{-- Supprimer --}}
                            <form method="POST" action="{{ route('admin.users.destroy', $u) }}">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Supprimer {{ $u->name }} ?')"
                                        class="text-[10px] text-red-400 hover:text-red-300 transition-colors tracking-wider">
                                    ✕
                                </button>
                            </form>
                        </div>
                        @else
                        <span class="text-[10px] text-dark-dim">—</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-3 py-8 text-center text-dark-muted text-[11px] tracking-wider">Aucun utilisateur trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
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
