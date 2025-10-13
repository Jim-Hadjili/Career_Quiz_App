<input type="hidden" id="quiz-mode" value="<?php echo $quizMode; ?>">
<input type="hidden" id="user-id" value="<?php echo $isLoggedIn ? $_SESSION['user_id'] : ''; ?>">
<input type="hidden" id="session-id" value="<?php echo $isLoggedIn ? '' : $_SESSION['guest_session_id']; ?>">

<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-gray-900 rounded-full flex items-center justify-center">
                    <i class="fas fa-compass text-lime-400 text-lg"></i>
                </div>
                <span class="text-xl font-bold">CareerPath Quiz</span>
            </div>

            <!-- Mode Indicator -->
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2 px-3 py-1 <?php echo $is_registered ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?> rounded-full text-sm">
                    <i class="fas <?php echo $is_registered ? 'fa-user-check' : 'fa-user-clock'; ?>"></i>
                    <span><?php echo $is_registered ? 'Registered' : 'Guest Mode'; ?></span>
                </div>

                <?php if ($is_registered): ?>
                    <span class="text-sm text-gray-600">Welcome, <?php echo htmlspecialchars(explode(' ', $user_name)[0]); ?>!</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>