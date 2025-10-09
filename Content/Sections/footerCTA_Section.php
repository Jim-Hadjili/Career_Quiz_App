<section class="py-16 md:py-24 bg-white">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-cream rounded-3xl p-8 md:p-16">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="flex flex-col items-center text-center">
                    <h2 class="text-2xl md:text-3xl lg:text-5xl font-bold mb-6">
                        <!-- 
                            - text-2xl on mobile
                            - md:text-3xl on medium screens
                            - lg:text-5xl on large screens
                        -->
                        Ready to Find Your Path?
                    </h2>
                    <p class="text-base md:text-md lg:text-lg text-gray-600 mb-8 max-w-2xl">
                        <!-- 
                            - text-base on mobile
                            - md:text-md on medium screens
                            - lg:text-lg on large screens
                        -->
                        Join thousands of students who have discovered their ideal career direction. Your future starts with understanding yourself.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center w-full">
                        <button
                            type="button"
                            onclick="startQuiz()"
                            class="group relative inline-flex items-center justify-center gap-3 px-8 py-4 bg-dark hover:bg-lime hover:text-black text-white font-medium rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-lime-500/30 focus:ring-offset-2 w-full md:w-auto transform hover:scale-105 overflow-hidden text-base md:text-sm lg:text-base"
                            aria-label="Take Quiz Now"
                        >
                            <!-- Animated gradient overlay -->
                            <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                            <span class="relative z-10">Take Quiz Now</span>
                            <!-- Arrow Right Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform duration-300 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </button>
                        
                        <button
                            type="button"
                            onclick="createAccount()"
                            class="group relative inline-flex items-center justify-center gap-3 px-8 py-4 bg-white text-dark border-2 border-dark font-medium rounded-xl transition-all duration-300 shadow-lg hover:bg-dark hover:text-white hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-lime-500/30 focus:ring-offset-2 w-full md:w-auto transform hover:scale-105 overflow-hidden text-base md:text-sm lg:text-base"
                            aria-label="Create Account"
                        >
                            <!-- Animated gradient overlay -->
                            <div class="absolute inset-0 bg-gradient-to-r from-black/0 via-black/10 to-black/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                            <!-- User Icon (slightly rotates on hover) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:rotate-12 transition-transform duration-300 relative z-10" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm0 2c-3.314 0-6 1.343-6 3v1a1 1 0 001 1h10a1 1 0 001-1v-1c0-1.657-2.686-3-6-3z"/>
                            </svg>
                            <span class="relative z-10">Create Account</span>
                        </button>
                    </div>
                    
                    <div class="mt-8 flex items-center justify-center space-x-6 text-xs md:text-xs lg:text-sm text-gray-500">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-lime"></i>
                            <span>Free to use</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-lime"></i>
                            <span>Save your results</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-lime"></i>
                            <span>Track progress</span>
                        </div>
                    </div>
                </div>
                
                <div class="relative hidden lg:block">
                    <div class="bg-white rounded-3xl p-8 border-2 border-dark shadow-lg">
                        <img src="https://illustrations.popsy.co/amber/success.svg" alt="Career Success Illustration" class="w-full h-[350px] mb-6">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>