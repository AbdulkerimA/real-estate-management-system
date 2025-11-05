@props(['data'=>[],'title'=>''])

@vite(['resources/js/admin-js/bar-chart.js'])
{{-- {{ dd($data) }} --}}
<script>
    let barChartData = @json($data);
</script>

<div class="dashboard-card rounded-2xl p-6">
    <h3 class="text-xl font-bold mb-4">{{ $title }}</h3>
    <div class="chart-container">
        <canvas id="bar"></canvas>
    </div>
</div>