<div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-bold text-gray-900">Most Selected Careers</h3>
        <div class="flex bg-gray-100 rounded-lg p-1">
            <button id="selectedBarBtn" class="px-3 py-1 text-xs font-medium rounded-md bg-lime text-dark transition-colors">
                <i class="fas fa-chart-bar mr-1"></i>
                Bar
            </button>
            <button id="selectedDoughnutBtn" class="px-3 py-1 text-xs font-medium rounded-md text-gray-600 hover:text-gray-800 transition-colors">
                <i class="fas fa-chart-pie mr-1"></i>
                Doughnut
            </button>
        </div>
    </div>
    <div class="relative h-64">
        <canvas id="selectedCareersChart"></canvas>
    </div>
</div>