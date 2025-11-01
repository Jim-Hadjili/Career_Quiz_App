<header class="bg-white shadow-sm border-b sticky top-0 z-10">
    <div class="px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center space-x-2">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-gray-800 to-gray-900 rounded-full flex items-center justify-center shadow-lg">
                    <i class="fas fa-compass text-lime text-xl"></i>
                </div>
                <span
                    class="text-2xl lg:text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                    CareerPath Admin Dashboard
                </span>
            </div>
            <div class="flex items-center gap-4">
                <!-- Admin Profile -->
                <div class="relative" id="profile-dropdown">
                    <button
                        onclick="toggleProfileDropdown()"
                        class="flex items-center gap-3 p-3 rounded-xl hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-sm hover:shadow-md border-2 border-gray-200 hover:border-blue-100">
                        <div class="w-10 h-10 bg-lime rounded-full flex items-center justify-center shadow-md">
                            <i class="fas fa-user text-dark text-sm"></i>
                        </div>
                        <div class="hidden sm:block text-left">
                            <p class="text-sm font-semibold text-gray-800"><?php echo $_SESSION['user_name'] ?? 'Admin User'; ?></p>
                            <p class="text-xs text-gray-500 font-medium"><?php echo ucfirst($_SESSION['user_role'] ?? 'admin'); ?></p>
                        </div>
                        <i class="fas fa-chevron-down text-gray-400 text-sm transition-transform duration-200"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="dropdown-menu" class="absolute right-0 top-full mt-3 w-72 bg-white rounded-2xl shadow-2xl border-2 border-gray-200 z-50 hidden overflow-hidden backdrop-blur-sm">
                        <div class="p-5 bg-white border-b-2 border-gray-200">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-lime rounded-full flex items-center justify-center shadow-lg">
                                    <i class="fas fa-user text-dark text-lg"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold pl-1 pb-1 text-gray-900 text-base"><?php echo $_SESSION['user_name'] ?? 'Admin User'; ?></p>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-lime text-dark shadow-sm">
                                        <i class="fas fa-shield-alt mr-1.5 text-xs"></i>
                                        <?php echo ucfirst($_SESSION['user_role'] ?? 'Admin'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="p-3">
                            <button
                                onclick="showLogoutModal()"
                                class="w-full flex items-center gap-3 px-4 py-3 text-left text-red-600 hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 rounded-xl transition-all duration-200 group border border-transparent hover:border-red-100 hover:shadow-sm">
                                <i class="fas fa-sign-out-alt text-red-500 group-hover:text-red-600 transition-colors duration-200"></i>
                                <span class="font-semibold">Logout</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>