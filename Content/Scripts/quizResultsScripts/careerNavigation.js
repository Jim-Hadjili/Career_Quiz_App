export class CareerNavigation {
  constructor() {
    this.currentCareerIndex = 0;
    this.totalCareers = 0;
  }

  init(totalCareers) {
    this.totalCareers = totalCareers;
    this.setupEventListeners();
    this.showCareer(0);
    console.log(`[CareerNavigation] Initialized with ${totalCareers} careers`);
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
    if (index < 0 || index >= this.totalCareers) {
      console.warn(`[CareerNavigation] Invalid career index: ${index}`);
      return;
    }

    // Hide all cards
    document.querySelectorAll(".career-card").forEach((card) => {
      card.classList.remove("active");
      card.style.display = "none";
    });

    // Show selected card
    const selectedCard = document.querySelector(`[data-index="${index}"]`);
    if (selectedCard) {
      selectedCard.classList.add("active");
      selectedCard.style.display = "block";
    } else {
      console.error(
        `[CareerNavigation] Career card with index ${index} not found`
      );
    }

    this.updateProgressDots(index);
    this.updateNavigationButtons(index);
    this.currentCareerIndex = index;
  }

  updateProgressDots(activeIndex) {
    document.querySelectorAll("#progress-dots button").forEach((dot, index) => {
      if (index === activeIndex) {
        dot.classList.remove("bg-gray-300", "hover:bg-gray-400");
        dot.classList.add("bg-lime", "w-10");
      } else {
        dot.classList.remove("bg-lime", "w-10");
        dot.classList.add("bg-gray-300", "hover:bg-gray-400");
      }
    });
  }

  updateNavigationButtons(index) {
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    if (prevBtn) {
      prevBtn.disabled = index === 0;
      prevBtn.classList.toggle("opacity-50", index === 0);
      prevBtn.classList.toggle("cursor-not-allowed", index === 0);
    }

    if (nextBtn) {
      nextBtn.disabled = index === this.totalCareers - 1;
      nextBtn.classList.toggle("opacity-50", index === this.totalCareers - 1);
      nextBtn.classList.toggle(
        "cursor-not-allowed",
        index === this.totalCareers - 1
      );
    }
  }

  nextCareer() {
    console.log(
      `[CareerNavigation] Next career requested. Current: ${this.currentCareerIndex}, Total: ${this.totalCareers}`
    );
    if (this.currentCareerIndex < this.totalCareers - 1) {
      this.showCareer(this.currentCareerIndex + 1);
    }
  }

  previousCareer() {
    console.log(
      `[CareerNavigation] Previous career requested. Current: ${this.currentCareerIndex}`
    );
    if (this.currentCareerIndex > 0) {
      this.showCareer(this.currentCareerIndex - 1);
    }
  }

  goToCareer(index) {
    console.log(`[CareerNavigation] Go to career ${index} requested`);
    if (index >= 0 && index < this.totalCareers) {
      this.showCareer(index);
    }
  }
}
