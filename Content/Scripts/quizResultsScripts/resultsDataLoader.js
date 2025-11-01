export class ResultsDataLoader {
  static async loadResultsData() {
    // Try to get data from sessionStorage first (for fresh submissions)
    const sessionData = sessionStorage.getItem("quizResults");
    if (sessionData) {
      console.log("[ResultsDataLoader] Loading from session storage");
      try {
        const parsedData = JSON.parse(sessionData);
        // Clear session data after loading to prevent conflicts
        sessionStorage.removeItem("quizResults");
        return parsedData;
      } catch (error) {
        console.error("[ResultsDataLoader] Error parsing session data:", error);
        sessionStorage.removeItem("quizResults");
      }
    }

    // If no session data, check URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const resultId = urlParams.get("result_id");
    const isGuest = urlParams.get("guest");

    console.log(
      "[ResultsDataLoader] URL params - resultId:",
      resultId,
      "isGuest:",
      isGuest
    );

    if (resultId || isGuest) {
      return await this.loadResultsFromServer(resultId, isGuest);
    } else {
      console.log(
        "[ResultsDataLoader] No parameters found, loading sample data"
      );
      return this.loadSampleData();
    }
  }

  static async loadResultsFromServer(resultId, isGuest) {
    try {
      console.log(
        `[ResultsDataLoader] Fetching from server - resultId: ${resultId}, isGuest: ${isGuest}`
      );

      const response = await fetch(
        "../Functions/quizPageFunctions/getResults.php",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: new URLSearchParams({
            action: "get_results",
            result_id: resultId || "",
            is_guest: isGuest || "",
          }),
        }
      );

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const data = await response.json();
      console.log("[ResultsDataLoader] Server response:", data);

      if (data.success) {
        return {
          mbtiType: data.data.mbtiType,
          coreSubjects: data.data.coreSubjects,
          quizAnswers: data.data.quizAnswers,
          careerRecommendations: data.data.careerRecommendations,
          result_id: data.data.result_id, // Add this for debugging
        };
      } else {
        console.error("[ResultsDataLoader] Server error:", data.message);
        throw new Error(data.message);
      }
    } catch (error) {
      console.error("[ResultsDataLoader] Error loading from server:", error);
      throw error;
    }
  }

  static loadSampleData() {
    console.log("[ResultsDataLoader] Loading sample data");
    return {
      mbtiType: "ESFJ - The Provider",
      coreSubjects: {
        mbti_type: "ESFJ",
        Statistics_and_Probability: "75",
        Physical_Science: "77",
        oral_comm_context: "77",
        general_math: "77",
        earth_life_sci: "77",
        ucsp: "77",
        reading_writing: "77",
        lit21_ph_world: "77",
        media_info_lit: "77",
      },
      quizAnswers: {},
      careerRecommendations: {
        personality_analysis: {
          key_traits: [
            { name: "Extraverted", opposite: "Introverted", percentage: 75 },
            { name: "Sensing", opposite: "Intuitive", percentage: 68 },
            { name: "Feeling", opposite: "Thinking", percentage: 82 },
            { name: "Judging", opposite: "Perceiving", percentage: 71 },
          ],
        },
        recommended_careers: [
          {
            title: "Human Resources Specialist",
            description:
              "As a Human Resources Specialist, you'll be the heart of any organization, managing employee relations, recruitment, and workplace harmony.",
            icon: "fa-users",
            salary_range: "₱30,000 - ₱75,000",
            growth_outlook: "High",
            match_percentage: 90,
            why_good_fit:
              "Your ESFJ personality is perfectly suited for this role, as you naturally excel in social interactions and thrive in cooperative environments.",
            educational_path: {
              degree_programs: [
                "Bachelor of Science in Psychology",
                "Bachelor of Science in Human Resource Development",
                "Bachelor of Science in Behavioral Sciences",
              ],
            },
          },
        ],
      },
    };
  }
}
