// Modal state management
let currentMode = "signup";
let currentUser = null;

// Check authentication status on page load
document.addEventListener("DOMContentLoaded", function () {
  checkAuthenticationStatus();
  initializeEventListeners();
});

// Check if user is authenticated
async function checkAuthenticationStatus() {
  try {
    const response = await fetch("Config/Auth/auth_handler.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ action: "check_auth" }),
    });

    const data = await response.json();

    if (data.success && data.authenticated) {
      currentUser = data.user;
      updateUIForAuthenticatedUser(data.user);
    }
  } catch (error) {
    console.error("Auth check failed:", error);
  }
}

// Update UI for authenticated user
function updateUIForAuthenticatedUser(user) {
  // This is handled by PHP in the navigation, but we can update any dynamic elements here
  currentUser = user;
}

// Sign Up Modal Functions
function openSignUpModal() {
  const modal = document.getElementById("signup-modal");
  const modalContent = document.getElementById("modal-content");

  modal.classList.remove("hidden");
  document.body.style.overflow = "hidden";

  setTimeout(() => {
    modalContent.classList.remove("scale-95", "opacity-0");
    modalContent.classList.add("scale-100", "opacity-100");
  }, 10);
}

function closeSignUpModal() {
  const modal = document.getElementById("signup-modal");
  const modalContent = document.getElementById("modal-content");

  modalContent.classList.remove("scale-100", "opacity-100");
  modalContent.classList.add("scale-95", "opacity-0");

  setTimeout(() => {
    modal.classList.add("hidden");
    document.body.style.overflow = "";
    resetForm();
    if (currentMode === "signin") {
      switchToSignUp();
    }
  }, 300);
}

function resetForm() {
  const form = document.getElementById("signup-form");
  form.reset();

  const passwordInput = document.getElementById("password");
  const toggleButton = document.querySelector("#toggle-password i");
  if (passwordInput && toggleButton) {
    passwordInput.type = "password";
    toggleButton.classList.remove("fa-eye-slash");
    toggleButton.classList.add("fa-eye");
  }

  // Clear any error messages
  clearErrorMessages();
}

// Clear error messages
function clearErrorMessages() {
  const errorElements = document.querySelectorAll(".error-message");
  errorElements.forEach((element) => element.remove());
}

// Show error message
function showErrorMessage(message) {
  clearErrorMessages();
  const form = document.getElementById("signup-form");
  const errorDiv = document.createElement("div");
  errorDiv.className =
    "error-message bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4";
  errorDiv.textContent = message;
  form.insertBefore(errorDiv, form.firstChild);
}

// Show success message
function showSuccessMessage(message) {
  clearErrorMessages();
  const form = document.getElementById("signup-form");
  const successDiv = document.createElement("div");
  successDiv.className =
    "success-message bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-4";
  successDiv.textContent = message;
  form.insertBefore(successDiv, form.firstChild);
}

// Mode switching functions
function switchToSignIn() {
  currentMode = "signin";
  updateModalContent();
  resetForm();
}

function switchToSignUp() {
  currentMode = "signup";
  updateModalContent();
  resetForm();
}

function updateModalContent() {
  const modalTitle = document.getElementById("modal-title");
  const modalDescription = document.getElementById("modal-description");
  const submitText = document.getElementById("submit-text");
  const switchText = document.getElementById("switch-text");
  const switchMode = document.getElementById("switch-mode");
  const fullnameField = document.getElementById("fullname-field");
  const passwordInput = document.getElementById("password");
  const fullNameInput = document.getElementById("fullName");

  if (currentMode === "signin") {
    if (modalTitle) modalTitle.textContent = "Welcome Back";
    if (modalDescription)
      modalDescription.textContent =
        "Sign in to access your saved quiz results and career recommendations.";
    if (fullnameField) fullnameField.style.display = "none";
    if (passwordInput) passwordInput.placeholder = "Enter your password";
    if (submitText) submitText.textContent = "Sign In";
    if (switchText) switchText.textContent = "Don't have an account?";
    if (switchMode) switchMode.textContent = "Sign up here";
    if (fullNameInput) fullNameInput.removeAttribute("required");
  } else {
    if (modalTitle) modalTitle.textContent = "Join CareerPath";
    if (modalDescription)
      modalDescription.textContent =
        "Create your account to save quiz results and track your career journey.";
    if (fullnameField) fullnameField.style.display = "block";
    if (passwordInput) passwordInput.placeholder = "Create a secure password";
    if (submitText) submitText.textContent = "Create Account";
    if (switchText) switchText.textContent = "Already have an account?";
    if (switchMode) switchMode.textContent = "Sign in here";
    if (fullNameInput) fullNameInput.setAttribute("required", "");
  }
}

