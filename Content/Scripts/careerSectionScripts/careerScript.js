document.addEventListener("DOMContentLoaded", function () {
  const carousel = document.getElementById("careerCarousel");
  const track = document.getElementById("careerTrack");
  const cards = document.querySelectorAll(".carousel-card");
  const prevBtn = document.getElementById("prevBtn");
  const nextBtn = document.getElementById("nextBtn");
  const indicatorsContainer = document.getElementById("carouselIndicators");

  let currentIndex = 0;
  let isDragging = false;
  let startPos = 0;
  let currentTranslate = 0;
  let prevTranslate = 0;
  let animationID = 0;

  let isScrolling = false;
  let scrollTimeout;
  let accumulatedDelta = 0;

  // Calculate cards per view based on screen size
  function getCardsPerView() {
    if (window.innerWidth >= 1024) return 3;
    if (window.innerWidth >= 768) return 2;
    return 1;
  }

  // Calculate total pages
  function getTotalPages() {
    return Math.ceil(cards.length / getCardsPerView());
  }

  function updateButtonVisibility() {
    const cardsPerView = getCardsPerView();
    const maxIndex = cards.length - cardsPerView;

    // Hide prev button if at the start
    if (currentIndex === 0) {
      prevBtn.classList.add("hidden");
    } else {
      prevBtn.classList.remove("hidden");
    }

    // Hide next button if at the end
    if (currentIndex >= maxIndex) {
      nextBtn.classList.add("hidden");
    } else {
      nextBtn.classList.remove("hidden");
    }
  }

  // Create indicators
  function createIndicators() {
    indicatorsContainer.innerHTML = "";
    const totalPages = getTotalPages();
    for (let i = 0; i < totalPages; i++) {
      const indicator = document.createElement("div");
      indicator.classList.add("indicator");
      if (i === 0) indicator.classList.add("active");
      indicator.addEventListener("click", () => goToSlide(i));
      indicatorsContainer.appendChild(indicator);
    }
  }

  // Update indicators
  function updateIndicators() {
    const indicators = document.querySelectorAll(".indicator");
    const currentPage = Math.floor(currentIndex / getCardsPerView());
    indicators.forEach((indicator, index) => {
      indicator.classList.toggle("active", index === currentPage);
    });
  }

  // Go to specific slide
  function goToSlide(index) {
    const cardsPerView = getCardsPerView();
    const maxIndex = cards.length - cardsPerView;
    currentIndex = Math.max(0, Math.min(index * cardsPerView, maxIndex));
    updateCarousel();
  }

  function updateCarousel() {
    // Update button visibility first
    updateButtonVisibility();

    // Use requestAnimationFrame to ensure DOM has settled after button visibility changes
    requestAnimationFrame(() => {
      // Get fresh measurements after layout changes
      const cardWidth = cards[0].offsetWidth;
      const gap = 16; // gap-4 = 1rem = 16px
      const offset = -(currentIndex * (cardWidth + gap));

      track.style.transform = `translateX(${offset}px)`;
      updateIndicators();
    });
  }

  prevBtn.addEventListener("click", () => {
    const cardsPerView = getCardsPerView();
    currentIndex = Math.max(0, currentIndex - cardsPerView);
    // Reset drag state
    currentTranslate = 0;
    prevTranslate = 0;
    updateCarousel();
  });

  nextBtn.addEventListener("click", () => {
    const cardsPerView = getCardsPerView();
    const maxIndex = cards.length - cardsPerView;
    currentIndex = Math.min(maxIndex, currentIndex + cardsPerView);
    // Reset drag state
    currentTranslate = 0;
    prevTranslate = 0;
    updateCarousel();
  });

  function handleWheel(event) {
    // Only enable on desktop/tablet (768px and above)
    if (window.innerWidth < 768) return;

    // Detect horizontal scroll (touchpad gesture)
    const deltaX = event.deltaX;
    const deltaY = event.deltaY;

    // Check if it's a horizontal scroll or if user is scrolling horizontally with shift key
    if (Math.abs(deltaX) > Math.abs(deltaY) || event.shiftKey) {
      event.preventDefault();

      // Accumulate scroll delta
      accumulatedDelta += deltaX !== 0 ? deltaX : deltaY;

      // Clear existing timeout
      clearTimeout(scrollTimeout);

      // Set scrolling flag
      isScrolling = true;

      // Threshold for triggering navigation (adjust for sensitivity)
      const threshold = 100;

      if (Math.abs(accumulatedDelta) >= threshold) {
        const cardsPerView = getCardsPerView();
        const maxIndex = cards.length - cardsPerView;

        if (accumulatedDelta > 0 && currentIndex < maxIndex) {
          // Scroll right - next card
          currentIndex = Math.min(maxIndex, currentIndex + 1);
          updateCarousel();
        } else if (accumulatedDelta < 0 && currentIndex > 0) {
          // Scroll left - previous card
          currentIndex = Math.max(0, currentIndex - 1);
          updateCarousel();
        }

        // Reset accumulated delta after navigation
        accumulatedDelta = 0;
      }

      // Reset scrolling flag after a delay
      scrollTimeout = setTimeout(() => {
        isScrolling = false;
        accumulatedDelta = 0;
      }, 150);
    }
  }

  // Add wheel event listener for touchpad scrolling
  carousel.addEventListener("wheel", handleWheel, { passive: false });

  // Desktop drag functionality
  function touchStart(index) {
    return function (event) {
      if (window.innerWidth < 768) return; // Disable drag on mobile

      isDragging = true;
      startPos = getPositionX(event);
      animationID = requestAnimationFrame(animation);
      carousel.classList.add("dragging");
    };
  }

  function touchMove(event) {
    if (isDragging && window.innerWidth >= 768) {
      const currentPosition = getPositionX(event);
      currentTranslate = prevTranslate + currentPosition - startPos;
    }
  }

  function touchEnd() {
    if (!isDragging || window.innerWidth < 768) return;

    isDragging = false;
    cancelAnimationFrame(animationID);
    carousel.classList.remove("dragging");

    const movedBy = currentTranslate - prevTranslate;
    const cardWidth = cards[0].offsetWidth;
    const threshold = cardWidth / 4;

    if (
      movedBy < -threshold &&
      currentIndex < cards.length - getCardsPerView()
    ) {
      currentIndex += 1;
    }

    if (movedBy > threshold && currentIndex > 0) {
      currentIndex -= 1;
    }

    currentTranslate = 0;
    prevTranslate = 0;
    updateCarousel();
  }

  function getPositionX(event) {
    return event.type.includes("mouse")
      ? event.pageX
      : event.touches[0].clientX;
  }

  function animation() {
    if (isDragging) {
      const cardWidth = cards[0].offsetWidth;
      const gap = 16;
      const baseOffset = -(currentIndex * (cardWidth + gap));
      track.style.transform = `translateX(${baseOffset + currentTranslate}px)`;
      requestAnimationFrame(animation);
    }
  }

  // Add event listeners for drag
  carousel.addEventListener("mousedown", touchStart(0));
  carousel.addEventListener("touchstart", touchStart(0));
  carousel.addEventListener("mousemove", touchMove);
  carousel.addEventListener("touchmove", touchMove);
  carousel.addEventListener("mouseup", touchEnd);
  carousel.addEventListener("mouseleave", touchEnd);
  carousel.addEventListener("touchend", touchEnd);

  // Prevent context menu on long press
  carousel.addEventListener("contextmenu", (e) => {
    if (isDragging) e.preventDefault();
  });

  // Handle window resize
  let resizeTimer;
  window.addEventListener("resize", () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
      currentIndex = 0;
      createIndicators();
      updateCarousel();
    }, 250);
  });

  // Initialize
  createIndicators();
  updateCarousel();
});
