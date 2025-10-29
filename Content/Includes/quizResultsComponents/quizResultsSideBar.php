<aside
    class="floating-sidebar fixed right-4 top-1/2 transform -translate-y-1/2 w-80 rounded-3xl p-6 z-40 no-print hidden lg:block bg-gray-100 shadow-lg border border-gray-200">
    <!-- Personality Card -->
    <div class="mb-6">
        <div class="flex items-center mb-4">
            <div
                class="w-12 h-12 rounded-full bg-lime flex items-center justify-center mr-4 shadow-lg">
                <i class="fas fa-user text-dark text-lg"></i>
            </div>
            <div>
                <p class="text-xs text-gray-600 font-medium">
                    Your personality type is:
                </p>
                <h3
                    class="text-lg font-bold text-gray-800"
                    id="sidebar-personality-type">
                    INTP
                </h3>
                <p class="text-sm text-gray-600" id="sidebar-personality-full">
                    INTP - The Thinker
                </p>
            </div>
        </div>
    </div>

    <!-- Divider -->
    <div class="h-1 bg-lime rounded-full mb-6"></div>

    <!-- Navigation -->
    <div class="mb-6">
        <p
            class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-4">
            ON THIS PAGE
        </p>
        <nav class="space-y-3">
            <a
                href="#Career-path"
                class="flex items-center text-sm text-gray-700 hover:text-gray-800 hover:font-semibold transition-all duration-200 py-2 px-3 rounded-lg hover:bg-gray-50">
                <span
                    class="w-6 h-6 rounded-full bg-lime flex items-center justify-center text-xs font-bold mr-3 text-dark">1</span>
                Career Path
            </a>
            <a
                href="#Recommended-Career-Paths"
                class="flex items-center text-sm text-gray-700 hover:text-gray-800 hover:font-semibold transition-all duration-200 py-2 px-3 rounded-lg hover:bg-gray-50">
                <span
                    class="w-6 h-6 rounded-full bg-lime flex items-center justify-center text-xs font-bold mr-3 text-dark">2</span>
                Recommended Careers
            </a>
            <a
                href="#Personality-Traits"
                class="flex items-center text-sm text-gray-700 hover:text-gray-800 hover:font-semibold transition-all duration-200 py-2 px-3 rounded-lg hover:bg-gray-50">
                <span
                    class="w-6 h-6 rounded-full bg-lime flex items-center justify-center text-xs font-bold mr-3 text-dark">3</span>
                Personality Traits
            </a>
            <a
                href="#Personality-Type"
                class="flex items-center text-sm text-gray-700 hover:text-gray-800 hover:font-semibold transition-all duration-200 py-2 px-3 rounded-lg hover:bg-gray-50">
                <span
                    class="w-6 h-6 rounded-full bg-lime flex items-center justify-center text-xs font-bold mr-3 text-dark">4</span>
                Personality Type
            </a>
        </nav>
    </div>

    <!-- Divider -->
    <div class="h-px bg-gray-200 rounded-full mb-6"></div>

    <!-- Action Buttons -->
    <div class="space-y-3">
        <p
            class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-4">
            ACTIONS
        </p>
        <a
            href="quizPage.php"
            class="block w-full px-6 py-3 bg-lime text-dark hover:text-white font-bold text-sm rounded-xl hover:bg-dark transition-all duration-300 shadow-lg text-center transform hover:scale-105">
            <i class="fas fa-redo mr-2"></i>Take Quiz Again
        </a>
        <a
            href="../../index.php"
            class="block w-full px-6 py-3 bg-white text-gray-700 font-bold text-sm rounded-xl hover:bg-dark hover:text-white transition-all duration-300 shadow-lg text-center transform hover:scale-105">
            <i class="fas fa-home mr-2"></i>Back to Home
        </a>
    </div>
</aside>

