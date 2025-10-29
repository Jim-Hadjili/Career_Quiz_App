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
      whyGoodFit:
        "Your INTP personality thrives on logical problem-solving and independent work, making you naturally suited for coding challenges. Your strong analytical thinking (82%) and preference for working alone (75% introverted) align perfectly with software development. Your high grades in mathematics and computer science demonstrate the technical foundation needed for this field.",
    },
    {
      title: "Data Scientist",
      description:
        "Analyze complex data sets to extract insights and patterns that drive business decisions and innovation. Use machine learning and statistical methods to solve real-world problems.",
      icon: "fa-chart-bar",
      salary: "$120,000",
      growth: "Very High",
      match: 89,
      whyGoodFit:
        "As an INTP, you excel at pattern recognition and theoretical thinking, which are essential for data analysis. Your intuitive nature (68%) helps you see connections others miss, while your thinking preference (82%) ensures objective, data-driven conclusions. Your strong performance in statistics and mathematics provides the quantitative skills this role demands.",
    },
    {
      title: "Research Scientist",
      description:
        "Conduct scientific research and experiments to advance knowledge in various fields of study. Publish findings and contribute to the scientific community.",
      icon: "fa-microscope",
      salary: "$85,000",
      growth: "Medium",
      match: 87,
      whyGoodFit:
        "Your INTP personality is ideal for research, with your love of theoretical exploration and independent investigation. Your perceiving trait (71%) allows flexibility in research approaches, while your thinking preference ensures objective analysis. Your excellent grades in science subjects and natural curiosity about how things work make research a perfect career path.",
    },
    {
      title: "Systems Analyst",
      description:
        "Analyze business requirements and design technology solutions to improve organizational efficiency. Bridge the gap between IT and business teams.",
      icon: "fa-network-wired",
      salary: "$88,000",
      growth: "High",
      match: 85,
      whyGoodFit:
        "Your INTP strengths in logical analysis and system thinking make you excellent at understanding complex business processes. Your intuitive nature (68%) helps you envision innovative solutions, while your thinking preference (82%) ensures practical, efficient designs. Your balanced performance across technical and analytical subjects shows you can bridge different domains effectively.",
    },
  ],
};

let currentCareerIndex = 0;
let totalCareers = 0;
let resultsData = null;

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

// Initialize the page with actual data
function initializePage() {
  // Try to get data from sessionStorage first (for fresh submissions)
  const sessionData = sessionStorage.getItem("quizResults");
  if (sessionData) {
    try {
      resultsData = JSON.parse(sessionData);
      populatePageWithData(resultsData);
      return;
    } catch (e) {
      console.error("Error parsing session data:", e);
    }
  }

  // If no session data, check URL parameters
  const urlParams = new URLSearchParams(window.location.search);
  const resultId = urlParams.get("result_id");
  const isGuest = urlParams.get("guest");

  if (resultId || isGuest) {
    loadResultsFromServer(resultId, isGuest);
  } else {
    // Fallback to sample data
    loadSampleData();
  }
}

function loadResultsFromServer(resultId, isGuest) {
  // This would make an AJAX call to get results from the server
  // For now, we'll use sample data
  loadSampleData();
}

function loadSampleData() {
  // Use existing sample data as fallback
  resultsData = {
    mbtiType: "INTP - The Thinker",
    traits: [
      { name: "Introverted", opposite: "Extraverted", percentage: 75 },
      { name: "Intuitive", opposite: "Sensing", percentage: 68 },
      { name: "Thinking", opposite: "Feeling", percentage: 82 },
      { name: "Perceiving", opposite: "Judging", percentage: 71 },
    ],
    careerPaths: [
      {
        title: "Software Developer",
        description:
          "Design and develop software applications, systems, and solutions using programming languages and technologies.",
        icon: "fa-code",
        salary: "$95,000",
        growth: "High",
        match: 92,
        whyGoodFit:
          "Your INTP personality thrives on logical problem-solving and independent work, making you naturally suited for coding challenges.",
      },
    ],
  };

  populatePageWithData(resultsData);
}

