// Quiz Results Modal Functions
let quizResultsModalOpen = false;
let currentPage = 1;
const resultsPerPage = 5;
let totalResults = 0;
let allResults = [];

// Open Quiz Results Modal
function openQuizResultsModal() {
  const modal = document.getElementById("quiz-results-modal");
  const modalContent = document.getElementById("quiz-results-modal-content");

  // Load quiz results
  loadQuizResults();

  modal.classList.remove("hidden");
  document.body.style.overflow = "hidden";
  quizResultsModalOpen = true;

  setTimeout(() => {
    modalContent.classList.remove("scale-95", "opacity-0");
    modalContent.classList.add("scale-100", "opacity-100");
  }, 10);
}

// Close Quiz Results Modal
function closeQuizResultsModal() {
  const modal = document.getElementById("quiz-results-modal");
  const modalContent = document.getElementById("quiz-results-modal-content");

  modalContent.classList.remove("scale-100", "opacity-100");
  modalContent.classList.add("scale-95", "opacity-0");

  setTimeout(() => {
    modal.classList.add("hidden");
    document.body.style.overflow = "";
    resetQuizResultsModal();
    quizResultsModalOpen = false;
  }, 300);
}

// Load Quiz Results from Database
async function loadQuizResults() {
  try {
    showLoadingState();

    const response = await fetch("Config/Auth/quiz_results_handler.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        action: "get_quiz_results",
        page: currentPage,
        per_page: resultsPerPage,
      }),
    });

    const data = await response.json();

    if (data.success) {
      if (data.results && data.results.length > 0) {
        allResults = data.results;
        totalResults = data.total_count;
        displayQuizResults(data.results);
        updatePagination(data.total_count, data.current_page, data.total_pages);
      } else {
        showEmptyState();
      }
    } else {
      if (data.message === "No quiz results found") {
        showEmptyState();
      } else {
        showQuizResultsMessage(data.message, "error");
        showEmptyState();
      }
    }
  } catch (error) {
    console.error("Error loading quiz results:", error);
    showQuizResultsMessage("Error loading quiz results", "error");
    showEmptyState();
  }
}

// Show Loading State
function showLoadingState() {
  document.getElementById("quiz-results-loading").classList.remove("hidden");
  document.getElementById("quiz-results-empty").classList.add("hidden");
  document.getElementById("quiz-results-container").classList.add("hidden");
}

// Show Empty State
function showEmptyState() {
  document.getElementById("quiz-results-loading").classList.add("hidden");
  document.getElementById("quiz-results-empty").classList.remove("hidden");
  document.getElementById("quiz-results-container").classList.add("hidden");
}

// Display Quiz Results
function displayQuizResults(results) {
  document.getElementById("quiz-results-loading").classList.add("hidden");
  document.getElementById("quiz-results-empty").classList.add("hidden");
  document.getElementById("quiz-results-container").classList.remove("hidden");

  // Update total count
  document.getElementById("total-results-count").textContent = totalResults;

  const resultsList = document.getElementById("results-list");
  resultsList.innerHTML = "";

  results.forEach((result, index) => {
    const resultCard = createResultCard(result, index);
    resultsList.appendChild(resultCard);
  });

  console.log(`[QuizResultsModal] Displayed ${results.length} results`);
}

// Create Result Card Element
function createResultCard(result, index) {
  const card = document.createElement("div");
  card.className =
    "result-card bg-white border-2 border-gray-200 rounded-xl p-6 hover:border-lime/50 transition-all duration-200";

  const quizData = JSON.parse(result.quiz_data);
  const careerData = JSON.parse(result.recommended_careers);
  const completionDate = new Date(result.completion_date);
  const mbtiType = quizData.coreSubjects?.mbti_type || "Not Available";
  const topCareers = careerData.recommended_careers?.slice(0, 3) || [];

  card.innerHTML = `
        <div class="flex flex-col lg:flex-row lg:items-center gap-4">
            <!-- Result Info -->
            <div class="flex-1">
                <div class="flex items-center gap-4 mb-3">
                    <div class="w-12 h-12 bg-lime rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-chart-pie text-dark text-lg"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-dark">Assessment #${
                          totalResults -
                          (currentPage - 1) * resultsPerPage -
                          index
                        }</h4>
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            ${completionDate.toLocaleDateString("en-US", {
                              year: "numeric",
                              month: "long",
                              day: "numeric",
                            })} at ${completionDate.toLocaleTimeString(
    "en-US",
    {
      hour: "2-digit",
      minute: "2-digit",
    }
  )}
                        </p>
                    </div>
                </div>

                <!-- Top Career Recommendations -->
                <div class="">
                    <p class="text-sm text-gray-600 font-medium mb-2">Top Career Recommendations:</p>
                    <div class="flex flex-wrap gap-1">
                        ${topCareers
                          .map(
                            (career) => `
                            <span class="career-tag">${career.title}</span>
                        `
                          )
                          .join("")}
                        ${
                          topCareers.length === 0
                            ? '<span class="text-sm text-gray-400 italic">No specific careers recorded</span>'
                            : ""
                        }
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-col gap-2 lg:w-48">
                <button 
                    onclick="viewFullResults('${result.result_id}', ${
    result.is_guest
  })"
                    class="w-full px-4 py-2 bg-dark text-lime font-medium rounded-lg hover:bg-gray-700 transition-colors duration-200"
                >
                    <i class="fas fa-eye mr-2"></i>View Details
                </button>
            </div>
        </div>
    `;

  return card;
}

