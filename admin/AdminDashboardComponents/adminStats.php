<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <?php foreach ($stats as $stat): ?>
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-start justify-between">
                <div class="flex-1 min-w-0">
                    <p class="text-gray-600 text-sm font-medium"><?php echo $stat['title']; ?></p>
                    <p class="text-2xl font-bold text-gray-900 mt-2 <?php echo ($stat['title'] === 'Popular Career') ? 'text-lg break-words' : ''; ?>"><?php echo $stat['value']; ?></p>
                    <p class="text-xs text-gray-500 mt-2"><?php echo $stat['change']; ?></p>
                </div>
                <div class="text-2xl text-blue-400 flex-shrink-0 ml-3">
                    <i class="fas <?php echo $stat['icon']; ?>"></i>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>