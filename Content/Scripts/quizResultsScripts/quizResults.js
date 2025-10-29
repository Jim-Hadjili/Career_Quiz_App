// Sample data to replace PHP variables
const sampleData = {
  mbtiType: "INTP - The Thinker",
  traits: [
    {
      name: "Introverted",
      opposite: "Extraverted",
      percentage: 75,
    },
    {
      name: "Intuitive",
      opposite: "Sensing",
      percentage: 68,
    },
    {
      name: "Thinking",
      opposite: "Feeling",
      percentage: 82,
    },
    {
      name: "Perceiving",
      opposite: "Judging",
      percentage: 71,
    },
  ],
  careerPaths: [
    {
      title: "Software Developer",
      description:
        "Design and develop software applications, systems, and solutions using programming languages and technologies. Work with cutting-edge frameworks and collaborate with cross-functional teams.",
      icon: "fa-code",
      salary: "$95,000",
      growth: "High",
      match: 92,
    },
    {
      title: "Data Scientist",
      description:
        "Analyze complex data sets to extract insights and patterns that drive business decisions and innovation. Use machine learning and statistical methods to solve real-world problems.",
      icon: "fa-chart-bar",
      salary: "$120,000",
      growth: "Very High",
      match: 89,
    },
    {
      title: "Research Scientist",
      description:
        "Conduct scientific research and experiments to advance knowledge in various fields of study. Publish findings and contribute to the scientific community.",
      icon: "fa-microscope",
      salary: "$85,000",
      growth: "Medium",
      match: 87,
    },
    {
      title: "Systems Analyst",
      description:
        "Analyze business requirements and design technology solutions to improve organizational efficiency. Bridge the gap between IT and business teams.",
      icon: "fa-network-wired",
      salary: "$88,000",
      growth: "High",
      match: 85,
    },
  ],
};

let currentCareerIndex = 0;
const totalCareers = sampleData.careerPaths.length;

// Mobile Menu Functions
function toggleMobileMenu() {
  const mobileMenu = document.getElementById("mobile-menu");
  const overlay = document.getElementById("mobile-overlay");
  const hamburgerIcon = document.getElementById("hamburger-icon");

  if (mobileMenu.classList.contains("open")) {
    closeMobileMenu();
  } else {
    mobileMenu.classList.add("open");
    overlay.classList.add("active");
    hamburgerIcon.classList.remove("fa-bars");
    hamburgerIcon.classList.add("fa-times");
  }
}

function closeMobileMenu() {
  const mobileMenu = document.getElementById("mobile-menu");
  const overlay = document.getElementById("mobile-overlay");
  const hamburgerIcon = document.getElementById("hamburger-icon");

  mobileMenu.classList.remove("open");
  overlay.classList.remove("active");
  hamburgerIcon.classList.remove("fa-times");
  hamburgerIcon.classList.add("fa-bars");
}

