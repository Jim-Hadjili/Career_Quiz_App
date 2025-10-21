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
