<div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-bold text-gray-900">Career Distribution</h3>
        <div class="flex items-center gap-2">
            <!-- Chart Type Toggle -->
            <div class="flex bg-gray-100 rounded-lg p-1">
                <button id="barChartBtn" class="px-3 py-1 text-xs font-medium rounded-md bg-blue-500 text-white transition-colors">
                    <i class="fas fa-chart-bar mr-1"></i>
                    Bar
                </button>
                <button id="pieChartBtn" class="px-3 py-1 text-xs font-medium rounded-md text-gray-600 hover:text-gray-800 transition-colors">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Pie
                </button>
            </div>
        </div>
    </div>
    <div class="relative h-64">
        <canvas id="careerChart"></canvas>
    </div>
</div>