@extends('layouts.app')

@section('title', 'Dashboard Admin')

{{-- ═══ SIDEBAR ═══ --}}
@section('sidebar')

    <x-sidebar-label label="Agents actifs" />
    @foreach($activeAgents as $agent)
    <div class="flex justify-between items-center py-1.5 border-b border-dark-border/50 last:border-0">
        <span class="text-xs text-dark-muted">{{ $agent->name }}</span>
        <x-status-badge status="actif" />
    </div>
    @endforeach

    <x-sidebar-label label="Métriques plateforme" />
    <div class="grid grid-cols-2 gap-1.5">
        <x-metric-card label="Biens" :value="$stats['total_properties']" sub="publiés" />
        <x-metric-card label="Nouveaux" :value="$stats['new_this_month']" sub="ce mois" />
    </div>

    <x-sidebar-label label="Santé du système" />
    <div class="flex flex-col gap-0">
        @foreach([
            ['RDV en attente',    $stats['pending_appointments']],
            ['Messages non lus',  $stats['unread_messages']],
            ['Agents actifs',     $stats['active_agents']],
            ['Latence API',       '14ms'],
        ] as [$key, $val])
        <div class="flex justify-between py-1.5 border-b border-dark-border/40 last:border-0 text-xs">
            <span class="text-dark-muted">{{ $key }}</span>
            <span class="text-dark-text">{{ $val }}</span>
        </div>
        @endforeach
    </div>

    <x-sidebar-label label="Alertes actives" />
    @if($alerts->count() > 0)
        @foreach($alerts as $alert)
        <div class="bg-red-950 border border-red-800 rounded-sm p-2 text-[10px] text-red-400">
            {{ $alert->message }}
        </div>
        @endforeach
    @else
        <p class="text-[11px] text-dark-dim py-1">Aucune alerte active</p>
    @endif

@endsection

{{-- ═══ CONTENT ═══ --}}
@section('content')
<div class="p-3 flex flex-col gap-3 h-full">

    {{-- Header --}}
    <div class="flex justify-between items-end">
        <div>
            <h1 class="text-base font-medium text-white tracking-wider">Activité en direct</h1>
            <p class="text-[10px] text-dark-muted mt-0.5 tracking-wider">DASHBOARD ADMIN — {{ now()->format('d/m/Y H:i') }}</p>
        </div>
        <div class="flex flex-col items-end gap-2">
            <span class="text-[10px] text-dark-dim tracking-wider">Affichage des {{ $recentActivity->count() }} derniers événements</span>
            <div class="flex gap-1.5" x-data="{ filter: 'all' }">
                @foreach(['all' => 'Tout', 'nouveau' => 'Nouveaux', 'rdv' => 'RDV', 'vendu' => 'Vendus'] as $key => $label)
                <button
                    @click="filter = '{{ $key }}'; filterFeed('{{ $key }}')"
                    :class="filter === '{{ $key }}' ? 'border-indigo-600 text-indigo-300 bg-indigo-950' : 'border-dark-border2 text-dark-muted'"
                    class="border text-[10px] px-3 py-1 rounded-sm tracking-wider hover:border-dark-dim transition-colors font-mono">
                    {{ $label }}
                </button>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Stats globales --}}
    <div class="grid grid-cols-4 gap-2">
        @foreach([
            ['label' => 'Total biens',    'value' => $stats['total_properties'],   'sub' => 'publiés'],
            ['label' => 'Utilisateurs',   'value' => $stats['total_users'],        'sub' => 'inscrits'],
            ['label' => 'RDV ce mois',    'value' => $stats['appointments_month'], 'sub' => 'visites'],
            ['label' => 'Logements loués', 'value' => $stats['rented_properties'],  'sub' => 'en location'],
        ] as $m)
        <x-metric-card :label="$m['label']" :value="$m['value']" :sub="$m['sub']" />
        @endforeach
    </div>

    {{-- Graphique + Feed --}}
    <div class="grid grid-cols-5 gap-3 flex-1">

        {{-- Graphique des ventes --}}
        <div class="col-span-2 bg-dark-card border border-dark-border rounded-sm p-3">
            <div class="text-[9px] tracking-[.15em] text-dark-dim uppercase mb-3">Biens publiés par mois</div>
            <canvas id="salesChart" height="200"></canvas>
        </div>

        {{-- Feed activités --}}
        <div class="col-span-3 flex flex-col gap-2 overflow-y-auto" id="feed-container" style="max-height: 480px;">
            @foreach($recentActivity as $item)
                <x-feed-item :item="$item" />
            @endforeach
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
const ctx = document.getElementById('salesChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($chartLabels),
        datasets: [{
            label: 'Biens publiés',
            data: @json($chartData),
            backgroundColor: '#1e1e3a',
            borderColor: '#4f46e5',
            borderWidth: 1,
            borderRadius: 2,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: '#141414',
                borderColor: '#222',
                borderWidth: 1,
                titleColor: '#d0d0d0',
                bodyColor: '#888',
                titleFont: { family: 'Courier New', size: 11 },
                bodyFont:  { family: 'Courier New', size: 10 },
            }
        },
        scales: {
            x: {
                ticks: { color: '#555', font: { family: 'Courier New', size: 10 } },
                grid:  { color: '#1a1a1a' }
            },
            y: {
                ticks: { color: '#555', font: { family: 'Courier New', size: 10 } },
                grid:  { color: '#1a1a1a' }
            }
        }
    }
});

function filterFeed(type) {
    const items = document.querySelectorAll('#feed-container > div');
    items.forEach(el => {
        el.style.display = (type === 'all' || el.dataset.type === type) ? '' : 'none';
    });
}
</script>
@endpush
