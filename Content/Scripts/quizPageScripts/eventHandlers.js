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
        const questionDiv = e.target.closest(".quiz-question");
        questionDiv.querySelectorAll(".scale-option").forEach((option) => {
          option.classList.remove("selected");
        });

        // Add selected class to clicked option
        e.target.classList.add("selected");

        // Check the radio button
        input.checked = true;

        // Store answer
        quizApp.answers[questionId] = Number.parseInt(scale);

        quizApp.updateNavigationButtons();

        console.log("[EventHandler] Answer saved:", {
          questionId,
          scale,
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
        if (quizApp.currentQuestion > 0) {
          quizApp.currentQuestion--;
          quizApp.showQuestion(quizApp.currentQuestion);
          quizApp.updateProgress();
          quizApp.updateNavigationButtons();
          quizApp.updateStageInfo();
        }
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener("click", () => {
        if (quizApp.currentQuestion < quizApp.totalQuestions - 1) {
          quizApp.currentQuestion++;
          quizApp.showQuestion(quizApp.currentQuestion);
          quizApp.updateProgress();
          quizApp.updateNavigationButtons();
          quizApp.updateStageInfo();
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
