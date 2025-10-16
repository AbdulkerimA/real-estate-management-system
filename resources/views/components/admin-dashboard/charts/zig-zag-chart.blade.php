
@props(['title'=>'','subTitle'=>''])

@vite(['resources/js/admin-js/zig-zag-chart.js'])

<div class="dashboard-card rounded-2xl p-6">
    <h3 class="text-xl font-bold mb-4">{{ $title }}</h3>
    <p class="text-gray-400 text-sm">{{ $subTitle }}</p>
    <div class="chart-container">
        <canvas id="zig-zag"></canvas>
    </div>
</div>