<!-- Mobile Slide-out Menu -->
<div
    id="mobile-menu"
    class="mobile-menu fixed top-0 right-0 h-full w-80 z-50 lg:hidden no-print overflow-y-auto">
    <div class="p-6">
        <!-- Close Button -->
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-gray-800">Menu</h3>
            <button
                onclick="closeMobileMenu()"
                class="w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 flex items-center justify-center transition-colors duration-200">
                <i class="fas fa-times text-gray-600"></i>
            </button>
        </div>

        <!-- Personality Card -->
        <div class="mb-6">
            <div class="flex items-center mb-4">
                <div
                    class="w-12 h-12 rounded-full bg-lime flex items-center justify-center mr-4 shadow-lg">
                    <i class="fas fa-user text-dark text-lg"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-600 font-medium">
                        Your personality type is:
                    </p>
                    <h3
                        class="text-lg font-bold text-gray-800"
                        id="mobile-personality-type">
                        INTP
                    </h3>
                    <p class="text-sm text-gray-600" id="mobile-personality-full">
                        INTP - The Thinker
                    </p>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="h-1 bg-lime rounded-full mb-6"></div>

        <!-- Navigation -->
        <div class="mb-6">
            <p
                class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-4">
                ON THIS PAGE
            </p>
            <nav class="space-y-3">
                <a
                    href="#Career-path"
                    onclick="closeMobileMenu()"
                    class="flex items-center text-sm text-gray-700 hover:text-gray-800 hover:font-semibold transition-all duration-200 py-2 px-3 rounded-lg hover:bg-gray-50">
                    <span
                        class="w-6 h-6 rounded-full bg-lime flex items-center justify-center text-xs font-bold mr-3 text-dark">1</span>
                    Career Path
                </a>
                <a
                    href="#Recommended-Career-Paths"
                    onclick="closeMobileMenu()"
                    class="flex items-center text-sm text-gray-700 hover:text-gray-800 hover:font-semibold transition-all duration-200 py-2 px-3 rounded-lg hover:bg-gray-50">
                    <span
                        class="w-6 h-6 rounded-full bg-lime flex items-center justify-center text-xs font-bold mr-3 text-dark">2</span>
                    Recommended Careers
                </a>
                <a
                    href="#Personality-Traits"
                    onclick="closeMobileMenu()"
                    class="flex items-center text-sm text-gray-700 hover:text-gray-800 hover:font-semibold transition-all duration-200 py-2 px-3 rounded-lg hover:bg-gray-50">
                    <span
                        class="w-6 h-6 rounded-full bg-lime flex items-center justify-center text-xs font-bold mr-3 text-dark">3</span>
                    Personality Traits
                </a>
                <a
                    href="#Personality-Type"
                    onclick="closeMobileMenu()"
                    class="flex items-center text-sm text-gray-700 hover:text-gray-800 hover:font-semibold transition-all duration-200 py-2 px-3 rounded-lg hover:bg-gray-50">
                    <span
                        class="w-6 h-6 rounded-full bg-lime flex items-center justify-center text-xs font-bold mr-3 text-dark">4</span>
                    Personality Type
                </a>
            </nav>
        </div>

        <!-- Divider -->
        <div class="h-px bg-gray-200 rounded-full mb-6"></div>

        <!-- Action Buttons -->
        <div class="space-y-3">
            <p
                class="text-xs font-bold text-gray-600 uppercase tracking-wide mb-4">
                ACTIONS
            </p>
            <a
                href="quizPage.html"
                class="block w-full px-6 py-3 bg-lime text-dark hover:text-white font-bold text-sm rounded-xl hover:bg-dark transition-all duration-300 shadow-lg text-center">
                <i class="fas fa-redo mr-2"></i>Take Quiz Again
            </a>
            <a
                href="../index.html"
                class="block w-full px-6 py-3 bg-gray-100 text-gray-700 font-bold text-sm rounded-xl hover:bg-dark hover:text-white transition-all duration-300 shadow-lg text-center">
                <i class="fas fa-home mr-2"></i>Back to Home
            </a>
        </div>
    </div>
</div>