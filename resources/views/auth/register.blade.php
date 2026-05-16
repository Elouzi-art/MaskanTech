@extends('admin_layout')

@section('title','Inscription - MaskanTech')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow rounded-lg p-8">
        <h2 class="text-2xl font-bold mb-2">Créer un compte</h2>
        <p class="text-sm text-gray-500 mb-6">Rejoignez MaskanTech en tant que locataire ou propriétaire.</p>

        @if($errors->any())
            <div class="mb-4 text-red-600">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/register" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Prénom</label>
                    <input name="prenom" type="text" required class="input w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Nom</label>
                    <input name="nom" type="text" required class="input w-full">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input name="email" type="email" required class="input w-full">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Mot de passe</label>
                    <input name="password" type="password" required class="input w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Téléphone</label>
                    <input name="telephone" type="text" class="input w-full">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Vous êtes</label>
                <select name="type" class="input w-full">
                    <option value="locataire">Locataire</option>
                    <option value="proprietaire">Propriétaire</option>
                </select>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="btn-primary">S'inscrire</button>
                <a href="/" class="text-sm text-gray-600">Retour</a>
            </div>
        </form>
    </div>
</div>
@endsection
