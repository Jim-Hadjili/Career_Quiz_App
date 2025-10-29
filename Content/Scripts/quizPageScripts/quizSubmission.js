import { CoreSubjectsHandler } from "./coreSubjectsHandler.js";

export class QuizSubmission {
  static submitQuiz(quizApp) {
    // Check if we need core subjects and haven't collected them yet
    if (quizApp.needsCoreSubjects && !quizApp.coreSubjects) {
      CoreSubjectsHandler.showCoreSubjectsForm(quizApp);
      return;
    }

    // If no core subjects needed or already collected, proceed with submission
    this.processQuizSubmission(quizApp);
  }

  static async processQuizSubmission(quizApp) {
    console.log("Processing quiz submission...");

    // Show loading state
    this.showLoadingState();

    try {
      // Prepare submission data
      const formData = new FormData();
      formData.append("action", "submit_quiz");
      formData.append("user_id", quizApp.userId);
      formData.append("session_id", quizApp.sessionId);
      formData.append("quiz_mode", quizApp.quizMode);
      formData.append("quiz_answers", JSON.stringify(quizApp.answers));
      formData.append(
        "core_subjects",
        JSON.stringify(quizApp.coreSubjects || {})
      );

      // Submit to server
      const response = await fetch(
        "../Functions/quizPageFunctions/submitQuiz.php",
        {
          method: "POST",
          body: formData,
        }
      );

      const result = await response.json();

      if (result.success) {
        console.log("Quiz submitted successfully!");
        console.log("Career recommendations:", result.career_recommendations);

        // Store results in sessionStorage for the results page
        sessionStorage.setItem(
          "quizResults",
          JSON.stringify({
            resultId: result.result_id,
            careerRecommendations: result.career_recommendations,
            quizAnswers: quizApp.answers,
            coreSubjects: quizApp.coreSubjects,
          })
        );

        // Redirect to results page
        window.location.href = result.redirect_url;
      } else {
        this.hideLoadingState();
        alert("Error submitting quiz: " + result.message);
      }
    } catch (error) {
      this.hideLoadingState();
      console.error("Submission error:", error);
      alert("An error occurred while submitting your quiz. Please try again.");
    }
  }

  static showLoadingState() {
    // Create loading overlay
    const loadingOverlay = document.createElement("div");
    loadingOverlay.id = "quiz-loading-overlay";
    loadingOverlay.className =
      "fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50";
    loadingOverlay.innerHTML = `
      <div class="bg-white rounded-2xl p-8 max-w-md mx-4 text-center">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-lime mx-auto mb-4"></div>
        <h3 class="text-xl font-bold text-dark mb-2">Analyzing Your Profile</h3>
        <p class="text-gray-600">
          Our AI is processing your responses and generating personalized career recommendations...
        </p>
      </div>
    `;

    document.body.appendChild(loadingOverlay);
  }

  static hideLoadingState() {
    const loadingOverlay = document.getElementById("quiz-loading-overlay");
    if (loadingOverlay) {
      loadingOverlay.remove();
    }
  }
}
