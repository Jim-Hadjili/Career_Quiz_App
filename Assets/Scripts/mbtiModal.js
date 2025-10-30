// MBTI Modal Functions
let mbtiModalOpen = false;
let selectedMbtiType = null;
let originalMbtiType = null;

// MBTI type descriptions
const mbtiDescriptions = {
  INTJ: "The Architect - Strategic & Innovative",
  INTP: "The Thinker - Logical & Creative",
  ENTJ: "The Commander - Bold & Decisive",
  ENTP: "The Debater - Quick & Ingenious",
  INFJ: "The Advocate - Creative & Insightful",
  INFP: "The Mediator - Poetic & Kind",
  ENFJ: "The Protagonist - Charismatic & Inspiring",
  ENFP: "The Campaigner - Enthusiastic & Creative",
  ISTJ: "The Logistician - Practical & Reliable",
  ISFJ: "The Protector - Warm & Conscientious",
  ESTJ: "The Executive - Organized & Driven",
  ESFJ: "The Consul - Caring & Social",
  ISTP: "The Virtuoso - Bold & Practical",
  ISFP: "The Adventurer - Flexible & Charming",
  ESTP: "The Entrepreneur - Smart & Energetic",
  ESFP: "The Entertainer - Spontaneous & Enthusiastic",
};

// Open MBTI Modal
function openMbtiModal() {
  const modal = document.getElementById("mbti-modal");
  const modalContent = document.getElementById("mbti-modal-content");

  // Load existing MBTI type
  loadMbtiType();

  modal.classList.remove("hidden");
  document.body.style.overflow = "hidden";
  mbtiModalOpen = true;

  setTimeout(() => {
    modalContent.classList.remove("scale-95", "opacity-0");
    modalContent.classList.add("scale-100", "opacity-100");
  }, 10);
}

// Close MBTI Modal
function closeMbtiModal() {
  const modal = document.getElementById("mbti-modal");
  const modalContent = document.getElementById("mbti-modal-content");

  modalContent.classList.remove("scale-100", "opacity-100");
  modalContent.classList.add("scale-95", "opacity-0");

  setTimeout(() => {
    modal.classList.add("hidden");
    document.body.style.overflow = "";
    resetMbtiForm();
    mbtiModalOpen = false;
  }, 300);
}

// Load MBTI Type from Database
async function loadMbtiType() {
  try {
    const response = await fetch("Config/Auth/mbti_handler.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ action: "get_mbti_type" }),
    });

    const data = await response.json();

    if (data.success && data.mbti_type) {
      originalMbtiType = data.mbti_type;
      showCurrentMbtiType(data.mbti_type);
    } else {
      console.log("No existing MBTI type found, showing selection form");
      showMbtiSelectionForm();
      originalMbtiType = null;
    }
  } catch (error) {
    console.error("Error loading MBTI type:", error);
    showMbtiMessage("Error loading MBTI type", "error");
    showMbtiSelectionForm();
    originalMbtiType = null;
  }
}

// Show Current MBTI Type Display
function showCurrentMbtiType(mbtiType) {
  const currentDisplay = document.getElementById("current-mbti-display");
  const selectionForm = document.getElementById("mbti-selection-form");
  const currentTypeSpan = document.getElementById("current-mbti-type");
  const currentDescSpan = document.getElementById("current-mbti-description");

  // Show current type, hide selection form
  currentDisplay.classList.remove("hidden");
  selectionForm.classList.add("hidden");

  // Update display
  currentTypeSpan.textContent = mbtiType;
  currentDescSpan.textContent =
    mbtiDescriptions[mbtiType] || "Personality Type";

  // Update button states
  updateSaveButtonState(false);
  document.getElementById("clear-mbti-button").classList.add("hidden");
}

// Show MBTI Selection Form
function showMbtiSelectionForm() {
  const currentDisplay = document.getElementById("current-mbti-display");
  const selectionForm = document.getElementById("mbti-selection-form");

  // Hide current type, show selection form
  currentDisplay.classList.add("hidden");
  selectionForm.classList.remove("hidden");

  // Show clear button if editing existing type
  if (originalMbtiType) {
    document.getElementById("clear-mbti-button").classList.remove("hidden");
  }

  // Reset selection state
  selectedMbtiType = originalMbtiType;
  updateMbtiSelection();
}

// Update MBTI Selection UI
function updateMbtiSelection() {
  const buttons = document.querySelectorAll(".modal-mbti-button");
  const statusSpan = document.getElementById("mbti-selection-status");
  const hiddenInput = document.getElementById("modal-mbti-type");

  // Reset all buttons
  buttons.forEach((btn) => {
    btn.classList.remove("selected");
  });

  if (selectedMbtiType) {
    // Find and select the current type button
    const selectedButton = document.querySelector(
      `[data-type="${selectedMbtiType}"]`
    );
    if (selectedButton) {
      selectedButton.classList.add("selected");
    }

    // Update status
    statusSpan.textContent = `${selectedMbtiType} selected ✓`;
    statusSpan.className = "text-sm text-dark font-medium";
    hiddenInput.value = selectedMbtiType;

    updateSaveButtonState(true);
  } else {
    // No selection
    statusSpan.textContent = "Please make a selection";
    statusSpan.className = "text-sm text-gray-600";
    hiddenInput.value = "";

    updateSaveButtonState(false);
  }
}

