// Profile Modal Functions
let profileModalOpen = false;
let passwordSectionVisible = false;
let originalEmail = ""; // Store original email for comparison

// Open Profile Modal
function openProfileModal() {
  const modal = document.getElementById("profile-modal");
  const modalContent = document.getElementById("profile-modal-content");

  // Populate form with current user data
  populateProfileForm();

  modal.classList.remove("hidden");
  document.body.style.overflow = "hidden";
  profileModalOpen = true;

  setTimeout(() => {
    modalContent.classList.remove("scale-95", "opacity-0");
    modalContent.classList.add("scale-100", "opacity-100");
  }, 10);
}

// Close Profile Modal
function closeProfileModal() {
  const modal = document.getElementById("profile-modal");
  const modalContent = document.getElementById("profile-modal-content");

  modalContent.classList.remove("scale-100", "opacity-100");
  modalContent.classList.add("scale-95", "opacity-0");

  setTimeout(() => {
    modal.classList.add("hidden");
    document.body.style.overflow = "";
    resetProfileForm();
    profileModalOpen = false;
  }, 300);
}

// Populate Profile Form with current user data
async function populateProfileForm() {
  try {
    const response = await fetch("Config/Auth/profile_handler.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ action: "get_user_data" }),
    });

    const data = await response.json();

    if (data.success) {
      document.getElementById("profile-fullName").value =
        data.user.fullName || "";
      document.getElementById("profile-email").value = data.user.email || "";
      originalEmail = data.user.email || ""; // Store original email
    } else {
      showProfileMessage("Failed to load user data", "error");
    }
  } catch (error) {
    console.error("Error loading user data:", error);
    showProfileMessage("Error loading profile data", "error");
  }
}

// Reset Profile Form
function resetProfileForm() {
  const form = document.getElementById("profile-form");
  form.reset();

  // Hide password section
  const passwordSection = document.getElementById("password-change-section");
  const toggleText = document.getElementById("password-toggle-text");
  passwordSection.classList.add("hidden");
  toggleText.textContent = "Change Password";
  passwordSectionVisible = false;

  // Clear messages
  clearProfileMessages();

  // Reset password visibility
  const passwordInputs = [
    "current-password",
    "new-password",
    "confirm-password",
  ];
  passwordInputs.forEach((id) => {
    const input = document.getElementById(id);
    const icon = document.getElementById(id + "-icon");
    if (input && icon) {
      input.type = "password";
      icon.classList.remove("fa-eye-slash");
      icon.classList.add("fa-eye");
    }
  });

  originalEmail = ""; // Reset original email
}

// Toggle Password Section
function togglePasswordSection() {
  const passwordSection = document.getElementById("password-change-section");
  const toggleText = document.getElementById("password-toggle-text");

  if (passwordSectionVisible) {
    passwordSection.classList.add("hidden");
    toggleText.textContent = "Change Password";
    passwordSectionVisible = false;

    // Clear password fields
    document.getElementById("current-password").value = "";
    document.getElementById("new-password").value = "";
    document.getElementById("confirm-password").value = "";
  } else {
    passwordSection.classList.remove("hidden");
    toggleText.textContent = "Cancel Password Change";
    passwordSectionVisible = true;
  }
}

