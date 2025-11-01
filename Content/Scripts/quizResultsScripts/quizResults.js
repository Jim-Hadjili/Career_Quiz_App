import { ResultsDataLoader } from "./resultsDataLoader.js";
import { PersonalityRenderer } from "./personalityRenderer.js";
import { CareerRenderer } from "./careerRenderer.js";
import { CareerNavigation } from "./careerNavigation.js";
import { MobileMenuHandler } from "./mobileMenuHandler.js";
import { CareerSelector } from "./careerSelector.js";

class QuizResults {
  constructor() {
    this.resultsData = null;
    this.careerNavigation = new CareerNavigation();
    this.careerSelector = new CareerSelector();

    // Make navigation functions globally available immediately
    this.setupGlobalFunctions();

    this.init();
  }

  setupGlobalFunctions() {
    // Make career navigation functions globally available for onclick handlers
    window.nextCareer = () => {
      if (this.careerNavigation) {
        this.careerNavigation.nextCareer();
      }
    };

    window.previousCareer = () => {
      if (this.careerNavigation) {
        this.careerNavigation.previousCareer();
      }
    };

    window.goToCareer = (index) => {
      if (this.careerNavigation) {
        this.careerNavigation.goToCareer(index);
      }
    };

    // Make career selector globally available
    window.careerSelector = this.careerSelector;

    // Make career navigation instance globally available
    window.careerNavigation = this.careerNavigation;
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

    // Make career selector globally available
    window.careerSelector = this.careerSelector;

    // Render personality information
    PersonalityRenderer.renderPersonalityInfo(this.resultsData);

    // Render career cards if available
    if (this.resultsData.careerRecommendations?.recommended_careers) {
      const careers =
        this.resultsData.careerRecommendations.recommended_careers;
      CareerRenderer.renderCareerCards(careers);

      // Initialize career navigation with the actual number of careers
      this.careerNavigation.init(careers.length);

      // Check for existing career selection after cards are rendered
      // Use multiple timeouts to ensure highlighting works
      setTimeout(() => {
        console.log(
          "[QuizResults] Calling checkExistingSelection (first attempt)"
        );
        this.careerSelector.checkExistingSelection();
      }, 1000);

      setTimeout(() => {
        console.log(
          "[QuizResults] Calling checkExistingSelection (second attempt)"
        );
        this.careerSelector.checkExistingSelection();
      }, 2000);
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
