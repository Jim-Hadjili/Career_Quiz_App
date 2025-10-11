<!-- Quiz Access Modal -->
<div id="quiz-access-modal" class="fixed inset-0 bg-black bg-opacity-50 z-[105] hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg mx-auto transform transition-all duration-300 scale-95 opacity-0" id="quiz-access-modal-content">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-lime rounded-full flex items-center justify-center">
                    <i class="fas fa-clipboard-list text-dark text-lg"></i>
                </div>
                <h2 class="text-2xl font-bold text-dark">Ready to Start Your Quiz?</h2>
            </div>
            <button id="close-quiz-access-modal" class="text-gray-500 hover:text-dark transition-colors text-2xl focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <!-- Illustration -->
            <div class="text-center mb-6">
                <div class="w-20 h-20 bg-lime/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-graduation-cap text-dark text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark mb-3">Get the Most Out of Your Quiz</h3>
                <p class="text-gray-600 leading-relaxed">
                    Creating an account allows you to save your results, track your progress, and receive personalized career recommendations based on your quiz outcomes.
                </p>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3">
                <!-- Create Account Button (Primary) -->
                <button 
                    type="button" 
                    id="create-account-from-quiz"
                    onclick="openSignUpModalFromQuiz()"
                    class="group relative inline-flex items-center justify-center gap-3 px-6 py-4 bg-dark text-white font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-lime-500/30 focus:ring-offset-2 w-full sm:flex-1 transform hover:scale-105 overflow-hidden"
                >
                    <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    <i class="fas fa-user-plus relative z-10"></i>
                    <span class="relative z-10">Create Account</span>
                </button>
                
                <!-- Continue as Guest Button (Secondary) -->
                <button 
                    type="button" 
                    id="continue-as-guest"
                    onclick="continueAsGuest()"
                    class="group relative inline-flex items-center justify-center gap-3 px-6 py-4 bg-white text-dark border-2 border-gray-300 font-medium rounded-xl transition-all duration-300 shadow-sm hover:shadow-md hover:border-dark focus:outline-none focus:ring-4 focus:ring-gray-300/50 focus:ring-offset-2 w-full sm:flex-1 transform hover:scale-105 overflow-hidden"
                >
                    <div class="absolute inset-0 bg-gradient-to-r from-gray-50/0 via-gray-50/50 to-gray-50/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    <i class="fas fa-user-clock relative z-10"></i>
                    <span class="relative z-10">Continue as Guest</span>
                </button>
            </div>
            
            <!-- Guest Mode Info -->
            <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-xl">
                <div class="flex items-start space-x-3">
                    <i class="fas fa-info-circle text-yellow-600 text-sm mt-0.5 flex-shrink-0"></i>
                    <div>
                        <p class="text-xs text-yellow-800 font-medium mb-1">Guest Mode Limitations:</p>
                        <p class="text-xs text-yellow-700">Quiz results won't be saved and you'll need to retake the quiz if you want to access results later.</p>
                    </div>
                </div>
            </div>

            <!-- Bottom Text -->
            <div class="text-center mt-6 pt-4 border-t border-gray-200">
                <p class="text-xs text-gray-500">
                    Creating an account is free and takes less than a minute
                </p>
            </div>
        </div>
    </div>
</div>