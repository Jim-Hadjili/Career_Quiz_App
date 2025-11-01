<header class="bg-white shadow-sm border-b sticky top-0 z-10">
    <div class="px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="text-2xl font-bold text-gray-900">CareerPath Dashboard</h2>
            <div class="flex items-center gap-4">
                <!-- Admin Profile -->
                <div class="relative" id="profile-dropdown">
                    <button
                        onclick="toggleProfileDropdown()"
                        class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-blue-600 text-sm"></i>
                        </div>
                        <div class="hidden sm:block text-left">
                            <p class="text-sm font-medium text-gray-900"><?php echo $_SESSION['user_name'] ?? 'Admin User'; ?></p>
                            <p class="text-xs text-gray-500"><?php echo ucfirst($_SESSION['user_role'] ?? 'admin'); ?></p>
                        </div>
                        <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="dropdown-menu" class="absolute right-0 top-full mt-2 w-64 bg-white rounded-lg shadow-lg border border-gray-200 z-50 hidden">
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900"><?php echo $_SESSION['user_name'] ?? 'Admin User'; ?></p>
                                    <p class="text-sm text-gray-500"><?php echo $_SESSION['user_email'] ?? 'admin@example.com'; ?></p>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mt-1">
                                        <i class="fas fa-shield-alt mr-1"></i>
                                        <?php echo ucfirst($_SESSION['user_role'] ?? 'Admin'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="p-2">
                            <button
                                onclick="showLogoutModal()"
                                class="w-full flex items-center gap-3 px-3 py-2 text-left text-red-600 hover:bg-red-50 rounded-lg transition-colors group">
                                <i class="fas fa-sign-out-alt text-red-500 group-hover:text-red-600"></i>
                                <span class="font-medium">Logout</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Notifications -->
                <button class="relative p-2 text-gray-400 hover:text-gray-600 rounded-lg">
                    <i class="fas fa-bell text-lg"></i>
                    <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                </button>
            </div>
        </div>
    </div>
</header>