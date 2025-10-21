<input type="hidden" id="quiz-mode" value="<?php echo $quizMode; ?>">
<input type="hidden" id="user-id" value="<?php echo $isLoggedIn ? $_SESSION['user_id'] : ''; ?>">
<input type="hidden" id="session-id" value="<?php echo $isLoggedIn ? '' : $_SESSION['guest_session_id']; ?>">
<input type="hidden" id="needs-core-subjects" value="<?php echo $needsCoreSubjects ? 'true' : 'false'; ?>">

<!-- Main Quiz Container -->
<div id="quiz-container">

</div>

<!-- Core Subjects Grades Form -->
<div id="core-subjects-form" class="bg-white rounded-2xl shadow-lg p-8 border-2" style="display: none;">
    <div class="mb-6">
        <h3 class="text-2xl font-bold text-dark mb-4 font-sans">Core Subject Grades Required</h3>
        <p class="text-gray-700 mb-6 font-sans">Please provide your core subject grades to get more accurate career recommendations.</p>
    </div>
    
    <!-- Subject Grades Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6 max-h-96 overflow-y-auto border rounded-xl p-4">
        
        <!-- Statistics and Probability -->
        <div>
            <label for="statistics-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                Statistics and Probability *
            </label>
            <input 
                type="number" 
                id="statistics-grade" 
                name="Statistics_and_Probability"
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="0-100" 
                min="0" 
                max="100" 
                step="0.01"
                required>
        </div>
        
        <!-- Physical Science -->
        <div>
            <label for="physical-science-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                Physical Science *
            </label>
            <input 
                type="number" 
                id="physical-science-grade" 
                name="Physical_Science"
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="0-100" 
                min="0" 
                max="100" 
                step="0.01"
                required>
        </div>

        <!-- Oral Communication in Context -->
        <div>
            <label for="oral-comm-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                Oral Communication in Context *
            </label>
            <input 
                type="number" 
                id="oral-comm-grade" 
                name="oral_comm_context"
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="0-100" 
                min="0" 
                max="100" 
                step="0.01"
                required>
        </div>

        <!-- Komunikasyon at Pananaliksik -->
        <div>
            <label for="komunikasyon-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                Komunikasyon at Pananaliksik *
            </label>
            <input 
                type="number" 
                id="komunikasyon-grade" 
                name="komunikasyon_pananaliksik"
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="0-100" 
                min="0" 
                max="100" 
                step="0.01"
                required>
        </div>

        <!-- General Mathematics -->
        <div>
            <label for="general-math-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                General Mathematics *
            </label>
            <input 
                type="number" 
                id="general-math-grade" 
                name="general_math"
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="0-100" 
                min="0" 
                max="100" 
                step="0.01"
                required>
        </div>

        <!-- Earth and Life Science -->
        <div>
            <label for="earth-life-sci-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                Earth and Life Science *
            </label>
            <input 
                type="number" 
                id="earth-life-sci-grade" 
                name="earth_life_sci"
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="0-100" 
                min="0" 
                max="100" 
                step="0.01"
                required>
        </div>

        <!-- Personal Development -->
        <div>
            <label for="personal-dev-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                Personal Development *
            </label>
            <input 
                type="number" 
                id="personal-dev-grade" 
                name="personal_dev"
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="0-100" 
                min="0" 
                max="100" 
                step="0.01"
                required>
        </div>

        <!-- Understanding Culture, Society and Politics -->
        <div>
            <label for="ucsp-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                Understanding Culture, Society and Politics *
            </label>
            <input 
                type="number" 
                id="ucsp-grade" 
                name="ucsp"
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="0-100" 
                min="0" 
                max="100" 
                step="0.01"
                required>
        </div>

        <!-- Physical Education and Health 1 -->
        <div>
            <label for="pe-health-1-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                Physical Education and Health 1 *
            </label>
            <input 
                type="number" 
                id="pe-health-1-grade" 
                name="pe_health_1"
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="0-100" 
                min="0" 
                max="100" 
                step="0.01"
                required>
        </div>

        <!-- Physical Education and Health 2 -->
        <div>
            <label for="pe-health-2-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                Physical Education and Health 2 *
            </label>
            <input 
                type="number" 
                id="pe-health-2-grade" 
                name="pe_health_2"
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="0-100" 
                min="0" 
                max="100" 
                step="0.01"
                required>
        </div>

        <!-- Reading and Writing -->
        <div>
            <label for="reading-writing-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                Reading and Writing *
            </label>
            <input 
                type="number" 
                id="reading-writing-grade" 
                name="reading_writing"
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="0-100" 
                min="0" 
                max="100" 
                step="0.01"
                required>
        </div>

        <!-- Pagbasa at Pagsusuri -->
        <div>
            <label for="pagbasa-pagsusuri-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                Pagbasa at Pagsusuri *
            </label>
            <input 
                type="number" 
                id="pagbasa-pagsusuri-grade" 
                name="pagbasa_pagsusuri"
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="0-100" 
                min="0" 
                max="100" 
                step="0.01"
                required>
        </div>

        <!-- 21st Century Literature from the Philippines and the World -->
        <div>
            <label for="lit21-ph-world-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                21st Century Literature *
            </label>
            <input 
                type="number" 
                id="lit21-ph-world-grade" 
                name="lit21_ph_world"
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="0-100" 
                min="0" 
                max="100" 
                step="0.01"
                required>
        </div>

        <!-- Media and Information Literacy -->
        <div>
            <label for="media-info-lit-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                Media and Information Literacy *
            </label>
            <input 
                type="number" 
                id="media-info-lit-grade" 
                name="media_info_lit"
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="0-100" 
                min="0" 
                max="100" 
                step="0.01"
                required>
        </div>

        <!-- Statistics and Probability (duplicate field) -->
        <div>
            <label for="stats-prob-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                Statistics and Probability (Advanced) *
            </label>
            <input 
                type="number" 
                id="stats-prob-grade" 
                name="stats_prob"
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="0-100" 
                min="0" 
                max="100" 
                step="0.01"
                required>
        </div>

        <!-- Physical Science (duplicate field) -->
        <div>
            <label for="physical-sci-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                Physical Science (Advanced) *
            </label>
            <input 
                type="number" 
                id="physical-sci-grade" 
                name="physical_sci"
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="0-100" 
                min="0" 
                max="100" 
                step="0.01"
                required>
        </div>

        <!-- Contemporary Philippine Arts from the Regions -->
        <div>
            <label for="cp-arts-regions-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                Contemporary Philippine Arts *
            </label>
            <input 
                type="number" 
                id="cp-arts-regions-grade" 
                name="cp_arts_regions"
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="0-100" 
                min="0" 
                max="100" 
                step="0.01"
                required>
        </div>

        <!-- Introduction to the Philosophy of the Human Person -->
        <div>
            <label for="intro-philo-human-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                Introduction to Philosophy *
            </label>
            <input 
                type="number" 
                id="intro-philo-human-grade" 
                name="intro_philo_human"
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="0-100" 
                min="0" 
                max="100" 
                step="0.01"
                required>
        </div>

        <!-- Physical Education and Health 3 -->
        <div>
            <label for="pe-health-3-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                Physical Education and Health 3 *
            </label>
            <input 
                type="number" 
                id="pe-health-3-grade" 
                name="pe_health_3"
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="0-100" 
                min="0" 
                max="100" 
                step="0.01"
                required>
        </div>

        <!-- Physical Education and Health 4 -->
        <div>
            <label for="pe-health-4-grade" class="block text-sm font-bold text-dark mb-2 font-sans">
                Physical Education and Health 4 *
            </label>
            <input 
                type="number" 
                id="pe-health-4-grade" 
                name="pe_health_4"
                class="w-full p-3 border-2 border-border rounded-xl focus:border-dark focus:outline-none font-sans" 
                placeholder="0-100" 
                min="0" 
                max="100" 
                step="0.01"
                required>
        </div>

    </div>
    
    <div class="mb-4">
        <p class="text-xs text-gray-500 font-sans">Enter your grades as percentages (e.g., 85.5 for 85.5%). All fields are required.</p>
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
            id="continue-to-mbti-btn"
            type="button"
            class="px-8 py-3 bg-dark text-lime font-bold rounded-xl border-2 hover:bg-lime hover:text-dark transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed shadow-sm font-sans"
            disabled>
            Continue<i class="fas fa-arrow-right ml-2"></i>
        </button>
    </div>
</div>

<!-- MBTI Form (Hidden initially) -->
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
