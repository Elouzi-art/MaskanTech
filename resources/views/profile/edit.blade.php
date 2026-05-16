{{-- resources/views/profile/edit.blade.php --}}
@extends('layouts.app')
@section('title', 'Mon profil')

@section('content')
<div class="p-4 max-w-2xl mx-auto flex flex-col gap-4">

    <div>
        <h1 class="text-base font-medium text-white tracking-wider">Mon profil</h1>
        <p class="text-[10px] text-dark-muted tracking-wider mt-0.5">{{ auth()->user()->role_label }} — {{ auth()->user()->email }}</p>
    </div>

    {{-- Informations personnelles --}}
    <div class="bg-dark-card border border-dark-border rounded-sm p-4 flex flex-col gap-3">
        <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase border-b border-dark-border pb-3">
            Informations personnelles
        </div>

        @if (session('status') === 'profile-updated')
            <div class="text-green-400 text-[10px] tracking-wider border border-green-800 bg-green-950 px-3 py-2 rounded-sm">
                ✓ Profil mis à jour avec succès.
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" class="flex flex-col gap-3">
            @csrf
            @method('PATCH')

            <div>
                <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Nom complet</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                       class="w-full bg-dark-card3 border @error('name') border-red-700 @else border-dark-border @enderror text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                @error('name') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                       class="w-full bg-dark-card3 border @error('email') border-red-700 @else border-dark-border @enderror text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                @error('email') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Téléphone</label>
                <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                       class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
            </div>

            <div>
                <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Adresse</label>
                <input type="text" name="address" value="{{ old('address', auth()->user()->address) }}"
                       class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
            </div>

            {{-- Rôle (lecture seule) --}}
            <div>
                <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Rôle</label>
                <div class="bg-dark-card2 border border-dark-border text-dark-dim text-xs px-2.5 py-2 rounded-sm font-mono">
                    {{ auth()->user()->role_label }}
                </div>
            </div>

            <div class="flex justify-end pt-1">
                <button type="submit"
                        class="text-xs border border-indigo-700 text-indigo-400 hover:bg-indigo-950 px-4 py-2 rounded-sm transition-colors tracking-wider font-mono">
                    SAUVEGARDER
                </button>
            </div>
        </form>
    </div>

    {{-- Changer mot de passe --}}
    <div class="bg-dark-card border border-dark-border rounded-sm p-4 flex flex-col gap-3">
        <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase border-b border-dark-border pb-3">
            Changer le mot de passe
        </div>

        @if (session('status') === 'password-updated')
            <div class="text-green-400 text-[10px] tracking-wider border border-green-800 bg-green-950 px-3 py-2 rounded-sm">
                ✓ Mot de passe mis à jour.
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="flex flex-col gap-3">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Mot de passe actuel</label>
                <input type="password" name="current_password" autocomplete="current-password"
                       class="w-full bg-dark-card3 border @error('current_password', 'updatePassword') border-red-700 @else border-dark-border @enderror text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                @error('current_password', 'updatePassword') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Nouveau mot de passe</label>
                <input type="password" name="password" autocomplete="new-password"
                       class="w-full bg-dark-card3 border @error('password', 'updatePassword') border-red-700 @else border-dark-border @enderror text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
                @error('password', 'updatePassword') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" autocomplete="new-password"
                       class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-indigo-700 font-mono">
            </div>

            <div class="flex justify-end pt-1">
                <button type="submit"
                        class="text-xs border border-dark-border text-dark-muted hover:border-dark-border2 hover:text-dark-text px-4 py-2 rounded-sm transition-colors tracking-wider font-mono">
                    METTRE À JOUR
                </button>
            </div>
        </form>
    </div>

    {{-- Zone dangereuse --}}
    <div class="bg-dark-card border border-red-950 rounded-sm p-4 flex flex-col gap-3">
        <div class="text-[9px] tracking-[.15em] text-red-900 uppercase border-b border-red-950 pb-3">
            Zone dangereuse
        </div>
        <p class="text-[11px] text-dark-dim font-mono leading-relaxed">
            Une fois supprimé, toutes vos données seront définitivement effacées.
        </p>
        <div>
            <button onclick="document.getElementById('delete-modal').style.display='flex'"
                    class="text-xs border border-red-900 text-red-400 hover:bg-red-950 px-4 py-2 rounded-sm transition-colors tracking-wider font-mono">
                SUPPRIMER MON COMPTE
            </button>
        </div>
    </div>

</div>

{{-- Modal suppression --}}
<div id="delete-modal" x-data
     style="display:none"
     class="fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4">
    <div class="bg-dark-card border border-red-950 rounded-sm p-6 w-full max-w-sm flex flex-col gap-4">
        <div>
            <p class="text-sm text-white font-mono font-semibold">Confirmer la suppression</p>
            <p class="text-[11px] text-dark-dim font-mono mt-1 leading-relaxed">
                Entrez votre mot de passe pour confirmer la suppression définitive de votre compte.
            </p>
        </div>

        <form method="POST" action="{{ route('profile.destroy') }}" class="flex flex-col gap-3">
            @csrf
            @method('DELETE')

            <div>
                <label class="block text-[10px] text-dark-muted tracking-wider mb-1">Mot de passe</label>
                <input type="password" name="password" placeholder="Votre mot de passe"
                       class="w-full bg-dark-card3 border @error('password', 'userDeletion') border-red-700 @else border-dark-border @enderror text-dark-text text-xs px-2.5 py-2 rounded-sm focus:outline-none focus:border-red-700 font-mono">
                @error('password', 'userDeletion') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-2 justify-end">
                <button type="button"
                        onclick="document.getElementById('delete-modal').style.display='none'"
                        class="text-xs border border-dark-border text-dark-dim hover:text-dark-text px-4 py-2 rounded-sm transition-colors tracking-wider font-mono">
                    ANNULER
                </button>
                <button type="submit"
                        class="text-xs border border-red-900 text-red-400 hover:bg-red-950 px-4 py-2 rounded-sm transition-colors tracking-wider font-mono">
                    SUPPRIMER
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