// Toggle Password Visibility for specific field
function togglePasswordVisibility(fieldId) {
  const passwordInput = document.getElementById(fieldId);
  const toggleIcon = document.getElementById(fieldId + "-icon");

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

// Validate Email Format
function validateEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

// Show Profile Message
function showProfileMessage(message, type = "success") {
  clearProfileMessages();
  const messagesContainer = document.getElementById("profile-messages");
  const messageDiv = document.createElement("div");

  if (type === "success") {
    messageDiv.className =
      "profile-message bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-4";
  } else {
    messageDiv.className =
      "profile-message bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4";
  }

  messageDiv.textContent = message;
  messagesContainer.appendChild(messageDiv);
}

// Clear Profile Messages
function clearProfileMessages() {
  const messages = document.querySelectorAll(".profile-message");
  messages.forEach((message) => message.remove());
}

// Validate Password - Updated with relaxed requirements
function validatePassword(password) {
  // Only check minimum length requirement
  return password.length >= 8;
}

// Handle Profile Form Submission
async function handleProfileFormSubmission(event) {
  event.preventDefault();

  const submitButton = document.getElementById("save-profile-button");
  const originalText = submitButton.innerHTML;

  // Disable button and show loading
  submitButton.disabled = true;
  submitButton.innerHTML = `
        <div class="relative z-10 flex items-center gap-2">
            <i class="fas fa-spinner fa-spin"></i>
            Saving...
        </div>
    `;

  const formData = new FormData(event.target);
  const fullName = formData.get("fullName");
  const email = formData.get("email");
  const currentPassword = formData.get("currentPassword");
  const newPassword = formData.get("newPassword");
  const confirmPassword = formData.get("confirmPassword");

  try {
    // Validate inputs
    if (!fullName || fullName.trim() === "") {
      showProfileMessage("Please enter your full name", "error");
      return;
    }

    if (!email || email.trim() === "") {
      showProfileMessage("Please enter your email address", "error");
      return;
    }

    if (!validateEmail(email)) {
      showProfileMessage("Please enter a valid email address", "error");
      return;
    }

    // If password section is visible, validate password fields
    if (passwordSectionVisible) {
      if (!currentPassword) {
        showProfileMessage("Please enter your current password", "error");
        return;
      }

      if (!newPassword) {
        showProfileMessage("Please enter a new password", "error");
        return;
      }

      if (newPassword !== confirmPassword) {
        showProfileMessage("New passwords do not match", "error");
        return;
      }

      if (!validatePassword(newPassword)) {
        showProfileMessage(
          "New password must be at least 8 characters long",
          "error"
        );
        return;
      }
    }

    const requestData = {
      action: "update_profile",
      fullName: fullName.trim(),
      email: email.trim(),
    };

    // Add password data if changing password
    if (passwordSectionVisible && currentPassword && newPassword) {
      requestData.currentPassword = currentPassword;
      requestData.newPassword = newPassword;
    }

    const response = await fetch("Config/Auth/profile_handler.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(requestData),
    });

    const data = await response.json();

    if (data.success) {
      showProfileMessage(data.message, "success");

      // Update session data if name was changed
      if (data.updatedName) {
        // Update the navigation display
        updateNavigationUserName(data.updatedName);
      }

      // Update navigation email if email was changed
      if (data.updatedEmail) {
        updateNavigationUserEmail(data.updatedEmail);
      }

      // Close modal after success
      setTimeout(() => {
        closeProfileModal();
      }, 1500);
    } else {
      showProfileMessage(data.message, "error");
    }
  } catch (error) {
    console.error("Profile update error:", error);
    showProfileMessage(
      "An error occurred while updating your profile",
      "error"
    );
  } finally {
    // Re-enable button
    submitButton.disabled = false;
    submitButton.innerHTML = originalText;
  }
}

// Update Navigation User Name
function updateNavigationUserName(newName) {
  // Update desktop profile dropdown button
  const profileButtons = document.querySelectorAll(
    '[aria-label="Profile"] span'
  );
  profileButtons.forEach((button) => {
    const userNameSpan = button.querySelector("span");
    if (userNameSpan) {
      userNameSpan.textContent = newName.split(" ")[0];
    }
  });

  // Update dropdown menu display
  const profileNameDisplays = document.querySelectorAll(
    ".text-sm.font-medium.text-dark"
  );
  profileNameDisplays.forEach((display) => {
    if (display.textContent && display.textContent.includes("@") === false) {
      display.textContent = newName;
    }
  });
}

// Update Navigation User Email
function updateNavigationUserEmail(newEmail) {
  // Update dropdown menu email display
  const emailDisplays = document.querySelectorAll(".text-xs.text-gray-500");
  emailDisplays.forEach((display) => {
    if (display.textContent && display.textContent.includes("@")) {
      display.textContent = newEmail;
    }
  });
}

// Initialize Profile Modal Event Listeners
document.addEventListener("DOMContentLoaded", function () {
  // Close profile modal button
  const closeProfileButton = document.getElementById("close-profile-modal");
  if (closeProfileButton) {
    closeProfileButton.addEventListener("click", closeProfileModal);
  }

  // Toggle password section button
  const togglePasswordButton = document.getElementById(
    "toggle-password-section"
  );
  if (togglePasswordButton) {
    togglePasswordButton.addEventListener("click", togglePasswordSection);
  }

  // Profile form submission
  const profileForm = document.getElementById("profile-form");
  if (profileForm) {
    profileForm.addEventListener("submit", handleProfileFormSubmission);
  }

  // Close modal when clicking outside
  const profileModal = document.getElementById("profile-modal");
  if (profileModal) {
    profileModal.addEventListener("click", function (e) {
      if (e.target === profileModal) {
        closeProfileModal();
      }
    });
  }

  // ESC key to close profile modal
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && profileModalOpen) {
      closeProfileModal();
    }
  });
});
