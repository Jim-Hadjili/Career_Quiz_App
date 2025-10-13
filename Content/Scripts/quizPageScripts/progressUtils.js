import { CategoryConfig } from "./categoryConfig.js";

export class ProgressUtils {
  static updateProgress(quizApp) {
    const progress =
      ((quizApp.currentQuestion + 1) / quizApp.totalQuestions) * 100;
    const progressBar = document.getElementById("progress-bar");
    const currentQuestionEl = document.getElementById("current-question");

    if (progressBar) {
      progressBar.style.width = `${progress}%`;
      console.log("[v0] Progress updated:", progress + "%");
    } else {
      console.error("[v0] Progress bar element not found");
    }

    if (currentQuestionEl) {
      currentQuestionEl.textContent = quizApp.currentQuestion + 1;
    }
  }

  static updateStageInfo(quizApp) {
    const stageBadges = document.querySelectorAll(".stage-badge");

    if (stageBadges.length === 0) {
      console.error("[v0] Stage badge elements not found");
      return;
    }

    const currentQuestion = quizApp.questions[quizApp.currentQuestion];
    if (!currentQuestion) return;

    const categoryInfo = CategoryConfig.getCategoryInfo(
      currentQuestion.category
    );

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
