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
    const statisticsInput = document.getElementById("statistics-grade");
    const physicalScienceInput = document.getElementById(
      "physical-science-grade"
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

    // Enable continue button when both grades are filled and valid
    const checkGradesValidity = () => {
      const statisticsValid =
        statisticsInput.value && validateGrade(statisticsInput);
      const physicalScienceValid =
        physicalScienceInput.value && validateGrade(physicalScienceInput);

      const isValid = statisticsValid && physicalScienceValid;
      continueBtn.disabled = !isValid;
    };

    // Add event listeners for real-time validation
    statisticsInput.addEventListener("input", () => {
      validateGrade(statisticsInput);
      checkGradesValidity();
    });

    physicalScienceInput.addEventListener("input", () => {
      validateGrade(physicalScienceInput);
      checkGradesValidity();
    });

    continueBtn.addEventListener("click", () => {
      // Store grades temporarily and move to MBTI form
      quizApp.tempCoreSubjects.statistics_grade = statisticsInput.value;
      quizApp.tempCoreSubjects.physical_science_grade =
        physicalScienceInput.value;
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
      // Combine grades and MBTI data
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

    // Restore the current question view and navigation state
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
    const statisticsGrade = quizApp.tempCoreSubjects.statistics_grade;
    const physicalScienceGrade =
      quizApp.tempCoreSubjects.physical_science_grade;
    const mbtiType = quizApp.tempCoreSubjects.mbti_type;

    // Final validation
    const statsValue = parseFloat(statisticsGrade);
    const physicsValue = parseFloat(physicalScienceGrade);

    if (isNaN(statsValue) || statsValue < 0 || statsValue > 100) {
      alert("Please enter a valid Statistics grade between 0 and 100");
      this.showCoreSubjectsForm(quizApp);
      return;
    }

    if (isNaN(physicsValue) || physicsValue < 0 || physicsValue > 100) {
      alert("Please enter a valid Physical Science grade between 0 and 100");
      this.showCoreSubjectsForm(quizApp);
      return;
    }

    if (!mbtiType) {
      alert("Please select your MBTI personality type");
      return;
    }

    const formData = new FormData();
    formData.append("action", "save_core_subjects");
    formData.append("statistics_grade", statisticsGrade);
    formData.append("physical_science_grade", physicalScienceGrade);
    formData.append("mbti_type", mbtiType);
    formData.append("user_id", quizApp.userId);
    formData.append("session_id", quizApp.sessionId);
    formData.append("quiz_mode", quizApp.quizMode);

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
        quizApp.coreSubjects = {
          statistics_grade: statisticsGrade,
          physical_science_grade: physicalScienceGrade,
          mbti_type: mbtiType,
        };

        // Clear temporary data
        quizApp.tempCoreSubjects = {};

        // Now proceed with final quiz submission
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
    console.log("User ID:", quizApp.userId);
    console.log("Session ID:", quizApp.sessionId);

    if (quizApp.coreSubjects) {
      console.log("Core subjects:", quizApp.coreSubjects);
    }

    // Here you would implement the actual quiz result processing
    alert("Quiz submitted successfully! Result Page will be available soon");
  }
}
