<div id="mbti-form" class="bg-white rounded-2xl shadow-lg p-8 border-2" style="display: none;">
    <!-- Header Section -->
    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-dark rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
            <i class="fas fa-user-circle text-lime text-2xl"></i>
        </div>
        <h3 class="text-3xl font-bold text-dark mb-3 font-sans">Personality Type</h3>
        <p class="text-gray-600 text-lg font-sans max-w-2xl mx-auto">
            Complete your profile by selecting your MBTI personality type. This helps us match you with careers that align with your natural preferences and work style.
        </p>
    </div>

    <!-- Progress Indicator -->
    <div class="flex justify-center mb-8">
        <div class="flex items-center space-x-4 bg-cream/50 rounded-full px-6 py-3 border border-border">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-lime rounded-full flex items-center justify-center">
                    <i class="fas fa-check text-dark text-sm"></i>
                </div>
                <span class="text-sm font-medium text-dark font-sans">Quiz Complete</span>
            </div>
            <div class="w-12 h-0.5 bg-lime"></div>
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-lime rounded-full flex items-center justify-center">
                    <i class="fas fa-check text-dark text-sm"></i>
                </div>
                <span class="text-sm font-medium text-dark font-sans">Academic Data</span>
            </div>
            <div class="w-12 h-0.5 bg-dark"></div>
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-dark rounded-full flex items-center justify-center ring-2 ring-dark ring-offset-2">
                    <span class="text-lime text-sm font-bold">3</span>
                </div>
                <span class="text-sm font-medium text-dark font-sans">Personality Type</span>
            </div>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="bg-gray-50/50 rounded-xl p-6 mb-8 border border-gray-200">
        <!-- Section Title -->
        <div class="flex items-center mb-6">
            <div class="w-1 h-6 bg-dark rounded-full mr-3"></div>
            <h4 class="text-lg font-bold text-dark font-sans">Choose Your Personality Type</h4>
            <div class="ml-auto">
                <span class="text-sm text-gray-600 font-sans" id="selection-status">
                    Please make a selection
                </span>
            </div>
        </div>

        <!-- Hidden input to store selected MBTI type -->
        <input type="hidden" id="mbti-type" name="mbti_type" value="">

        <!-- MBTI Types Grid -->
        <div class="space-y-8">
          
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <button type="button" class="mbti-button" data-type="INTJ">
                        <div class="text-center">
                            <div class="text-xl font-bold text-dark mb-2 font-sans">INTJ</div>
                            <div class="text-sm font-semibold text-gray-700 mb-1 font-sans">The Architect</div>
                            <div class="text-xs text-gray-600 font-sans">Strategic & Innovative</div>
                        </div>
                    </button>
                    <button type="button" class="mbti-button" data-type="INTP">
                        <div class="text-center">
                            <div class="text-xl font-bold text-dark mb-2 font-sans">INTP</div>
                            <div class="text-sm font-semibold text-gray-700 mb-1 font-sans">The Thinker</div>
                            <div class="text-xs text-gray-600 font-sans">Logical & Creative</div>
                        </div>
                    </button>
                    <button type="button" class="mbti-button" data-type="ENTJ">
                        <div class="text-center">
                            <div class="text-xl font-bold text-dark mb-2 font-sans">ENTJ</div>
                            <div class="text-sm font-semibold text-gray-700 mb-1 font-sans">The Commander</div>
                            <div class="text-xs text-gray-600 font-sans">Bold & Decisive</div>
                        </div>
                    </button>
                    <button type="button" class="mbti-button" data-type="ENTP">
                        <div class="text-center">
                            <div class="text-xl font-bold text-dark mb-2 font-sans">ENTP</div>
                            <div class="text-sm font-semibold text-gray-700 mb-1 font-sans">The Debater</div>
                            <div class="text-xs text-gray-600 font-sans">Quick & Ingenious</div>
                        </div>
                    </button>
                </div>
  

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <button type="button" class="mbti-button" data-type="INFJ">
                        <div class="text-center">
                            <div class="text-xl font-bold text-dark mb-2 font-sans">INFJ</div>
                            <div class="text-sm font-semibold text-gray-700 mb-1 font-sans">The Advocate</div>
                            <div class="text-xs text-gray-600 font-sans">Creative & Insightful</div>
                        </div>
                    </button>
                    <button type="button" class="mbti-button" data-type="INFP">
                        <div class="text-center">
                            <div class="text-xl font-bold text-dark mb-2 font-sans">INFP</div>
                            <div class="text-sm font-semibold text-gray-700 mb-1 font-sans">The Mediator</div>
                            <div class="text-xs text-gray-600 font-sans">Poetic & Kind</div>
                        </div>
                    </button>
                    <button type="button" class="mbti-button" data-type="ENFJ">
                        <div class="text-center">
                            <div class="text-xl font-bold text-dark mb-2 font-sans">ENFJ</div>
                            <div class="text-sm font-semibold text-gray-700 mb-1 font-sans">The Protagonist</div>
                            <div class="text-xs text-gray-600 font-sans">Charismatic & Inspiring</div>
                        </div>
                    </button>
                    <button type="button" class="mbti-button" data-type="ENFP">
                        <div class="text-center">
                            <div class="text-xl font-bold text-dark mb-2 font-sans">ENFP</div>
                            <div class="text-sm font-semibold text-gray-700 mb-1 font-sans">The Campaigner</div>
                            <div class="text-xs text-gray-600 font-sans">Enthusiastic & Creative</div>
                        </div>
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <button type="button" class="mbti-button" data-type="ISTJ">
                        <div class="text-center">
                            <div class="text-xl font-bold text-dark mb-2 font-sans">ISTJ</div>
                            <div class="text-sm font-semibold text-gray-700 mb-1 font-sans">The Logistician</div>
                            <div class="text-xs text-gray-600 font-sans">Practical & Reliable</div>
                        </div>
                    </button>
                    <button type="button" class="mbti-button" data-type="ISFJ">
                        <div class="text-center">
                            <div class="text-xl font-bold text-dark mb-2 font-sans">ISFJ</div>
                            <div class="text-sm font-semibold text-gray-700 mb-1 font-sans">The Protector</div>
                            <div class="text-xs text-gray-600 font-sans">Warm & Conscientious</div>
                        </div>
                    </button>
                    <button type="button" class="mbti-button" data-type="ESTJ">
                        <div class="text-center">
                            <div class="text-xl font-bold text-dark mb-2 font-sans">ESTJ</div>
                            <div class="text-sm font-semibold text-gray-700 mb-1 font-sans">The Executive</div>
                            <div class="text-xs text-gray-600 font-sans">Organized & Driven</div>
                        </div>
                    </button>
                    <button type="button" class="mbti-button" data-type="ESFJ">
                        <div class="text-center">
                            <div class="text-xl font-bold text-dark mb-2 font-sans">ESFJ</div>
                            <div class="text-sm font-semibold text-gray-700 mb-1 font-sans">The Consul</div>
                            <div class="text-xs text-gray-600 font-sans">Caring & Social</div>
                        </div>
                    </button>
                </div>


                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <button type="button" class="mbti-button" data-type="ISTP">
                        <div class="text-center">
                            <div class="text-xl font-bold text-dark mb-2 font-sans">ISTP</div>
                            <div class="text-sm font-semibold text-gray-700 mb-1 font-sans">The Virtuoso</div>
                            <div class="text-xs text-gray-600 font-sans">Bold & Practical</div>
                        </div>
                    </button>
                    <button type="button" class="mbti-button" data-type="ISFP">
                        <div class="text-center">
                            <div class="text-xl font-bold text-dark mb-2 font-sans">ISFP</div>
                            <div class="text-sm font-semibold text-gray-700 mb-1 font-sans">The Adventurer</div>
                            <div class="text-xs text-gray-600 font-sans">Flexible & Charming</div>
                        </div>
                    </button>
                    <button type="button" class="mbti-button" data-type="ESTP">
                        <div class="text-center">
                            <div class="text-xl font-bold text-dark mb-2 font-sans">ESTP</div>
                            <div class="text-sm font-semibold text-gray-700 mb-1 font-sans">The Entrepreneur</div>
                            <div class="text-xs text-gray-600 font-sans">Smart & Energetic</div>
                        </div>
                    </button>
                    <button type="button" class="mbti-button" data-type="ESFP">
                        <div class="text-center">
                            <div class="text-xl font-bold text-dark mb-2 font-sans">ESFP</div>
                            <div class="text-sm font-semibold text-gray-700 mb-1 font-sans">The Entertainer</div>
                            <div class="text-xs text-gray-600 font-sans">Spontaneous & Enthusiastic</div>
                        </div>
                    </button>
                </div>
            </div>


        <!-- Don't Know Your Type Section -->
        <div class="mt-6 p-4 bg-gray-100 border border-gray-300 rounded-lg">
            <div class="flex items-start space-x-3">
            <i class="fas fa-question-circle text-gray-600 mt-0.5"></i>
            <div>
                <h5 class="text-sm font-semibold text-gray-800 font-sans">Don't know your MBTI type?</h5>
                <p class="text-sm text-gray-600 font-sans leading-relaxed">
                    Take a free personality test to discover your personality type. <a href="https://www.16personalities.com/free-personality-test" 
                   target="_blank" 
                   class="inline-flex items-center mt-3 text-sm font-medium text-dark hover:text-lime transition-colors duration-200 underline underline-offset-2 hover:underline-offset-4 font-sans">
                    Take Free Test
                    <i class="fas fa-external-link-alt ml-2 text-xs"></i>
                </a>
                </p>
            </div>
            </div>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6 border-t border-gray-200">
        <button
            id="back-to-grades-btn"
            type="button"
            class="px-6 py-3 bg-cream text-dark font-bold rounded-xl border-2 hover:bg-dark hover:text-lime transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed shadow-sm font-sans flex items-center justify-center group">
            <i class="fas fa-arrow-left mr-3 group-hover:-translate-x-1 transition-transform duration-200"></i>
            Academic Data
        </button>

        <div class="flex items-center space-x-4">

            <!-- Complete Button -->
            <button
                id="complete-quiz-btn"
                type="button"
                class="px-6 py-3 bg-lime text-dark font-bold rounded-xl border-2 hover:bg-dark hover:text-lime transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-dark disabled:hover:text-lime shadow-lg font-sans flex items-center group"
                disabled>
                Generate Results
                <i class="fas fa-magic ml-3 group-hover:rotate-12 transition-transform duration-200"></i>
            </button>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mbtiButtons = document.querySelectorAll('.mbti-button');
    const mbtiInput = document.getElementById('mbti-type');
    const completeBtn = document.getElementById('complete-quiz-btn');
    const selectionStatus = document.getElementById('selection-status');
    const validationMsg = document.getElementById('mbti-validation-message');
    const successMsg = document.getElementById('mbti-success-message');

    function updateSelection(selectedType, selectedButton) {
        // Remove selected class from all buttons
        mbtiButtons.forEach(btn => btn.classList.remove('selected'));
        
        // Add selected class to clicked button
        selectedButton.classList.add('selected');
        
        // Update hidden input
        mbtiInput.value = selectedType;
        
        // Update status
        selectionStatus.textContent = `${selectedType} selected ✓`;
        selectionStatus.className = 'text-sm text-dark font-medium font-sans';
        
        // Update button state
        completeBtn.disabled = false;
        validationMsg.classList.add('hidden');
        successMsg.classList.remove('hidden');
    }

    // Add event listeners to all MBTI buttons
    mbtiButtons.forEach(button => {
        button.addEventListener('click', function() {
            const selectedType = this.getAttribute('data-type');
            updateSelection(selectedType, this);
        });
    });
    
    // Show validation message if user tries to continue without selection
    completeBtn.addEventListener('click', function() {
        if (!mbtiInput.value) {
            validationMsg.classList.remove('hidden');
        }
    });
});
</script>