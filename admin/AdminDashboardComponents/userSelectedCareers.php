<!-- User Selected Careers Chart -->
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-bold text-gray-900">User Selected Careers</h3>
        <div class="flex bg-gray-100 rounded-lg p-1">
            <button id="userSelectedBarBtn" class="px-3 py-1 text-xs font-medium rounded-md bg-lime text-dark transition-colors">
                <i class="fas fa-chart-bar mr-1"></i>
                Bar
            </button>
            <button id="userSelectedPieBtn" class="px-3 py-1 text-xs font-medium rounded-md text-gray-600 hover:text-gray-800 transition-colors">
                <i class="fas fa-chart-pie mr-1"></i>
                Pie
            </button>
        </div>
    </div>
    <?php if (!empty($user_selected_career_labels)): ?>
        <div class="relative h-64">
            <canvas id="userSelectedCareersChart"></canvas>
        </div>
    <?php else: ?>
        <div class="flex flex-col items-center justify-center h-64 text-gray-500">
            <i class="fas fa-chart-bar text-4xl mb-4 text-gray-300"></i>
            <p class="text-lg font-medium">No career selections yet</p>
            <p class="text-sm">User career selections will appear here once users start selecting their preferred careers.</p>
        </div>
    <?php endif; ?>
</div>

<!-- Recent User Selections -->
<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-bold text-gray-900 mb-4">Recent Career Selections</h3>
    <?php if (!empty($recent_user_selections)): ?>
        <div class="space-y-3 max-h-64 overflow-y-auto">
            <?php foreach ($recent_user_selections as $selection): ?>
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <div>
                            <p class="font-medium text-gray-900"><?php echo htmlspecialchars($selection['career']); ?></p>
                            <p class="text-sm text-gray-600">Selected by <?php echo htmlspecialchars($selection['user']); ?></p>
                        </div>
                    </div>
                    <i class="fas fa-user-check text-green-500"></i>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-8 text-gray-500">
            <i class="fas fa-users text-3xl mb-3 text-gray-300"></i>
            <p class="font-medium">No career selections yet</p>
            <p class="text-sm">Recent user career selections will appear here.</p>
        </div>
    <?php endif; ?>
</div>