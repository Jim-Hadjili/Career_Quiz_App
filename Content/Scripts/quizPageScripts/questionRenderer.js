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
}
