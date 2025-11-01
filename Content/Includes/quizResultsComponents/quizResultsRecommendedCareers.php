<section class="pt-24 pb-2 bg-white" id="Recommended-Career-Paths">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center mb-16">
            <div
                class="w-14 h-14 bg-lime rounded-full flex items-center justify-center mr-6 font-bold text-dark text-xl shadow-lg">
                2
            </div>
            <h2
                class="section-title text-3xl lg:text-5xl font-bold text-gray-800">
                Your Personalized Career Recommendations
            </h2>
        </div>

        <!-- Career Cards Carousel -->
        <div class="relative">
            <div
                class="bg-gradient-to-br from-gray-50 to-white rounded-3xl shadow-2xl p-6 lg:p-12 min-h-[32rem] border border-gray-100"
                id="career-cards-container">
                <!-- Enhanced career cards will be populated by JavaScript -->
                <div class="flex items-center justify-center h-64">
                    <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-lime"></div>
                    <span class="ml-4 text-gray-600 text-lg">Loading your personalized recommendations...</span>
                </div>
            </div>

            <!-- Enhanced Navigation Controls -->
            <div class="flex items-center justify-between mt-10 px-6">
                <button
                    id="prevBtn"
                    class="px-8 py-4 bg-white border-2 border-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-lime hover:text-dark hover:border-lime transition-all duration-300 flex items-center gap-3 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed no-print">
                    <i class="fas fa-chevron-left"></i>
                    <span class="hidden sm:inline">Previous Career</span>
                </button>

                <div
                    class="flex gap-4 justify-center no-print"
                    id="progress-dots">
                    <!-- Progress dots will be populated by JavaScript -->
                </div>

                <button
                    id="nextBtn"
                    class="px-8 py-4 bg-lime text-dark font-semibold rounded-xl hover:bg-dark hover:text-lime transition-all duration-300 flex items-center gap-3 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed no-print">
                    <span class="hidden sm:inline">Next Career</span>
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</section>