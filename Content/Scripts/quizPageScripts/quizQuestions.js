const CATEGORY_ORDER = ["personality", "interests", "values", "skills"];

export const quizQuestions = [
  // Personality Traits (10 questions)
  {
    id: 1,
    text: "You regularly make new friends and enjoy social interactions.",
    category: "personality",
  },
  {
    id: 2,
    text: "You prefer to work alone rather than in a team environment.",
    category: "personality",
  },
  {
    id: 3,
    text: "You often take charge in group situations and lead discussions.",
    category: "personality",
  },
  {
    id: 4,
    text: "You handle stress and pressure well without getting overwhelmed.",
    category: "personality",
  },
  {
    id: 5,
    text: "You are comfortable with taking calculated risks to achieve goals.",
    category: "personality",
  },
  {
    id: 6,
    text: "You pay close attention to details and rarely make careless mistakes.",
    category: "personality",
  },
  {
    id: 7,
    text: "You adapt quickly to changes and unexpected situations.",
    category: "personality",
  },
  {
    id: 8,
    text: "You enjoy brainstorming creative solutions to complex problems.",
    category: "personality",
  },
  {
    id: 9,
    text: "You are patient and persistent when working on long-term projects.",
    category: "personality",
  },
  {
    id: 10,
    text: "You are comfortable expressing your opinions and ideas to others.",
    category: "personality",
  },

  // Interests & Hobbies (10 questions)
  {
    id: 11,
    text: "You enjoy working with computers and technology to solve problems.",
    category: "interests",
  },
  {
    id: 12,
    text: "You like creating art, writing, or other forms of creative expression.",
    category: "interests",
  },
  {
    id: 13,
    text: "You are fascinated by how things work and enjoy taking them apart.",
    category: "interests",
  },
  {
    id: 14,
    text: "You enjoy reading about science, research, and new discoveries.",
    category: "interests",
  },
  {
    id: 15,
    text: "You like organizing events and bringing people together.",
    category: "interests",
  },
  {
    id: 16,
    text: "You enjoy outdoor activities and working with your hands.",
    category: "interests",
  },
  {
    id: 17,
    text: "You are interested in understanding how businesses and economies work.",
    category: "interests",
  },
  {
    id: 18,
    text: "You like teaching others and sharing knowledge.",
    category: "interests",
  },
  {
    id: 19,
    text: "You enjoy games that involve strategy and problem-solving.",
    category: "interests",
  },
  {
    id: 20,
    text: "You are drawn to learning about different cultures and languages.",
    category: "interests",
  },

  // Work Values (10 questions)
  {
    id: 21,
    text: "You find satisfaction in helping people with their health and well-being.",
    category: "values",
  },
  {
    id: 22,
    text: "You value job security and stable employment over high-risk opportunities.",
    category: "values",
  },
  {
    id: 23,
    text: "You prefer a flexible work schedule and work-life balance.",
    category: "values",
  },
  {
    id: 24,
    text: "You are motivated by opportunities for career advancement and promotion.",
    category: "values",
  },
  {
    id: 25,
    text: "You want your work to make a positive impact on society.",
    category: "values",
  },
  {
    id: 26,
    text: "You prefer working independently with minimal supervision.",
    category: "values",
  },
  {
    id: 27,
    text: "You value high compensation and financial rewards for your work.",
    category: "values",
  },
  {
    id: 28,
    text: "You want to work in a collaborative and supportive team environment.",
    category: "values",
  },
  {
    id: 29,
    text: "You prefer a structured work environment with clear procedures.",
    category: "values",
  },
  {
    id: 30,
    text: "You value intellectual challenges and continuous learning opportunities.",
    category: "values",
  },

  // Skills & Strengths (10 questions)
  {
    id: 31,
    text: "You enjoy analyzing data and finding patterns to make decisions.",
    category: "skills",
  },
  {
    id: 32,
    text: "You are skilled at communicating complex ideas clearly to others.",
    category: "skills",
  },
  {
    id: 33,
    text: "You excel at managing your time and organizing tasks efficiently.",
    category: "skills",
  },
  {
    id: 34,
    text: "You are good at building relationships and networking with people.",
    category: "skills",
  },
  {
    id: 35,
    text: "You have strong mathematical and analytical thinking abilities.",
    category: "skills",
  },
  {
    id: 36,
    text: "You are skilled at writing reports, proposals, or other documents.",
    category: "skills",
  },
  {
    id: 37,
    text: "You can quickly learn and master new software or technologies.",
    category: "skills",
  },
  {
    id: 38,
    text: "You are effective at resolving conflicts and mediating disputes.",
    category: "skills",
  },
  {
    id: 39,
    text: "You have artistic or design skills that others recognize.",
    category: "skills",
  },
  {
    id: 40,
    text: "You are skilled at public speaking and presenting to groups.",
    category: "skills",
  },
];

// Sort questions by CATEGORY_ORDER
export const orderedQuizQuestions = quizQuestions.slice().sort((a, b) => {
  return (
    CATEGORY_ORDER.indexOf(a.category) - CATEGORY_ORDER.indexOf(b.category)
  );
});
