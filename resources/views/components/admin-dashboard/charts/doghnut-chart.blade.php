@vite(['resources/js/admin-js/doghnut-chart.js'])

{{-- others props indicates that the number of deals Closed By Other than top agents --}}
@props(['data' => []])

<script>
    const dChartData = @json($data);
</script>

<div class="chart-container">
    <canvas id="doghnut"></canvas>
</div>