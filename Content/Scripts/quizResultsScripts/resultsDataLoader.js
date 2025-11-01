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

    console.log(
      "[ResultsDataLoader] URL params - resultId:",
      resultId,
      "isGuest:",
      isGuest
    );

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

      console.log("[ResultsDataLoader] Making request to server with:", {
        action: "get_results",
        result_id: resultId,
        is_guest: isGuest,
      });

      const response = await fetch(
        "../Functions/quizPageFunctions/getResults.php",
        {
          method: "POST",
          body: formData,
        }
      );

      // Check if response is ok
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const text = await response.text();
      console.log("[ResultsDataLoader] Raw response:", text);

      // Try to parse as JSON
      let result;
      try {
        result = JSON.parse(text);
      } catch (parseError) {
        console.error("[ResultsDataLoader] JSON parse error:", parseError);
        console.error("[ResultsDataLoader] Response text:", text);
        throw new Error("Server returned invalid JSON");
      }

      if (result.success) {
        console.log(
          "[ResultsDataLoader] Successfully loaded data:",
          result.data
        );
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
      quizAnswers: {
        1: 7,
        2: 7,
        3: 7,
        4: 7,
        5: 7,
        6: 7,
        7: 7,
        8: 7,
        9: 7,
        10: 7,
        11: 7,
        12: 7,
        13: 7,
        14: 7,
        15: 7,
        16: 7,
        17: 7,
        18: 7,
        19: 7,
        20: 7,
        21: 7,
        22: 7,
        23: 7,
        24: 7,
        25: 7,
        26: 7,
        27: 7,
        28: 7,
        29: 7,
        30: 7,
        31: 7,
        32: 7,
        33: 7,
        34: 7,
        35: 7,
        36: 7,
        37: 7,
        38: 7,
        39: 7,
        40: 7,
      },
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
          },
          {
            title: "Public Relations Officer",
            description:
              "As a Public Relations Officer, you'll be the bridge between organizations and the public, crafting compelling narratives and managing media relations.",
            icon: "fa-bullhorn",
            salary_range: "₱28,000 - ₱70,000",
            growth_outlook: "Medium",
            match_percentage: 88,
            why_good_fit:
              "Your ESFJ traits of cooperation and harmony align perfectly with PR's need for relationship-building.",
          },
          {
            title: "Social Worker",
            description:
              "As a Social Worker, you'll empower individuals and communities by providing support and resources to those in need.",
            icon: "fa-heart",
            salary_range: "₱25,000 - ₱65,000",
            growth_outlook: "High",
            match_percentage: 87,
            why_good_fit:
              "Your ESFJ personality is ideal for this caring profession, as you naturally want to help others and create harmonious environments.",
          },
          {
            title: "Event Planner",
            description:
              "As an Event Planner, you'll bring people together by organizing memorable experiences, from corporate conferences to weddings and cultural festivals.",
            icon: "fa-calendar",
            salary_range: "₱25,000 - ₱60,000",
            growth_outlook: "Medium",
            match_percentage: 85,
            why_good_fit:
              "Your ESFJ traits of cooperation and harmony make you naturally skilled at creating enjoyable experiences for others.",
          },
          {
            title: "Customer Service Manager",
            description:
              "As a Customer Service Manager, you'll lead teams that provide exceptional service to clients, ensuring satisfaction and loyalty.",
            icon: "fa-headset",
            salary_range: "₱35,000 - ₱80,000",
            growth_outlook: "High",
            match_percentage: 89,
            why_good_fit:
              "Your ESFJ personality is perfectly suited for this customer-facing role, as you naturally enjoy helping others and creating positive experiences.",
          },
        ],
      },
    };
  }
}
