<div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-bold text-gray-900">Career Distribution</h3>
        <div class="flex items-center gap-2" id="career-chart-controls">
            <!-- Chart Type Toggle -->
            <div class="flex bg-gray-100 rounded-lg p-1">
                <button id="barChartBtn" class="px-3 py-1 text-xs font-medium rounded-md bg-lime text-dark transition-colors">
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
    
    <!-- Chart Container -->
    <div class="relative h-64" id="career-chart-container">
        <canvas id="careerChart"></canvas>
    </div>
    
    <!-- No Data State -->
    <div class="hidden flex flex-col items-center justify-center h-64 text-gray-500" id="career-no-data">
        <div class="text-center">
            <i class="fas fa-chart-bar text-4xl text-gray-300 mb-4"></i>
            <h4 class="text-lg font-medium text-gray-600 mb-2">No career selections yet</h4>
            <p class="text-sm text-gray-500 leading-relaxed max-w-sm">
                Career distribution data will appear here once users start completing career quizzes and getting recommendations.
            </p>
        </div>
    </div>
</div>