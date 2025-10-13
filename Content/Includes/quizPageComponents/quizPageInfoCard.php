<div class="bg-white rounded-2xl shadow-sm p-8 mb-8">
    <div class="text-center">
        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-clipboard-list text-blue-600 text-2xl"></i>
        </div>
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Career Path Discovery Quiz</h1>
        <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
            Answer these questions honestly to discover career paths that align with your personality,
            interests, values, and skills. This quiz contains 15 carefully selected questions.
        </p>

        <!-- Stage Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="p-4 bg-blue-50 rounded-xl">
                <div class="text-2xl font-bold text-blue-600 mb-1">5</div>
                <div class="text-sm font-medium text-blue-900">Social</div>
            </div>
            <div class="p-4 bg-pink-50 rounded-xl">
                <div class="text-2xl font-bold text-pink-600 mb-1">4</div>
                <div class="text-sm font-medium text-pink-900">Analytical</div>
            </div>
            <div class="p-4 bg-yellow-50 rounded-xl">
                <div class="text-2xl font-bold text-yellow-600 mb-1">3</div>
                <div class="text-sm font-medium text-yellow-900">Creative</div>
            </div>
            <div class="p-4 bg-green-50 rounded-xl">
                <div class="text-2xl font-bold text-green-600 mb-1">3</div>
                <div class="text-sm font-medium text-green-900">Technical</div>
            </div>
        </div>

        <!-- Mode-specific info -->
        <?php if ($is_registered): ?>
            <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                <div class="flex items-center justify-center space-x-2 text-green-800">
                    <i class="fas fa-save"></i>
                    <span class="font-medium">Your results will be saved to your account</span>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                <div class="flex items-center justify-center space-x-2 text-yellow-800">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span class="font-medium">Guest Mode: Results won't be saved</span>
                </div>
                <p class="text-xs text-yellow-700 mt-1">
                    <a href="../../index.php" class="underline hover:no-underline">Create an account</a> to save your results
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>