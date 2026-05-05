{{-- resources/views/auth/login.blade.php --}}
<x-guest-layout>

<div class="flex flex-col gap-5">

    <div class="text-center mb-1">
        <p class="text-[9px] tracking-[.2em] uppercase mb-1" style="color:#444;font-family:'Courier New',monospace">Authentification</p>
        <h1 class="text-base font-medium text-white tracking-wider" style="font-family:'Courier New',monospace">CONNEXION</h1>
    </div>

    @if (session('status'))
        <div style="background:#052e16;border:1px solid #166534;color:#4ade80" class="text-xs px-3 py-2 rounded-sm tracking-wide" style="font-family:'Courier New',monospace">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-3">
        @csrf

        <div>
            <label class="block text-[9px] tracking-[.15em] uppercase mb-1.5" style="color:#444;font-family:'Courier New',monospace">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                   style="background:#1a1a1a;border:1px solid {{ $errors->has('email') ? '#b91c1c' : '#222' }};color:#d0d0d0;font-family:'Courier New',monospace"
                   class="w-full text-xs px-3 py-2.5 rounded-sm focus:outline-none"
                   placeholder="exemple@email.com">
            @error('email')
                <p class="text-xs mt-1" style="color:#f87171;font-family:'Courier New',monospace">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-[9px] tracking-[.15em] uppercase mb-1.5" style="color:#444;font-family:'Courier New',monospace">Mot de passe</label>
            <input type="password" name="password" required
                   style="background:#1a1a1a;border:1px solid {{ $errors->has('password') ? '#b91c1c' : '#222' }};color:#d0d0d0;font-family:'Courier New',monospace"
                   class="w-full text-xs px-3 py-2.5 rounded-sm focus:outline-none">
            @error('password')
                <p class="text-xs mt-1" style="color:#f87171;font-family:'Courier New',monospace">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between" style="font-family:'Courier New',monospace">
            <label class="flex items-center gap-2 text-xs cursor-pointer" style="color:#666">
                <input type="checkbox" name="remember" class="accent-indigo-500">
                Se souvenir de moi
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-xs" style="color:#818cf8;font-family:'Courier New',monospace">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        <button type="submit"
                style="background:#1e1b4b;border:1px solid #4338ca;color:#a5b4fc;font-family:'Courier New',monospace"
                class="w-full text-xs py-3 rounded-sm tracking-widest mt-1 hover:opacity-90 transition-opacity">
            SE CONNECTER
        </button>
    </form>

    <p class="text-center text-xs tracking-wider" style="color:#666;font-family:'Courier New',monospace">
        Pas encore de compte ?
        <a href="{{ route('register') }}" style="color:#818cf8;font-family:'Courier New',monospace" class="ml-1">
            S'inscrire
        </a>
    </p>

</div>
</x-guest-layout>
