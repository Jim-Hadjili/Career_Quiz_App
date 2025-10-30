<style>
.subject-modal-content::-webkit-scrollbar {
  display: none;
}
</style>
<!-- Subject Grade Modal -->
<div id="subject-grade-modal" class="fixed inset-0 bg-black bg-opacity-50 z-[125] hidden flex items-center justify-center p-4">
    <div class="subject-modal-content bg-white rounded-3xl shadow-2xl w-full max-w-6xl mx-auto transform transition-all duration-300 scale-95 opacity-0 max-h-[95vh] overflow-y-auto" id="subject-grade-modal-content">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200 sticky top-0 bg-white rounded-t-3xl z-10">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-dark rounded-full flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-lime text-sm"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-dark">Subject Grades</h2>
                    <p class="text-sm text-gray-600">View and manage your academic grades</p>
                </div>
            </div>
            <button id="close-subject-grade-modal" class="text-gray-500 hover:text-dark transition-colors text-2xl focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <!-- Success/Error Messages Container -->
            <div id="subject-grade-messages"></div>

            <!-- Subject Grade Form -->
            <form id="subject-grade-form">
                <!-- Form Fields Container -->
                <div class="bg-gray-50/50 rounded-xl p-6 mb-6 border border-gray-200">
                    <!-- Section Title -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="w-1 h-6 bg-dark rounded-full mr-3"></div>
                            <h4 class="text-lg font-bold text-dark">Academic Subjects</h4>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-600">
                                <span id="subject-filled-counter">0</span> of 9 completed
                            </span>
                        </div>
                    </div>

                    <!-- Subject Grades Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 max-h-[500px] overflow-y-auto pr-2">

                        <!-- Statistics and Probability -->
                        <div class="bg-white p-5 rounded-xl border border-gray-200 hover:border-dark/20 transition-all duration-200 hover:shadow-md">
                            <div class="flex items-start justify-between mb-3">
                                <label for="modal-statistics-grade" class="block text-sm font-bold text-dark leading-tight">
                                    Statistics and Probability
                                </label>
                                <span class="text-red-500 text-sm">*</span>
                            </div>
                            <input
                                type="number"
                                id="modal-statistics-grade"
                                name="Statistics_and_Probability"
                                class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-lime focus:ring-4 focus:ring-lime-500/20 focus:outline-none text-center text-lg font-medium hover:border-gray-300 transition-all duration-200"
                                placeholder="85.5"
                                min="65"
                                max="100"
                                step="0.01">
                        </div>

                        <!-- Physical Science -->
                        <div class="bg-white p-5 rounded-xl border border-gray-200 hover:border-dark/20 transition-all duration-200 hover:shadow-md">
                            <div class="flex items-start justify-between mb-3">
                                <label for="modal-physical-science-grade" class="block text-sm font-bold text-dark leading-tight">
                                    Physical Science
                                </label>
                                <span class="text-red-500 text-sm">*</span>
                            </div>
                            <input
                                type="number"
                                id="modal-physical-science-grade"
                                name="Physical_Science"
                                class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-lime focus:ring-4 focus:ring-lime-500/20 focus:outline-none text-center text-lg font-medium hover:border-gray-300 transition-all duration-200"
                                placeholder="90.0"
                                min="65"
                                max="100"
                                step="0.01">
                        </div>

                        <!-- Oral Communication in Context -->
                        <div class="bg-white p-5 rounded-xl border border-gray-200 hover:border-dark/20 transition-all duration-200 hover:shadow-md">
                            <div class="flex items-start justify-between mb-3">
                                <label for="modal-oral-comm-grade" class="block text-sm font-bold text-dark leading-tight">
                                    Oral Communication
                                </label>
                                <span class="text-red-500 text-sm">*</span>
                            </div>
                            <input
                                type="number"
                                id="modal-oral-comm-grade"
                                name="oral_comm_context"
                                class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-lime focus:ring-4 focus:ring-lime-500/20 focus:outline-none text-center text-lg font-medium hover:border-gray-300 transition-all duration-200"
                                placeholder="88.0"
                                min="65"
                                max="100"
                                step="0.01">
                        </div>

                        <!-- General Mathematics -->
                        <div class="bg-white p-5 rounded-xl border border-gray-200 hover:border-dark/20 transition-all duration-200 hover:shadow-md">
                            <div class="flex items-start justify-between mb-3">
                                <label for="modal-general-math-grade" class="block text-sm font-bold text-dark leading-tight">
                                    General Mathematics
                                </label>
                                <span class="text-red-500 text-sm">*</span>
                            </div>
                            <input
                                type="number"
                                id="modal-general-math-grade"
                                name="general_math"
                                class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-lime focus:ring-4 focus:ring-lime-500/20 focus:outline-none text-center text-lg font-medium hover:border-gray-300 transition-all duration-200"
                                placeholder="92.5"
                                min="65"
                                max="100"
                                step="0.01">
                        </div>

                        <!-- Earth and Life Science -->
                        <div class="bg-white p-5 rounded-xl border border-gray-200 hover:border-dark/20 transition-all duration-200 hover:shadow-md">
                            <div class="flex items-start justify-between mb-3">
                                <label for="modal-earth-life-sci-grade" class="block text-sm font-bold text-dark leading-tight">
                                    Earth and Life Science
                                </label>
                                <span class="text-red-500 text-sm">*</span>
                            </div>
                            <input
                                type="number"
                                id="modal-earth-life-sci-grade"
                                name="earth_life_sci"
                                class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-lime focus:ring-4 focus:ring-lime-500/20 focus:outline-none text-center text-lg font-medium hover:border-gray-300 transition-all duration-200"
                                placeholder="87.0"
                                min="65"
                                max="100"
                                step="0.01">
                        </div>

                        <!-- Understanding Culture, Society and Politics -->
                        <div class="bg-white p-5 rounded-xl border border-gray-200 hover:border-dark/20 transition-all duration-200 hover:shadow-md">
                            <div class="flex items-start justify-between mb-3">
                                <label for="modal-ucsp-grade" class="block text-sm font-bold text-dark leading-tight">
                                    Culture, Society & Politics
                                </label>
                                <span class="text-red-500 text-sm">*</span>
                            </div>
                            <input
                                type="number"
                                id="modal-ucsp-grade"
                                name="ucsp"
                                class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-lime focus:ring-4 focus:ring-lime-500/20 focus:outline-none text-center text-lg font-medium hover:border-gray-300 transition-all duration-200"
                                placeholder="89.0"
                                min="65"
                                max="100"
                                step="0.01">
                        </div>

                        <!-- Reading and Writing -->
                        <div class="bg-white p-5 rounded-xl border border-gray-200 hover:border-dark/20 transition-all duration-200 hover:shadow-md">
                            <div class="flex items-start justify-between mb-3">
                                <label for="modal-reading-writing-grade" class="block text-sm font-bold text-dark leading-tight">
                                    Reading and Writing
                                </label>
                                <span class="text-red-500 text-sm">*</span>
                            </div>
                            <input
                                type="number"
                                id="modal-reading-writing-grade"
                                name="reading_writing"
                                class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-lime focus:ring-4 focus:ring-lime-500/20 focus:outline-none text-center text-lg font-medium hover:border-gray-300 transition-all duration-200"
                                placeholder="91.0"
                                min="65"
                                max="100"
                                step="0.01">
                        </div>

                        <!-- 21st Century Literature -->
                        <div class="bg-white p-5 rounded-xl border border-gray-200 hover:border-dark/20 transition-all duration-200 hover:shadow-md">
                            <div class="flex items-start justify-between mb-3">
                                <label for="modal-lit21-ph-world-grade" class="block text-sm font-bold text-dark leading-tight">
                                    21st Century Literature
                                </label>
                                <span class="text-red-500 text-sm">*</span>
                            </div>
                            <input
                                type="number"
                                id="modal-lit21-ph-world-grade"
                                name="lit21_ph_world"
                                class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-lime focus:ring-4 focus:ring-lime-500/20 focus:outline-none text-center text-lg font-medium hover:border-gray-300 transition-all duration-200"
                                placeholder="86.5"
                                min="65"
                                max="100"
                                step="0.01">
                        </div>

                        <!-- Media and Information Literacy -->
                        <div class="bg-white p-5 rounded-xl border border-gray-200 hover:border-dark/20 transition-all duration-200 hover:shadow-md">
                            <div class="flex items-start justify-between mb-3">
                                <label for="modal-media-info-lit-grade" class="block text-sm font-bold text-dark leading-tight">
                                    Media & Information Literacy
                                </label>
                                <span class="text-red-500 text-sm">*</span>
                            </div>
                            <input
                                type="number"
                                id="modal-media-info-lit-grade"
                                name="media_info_lit"
                                class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-lime focus:ring-4 focus:ring-lime-500/20 focus:outline-none text-center text-lg font-medium hover:border-gray-300 transition-all duration-200"
                                placeholder="93.0"
                                min="65"
                                max="100"
                                step="0.01">
                        </div>

                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 justify-end pt-4 border-t border-gray-200">
                    <!-- Clear All Button -->
                    <button 
                        type="button" 
                        id="clear-all-grades-button"
                        class="group relative inline-flex items-center justify-center gap-2 px-6 py-3 bg-red-50 text-red-600 font-medium rounded-xl transition-all duration-300 shadow-sm hover:shadow-md hover:bg-red-100 focus:outline-none focus:ring-4 focus:ring-red-300/50 focus:ring-offset-2 w-full sm:w-auto transform hover:scale-105 overflow-hidden border border-red-200"
                    >
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/30 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <i class="fas fa-trash relative z-10"></i>
                        <span class="relative z-10">Clear All</span>
                    </button>

                    <!-- Cancel Button -->
                    <button 
                        type="button" 
                        id="cancel-subject-grade-changes"
                        onclick="closeSubjectGradeModal()"
                        class="group relative inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 text-dark font-medium rounded-xl transition-all duration-300 shadow-sm hover:shadow-md focus:outline-none focus:ring-4 focus:ring-gray-300/50 focus:ring-offset-2 w-full sm:w-auto transform hover:scale-105 overflow-hidden"
                    >
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/50 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <span class="relative z-10">Cancel</span>
                    </button>
                    
                    <!-- Save Button -->
                    <button 
                        type="submit" 
                        id="save-subject-grades-button"
                        class="group relative inline-flex items-center justify-center gap-2 px-6 py-3 bg-dark text-white font-medium rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-lime-500/30 focus:ring-offset-2 w-full sm:w-auto transform hover:scale-105 overflow-hidden"
                    >
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <i class="fas fa-save relative z-10"></i>
                        <span class="relative z-10">Save Grades</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>