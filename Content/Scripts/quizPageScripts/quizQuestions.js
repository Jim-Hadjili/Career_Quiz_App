const CATEGORY_ORDER = [
  "social",
  "analytical",
  "emotional",
  "organized",
  "stress-management",
  "work-style",
  "leadership",
  "communication", // Personality
  "technology",
  "creative", // Interests & Hobbies
  "healthcare",
  "education", // Work Values
  "finance", // Skills & Strengths
];

export const quizQuestions = [
  // Personality Assessment
  {
    id: 1,
    text: "You regularly make new friends.",
    category: "social",
  },
  {
    id: 2,
    text: "You usually feel more persuaded by what resonates emotionally with you than by factual arguments.",
    category: "emotional",
  },
  {
    id: 3,
    text: "Your living and working spaces are clean and organized.",
    category: "organized",
  },
  {
    id: 4,
    text: "You usually stay calm, even under a lot of pressure.",
    category: "stress-management",
  },
  {
    id: 5,
    text: "You prefer working independently rather than in a team environment.",
    category: "work-style",
  },

  // Interests & Hobbies
  {
    id: 6,
    text: "Complex and novel ideas excite you more than simple and straightforward ones.",
    category: "analytical",
  },
  {
    id: 7,
    text: "You enjoy working with computers and technology to solve problems.",
    category: "technology",
  },
  {
    id: 8,
    text: "You enjoy creative work like design, writing, or multimedia production.",
    category: "creative",
  },

  // Work Values
  {
    id: 9,
    text: "You find satisfaction in helping people with their health and well-being.",
    category: "healthcare",
  },
  {
    id: 10,
    text: "You find the idea of networking or promoting yourself to strangers very daunting.",
    category: "social",
  },
  {
    id: 11,
    text: "You like leading teams and managing projects to achieve goals.",
    category: "leadership",
  },
  {
    id: 12,
    text: "You are interested in teaching and sharing knowledge with others.",
    category: "education",
  },

  // Skills & Strengths
  {
    id: 13,
    text: "You enjoy working with numbers, budgets, and financial planning.",
    category: "finance",
  },
  {
    id: 14,
    text: "You enjoy analyzing data and finding patterns to make decisions.",
    category: "analytical",
  },
  {
    id: 15,
    text: "You are comfortable with public speaking and presenting ideas to large groups.",
    category: "communication",
  },
];

// Sort questions by CATEGORY_ORDER
export const orderedQuizQuestions = quizQuestions.slice().sort((a, b) => {
  return (
    CATEGORY_ORDER.indexOf(a.category) - CATEGORY_ORDER.indexOf(b.category)
  );
});
