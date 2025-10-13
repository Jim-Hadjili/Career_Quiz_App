// Import statements
import { quizQuestions } from "./quizQuestions.js";
import { QuestionRenderer } from "./questionRenderer.js";

class QuizApp {
  constructor() {
    this.currentQuestion = 0;
    this.answers = {};
    this.questions = quizQuestions;
    this.totalQuestions = this.questions.length;

    const quizModeEl = document.getElementById("quiz-mode");
    const userIdEl = document.getElementById("user-id");
    const sessionIdEl = document.getElementById("session-id");

    this.quizMode = quizModeEl ? quizModeEl.value : "guest";
    this.userId = userIdEl ? userIdEl.value : "";
    this.sessionId = sessionIdEl ? sessionIdEl.value : "";

    this.init();
  }

  init() {
    QuestionRenderer.renderAllQuestions(this); // Use the external renderer
    this.setupEventListeners();
    this.updateProgress();
    this.updateNavigationButtons();
    this.updateStageInfo();

    // Update total questions display
    const totalQuestionsEl = document.getElementById("total-questions");
    if (totalQuestionsEl) {
      totalQuestionsEl.textContent = this.totalQuestions;
    }
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
        this.answers[questionId] = Number.parseInt(scale);

        this.updateNavigationButtons();
      }
    });

    // Navigation buttons
    const prevBtn = document.getElementById("prev-btn");
    const nextBtn = document.getElementById("next-btn");
    const submitBtn = document.getElementById("submit-btn");

    if (prevBtn) {
      prevBtn.addEventListener("click", () => {
        if (this.currentQuestion > 0) {
          this.currentQuestion--;
          this.showQuestion(this.currentQuestion);
          this.updateProgress();
          this.updateNavigationButtons();
          this.updateStageInfo();
        }
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener("click", () => {
        if (this.currentQuestion < this.totalQuestions - 1) {
          this.currentQuestion++;
          this.showQuestion(this.currentQuestion);
          this.updateProgress();
          this.updateNavigationButtons();
          this.updateStageInfo();
        }
      });
    }

    if (submitBtn) {
      submitBtn.addEventListener("click", () => {
        this.submitQuiz();
      });
    }
  }

  showQuestion(index) {
    const allQuestions = document.querySelectorAll(".quiz-question");

    allQuestions.forEach((q, i) => {
      if (i === index) {
        q.style.display = "block";
      } else {
        q.style.display = "none";
      }
    });
  }

  updateProgress() {
    const progress = ((this.currentQuestion + 1) / this.totalQuestions) * 100;
    const progressBar = document.getElementById("progress-bar");
    const currentQuestionEl = document.getElementById("current-question");

    if (progressBar) {
      progressBar.style.width = `${progress}%`;
      console.log("[v0] Progress updated:", progress + "%");
    } else {
      console.error("[v0] Progress bar element not found");
    }

    if (currentQuestionEl) {
      currentQuestionEl.textContent = this.currentQuestion + 1;
    }
  }

  updateStageInfo() {
    const stageBadge = document.getElementById("stage-badge");
  }

  updateNavigationButtons() {
    const prevBtn = document.getElementById("prev-btn");
    const nextBtn = document.getElementById("next-btn");
    const submitBtn = document.getElementById("submit-btn");

    if (!prevBtn || !nextBtn || !submitBtn) {
      console.error("[v0] Navigation buttons not found");
      return;
    }

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
  console.log("[v0] Initializing QuizApp...");
  new QuizApp();
});
