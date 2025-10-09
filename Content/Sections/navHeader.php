<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-dark rounded-full flex items-center justify-center">
                    <i class="fas fa-compass text-lime text-lg"></i>
                </div>
                <span class="text-2xl font-bold">CareerPath</span>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="#home" class="hover:text-lime transition-colors">Home</a>
                <a href="#how-it-works" class="hover:text-lime transition-colors">How It Works</a>
                <a href="#quiz-guide" class="hover:text-lime transition-colors">Quiz Guide</a>
                <a href="#careers" class="hover:text-lime transition-colors">Careers</a>
                <button onclick="startQuiz()" class="bg-dark text-white px-6 py-3 rounded-full hover:bg-opacity-90 transition-all">
                    Take Quiz
                </button>
            </div>

            <button id="mobile-menu-btn" class="md:hidden text-2xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
        <div class="px-4 py-4 space-y-3">
            <a href="#home" class="block py-2 hover:text-lime transition-colors">Home</a>
            <a href="#how-it-works" class="block py-2 hover:text-lime transition-colors">How It Works</a>
            <a href="#quiz-guide" class="block py-2 hover:text-lime transition-colors">Quiz Guide</a>
            <a href="#careers" class="block py-2 hover:text-lime transition-colors">Careers</a>
            <button onclick="startQuiz()" class="w-full bg-dark text-white px-6 py-3 rounded-full hover:bg-opacity-90 transition-all">
                Take Quiz
            </button>
        </div>
    </div>
</nav>