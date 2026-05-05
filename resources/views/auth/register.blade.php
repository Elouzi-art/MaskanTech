{{-- resources/views/auth/register.blade.php --}}
<x-guest-layout>

<div class="flex flex-col gap-5">

    {{-- En-tête --}}
    <div class="text-center mb-1">
        <p class="text-[9px] tracking-[.2em] text-dark-dim uppercase mb-1">Créer un compte</p>
        <h1 class="text-base font-medium text-white tracking-wider">INSCRIPTION</h1>
    </div>

    <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-3">
        @csrf

        {{-- Nom --}}
        <div>
            <label class="block text-[9px] tracking-[.15em] text-dark-dim uppercase mb-1.5">Nom complet</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus
                   class="w-full bg-dark-card3 border @error('name') border-red-700 @else border-dark-border @enderror text-dark-text text-xs px-3 py-2.5 rounded-sm focus:outline-none focus:border-indigo-700 font-mono placeholder-dark-dim"
                   placeholder="Votre nom">
            @error('name')
                <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label class="block text-[9px] tracking-[.15em] text-dark-dim uppercase mb-1.5">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full bg-dark-card3 border @error('email') border-red-700 @else border-dark-border @enderror text-dark-text text-xs px-3 py-2.5 rounded-sm focus:outline-none focus:border-indigo-700 font-mono placeholder-dark-dim"
                   placeholder="exemple@email.com">
            @error('email')
                <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Rôle — NOUVEAU ─────────────────────────────── --}}
        <div>
            <label class="block text-[9px] tracking-[.15em] text-dark-dim uppercase mb-1.5">Je suis</label>
            <div class="grid grid-cols-3 gap-1.5">
                @foreach([
                    'client'  => ['label' => 'Locataire',    'desc' => 'Je cherche un logement'],
                    'student' => ['label' => 'Étudiant',     'desc' => 'Je cherche un logement étudiant'],
                    'owner'   => ['label' => 'Propriétaire', 'desc' => 'Je loue mon bien'],
                ] as $val => $info)
                <label class="relative cursor-pointer">
                    <input type="radio" name="role" value="{{ $val }}"
                           {{ old('role', 'client') === $val ? 'checked' : '' }}
                           class="peer sr-only">
                    <div class="border border-dark-border peer-checked:border-indigo-600 peer-checked:bg-indigo-950 rounded-sm p-2 text-center transition-colors hover:border-dark-dim">
                        <p class="text-[11px] text-dark-text peer-checked:text-indigo-300 font-medium">{{ $info['label'] }}</p>
                        <p class="text-[9px] text-dark-dim mt-0.5 leading-tight">{{ $info['desc'] }}</p>
                    </div>
                </label>
                @endforeach
            </div>
            @error('role')
                <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Mot de passe --}}
        <div>
            <label class="block text-[9px] tracking-[.15em] text-dark-dim uppercase mb-1.5">Mot de passe</label>
            <input type="password" name="password" required
                   class="w-full bg-dark-card3 border @error('password') border-red-700 @else border-dark-border @enderror text-dark-text text-xs px-3 py-2.5 rounded-sm focus:outline-none focus:border-indigo-700 font-mono"
                   autocomplete="new-password">
            @error('password')
                <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirmation --}}
        <div>
            <label class="block text-[9px] tracking-[.15em] text-dark-dim uppercase mb-1.5">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" required
                   class="w-full bg-dark-card3 border border-dark-border text-dark-text text-xs px-3 py-2.5 rounded-sm focus:outline-none focus:border-indigo-700 font-mono"
                   autocomplete="new-password">
        </div>

        <button type="submit"
                class="w-full text-xs bg-indigo-950 border border-indigo-700 text-indigo-300 hover:bg-indigo-900 py-3 rounded-sm transition-colors tracking-widest font-mono mt-1">
            CRÉER MON COMPTE
        </button>
    </form>

    <p class="text-center text-[10px] text-dark-muted tracking-wider">
        Déjà un compte ?
        <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 transition-colors ml-1">
            Se connecter
        </a>
    </p>

</div>
</x-guest-layout>
