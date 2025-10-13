<div class="flex flex-col md:flex-row items-center md:items-start gap-8">
    <!-- Icon Section -->
    <div class="w-20 h-20 bg-dark rounded-2xl flex items-center justify-center shadow-lg border-2 border-dark">
        <i class="fas fa-question-circle text-lime text-4xl"></i>
    </div>
    
    <!-- Info Section -->
    <div class="flex-1">
        <div class="flex flex-wrap items-center gap-3 mb-4">
            <?php if ($is_registered): ?>
                <span class="bg-dark text-lime px-4 py-1.5 rounded-full text-sm font-bold flex items-center gap-2 border-2 border-dark shadow-sm font-sans">
                    <i class="fas fa-user-check"></i> Registered
                </span>
            <?php else: ?>
                <span class="bg-cream text-dark px-4 py-1.5 rounded-full text-sm font-bold flex items-center gap-2 border-2 border-dark shadow-sm font-sans">
                    <i class="fas fa-user-clock"></i> Guest Mode
                </span>
            <?php endif; ?>
        </div>
        
        <h1 class="text-2xl md:text-3xl font-bold mb-3 text-dark font-sans">
            Discover Your Ideal Career Path
        </h1>
        
        <p class="text-gray-700 text-base md:text-lg mb-4 leading-relaxed font-sans">
            Answer a series of questions about your personality, interests, values, and skills. Our AI-powered system will match you with careers that fit your unique profile.
        </p>
    </div>

    <div class="w-full md:w-auto">
        <!-- Stage Overview -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="p-4 bg-cream rounded-xl border-2 border-dark shadow-sm">
                <div class="text-2xl font-bold text-dark mb-1 font-sans">5</div>
                <div class="text-sm font-semibold text-gray-700 font-sans">Social</div>
            </div>
            <div class="p-4 bg-cream rounded-xl border-2 border-dark shadow-sm">
                <div class="text-2xl font-bold text-dark mb-1 font-sans">4</div>
                <div class="text-sm font-semibold text-gray-700 font-sans">Analytical</div>
            </div>
            <div class="p-4 bg-lime rounded-xl border-2 border-dark shadow-sm">
                <div class="text-2xl font-bold text-dark mb-1 font-sans">3</div>
                <div class="text-sm font-semibold text-dark font-sans">Creative</div>
            </div>
            <div class="p-4 bg-dark rounded-xl border-2 border-dark shadow-sm">
                <div class="text-2xl font-bold text-lime mb-1 font-sans">3</div>
                <div class="text-sm font-semibold text-lime font-sans">Technical</div>
            </div>
        </div>

        <!-- Mode-specific info -->
        <?php if ($is_registered): ?>
            <div class="bg-lime border-2 border-dark rounded-xl p-4 shadow-sm">
                <div class="flex items-center justify-center space-x-2 text-dark">
                    <i class="fas fa-save"></i>
                    <span class="font-bold font-sans">Your results will be saved to your account</span>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-cream border-2 border-dark rounded-xl p-4 shadow-sm">
                <div class="flex items-center justify-center space-x-2 text-dark mb-2">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span class="font-bold font-sans">Guest Mode: Results won't be saved</span>
                </div>
                <p class="text-sm text-gray-700 text-center font-sans">
                    <a href="../../index.php" class="underline hover:no-underline font-semibold text-dark">Create an account</a> to save your results
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>
