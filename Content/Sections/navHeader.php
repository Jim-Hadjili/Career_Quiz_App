<?php
// Remove session_start() from here since it's now at the top of index.php
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $isLoggedIn ? $_SESSION['user_name'] : '';
?>

<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex items-center space-x-2">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-gray-800 to-gray-900 rounded-full flex items-center justify-center shadow-lg">
                    <i class="fas fa-compass text-lime text-xl"></i>
                </div>
                <span
                    class="text-2xl lg:text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                    CareerPath
                </span>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="#home" class="hover:text-lime transition-colors text-base md:text-sm lg:text-lg">Home</a>
                <a href="#about" class="hover:text-lime transition-colors text-base md:text-sm lg:text-lg">About</a>
                <a href="#how-it-works" class="hover:text-lime transition-colors text-base md:text-sm lg:text-lg">How It Works</a>
                <a href="#quiz-guide" class="hover:text-lime transition-colors text-base md:text-sm lg:text-lg">Quiz Guide</a>
                <a href="#careers" class="hover:text-lime transition-colors text-base md:text-sm lg:text-lg">Careers</a>

                <?php if ($isLoggedIn): ?>
                    <!-- Profile Dropdown -->
                    <div class="relative" id="profile-dropdown">
                        <button
                            type="button"
                            onclick="toggleProfileDropdown()"
                            class="group relative inline-flex items-center justify-center gap-2 px-6 py-2 bg-dark text-white rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-lime-500/30 focus:ring-offset-2 w-full md:w-auto transform hover:scale-105 overflow-hidden text-sm md:text-sm lg:text-lg"
                            aria-label="Profile">
                            <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                            <span class="relative z-10 flex items-center gap-2">
                                <i class="fas fa-user-circle"></i>
                                <span><?php echo htmlspecialchars(explode(' ', $userName)[0]); ?></span>
                            </span>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="dropdown-menu" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-200 z-50 hidden">
                            <div class="py-2">
                                <div class="px-4 py-2 border-b border-gray-200">
                                    <p class="text-sm font-medium text-dark"><?php echo htmlspecialchars($userName); ?></p>
                                    <p class="text-xs text-gray-500"><?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
                                </div>
                                <button onclick="openProfileModal()" class="w-full text-left px-4 py-2 text-sm text-dark hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-user mr-2"></i>Profile
                                </button>
                                <button onclick="openSubjectGradeModal()" class="w-full text-left px-4 py-2 text-sm text-dark hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-graduation-cap mr-2"></i>Subject Grade
                                </button>
                                <button onclick="openMbtiModal()" class="w-full text-left px-4 py-2 text-sm text-dark hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-brain mr-2"></i>MBTI Type
                                </button>
                                <button onclick="openQuizResultsModal()" class="w-full text-left px-4 py-2 text-sm text-dark hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-chart-line mr-2"></i>Quiz Results
                                </button>
                                <button onclick="showLogoutModal()" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </button>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Sign Up Button -->
                    <button
                        type="button"
                        onclick="openSignUpModal()"
                        class="group relative inline-flex items-center justify-center gap-2 px-6 py-2 bg-dark text-white rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-lime-500/30 focus:ring-offset-2 w-full md:w-auto transform hover:scale-105 overflow-hidden text-sm md:text-sm lg:text-lg"
                        aria-label="Sign Up">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <span class="relative z-10 flex items-center gap-2">
                            Sign Up
                        </span>
                    </button>
                <?php endif; ?>
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
                <div class="w-6 h-6 bg-dark rounded-full flex items-center justify-center">
                    <i class="fas fa-compass text-lime text-lg"></i>
                </div>
                <span class="text-lg font-bold">CareerPath</span>
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

            <?php if ($isLoggedIn): ?>
                <!-- Mobile Profile Section -->
                <div class="border-t pt-3 mt-3">
                    <div class="mb-3">
                        <p class="text-sm font-medium text-dark"><?php echo htmlspecialchars($userName); ?></p>
                        <p class="text-xs text-gray-500"><?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
                    </div>
                    <button onclick="openProfileModal()" class="w-full text-left py-2 hover:text-lime transition-colors">
                        <i class="fas fa-user mr-2"></i>Profile
                    </button>
                    <button onclick="openSubjectGradeModal()" class="w-full text-left py-2 hover:text-lime transition-colors">
                        <i class="fas fa-graduation-cap mr-2"></i>Subject Grade
                    </button>
                    <button onclick="openMbtiModal()" class="w-full text-left py-2 hover:text-lime transition-colors">
                        <i class="fas fa-brain mr-2"></i>MBTI Type
                    </button>
                    <button onclick="openQuizResultsModal()" class="w-full text-left py-2 hover:text-lime transition-colors">
                        <i class="fas fa-chart-line mr-2"></i>Quiz Results
                    </button>
                    <button onclick="showLogoutModal()" class="w-full text-left py-2 text-red-600 hover:text-red-700 transition-colors">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </div>
            <?php else: ?>
                <!-- Mobile Sign Up Button -->
                <button
                    type="button"
                    onclick="openSignUpModal()"
                    class="group relative inline-flex items-center justify-center gap-2 px-6 py-2 bg-dark text-white rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-lime-500/30 focus:ring-offset-2 w-full md:w-auto transform hover:scale-105 overflow-hidden text-sm md:text-sm lg:text-lg"
                    aria-label="Sign Up">
                    <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    <span class="relative z-10 flex items-center gap-2">
                        Sign Up
                    </span>
                </button>
            <?php endif; ?>
        </div>
    </div>
</nav>