// Profile dropdown functionality
class ProfileDropdown {
  constructor() {
    this.initializeDropdown();
  }

  initializeDropdown() {
    // Make toggle function globally available
    window.toggleProfileDropdown = this.toggleDropdown.bind(this);

    // Setup click outside to close
    this.setupOutsideClickHandler();
  }

  toggleDropdown() {
    const dropdown = document.getElementById("dropdown-menu");
    if (dropdown) {
      dropdown.classList.toggle("hidden");
    }
  }

  closeDropdown() {
    const dropdown = document.getElementById("dropdown-menu");
    if (dropdown) {
      dropdown.classList.add("hidden");
    }
  }

  setupOutsideClickHandler() {
    document.addEventListener("click", (e) => {
      const profileDropdown = document.getElementById("profile-dropdown");
      const dropdownMenu = document.getElementById("dropdown-menu");

      if (
        profileDropdown &&
        dropdownMenu &&
        !profileDropdown.contains(e.target)
      ) {
        dropdownMenu.classList.add("hidden");
      }
    });
  }
}

// Export for use in other modules
window.ProfileDropdown = ProfileDropdown;
