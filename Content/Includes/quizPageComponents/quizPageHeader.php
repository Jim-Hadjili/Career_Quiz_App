<input type="hidden" id="quiz-mode" value="<?php echo $quizMode; ?>">
<input type="hidden" id="user-id" value="<?php echo $isLoggedIn ? $_SESSION['user_id'] : ''; ?>">
<input type="hidden" id="session-id" value="<?php echo $isLoggedIn ? '' : $_SESSION['guest_session_id']; ?>">

<header class="bg-white shadow-sm border-b-2 border-dark sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-dark rounded-full flex items-center justify-center shadow-md">
                    <i class="fas fa-compass text-lime text-xl"></i>
                </div>
                <span class="text-2xl md:text-xl lg:text-3xl font-bold text-dark font-sans">CareerPath</span>
                <span class="hidden md:inline-block text-base font-semibold text-gray-600 ml-3 font-sans">Quiz</span>
            </div>
        </div>
    </div>
</header>