// Password visibility toggle
function togglePasswordVisibility() {
  const passwordInput = document.getElementById("password");
  const toggleIcon = document.querySelector("#toggle-password i");

  if (passwordInput && toggleIcon) {
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      toggleIcon.classList.remove("fa-eye");
      toggleIcon.classList.add("fa-eye-slash");
    } else {
      passwordInput.type = "password";
      toggleIcon.classList.remove("fa-eye-slash");
      toggleIcon.classList.add("fa-eye");
    }
  }
}

// Form validation and submission
async function handleFormSubmission(event) {
  event.preventDefault();

  const submitButton = document.getElementById("submit-button");
  const originalText = submitButton.innerHTML;

  // Disable button and show loading
  submitButton.disabled = true;
  submitButton.innerHTML = `
    <div class="relative z-10 flex items-center gap-2">
      <i class="fas fa-spinner fa-spin"></i>
      Processing...
    </div>
  `;

  const formData = new FormData(event.target);

  try {
    const requestData = {
      action: currentMode === "signup" ? "signup" : "signin",
      email: formData.get("email"),
      password: formData.get("password"),
    };

    if (currentMode === "signup") {
      requestData.fullName = formData.get("fullName");
    }

    const response = await fetch("Config/Auth/auth_handler.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(requestData),
    });

    const data = await response.json();

    if (data.success) {
      showSuccessMessage(data.message);
      currentUser = data.user;

      // Close modal after short delay and reload page to update navigation
      setTimeout(() => {
        closeSignUpModal();
        window.location.reload(); // Reload to update PHP session state in navigation
      }, 1500);
    } else {
      showErrorMessage(data.message);
    }
  } catch (error) {
    console.error("Form submission error:", error);
    showErrorMessage("An error occurred. Please try again.");
  } finally {
    // Re-enable button
    submitButton.disabled = false;
    submitButton.innerHTML = originalText;
  }
}

// Profile dropdown functions
function toggleProfileDropdown() {
  const dropdown = document.getElementById("dropdown-menu");
  if (dropdown) {
    dropdown.classList.toggle("hidden");
  }
}

// Handle logout
async function handleLogout() {
  try {
    const response = await fetch("Config/Auth/auth_handler.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ action: "logout" }),
    });

    const data = await response.json();

    if (data.success) {
      currentUser = null;
      window.location.reload(); // Reload to update navigation
    }
  } catch (error) {
    console.error("Logout error:", error);
  }
}

// Initialize event listeners
function initializeEventListeners() {
  // Close modal button
  const closeButton = document.getElementById("close-modal");
  if (closeButton) {
    closeButton.addEventListener("click", closeSignUpModal);
  }

  // Close modal when clicking outside
  const modal = document.getElementById("signup-modal");
  if (modal) {
    modal.addEventListener("click", function (e) {
      if (e.target === modal) {
        closeSignUpModal();
      }
    });
  }

  // Password toggle
  const togglePasswordButton = document.getElementById("toggle-password");
  if (togglePasswordButton) {
    togglePasswordButton.addEventListener("click", togglePasswordVisibility);
  }

  // Form submission
  const form = document.getElementById("signup-form");
  if (form) {
    form.addEventListener("submit", handleFormSubmission);
  }

  // Mode switching
  const switchModeButton = document.getElementById("switch-mode");
  if (switchModeButton) {
    switchModeButton.addEventListener("click", function () {
      if (currentMode === "signup") {
        switchToSignIn();
      } else {
        switchToSignUp();
      }
    });
  }

  // ESC key to close modal
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      const modal = document.getElementById("signup-modal");
      if (modal && !modal.classList.contains("hidden")) {
        closeSignUpModal();
      }
    }
  });

  // Close dropdown when clicking outside
  document.addEventListener("click", function (e) {
    const dropdown = document.getElementById("profile-dropdown");
    const dropdownMenu = document.getElementById("dropdown-menu");

    if (dropdown && dropdownMenu && !dropdown.contains(e.target)) {
      dropdownMenu.classList.add("hidden");
    }
  });
}
