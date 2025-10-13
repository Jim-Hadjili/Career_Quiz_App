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

    // Update total questions display
    document.getElementById("total-questions").textContent =
      this.totalQuestions;
  }

  renderAllQuestions() {
    const container = document.getElementById("quiz-container");
    container.innerHTML = "";

    this.questions.forEach((question, index) => {
      const questionDiv = document.createElement("div");
      questionDiv.className = `question-item ${index === 0 ? "fade-in" : ""}`;
      questionDiv.dataset.questionId = question.id;
      questionDiv.style.display = index === 0 ? "block" : "none";

      questionDiv.innerHTML = `
        <div class="space-y-8">
          <p class="question-text ${
            index === 0 ? "active" : ""
          } text-center max-w-3xl mx-auto">
            ${question.text}
          </p>
          
          <div class="flex items-center justify-between max-w-2xl mx-auto px-4">
            <span class="text-sm font-medium text-gray-400 mr-4">Disagree</span>
            
            <div class="flex items-center justify-center gap-3 flex-1">
              ${[1, 2, 3, 4, 5, 6, 7]
                .map(
                  (value) => `
                <div class="radio-option" data-value="${value}" data-question="${question.id}"></div>
              `
                )
                .join("")}
            </div>
            
            <span class="text-sm font-medium text-emerald-500 ml-4">Agree</span>
          </div>
        </div>
      `;

      container.appendChild(questionDiv);
    });
  }

  setupEventListeners() {
    // Radio button clicks
    document.addEventListener("click", (e) => {
      if (e.target.classList.contains("radio-option")) {
        const questionId = parseInt(e.target.dataset.question);
        const value = parseInt(e.target.dataset.value);

        // Remove selected class from all options for this question
        document
          .querySelectorAll(`.radio-option[data-question="${questionId}"]`)
          .forEach((opt) => opt.classList.remove("selected"));

        // Add selected class to clicked option
        e.target.classList.add("selected");

        // Store answer
        this.answers[questionId] = value;

        // Enable next button
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
      }
    });

    document.getElementById("next-btn").addEventListener("click", () => {
      if (this.currentQuestion < this.totalQuestions - 1) {
        this.currentQuestion++;
        this.showQuestion(this.currentQuestion);
        this.updateProgress();
        this.updateNavigationButtons();
      }
    });
  }

  showQuestion(index) {
    const allQuestions = document.querySelectorAll(".question-item");
    const allTexts = document.querySelectorAll(".question-text");

    allQuestions.forEach((q, i) => {
      if (i === index) {
        q.style.display = "block";
        q.classList.add("fade-in");
        allTexts[i].classList.add("active");
      } else {
        q.style.display = "none";
        q.classList.remove("fade-in");
        allTexts[i].classList.remove("active");
      }
    });
  }

  updateProgress() {
    const progress = ((this.currentQuestion + 1) / this.totalQuestions) * 100;
    document.getElementById("progress-bar").style.width = `${progress}%`;
    document.getElementById("progress-percentage").textContent =
      Math.round(progress);
    document.getElementById("current-question").textContent =
      this.currentQuestion + 1;
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

    // Next button
    if (this.currentQuestion === this.totalQuestions - 1) {
      nextBtn.style.display = "none";
      submitBtn.classList.remove("hidden");
    } else {
      nextBtn.style.display = "block";
      submitBtn.classList.add("hidden");
      nextBtn.disabled = !isAnswered;
    }
  }
}

// Initialize quiz when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
  new QuizApp();
});
