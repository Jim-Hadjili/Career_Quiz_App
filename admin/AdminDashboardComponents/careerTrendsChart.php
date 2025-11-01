<div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-bold text-gray-900">Career Quiz Trends Over Time</h3>
        <div class="flex items-center space-x-2 text-sm text-gray-600">
            <i class="fas fa-chart-line"></i>
            <span>Last 6 Months</span>
        </div>
    </div>
    <?php if (!empty($monthly_labels) && array_sum($monthly_counts) > 0): ?>
        <div class="relative h-64">
            <canvas id="careerTrendsChart"></canvas>
        </div>
    <?php else: ?>
        <div class="flex flex-col items-center justify-center h-64 text-gray-500">
            <i class="fas fa-chart-line text-4xl mb-4 text-gray-300"></i>
            <p class="text-lg font-medium">No trend data available</p>
            <p class="text-sm">Quiz completion trends will appear here once users start taking quizzes.</p>
        </div>
    <?php endif; ?>
</div>