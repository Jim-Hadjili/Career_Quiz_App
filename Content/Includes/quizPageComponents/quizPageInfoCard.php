<div class="flex flex-wrap md:flex-nowrap items-start gap-6 md:gap-8 w-full">
    <!-- Icon Section -->
    <div
        class="w-16 h-16 md:w-20 md:h-20 bg-crimson_red rounded-2xl flex items-center justify-center shadow-lg  flex-shrink-0 mb-4 md:mb-0 mx-auto md:mx-0">
        <i class="fas fa-lightbulb text-white text-3xl md:text-4xl"></i>
    </div>

    <!-- Info Section -->
    <div class="flex-1 min-w-[220px]">
        <div class="flex flex-wrap items-center gap-3 mb-3">
            <?php if ($is_registered): ?>
            <span
                class="bg-dark text-lime px-4 py-1.5 rounded-full text-sm font-semibold flex items-center gap-2 border-2 border-dark shadow-sm font-sans">
                <i class="fas fa-user-check"></i> Registered
            </span>
            <?php else: ?>
            <span
                class="bg-cream text-dark px-4 py-1.5 rounded-full text-sm font-semibold flex items-center gap-2 border-2 border-border shadow-sm font-sans">
                <i class="fas fa-user-clock"></i> Guest Mode
            </span>
            <?php endif; ?>
        </div>

        <h1 class="text-xl md:text-3xl font-bold mb-2 md:mb-3 text-dark font-sans">
            Discover Your Ideal Career Path
        </h1>

        <p class="text-gray-700 text-justify text-base md:text-lg md:mb-3 leading-relaxed font-sans">
            Answer a series of questions about your personality, interests, values, and skills. Our AI-powered system
            will match you with careers that fit your unique profile.
        </p>
    </div>

    <!-- Stage Overview & Mode Info -->
    <div class="w-full md:w-[340px] flex flex-col gap-4">
        <!-- Stage Overview -->
        <div class="grid grid-cols-2 grid-rows-2 gap-3 md:gap-4">
            <div class="p-3 md:p-4 bg-cream rounded-xl border-2 border-border shadow-sm min-w-[120px]">
                <div class="text-xl md:text-2xl font-bold text-dark mb-1 font-sans">10</div>
                <div class="text-xs md:text-sm font-semibold text-gray-700 font-sans">Personality</div>
            </div>
            <div class="p-3 md:p-4 bg-cream rounded-xl border-2 border-border shadow-sm min-w-[120px]">
                <div class="text-xl md:text-2xl font-bold text-dark mb-1 font-sans">10</div>
                <div class="text-xs md:text-sm font-semibold text-gray-700 font-sans">Interests & Hobbies</div>
            </div>
            <div class="p-3 md:p-4 bg-cream rounded-xl border-2 border-border shadow-sm min-w-[120px]">
                <div class="text-xl md:text-2xl font-bold text-dark mb-1 font-sans">10</div>
                <div class="text-xs md:text-sm font-semibold text-dark font-sans">Work Values</div>
            </div>
            <div class="p-3 md:p-4 bg-cream rounded-xl border-2 border-border shadow-sm min-w-[120px]">
                <div class="text-xl md:text-2xl font-bold text-dark mb-1 font-sans">10</div>
                <div class="text-xs md:text-sm font-semibold text-dark font-sans">Skills & Strengths</div>
            </div>
        </div>
    </div>
</div>