{{-- Composant: carte d'événement dans le feed --}}
{{-- Usage: <x-feed-item :item="$item" /> --}}
@php
$severityMap = [
    'nouveau'    => ['label' => 'NOUVEAU',    'class' => 'text-yellow-400'],
    'vendu'      => ['label' => 'VENDU',      'class' => 'text-red-400'],
    'rdv'        => ['label' => 'RDV',        'class' => 'text-orange-400'],
    'message'    => ['label' => 'MESSAGE',    'class' => 'text-blue-400'],
    'favori'     => ['label' => 'FAVORI',     'class' => 'text-pink-400'],
    'loué'       => ['label' => 'LOUÉ',       'class' => 'text-teal-400'],
];
$sev = $severityMap[$item['type'] ?? 'nouveau'] ?? $severityMap['nouveau'];
@endphp

<div class="bg-dark-card2 border border-dark-border rounded-sm p-3 fade-in">
    <div class="flex justify-between items-center mb-1.5">
        <span class="text-[10px] text-dark-muted tracking-wider">{{ $item['id'] ?? 'evt_'.uniqid() }}</span>
        <span class="text-[10px] font-mono font-medium tracking-wider {{ $sev['class'] }}">{{ $sev['label'] }}</span>
    </div>
    <div class="text-[13px] text-dark-text font-medium mb-1.5 tracking-wide">
        {{ $item['title'] }}
    </div>
    <div class="flex gap-4 text-[10px] text-dark-muted">
        <span class="flex items-center gap-1">
            <svg class="w-2.5 h-2.5" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="6" cy="6" r="5"/><path d="M6 3v3l2 2"/>
            </svg>
            {{ $item['time'] ?? now()->format('H:i') }}
        </span>
        <span class="flex items-center gap-1">
            <svg class="w-2.5 h-2.5" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="6" cy="4" r="2"/><path d="M2 10c0-2.2 1.8-4 4-4s4 1.8 4 4"/>
            </svg>
            {{ $item['agent'] ?? 'Système' }}
        </span>
        @isset($item['city'])
        <span class="flex items-center gap-1">
            <svg class="w-2.5 h-2.5" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M6 1C4.3 1 3 2.3 3 4c0 2.5 3 7 3 7s3-4.5 3-7c0-1.7-1.3-3-3-3z"/>
                <circle cx="6" cy="4" r="1"/>
            </svg>
            {{ $item['city'] }}
        </span>
        @endisset
    </div>
</div>
