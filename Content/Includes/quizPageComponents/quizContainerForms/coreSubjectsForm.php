<div id="core-subjects-form" class="bg-white rounded-2xl shadow-lg p-8 border-2" style="display: none;">
    <!-- Header Section -->
    <div class="text-center mb-8">
        <div class="w-16 h-16 bg-crimson_red rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
            <i class="fas fa-graduation-cap text-white text-2xl"></i>
        </div>
        <h3 class="text-3xl font-bold text-dark mb-3 font-sans">Academic Data</h3>
        <p class="text-gray-600 text-lg font-sans max-w-2xl mx-auto">
            Help us understand your academic strengths by providing your grades in these core subjects.
            This will enable more personalized career recommendations.
        </p>
    </div>

    <!-- Progress Indicator -->
    <div class="flex justify-center mb-8">
        <div class="flex items-center space-x-4 bg-cream/50 rounded-full px-6 py-3 border border-border">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-crimson_red rounded-full flex items-center justify-center">
                    <i class="fas fa-check text-white text-sm"></i>
                </div>
                <span class="text-sm font-medium text-dark font-sans">Quiz Complete</span>
            </div>
            <div class="w-12 h-0.5 bg-border"></div>
            <div class="flex items-center space-x-2">
                <div
                    class="w-8 h-8 bg-dark rounded-full flex items-center justify-center ring-2 ring-dark ring-offset-2">
                    <span class="text-white text-sm font-bold">2</span>
                </div>
                <span class="text-sm font-medium text-dark font-sans">Academic Data</span>
            </div>
            <div class="w-12 h-0.5 bg-gray-300"></div>
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                    <span class="text-gray-500 text-sm font-bold">3</span>
                </div>
                <span class="text-sm font-medium text-gray-500 font-sans">Personality Type</span>
            </div>
        </div>
    </div>

    <!-- Form Fields Container -->
    <div class="bg-gray-50/50 rounded-xl p-6 mb-8 border border-gray-200">
        <!-- Section Title -->
        <div class="flex items-center mb-6">
            <div class="w-1 h-6 bg-dark rounded-full mr-3"></div>
            <h4 class="text-lg font-bold text-dark font-sans">Core Subject Grades</h4>
            <div class="ml-auto">
                <span class="text-sm text-gray-600 font-sans">
                    <span id="filled-subjects">0</span> of 9 completed
                </span>
            </div>
        </div>

        <!-- Subject Grades Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 max-h-[500px] overflow-y-auto pr-2">

            <!-- Statistics and Probability -->
            <div
                class="bg-white p-5 rounded-xl border border-gray-200 hover:border-dark/20 transition-all duration-200 hover:shadow-md">
                <div class="flex items-start justify-between mb-3">
                    <label for="statistics-grade" class="block text-sm font-bold text-dark font-sans leading-tight">
                        Statistics and Probability
                    </label>
                    <span class="text-red-500 text-sm">*</span>
                </div>
                <input type="number" id="statistics-grade" name="Statistics_and_Probability"
                    class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-dark focus:outline-none font-sans text-center text-lg font-medium hover:border-gray-300 transition-colors duration-200"
                    placeholder="85.5" min="0" max="100" step="0.01" required>
            </div>

            <!-- Physical Science -->
            <div
                class="bg-white p-5 rounded-xl border border-gray-200 hover:border-dark/20 transition-all duration-200 hover:shadow-md">
                <div class="flex items-start justify-between mb-3">
                    <label for="physical-science-grade"
                        class="block text-sm font-bold text-dark font-sans leading-tight">
                        Physical Science
                    </label>
                    <span class="text-red-500 text-sm">*</span>
                </div>
                <input type="number" id="physical-science-grade" name="Physical_Science"
                    class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-dark focus:outline-none font-sans text-center text-lg font-medium hover:border-gray-300 transition-colors duration-200"
                    placeholder="90.0" min="0" max="100" step="0.01" required>
            </div>

            <!-- Oral Communication in Context -->
            <div
                class="bg-white p-5 rounded-xl border border-gray-200 hover:border-dark/20 transition-all duration-200 hover:shadow-md">
                <div class="flex items-start justify-between mb-3">
                    <label for="oral-comm-grade" class="block text-sm font-bold text-dark font-sans leading-tight">
                        Oral Communication
                    </label>
                    <span class="text-red-500 text-sm">*</span>
                </div>
                <input type="number" id="oral-comm-grade" name="oral_comm_context"
                    class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-dark focus:outline-none font-sans text-center text-lg font-medium hover:border-gray-300 transition-colors duration-200"
                    placeholder="88.0" min="0" max="100" step="0.01" required>
            </div>

            <!-- General Mathematics -->
            <div
                class="bg-white p-5 rounded-xl border border-gray-200 hover:border-dark/20 transition-all duration-200 hover:shadow-md">
                <div class="flex items-start justify-between mb-3">
                    <label for="general-math-grade" class="block text-sm font-bold text-dark font-sans leading-tight">
                        General Mathematics
                    </label>
                    <span class="text-red-500 text-sm">*</span>
                </div>
                <input type="number" id="general-math-grade" name="general_math"
                    class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-dark focus:outline-none font-sans text-center text-lg font-medium hover:border-gray-300 transition-colors duration-200"
                    placeholder="92.5" min="0" max="100" step="0.01" required>
            </div>

            <!-- Earth and Life Science -->
            <div
                class="bg-white p-5 rounded-xl border border-gray-200 hover:border-dark/20 transition-all duration-200 hover:shadow-md">
                <div class="flex items-start justify-between mb-3">
                    <label for="earth-life-sci-grade" class="block text-sm font-bold text-dark font-sans leading-tight">
                        Earth and Life Science
                    </label>
                    <span class="text-red-500 text-sm">*</span>
                </div>
                <input type="number" id="earth-life-sci-grade" name="earth_life_sci"
                    class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-dark focus:outline-none font-sans text-center text-lg font-medium hover:border-gray-300 transition-colors duration-200"
                    placeholder="87.0" min="0" max="100" step="0.01" required>
            </div>

            <!-- Understanding Culture, Society and Politics -->
            <div
                class="bg-white p-5 rounded-xl border border-gray-200 hover:border-dark/20 transition-all duration-200 hover:shadow-md">
                <div class="flex items-start justify-between mb-3">
                    <label for="ucsp-grade" class="block text-sm font-bold text-dark font-sans leading-tight">
                        Culture, Society & Politics
                    </label>
                    <span class="text-red-500 text-sm">*</span>
                </div>
                <input type="number" id="ucsp-grade" name="ucsp"
                    class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-dark focus:outline-none font-sans text-center text-lg font-medium hover:border-gray-300 transition-colors duration-200"
                    placeholder="89.0" min="0" max="100" step="0.01" required>
            </div>

            <!-- Reading and Writing -->
            <div
                class="bg-white p-5 rounded-xl border border-gray-200 hover:border-dark/20 transition-all duration-200 hover:shadow-md">
                <div class="flex items-start justify-between mb-3">
                    <label for="reading-writing-grade"
                        class="block text-sm font-bold text-dark font-sans leading-tight">
                        Reading and Writing
                    </label>
                    <span class="text-red-500 text-sm">*</span>
                </div>
                <input type="number" id="reading-writing-grade" name="reading_writing"
                    class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-dark focus:outline-none font-sans text-center text-lg font-medium hover:border-gray-300 transition-colors duration-200"
                    placeholder="91.0" min="0" max="100" step="0.01" required>
            </div>

            <!-- 21st Century Literature -->
            <div
                class="bg-white p-5 rounded-xl border border-gray-200 hover:border-dark/20 transition-all duration-200 hover:shadow-md">
                <div class="flex items-start justify-between mb-3">
                    <label for="lit21-ph-world-grade" class="block text-sm font-bold text-dark font-sans leading-tight">
                        21st Century Literature
                    </label>
                    <span class="text-red-500 text-sm">*</span>
                </div>
                <input type="number" id="lit21-ph-world-grade" name="lit21_ph_world"
                    class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-dark focus:outline-none font-sans text-center text-lg font-medium hover:border-gray-300 transition-colors duration-200"
                    placeholder="86.5" min="0" max="100" step="0.01" required>
            </div>

            <!-- Media and Information Literacy -->
            <div
                class="bg-white p-5 rounded-xl border border-gray-200 hover:border-dark/20 transition-all duration-200 hover:shadow-md">
                <div class="flex items-start justify-between mb-3">
                    <label for="media-info-lit-grade" class="block text-sm font-bold text-dark font-sans leading-tight">
                        Media & Information Literacy
                    </label>
                    <span class="text-red-500 text-sm">*</span>
                </div>
                <input type="number" id="media-info-lit-grade" name="media_info_lit"
                    class="w-full p-3 border-2 border-gray-200 rounded-lg focus:border-dark focus:outline-none font-sans text-center text-lg font-medium hover:border-gray-300 transition-colors duration-200"
                    placeholder="93.0" min="0" max="100" step="0.01" required>
            </div>

        </div>

    </div>

    <!-- Navigation Buttons -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6 border-t border-gray-200">
        <button id="back-to-quiz-btn" type="button"
            class="px-6 py-3 bg-cream text-dark font-bold rounded-xl border-2 hover:bg-navy_blue hover:text-white transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed shadow-sm font-sans flex items-center justify-center group">
            <i class="fas fa-arrow-left mt-[2px] mr-3 group-hover:-translate-x-1 transition-transform duration-200"></i>
            Back to Quiz
        </button>

        <div class="flex items-center space-x-4">
            <!-- Continue Button -->
            <button id="continue-to-mbti-btn" type="button"
                class="px-6 py-3 bg-dark text-white font-bold rounded-xl border-2 hover:bg-navy_blue hover:text-white transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed shadow-sm font-sans flex items-center group"
                disabled>
                Personality Type
                <i
                    class="fas fa-arrow-right mt-[2px] ml-3 group-hover:translate-x-1 transition-transform duration-200"></i>
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('#core-subjects-form input[type="number"]');
    const continueBtn = document.getElementById('continue-to-mbti-btn');
    const filledCounter = document.getElementById('filled-subjects');
    const validationMsg = document.getElementById('validation-message');
    const successMsg = document.getElementById('success-message');

    // Function to validate and adjust grade values
    function validateGrade(input) {
        let value = parseFloat(input.value);

        // If empty or not a number, don't validate
        if (input.value.trim() === '' || isNaN(value)) {
            return;
        }

        // Only adjust if value is outside the valid range (65-100)
        if (value < 65) {
            input.value = 65;
            showGradeAdjustmentFeedback(input, 'minimum');
        } else if (value > 100) {
            input.value = 100;
            showGradeAdjustmentFeedback(input, 'maximum');
        }
        // If value is between 65-100, no adjustment needed
    }

    // Function to show visual feedback when grade is adjusted
    function showGradeAdjustmentFeedback(input, type) {
        const parent = input.parentElement;
        let message = type === 'minimum' ? 'Minimum grade (65%)' : 'Maximum grade (100%)';

        // Remove existing feedback
        const existingFeedback = parent.querySelector('.grade-feedback');
        if (existingFeedback) {
            existingFeedback.remove();
        }

        // Add feedback message
        const feedback = document.createElement('div');
        feedback.className = 'grade-feedback text-xs text-orange-600 mt-1 font-medium';
        feedback.textContent = message;
        parent.appendChild(feedback);

        // Add temporary visual highlight
        input.classList.add('border-orange-400', 'bg-orange-50');

        // Remove feedback and highlight after 3 seconds
        setTimeout(() => {
            if (feedback.parentElement) {
                feedback.remove();
            }
            input.classList.remove('border-orange-400', 'bg-orange-50');
        }, 3000);
    }

    function updateProgress() {
        const filledInputs = Array.from(inputs).filter(input => input.value.trim() !== '');
        const filledCount = filledInputs.length;

        // Update counter
        filledCounter.textContent = filledCount;

        // Update button state and messages
        if (filledCount === inputs.length) {
            continueBtn.disabled = false;
            if (validationMsg) validationMsg.classList.add('hidden');
            if (successMsg) successMsg.classList.remove('hidden');
        } else {
            continueBtn.disabled = true;
            if (successMsg) successMsg.classList.add('hidden');
            if (filledCount > 0 && validationMsg) {
                validationMsg.classList.remove('hidden');
            }
        }
    }

    // Add event listeners to all inputs
    inputs.forEach(input => {
        // Set min and max attributes for HTML5 validation
        input.setAttribute('min', '65');
        input.setAttribute('max', '100');

        // Real-time validation on input (only for complete values)
        input.addEventListener('input', function() {
            // Only validate if the user has finished typing (value looks complete)
            const value = parseFloat(this.value);
            if (!isNaN(value) && this.value.length >= 2) {
                validateGrade(this);
            }
            updateProgress();
        });

        // Validation when user leaves the field
        input.addEventListener('blur', function() {
            validateGrade(this);

            // Add visual feedback for completed fields
            if (this.value.trim() !== '') {
                this.classList.add('border-navy_blue');
            } else {
                this.classList.remove('border-navy_blue');
            }

            updateProgress();
        });

        // Allow decimal input and prevent invalid characters
        input.addEventListener('keydown', function(e) {
            if ([46, 8, 9, 27, 13, 110, 190].indexOf(e.keyCode) !== -1 ||
                (e.keyCode === 65 && e.ctrlKey === true) ||
                (e.keyCode === 67 && e.ctrlKey === true) ||
                (e.keyCode === 86 && e.ctrlKey === true) ||
                (e.keyCode === 88 && e.ctrlKey === true) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                return;
            }
            // Ensure that it is a number and stop the keypress for invalid characters
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e
                    .keyCode > 105)) {
                e.preventDefault();
            }
        });
    });

    updateProgress();
});
</script>