<style>
.quiz-results-modal-content::-webkit-scrollbar {
    display: none;
}

.result-card {
    transition: all 0.3s ease;
}

.result-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.career-tag {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    background-color: rgba(185, 255, 102, 0.1);
    color: #191a23;
    border: 1px solid rgba(185, 255, 102, 0.3);
    border-radius: 0.5rem;
    font-size: 0.75rem;
    font-weight: 600;
    margin: 0.125rem;
}

.pagination-btn {
    @apply px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium transition-colors duration-200;
}

.pagination-btn:hover:not(:disabled) {
    @apply bg-lime text-dark border-lime;
}

.pagination-btn:disabled {
    @apply opacity-50 cursor-not-allowed bg-gray-100;
}

.pagination-btn.active {
    @apply bg-dark text-white border-dark;
}
</style>
<!-- Quiz Results Modal -->
<div id="quiz-results-modal" class="fixed inset-0 bg-black bg-opacity-50 z-[135] hidden flex items-center justify-center p-4">
    <div class="quiz-results-modal-content bg-white rounded-3xl shadow-2xl w-full max-w-6xl mx-auto transform transition-all duration-300 scale-95 opacity-0 max-h-[95vh] overflow-y-auto" id="quiz-results-modal-content">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200 sticky top-0 bg-white rounded-t-3xl z-10">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-dark rounded-full flex items-center justify-center">
                    <i class="fas fa-chart-line text-lime text-lg"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-dark">Quiz Results History</h2>
                    <p class="text-sm text-gray-600">View your past career recommendations</p>
                </div>
            </div>
            <button id="close-quiz-results-modal" class="text-gray-500 hover:text-dark transition-colors text-2xl focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <!-- Success/Error Messages Container -->
            <div id="quiz-results-messages"></div>

            <!-- Loading State -->
            <div id="quiz-results-loading" class="flex items-center justify-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-lime mr-4"></div>
                <span class="text-gray-600 text-lg">Loading your quiz results...</span>
            </div>

            <!-- No Results State -->
            <div id="quiz-results-empty" class="hidden text-center py-12">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-clipboard-list text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">No Record Found</h3>
                <p class="text-gray-600 mb-6">You haven't taken any career quizzes yet.</p>
                <button onclick="closeQuizResultsModal(); window.location.href='Content/Pages/quizPage.php'" class="px-6 py-3 bg-dark text-lime font-medium rounded-xl hover:bg-gray-700 transition-colors">
                    <i class="fas fa-play mr-2"></i>Take Your First Quiz
                </button>
            </div>

            <!-- Results Container -->
            <div id="quiz-results-container" class="hidden space-y-6">
                <!-- Header Info -->
                <div class="bg-white border-2 border-lime rounded-xl p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-dark mb-2">Your Career Assessment History</h3>
                            <p class="text-sm text-gray-600">Total completed assessments: <span id="total-results-count" class="font-semibold text-dark">0</span></p>
                        </div>
                    </div>
                </div>

                <!-- Results List -->
                <div id="results-list" class="space-y-4">
                    <!-- Results will be populated by JavaScript -->
                </div>

                <!-- Pagination Container -->
                <div id="results-pagination" class="flex items-center justify-center space-x-4 pt-6 border-t border-gray-200">
                    <!-- Pagination will be populated by JavaScript -->
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 justify-end pt-6 border-t border-gray-200 mt-6">
                <!-- Close Button -->
                <button 
                    type="button" 
                    id="close-quiz-results-btn"
                    onclick="closeQuizResultsModal()"
                    class="group relative inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 text-dark font-medium rounded-xl transition-all duration-300 shadow-sm hover:shadow-md focus:outline-none focus:ring-4 focus:ring-gray-300/50 focus:ring-offset-2 w-full sm:w-auto transform hover:scale-105 overflow-hidden"
                >
                    <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/50 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    <span class="relative z-10">Close</span>
                </button>
                
                <!-- Take New Quiz Button -->
                <button 
                    type="button" 
                    onclick="closeQuizResultsModal(); window.location.href='Content/Pages/quizPage.php'"
                    class="group relative inline-flex items-center justify-center gap-2 px-6 py-3 bg-dark text-white font-medium rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-lime-500/30 focus:ring-offset-2 w-full sm:w-auto transform hover:scale-105 overflow-hidden"
                >
                    <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    <i class="fas fa-play relative z-10"></i>
                    <span class="relative z-10">Take New Quiz</span>
                </button>
            </div>
        </div>
    </div>
</div>

