<!-- Mobile Hamburger Menu Button - Move outside header -->
<button
    id="hamburger-btn"
    class="hamburger-menu fixed top-5 right-6 w-12 h-12 rounded-full flex items-center justify-center text-dark font-bold z-50 lg:hidden no-print"
    onclick="toggleMobileMenu()">
    <i class="fas fa-bars text-lg" id="hamburger-icon"></i>
</button>

<!-- Mobile Overlay - Move outside header -->
<div
    id="mobile-overlay"
    class="mobile-overlay fixed inset-0 z-50 lg:hidden no-print"
    onclick="closeMobileMenu()">
</div>

<!-- Header Section -->
<header
    class="bg-white border-b sticky top-0 z-40 w-full shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <div class="flex items-center space-x-3">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-gray-800 to-gray-900 rounded-full flex items-center justify-center shadow-lg">
                    <i class="fas fa-compass text-lime text-xl"></i>
                </div>
                <span
                    class="text-2xl lg:text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                    CareerPath
                </span>
            </div>
        </div>
    </div>
</header>