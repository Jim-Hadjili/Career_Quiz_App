<?php 
include "../Functions/quizPageFunctions/quizPageFunction.php";

// Determine quiz mode and user info
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
$quizMode = $isLoggedIn ? 'user' : 'guest';
$userName = $isLoggedIn ? $_SESSION['userName'] : 'Guest User';
$userEmail = $isLoggedIn ? $_SESSION['userEmail'] : null;

// Generate session ID for guest users
if (!$isLoggedIn && !isset($_SESSION['guest_session_id'])) {
    $_SESSION['guest_session_id'] = 'guest_' . uniqid('', true);
}

// Set variables for compatibility with the new design
$is_registered = $isLoggedIn;
$user_name = $userName;
$quiz_mode = $quizMode;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="../../Assets/Scripts/tailwindConfig.js"></script>
    <link rel="stylesheet" href="../../Assets/Styles/index.css">
    <title>CareerPath Quiz - <?php echo $is_registered ? 'Registered User' : 'Guest Mode'; ?></title>
    <style>
        .scale-option {
            width: 48px;
            height: 48px;
            border: 2px solid #e5e7eb;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .scale-option:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        /* Disagree options (left side) - Red shades */
        .scale-option[data-scale="1"] {
            border-color: #dc2626;
            background-color: #fef2f2;
        }
        .scale-option[data-scale="1"]:hover {
            border-color: #b91c1c;
            background-color: #fee2e2;
        }
        .scale-option[data-scale="1"].selected {
            border-color: #dc2626;
            background-color: #dc2626;
            color: white;
        }
        
        .scale-option[data-scale="2"] {
            border-color: #ef4444;
            background-color: #fef2f2;
        }
        .scale-option[data-scale="2"]:hover {
            border-color: #dc2626;
            background-color: #fee2e2;
        }
        .scale-option[data-scale="2"].selected {
            border-color: #ef4444;
            background-color: #ef4444;
            color: white;
        }
        
        .scale-option[data-scale="3"] {
            border-color: #f87171;
            background-color: #fef2f2;
        }
        .scale-option[data-scale="3"]:hover {
            border-color: #ef4444;
            background-color: #fee2e2;
        }
        .scale-option[data-scale="3"].selected {
            border-color: #f87171;
            background-color: #f87171;
            color: white;
        }
        
        /* Neutral option (middle) - Gray */
        .scale-option[data-scale="4"] {
            border-color: #6b7280;
            background-color: #f9fafb;
        }
        .scale-option[data-scale="4"]:hover {
            border-color: #4b5563;
            background-color: #f3f4f6;
        }
        .scale-option[data-scale="4"].selected {
            border-color: #6b7280;
            background-color: #6b7280;
            color: white;
        }
        
        /* Agree options (right side) - Green shades */
        .scale-option[data-scale="5"] {
            border-color: #65a30d;
            background-color: #f7fee7;
        }
        .scale-option[data-scale="5"]:hover {
            border-color: #84cc16;
            background-color: #ecfccb;
        }
        .scale-option[data-scale="5"].selected {
            border-color: #65a30d;
            background-color: #65a30d;
            color: white;
        }
        
        .scale-option[data-scale="6"] {
            border-color: #84cc16;
            background-color: #f7fee7;
        }
        .scale-option[data-scale="6"]:hover {
            border-color: #65a30d;
            background-color: #ecfccb;
        }
        .scale-option[data-scale="6"].selected {
            border-color: #84cc16;
            background-color: #84cc16;
            color: white;
        }
        
        .scale-option[data-scale="7"] {
            border-color: #16a34a;
            background-color: #f0fdf4;
        }
        .scale-option[data-scale="7"]:hover {
            border-color: #15803d;
            background-color: #dcfce7;
        }
        .scale-option[data-scale="7"].selected {
            border-color: #16a34a;
            background-color: #16a34a;
            color: white;
        }
        
        .scale-option.selected::after {
            content: '✓';
            position: absolute;
            font-size: 14px;
            font-weight: bold;
        }
        
        .stage-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.875rem;
        }
        
        .stage-personality { background-color: #dbeafe; color: #1e40af; }
        .stage-interests { background-color: #fce7f3; color: #be185d; }
        .stage-values { background-color: #fef3c7; color: #92400e; }
        .stage-skills { background-color: #d1fae5; color: #065f46; }

        /* Hide all questions except first by default */
        .quiz-question:not(:first-child) {
            display: none;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50 text-gray-900">
    
    <!-- Hidden inputs for JavaScript -->
    <input type="hidden" id="quiz-mode" value="<?php echo $quizMode; ?>">
    <input type="hidden" id="user-id" value="<?php echo $isLoggedIn ? $_SESSION['user_id'] : ''; ?>">
    <input type="hidden" id="session-id" value="<?php echo $isLoggedIn ? '' : $_SESSION['guest_session_id']; ?>">

    <!-- Header -->
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

    <!-- Quiz Container -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Quiz Info Card -->
        <div class="bg-white rounded-2xl shadow-sm p-8 mb-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clipboard-list text-blue-600 text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Career Path Discovery Quiz</h1>
                <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                    Answer these questions honestly to discover career paths that align with your personality, 
                    interests, values, and skills. This quiz contains 15 carefully selected questions.
                </p>
                
                <!-- Stage Overview -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="p-4 bg-blue-50 rounded-xl">
                        <div class="text-2xl font-bold text-blue-600 mb-1">5</div>
                        <div class="text-sm font-medium text-blue-900">Social</div>
                    </div>
                    <div class="p-4 bg-pink-50 rounded-xl">
                        <div class="text-2xl font-bold text-pink-600 mb-1">4</div>
                        <div class="text-sm font-medium text-pink-900">Analytical</div>
                    </div>
                    <div class="p-4 bg-yellow-50 rounded-xl">
                        <div class="text-2xl font-bold text-yellow-600 mb-1">3</div>
                        <div class="text-sm font-medium text-yellow-900">Creative</div>
                    </div>
                    <div class="p-4 bg-green-50 rounded-xl">
                        <div class="text-2xl font-bold text-green-600 mb-1">3</div>
                        <div class="text-sm font-medium text-green-900">Technical</div>
                    </div>
                </div>
                
                <!-- Mode-specific info -->
                <?php if ($is_registered): ?>
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                        <div class="flex items-center justify-center space-x-2 text-green-800">
                            <i class="fas fa-save"></i>
                            <span class="font-medium">Your results will be saved to your account</span>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                        <div class="flex items-center justify-center space-x-2 text-yellow-800">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span class="font-medium">Guest Mode: Results won't be saved</span>
                        </div>
                        <p class="text-xs text-yellow-700 mt-1">
                            <a href="../../index.php" class="underline hover:no-underline">Create an account</a> to save your results
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center space-x-3">
                    <span class="text-sm font-medium text-gray-900">Progress</span>
                    <span id="stage-badge" class="stage-badge stage-personality">
                        <i class="fas fa-user"></i>
                        <span>Personality Assessment</span>
                    </span>
                </div>
                <span class="text-sm text-gray-600">
                    <span id="current-question">1</span> of <span id="total-questions">15</span>
                </span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div id="progress-bar" class="bg-gradient-to-r from-blue-500 to-green-500 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
            </div>
        </div>

        <!-- Quiz Container for Questions -->
        <div id="quiz-container">
            <!-- Questions will be dynamically inserted here by JavaScript -->
        </div>

        <!-- Navigation positioned outside quiz container -->
        <div class="bg-white rounded-2xl shadow-sm p-6 mt-6">
            <div class="flex justify-between items-center">
                <button 
                    id="prev-btn"
                    type="button" 
                    class="px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                    disabled
                >
                    <i class="fas fa-arrow-left mr-2"></i>Previous
                </button>
                
                <button 
                    id="next-btn"
                    type="button" 
                    class="px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                    disabled
                >
                    Next<i class="fas fa-arrow-right ml-2"></i>
                </button>

                <button 
                    id="submit-btn"
                    type="button" 
                    class="px-6 py-3 bg-green-600 text-white font-medium rounded-xl hover:bg-green-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed hidden"
                    disabled
                >
                    Complete Quiz<i class="fas fa-check ml-2"></i>
                </button>
            </div>
        </div>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-400">
                <?php if ($quizMode === 'guest'): ?>
                    <i class="fas fa-info-circle mr-1"></i> You're taking the quiz as a guest. Sign in to save your progress.
                <?php else: ?>
                    <i class="fas fa-check-circle mr-1"></i> Your progress is being saved automatically.
                <?php endif; ?>
            </p>
        </div>
    </div>

    <!-- Updated Quiz JavaScript -->
    <script>
        // Career Path Discovery Quiz Application
        class QuizApp {
            constructor() {
                this.currentQuestion = 0;
                this.answers = {};
                this.questions = [
                    {
                        id: 1,
                        text: "You regularly make new friends.",
                        category: "social",
                    },
                    {
                        id: 2,
                        text: "Complex and novel ideas excite you more than simple and straightforward ones.",
                        category: "analytical",
                    },
                    {
                        id: 3,
                        text: "You usually feel more persuaded by what resonates emotionally with you than by factual arguments.",
                        category: "emotional",
                    },
                    {
                        id: 4,
                        text: "Your living and working spaces are clean and organized.",
                        category: "organized",
                    },
                    {
                        id: 5,
                        text: "You usually stay calm, even under a lot of pressure.",
                        category: "stress-management",
                    },
                    {
                        id: 6,
                        text: "You find the idea of networking or promoting yourself to strangers very daunting.",
                        category: "social",
                    },
                    {
                        id: 7,
                        text: "You enjoy working with computers and technology to solve problems.",
                        category: "technology",
                    },
                    {
                        id: 8,
                        text: "You like leading teams and managing projects to achieve goals.",
                        category: "leadership",
                    },
                    {
                        id: 9,
                        text: "You find satisfaction in helping people with their health and well-being.",
                        category: "healthcare",
                    },
                    {
                        id: 10,
                        text: "You enjoy analyzing data and finding patterns to make decisions.",
                        category: "analytical",
                    },
                    {
                        id: 11,
                        text: "You are interested in teaching and sharing knowledge with others.",
                        category: "education",
                    },
                    {
                        id: 12,
                        text: "You enjoy working with numbers, budgets, and financial planning.",
                        category: "finance",
                    },
                    {
                        id: 13,
                        text: "You enjoy creative work like design, writing, or multimedia production.",
                        category: "creative",
                    },
                    {
                        id: 14,
                        text: "You prefer working independently rather than in a team environment.",
                        category: "work-style",
                    },
                    {
                        id: 15,
                        text: "You are comfortable with public speaking and presenting ideas to large groups.",
                        category: "communication",
                    },
                ];
                this.totalQuestions = this.questions.length;
                this.quizMode = document.getElementById("quiz-mode").value;
                this.userId = document.getElementById("user-id").value;
                this.sessionId = document.getElementById("session-id").value;

                this.init();
            }

            init() {
                this.renderAllQuestions();
                this.setupEventListeners();
                this.updateProgress();
                this.updateNavigationButtons();
                this.updateStageInfo();

                // Update total questions display
                document.getElementById("total-questions").textContent = this.totalQuestions;
            }

            renderAllQuestions() {
                const container = document.getElementById("quiz-container");
                container.innerHTML = "";

                this.questions.forEach((question, index) => {
                    const questionDiv = document.createElement("div");
                    questionDiv.className = `quiz-question bg-white rounded-2xl shadow-sm p-8 ${index === 0 ? '' : 'hidden'}`;
                    questionDiv.dataset.questionId = question.id;

                    questionDiv.innerHTML = `
                        <div class="mb-8">
                            <div class="flex items-center justify-between mb-4">
                                <span class="stage-badge stage-personality">
                                    <i class="fas fa-user"></i>
                                    <span>Assessment</span>
                                </span>
                                <span class="text-sm text-gray-500">Question ${index + 1} of ${this.totalQuestions}</span>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">
                                ${question.text}
                            </h3>
                        </div>
                        
                        <div class="mb-8">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-4">
                                    <span class="text-sm font-medium text-red-600">Disagree</span>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="text-sm font-medium text-green-600">Agree</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between max-w-2xl mx-auto">
                                ${[1, 2, 3, 4, 5, 6, 7].map(scale => `
                                    <label class="cursor-pointer">
                                        <input 
                                            type="radio" 
                                            name="question_${question.id}" 
                                            value="${scale}"
                                            class="sr-only quiz-option"
                                            data-question-id="${question.id}"
                                            data-scale="${scale}"
                                        >
                                        <div class="scale-option" data-scale="${scale}"></div>
                                    </label>
                                `).join('')}
                            </div>
                            
                            <div class="flex items-center justify-between max-w-2xl mx-auto mt-2">
                                <span class="text-xs text-gray-400">Strongly Disagree</span>
                                <span class="text-xs text-gray-400">Neutral</span>
                                <span class="text-xs text-gray-400">Strongly Agree</span>
                            </div>
                        </div>
                    `;

                    container.appendChild(questionDiv);
                });
            }

            setupEventListeners() {
                // Radio button clicks
                document.addEventListener("click", (e) => {
                    if (e.target.classList.contains("scale-option")) {
                        const input = e.target.parentElement.querySelector('input[type="radio"]');
                        const questionId = input.dataset.questionId;
                        const scale = input.dataset.scale;
                        
                        // Remove selected class from all options in this question
                        const questionDiv = e.target.closest('.quiz-question');
                        questionDiv.querySelectorAll('.scale-option').forEach(option => {
                            option.classList.remove('selected');
                        });
                        
                        // Add selected class to clicked option
                        e.target.classList.add('selected');
                        
                        // Check the radio button
                        input.checked = true;
                        
                        // Store answer
                        this.answers[questionId] = parseInt(scale);
                        
                        this.updateNavigationButtons();
                    }
                });

                // Navigation buttons
                document.getElementById("prev-btn").addEventListener("click", () => {
                    if (this.currentQuestion > 0) {
                        this.currentQuestion--;
                        this.showQuestion(this.currentQuestion);
                        this.updateProgress();
                        this.updateNavigationButtons();
                        this.updateStageInfo();
                    }
                });

                document.getElementById("next-btn").addEventListener("click", () => {
                    if (this.currentQuestion < this.totalQuestions - 1) {
                        this.currentQuestion++;
                        this.showQuestion(this.currentQuestion);
                        this.updateProgress();
                        this.updateNavigationButtons();
                        this.updateStageInfo();
                    }
                });

                document.getElementById("submit-btn").addEventListener("click", () => {
                    this.submitQuiz();
                });
            }

            showQuestion(index) {
                const allQuestions = document.querySelectorAll(".quiz-question");
                
                allQuestions.forEach((q, i) => {
                    if (i === index) {
                        q.classList.remove('hidden');
                    } else {
                        q.classList.add('hidden');
                    }
                });
            }

            updateProgress() {
                const progress = ((this.currentQuestion + 1) / this.totalQuestions) * 100;
                document.getElementById("progress-bar").style.width = `${progress}%`;
                document.getElementById("current-question").textContent = this.currentQuestion + 1;
            }

            updateStageInfo() {
                // Update stage badge if needed
                const stageBadge = document.getElementById("stage-badge");
                // You can customize this based on question categories if needed
            }

            updateNavigationButtons() {
                const prevBtn = document.getElementById("prev-btn");
                const nextBtn = document.getElementById("next-btn");
                const submitBtn = document.getElementById("submit-btn");

                // Previous button
                prevBtn.disabled = this.currentQuestion === 0;

                // Check if current question is answered
                const currentQuestionId = this.questions[this.currentQuestion].id;
                const isAnswered = this.answers.hasOwnProperty(currentQuestionId);

                // Next/Submit button
                if (this.currentQuestion === this.totalQuestions - 1) {
                    nextBtn.classList.add("hidden");
                    submitBtn.classList.remove("hidden");
                    submitBtn.disabled = !isAnswered;
                } else {
                    nextBtn.classList.remove("hidden");
                    submitBtn.classList.add("hidden");
                    nextBtn.disabled = !isAnswered;
                }
            }

            submitQuiz() {
                // Placeholder for submit functionality
                alert("Quiz completed! Submit functionality will be implemented soon.");
                console.log("Quiz answers:", this.answers);
            }
        }

        // Initialize quiz when DOM is loaded
        document.addEventListener("DOMContentLoaded", () => {
            new QuizApp();
        });
    </script>
</body>
</html>