export class CareerNavigation {
  constructor() {
    this.currentCareerIndex = 0;
    this.totalCareers = 0;
  }

  init(totalCareers) {
    this.totalCareers = totalCareers;
    this.setupEventListeners();
    this.showCareer(0);
  }

  setupEventListeners() {
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    if (prevBtn) {
      prevBtn.addEventListener("click", () => this.previousCareer());
    }

    if (nextBtn) {
      nextBtn.addEventListener("click", () => this.nextCareer());
    }

    // Add keyboard navigation
    document.addEventListener("keydown", (e) => {
      if (e.key === "ArrowLeft") {
        this.previousCareer();
      } else if (e.key === "ArrowRight") {
        this.nextCareer();
      }
    });
  }

  showCareer(index) {
    if (index < 0 || index >= this.totalCareers) return;

    // Hide all cards
    document.querySelectorAll(".career-card").forEach((card) => {
      card.classList.remove("active");
    });

    // Show selected card
    const selectedCard = document.querySelector(`[data-index="${index}"]`);
    if (selectedCard) {
      selectedCard.classList.add("active");
    }

    this.updateProgressDots(index);
    this.updateNavigationButtons(index);
    this.currentCareerIndex = index;

    console.log(
      `[CareerNavigation] Showing career ${index + 1} of ${this.totalCareers}`
    );
  }

  updateProgressDots(activeIndex) {
    document.querySelectorAll('[id^="dot-"]').forEach((dot, i) => {
      if (i === activeIndex) {
        dot.classList.remove("bg-gray-300", "hover:bg-gray-400", "w-4");
        dot.classList.add("bg-lime", "w-10");
      } else {
        dot.classList.remove("bg-lime", "w-10");
        dot.classList.add("bg-gray-300", "hover:bg-gray-400", "w-4");
      }
    });
  }

  updateNavigationButtons(index) {
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    if (prevBtn && nextBtn) {
      prevBtn.disabled = index === 0;
      nextBtn.disabled = index === this.totalCareers - 1;

      if (index === 0) {
        prevBtn.classList.add("opacity-50", "cursor-not-allowed");
      } else {
        prevBtn.classList.remove("opacity-50", "cursor-not-allowed");
      }

      if (index === this.totalCareers - 1) {
        nextBtn.classList.add("opacity-50", "cursor-not-allowed");
      } else {
        nextBtn.classList.remove("opacity-50", "cursor-not-allowed");
      }
    }
  }

  nextCareer() {
    if (this.currentCareerIndex < this.totalCareers - 1) {
      this.showCareer(this.currentCareerIndex + 1);
    }
  }

  previousCareer() {
    if (this.currentCareerIndex > 0) {
      this.showCareer(this.currentCareerIndex - 1);
    }
  }

  goToCareer(index) {
    this.showCareer(index);
  }
}
