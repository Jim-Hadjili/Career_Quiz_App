export class CoreSubjectsHandler {
  static init(quizApp) {
    const needsCoreSubjects =
      document.getElementById("needs-core-subjects").value === "true";

    if (needsCoreSubjects) {
      quizApp.needsCoreSubjects = true;
      quizApp.tempCoreSubjects = {}; // Store temporary data
      this.setupCoreSubjectsForm(quizApp);
      this.setupMBTIForm(quizApp);
    } else {
      quizApp.needsCoreSubjects = false;
    }
  }

  static setupCoreSubjectsForm(quizApp) {
    // Get all subject input fields
    const subjectInputs = document.querySelectorAll(
      '#core-subjects-form input[type="number"]'
    );
    const continueBtn = document.getElementById("continue-to-mbti-btn");
    const backBtn = document.getElementById("back-to-quiz-btn");

    // Validate grade input
    const validateGrade = (input) => {
      const value = parseFloat(input.value);
      if (isNaN(value) || value < 0 || value > 100) {
        input.setCustomValidity("Please enter a valid grade between 0 and 100");
        return false;
      } else {
        input.setCustomValidity("");
        return true;
      }
    };

    // Check if all required fields are filled and valid
    const checkGradesValidity = () => {
      let allValid = true;

      subjectInputs.forEach((input) => {
        if (input.required) {
          if (!input.value || !validateGrade(input)) {
            allValid = false;
          }
        }
      });

      continueBtn.disabled = !allValid;
    };

    // Add event listeners for real-time validation
    subjectInputs.forEach((input) => {
      input.addEventListener("input", () => {
        validateGrade(input);
        checkGradesValidity();
      });
    });

    continueBtn.addEventListener("click", () => {
      // Store all grades temporarily
      subjectInputs.forEach((input) => {
        if (input.name) {
          quizApp.tempCoreSubjects[input.name] = input.value;
        }
      });

      this.showMBTIForm(quizApp);
    });

    backBtn.addEventListener("click", () => {
      this.showQuizForm(quizApp);
    });
  }

  static setupMBTIForm(quizApp) {
    const mbtiSelect = document.getElementById("mbti-type");
    const completeBtn = document.getElementById("complete-quiz-btn");
    const backBtn = document.getElementById("back-to-grades-btn");

    // Enable complete button when MBTI is selected
    const checkMBTIValidity = () => {
      completeBtn.disabled = !mbtiSelect.value;
    };

    mbtiSelect.addEventListener("change", checkMBTIValidity);

    completeBtn.addEventListener("click", () => {
      // Add MBTI data
      quizApp.tempCoreSubjects.mbti_type = mbtiSelect.value;
      this.saveCoreSubjects(quizApp);
    });

    backBtn.addEventListener("click", () => {
      this.showCoreSubjectsForm(quizApp);
    });
  }

  static showCoreSubjectsForm(quizApp) {
    const quizContainer = document.getElementById("quiz-container");
    const coreSubjectsForm = document.getElementById("core-subjects-form");
    const mbtiForm = document.getElementById("mbti-form");
    const quizNavigation = document.getElementById("quiz-navigation");

    // Hide other forms
    quizContainer.style.display = "none";
    mbtiForm.style.display = "none";
    quizNavigation.style.display = "none";

    // Show core subjects form
    coreSubjectsForm.style.display = "block";

    console.log("[CoreSubjects] Showing core subjects form");
  }

  static showMBTIForm(quizApp) {
    const coreSubjectsForm = document.getElementById("core-subjects-form");
    const mbtiForm = document.getElementById("mbti-form");

    // Hide core subjects form
    coreSubjectsForm.style.display = "none";

    // Show MBTI form
    mbtiForm.style.display = "block";

    console.log("[CoreSubjects] Showing MBTI form");
  }

  static showQuizForm(quizApp) {
    const quizContainer = document.getElementById("quiz-container");
    const coreSubjectsForm = document.getElementById("core-subjects-form");
    const mbtiForm = document.getElementById("mbti-form");
    const quizNavigation = document.getElementById("quiz-navigation");

    // Show quiz and navigation
    quizContainer.style.display = "block";
    quizNavigation.style.display = "block";

    // Hide additional forms
    coreSubjectsForm.style.display = "none";
    mbtiForm.style.display = "none";

    // Restore quiz state
    quizApp.showQuestion(quizApp.currentQuestion);
    quizApp.updateNavigationButtons();
    quizApp.updateProgress();
    quizApp.updateStageInfo();

    console.log(
      "[CoreSubjects] Showing quiz form, current question:",
      quizApp.currentQuestion
    );
  }

  static async saveCoreSubjects(quizApp) {
    const formData = new FormData();
    formData.append("action", "save_core_subjects");
    formData.append("user_id", quizApp.userId);
    formData.append("session_id", quizApp.sessionId);
    formData.append("quiz_mode", quizApp.quizMode);

    // Add all subject grades
    Object.keys(quizApp.tempCoreSubjects).forEach((key) => {
      formData.append(key, quizApp.tempCoreSubjects[key]);
    });

    try {
      const response = await fetch(
        "../Functions/quizPageFunctions/saveCoreSubjects.php",
        {
          method: "POST",
          body: formData,
        }
      );

      const result = await response.json();

      if (result.success) {
        quizApp.coreSubjects = { ...quizApp.tempCoreSubjects };
        quizApp.tempCoreSubjects = {};

        this.processQuizSubmission(quizApp);
      } else {
        alert("Error saving core subjects: " + result.message);
      }
    } catch (error) {
      console.error("Error:", error);
      alert("An error occurred while saving core subjects.");
    }
  }

  static processQuizSubmission(quizApp) {
    console.log("Quiz completed! Processing submission...");
    console.log("Quiz answers:", quizApp.answers);
    console.log("Quiz mode:", quizApp.quizMode);
    console.log("Core subjects:", quizApp.coreSubjects);

    alert("Quiz submitted successfully! Result Page will be available soon");
  }
}
