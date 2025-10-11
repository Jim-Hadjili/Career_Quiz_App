<!-- Sign Up/Sign In Modal -->
<div id="signup-modal" class="fixed inset-0 bg-black bg-opacity-50 z-[100] hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md mx-auto transform transition-all duration-300 scale-95 opacity-0" id="modal-content">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-dark rounded-full flex items-center justify-center">
                    <i class="fas fa-compass text-lime text-lg"></i>
                </div>
                <h2 id="modal-title" class="text-2xl font-bold text-dark">Join CareerPath</h2>
            </div>
            <button id="close-modal" class="text-gray-500 hover:text-dark transition-colors text-2xl focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <p id="modal-description" class="text-gray-600 mb-6 text-center">Create your account to save quiz results and track your career journey.</p>
            
            <!-- Sign Up Form -->
            <form id="signup-form" class="space-y-4">
                <!-- Full Name -->
                <div id="fullname-field">
                    <label for="fullName" class="block text-sm font-medium text-dark mb-2">Full Name</label>
                    <div class="relative">
                        <input 
                            type="text" 
                            id="fullName" 
                            name="fullName" 
                            required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-lime focus:ring-4 focus:ring-lime-500/20 focus:outline-none transition-all duration-300 pl-12"
                            placeholder="Enter your full name"
                        >
                        <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-dark mb-2">Email Address</label>
                    <div class="relative">
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-lime focus:ring-4 focus:ring-lime-500/20 focus:outline-none transition-all duration-300 pl-12"
                            placeholder="Enter your email"
                        >
                        <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-dark mb-2">Password</label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-lime focus:ring-4 focus:ring-lime-500/20 focus:outline-none transition-all duration-300 pl-12 pr-12"
                            placeholder="Create a secure password"
                        >
                        <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <button 
                            type="button" 
                            id="toggle-password" 
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-dark transition-colors focus:outline-none"
                        >
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Forgot Password Link - Only for sign in -->
                <!-- <div id="forgot-password-link" class="hidden text-right">
                    <a href="#" class="text-sm text-lime hover:underline font-medium">
                        Forgot your password?
                    </a>
                </div> -->

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    id="submit-button"
                    class="group relative w-full inline-flex items-center justify-center gap-3 px-8 py-4 bg-dark text-white font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-lime-500/30 focus:ring-offset-2 transform hover:scale-105 overflow-hidden mt-6"
                >
                    <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    <span id="submit-text" class="relative z-10">Create Account</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform duration-300 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </button>

                <!-- Alternative Actions -->
                <div class="text-center mt-6 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">
                        <span id="switch-text">Already have an account?</span>
                        <button type="button" id="switch-mode" class="text-lime hover:underline font-medium ml-1">
                            Sign in here
                        </button>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>