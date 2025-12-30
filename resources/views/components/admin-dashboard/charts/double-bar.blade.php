@props(['title','subTitle'=>"",'data'=>[]])

@vite(['resources/js/admin-js/double-bar.js'])

<script>
    const buyerEngagementData = @json($data);
</script>

<div class="dashboard-card rounded-2xl p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-xl font-bold text-white">{{ $title }}</h3>
            <p class="text-gray-400 text-sm">{{ $subTitle }}</p>
        </div>
    </div>
    <div class="small-chart-container">
        <canvas id="buyerChart"></canvas>
    </div>
</div>