function populatePageWithData(data) {
  if (!data || !data.careerRecommendations) {
    console.error("Invalid results data");
    return;
  }

  const recommendations = data.careerRecommendations;

  // Set personality type
  const mbtiType = data.coreSubjects?.mbti_type || "UNKNOWN";
  const mbtiDisplay = getMBTIDisplay(mbtiType);

  // Update all personality type elements
  const personalityElements = [
    "personality-type",
    "banner-personality-type",
    "sidebar-personality-type",
    "mobile-personality-type",
  ];

  personalityElements.forEach((id) => {
    const element = document.getElementById(id);
    if (element) element.textContent = mbtiType;
  });

  const personalityFullElements = [
    "personality-full",
    "banner-personality-full",
    "sidebar-personality-full",
    "mobile-personality-full",
  ];

  personalityFullElements.forEach((id) => {
    const element = document.getElementById(id);
    if (element) element.textContent = mbtiDisplay;
  });

  // Populate traits if available
  if (
    recommendations.personality_analysis &&
    recommendations.personality_analysis.key_traits
  ) {
    populateTraits(recommendations.personality_analysis.key_traits);
  }

  // Populate career cards
  if (recommendations.recommended_careers) {
    populateCareerCards(recommendations.recommended_careers);
    totalCareers = recommendations.recommended_careers.length;
  }

  // Initialize career display
  showCareer(0);
}

function getMBTIDisplay(mbtiType) {
  const mbtiDescriptions = {
    INTJ: "INTJ - The Architect",
    INTP: "INTP - The Thinker",
    ENTJ: "ENTJ - The Commander",
    ENTP: "ENTP - The Debater",
    INFJ: "INFJ - The Advocate",
    INFP: "INFP - The Mediator",
    ENFJ: "ENFJ - The Protagonist",
    ENFP: "ENFP - The Campaigner",
    ISTJ: "ISTJ - The Logistician",
    ISFJ: "ISFJ - The Protector",
    ESTJ: "ESTJ - The Executive",
    ESFJ: "ESFJ - The Consul",
    ISTP: "ISTP - The Virtuoso",
    ISFP: "ISFP - The Adventurer",
    ESTP: "ESTP - The Entrepreneur",
    ESFP: "ESFP - The Entertainer",
  };

  return mbtiDescriptions[mbtiType] || `${mbtiType} - Personality Type`;
}

function populateTraits(traits) {
  // This would populate the traits section based on personality analysis
  // For now, keeping the existing sample implementation
}

function populateCareerCards(careerPaths) {
  const careerCardsContainer = document.getElementById(
    "career-cards-container"
  );
  if (!careerCardsContainer) return;

  careerCardsContainer.innerHTML = "";

  careerPaths.forEach((path, index) => {
    const cardHtml = `
      <div class="career-card ${
        index === 0 ? "active" : ""
      }" data-index="${index}">
        <div class="flex flex-col lg:flex-row items-start gap-8">
          <div class="w-20 h-20 bg-lime rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg">
            <i class="fas fa-briefcase text-dark text-3xl"></i>
          </div>
          <div class="flex-1">
            <h3 class="text-3xl font-bold text-gray-800 mb-4">${path.title}</h3>
            <p class="text-gray-600 text-lg leading-relaxed mb-6">${
              path.description
            }</p>
            
            <div class="bg-white border border-lime/30 rounded-2xl p-6 mb-6">
              <h4 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                <i class="fas fa-lightbulb text-lime"></i>
                Why This is a Good Fit for You
              </h4>
              <p class="text-gray-700 leading-relaxed">${path.why_good_fit}</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 bg-white rounded-2xl border border-gray-200">
              <div class="text-center">
                <p class="text-sm text-gray-600 mb-2 font-medium">Match Score</p>
                <p class="font-bold text-lime text-2xl">${
                  path.match_percentage
                }%</p>
              </div>
              <div class="text-center">
                <p class="text-sm text-gray-600 mb-2 font-medium">Salary Range</p>
                <p class="font-bold text-gray-800 text-2xl">${
                  path.salary_range || "Varies"
                }</p>
              </div>
              <div class="text-center">
                <p class="text-sm text-gray-600 mb-2 font-medium">Job Growth</p>
                <p class="font-bold text-gray-800 text-2xl">${
                  path.growth_outlook || "Medium"
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
  if (progressDots) {
    progressDots.innerHTML = "";
    careerPaths.forEach((_, index) => {
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
  }
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

  if (prevBtn && nextBtn) {
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
