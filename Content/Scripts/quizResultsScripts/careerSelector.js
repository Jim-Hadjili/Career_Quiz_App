export class CareerSelector {
  constructor() {
    this.selectedCareer = null;
    this.selectionId = null;
    this.resultId = null;
    this.userId = null;
    this.isGuest = false;
    this.isLoggedIn = false;
    this.init();
  }

  init() {
    // Get user information from PHP session data
    if (window.APP_CONFIG) {
      this.userId = window.APP_CONFIG.userId;
      this.isLoggedIn = window.APP_CONFIG.isLoggedIn;
      console.log("[CareerSelector] User data loaded:", {
        userId: this.userId,
        isLoggedIn: this.isLoggedIn,
      });
    }

    // Get URL parameters to determine result ID and guest status
    const urlParams = new URLSearchParams(window.location.search);
    this.resultId = urlParams.get("result_id");
    this.isGuest = urlParams.get("guest") === "true";

    console.log("[CareerSelector] URL params:", {
      resultId: this.resultId,
      isGuest: this.isGuest,
    });

    this.createModal();
  }

  // New method to be called after career cards are rendered
  async checkExistingSelection() {
    console.log("[CareerSelector] checkExistingSelection called");
    // Only check if user is logged in and has a result ID
    if (this.isLoggedIn && this.userId && this.resultId && !this.isGuest) {
      console.log(
        "[CareerSelector] Conditions met, loading existing selection..."
      );
      await this.loadExistingSelection();
    } else {
      console.log("[CareerSelector] Conditions not met:", {
        isLoggedIn: this.isLoggedIn,
        userId: this.userId,
        resultId: this.resultId,
        isGuest: this.isGuest,
      });
    }
  }

  createModal() {
    const modalHtml = `
      <div id="career-selection-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl">
          <div class="text-center">
            <div class="w-16 h-16 bg-lime rounded-full flex items-center justify-center mx-auto mb-4">
              <i class="fas fa-check text-dark text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Select Career Path</h3>
            <p class="text-gray-600 mb-6" id="modal-message">Are you sure you want to select this career as your preferred path?</p>
            <div id="selected-career-preview" class="bg-gray-50 rounded-lg p-4 mb-6">
              <h4 id="modal-career-title" class="font-semibold text-gray-800"></h4>
            </div>
            <div class="flex gap-3 justify-center">
              <button id="cancel-selection" class="px-6 py-2 border border-gray-300 rounded-lg font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
                Cancel
              </button>
              <button id="confirm-selection" class="px-6 py-2 bg-lime text-dark rounded-lg font-semibold hover:bg-lime/90 transition-colors">
                <span id="confirm-button-text">Confirm Selection</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    `;

    document.body.insertAdjacentHTML("beforeend", modalHtml);
    this.setupModalEventListeners();
  }

  setupModalEventListeners() {
    const modal = document.getElementById("career-selection-modal");
    const cancelBtn = document.getElementById("cancel-selection");
    const confirmBtn = document.getElementById("confirm-selection");

    // Close modal on cancel
    cancelBtn.addEventListener("click", () => this.closeModal());

    // Close modal on outside click
    modal.addEventListener("click", (e) => {
      if (e.target === modal) this.closeModal();
    });

    // Handle confirmation
    confirmBtn.addEventListener("click", () => this.confirmSelection());

    // Close modal on escape key
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && !modal.classList.contains("hidden")) {
        this.closeModal();
      }
    });
  }

  async loadExistingSelection() {
    try {
      const formData = new FormData();
      formData.append("action", "get_selected_career");
      formData.append("result_id", this.resultId);
      formData.append("user_id", this.userId);

      console.log("[CareerSelector] Checking for existing selection with:", {
        result_id: this.resultId,
        user_id: this.userId,
      });

      const response = await fetch(
        "../Functions/quizPageFunctions/getSelectedCareer.php",
        {
          method: "POST",
          body: formData,
        }
      );

      const text = await response.text();
      console.log("[CareerSelector] Raw response:", text);

      const result = JSON.parse(text);
      console.log("[CareerSelector] Parsed result:", result);

      if (result.success && result.career) {
        this.selectedCareer = result.career;
        this.selectionId = result.selection_id;

        console.log("[CareerSelector] Found existing selection:", {
          career: result.career,
          selection_id: result.selection_id,
        });

        // Try multiple times to highlight the career with different delays
        this.attemptHighlight(result.career, 0);
      } else {
        console.log("[CareerSelector] No existing selection found");
      }
    } catch (error) {
      console.error(
        "[CareerSelector] Error loading existing selection:",
        error
      );
    }
  }

  attemptHighlight(careerTitle, attempt) {
    const maxAttempts = 10;
    const delay = 500; // ms

    console.log(
      `[CareerSelector] Attempt ${
        attempt + 1
      } to highlight career: ${careerTitle}`
    );

    // Check if career cards are available
    const careerCards = document.querySelectorAll(".career-card");
    console.log(`[CareerSelector] Found ${careerCards.length} career cards`);

    if (careerCards.length > 0) {
      const highlighted = this.highlightSelectedCareer(careerTitle);
      if (highlighted) {
        console.log("[CareerSelector] Successfully highlighted career");
        return;
      }
    }

    // If highlighting failed and we haven't reached max attempts, try again
    if (attempt < maxAttempts) {
      setTimeout(() => {
        this.attemptHighlight(careerTitle, attempt + 1);
      }, delay);
    } else {
      console.error(
        "[CareerSelector] Failed to highlight career after all attempts"
      );
    }
  }

  selectCareer(careerTitle, careerData) {
    console.log("[CareerSelector] Attempting to select career:", careerTitle);
    console.log("[CareerSelector] Current state:", {
      isLoggedIn: this.isLoggedIn,
      userId: this.userId,
      resultId: this.resultId,
      isGuest: this.isGuest,
      currentSelection: this.selectedCareer,
    });

    // Check if user is a guest
    if (this.isGuest) {
      this.showGuestMessage();
      return;
    }

    // Check if user is logged in and has valid data
    if (!this.isLoggedIn || !this.userId || !this.resultId) {
      this.showLoginMessage();
      return;
    }

    this.currentSelection = {
      title: careerTitle,
      data: careerData,
    };

    // Check if this is the same career already selected
    if (this.selectedCareer === careerTitle) {
      this.showChangeSelectionModal(careerTitle, careerData);
    } else {
      this.showModal(careerTitle, careerData);
    }
  }

  showModal(careerTitle, careerData) {
    const modal = document.getElementById("career-selection-modal");
    const titleElement = document.getElementById("modal-career-title");
    const messageElement = document.getElementById("modal-message");
    const confirmButtonText = document.getElementById("confirm-button-text");

    titleElement.textContent = careerTitle;

    // Update modal text based on whether user has a previous selection
    if (this.selectedCareer) {
      messageElement.textContent = `This will replace your current selection (${this.selectedCareer}). Continue?`;
      confirmButtonText.textContent = "Change Selection";
    } else {
      messageElement.textContent =
        "Are you sure you want to select this career as your preferred path?";
      confirmButtonText.textContent = "Confirm Selection";
    }

    modal.classList.remove("hidden");
    document.body.style.overflow = "hidden";
  }

  showChangeSelectionModal(careerTitle, careerData) {
    const modal = document.getElementById("career-selection-modal");
    const titleElement = document.getElementById("modal-career-title");
    const messageElement = document.getElementById("modal-message");
    const confirmButtonText = document.getElementById("confirm-button-text");

    titleElement.textContent = careerTitle;
    messageElement.textContent =
      "This career is already selected. Do you want to remove your selection?";
    confirmButtonText.textContent = "Remove Selection";

    this.isRemoving = true;
    modal.classList.remove("hidden");
    document.body.style.overflow = "hidden";
  }

  closeModal() {
    const modal = document.getElementById("career-selection-modal");
    modal.classList.add("hidden");
    document.body.style.overflow = "";
    this.currentSelection = null;
    this.isRemoving = false;
  }

  async confirmSelection() {
    if (!this.currentSelection) return;

    console.log(
      "[CareerSelector] Confirming selection:",
      this.currentSelection.title
    );

    try {
      if (this.isRemoving) {
        await this.removeSelection();
      } else {
        await this.saveSelection();
      }
    } catch (error) {
      console.error("[CareerSelector] Error in confirmSelection:", error);
      this.showErrorMessage("Failed to process request. Please try again.");
    }
  }

  async saveSelection() {
    const formData = new FormData();
    formData.append("action", "select_career");
    formData.append("result_id", this.resultId);
    formData.append("user_id", this.userId);
    formData.append("career_selected", this.currentSelection.title);

    console.log("[CareerSelector] Sending selection data:", {
      result_id: this.resultId,
      user_id: this.userId,
      career_selected: this.currentSelection.title,
    });

    const response = await fetch(
      "../Functions/quizPageFunctions/selectCareer.php",
      {
        method: "POST",
        body: formData,
      }
    );

    const text = await response.text();
    console.log("[CareerSelector] Raw response:", text);

    const result = JSON.parse(text);

    if (result.success) {
      this.selectedCareer = this.currentSelection.title;
      this.highlightSelectedCareer(this.currentSelection.title);
      this.showSuccessMessage("Career selected successfully!");
      this.closeModal();
    } else {
      throw new Error(result.message);
    }
  }

  async removeSelection() {
    const formData = new FormData();
    formData.append("action", "remove_career_selection");
    formData.append("result_id", this.resultId);
    formData.append("user_id", this.userId);

    const response = await fetch(
      "../Functions/quizPageFunctions/selectCareer.php",
      {
        method: "POST",
        body: formData,
      }
    );

    const result = await response.json();

    if (result.success) {
      this.selectedCareer = null;
      this.selectionId = null;
      this.removeHighlight();
      this.showSuccessMessage("Career selection removed!");
      this.closeModal();
    } else {
      throw new Error(result.message);
    }
  }

  highlightSelectedCareer(careerTitle) {
    console.log(
      "[CareerSelector] Attempting to highlight career:",
      careerTitle
    );

    // Remove previous selections
    this.removeHighlight();

    let highlighted = false;

    // Find and highlight the selected career card
    document.querySelectorAll(".career-card").forEach((card) => {
      const titleElement = card.querySelector("h3");
      if (titleElement) {
        console.log(
          "[CareerSelector] Checking card title:",
          titleElement.textContent.trim()
        );
        if (titleElement.textContent.trim() === careerTitle) {
          console.log("[CareerSelector] Found matching card, highlighting...");

          card.classList.add("selected-career");

          // Add selection badge
          const badge = document.createElement("div");
          badge.className =
            "selection-badge absolute top-4 right-4 bg-lime text-dark px-3 py-1 rounded-full text-sm font-semibold flex items-center gap-1";
          badge.innerHTML = '<i class="fas fa-check"></i> Selected';

          // Make card content position relative if not already
          const cardContent = card.querySelector(".flex");
          if (cardContent) {
            cardContent.style.position = "relative";
            cardContent.appendChild(badge);
          }

          highlighted = true;
        }
      }
    });

    console.log("[CareerSelector] Highlighting result:", highlighted);
    return highlighted;
  }

  removeHighlight() {
    document.querySelectorAll(".career-card").forEach((card) => {
      card.classList.remove("selected-career");
      const selectionBadge = card.querySelector(".selection-badge");
      if (selectionBadge) selectionBadge.remove();
    });
  }

  showGuestMessage() {
    this.showInfoMessage(
      "Please create an account or log in to save your career selection."
    );
  }

  showLoginMessage() {
    this.showInfoMessage(
      "Please log in to select and save your preferred career path."
    );
  }

  showSuccessMessage(message) {
    this.showNotification(message, "success");
  }

  showErrorMessage(message) {
    this.showNotification(message, "error");
  }

  showInfoMessage(message) {
    this.showNotification(message, "info");
  }

  showNotification(message, type) {
    const notification = document.createElement("div");
    const bgColor =
      type === "success"
        ? "bg-green-500"
        : type === "error"
        ? "bg-red-500"
        : "bg-blue-500";

    notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300`;
    notification.textContent = message;

    document.body.appendChild(notification);

    // Slide in
    setTimeout(() => {
      notification.classList.remove("translate-x-full");
    }, 100);

    // Slide out and remove
    setTimeout(() => {
      notification.classList.add("translate-x-full");
      setTimeout(() => {
        if (notification.parentNode) {
          notification.parentNode.removeChild(notification);
        }
      }, 300);
    }, 3000);
  }
}
