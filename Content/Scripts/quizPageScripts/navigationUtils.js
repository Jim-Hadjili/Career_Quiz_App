export class NavigationUtils {
  static showQuestion(quizApp, index) {
    const allQuestions = document.querySelectorAll(".quiz-question");

    allQuestions.forEach((q, i) => {
      if (i === index) {
        q.style.display = "block";
      } else {
        q.style.display = "none";
      }
    });
  }

  static updateNavigationButtons(quizApp) {
    const prevBtn = document.getElementById("prev-btn");
    const nextBtn = document.getElementById("next-btn");
    const submitBtn = document.getElementById("submit-btn");

    if (!prevBtn || !nextBtn || !submitBtn) {
      console.error("[v0] Navigation buttons not found");
      return;
    }

    // Previous button
    prevBtn.disabled = quizApp.currentQuestion === 0;

    // Check if current question is answered
    const currentQuestionId = quizApp.questions[quizApp.currentQuestion].id;
    const isAnswered = quizApp.answers.hasOwnProperty(currentQuestionId);

    // Next/Submit button
    if (quizApp.currentQuestion === quizApp.totalQuestions - 1) {
      nextBtn.classList.add("hidden");
      submitBtn.classList.remove("hidden");
      submitBtn.disabled = !isAnswered;
    } else {
      nextBtn.classList.remove("hidden");
      submitBtn.classList.add("hidden");
      nextBtn.disabled = !isAnswered;
    }
  }
}
