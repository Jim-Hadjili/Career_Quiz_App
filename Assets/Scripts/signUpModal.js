// Modal state management
let currentMode = "signup"; // 'signup' or 'signin'

// Sign Up Modal Functions
function openSignUpModal() {
  const modal = document.getElementById("signup-modal");
  const modalContent = document.getElementById("modal-content");

  modal.classList.remove("hidden");
  document.body.style.overflow = "hidden"; // Prevent background scrolling

  // Animate modal appearance
  setTimeout(() => {
    modalContent.classList.remove("scale-95", "opacity-0");
    modalContent.classList.add("scale-100", "opacity-100");
  }, 10);
}

function closeSignUpModal() {
  const modal = document.getElementById("signup-modal");
  const modalContent = document.getElementById("modal-content");

  // Animate modal disappearance
  modalContent.classList.remove("scale-100", "opacity-100");
  modalContent.classList.add("scale-95", "opacity-0");

  setTimeout(() => {
    modal.classList.add("hidden");
    document.body.style.overflow = ""; // Restore scrolling
    resetForm();
    // Reset to signup mode when closing
    if (currentMode === "signin") {
      switchToSignUp();
    }
  }, 300);
}

function resetForm() {
  const form = document.getElementById("signup-form");
  form.reset();

  // Reset password visibility
  const passwordInput = document.getElementById("password");
  const toggleButton = document.querySelector("#toggle-password i");
  if (passwordInput && toggleButton) {
    passwordInput.type = "password";
    toggleButton.classList.remove("fa-eye-slash");
    toggleButton.classList.add("fa-eye");
  }
}

// Mode switching functions
function switchToSignIn() {
  currentMode = "signin";

  // Update modal title and description
  const modalTitle = document.getElementById("modal-title");
  const modalDescription = document.getElementById("modal-description");
  const submitText = document.getElementById("submit-text");
  const switchText = document.getElementById("switch-text");
  const switchMode = document.getElementById("switch-mode");
  const fullnameField = document.getElementById("fullname-field");
  const forgotPasswordLink = document.getElementById("forgot-password-link");
  const passwordInput = document.getElementById("password");
  const fullNameInput = document.getElementById("fullName");

  if (modalTitle) modalTitle.textContent = "Welcome Back";
  if (modalDescription)
    modalDescription.textContent =
      "Sign in to access your saved quiz results and career recommendations.";

  // Hide signup-only fields
  if (fullnameField) fullnameField.style.display = "none";

  // Show signin-only elements
  if (forgotPasswordLink) forgotPasswordLink.classList.remove("hidden");

  // Update password placeholder
  if (passwordInput) passwordInput.placeholder = "Enter your password";

  // Update submit button text
  if (submitText) submitText.textContent = "Sign In";

  // Update switch text
  if (switchText) switchText.textContent = "Don't have an account?";
  if (switchMode) switchMode.textContent = "Sign up here";

  // Remove required attribute from signup-only fields
  if (fullNameInput) fullNameInput.removeAttribute("required");

  // Reset form
  resetForm();
}

function switchToSignUp() {
  currentMode = "signup";

  // Update modal title and description
  const modalTitle = document.getElementById("modal-title");
  const modalDescription = document.getElementById("modal-description");
  const submitText = document.getElementById("submit-text");
  const switchText = document.getElementById("switch-text");
  const switchMode = document.getElementById("switch-mode");
  const fullnameField = document.getElementById("fullname-field");
  const forgotPasswordLink = document.getElementById("forgot-password-link");
  const passwordInput = document.getElementById("password");
  const fullNameInput = document.getElementById("fullName");

  if (modalTitle) modalTitle.textContent = "Join CareerPath";
  if (modalDescription)
    modalDescription.textContent =
      "Create your account to save quiz results and track your career journey.";

  // Show signup-only fields
  if (fullnameField) fullnameField.style.display = "block";

  // Hide signin-only elements
  if (forgotPasswordLink) forgotPasswordLink.classList.add("hidden");

  // Update password placeholder
  if (passwordInput) passwordInput.placeholder = "Create a secure password";

  // Update submit button text
  if (submitText) submitText.textContent = "Create Account";

  // Update switch text
  if (switchText) switchText.textContent = "Already have an account?";
  if (switchMode) switchMode.textContent = "Sign in here";

  // Add required attribute back to signup fields
  if (fullNameInput) fullNameInput.setAttribute("required", "");

  // Reset form
  resetForm();
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
function handleFormSubmission(event) {
  event.preventDefault();

  const formData = new FormData(event.target);

  if (currentMode === "signup") {
    const data = {
      fullName: formData.get("fullName"),
      email: formData.get("email"),
      password: formData.get("password"),
    };

    // Basic validation for signup
    if (!data.fullName || !data.email || !data.password) {
      alert("Please fill in all required fields.");
      return;
    }

    // Password strength validation
    if (data.password.length < 8) {
      alert("Password must be at least 8 characters long.");
      return;
    }

    // Here you would typically send the data to your backend
    console.log("Sign up data:", data);

    // Simulate successful account creation
    alert("Account created successfully! You can now take the quiz.");
    closeSignUpModal();
  } else {
    // Sign in mode
    const data = {
      email: formData.get("email"),
      password: formData.get("password"),
    };

    // Basic validation for signin
    if (!data.email || !data.password) {
      alert("Please enter both email and password.");
      return;
    }

    // Here you would typically send the data to your backend for authentication
    console.log("Sign in data:", data);

    // Simulate successful sign in
    alert("Welcome back! You are now signed in.");
    closeSignUpModal();
  }
}

// Event listeners
document.addEventListener("DOMContentLoaded", function () {
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
      if (!modal.classList.contains("hidden")) {
        closeSignUpModal();
      }
    }
  });
});
