import { CategoryConfig } from "./categoryConfig.js";

export class ProgressUtils {
  static updateProgress(quizApp) {
    const answeredQuestions = quizApp.getAnsweredQuestionsCount();
    const progress = (answeredQuestions / quizApp.totalQuestions) * 100;

    const progressBar = document.getElementById("progress-bar");
    const currentQuestionEl = document.getElementById("current-question");

    if (progressBar) {
      progressBar.style.width = `${progress}%`;
      console.log("[v0] Progress updated:", progress + "%");
    } else {
      console.error("[v0] Progress bar element not found");
    }

    if (currentQuestionEl) {
      currentQuestionEl.textContent = answeredQuestions;
    }

    // Update category progress info
    this.updateCategoryProgress(quizApp);
  }

  static updateCategoryProgress(quizApp) {
    const currentCategory = quizApp.categories[quizApp.currentCategory];
    const categoryQuestions = quizApp.getCurrentCategoryQuestions();
    const answeredInCategory = categoryQuestions.filter((q) =>
      quizApp.answers.hasOwnProperty(q.id)
    ).length;

    // You can add elements to display category-specific progress
    console.log(
      `[Progress] Category ${currentCategory}: ${answeredInCategory}/${categoryQuestions.length} answered`
    );
  }

  static updateStageInfo(quizApp) {
    const currentCategory = quizApp.categories[quizApp.currentCategory];
    const categoryInfo = CategoryConfig.getCategoryInfo(currentCategory);
    const stageBadges = document.querySelectorAll(".stage-badge");

    if (stageBadges.length === 0) {
      console.error("[v0] Stage badge elements not found");
      return;
    }

    // Update all stage badges (in case there are multiple)
    stageBadges.forEach((stageBadge) => {
      stageBadge.className = `stage-badge ${categoryInfo.class}`;
      stageBadge.innerHTML = `
        <i class="${categoryInfo.icon}"></i>
        <span>${categoryInfo.label}</span>
      `;
    });
  }
}
