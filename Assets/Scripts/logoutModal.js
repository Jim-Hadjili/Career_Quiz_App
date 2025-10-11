// Logout Modal Functions
function showLogoutModal() {
  const modal = document.getElementById("logout-modal");
  const modalContent = document.getElementById("logout-modal-content");

  // Close profile dropdown if open
  const profileDropdown = document.getElementById("dropdown-menu");
  if (profileDropdown && !profileDropdown.classList.contains("hidden")) {
    profileDropdown.classList.add("hidden");
  }

  // Show modal
  modal.classList.remove("hidden");
  document.body.style.overflow = "hidden";

  setTimeout(() => {
    modalContent.classList.remove("scale-95", "opacity-0");
    modalContent.classList.add("scale-100", "opacity-100");
  }, 10);
}

function closeLogoutModal() {
  const modal = document.getElementById("logout-modal");
  const modalContent = document.getElementById("logout-modal-content");

  modalContent.classList.remove("scale-100", "opacity-100");
  modalContent.classList.add("scale-95", "opacity-0");

  setTimeout(() => {
    modal.classList.add("hidden");
    document.body.style.overflow = "";
  }, 300);
}

// Handle actual logout after confirmation
async function confirmLogout() {
  const confirmButton = document.getElementById("confirm-logout");
  const originalText = confirmButton.innerHTML;

  // Show loading state
  confirmButton.disabled = true;
  confirmButton.innerHTML = `
        <div class="relative z-10 flex items-center gap-2">
            <i class="fas fa-spinner fa-spin"></i>
            Logging out...
        </div>
    `;

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
      // Show success message briefly
      confirmButton.innerHTML = `
                <div class="relative z-10 flex items-center gap-2">
                    <i class="fas fa-check"></i>
                    Logged out!
                </div>
            `;

      // Close modal and reload page after short delay
      setTimeout(() => {
        closeLogoutModal();
        window.location.reload();
      }, 1000);
    } else {
      throw new Error(data.message || "Logout failed");
    }
  } catch (error) {
    console.error("Logout error:", error);

    // Show error state
    confirmButton.innerHTML = `
            <div class="relative z-10 flex items-center gap-2">
                <i class="fas fa-exclamation-triangle"></i>
                Error occurred
            </div>
        `;

    // Reset button after delay
    setTimeout(() => {
      confirmButton.disabled = false;
      confirmButton.innerHTML = originalText;
    }, 2000);
  }
}

// Initialize logout modal event listeners
document.addEventListener("DOMContentLoaded", function () {
  // Close logout modal button
  const closeLogoutButton = document.getElementById("close-logout-modal");
  if (closeLogoutButton) {
    closeLogoutButton.addEventListener("click", closeLogoutModal);
  }

  // Cancel logout button
  const cancelLogoutButton = document.getElementById("cancel-logout");
  if (cancelLogoutButton) {
    cancelLogoutButton.addEventListener("click", closeLogoutModal);
  }

  // Confirm logout button
  const confirmLogoutButton = document.getElementById("confirm-logout");
  if (confirmLogoutButton) {
    confirmLogoutButton.addEventListener("click", confirmLogout);
  }

  // Close modal when clicking outside
  const logoutModal = document.getElementById("logout-modal");
  if (logoutModal) {
    logoutModal.addEventListener("click", function (e) {
      if (e.target === logoutModal) {
        closeLogoutModal();
      }
    });
  }

  // ESC key to close logout modal
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      const modal = document.getElementById("logout-modal");
      if (modal && !modal.classList.contains("hidden")) {
        closeLogoutModal();
      }
    }
  });
});
