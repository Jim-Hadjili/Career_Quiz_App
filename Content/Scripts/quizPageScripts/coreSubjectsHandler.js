export class CoreSubjectsHandler {
  static init(quizApp) {
    const needsCoreSubjects =
      document.getElementById("needs-core-subjects").value === "true";

    if (needsCoreSubjects) {
      quizApp.needsCoreSubjects = true;
      this.setupCoreSubjectsForm(quizApp);
    } else {
      quizApp.needsCoreSubjects = false;
    }
  }

  static setupCoreSubjectsForm(quizApp) {
    const statisticsSelect = document.getElementById("statistics-grade");
    const physicalScienceSelect = document.getElementById(
      "physical-science-grade"
    );
    const mbtiSelect = document.getElementById("mbti-type");
    const saveBtn = document.getElementById("save-core-subjects-btn");
    const backBtn = document.getElementById("back-to-quiz-btn");

    // Enable save button when all fields are filled
    const checkFormValidity = () => {
      const isValid =
        statisticsSelect.value &&
        physicalScienceSelect.value &&
        mbtiSelect.value;
      saveBtn.disabled = !isValid;
    };

    statisticsSelect.addEventListener("change", checkFormValidity);
    physicalScienceSelect.addEventListener("change", checkFormValidity);
    mbtiSelect.addEventListener("change", checkFormValidity);

    saveBtn.addEventListener("click", () => {
      this.saveCoreSubjects(quizApp);
    });

    backBtn.addEventListener("click", () => {
      this.showQuizForm(quizApp);
    });
  }

  static showCoreSubjectsForm(quizApp) {
    const quizContainer = document.getElementById("quiz-container");
    const coreSubjectsForm = document.getElementById("core-subjects-form");
    const quizNavigation = document.getElementById("quiz-navigation");

    // Hide quiz and navigation
    quizContainer.style.display = "none";
    quizNavigation.style.display = "none";

    // Show core subjects form
    coreSubjectsForm.style.display = "block";

    console.log("[CoreSubjects] Showing core subjects form");
  }

  static showQuizForm(quizApp) {
    const quizContainer = document.getElementById("quiz-container");
    const coreSubjectsForm = document.getElementById("core-subjects-form");
    const quizNavigation = document.getElementById("quiz-navigation");

    // Show quiz and navigation
    quizContainer.style.display = "block";
    quizNavigation.style.display = "block";

    // Hide core subjects form
    coreSubjectsForm.style.display = "none";

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
    const statisticsGrade = document.getElementById("statistics-grade").value;
    const physicalScienceGrade = document.getElementById(
      "physical-science-grade"
    ).value;
    const mbtiType = document.getElementById("mbti-type").value;

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
