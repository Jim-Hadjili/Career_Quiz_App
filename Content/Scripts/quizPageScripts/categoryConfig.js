export class CategoryConfig {
  static getCategoryInfo(category) {
    // Map individual categories to the 4 main quiz categories
    const categoryMap = {
      // Personality traits
      social: {
        class: "stage-personality",
        icon: "fas fa-user",
        label: "Personality traits",
      },
      analytical: {
        class: "stage-personality",
        icon: "fas fa-user",
        label: "Personality traits",
      },
      emotional: {
        class: "stage-personality",
        icon: "fas fa-user",
        label: "Personality traits",
      },
      organized: {
        class: "stage-personality",
        icon: "fas fa-user",
        label: "Personality traits",
      },
      "stress-management": {
        class: "stage-personality",
        icon: "fas fa-user",
        label: "Personality traits",
      },
      "work-style": {
        class: "stage-personality",
        icon: "fas fa-user",
        label: "Personality traits",
      },
      leadership: {
        class: "stage-personality",
        icon: "fas fa-user",
        label: "Personality traits",
      },
      communication: {
        class: "stage-personality",
        icon: "fas fa-user",
        label: "Personality traits",
      },

      // Interests & Hobbies
      technology: {
        class: "stage-interests",
        icon: "fas fa-heart",
        label: "Interests & Hobbies",
      },
      creative: {
        class: "stage-interests",
        icon: "fas fa-heart",
        label: "Interests & Hobbies",
      },

      // Work Values
      healthcare: {
        class: "stage-values",
        icon: "fas fa-star",
        label: "Work Values",
      },
      education: {
        class: "stage-values",
        icon: "fas fa-star",
        label: "Work Values",
      },

      // Skills & Strengths
      finance: {
        class: "stage-abilities",
        icon: "fas fa-bolt",
        label: "Skills & Strengths",
      },
    };

    return (
      categoryMap[category] || {
        class: "stage-personality",
        icon: "fas fa-user",
        label: "Personality traits",
      }
    );
  }
}
