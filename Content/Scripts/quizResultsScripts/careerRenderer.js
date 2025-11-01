export class CareerRenderer {
  static renderCareerCards(careerPaths) {
    if (!careerPaths || !Array.isArray(careerPaths)) {
      console.error("[CareerRenderer] Invalid career paths data");
      return;
    }

    const careerCardsContainer = document.getElementById(
      "career-cards-container"
    );
    if (!careerCardsContainer) {
      console.error("[CareerRenderer] Career cards container not found");
      return;
    }

    careerCardsContainer.innerHTML = "";

    careerPaths.forEach((path, index) => {
      const cardHtml = this.createCareerCardHtml(path, index);
      careerCardsContainer.innerHTML += cardHtml;
    });

    // Add click event listeners to career cards
    this.setupCardClickListeners(careerPaths);

    this.renderProgressDots(careerPaths.length);
    console.log(`[CareerRenderer] Rendered ${careerPaths.length} career cards`);
  }

  static createCareerCardHtml(path, index) {
    return `
      <div class="career-card cursor-pointer hover:shadow-xl transition-all duration-300 ${
        index === 0 ? "active" : ""
      }" data-index="${index}" data-career-title="${path.title}">
        <div class="flex flex-col lg:flex-row items-start gap-8 p-6 bg-white rounded-2xl border border-gray-200 hover:border-lime/50 transition-colors relative">
          <div class="w-20 h-20 bg-lime rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg">
            <i class="fas ${
              path.icon || "fa-briefcase"
            } text-dark text-3xl"></i>
          </div>
          <div class="flex-1">
            <h3 class="text-3xl font-bold text-gray-800 mb-4">${path.title}</h3>
            <p class="text-gray-600 text-lg leading-relaxed mb-6">${
              path.description
            }</p>
            
            <div class="bg-white border border-lime/30 rounded-2xl p-6 mb-6">
              <h4 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                <i class="fas fa-lightbulb text-lime"></i>
                Why This is a Good Fit for You
              </h4>
              <p class="text-gray-700 leading-relaxed">${path.why_good_fit}</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 bg-white rounded-2xl border border-gray-200">
              <div class="text-center">
                <p class="text-sm text-gray-600 mb-2 font-medium">Match Score</p>
                <p class="font-bold text-lime text-2xl">${
                  path.match_percentage
                }%</p>
              </div>
              <div class="text-center">
                <p class="text-sm text-gray-600 mb-2 font-medium">Salary Range</p>
                <p class="font-bold text-gray-800 text-2xl">${
                  path.salary_range || "Varies"
                }</p>
              </div>
              <div class="text-center">
                <p class="text-sm text-gray-600 mb-2 font-medium">Job Growth</p>
                <p class="font-bold text-gray-800 text-2xl">${
                  path.growth_outlook || "Medium"
                }</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    `;
  }

  static setupCardClickListeners(careerPaths) {
    document.querySelectorAll(".career-card").forEach((card, index) => {
      // Make the entire card clickable
      card.addEventListener("click", (e) => {
        // Don't trigger selection if clicking navigation buttons
        if (
          e.target.closest("#prevBtn") ||
          e.target.closest("#nextBtn") ||
          e.target.closest("#progress-dots")
        ) {
          return;
        }

        if (window.careerSelector && careerPaths[index]) {
          window.careerSelector.selectCareer(
            careerPaths[index].title,
            careerPaths[index]
          );
        }
      });
    });
  }

  static renderProgressDots(totalCareers) {
    const progressDots = document.getElementById("progress-dots");
    if (!progressDots) return;

    progressDots.innerHTML = "";
    for (let i = 0; i < totalCareers; i++) {
      const dotHtml = `
        <button
          onclick="window.careerNavigation.goToCareer(${i})"
          class="w-4 h-4 rounded-full transition-all duration-300 ${
            i === 0 ? "bg-lime w-10" : "bg-gray-300 hover:bg-gray-400"
          } shadow-md"
          id="dot-${i}"
        ></button>
      `;
      progressDots.innerHTML += dotHtml;
    }
  }
}
