// Quiz Application Logic
class QuizApp {
  constructor() {
    this.currentQuestion = 0;
    this.answers = {};
    this.questions = [
      {
        id: 1,
        text: "I enjoy working with computers and technology to solve problems",
        category: "technology",
      },
      {
        id: 2,
        text: "I like leading teams and managing projects to achieve goals",
        category: "business",
      },
      {
        id: 3,
        text: "I find satisfaction in helping people with their health and well-being",
        category: "healthcare",
      },
      {
        id: 4,
        text: "I enjoy analyzing data and finding patterns to make decisions",
        category: "technology",
      },
      {
        id: 5,
        text: "I like developing business strategies and marketing plans",
        category: "business",
      },
      {
        id: 6,
        text: "I am interested in teaching and sharing knowledge with others",
        category: "education",
      },
      {
        id: 7,
        text: "I enjoy working with numbers, budgets, and financial planning",
        category: "finance",
      },
      {
        id: 8,
        text: "I am interested in law, legal procedures, and helping people with legal matters",
        category: "legal",
      },
      {
        id: 9,
        text: "I enjoy creative work like design, writing, or multimedia production",
        category: "creative",
      },
      {
        id: 10,
        text: "I prefer working in healthcare settings like hospitals or clinics",
        category: "healthcare",
      },
      {
        id: 11,
        text: "I am comfortable presenting ideas and training groups of people",
        category: "education",
      },
      {
        id: 12,
        text: "I enjoy investigating financial records and ensuring accuracy",
        category: "finance",
      },
      {
        id: 13,
        text: "I am interested in researching laws and helping clients understand their rights",
        category: "legal",
      },
      {
        id: 14,
        text: "I like creating visual content and managing social media accounts",
        category: "creative",
      },
      {
        id: 15,
        text: "I am interested in software development and programming applications",
        category: "technology",
      },
    ];
    this.totalQuestions = this.questions.length;
    this.quizMode = document.getElementById("quiz-mode").value;
    this.userId = document.getElementById("user-id").value;
    this.sessionId = document.getElementById("session-id").value;

    this.init();
  }

  init() {
    this.loadQuestion();
    this.setupEventListeners();
    this.updateProgress();

    // Auto-save for registered users
    if (this.quizMode === "user") {
      this.setupAutoSave();
    }
  }

  setupEventListeners() {
    document
      .getElementById("next-btn")
      .addEventListener("click", () => this.nextQuestion());
    document
      .getElementById("prev-btn")
      .addEventListener("click", () => this.prevQuestion());
    document
      .getElementById("submit-btn")
      .addEventListener("click", () => this.submitQuiz());
  }

  setupAutoSave() {
    // Auto-save every 30 seconds for registered users
    setInterval(() => {
      if (Object.keys(this.answers).length > 0) {
        this.autoSaveProgress();
      }
    }, 30000);
  }

  loadQuestion() {
    const question = this.questions[this.currentQuestion];
    const questionContainer = document.getElementById("question-container");

    questionContainer.innerHTML = `
            <div class="mb-6">
                <h3 class="text-xl font-bold text-dark mb-4">Question ${
                  this.currentQuestion + 1
                }</h3>
                <p class="text-lg text-gray-700 mb-6">${question.text}</p>
                
                <div class="space-y-3">
                    <label class="text-sm font-medium text-gray-600 block mb-2">
                        How much do you agree with this statement?
                    </label>
                    <div class="grid grid-cols-7 gap-2">
                        ${this.generateScaleOptions(question.id)}
                    </div>
                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                        <span>Strongly Disagree</span>
                        <span>Neutral</span>
                        <span>Strongly Agree</span>
                    </div>
                </div>
            </div>
        `;

    // Restore previous answer if exists
    if (this.answers[question.id]) {
      const radio = document.querySelector(
        `input[name="question_${question.id}"][value="${
          this.answers[question.id]
        }"]`
      );
      if (radio) radio.checked = true;
    }

    this.updateNavigationButtons();
  }

