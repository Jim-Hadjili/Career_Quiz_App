import { orderedQuizQuestions as quizQuestions } from "./quizQuestions.js";
import { QuestionRenderer } from "./questionRenderer.js";
import { EventHandlers } from "./eventHandlers.js";
import { NavigationUtils } from "./navigationUtils.js";
import { ProgressUtils } from "./progressUtils.js";
import { QuizSubmission } from "./quizSubmission.js";

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
    QuestionRenderer.renderAllQuestions(this);
    EventHandlers.setupEventListeners(this);
    ProgressUtils.updateProgress(this);
    NavigationUtils.updateNavigationButtons(this);
    ProgressUtils.updateStageInfo(this);

    const totalQuestionsEl = document.getElementById("total-questions");
    if (totalQuestionsEl) {
      totalQuestionsEl.textContent = this.totalQuestions;
    }
  }

  setupEventListeners() {
    EventHandlers.setupEventListeners(this);
  }

  showQuestion(index) {
    NavigationUtils.showQuestion(this, index);
  }

  updateProgress() {
    ProgressUtils.updateProgress(this);
  }

  updateStageInfo() {
    ProgressUtils.updateStageInfo(this);
  }

  updateNavigationButtons() {
    NavigationUtils.updateNavigationButtons(this);
  }

  submitQuiz() {
    QuizSubmission.submitQuiz(this);
  }
}

document.addEventListener("DOMContentLoaded", () => {
  console.log("[v0] Initializing QuizApp...");
  new QuizApp();
});
