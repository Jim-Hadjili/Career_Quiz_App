// Subject Grade Modal Functions
let subjectGradeModalOpen = false;
let originalGrades = {};

// Open Subject Grade Modal
function openSubjectGradeModal() {
  const modal = document.getElementById("subject-grade-modal");
  const modalContent = document.getElementById("subject-grade-modal-content");

  // Load existing grades
  loadSubjectGrades();

  modal.classList.remove("hidden");
  document.body.style.overflow = "hidden";
  subjectGradeModalOpen = true;

  setTimeout(() => {
    modalContent.classList.remove("scale-95", "opacity-0");
    modalContent.classList.add("scale-100", "opacity-100");
  }, 10);
}

// Close Subject Grade Modal
function closeSubjectGradeModal() {
  const modal = document.getElementById("subject-grade-modal");
  const modalContent = document.getElementById("subject-grade-modal-content");

  modalContent.classList.remove("scale-100", "opacity-100");
  modalContent.classList.add("scale-95", "opacity-0");

  setTimeout(() => {
    modal.classList.add("hidden");
    document.body.style.overflow = "";
    resetSubjectGradeForm();
    subjectGradeModalOpen = false;
  }, 300);
}

// Load Subject Grades from Database
async function loadSubjectGrades() {
  try {
    const response = await fetch("Config/Auth/subject_grade_handler.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ action: "get_subject_grades" }),
    });

    const data = await response.json();

    if (data.success) {
      populateSubjectGradeForm(data.grades);
      originalGrades = { ...data.grades };
    } else {
      console.log("No existing grades found, showing empty form");
      populateSubjectGradeForm({});
      originalGrades = {};
    }
  } catch (error) {
    console.error("Error loading subject grades:", error);
    showSubjectGradeMessage("Error loading subject grades", "error");
    populateSubjectGradeForm({});
    originalGrades = {};
  }
}

// Populate Subject Grade Form
function populateSubjectGradeForm(grades) {
  const inputs = {
    Statistics_and_Probability: "modal-statistics-grade",
    Physical_Science: "modal-physical-science-grade",
    oral_comm_context: "modal-oral-comm-grade",
    general_math: "modal-general-math-grade",
    earth_life_sci: "modal-earth-life-sci-grade",
    ucsp: "modal-ucsp-grade",
    reading_writing: "modal-reading-writing-grade",
    lit21_ph_world: "modal-lit21-ph-world-grade",
    media_info_lit: "modal-media-info-lit-grade",
  };

  // Populate grade inputs
  Object.keys(inputs).forEach((key) => {
    const input = document.getElementById(inputs[key]);
    if (input && grades[key]) {
      input.value = grades[key];
    }
  });

  updateSubjectGradeProgress();
}

// Reset Subject Grade Form
function resetSubjectGradeForm() {
  const form = document.getElementById("subject-grade-form");
  form.reset();

  clearSubjectGradeMessages();
  updateSubjectGradeProgress();
}

// Update Progress Counter
function updateSubjectGradeProgress() {
  const inputs = document.querySelectorAll(
    '#subject-grade-form input[type="number"]'
  );
  const filledInputs = Array.from(inputs).filter(
    (input) => input.value.trim() !== ""
  );
  const counter = document.getElementById("subject-filled-counter");
  const status = document.getElementById("subject-grade-status");

  if (counter) {
    counter.textContent = filledInputs.length;
  }

  // Show status badges
  if (filledInputs.length === inputs.length && status) {
    status.classList.remove("hidden");
  } else if (status) {
    status.classList.add("hidden");
  }
}

// Validate Grade Input
function validateGrade(input) {
  let value = parseFloat(input.value);

  if (input.value.trim() === "" || isNaN(value)) {
    return;
  }

  if (value < 65) {
    input.value = 65;
    showGradeAdjustmentFeedback(input, "minimum");
  } else if (value > 100) {
    input.value = 100;
    showGradeAdjustmentFeedback(input, "maximum");
  }
}