  generateScaleOptions(questionId) {
    let options = "";
    for (let i = 1; i <= 7; i++) {
      options += `
                <label class="relative cursor-pointer">
                    <input type="radio" name="question_${questionId}" value="${i}" 
                           class="sr-only peer" onchange="quiz.saveAnswer(${questionId}, ${i})">
                    <div class="w-12 h-12 rounded-full border-2 border-gray-300 flex items-center justify-center 
                                peer-checked:border-lime peer-checked:bg-lime peer-checked:text-dark 
                                hover:border-gray-400 transition-all duration-200 font-medium">
                        ${i}
                    </div>
                </label>
            `;
    }
    return options;
  }

  saveAnswer(questionId, value) {
    this.answers[questionId] = value;
    this.updateNavigationButtons();
  }

  nextQuestion() {
    if (this.currentQuestion < this.totalQuestions - 1) {
      this.currentQuestion++;
      this.loadQuestion();
      this.updateProgress();
    }
  }

  prevQuestion() {
    if (this.currentQuestion > 0) {
      this.currentQuestion--;
      this.loadQuestion();
      this.updateProgress();
    }
  }

  updateProgress() {
    document.getElementById("current-question").textContent =
      this.currentQuestion + 1;
    document.getElementById("total-questions").textContent =
      this.totalQuestions;
    const progress = ((this.currentQuestion + 1) / this.totalQuestions) * 100;
    document.getElementById("progress-bar").style.width = `${progress}%`;
  }

  updateNavigationButtons() {
    const prevBtn = document.getElementById("prev-btn");
    const nextBtn = document.getElementById("next-btn");
    const submitBtn = document.getElementById("submit-btn");

    prevBtn.disabled = this.currentQuestion === 0;

    if (this.currentQuestion === this.totalQuestions - 1) {
      nextBtn.classList.add("hidden");
      submitBtn.classList.remove("hidden");
    } else {
      nextBtn.classList.remove("hidden");
      submitBtn.classList.add("hidden");
    }

    // Enable next/submit only if current question is answered
    const currentQuestionId = this.questions[this.currentQuestion].id;
    const isAnswered = this.answers[currentQuestionId] !== undefined;

    nextBtn.disabled = !isAnswered;
    submitBtn.disabled =
      !isAnswered || Object.keys(this.answers).length !== this.totalQuestions;
  }

  async autoSaveProgress() {
    if (this.quizMode !== "user") return;

    try {
      const response = await fetch(
        "../Functions/quizPageFunctions/saveProgress.php",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            user_id: this.userId,
            answers: this.answers,
            current_question: this.currentQuestion,
          }),
        }
      );

      const result = await response.json();
      if (!result.success) {
        console.error("Auto-save failed:", result.error);
      }
    } catch (error) {
      console.error("Auto-save error:", error);
    }
  }

  async submitQuiz() {
    if (Object.keys(this.answers).length !== this.totalQuestions) {
      alert("Please answer all questions before submitting.");
      return;
    }

    document.getElementById("loading-overlay").classList.remove("hidden");

    try {
      const quizData = this.questions.map((q) => ({
        question_id: q.id.toString(),
        scale_value: this.answers[q.id],
        option_value: this.answers[q.id],
        category: q.category,
      }));

      // Prepare submission data with proper null handling
      const submissionData = {
        quiz_mode: this.quizMode,
        quiz_data: quizData,
      };

      // Add user_id only for logged-in users
      if (this.quizMode === "user" && this.userId) {
        submissionData.user_id = this.userId;
      }

      // Add session_id only for guest users
      if (this.quizMode === "guest" && this.sessionId) {
        submissionData.session_id = this.sessionId;
      }

      const response = await fetch(
        "../Functions/quizPageFunctions/submitQuiz.php",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(submissionData),
        }
      );

      const result = await response.json();

      if (result.success) {
        // Redirect to results page
        window.location.href = `quizResults.php?result_id=${result.result_id}&mode=${this.quizMode}`;
      } else {
        throw new Error(result.error || "Failed to submit quiz");
      }
    } catch (error) {
      console.error("Quiz submission error:", error);
      alert("Failed to submit quiz. Please try again.");
    } finally {
      document.getElementById("loading-overlay").classList.add("hidden");
    }
  }
}

// Initialize quiz when page loads
let quiz;
document.addEventListener("DOMContentLoaded", function () {
  quiz = new QuizApp();
});
