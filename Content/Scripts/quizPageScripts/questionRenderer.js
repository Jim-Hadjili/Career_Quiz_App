import { CategoryConfig } from "./categoryConfig.js";

export class QuestionRenderer {
  static renderAllQuestions(quizApp) {
    const container = document.getElementById("quiz-container");
    if (!container) {
      console.error("[v0] Quiz container not found");
      return;
    }

    container.innerHTML = "";

    quizApp.questions.forEach((question, index) => {
      const questionDiv = document.createElement("div");
      questionDiv.className = `quiz-question bg-white rounded-2xl shadow-sm p-8 border-2`;
      questionDiv.dataset.questionId = question.id;

      if (index !== 0) {
        questionDiv.style.display = "none";
      }

      questionDiv.innerHTML = `
        <div class="mb-8">
          <div class="flex items-center justify-between mb-4">
            <span class="stage-badge stage-personality">
              <i class="fas fa-user"></i>
              <span>Personality Assessment</span>
            </span>
            <span class="text-sm text-gray-600 font-sans">Question ${
              index + 1
            } of ${quizApp.totalQuestions}</span>
          </div>
          <h3 class="text-xl font-bold text-dark font-sans">
            ${question.text}
          </h3>
        </div>
        
        <div class="mb-8">
          <div class="flex items-center justify-between mb-4 max-w-4xl mx-auto">
            <div class="flex items-center space-x-4">
              <span class="text-sm font-bold text-red-600 font-sans">Disagree</span>
            </div>
            <div class="flex items-center space-x-4">
              <span class="text-sm font-bold text-green-600 font-sans">Agree</span>
            </div>
          </div>
          
          <div class="flex items-center justify-between max-w-2xl mx-auto">
            ${[1, 2, 3, 4, 5, 6, 7]
              .map(
                (scale) => `
                <label class="cursor-pointer">
                  <input 
                    type="radio" 
                    name="question_${question.id}" 
                    value="${scale}"
                    class="sr-only quiz-option"
                    data-question-id="${question.id}"
                    data-scale="${scale}"
                  >
                  <div class="scale-option" data-scale="${scale}"></div>
                </label>
              `
              )
              .join("")}
          </div>
        </div>
      `;

      container.appendChild(questionDiv);
    });
  }

  static renderCategoryQuestions(quizApp, categoryIndex) {
    const container = document.getElementById("quiz-container");
    if (!container) {
      console.error("[v0] Quiz container not found");
      return;
    }

    container.innerHTML = "";

    const categories = quizApp.getCategories();
    const currentCategory = categories[categoryIndex];
    const categoryQuestions = quizApp.getQuestionsByCategory(currentCategory);
    const categoryInfo = CategoryConfig.getCategoryInfo(currentCategory);

    // Create category container
    const categoryDiv = document.createElement("div");
    categoryDiv.className = "category-container";
    categoryDiv.innerHTML = `
      <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
          <div class="stage-badge ${categoryInfo.class}">
            <i class="${categoryInfo.icon}"></i>
            <span>${categoryInfo.label}</span>
          </div>
          <span class="text-sm text-gray-600 font-sans">
            Category ${categoryIndex + 1} of ${categories.length}
          </span>
        </div>
        <div class="mb-4">
          <h2 class="text-2xl font-bold text-dark font-sans mb-2">
            ${categoryInfo.label}
          </h2>
          <p class="text-gray-600 font-sans">
            Please rate how much you agree with each statement on a scale from 1 (Strongly Disagree) to 7 (Strongly Agree).
          </p>
        </div>
      </div>
    `;

    // Create questions grid
    const questionsGrid = document.createElement("div");
    questionsGrid.className = "questions-grid space-y-6";

    categoryQuestions.forEach((question, index) => {
      const questionDiv = document.createElement("div");
      questionDiv.className =
        "question-item bg-gray-50 rounded-xl p-6 border-2";
      questionDiv.dataset.questionId = question.id;

      questionDiv.innerHTML = `
        <div class="mb-4">
          <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-semibold text-gray-500 font-sans">
              Question ${index + 1} of ${categoryQuestions.length}
            </span>
          </div>
          <h3 class="text-lg font-semibold text-dark font-sans">
            ${question.text}
          </h3>
        </div>
        
        <div class="mb-4">
          <div class="flex items-center justify-between mb-3 max-w-4xl mx-auto">
            <div class="flex items-center space-x-2">
              <span class="text-xs font-bold text-red-600 font-sans">Strongly Disagree</span>
            </div>
            <div class="flex items-center space-x-2">
              <span class="text-xs font-bold text-green-600 font-sans">Strongly Agree</span>
            </div>
          </div>
          
          <div class="flex items-center justify-between max-w-xl mx-auto">
            ${[1, 2, 3, 4, 5, 6, 7]
              .map(
                (scale) => `
                <label class="cursor-pointer flex flex-col items-center">
                  <input 
                    type="radio" 
                    name="question_${question.id}" 
                    value="${scale}"
                    class="sr-only quiz-option"
                    data-question-id="${question.id}"
                    data-scale="${scale}"
                  >
                  <div class="scale-option scale-option-small" data-scale="${scale}"></div>
                  <span class="text-xs text-gray-500 mt-1 font-sans">${scale}</span>
                </label>
              `
              )
              .join("")}
          </div>
        </div>
      `;

      questionsGrid.appendChild(questionDiv);
    });

    categoryDiv.appendChild(questionsGrid);
    container.appendChild(categoryDiv);

    // Restore answers for this category
    this.restoreCategoryAnswers(quizApp, categoryQuestions);
  }

  static restoreCategoryAnswers(quizApp, categoryQuestions) {
    categoryQuestions.forEach((question) => {
      const savedAnswer = quizApp.answers[question.id];
      if (savedAnswer) {
        const questionDiv = document.querySelector(
          `[data-question-id="${question.id}"]`
        );
        if (questionDiv) {
          const radioInput = questionDiv.querySelector(
            `input[data-scale="${savedAnswer}"]`
          );
          const scaleOption = questionDiv.querySelector(
            `[data-scale="${savedAnswer}"].scale-option`
          );

          if (radioInput && scaleOption) {
            radioInput.checked = true;
            scaleOption.classList.add("selected");
          }
        }
      }
    });
  }
}
