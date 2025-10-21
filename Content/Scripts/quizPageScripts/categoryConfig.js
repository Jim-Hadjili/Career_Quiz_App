export class CategoryConfig {
  static getCategoryInfo(category) {
    // Map categories to the 4 main quiz categories
    const categoryMap = {
      // Personality Traits
      personality: {
        class: "stage-personality",
        icon: "fas fa-user",
        label: "Personality Traits",
      },

      // Interests & Hobbies
      interests: {
        class: "stage-interests",
        icon: "fas fa-heart",
        label: "Interests & Hobbies",
      },

      // Work Values
      values: {
        class: "stage-values",
        icon: "fas fa-star",
        label: "Work Values",
      },

      // Skills & Strengths
      skills: {
        class: "stage-abilities",
        icon: "fas fa-bolt",
        label: "Skills & Strengths",
      },
    };

    return (
      categoryMap[category] || {
        class: "stage-personality",
        icon: "fas fa-user",
        label: "Personality Traits",
      }
    );
  }
}
