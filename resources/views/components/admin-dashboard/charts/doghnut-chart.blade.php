@vite(['resources/js/admin-js/doghnut-chart.js'])

{{-- others props indicates that the number of deals Closed By Other than top agents --}}
@props(['data' => []])

<script>
    window.dChartData = @json($data);
</script>
{{-- {{ dd($data); }} --}}
<div class="dashboard-card rounded-2xl p-6">
    <div class="chart-container">
        <canvas id="doghnut"></canvas>
    </div>
</div>