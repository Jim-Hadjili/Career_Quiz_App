<div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-bold text-gray-900">Recent Users</h3>
        <?php if ($total_users > 10): ?>
            <div class="text-xs text-gray-500">
                Page <?php echo $current_page; ?> of <?php echo $total_pages; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- User List -->
    <div class="space-y-4 mb-6">
        <?php if (!empty($recent_users)): ?>
            <?php foreach ($recent_users as $user): ?>
                <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-user text-blue-600 text-sm"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">
                            <?php echo htmlspecialchars($user['userName']); ?>
                        </p>
                        <p class="text-xs text-gray-500 truncate">
                            <?php echo htmlspecialchars($user['userEmail']); ?>
                        </p>
                    </div>
                    <div class="w-2 h-2 bg-green-400 rounded-full flex-shrink-0"></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center py-8">
                <i class="fas fa-users text-gray-300 text-3xl mb-3"></i>
                <p class="text-gray-500 text-sm">No users found</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination - Only show if more than 10 users -->
    <?php if ($total_users > 10 && $total_pages > 1): ?>
        <div class="border-t pt-4">
            <div class="flex items-center justify-between">
                <!-- Previous Button -->
                <?php if ($current_page > 1): ?>
                    <a href="?page=<?php echo $current_page - 1; ?>"
                        class="flex items-center px-3 py-2 text-xs font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-700 transition-colors">
                        <i class="fas fa-chevron-left mr-1"></i>
                        Previous
                    </a>
                <?php else: ?>
                    <button disabled class="flex items-center px-3 py-2 text-xs font-medium text-gray-300 bg-gray-100 border border-gray-200 rounded-md cursor-not-allowed">
                        <i class="fas fa-chevron-left mr-1"></i>
                        Previous
                    </button>
                <?php endif; ?>

                <!-- Page Numbers -->
                <div class="flex items-center space-x-1">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <?php if ($i == $current_page): ?>
                            <span class="px-3 py-2 text-xs font-medium text-white bg-blue-500 rounded-md">
                                <?php echo $i; ?>
                            </span>
                        <?php else: ?>
                            <a href="?page=<?php echo $i; ?>"
                                class="px-3 py-2 text-xs font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-700 transition-colors">
                                <?php echo $i; ?>
                            </a>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>

                <!-- Next Button -->
                <?php if ($current_page < $total_pages): ?>
                    <a href="?page=<?php echo $current_page + 1; ?>"
                        class="flex items-center px-3 py-2 text-xs font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-700 transition-colors">
                        Next
                        <i class="fas fa-chevron-right ml-1"></i>
                    </a>
                <?php else: ?>
                    <button disabled class="flex items-center px-3 py-2 text-xs font-medium text-gray-300 bg-gray-100 border border-gray-200 rounded-md cursor-not-allowed">
                        Next
                        <i class="fas fa-chevron-right ml-1"></i>
                    </button>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>