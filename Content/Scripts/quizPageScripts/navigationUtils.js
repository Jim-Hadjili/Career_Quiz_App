import { QuestionRenderer } from "./questionRenderer.js";

export class NavigationUtils {
  static showCategory(quizApp, categoryIndex) {
    quizApp.currentCategory = categoryIndex;
    QuestionRenderer.renderCategoryQuestions(quizApp, categoryIndex);

    // Use requestAnimationFrame to ensure DOM is updated before scrolling
    requestAnimationFrame(() => {
      this.scrollToQuizContainer();
    });

    console.log(
      `[Navigation] Showing category ${categoryIndex + 1}: ${
        quizApp.categories[categoryIndex]
      }`
    );
  }

  static scrollToQuizContainer() {
    const quizContainer = document.getElementById("quiz-container");
    if (quizContainer) {
      // Get the position of the quiz container
      const containerTop =
        quizContainer.getBoundingClientRect().top + window.pageYOffset;
      // Scroll to 100px above the container for better visibility
      const scrollPosition = containerTop - 115;

      window.scrollTo({
        top: scrollPosition,
        behavior: "smooth",
      });
    } else {
      // Fallback: scroll to top of page
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    }
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
    prevBtn.disabled = quizApp.currentCategory === 0;

    // Check if current category is complete
    const isCategoryComplete = quizApp.isCategoryComplete();

    // Next/Submit button
    if (quizApp.currentCategory === quizApp.totalCategories - 1) {
      nextBtn.classList.add("hidden");
      submitBtn.classList.remove("hidden");
      submitBtn.disabled = !isCategoryComplete;
    } else {
      nextBtn.classList.remove("hidden");
      submitBtn.classList.add("hidden");
      nextBtn.disabled = !isCategoryComplete;
    }

    // Update button text based on category completion
    if (isCategoryComplete) {
      if (quizApp.currentCategory === quizApp.totalCategories - 1) {
        submitBtn.innerHTML = 'Complete Quiz<i class="fas fa-check ml-2"></i>';
      } else {
        nextBtn.innerHTML = `Next Category<i class="fas fa-arrow-right ml-2"></i>`;
      }
    } else {
      nextBtn.innerHTML = `Complete Category<i class="fas fa-arrow-right ml-2"></i>`;
    }
  }
}
