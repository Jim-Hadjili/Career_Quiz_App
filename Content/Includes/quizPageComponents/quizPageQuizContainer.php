<input type="hidden" id="quiz-mode" value="<?php echo $quizMode; ?>">
<input type="hidden" id="user-id" value="<?php echo $isLoggedIn ? $_SESSION['user_id'] : ''; ?>">
<input type="hidden" id="session-id" value="<?php echo $isLoggedIn ? '' : $_SESSION['guest_session_id']; ?>">
<input type="hidden" id="needs-core-subjects" value="<?php echo $needsCoreSubjects ? 'true' : 'false'; ?>">
<input type="hidden" id="existing-core-subjects"
    value='<?php echo htmlspecialchars($existingCoreSubjectsJson, ENT_QUOTES, 'UTF-8'); ?>'>

<!-- Main Quiz Container -->
<div id="quiz-container">

</div>

<!-- Core Subjects Grades Form -->
<?php include 'quizContainerForms/coreSubjectsForm.php'; ?>

<!-- MBTI Form (Hidden initially) -->
<?php include 'quizContainerForms/MBTIForm.php'; ?>

<!-- Quiz Navigation -->
<div id="quiz-navigation" class="bg-white rounded-2xl shadow-lg p-6 mt-6 border-2">
    <div class="flex justify-between items-center">
        <button id="prev-btn" type="button"
            class="px-6 py-3 bg-cream text-dark font-bold rounded-xl border-2 hover:bg-navy_blue hover:text-white transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed shadow-sm font-sans"
            disabled>
            <i class="fas fa-arrow-left mr-2"></i>Previous
        </button>

        <button id="next-btn" type="button"
            class="px-6 py-3 bg-dark text-white font-bold rounded-xl border-2 hover:bg-navy_blue hover:text-white transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed shadow-sm font-sans"
            disabled>
            Next<i class="fas fa-arrow-right ml-2"></i>
        </button>

        <button id="submit-btn" type="button"
            class="px-6 py-3 bg-navy_blue text-white font-bold rounded-xl border-2 hover:bg-dark hover:text-white    transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed shadow-sm hidden font-sans"
            disabled>
            Complete Quiz<i class="fas fa-check ml-2"></i>
        </button>
    </div>
</div>