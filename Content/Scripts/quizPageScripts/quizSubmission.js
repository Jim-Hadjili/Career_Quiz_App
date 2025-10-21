import { CoreSubjectsHandler } from "./coreSubjectsHandler.js";

export class QuizSubmission {
  static submitQuiz(quizApp) {
    // Check if we need core subjects and haven't collected them yet
    if (quizApp.needsCoreSubjects && !quizApp.coreSubjects) {
      CoreSubjectsHandler.showCoreSubjectsForm();
      return;
    }

    // Proceed with actual submission
    this.processQuizSubmission(quizApp);
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

    alert("Quiz submitted successfully! Result Page will be available soon");
  }
}
