{{-- Composant: carte métrique --}}
{{-- Usage: <x-metric-card label="Biens publiés" value="147" sub="total" /> --}}
<div class="bg-dark-card3 border border-dark-border rounded-sm p-2.5">
    <div class="text-[9px] tracking-[.1em] text-dark-dim uppercase flex items-center gap-1">
        @isset($icon)
            {!! $icon !!}
        @endisset
        {{ $label }}
    </div>
    <div class="text-xl font-bold text-white mt-1">{{ $value }}</div>
    @isset($sub)
        <div class="text-[10px] text-dark-dim mt-0.5">{{ $sub }}</div>
    @endisset
</div>