// Update Pagination
function updatePagination(totalCount, currentPageNum, totalPages) {
  const paginationContainer = document.getElementById("results-pagination");

  if (totalPages <= 1) {
    paginationContainer.classList.add("hidden");
    return;
  }

  paginationContainer.classList.remove("hidden");
  paginationContainer.innerHTML = "";

  // Previous button
  const prevBtn = document.createElement("button");
  prevBtn.className = "pagination-btn";
  prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
  prevBtn.disabled = currentPageNum === 1;
  prevBtn.onclick = () => changePage(currentPageNum - 1);
  paginationContainer.appendChild(prevBtn);

  // Page numbers
  const startPage = Math.max(1, currentPageNum - 2);
  const endPage = Math.min(totalPages, startPage + 4);

  for (let i = startPage; i <= endPage; i++) {
    const pageBtn = document.createElement("button");
    pageBtn.className = `pagination-btn ${
      i === currentPageNum ? "active" : ""
    }`;
    pageBtn.textContent = i;
    pageBtn.onclick = () => changePage(i);
    paginationContainer.appendChild(pageBtn);
  }

  // Next button
  const nextBtn = document.createElement("button");
  nextBtn.className = "pagination-btn";
  nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
  nextBtn.disabled = currentPageNum === totalPages;
  nextBtn.onclick = () => changePage(currentPageNum + 1);
  paginationContainer.appendChild(nextBtn);

  // Results info
  const resultsInfo = document.createElement("div");
  resultsInfo.className = "text-sm text-gray-600 ml-4";
  const startResult = (currentPageNum - 1) * resultsPerPage + 1;
  const endResult = Math.min(currentPageNum * resultsPerPage, totalCount);
  resultsInfo.textContent = `Showing ${startResult}-${endResult} of ${totalCount} results`;
  paginationContainer.appendChild(resultsInfo);
}

// Change Page
async function changePage(page) {
  if (page < 1) return;

  currentPage = page;
  await loadQuizResults();
}

// View Full Results
function viewFullResults(resultId, isGuest) {
  const url = `Content/Pages/quizResults.php?result_id=${resultId}${
    isGuest ? "&guest=1" : ""
  }`;
  window.location.href = url;
}

// Delete Result
async function deleteResult(resultId) {
  if (
    !confirm(
      "Are you sure you want to delete this quiz result? This action cannot be undone."
    )
  ) {
    return;
  }

  try {
    const response = await fetch("Config/Auth/quiz_results_handler.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        action: "delete_quiz_result",
        result_id: resultId,
      }),
    });

    const data = await response.json();

    if (data.success) {
      showQuizResultsMessage(data.message, "success");
      // Reload results after deletion
      setTimeout(() => {
        loadQuizResults();
      }, 1000);
    } else {
      showQuizResultsMessage(data.message, "error");
    }
  } catch (error) {
    console.error("Error deleting result:", error);
    showQuizResultsMessage("Error deleting result", "error");
  }
}

// Reset Quiz Results Modal
function resetQuizResultsModal() {
  currentPage = 1;
  totalResults = 0;
  allResults = [];
  clearQuizResultsMessages();

  // Reset to loading state
  showLoadingState();
}

// Show Quiz Results Message
function showQuizResultsMessage(message, type = "success") {
  clearQuizResultsMessages();
  const messagesContainer = document.getElementById("quiz-results-messages");
  const messageDiv = document.createElement("div");

  if (type === "success") {
    messageDiv.className =
      "quiz-results-message bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-4";
  } else {
    messageDiv.className =
      "quiz-results-message bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4";
  }

  messageDiv.textContent = message;
  messagesContainer.appendChild(messageDiv);

  // Auto-hide success messages
  if (type === "success") {
    setTimeout(() => {
      if (messageDiv.parentElement) {
        messageDiv.remove();
      }
    }, 3000);
  }
}

// Clear Quiz Results Messages
function clearQuizResultsMessages() {
  const messages = document.querySelectorAll(".quiz-results-message");
  messages.forEach((message) => message.remove());
}

// Initialize Quiz Results Modal Event Listeners
document.addEventListener("DOMContentLoaded", function () {
  // Close modal button
  const closeButton = document.getElementById("close-quiz-results-modal");
  if (closeButton) {
    closeButton.addEventListener("click", closeQuizResultsModal);
  }

  // Close modal when clicking outside
  const modal = document.getElementById("quiz-results-modal");
  if (modal) {
    modal.addEventListener("click", function (e) {
      if (e.target === modal) {
        closeQuizResultsModal();
      }
    });
  }

  // ESC key to close modal
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && quizResultsModalOpen) {
      closeQuizResultsModal();
    }
  });
});
