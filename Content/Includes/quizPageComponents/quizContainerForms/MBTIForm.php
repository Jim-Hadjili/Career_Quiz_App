<div id="mbti-form" class="bg-white rounded-2xl shadow-lg p-8 border-2" style="display: none;">
    <div class="mb-6">
        <h3 class="text-2xl font-bold text-dark mb-4 font-sans">Personality Type Information</h3>
        <p class="text-gray-700 mb-6 font-sans">Please select your MBTI personality type to complete your profile for accurate career matching.</p>
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
        <p class="text-xs text-gray-500 mt-1 font-sans">Don't know your MBTI type? <a href="https://www.16personalities.com/free-personality-test" target="_blank" class="text-dark hover:text-lime underline">Take the test here</a></p>
    </div>

    <!-- MBTI Form Navigation -->
    <div class="flex justify-between items-center">
        <button
            id="back-to-grades-btn"
            type="button"
            class="px-6 py-3 bg-cream text-dark font-bold rounded-xl border-2 hover:bg-dark hover:text-lime transition-all duration-300 shadow-sm font-sans">
            <i class="fas fa-arrow-left mr-2"></i>Back to Grades
        </button>

        <button
            id="complete-quiz-btn"
            type="button"
            class="px-8 py-3 bg-lime text-dark font-bold rounded-xl border-2 hover:bg-dark hover:text-lime transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed shadow-sm font-sans"
            disabled>
            Complete Quiz<i class="fas fa-check ml-2"></i>
        </button>
    </div>
</div>