<style>
    .mbti-modal-content::-webkit-scrollbar {
        display: none;
    }

    /* MBTI Button Styles */
    .modal-mbti-button {
        width: 100%;
        padding: 1rem;
        border: 2px solid #d1d5db;
        /* gray-300 */
        border-radius: 0.5rem;
        background-color: #ffffff;
        cursor: pointer;
        font-family: inherit;
        transition: all 0.3s ease;
        position: relative;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    /* Hover State */
    .modal-mbti-button:hover {
        border-color: #191a23;
        /* dark */
        background-color: #f9fafb;
        /* gray-50 */
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(25, 26, 35, 0.15);
    }

    /* Selected State */
    .modal-mbti-button.selected {
        border-color: #b9ff66;
        /* lime */
        background-color: rgba(212, 241, 100, 0.1);
        /* lime/10 */
        box-shadow: 0 0 0 3px rgba(212, 241, 100, 0.3),
            0 4px 12px rgba(25, 26, 35, 0.15);
    }

    /* Selected state text color adjustments */
    .modal-mbti-button.selected .text-dark {
        color: #191a23;
        /* Keep dark text */
    }

    .modal-mbti-button.selected .text-gray-700 {
        color: #374151;
        /* Keep readable contrast */
    }

    .modal-mbti-button.selected .text-gray-600 {
        color: #4b5563;
        /* Keep readable contrast */
    }

    /* Hover effect on selected button */
    .modal-mbti-button.selected:hover {
        background-color: rgba(212,
                241,
                100,
                0.15);
        /* Slightly more lime background */
        transform: translateY(-2px);
    }

    /* Focus state for accessibility */
    .modal-mbti-button:focus {
        outline: none;
        border-color: #b9ff66;
        /* dark */
        box-shadow: 0 0 0 3px rgba(25, 26, 35, 0.1);
    }

    /* Active state (when clicked) */
    .modal-mbti-button:active {
        transform: translateY(0px);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
</style>

<!-- MBTI Type Modal -->
<div id="mbti-modal" class="fixed inset-0 bg-black bg-opacity-50 z-[130] hidden flex items-center justify-center p-4">
    <div class="mbti-modal-content bg-white rounded-3xl shadow-2xl w-full max-w-5xl mx-auto transform transition-all duration-300 scale-95 opacity-0 max-h-[95vh] overflow-y-auto" id="mbti-modal-content">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200 sticky top-0 bg-white rounded-t-3xl z-10">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-dark rounded-full flex items-center justify-center">
                    <i class="fas fa-brain text-lime text-lg"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-dark">MBTI Personality Type</h2>
                    <p class="text-sm text-gray-600">Manage your personality type information</p>
                </div>
            </div>
            <button id="close-mbti-modal" class="text-gray-500 hover:text-dark transition-colors text-2xl focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <!-- Success/Error Messages Container -->
            <div id="mbti-messages"></div>

            <!-- MBTI Form -->
            <form id="mbti-form">

                <!-- Current MBTI Display (shown when user has existing type) -->
                <div id="current-mbti-display" class="bg-lime/10 border-2 border-lime rounded-xl p-6 mb-6 hidden">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-dark rounded-full flex items-center justify-center">
                                <span id="current-mbti-type" class="text-lime font-bold text-lg"></span>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-dark" id="current-mbti-title">Your Current Type</h4>
                                <p class="text-sm text-gray-600" id="current-mbti-description">Click "Change Type" to update your personality type</p>
                            </div>
                        </div>
                        <button type="button" id="change-mbti-button" class="px-4 py-2 bg-dark text-lime font-medium rounded-lg hover:bg-gray-700 transition-colors">
                            <i class="fas fa-edit mr-2"></i>Change Type
                        </button>
                    </div>
                </div>

                <!-- MBTI Selection Form -->
                <div id="mbti-selection-form" class="bg-gray-50/50 rounded-xl p-6 mb-6 border border-gray-200">
                    <!-- Section Title -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="w-1 h-6 bg-dark rounded-full mr-3"></div>
                            <h4 class="text-lg font-bold text-dark">Choose Your Personality Type</h4>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-600" id="mbti-selection-status">
                                Please make a selection
                            </span>
                        </div>
                    </div>

                    <!-- Hidden input to store selected MBTI type -->
                    <input type="hidden" id="modal-mbti-type" name="mbti_type" value="">

                    <!-- MBTI Types Grid -->
                    <div class="space-y-8">
                        <!-- Analysts Group -->
                        <div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                <button type="button" class="modal-mbti-button" data-type="INTJ">
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-dark mb-2">INTJ</div>
                                        <div class="text-sm font-semibold text-gray-700 mb-1">The Architect</div>
                                        <div class="text-xs text-gray-600">Strategic & Innovative</div>
                                    </div>
                                </button>
                                <button type="button" class="modal-mbti-button" data-type="INTP">
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-dark mb-2">INTP</div>
                                        <div class="text-sm font-semibold text-gray-700 mb-1">The Thinker</div>
                                        <div class="text-xs text-gray-600">Logical & Creative</div>
                                    </div>
                                </button>
                                <button type="button" class="modal-mbti-button" data-type="ENTJ">
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-dark mb-2">ENTJ</div>
                                        <div class="text-sm font-semibold text-gray-700 mb-1">The Commander</div>
                                        <div class="text-xs text-gray-600">Bold & Decisive</div>
                                    </div>
                                </button>
                                <button type="button" class="modal-mbti-button" data-type="ENTP">
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-dark mb-2">ENTP</div>
                                        <div class="text-sm font-semibold text-gray-700 mb-1">The Debater</div>
                                        <div class="text-xs text-gray-600">Quick & Ingenious</div>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <!-- Diplomats Group -->
                        <div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                <button type="button" class="modal-mbti-button" data-type="INFJ">
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-dark mb-2">INFJ</div>
                                        <div class="text-sm font-semibold text-gray-700 mb-1">The Advocate</div>
                                        <div class="text-xs text-gray-600">Creative & Insightful</div>
                                    </div>
                                </button>
                                <button type="button" class="modal-mbti-button" data-type="INFP">
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-dark mb-2">INFP</div>
                                        <div class="text-sm font-semibold text-gray-700 mb-1">The Mediator</div>
                                        <div class="text-xs text-gray-600">Poetic & Kind</div>
                                    </div>
                                </button>
                                <button type="button" class="modal-mbti-button" data-type="ENFJ">
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-dark mb-2">ENFJ</div>
                                        <div class="text-sm font-semibold text-gray-700 mb-1">The Protagonist</div>
                                        <div class="text-xs text-gray-600">Charismatic & Inspiring</div>
                                    </div>
                                </button>
                                <button type="button" class="modal-mbti-button" data-type="ENFP">
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-dark mb-2">ENFP</div>
                                        <div class="text-sm font-semibold text-gray-700 mb-1">The Campaigner</div>
                                        <div class="text-xs text-gray-600">Enthusiastic & Creative</div>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <!-- Sentinels Group -->
                        <div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                <button type="button" class="modal-mbti-button" data-type="ISTJ">
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-dark mb-2">ISTJ</div>
                                        <div class="text-sm font-semibold text-gray-700 mb-1">The Logistician</div>
                                        <div class="text-xs text-gray-600">Practical & Reliable</div>
                                    </div>
                                </button>
                                <button type="button" class="modal-mbti-button" data-type="ISFJ">
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-dark mb-2">ISFJ</div>
                                        <div class="text-sm font-semibold text-gray-700 mb-1">The Protector</div>
                                        <div class="text-xs text-gray-600">Warm & Conscientious</div>
                                    </div>
                                </button>
                                <button type="button" class="modal-mbti-button" data-type="ESTJ">
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-dark mb-2">ESTJ</div>
                                        <div class="text-sm font-semibold text-gray-700 mb-1">The Executive</div>
                                        <div class="text-xs text-gray-600">Organized & Driven</div>
                                    </div>
                                </button>
                                <button type="button" class="modal-mbti-button" data-type="ESFJ">
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-dark mb-2">ESFJ</div>
                                        <div class="text-sm font-semibold text-gray-700 mb-1">The Consul</div>
                                        <div class="text-xs text-gray-600">Caring & Social</div>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <!-- Explorers Group -->
                        <div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                <button type="button" class="modal-mbti-button" data-type="ISTP">
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-dark mb-2">ISTP</div>
                                        <div class="text-sm font-semibold text-gray-700 mb-1">The Virtuoso</div>
                                        <div class="text-xs text-gray-600">Bold & Practical</div>
                                    </div>
                                </button>
                                <button type="button" class="modal-mbti-button" data-type="ISFP">
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-dark mb-2">ISFP</div>
                                        <div class="text-sm font-semibold text-gray-700 mb-1">The Adventurer</div>
                                        <div class="text-xs text-gray-600">Flexible & Charming</div>
                                    </div>
                                </button>
                                <button type="button" class="modal-mbti-button" data-type="ESTP">
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-dark mb-2">ESTP</div>
                                        <div class="text-sm font-semibold text-gray-700 mb-1">The Entrepreneur</div>
                                        <div class="text-xs text-gray-600">Smart & Energetic</div>
                                    </div>
                                </button>
                                <button type="button" class="modal-mbti-button" data-type="ESFP">
                                    <div class="text-center">
                                        <div class="text-xl font-bold text-dark mb-2">ESFP</div>
                                        <div class="text-sm font-semibold text-gray-700 mb-1">The Entertainer</div>
                                        <div class="text-xs text-gray-600">Spontaneous & Enthusiastic</div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Don't Know Your Type Section -->
                    <div class="mt-8 p-4 bg-gray-100 border border-gray-300 rounded-lg">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-question-circle text-gray-600 mt-0.5"></i>
                            <div>
                                <h5 class="text-sm font-semibold text-gray-800">Don't know your MBTI type?</h5>
                                <a href="https://www.16personalities.com/free-personality-test"
                                    target="_blank"
                                    class="inline-flex items-center text-sm font-medium text-dark hover:text-lime transition-colors duration-200 underline underline-offset-2 hover:underline-offset-4">
                                    Take Free Test
                                    <i class="fas fa-external-link-alt ml-2 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 justify-end pt-4 border-t border-gray-200">
                    <!-- Clear Selection Button (only show when editing) -->
                    <button
                        type="button"
                        id="clear-mbti-button"
                        class="group relative inline-flex items-center justify-center gap-2 px-6 py-3 bg-red-50 text-red-600 font-medium rounded-xl transition-all duration-300 shadow-sm hover:shadow-md hover:bg-red-100 focus:outline-none focus:ring-4 focus:ring-red-300/50 focus:ring-offset-2 w-full sm:w-auto transform hover:scale-105 overflow-hidden border border-red-200 hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/30 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <i class="fas fa-trash relative z-10"></i>
                        <span class="relative z-10">Clear Selection</span>
                    </button>

                    <!-- Cancel Button -->
                    <button
                        type="button"
                        id="cancel-mbti-changes"
                        onclick="closeMbtiModal()"
                        class="group relative inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 text-dark font-medium rounded-xl transition-all duration-300 shadow-sm hover:shadow-md focus:outline-none focus:ring-4 focus:ring-gray-300/50 focus:ring-offset-2 w-full sm:w-auto transform hover:scale-105 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/50 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <span class="relative z-10">Cancel</span>
                    </button>

                    <!-- Save Button -->
                    <button
                        type="submit"
                        id="save-mbti-button"
                        class="group relative inline-flex items-center justify-center gap-2 px-6 py-3 bg-dark text-white font-medium rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-lime-500/30 focus:ring-offset-2 w-full sm:w-auto transform hover:scale-105 overflow-hidden disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled>
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <i class="fas fa-save relative z-10"></i>
                        <span class="relative z-10">Save MBTI Type</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .modal-mbti-button {
        @apply p-4 bg-white border-2 border-gray-200 rounded-xl hover:border-lime hover:bg-lime/5 transition-all duration-200 cursor-pointer focus:outline-none focus:ring-2 focus:ring-lime focus:ring-offset-2;
    }

    .modal-mbti-button.selected {
        @apply border-lime bg-lime/10 shadow-md;
    }

    .modal-mbti-button:hover {
        @apply transform -translate-y-0.5 shadow-lg;
    }
</style>