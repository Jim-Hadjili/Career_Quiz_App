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

    const categoryInfo = this.getCategoryInfo(currentQuestion.category);

    // Update all stage badges (in case there are multiple)
    stageBadges.forEach((stageBadge) => {
      stageBadge.className = `stage-badge ${categoryInfo.class}`;
      stageBadge.innerHTML = `
        <i class="${categoryInfo.icon}"></i>
        <span>${categoryInfo.label}</span>
      `;
    });
  }

  static getCategoryInfo(category) {
    // Map individual categories to the 4 main quiz categories
    const categoryMap = {
      // Personality traits
      social: {
        class: "stage-personality",
        icon: "fas fa-user",
        label: "Personality traits",
      },
      analytical: {
        class: "stage-personality",
        icon: "fas fa-user",
        label: "Personality traits",
      },
      emotional: {
        class: "stage-personality",
        icon: "fas fa-user",
        label: "Personality traits",
      },
      organized: {
        class: "stage-personality",
        icon: "fas fa-user",
        label: "Personality traits",
      },
      "stress-management": {
        class: "stage-personality",
        icon: "fas fa-user",
        label: "Personality traits",
      },
      "work-style": {
        class: "stage-personality",
        icon: "fas fa-user",
        label: "Personality traits",
      },
      leadership: {
        class: "stage-personality",
        icon: "fas fa-user",
        label: "Personality traits",
      },
      communication: {
        class: "stage-personality",
        icon: "fas fa-user",
        label: "Personality traits",
      },

      // Interests & Hobbies
      technology: {
        class: "stage-interests",
        icon: "fas fa-heart",
        label: "Interests & Hobbies",
      },
      creative: {
        class: "stage-interests",
        icon: "fas fa-heart",
        label: "Interests & Hobbies",
      },

      // Work Values
      healthcare: {
        class: "stage-values",
        icon: "fas fa-star",
        label: "Work Values",
      },
      education: {
        class: "stage-values",
        icon: "fas fa-star",
        label: "Work Values",
      },

      // Skills & Strengths
      finance: {
        class: "stage-abilities",
        icon: "fas fa-bolt",
        label: "Skills & Strengths",
      },
    };

    return (
      categoryMap[category] || {
        class: "stage-personality",
        icon: "fas fa-user",
        label: "Personality traits",
      }
    );
  }
}