// Show Grade Adjustment Feedback
function showGradeAdjustmentFeedback(input, type) {
  const parent = input.parentElement;
  const message =
    type === "minimum"
      ? "Adjusted to minimum (65%)"
      : "Adjusted to maximum (100%)";

  // Remove existing feedback
  const existingFeedback = parent.querySelector(".grade-feedback");
  if (existingFeedback) {
    existingFeedback.remove();
  }

  // Add feedback message
  const feedback = document.createElement("div");
  feedback.className =
    "grade-feedback text-xs text-orange-600 mt-1 font-medium";
  feedback.textContent = message;
  parent.appendChild(feedback);

  // Add visual highlight
  input.classList.add("border-orange-400", "bg-orange-50");

  // Remove after 3 seconds
  setTimeout(() => {
    if (feedback.parentElement) {
      feedback.remove();
    }
    input.classList.remove("border-orange-400", "bg-orange-50");
  }, 3000);
}

// Show Subject Grade Message
function showSubjectGradeMessage(message, type = "success") {
  clearSubjectGradeMessages();
  const messagesContainer = document.getElementById("subject-grade-messages");
  const messageDiv = document.createElement("div");

  if (type === "success") {
    messageDiv.className =
      "subject-grade-message bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-4";
  } else {
    messageDiv.className =
      "subject-grade-message bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4";
  }

  messageDiv.textContent = message;
  messagesContainer.appendChild(messageDiv);
}

// Clear Subject Grade Messages
function clearSubjectGradeMessages() {
  const messages = document.querySelectorAll(".subject-grade-message");
  messages.forEach((message) => message.remove());
}

// Clear All Grades
function clearAllGrades() {
  if (
    confirm(
      "Are you sure you want to clear all grades? This action cannot be undone."
    )
  ) {
    // Clear all input fields
    const inputs = document.querySelectorAll(
      '#subject-grade-form input[type="number"]'
    );
    inputs.forEach((input) => {
      input.value = "";
      input.classList.remove("border-lime");
    });

    updateSubjectGradeProgress();
    showSubjectGradeMessage("All grades cleared", "error");
  }
}

// Handle Subject Grade Form Submission
async function handleSubjectGradeFormSubmission(event) {
  event.preventDefault();

  const submitButton = document.getElementById("save-subject-grades-button");
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
    const formData = new FormData(event.target);
    const gradesData = {
      action: "save_subject_grades",
    };

    // Add all form data to the grades object
    for (let [key, value] of formData.entries()) {
      if (value.trim() !== "") {
        gradesData[key] = value;
      }
    }

    const response = await fetch("Config/Auth/subject_grade_handler.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(gradesData),
    });

    const data = await response.json();

    if (data.success) {
      showSubjectGradeMessage(data.message, "success");
      originalGrades = { ...gradesData };

      // Close modal after success
      setTimeout(() => {
        closeSubjectGradeModal();
      }, 1500);
    } else {
      showSubjectGradeMessage(data.message, "error");
    }
  } catch (error) {
    console.error("Subject grade save error:", error);
    showSubjectGradeMessage("An error occurred while saving grades", "error");
  } finally {
    // Re-enable button
    submitButton.disabled = false;
    submitButton.innerHTML = originalText;
  }
}

// Initialize Subject Grade Modal Event Listeners
document.addEventListener("DOMContentLoaded", function () {
  // Close modal button
  const closeButton = document.getElementById("close-subject-grade-modal");
  if (closeButton) {
    closeButton.addEventListener("click", closeSubjectGradeModal);
  }

  // Clear all button
  const clearAllButton = document.getElementById("clear-all-grades-button");
  if (clearAllButton) {
    clearAllButton.addEventListener("click", clearAllGrades);
  }

  // Form submission
  const form = document.getElementById("subject-grade-form");
  if (form) {
    form.addEventListener("submit", handleSubjectGradeFormSubmission);
  }

  // Grade input validation
  const gradeInputs = document.querySelectorAll(
    '#subject-grade-form input[type="number"]'
  );
  gradeInputs.forEach((input) => {
    input.addEventListener("input", function () {
      const value = parseFloat(this.value);
      if (!isNaN(value) && this.value.length >= 2) {
        validateGrade(this);
      }
      updateSubjectGradeProgress();
    });

    input.addEventListener("blur", function () {
      validateGrade(this);
      if (this.value.trim() !== "") {
        this.classList.add("border-lime");
      } else {
        this.classList.remove("border-lime");
      }
      updateSubjectGradeProgress();
    });
  });

  // Close modal when clicking outside
  const modal = document.getElementById("subject-grade-modal");
  if (modal) {
    modal.addEventListener("click", function (e) {
      if (e.target === modal) {
        closeSubjectGradeModal();
      }
    });
  }

  // ESC key to close modal
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && subjectGradeModalOpen) {
      closeSubjectGradeModal();
    }
  });
});
