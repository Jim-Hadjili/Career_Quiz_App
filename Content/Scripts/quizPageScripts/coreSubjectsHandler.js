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
  }

  static showCoreSubjectsForm() {
    const form = document.getElementById("core-subjects-form");
    const navigationDiv = form.nextElementSibling;

    form.style.display = "block";
    navigationDiv.style.display = "none";
  }

  static hideCoreSubjectsForm() {
    const form = document.getElementById("core-subjects-form");
    const navigationDiv = form.nextElementSibling;

    form.style.display = "none";
    navigationDiv.style.display = "block";
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

        this.hideCoreSubjectsForm();
        quizApp.submitQuiz();
      } else {
        alert("Error saving core subjects: " + result.message);
      }
    } catch (error) {
      console.error("Error:", error);
      alert("An error occurred while saving core subjects.");
    }
  }
}
