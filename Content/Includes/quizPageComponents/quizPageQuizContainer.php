<input type="hidden" id="quiz-mode" value="<?php echo $quizMode; ?>">
<input type="hidden" id="user-id" value="<?php echo $isLoggedIn ? $_SESSION['user_id'] : ''; ?>">
<input type="hidden" id="session-id" value="<?php echo $isLoggedIn ? '' : $_SESSION['guest_session_id']; ?>">
<input type="hidden" id="needs-core-subjects" value="<?php echo $needsCoreSubjects ? 'true' : 'false'; ?>">

<!-- Main Quiz Container -->
<div id="quiz-container">

</div>

<!-- Core Subjects Form (Hidden initially) -->
<div id="core-subjects-form" class="bg-white rounded-2xl shadow-lg p-8 border-2" style="display: none;">
    <div class="mb-6">
        <h3 class="text-2xl font-bold text-dark mb-4 font-sans">Additional Information Required</h3>
        <p class="text-gray-700 mb-6 font-sans">Please provide your core subject grades and MBTI personality type to get more accurate career recommendations.</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Statistics and Probability -->
        <div>
            <label for="statistics-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                Statistics and Probability Grade *
            </label>
            <input 
                type="number" 
                id="statistics-grade" 
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="Enter grade (0-100)" 
                min="0" 
                max="100" 
                step="0.01"
                required>
            <p class="text-xs text-gray-500 mt-1 font-sans">Enter your grade as a percentage (e.g., 85.5 for 85.5%)</p>
        </div>
        
        <!-- Physical Science -->
        <div>
            <label for="physical-science-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                Physical Science Grade *
            </label>
            <input 
                type="number" 
                id="physical-science-grade" 
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="Enter grade (0-100)" 
                min="0" 
                max="100" 
                step="0.01"
                required>
            <p class="text-xs text-gray-500 mt-1 font-sans">Enter your grade as a percentage (e.g., 92.0 for 92.0%)</p>
        </div>
    </div>
    
    <!-- MBTI Type -->
    <div class="mb-6">
        <label for="mbti-type" class="block text-sm font-bold text-dark mb-2 font-sans">
            MBTI Personality Type *
        </label>
        <select id="mbti-type" class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" required>
            <option value="">Select MBTI Type</option>
            <option value="INTJ">INTJ - The Architect</option>
            <option value="INTP">INTP - The Thinker</option>
            <option value="ENTJ">ENTJ - The Commander</option>
            <option value="ENTP">ENTP - The Debater</option>
            <option value="INFJ">INFJ - The Advocate</option>
            <option value="INFP">INFP - The Mediator</option>
            <option value="ENFJ">ENFJ - The Protagonist</option>
            <option value="ENFP">ENFP - The Campaigner</option>
            <option value="ISTJ">ISTJ - The Logistician</option>
            <option value="ISFJ">ISFJ - The Protector</option>
            <option value="ESTJ">ESTJ - The Executive</option>
            <option value="ESFJ">ESFJ - The Consul</option>
            <option value="ISTP">ISTP - The Virtuoso</option>
            <option value="ISFP">ISFP - The Adventurer</option>
            <option value="ESTP">ESTP - The Entrepreneur</option>
            <option value="ESFP">ESFP - The Entertainer</option>
        </select>
    </div>
    
    <!-- Core Subjects Form Navigation -->
    <div class="flex justify-between items-center">
        <button
            id="back-to-quiz-btn"
            type="button"
            class="px-6 py-3 bg-cream text-dark font-bold rounded-xl border-2 hover:bg-dark hover:text-lime transition-all duration-300 shadow-sm font-sans">
            <i class="fas fa-arrow-left mr-2"></i>Back to Quiz
        </button>
        
        <button
            id="save-core-subjects-btn"
            type="button"
            class="px-8 py-3 bg-dark text-lime font-bold rounded-xl border-2 hover:bg-lime hover:text-dark transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed shadow-sm font-sans"
            disabled>
            Complete Quiz<i class="fas fa-check ml-2"></i>
        </button>
    </div>
</div>

<!-- Quiz Navigation (Only shown during quiz) -->
<div id="quiz-navigation" class="bg-white rounded-2xl shadow-lg p-6 mt-6 border-2">
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
