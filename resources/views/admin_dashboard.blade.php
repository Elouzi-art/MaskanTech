@extends('admin_layout')

@section('title','Dashboard - Admin')
@section('section_title','Dashboard')
@section('section_sub','Statistiques & modération')

@section('content')
    <h1 class="text-2xl font-bold mb-2">Tableau de bord</h1>
    <p class="text-sm text-gray-600 mb-6">Vue d'ensemble des annonces, utilisateurs et vérifications.</p>

    <h2 class="text-xl font-semibold mb-3">Annonces en attente</h2>
    <table class="w-full text-left border-collapse mb-6">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Titre</th>
                <th class="p-2">Propriétaire</th>
                <th class="p-2">Ville</th>
                <th class="p-2">Prix</th>
                <th class="p-2">Date</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="p-2">Exemple: Studio économique</td>
                <td class="p-2">Ali Ben</td>
                <td class="p-2">Casablanca</td>
                <td class="p-2">1 500 MAD</td>
                <td class="p-2">2026-04-01</td>
                <td class="p-2 space-x-2">
                    <button class="px-3 py-1 bg-green-500 text-white rounded">Valider ✓</button>
                    <button class="px-3 py-1 bg-red-500 text-white rounded">Refuser ✗</button>
                    <a href="#" class="px-3 py-1 border rounded">Voir</a>
                </td>
            </tr>
        </tbody>
    </table>

@endsection