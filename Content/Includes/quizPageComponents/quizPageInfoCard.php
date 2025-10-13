<div class="flex flex-col md:flex-row items-center md:items-start gap-8">
    <!-- Icon Section -->
    <div class="w-20 h-20 bg-dark rounded-2xl flex items-center justify-center shadow-lg">
        <i class="fas fa-question-circle text-lime text-4xl"></i>
    </div>
    <!-- Info Section -->
    <div class="flex-1">
        <div class="flex flex-wrap items-center gap-3 mb-4">
            <span class="bg-lime text-dark px-4 py-1 rounded-full text-sm font-semibold">CareerPath Quiz</span>
            <?php if ($is_registered): ?>
                <span class="bg-dark text-lime px-4 py-1 rounded-full text-sm font-semibold flex items-center gap-2">
                    <i class="fas fa-user-check"></i> Registered
                </span>
            <?php else: ?>
                <span class="bg-yellow-200 text-yellow-900 px-4 py-1 rounded-full text-sm font-semibold flex items-center gap-2">
                    <i class="fas fa-user-clock"></i> Guest Mode
                </span>
            <?php endif; ?>
        </div>
        <h1 class="text-2xl md:text-3xl font-bold mb-2 font-sans">Discover Your Ideal Career Path</h1>
        <p class="text-gray-600 text-base md:text-lg mb-4 font-sans">
            Answer a series of questions about your personality, interests, values, and skills. Our AI-powered system will match you with careers that fit your unique profile.
        </p>
    </div>

    <div class="text-center">
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