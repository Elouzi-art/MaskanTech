{{-- Composant: badge de statut --}}
{{-- Usage: <x-status-badge status="disponible" /> --}}
@php
$styles = [
    'disponible'       => 'bg-green-950 text-green-400 border border-green-800',
    'vendu'            => 'bg-red-950 text-red-400 border border-red-800',
    'loué'             => 'bg-blue-950 text-blue-400 border border-blue-800',
    'en_construction'  => 'bg-amber-950 text-amber-400 border border-amber-800',
    'en attente'       => 'bg-yellow-950 text-yellow-400 border border-yellow-800',
    'confirmé'         => 'bg-green-950 text-green-400 border border-green-800',
    'refusé'           => 'bg-red-950 text-red-400 border border-red-800',
    'terminé'          => 'bg-gray-900 text-gray-400 border border-gray-700',
    'admin'            => 'bg-purple-950 text-purple-400 border border-purple-800',
    'agent'            => 'bg-blue-950 text-blue-400 border border-blue-800',
    'client'           => 'bg-teal-950 text-teal-400 border border-teal-800',
    'actif'            => 'bg-green-950 text-green-400 border border-green-800',
];
$class = $styles[strtolower($status)] ?? 'bg-gray-900 text-gray-400 border border-gray-700';
@endphp
<span class="text-[9px] px-2 py-0.5 rounded-sm tracking-wider font-mono {{ $class }}">
    {{ strtoupper($status) }}
</span>