// Initialize the page with sample data
function initializePage() {
  // Set personality type in various locations
  const personalityType = sampleData.mbtiType.split(" - ")[0];
  document.getElementById("personality-type").textContent = personalityType;
  document.getElementById("personality-full").textContent = sampleData.mbtiType;
  document.getElementById("banner-personality-type").textContent =
    personalityType;
  document.getElementById("banner-personality-full").textContent =
    sampleData.mbtiType;
  document.getElementById("sidebar-personality-type").textContent =
    personalityType;
  document.getElementById("sidebar-personality-full").textContent =
    sampleData.mbtiType;
  document.getElementById("mobile-personality-type").textContent =
    personalityType;
  document.getElementById("mobile-personality-full").textContent =
    sampleData.mbtiType;

  // Populate traits
  const traitsContainer = document.getElementById("traits-container");
  traitsContainer.innerHTML = "";
  sampleData.traits.forEach((trait) => {
    const traitHtml = `
            <div class="mb-8">
              <div class="trait-bar">
                <div class="trait-label">${trait.opposite}</div>
                <div class="trait-progress">
                  <div class="trait-fill bg-lime" style="width: ${
                    100 - trait.percentage
                  }%"></div>
                </div>
                <div class="trait-opposite">${trait.name}</div>
              </div>
              <div class="trait-percentage">
                ${trait.percentage}% ${trait.name}
              </div>
            </div>
          `;
    traitsContainer.innerHTML += traitHtml;
  });

  // Populate career cards
  const careerCardsContainer = document.getElementById(
    "career-cards-container"
  );
  careerCardsContainer.innerHTML = "";
  sampleData.careerPaths.forEach((path, index) => {
    const cardHtml = `
            <div class="career-card ${
              index === 0 ? "active" : ""
            }" data-index="${index}">
              <div class="flex flex-col lg:flex-row items-start gap-8">
                <div class="w-20 h-20 bg-lime rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg">
                  <i class="fas ${path.icon} text-dark text-3xl"></i>
                </div>
                <div class="flex-1">
                  <h3 class="text-3xl font-bold text-gray-800 mb-4">${
                    path.title
                  }</h3>
                  <p class="text-gray-600 text-lg leading-relaxed mb-6">${
                    path.description
                  }</p>
                  
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 bg-white/50 rounded-2xl border border-gray-200">
                    <div class="text-center">
                      <p class="text-sm text-gray-600 mb-2 font-medium">Match Score</p>
                      <p class="font-bold text-lime text-2xl">${path.match}%</p>
                    </div>
                    <div class="text-center">
                      <p class="text-sm text-gray-600 mb-2 font-medium">Avg. Salary</p>
                      <p class="font-bold text-gray-800 text-2xl">${
                        path.salary
                      }</p>
                    </div>
                    <div class="text-center">
                      <p class="text-sm text-gray-600 mb-2 font-medium">Job Growth</p>
                      <p class="font-bold text-gray-800 text-2xl">${
                        path.growth
                      }</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          `;
    careerCardsContainer.innerHTML += cardHtml;
  });

  // Populate progress dots
  const progressDots = document.getElementById("progress-dots");
  progressDots.innerHTML = "";
  sampleData.careerPaths.forEach((_, index) => {
    const dotHtml = `
            <button
              onclick="goToCareer(${index})"
              class="w-4 h-4 rounded-full transition-all duration-300 ${
                index === 0 ? "bg-lime w-10" : "bg-gray-300 hover:bg-gray-400"
              } shadow-md"
              id="dot-${index}"
            ></button>
          `;
    progressDots.innerHTML += dotHtml;
  });

  // Initialize career display
  showCareer(0);
}

function showCareer(index) {
  // Hide all cards
  document.querySelectorAll(".career-card").forEach((card) => {
    card.classList.remove("active");
  });

  // Show selected card
  const selectedCard = document.querySelector(`[data-index="${index}"]`);
  if (selectedCard) {
    selectedCard.classList.add("active");
  }

  // Update progress dots
  document.querySelectorAll('[id^="dot-"]').forEach((dot, i) => {
    if (i === index) {
      dot.classList.remove("bg-gray-300", "hover:bg-gray-400", "w-4");
      dot.classList.add("bg-lime", "w-10");
    } else {
      dot.classList.remove("bg-lime", "w-10");
      dot.classList.add("bg-gray-300", "hover:bg-gray-400", "w-4");
    }
  });

  // Update button states
  const prevBtn = document.getElementById("prevBtn");
  const nextBtn = document.getElementById("nextBtn");

  prevBtn.disabled = index === 0;
  nextBtn.disabled = index === totalCareers - 1;

  if (index === 0) {
    prevBtn.classList.add("opacity-50", "cursor-not-allowed");
  } else {
    prevBtn.classList.remove("opacity-50", "cursor-not-allowed");
  }

  if (index === totalCareers - 1) {
    nextBtn.classList.add("opacity-50", "cursor-not-allowed");
  } else {
    nextBtn.classList.remove("opacity-50", "cursor-not-allowed");
  }

  currentCareerIndex = index;
}

function nextCareer() {
  if (currentCareerIndex < totalCareers - 1) {
    showCareer(currentCareerIndex + 1);
  }
}

function previousCareer() {
  if (currentCareerIndex > 0) {
    showCareer(currentCareerIndex - 1);
  }
}

function goToCareer(index) {
  showCareer(index);
}

// Close mobile menu on window resize
window.addEventListener("resize", function () {
  if (window.innerWidth >= 1024) {
    closeMobileMenu();
  }
});

// Initialize the page when DOM is loaded
document.addEventListener("DOMContentLoaded", initializePage);
