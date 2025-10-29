export class CoreSubjectsHandler {
  static init(quizApp) {
    const needsCoreSubjects =
      document.getElementById("needs-core-subjects").value === "true";
    const existingDataEl = document.getElementById("existing-core-subjects");

    if (needsCoreSubjects) {
      quizApp.needsCoreSubjects = true;
      quizApp.tempCoreSubjects = {}; // Store temporary data
      this.setupCoreSubjectsForm(quizApp);
      this.setupMBTIForm(quizApp);
    } else {
      quizApp.needsCoreSubjects = false;
      // Load existing core subjects data
      if (existingDataEl && existingDataEl.value) {
        try {
          quizApp.coreSubjects = JSON.parse(existingDataEl.value);
          console.log(
            "[CoreSubjects] Loaded existing data:",
            quizApp.coreSubjects
          );
        } catch (e) {
          console.error("Error parsing existing core subjects:", e);
          quizApp.coreSubjects = {};
        }
      } else {
        quizApp.coreSubjects = {};
      }
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
      if (isNaN(value) || value < 65 || value > 100) {
        input.setCustomValidity(
          "Please enter a valid grade between 65 and 100"
        );
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

    continueBtn.addEventListener("click", async () => {
      // Store all grades temporarily (only academic subjects, no MBTI yet)
      subjectInputs.forEach((input) => {
        if (input.name) {
          quizApp.tempCoreSubjects[input.name] = input.value;
        }
      });

      console.log(
        "[CoreSubjects] Stored academic grades:",
        quizApp.tempCoreSubjects
      );

      // Save core subjects to database for registered users (without MBTI type)
      if (quizApp.quizMode === "user" && quizApp.userId) {
        try {
          await this.saveAcademicGradesToDatabase(quizApp);
        } catch (error) {
          console.error("Error saving academic grades:", error);
          alert("Error saving academic grades. Please try again.");
          return;
        }
      }

      this.showMBTIForm(quizApp);
    });

    backBtn.addEventListener("click", () => {
      this.showQuizForm(quizApp);
    });

    // Initial validation check
    checkGradesValidity();
  }

  static setupMBTIForm(quizApp) {
    const mbtiButtons = document.querySelectorAll(".mbti-button");
    const mbtiInput = document.getElementById("mbti-type");
    const completeBtn = document.getElementById("complete-quiz-btn");
    const backBtn = document.getElementById("back-to-grades-btn");

    let selectedMBTI = null;

    // Handle MBTI selection
    mbtiButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const selectedType = this.getAttribute("data-type");

        // Remove selected class from all buttons
        mbtiButtons.forEach((btn) => btn.classList.remove("selected"));

        // Add selected class to clicked button
        this.classList.add("selected");

        // Update hidden input and variable
        mbtiInput.value = selectedType;
        selectedMBTI = selectedType;

        // Enable complete button
        completeBtn.disabled = false;

        console.log("[CoreSubjects] MBTI selected:", selectedType);
      });
    });

    completeBtn.addEventListener("click", async () => {
      if (!selectedMBTI) {
        alert("Please select your MBTI personality type.");
        return;
      }

      // Add MBTI data to temporary storage
      quizApp.tempCoreSubjects.mbti_type = selectedMBTI;

      // Update MBTI in database for registered users
      if (quizApp.quizMode === "user" && quizApp.userId) {
        try {
          await this.updateMBTIInDatabase(quizApp, selectedMBTI);
        } catch (error) {
          console.error("Error saving MBTI type:", error);
          alert("Error saving personality type. Please try again.");
          return;
        }
      }

      // Finalize core subjects data
      quizApp.coreSubjects = { ...quizApp.tempCoreSubjects };
      quizApp.tempCoreSubjects = {};

      console.log(
        "[CoreSubjects] Final core subjects data:",
        quizApp.coreSubjects
      );

      // Trigger quiz submission
      import("./quizSubmission.js").then(({ QuizSubmission }) => {
        QuizSubmission.processQuizSubmission(quizApp);
      });
    });

    backBtn.addEventListener("click", () => {
      this.showCoreSubjectsForm(quizApp);
    });

    // Initial button state
    completeBtn.disabled = !selectedMBTI;
  }

  static async saveAcademicGradesToDatabase(quizApp) {
    const formData = new FormData();
    formData.append("action", "save_academic_grades");
    formData.append("user_id", quizApp.userId);
    formData.append("quiz_mode", quizApp.quizMode);

    // Add only academic subjects data (no MBTI type)
    Object.keys(quizApp.tempCoreSubjects).forEach((key) => {
      if (key !== "mbti_type") {
        formData.append(key, quizApp.tempCoreSubjects[key]);
      }
    });

    console.log(
      "[CoreSubjects] Saving academic grades:",
      quizApp.tempCoreSubjects
    );

    try {
      const response = await fetch(
        "../Functions/quizPageFunctions/saveCoreSubjects.php",
        {
          method: "POST",
          body: formData,
        }
      );

      // Check if response is ok
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const result = await response.json();

      if (!result.success) {
        console.error("[CoreSubjects] Save failed:", result.message);
        throw new Error(result.message || "Failed to save academic grades");
      }

      console.log(
        "[CoreSubjects] Successfully saved academic grades:",
        result.message
      );
      return result;
    } catch (error) {
      console.error("[CoreSubjects] Error saving academic grades:", error);
      throw error;
    }
  }

  static async updateMBTIInDatabase(quizApp, mbtiType) {
    const formData = new FormData();
    formData.append("action", "update_mbti");
    formData.append("user_id", quizApp.userId);
    formData.append("quiz_mode", quizApp.quizMode);
    formData.append("mbti_type", mbtiType);

    console.log("[CoreSubjects] Updating MBTI type:", mbtiType);

    try {
      const response = await fetch(
        "../Functions/quizPageFunctions/saveCoreSubjects.php",
        {
          method: "POST",
          body: formData,
        }
      );

      // Check if response is ok
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const result = await response.json();

      if (!result.success) {
        console.error("[CoreSubjects] MBTI update failed:", result.message);
        throw new Error(result.message || "Failed to update MBTI type");
      }

      console.log(
        "[CoreSubjects] Successfully updated MBTI type:",
        result.message
      );
      return result;
    } catch (error) {
      console.error("[CoreSubjects] Error updating MBTI type:", error);
      throw error;
    }
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

    console.log("[CoreSubjects] Showing quiz form");
  }
}
