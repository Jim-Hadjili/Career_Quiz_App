// Quiz Access Modal Functions
function showQuizAccessModal() {
  const modal = document.getElementById("quiz-access-modal");
  const modalContent = document.getElementById("quiz-access-modal-content");

  modal.classList.remove("hidden");
  document.body.style.overflow = "hidden";

  setTimeout(() => {
    modalContent.classList.remove("scale-95", "opacity-0");
    modalContent.classList.add("scale-100", "opacity-100");
  }, 10);
}

function closeQuizAccessModal() {
  const modal = document.getElementById("quiz-access-modal");
  const modalContent = document.getElementById("quiz-access-modal-content");

  modalContent.classList.remove("scale-100", "opacity-100");
  modalContent.classList.add("scale-95", "opacity-0");

  setTimeout(() => {
    modal.classList.add("hidden");
    document.body.style.overflow = "";
  }, 300);
}

// Open sign up modal from quiz access modal
function openSignUpModalFromQuiz() {
  closeQuizAccessModal();

  // Small delay to ensure smooth transition
  setTimeout(() => {
    openSignUpModal();
  }, 100);
}

// Handle continuing as guest
function continueAsGuest() {
  const guestButton = document.getElementById("continue-as-guest");
  const originalText = guestButton.innerHTML;

  // Show loading state
  guestButton.disabled = true;
  guestButton.innerHTML = `
        <div class="relative z-10 flex items-center gap-2">
            <i class="fas fa-spinner fa-spin"></i>
            Starting Quiz...
        </div>
    `;

  // Close modal and redirect to quiz page
  setTimeout(() => {
    closeQuizAccessModal();

    setTimeout(() => {
      // Redirect to quiz page
      window.location.href = "Content/Pages/quizPage.php";
    }, 500);
  }, 1000);
}

// Main function to handle quiz start
function startQuiz() {
  // Check if user is logged in by looking for session indicators
  const isLoggedIn = checkIfUserIsLoggedIn();

  if (isLoggedIn) {
    // User is logged in, proceed directly to quiz
    proceedToQuiz();
  } else {
    // User is not logged in, show access modal
    showQuizAccessModal();
  }
}

// Helper function to check if user is logged in
function checkIfUserIsLoggedIn() {
  // Check if profile dropdown exists (indicates user is logged in)
  const profileDropdown = document.getElementById("profile-dropdown");
  return profileDropdown !== null;
}

// Function to proceed to quiz (for logged in users)
function proceedToQuiz() {
  // Redirect to quiz page for logged in users
  window.location.href = "Content/Pages/quizPage.php";
}

// Initialize quiz access modal event listeners
document.addEventListener("DOMContentLoaded", function () {
  // Close quiz access modal button
  const closeQuizAccessButton = document.getElementById(
    "close-quiz-access-modal"
  );
  if (closeQuizAccessButton) {
    closeQuizAccessButton.addEventListener("click", closeQuizAccessModal);
  }

  // Create account button
  const createAccountButton = document.getElementById(
    "create-account-from-quiz"
  );
  if (createAccountButton) {
    createAccountButton.addEventListener("click", openSignUpModalFromQuiz);
  }

  // Continue as guest button
  const continueGuestButton = document.getElementById("continue-as-guest");
  if (continueGuestButton) {
    continueGuestButton.addEventListener("click", continueAsGuest);
  }

  // Close modal when clicking outside
  const quizAccessModal = document.getElementById("quiz-access-modal");
  if (quizAccessModal) {
    quizAccessModal.addEventListener("click", function (e) {
      if (e.target === quizAccessModal) {
        closeQuizAccessModal();
      }
    });
  }

  // ESC key to close quiz access modal
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      const modal = document.getElementById("quiz-access-modal");
      if (modal && !modal.classList.contains("hidden")) {
        closeQuizAccessModal();
      }
    }
  });
});
