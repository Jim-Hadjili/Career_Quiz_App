<section class="py-20 bg-white" id="Recommended-Career-Paths">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center mb-16">
            <div
                class="w-14 h-14 bg-lime rounded-full flex items-center justify-center mr-6 font-bold text-dark text-xl shadow-lg">
                2
            </div>
            <h2
                class="section-title text-4xl lg:text-5xl font-bold text-gray-800">
                Recommended Career Paths
            </h2>
        </div>

        <!-- Career Cards Carousel -->
        <div class="relative">
            <div
                class="bg-gradient-to-br from-cream to-white rounded-3xl shadow-xl p-10 lg:p-14 min-h-[28rem] border border-gray-200"
                id="career-cards-container">
                <!-- Career cards will be populated by JavaScript -->
            </div>

            <!-- Navigation Controls -->
            <div class="flex items-center justify-between mt-10 px-6">
                <button
                    id="prevBtn"
                    onclick="previousCareer()"
                    class="px-8 py-4 bg-white border-2 border-border text-gray-700 font-semibold rounded-xl hover:bg-lime hover:text-dark hover:border-lime transition-all duration-300 flex items-center gap-3 shadow-md no-print">
                    <i class="fas fa-chevron-left"></i>
                    <span class="hidden sm:inline">Previous</span>
                </button>

                <div
                    class="flex gap-4 justify-center no-print"
                    id="progress-dots">
                    <!-- Progress dots will be populated by JavaScript -->
                </div>

                <button
                    id="nextBtn"
                    onclick="nextCareer()"
                    class="px-8 py-4 bg-lime text-dark font-semibold rounded-xl hover:bg-dark hover:text-lime transition-all duration-300 flex items-center gap-3 shadow-md no-print">
                    <span class="hidden sm:inline">Next</span>
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</section>