<input type="hidden" id="quiz-mode" value="<?php echo $quizMode; ?>">
<input type="hidden" id="user-id" value="<?php echo $isLoggedIn ? $_SESSION['user_id'] : ''; ?>">
<input type="hidden" id="session-id" value="<?php echo $isLoggedIn ? '' : $_SESSION['guest_session_id']; ?>">

<div id="quiz-container">

</div>

<div class="bg-white rounded-2xl shadow-lg p-6 mt-6 border-2">
    <div class="flex justify-between items-center">
        <button
            id="prev-btn"
            type="button"
            class="px-6 py-3 bg-cream text-dark font-bold rounded-xl border-2 hover:bg-dark hover:text-lime transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed shadow-sm font-sans"
            disabled>
            <i class="fas fa-arrow-left mr-2"></i>Previous
        </button>

        <button
            id="next-btn"
            type="button"
            class="px-6 py-3 bg-dark text-lime font-bold rounded-xl border-2 hover:bg-lime hover:text-dark transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed shadow-sm font-sans"
            disabled>
            Next<i class="fas fa-arrow-right ml-2"></i>
        </button>

        <button
            id="submit-btn"
            type="button"
            class="px-6 py-3 bg-lime text-dark font-bold rounded-xl border-2 hover:bg-dark hover:text-lime transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed shadow-sm hidden font-sans"
            disabled>
            Complete Quiz<i class="fas fa-check ml-2"></i>
        </button>
    </div>
</div>