// Update Save Button State
function updateSaveButtonState(enabled) {
  const saveButton = document.getElementById("save-mbti-button");
  saveButton.disabled = !enabled;
}

// Reset MBTI Form
function resetMbtiForm() {
  selectedMbtiType = null;
  originalMbtiType = null;

  // Reset button states
  const buttons = document.querySelectorAll(".modal-mbti-button");
  buttons.forEach((btn) => {
    btn.classList.remove("selected");
  });

  clearMbtiMessages();
  updateSaveButtonState(false);
}

// Clear MBTI Selection
function clearMbtiSelection() {
  if (
    confirm(
      "Are you sure you want to clear your MBTI type? This action cannot be undone."
    )
  ) {
    selectedMbtiType = null;
    updateMbtiSelection();
    showMbtiMessage("MBTI type selection cleared", "error");
  }
}

// Show MBTI Message
function showMbtiMessage(message, type = "success") {
  clearMbtiMessages();
  const messagesContainer = document.getElementById("mbti-messages");
  const messageDiv = document.createElement("div");

  if (type === "success") {
    messageDiv.className =
      "mbti-message bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-4";
  } else {
    messageDiv.className =
      "mbti-message bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4";
  }

  messageDiv.textContent = message;
  messagesContainer.appendChild(messageDiv);
}

// Clear MBTI Messages
function clearMbtiMessages() {
  const messages = document.querySelectorAll(".mbti-message");
  messages.forEach((message) => message.remove());
}

// Handle MBTI Form Submission
async function handleMbtiFormSubmission(event) {
  event.preventDefault();

  if (!selectedMbtiType) {
    showMbtiMessage("Please select an MBTI type", "error");
    return;
  }

  const submitButton = document.getElementById("save-mbti-button");
  const originalText = submitButton.innerHTML;

  // Disable button and show loading
  submitButton.disabled = true;
  submitButton.innerHTML = `
        <div class="relative z-10 flex items-center gap-2">
            <i class="fas fa-spinner fa-spin"></i>
            Saving...
        </div>
    `;

  try {
    const requestData = {
      action: "save_mbti_type",
      mbti_type: selectedMbtiType,
    };

    const response = await fetch("Config/Auth/mbti_handler.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(requestData),
    });

    const data = await response.json();

    if (data.success) {
      showMbtiMessage(data.message, "success");
      originalMbtiType = selectedMbtiType;

      // Close modal after success
      setTimeout(() => {
        closeMbtiModal();
      }, 1500);
    } else {
      showMbtiMessage(data.message, "error");
    }
  } catch (error) {
    console.error("MBTI save error:", error);
    showMbtiMessage("An error occurred while saving MBTI type", "error");
  } finally {
    // Re-enable button
    submitButton.disabled = false;
    submitButton.innerHTML = originalText;
  }
}

// Initialize MBTI Modal Event Listeners
document.addEventListener("DOMContentLoaded", function () {
  // Close modal button
  const closeButton = document.getElementById("close-mbti-modal");
  if (closeButton) {
    closeButton.addEventListener("click", closeMbtiModal);
  }

  // Change MBTI button (switch from display to edit mode)
  const changeMbtiButton = document.getElementById("change-mbti-button");
  if (changeMbtiButton) {
    changeMbtiButton.addEventListener("click", showMbtiSelectionForm);
  }

  // Clear MBTI button
  const clearMbtiButton = document.getElementById("clear-mbti-button");
  if (clearMbtiButton) {
    clearMbtiButton.addEventListener("click", clearMbtiSelection);
  }

  // Form submission
  const form = document.getElementById("mbti-form");
  if (form) {
    form.addEventListener("submit", handleMbtiFormSubmission);
  }

  // MBTI button handlers
  const mbtiButtons = document.querySelectorAll(".modal-mbti-button");
  mbtiButtons.forEach((button) => {
    button.addEventListener("click", function () {
      selectedMbtiType = this.getAttribute("data-type");
      updateMbtiSelection();
    });
  });

  // Close modal when clicking outside
  const modal = document.getElementById("mbti-modal");
  if (modal) {
    modal.addEventListener("click", function (e) {
      if (e.target === modal) {
        closeMbtiModal();
      }
    });
  }

  // ESC key to close modal
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && mbtiModalOpen) {
      closeMbtiModal();
    }
  });
});
