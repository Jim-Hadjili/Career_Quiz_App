<div class="bg-white rounded-2xl shadow-lg p-6 mb-6 border-2 border-dark">
    <div class="flex items-center justify-between mb-3">
        <div class="flex items-center space-x-3">
            <span class="text-sm font-bold text-dark font-sans">Progress</span>
            <span id="stage-badge" class="stage-badge stage-personality">
                <i class="fas fa-user"></i>
                <span class="font-sans">Personality Assessment</span>
            </span>
        </div>
        <span class="text-sm font-semibold text-gray-700 font-sans">
            <span id="current-question">1</span> of <span id="total-questions">15</span>
        </span>
    </div>
    <div class="w-full bg-cream rounded-full h-3 border-2 border-dark overflow-hidden">
        <div id="progress-bar" class="bg-lime h-full transition-all duration-300 shadow-inner" style="width: 0%"></div>
    </div>
</div>
