export class EventHandlers {
  static setupEventListeners(quizApp) {
    // Radio button clicks
    document.addEventListener("click", (e) => {
      if (e.target.classList.contains("scale-option")) {
        const input = e.target.parentElement.querySelector(
          'input[type="radio"]'
        );
        const questionId = input.dataset.questionId;
        const scale = input.dataset.scale;

        // Remove selected class from all options in this question
        const questionDiv = e.target.closest(".question-item");
        questionDiv.querySelectorAll(".scale-option").forEach((option) => {
          option.classList.remove("selected");
        });

        // Add selected class to clicked option
        e.target.classList.add("selected");

        // Check the radio button
        input.checked = true;

        // Store answer
        quizApp.answers[questionId] = Number.parseInt(scale);

        // Update UI
        quizApp.updateNavigationButtons();
        quizApp.updateProgress();

        console.log("[EventHandler] Answer saved:", {
          questionId,
          scale,
          category: quizApp.categories[quizApp.currentCategory],
          allAnswers: quizApp.answers,
        });
      }
    });

    // Navigation buttons
    const prevBtn = document.getElementById("prev-btn");
    const nextBtn = document.getElementById("next-btn");
    const submitBtn = document.getElementById("submit-btn");

    if (prevBtn) {
      prevBtn.addEventListener("click", () => {
        if (quizApp.currentCategory > 0) {
          quizApp.currentCategory--;
          quizApp.showCategory(quizApp.currentCategory);
          quizApp.updateProgress();
          quizApp.updateNavigationButtons();
        }
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener("click", () => {
        if (quizApp.currentCategory < quizApp.totalCategories - 1) {
          quizApp.currentCategory++;
          quizApp.showCategory(quizApp.currentCategory);
          quizApp.updateProgress();
          quizApp.updateNavigationButtons();
        }
      });
    }

    if (submitBtn) {
      submitBtn.addEventListener("click", () => {
        quizApp.submitQuiz();
      });
    }
  }
}
