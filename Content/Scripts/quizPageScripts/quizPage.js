import { orderedQuizQuestions as quizQuestions } from "./quizQuestions.js";
import { QuestionRenderer } from "./questionRenderer.js";
import { EventHandlers } from "./eventHandlers.js";
import { NavigationUtils } from "./navigationUtils.js";
import { ProgressUtils } from "./progressUtils.js";
import { QuizSubmission } from "./quizSubmission.js";
import { CoreSubjectsHandler } from "./coreSubjectsHandler.js";

class QuizApp {
  constructor() {
    this.currentCategory = 0;
    this.answers = {};
    this.questions = quizQuestions;
    this.categories = this.getCategories();
    this.totalCategories = this.categories.length;
    this.totalQuestions = this.questions.length;
    this.needsCoreSubjects = false;
    this.coreSubjects = null;

    const quizModeEl = document.getElementById("quiz-mode");
    const userIdEl = document.getElementById("user-id");
    const sessionIdEl = document.getElementById("session-id");

    this.quizMode = quizModeEl ? quizModeEl.value : "guest";
    this.userId = userIdEl ? userIdEl.value : "";
    this.sessionId = sessionIdEl ? sessionIdEl.value : "";

    this.init();
  }

  init() {
    QuestionRenderer.renderCategoryQuestions(this, this.currentCategory);
    EventHandlers.setupEventListeners(this);
    ProgressUtils.updateProgress(this);
    NavigationUtils.updateNavigationButtons(this);
    CoreSubjectsHandler.init(this);

    const totalQuestionsEl = document.getElementById("total-questions");
    if (totalQuestionsEl) {
      totalQuestionsEl.textContent = this.totalQuestions;
    }
  }

  getCategories() {
    const categories = [];
    const seen = new Set();

    this.questions.forEach((question) => {
      if (!seen.has(question.category)) {
        categories.push(question.category);
        seen.add(question.category);
      }
    });

    return categories;
  }

  getQuestionsByCategory(category) {
    return this.questions.filter((question) => question.category === category);
  }

  getCurrentCategoryQuestions() {
    const currentCategory = this.categories[this.currentCategory];
    return this.getQuestionsByCategory(currentCategory);
  }

  isCategoryComplete() {
    const categoryQuestions = this.getCurrentCategoryQuestions();
    return categoryQuestions.every((question) =>
      this.answers.hasOwnProperty(question.id)
    );
  }

  getAnsweredQuestionsCount() {
    return Object.keys(this.answers).length;
  }

  showCategory(categoryIndex) {
    NavigationUtils.showCategory(this, categoryIndex);
  }

  updateProgress() {
    ProgressUtils.updateProgress(this);
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
