const CATEGORY_ORDER = ["personality", "interests", "values", "skills"];

export const quizQuestions = [
  // Personality Traits
  {
    id: 1,
    text: "You regularly make new friends and enjoy social interactions.",
    category: "personality",
  },

  // Interests & Hobbies
  {
    id: 2,
    text: "You enjoy working with computers and technology to solve problems.",
    category: "interests",
  },

  // Work Values
  {
    id: 3,
    text: "You find satisfaction in helping people with their health and well-being.",
    category: "values",
  },

  // Skills & Strengths
  {
    id: 4,
    text: "You enjoy analyzing data and finding patterns to make decisions.",
    category: "skills",
  },
];

// Sort questions by CATEGORY_ORDER
export const orderedQuizQuestions = quizQuestions.slice().sort((a, b) => {
  return (
    CATEGORY_ORDER.indexOf(a.category) - CATEGORY_ORDER.indexOf(b.category)
  );
});
