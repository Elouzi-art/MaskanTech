@if ($paginator->hasPages())
<div class="flex items-center gap-1.5 text-[10px] font-mono tracking-wider">

    {{-- Précédent --}}
    @if ($paginator->onFirstPage())
        <span class="px-3 py-1.5 border border-dark-border text-dark-dim rounded-sm">← PRÉC</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}"
           class="px-3 py-1.5 border border-dark-border text-dark-muted hover:border-dark-dim hover:text-dark-text rounded-sm transition-colors">
            ← PRÉC
        </a>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="px-2 py-1.5 text-dark-dim">{{ $element }}</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="px-3 py-1.5 bg-indigo-950 border border-indigo-700 text-indigo-300 rounded-sm">{{ $page }}</span>
                @else
                    <a href="{{ $url }}"
                       class="px-3 py-1.5 border border-dark-border text-dark-muted hover:border-dark-dim hover:text-dark-text rounded-sm transition-colors">
                        {{ $page }}
                    </a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Suivant --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"
           class="px-3 py-1.5 border border-dark-border text-dark-muted hover:border-dark-dim hover:text-dark-text rounded-sm transition-colors">
            SUIV →
        </a>
    @else
        <span class="px-3 py-1.5 border border-dark-border text-dark-dim rounded-sm">SUIV →</span>
    @endif

    <span class="ml-3 text-dark-dim">
        {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} sur {{ $paginator->total() }}
    </span>

</div>
@endif
