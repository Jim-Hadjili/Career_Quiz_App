// Logout modal functionality
class LogoutModal {
  constructor() {
    this.initializeModal();
  }

  initializeModal() {
    // Make functions globally available
    window.showLogoutModal = this.showModal.bind(this);
    window.closeLogoutModal = this.closeModal.bind(this);
    window.confirmLogout = this.confirmLogout.bind(this);

    // Setup event listeners immediately instead of waiting for DOMContentLoaded
    this.setupEventListeners();
  }

  showModal() {
    const modal = document.getElementById("logout-modal");
    const modalContent = document.getElementById("logout-modal-content");

    if (!modal || !modalContent) {
      console.error("Logout modal elements not found");
      return;
    }

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

  closeModal() {
    const modal = document.getElementById("logout-modal");
    const modalContent = document.getElementById("logout-modal-content");

    if (!modal || !modalContent) {
      console.error("Logout modal elements not found");
      return;
    }

    modalContent.classList.remove("scale-100", "opacity-100");
    modalContent.classList.add("scale-95", "opacity-0");

    setTimeout(() => {
      modal.classList.add("hidden");
      document.body.style.overflow = "";
    }, 300);
  }

  async confirmLogout() {
    const confirmButton = document.getElementById("confirm-logout");
    if (!confirmButton) {
      console.error("Confirm logout button not found");
      return;
    }

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
      const response = await fetch("../Config/Auth/auth_handler.php", {
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

        // Close modal and redirect after short delay
        setTimeout(() => {
          this.closeModal();
          window.location.href = "../index.php";
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

  setupEventListeners() {
    // Remove DOMContentLoaded wrapper since DOM is already loaded
    // Close logout modal button
    const closeLogoutButton = document.getElementById("close-logout-modal");
    if (closeLogoutButton) {
      closeLogoutButton.addEventListener("click", this.closeModal.bind(this));
    }

    // Cancel logout button
    const cancelLogoutButton = document.getElementById("cancel-logout");
    if (cancelLogoutButton) {
      cancelLogoutButton.addEventListener("click", this.closeModal.bind(this));
    }

    // Confirm logout button
    const confirmLogoutButton = document.getElementById("confirm-logout");
    if (confirmLogoutButton) {
      confirmLogoutButton.addEventListener(
        "click",
        this.confirmLogout.bind(this)
      );
    }

    // Close modal when clicking outside
    const logoutModal = document.getElementById("logout-modal");
    if (logoutModal) {
      logoutModal.addEventListener("click", (e) => {
        if (e.target === logoutModal) {
          this.closeModal();
        }
      });
    }

    // ESC key to close logout modal
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") {
        const modal = document.getElementById("logout-modal");
        if (modal && !modal.classList.contains("hidden")) {
          this.closeModal();
        }
      }
    });
  }
}

// Export for use in other modules
window.LogoutModal = LogoutModal;
