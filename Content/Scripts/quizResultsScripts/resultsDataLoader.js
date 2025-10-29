export class ResultsDataLoader {
  static async loadResultsData() {
    // Try to get data from sessionStorage first (for fresh submissions)
    const sessionData = sessionStorage.getItem("quizResults");
    if (sessionData) {
      try {
        const resultsData = JSON.parse(sessionData);
        console.log("[ResultsDataLoader] Loading data from session storage");
        return resultsData;
      } catch (e) {
        console.error("[ResultsDataLoader] Error parsing session data:", e);
      }
    }

    // If no session data, check URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const resultId = urlParams.get("result_id");
    const isGuest = urlParams.get("guest");

    if (resultId || isGuest) {
      return await this.loadResultsFromServer(resultId, isGuest);
    } else {
      // Fallback to sample data
      console.log("[ResultsDataLoader] Using fallback sample data");
      return this.loadSampleData();
    }
  }

  static async loadResultsFromServer(resultId, isGuest) {
    try {
      const formData = new FormData();
      formData.append("action", "get_results");
      if (resultId) formData.append("result_id", resultId);
      if (isGuest) formData.append("is_guest", isGuest);

      const response = await fetch(
        "../Functions/quizPageFunctions/getResults.php",
        {
          method: "POST",
          body: formData,
        }
      );

      const result = await response.json();

      if (result.success) {
        return result.data;
      } else {
        console.error("[ResultsDataLoader] Server error:", result.message);
        return this.loadSampleData();
      }
    } catch (error) {
      console.error("[ResultsDataLoader] Network error:", error);
      return this.loadSampleData();
    }
  }

  static loadSampleData() {
    return {
      mbtiType: "INTP - The Thinker",
      coreSubjects: {
        mbti_type: "INTP",
      },
      careerRecommendations: {
        personality_analysis: {
          key_traits: [
            { name: "Introverted", opposite: "Extraverted", percentage: 75 },
            { name: "Intuitive", opposite: "Sensing", percentage: 68 },
            { name: "Thinking", opposite: "Feeling", percentage: 82 },
            { name: "Perceiving", opposite: "Judging", percentage: 71 },
          ],
        },
        recommended_careers: [
          {
            title: "Software Developer",
            description:
              "Design and develop software applications, systems, and solutions using programming languages and technologies.",
            icon: "fa-code",
            salary_range: "$95,000",
            growth_outlook: "High",
            match_percentage: 92,
            why_good_fit:
              "Your INTP personality thrives on logical problem-solving and independent work, making you naturally suited for coding challenges.",
          },
        ],
      },
    };
  }
}
