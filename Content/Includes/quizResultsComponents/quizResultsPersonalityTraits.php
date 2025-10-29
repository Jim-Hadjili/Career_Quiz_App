<section
    class="pt-24 pb-2 bg-white"
    id="Personality-Traits">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center mb-8">
            <div
                class="w-14 h-14 bg-lime rounded-full flex items-center justify-center mr-6 font-bold text-dark text-xl shadow-lg">
                3
            </div>
            <h2
                class="section-title text-3xl lg:text-5xl font-bold text-gray-800">
                Comprehensive Personality Analysis
            </h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Traits Visualization -->
            <div
                class="lg:col-span-2 bg-white rounded-3xl p-10 shadow-md border-2 border-gray-100">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Personality Traits Spectrum</h3>
                    <p class="text-gray-600 text-sm">
                        Based on your responses across all assessment categories: personality, interests, values, and skills.
                    </p>
                </div>
                <div id="traits-container">
                    <!-- Traits will be populated by JavaScript -->
                    <div class="flex items-center justify-center py-8">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-lime"></div>
                        <span class="ml-3 text-gray-600">Analyzing your responses...</span>
                    </div>
                </div>
            </div>

        
        </div>

        <!-- Description Text -->
        <div
            class="mt-8 bg-white rounded-3xl p-10 shadow-md border-2 border-gray-100">
            <div class="mb-4">
                <h3 class="text-lg font-bold text-gray-800 mb-2">Your Comprehensive Profile</h3>
            </div>
            <div class="space-y-6 text-gray-700 leading-relaxed text-md" id="personality-description">
                <div class="flex items-center justify-center py-8">
                    <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-lime"></div>
                    <span class="ml-3 text-gray-600">Generating personalized analysis...</span>
                </div>
            </div>
        </div>
    </div>
</section>