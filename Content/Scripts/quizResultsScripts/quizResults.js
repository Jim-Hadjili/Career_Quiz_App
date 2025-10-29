import { ResultsDataLoader } from "./resultsDataLoader.js";
import { PersonalityRenderer } from "./personalityRenderer.js";
import { CareerRenderer } from "./careerRenderer.js";
import { CareerNavigation } from "./careerNavigation.js";
import { MobileMenuHandler } from "./mobileMenuHandler.js";

class QuizResults {
  constructor() {
    this.resultsData = null;
    this.careerNavigation = new CareerNavigation();
    this.init();
  }

  async init() {
    console.log("[QuizResults] Initializing results page...");

    try {
      // Load results data
      this.resultsData = await ResultsDataLoader.loadResultsData();

      if (!this.resultsData) {
        throw new Error("Failed to load results data");
      }

      // Initialize components
      this.initializeComponents();

      console.log("[QuizResults] Results page initialized successfully");
    } catch (error) {
      console.error("[QuizResults] Initialization failed:", error);
      this.showErrorState();
    }
  }

  initializeComponents() {
    // Initialize mobile menu handler
    MobileMenuHandler.init();

    // Render personality information
    PersonalityRenderer.renderPersonalityInfo(this.resultsData);

    // Render career cards if available
    if (this.resultsData.careerRecommendations?.recommended_careers) {
      const careers =
        this.resultsData.careerRecommendations.recommended_careers;
      CareerRenderer.renderCareerCards(careers);

      // Initialize career navigation
      this.careerNavigation.init(careers.length);

      // Make career navigation globally available for onclick handlers
      window.careerNavigation = this.careerNavigation;
    }
  }

  showErrorState() {
    const container = document.getElementById("results-container");
    if (container) {
      container.innerHTML = `
        <div class="text-center py-12">
          <i class="fas fa-exclamation-triangle text-red-500 text-4xl mb-4"></i>
          <h2 class="text-2xl font-bold text-gray-800 mb-2">Error Loading Results</h2>
          <p class="text-gray-600 mb-4">We encountered an error while loading your quiz results.</p>
          <button onclick="window.location.reload()" class="bg-lime text-dark px-6 py-2 rounded-lg font-semibold hover:bg-lime/90 transition-colors">
            Try Again
          </button>
        </div>
      `;
    }
  }
}

// Initialize the application when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
  console.log("[QuizResults] DOM loaded, initializing application...");
  new QuizResults();
});

// Export for potential external use
export { QuizResults };
