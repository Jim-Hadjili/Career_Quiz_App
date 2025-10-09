<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-dark rounded-full flex items-center justify-center">
                    <i class="fas fa-compass text-lime text-lg"></i>
                </div>
                <span class="text-2xl font-bold">CareerPath</span>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="#home" class="hover:text-lime transition-colors">Home</a>
                <a href="#about" class="hover:text-lime transition-colors">About</a>
                <a href="#how-it-works" class="hover:text-lime transition-colors">How It Works</a>
                <a href="#quiz-guide" class="hover:text-lime transition-colors">Quiz Guide</a>
                <a href="#careers" class="hover:text-lime transition-colors">Careers</a>
                <button onclick="startQuiz()" class="bg-dark text-white px-6 py-3 rounded-full hover:bg-opacity-90 transition-all">
                    Sign Up
                </button>
            </div>

            <button id="mobile-menu-btn" class="md:hidden text-2xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>

    <!-- Mobile menu overlay and menu -->
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black bg-opacity-40 z-40 hidden md:hidden"></div>
    <div id="mobile-menu"
        class="fixed top-0 right-0 h-full w-1/2 max-w-xs bg-white border-l shadow-lg z-50 transform translate-x-full transition-transform duration-300 md:hidden">
        <div class="flex items-center justify-between px-4 py-4 border-b">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-dark rounded-full flex items-center justify-center">
                    <i class="fas fa-compass text-lime text-lg"></i>
                </div>
                <span class="text-2xl font-bold">CareerPath</span>
            </div>
            <button id="mobile-menu-close" class="text-2xl focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="px-4 py-4 space-y-3">
            <a href="#home" class="block py-2 hover:text-lime transition-colors">Home</a>
            <a href="#about" class="block py-2 hover:text-lime transition-colors">About</a>
            <a href="#how-it-works" class="block py-2 hover:text-lime transition-colors">How It Works</a>
            <a href="#quiz-guide" class="block py-2 hover:text-lime transition-colors">Quiz Guide</a>
            <a href="#careers" class="block py-2 hover:text-lime transition-colors">Careers</a>
            <button onclick="startQuiz()" class="w-full bg-dark text-white px-6 py-3 rounded-full hover:bg-opacity-90 transition-all">
                Sign Up
            </button>
        </div>
    </div>
</nav>