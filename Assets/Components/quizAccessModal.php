<!-- Quiz Access Modal -->
<div id="quiz-access-modal" class="fixed inset-0 bg-black bg-opacity-50 z-[105] hidden flex items-center justify-center p-3">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-auto transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto" id="quiz-access-modal-content">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-4 border-b border-gray-200">
            <div class="flex items-center space-x-2">
                <div class="w-6 h-6 bg-lime rounded-full flex items-center justify-center">
                    <i class="fas fa-clipboard-list text-dark text-sm"></i>
                </div>
                <h2 class="text-lg font-bold text-dark">Ready to Start?</h2>
            </div>
            <button id="close-quiz-access-modal" class="text-gray-500 hover:text-dark transition-colors text-xl focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-4">
            <!-- Illustration -->
            <div class="text-center mb-4">
                <div class="w-12 h-12 bg-lime/20 rounded-full flex items-center justify-center mx-auto mb-2">
                    <i class="fas fa-graduation-cap text-dark text-xl"></i>
                </div>
                <h3 class="text-base font-bold text-dark mb-2">Get the Most Out of Your Quiz</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Creating an account allows you to save your results, and track your progress at any time.
                </p>
            </div>

            <!-- Benefits Section -->
            <div class="bg-cream rounded-xl p-3 mb-4">
                <h4 class="text-sm font-semibold text-dark mb-2 text-center">With an Account, You Get:</h4>
                <div class="grid grid-cols-2 gap-2 text-xs">
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-4 bg-lime rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-save text-dark" style="font-size: 8px;"></i>
                        </div>
                        <span class="text-dark">Save and access your quiz results anytime</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-4 bg-lime rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-chart-line text-dark" style="font-size: 8px;"></i>
                        </div>
                        <span class="text-dark">Track your career progress
                        </span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-4 bg-lime rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-lightbulb text-dark" style="font-size: 8px;"></i>
                        </div>
                        <span class="text-dark">Get career recommendations</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-4 bg-lime rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-redo text-dark" style="font-size: 8px;"></i>
                        </div>
                        <span class="text-dark">Retake quizzes and compare results over time</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-2 mb-3">
                <!-- Create Account Button (Primary) -->
                <button
                    type="button"
                    id="create-account-from-quiz"
                    onclick="openSignUpModalFromQuiz()"
                    class="group relative inline-flex items-center justify-center gap-2 px-4 py-3 bg-dark text-white font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-lime-500/30 focus:ring-offset-2 w-full transform hover:scale-105 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    <i class="fas fa-user-plus relative z-10 text-sm"></i>
                    <span class="relative z-10 text-sm">Create Account</span>
                </button>

                <!-- Continue as Guest Button (Secondary) -->
                <button
                    type="button"
                    id="continue-as-guest"
                    onclick="continueAsGuest()"
                    class="group relative inline-flex items-center justify-center gap-2 px-4 py-3 bg-white text-dark border-2 border-gray-300 font-medium rounded-xl transition-all duration-300 shadow-sm hover:shadow-md hover:border-dark focus:outline-none focus:ring-4 focus:ring-gray-300/50 focus:ring-offset-2 w-full transform hover:scale-105 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-gray-50/0 via-gray-50/50 to-gray-50/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    <i class="fas fa-user-clock relative z-10 text-sm"></i>
                    <span class="relative z-10 text-sm">Continue as Guest</span>
                </button>
            </div>

            <!-- Guest Mode Info -->
            <div class="p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                <div class="flex items-start space-x-2">
                    <i class="fas fa-info-circle text-yellow-600 text-xs mt-0.5 flex-shrink-0"></i>
                    <div>
                        <p class="text-xs text-yellow-800 font-medium">Guest Mode:</p>
                        <p class="text-xs text-yellow-700">Quiz results won't be saved and you'll need to retake the quiz if you want to access results later.</p>
                    </div>
                </div>
            </div>

            <!-- Bottom Text -->
            <div class="text-center mt-3 pt-3 border-t border-gray-200">
                <p class="text-xs text-gray-500">
                    Creating an account is free and takes less than a minute
                </p>
            </div>
        </div>
    </div>
</div>