export class MobileMenuHandler {
  static init() {
    this.setupEventListeners();
  }

  static setupEventListeners() {
    // Mobile menu toggle button
    const mobileMenuBtn = document.getElementById("mobile-menu-btn");
    if (mobileMenuBtn) {
      mobileMenuBtn.addEventListener("click", () => this.toggleMobileMenu());
    }

    // Mobile overlay click to close
    const overlay = document.getElementById("mobile-overlay");
    if (overlay) {
      overlay.addEventListener("click", () => this.closeMobileMenu());
    }

    // Close mobile menu on window resize
    window.addEventListener("resize", () => {
      if (window.innerWidth >= 1024) {
        this.closeMobileMenu();
      }
    });

    // Escape key to close menu
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") {
        this.closeMobileMenu();
      }
    });
  }

  static toggleMobileMenu() {
    const mobileMenu = document.getElementById("mobile-menu");
    const overlay = document.getElementById("mobile-overlay");
    const hamburgerIcon = document.getElementById("hamburger-icon");

    if (!mobileMenu || !overlay || !hamburgerIcon) {
      console.error("[MobileMenuHandler] Required elements not found");
      return;
    }

    if (mobileMenu.classList.contains("open")) {
      this.closeMobileMenu();
    } else {
      this.openMobileMenu();
    }
  }

  static openMobileMenu() {
    const mobileMenu = document.getElementById("mobile-menu");
    const overlay = document.getElementById("mobile-overlay");
    const hamburgerIcon = document.getElementById("hamburger-icon");

    mobileMenu.classList.add("open");
    overlay.classList.add("active");
    hamburgerIcon.classList.remove("fa-bars");
    hamburgerIcon.classList.add("fa-times");

    // Prevent body scroll
    document.body.style.overflow = "hidden";
  }

  static closeMobileMenu() {
    const mobileMenu = document.getElementById("mobile-menu");
    const overlay = document.getElementById("mobile-overlay");
    const hamburgerIcon = document.getElementById("hamburger-icon");

    if (mobileMenu) mobileMenu.classList.remove("open");
    if (overlay) overlay.classList.remove("active");
    if (hamburgerIcon) {
      hamburgerIcon.classList.remove("fa-times");
      hamburgerIcon.classList.add("fa-bars");
    }

    // Restore body scroll
    document.body.style.overflow = "";
  }
}
