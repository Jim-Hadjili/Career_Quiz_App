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
    document.getElementById("total-questions").textContent =
      this.totalQuestions;
  }

  renderAllQuestions() {
    const container = document.getElementById("quiz-container");
    container.innerHTML = "";

    this.questions.forEach((question, index) => {
      const questionDiv = document.createElement("div");
      questionDiv.className = `quiz-question bg-white rounded-2xl shadow-sm p-8 ${
        index === 0 ? "" : "hidden"
      }`;
      questionDiv.dataset.questionId = question.id;

      questionDiv.innerHTML = `
                        <div class="mb-8">
                            <div class="flex items-center justify-between mb-4">
                                <span class="stage-badge stage-personality">
                                    <i class="fas fa-user"></i>
                                    <span>Assessment</span>
                                </span>
                                <span class="text-sm text-gray-500">Question ${
                                  index + 1
                                } of ${this.totalQuestions}</span>
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
                                ${[1, 2, 3, 4, 5, 6, 7]
                                  .map(
                                    (scale) => `
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
                                `
                                  )
                                  .join("")}
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
        const input = e.target.parentElement.querySelector(
          'input[type="radio"]'
        );
        const questionId = input.dataset.questionId;
        const scale = input.dataset.scale;

        // Remove selected class from all options in this question
        const questionDiv = e.target.closest(".quiz-question");
        questionDiv.querySelectorAll(".scale-option").forEach((option) => {
          option.classList.remove("selected");
        });

        // Add selected class to clicked option
        e.target.classList.add("selected");

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
        q.classList.remove("hidden");
      } else {
        q.classList.add("hidden");
      }
    });
  }

  updateProgress() {
    const progress = ((this.currentQuestion + 1) / this.totalQuestions) * 100;
    document.getElementById("progress-bar").style.width = `${progress}%`;
    document.getElementById("current-question").textContent =
      this.currentQuestion + 1;
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
