<!-- About Admin Logout Modal -->
<div id="logout-modal" class="fixed inset-0 bg-black bg-opacity-50 z-[110] hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md mx-auto transform transition-all duration-300 scale-95 opacity-0" id="logout-modal-content">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-sign-out-alt text-red-600 text-lg"></i>
                </div>
                <h2 class="text-2xl font-bold text-dark">Admin Logout</h2>
            </div>
            <button id="close-logout-modal" class="text-gray-500 hover:text-dark transition-colors text-2xl focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-info-circle text-red-600 text-2xl"></i>
                </div>
                <p class="text-gray-600 text-lg mb-2">Are you sure you want to Logout?</p>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <!-- Cancel Button -->
                <button 
                    type="button" 
                    id="cancel-logout"
                    class="group relative inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-100 text-dark font-medium rounded-xl transition-all duration-300 shadow-sm hover:shadow-md focus:outline-none focus:ring-4 focus:ring-gray-300/50 focus:ring-offset-2 w-full sm:w-auto transform hover:scale-105 overflow-hidden"
                >
                    <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/50 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    <span class="relative z-10">Cancel</span>
                </button>
                
                <!-- Confirm Logout Button -->
                <button 
                    type="button" 
                    id="confirm-logout"
                    class="group relative inline-flex items-center justify-center gap-2 px-6 py-3 bg-red-600 text-white font-medium rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-red-500/30 focus:ring-offset-2 w-full sm:w-auto transform hover:scale-105 overflow-hidden"
                >
                    <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    <i class="fas fa-sign-out-alt relative z-10"></i>
                    <span class="relative z-10">Yes, Log Out</span>
                </button>
            </div>
        </div>
    </div>
</div>