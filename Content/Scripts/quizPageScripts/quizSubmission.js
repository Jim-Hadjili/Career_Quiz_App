import { CoreSubjectsHandler } from "./coreSubjectsHandler.js";

export class QuizSubmission {
  static submitQuiz(quizApp) {
    console.log("[QuizSubmission] Starting submission process...");
    console.log(
      "[QuizSubmission] Total answers:",
      Object.keys(quizApp.answers).length
    );
    console.log(
      "[QuizSubmission] Answers by category:",
      this.categorizeAnswers(quizApp.answers)
    );
    console.log(
      "[QuizSubmission] Needs core subjects:",
      quizApp.needsCoreSubjects
    );
    console.log(
      "[QuizSubmission] Current core subjects:",
      quizApp.coreSubjects
    );

    // Check if we need core subjects and haven't collected them yet
    if (
      quizApp.needsCoreSubjects &&
      (!quizApp.coreSubjects || Object.keys(quizApp.coreSubjects).length === 0)
    ) {
      console.log("[QuizSubmission] Showing core subjects form...");
      CoreSubjectsHandler.showCoreSubjectsForm(quizApp);
      return;
    }

    // If no core subjects needed or already collected, proceed with submission
    this.processQuizSubmission(quizApp);
  }

  static categorizeAnswers(answers) {
    const categories = {
      personality: [], // IDs 1-10
      interests: [], // IDs 11-20
      values: [], // IDs 21-30
      skills: [], // IDs 31-40
    };

    Object.entries(answers).forEach(([questionId, answer]) => {
      const id = parseInt(questionId);
      if (id >= 1 && id <= 10) {
        categories.personality.push({ id, answer });
      } else if (id >= 11 && id <= 20) {
        categories.interests.push({ id, answer });
      } else if (id >= 21 && id <= 30) {
        categories.values.push({ id, answer });
      } else if (id >= 31 && id <= 40) {
        categories.skills.push({ id, answer });
      }
    });

    return categories;
  }

  static async processQuizSubmission(quizApp) {
    console.log("[QuizSubmission] Processing quiz submission...");
    console.log("[QuizSubmission] Quiz answers:", quizApp.answers);
    console.log("[QuizSubmission] Core subjects:", quizApp.coreSubjects);

    // Validate that we have comprehensive data
    const answersByCategory = this.categorizeAnswers(quizApp.answers);
    const incompleteCategories = [];

    Object.entries(answersByCategory).forEach(([category, answers]) => {
      if (answers.length < 10) {
        // Each category should have 10 questions
        incompleteCategories.push(category);
      }
    });

    if (incompleteCategories.length > 0) {
      alert(
        `Please complete all categories: ${incompleteCategories.join(", ")}`
      );
      return;
    }

    // Validate that we have the required data
    if (
      !quizApp.coreSubjects ||
      Object.keys(quizApp.coreSubjects).length === 0
    ) {
      alert(
        "Missing core subjects data. Please complete all required sections."
      );
      return;
    }

    if (!quizApp.coreSubjects.mbti_type) {
      alert(
        "Missing MBTI personality type. Please complete all required sections."
      );
      return;
    }

    // Show loading state
    this.showLoadingState();

    try {
      // Prepare submission data with enhanced structure
      const formData = new FormData();
      formData.append("action", "submit_quiz");
      formData.append("user_id", quizApp.userId);
      formData.append("session_id", quizApp.sessionId);
      formData.append("quiz_mode", quizApp.quizMode);
      formData.append("quiz_answers", JSON.stringify(quizApp.answers));
      formData.append("answers_by_category", JSON.stringify(answersByCategory));
      formData.append("core_subjects", JSON.stringify(quizApp.coreSubjects));

      console.log("[QuizSubmission] Submitting comprehensive data:", {
        userId: quizApp.userId,
        sessionId: quizApp.sessionId,
        quizMode: quizApp.quizMode,
        totalAnswers: Object.keys(quizApp.answers).length,
        answersByCategory: answersByCategory,
        coreSubjects: quizApp.coreSubjects,
      });

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
        console.log("[QuizSubmission] Quiz submitted successfully!");
        console.log(
          "[QuizSubmission] Career recommendations:",
          result.career_recommendations
        );

        // Store results in sessionStorage for the results page with enhanced data
        sessionStorage.setItem(
          "quizResults",
          JSON.stringify({
            resultId: result.result_id,
            careerRecommendations: result.career_recommendations,
            quizAnswers: quizApp.answers,
            answersByCategory: answersByCategory,
            coreSubjects: quizApp.coreSubjects,
          })
        );

        // Redirect to results page
        window.location.href = result.redirect_url;
      } else {
        this.hideLoadingState();
        console.error("[QuizSubmission] Submission failed:", result.message);
        alert("Error submitting quiz: " + result.message);
      }
    } catch (error) {
      this.hideLoadingState();
      console.error("[QuizSubmission] Submission error:", error);
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
        <h3 class="text-xl font-bold text-dark mb-2">Analyzing Your Complete Profile</h3>
        <p class="text-gray-600">
          Our AI is processing your responses across all categories - personality, interests, values, and skills - to generate comprehensive career recommendations...
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
