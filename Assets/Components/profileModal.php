<style>
.modal-content::-webkit-scrollbar {
  display: none;
}
</style>

<!-- Profile Modal -->
<div id="profile-modal" class="fixed inset-0 bg-black bg-opacity-50 z-[120] hidden flex items-center justify-center p-4">
    <div class="modal-content bg-white rounded-3xl shadow-2xl w-full max-w-lg mx-auto transform transition-all duration-300 scale-95 opacity-0 max-h-[90vh] overflow-y-auto" id="profile-modal-content">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-dark rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-lime text-sm"></i>
                </div>
                <h2 class="text-2xl font-bold text-dark">Profile Settings</h2>
            </div>
            <button id="close-profile-modal" class="text-gray-500 hover:text-dark transition-colors text-2xl focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <p class="text-gray-600 mb-6 text-center">Update your account information and password.</p>
            
            <!-- Profile Form -->
            <form id="profile-form" class="space-y-4">
                <!-- Success/Error Messages Container -->
                <div id="profile-messages"></div>

                <!-- Full Name -->
                <div>
                    <label for="profile-fullName" class="block text-sm font-medium text-dark mb-2">Full Name</label>
                    <div class="relative">
                        <input 
                            type="text" 
                            id="profile-fullName" 
                            name="fullName" 
                            required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-lime focus:ring-lime-500/20 focus:outline-none transition-all duration-300 pl-12"
                            placeholder="Enter your full name"
                        >
                        <i class="fas fa-user absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Email (Now Editable) -->
                <div>
                    <label for="profile-email" class="block text-sm font-medium text-dark mb-2">Email Address</label>
                    <div class="relative">
                        <input 
                            type="email" 
                            id="profile-email" 
                            name="email" 
                            required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-lime focus:ring-lime-500/20 focus:outline-none transition-all duration-300 pl-12"
                            placeholder="Enter your email address"
                        >
                        <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Make sure you have access to this email address</p>
                </div>

                <!-- Password Change Section -->
                <div class="border-t border-gray-200 pt-4 mt-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-dark">Change Password</h3>
                        <button type="button" id="toggle-password-section" class="text-lime hover:text-dark text-sm font-medium">
                            <span id="password-toggle-text">Change Password</span>
                        </button>
                    </div>

                    <div id="password-change-section" class="hidden space-y-4">
                        <!-- Current Password -->
                        <div>
                            <label for="current-password" class="block text-sm font-medium text-dark mb-2">Current Password</label>
                            <div class="relative">
                                <input 
                                    type="password" 
                                    id="current-password" 
                                    name="currentPassword" 
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-lime focus:ring-lime-500/20 focus:outline-none transition-all duration-300 pl-12 pr-12"
                                    placeholder="Enter your current password"
                                >
                                <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <button 
                                    type="button" 
                                    onclick="togglePasswordVisibility('current-password')"
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-dark transition-colors focus:outline-none"
                                >
                                    <i class="fas fa-eye" id="current-password-icon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- New Password -->
                        <div>
                            <label for="new-password" class="block text-sm font-medium text-dark mb-2">New Password</label>
                            <div class="relative">
                                <input 
                                    type="password" 
                                    id="new-password" 
                                    name="newPassword" 
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-lime focus:ring-lime-500/20 focus:outline-none transition-all duration-300 pl-12 pr-12"
                                    placeholder="Enter your new password"
                                >
                                <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <button 
                                    type="button" 
                                    onclick="togglePasswordVisibility('new-password')"
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-dark transition-colors focus:outline-none"
                                >
                                    <i class="fas fa-eye" id="new-password-icon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Confirm New Password -->
                        <div>
                            <label for="confirm-password" class="block text-sm font-medium text-dark mb-2">Confirm New Password</label>
                            <div class="relative">
                                <input 
                                    type="password" 
                                    id="confirm-password" 
                                    name="confirmPassword" 
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-lime focus:ring-lime-500/20 focus:outline-none transition-all duration-300 pl-12 pr-12"
                                    placeholder="Confirm your new password"
                                >
                                <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <button 
                                    type="button" 
                                    onclick="togglePasswordVisibility('confirm-password')"
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-dark transition-colors focus:outline-none"
                                >
                                    <i class="fas fa-eye" id="confirm-password-icon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 justify-end pt-4 border-t border-gray-200 mt-6">
                    <!-- Cancel Button -->
                    <button 
                        type="button" 
                        id="cancel-profile-changes"
                        onclick="closeProfileModal()"
                        class="group relative inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 text-dark font-medium rounded-xl transition-all duration-300 shadow-sm hover:shadow-md focus:outline-none focus:ring-gray-300/50 focus:ring-offset-2 w-full sm:w-auto transform hover:scale-105 overflow-hidden"
                    >
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/50 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <span class="relative z-10">Cancel</span>
                    </button>
                    
                    <!-- Save Button -->
                    <button 
                        type="submit" 
                        id="save-profile-button"
                        class="group relative inline-flex items-center justify-center gap-2 px-6 py-3 bg-dark text-white font-medium rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-lime-500/30 focus:ring-offset-2 w-full sm:w-auto transform hover:scale-105 overflow-hidden"
                    >
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                        <i class="fas fa-save relative z-10"></i>
                        <span class="relative z-10">Save Changes</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>