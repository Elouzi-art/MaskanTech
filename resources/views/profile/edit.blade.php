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

</div>
@endsection