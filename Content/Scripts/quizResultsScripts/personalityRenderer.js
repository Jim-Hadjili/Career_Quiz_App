export class PersonalityRenderer {
  static renderPersonalityInfo(data) {
    if (!data || !data.coreSubjects) {
      console.error("[PersonalityRenderer] Invalid data provided");
      return;
    }

    const mbtiType = data.coreSubjects.mbti_type || "UNKNOWN";
    const mbtiDisplay = this.getMBTIDisplay(mbtiType);

    // Update all personality type elements
    const personalityElements = [
      "personality-type",
      "banner-personality-type",
      "sidebar-personality-type",
      "mobile-personality-type",
    ];

    personalityElements.forEach((id) => {
      const element = document.getElementById(id);
      if (element) {
        element.textContent = mbtiType;
        console.log(`[PersonalityRenderer] Updated ${id} with ${mbtiType}`);
      }
    });

    const personalityFullElements = [
      "personality-full",
      "banner-personality-full",
      "sidebar-personality-full",
      "mobile-personality-full",
    ];

    personalityFullElements.forEach((id) => {
      const element = document.getElementById(id);
      if (element) {
        element.textContent = mbtiDisplay;
        console.log(`[PersonalityRenderer] Updated ${id} with ${mbtiDisplay}`);
      }
    });

    // Render comprehensive personality analysis
    this.renderComprehensiveAnalysis(data);
  }

  static renderComprehensiveAnalysis(data) {
    // Check if quiz answers are available
    if (!data.quizAnswers || Object.keys(data.quizAnswers).length === 0) {
      console.log(
        "[PersonalityRenderer] Quiz answers not available, using fallback analysis"
      );
      this.renderFallbackAnalysis(data);
      return;
    }

    // Analyze responses across all categories
    const personalityAnalysis = this.analyzePersonalityResponses(
      data.quizAnswers
    );
    const interestsAnalysis = this.analyzeInterestsResponses(data.quizAnswers);
    const valuesAnalysis = this.analyzeValuesResponses(data.quizAnswers);
    const skillsAnalysis = this.analyzeSkillsResponses(data.quizAnswers);

    // Combine analyses for comprehensive traits
    const comprehensiveTraits = this.generateComprehensiveTraits(
      personalityAnalysis,
      interestsAnalysis,
      valuesAnalysis,
      skillsAnalysis,
      data.coreSubjects.mbti_type
    );

    // Render the traits visualization
    this.renderTraits(comprehensiveTraits);

    // Update personality description based on comprehensive analysis
    this.updatePersonalityDescription(
      comprehensiveTraits,
      data.coreSubjects.mbti_type
    );
  }

  static renderFallbackAnalysis(data) {
    // Generate basic traits based on MBTI type when quiz data is unavailable
    const mbtiType = data.coreSubjects.mbti_type || "ISFJ";
    const fallbackTraits = this.generateMBTIBasedTraits(mbtiType);

    this.renderTraits(fallbackTraits);
    this.updatePersonalityDescription(fallbackTraits, mbtiType);
  }

  static generateMBTIBasedTraits(mbtiType) {
    // Generate basic traits based on MBTI type
    const traits = [];

    // Extract MBTI dimensions
    const isExtraverted = mbtiType.charAt(0) === "E";
    const isSensing = mbtiType.charAt(1) === "S";
    const isThinking = mbtiType.charAt(2) === "T";
    const isJudging = mbtiType.charAt(3) === "J";

    traits.push({
      name: "Extraversion",
      opposite: "Introversion",
      percentage: isExtraverted ? 65 : 35,
      description: isExtraverted
        ? "You gain energy from social interactions"
        : "You prefer quieter, more focused environments",
    });

    traits.push({
      name: "Sensing",
      opposite: "Intuition",
      percentage: isSensing ? 65 : 35,
      description: isSensing
        ? "You focus on concrete details and practical information"
        : "You prefer abstract concepts and future possibilities",
    });

    traits.push({
      name: "Thinking",
      opposite: "Feeling",
      percentage: isThinking ? 65 : 35,
      description: isThinking
        ? "You make decisions based on logic and analysis"
        : "You prioritize values and personal considerations",
    });

    traits.push({
      name: "Judging",
      opposite: "Perceiving",
      percentage: isJudging ? 65 : 35,
      description: isJudging
        ? "You prefer structure and planned approaches"
        : "You like flexibility and adaptable methods",
    });

    return traits;
  }

  static analyzePersonalityResponses(answers) {
    // Personality questions are IDs 1-10
    const personalityQuestions = {
      1: { trait: "extraversion", weight: 1 }, // social interactions
      2: { trait: "introversion", weight: 1 }, // work alone
      3: { trait: "leadership", weight: 1 }, // take charge
      4: { trait: "stress_tolerance", weight: 1 }, // handle stress
      5: { trait: "risk_taking", weight: 1 }, // calculated risks
      6: { trait: "attention_to_detail", weight: 1 }, // details
      7: { trait: "adaptability", weight: 1 }, // adapt to changes
      8: { trait: "creativity", weight: 1 }, // creative solutions
      9: { trait: "persistence", weight: 1 }, // long-term projects
      10: { trait: "communication", weight: 1 }, // express opinions
    };

    const traits = {};

    Object.entries(personalityQuestions).forEach(([questionId, config]) => {
      const answer = answers[questionId];
      if (answer !== undefined) {
        if (!traits[config.trait]) traits[config.trait] = 0;

        // For introversion question (ID 2), invert the score
        if (config.trait === "introversion") {
          traits[config.trait] += (8 - answer) * config.weight;
        } else {
          traits[config.trait] += answer * config.weight;
        }
      }
    });

    return traits;
  }

  static analyzeInterestsResponses(answers) {
    // Interests questions are IDs 11-20
    const interestsQuestions = {
      11: { trait: "technology_interest", weight: 1 },
      12: { trait: "creative_interest", weight: 1 },
      13: { trait: "mechanical_interest", weight: 1 },
      14: { trait: "scientific_interest", weight: 1 },
      15: { trait: "social_interest", weight: 1 },
      16: { trait: "outdoor_interest", weight: 1 },
      17: { trait: "business_interest", weight: 1 },
      18: { trait: "teaching_interest", weight: 1 },
      19: { trait: "strategic_interest", weight: 1 },
      20: { trait: "cultural_interest", weight: 1 },
    };

    const interests = {};

    Object.entries(interestsQuestions).forEach(([questionId, config]) => {
      const answer = answers[questionId];
      if (answer !== undefined) {
        if (!interests[config.trait]) interests[config.trait] = 0;
        interests[config.trait] += answer * config.weight;
      }
    });

    return interests;
  }

  static analyzeValuesResponses(answers) {
    // Values questions are IDs 21-30
    const valuesQuestions = {
      21: { trait: "helping_value", weight: 1 },
      22: { trait: "security_value", weight: 1 },
      23: { trait: "flexibility_value", weight: 1 },
      24: { trait: "advancement_value", weight: 1 },
      25: { trait: "impact_value", weight: 1 },
      26: { trait: "independence_value", weight: 1 },
      27: { trait: "compensation_value", weight: 1 },
      28: { trait: "collaboration_value", weight: 1 },
      29: { trait: "structure_value", weight: 1 },
      30: { trait: "learning_value", weight: 1 },
    };

    const values = {};

    Object.entries(valuesQuestions).forEach(([questionId, config]) => {
      const answer = answers[questionId];
      if (answer !== undefined) {
        if (!values[config.trait]) values[config.trait] = 0;
        values[config.trait] += answer * config.weight;
      }
    });

    return values;
  }

  static analyzeSkillsResponses(answers) {
    // Skills questions are IDs 31-40
    const skillsQuestions = {
      31: { trait: "analytical_skill", weight: 1 },
      32: { trait: "communication_skill", weight: 1 },
      33: { trait: "organization_skill", weight: 1 },
      34: { trait: "networking_skill", weight: 1 },
      35: { trait: "mathematical_skill", weight: 1 },
      36: { trait: "writing_skill", weight: 1 },
      37: { trait: "technical_skill", weight: 1 },
      38: { trait: "mediation_skill", weight: 1 },
      39: { trait: "artistic_skill", weight: 1 },
      40: { trait: "presentation_skill", weight: 1 },
    };

    const skills = {};

    Object.entries(skillsQuestions).forEach(([questionId, config]) => {
      const answer = answers[questionId];
      if (answer !== undefined) {
        if (!skills[config.trait]) skills[config.trait] = 0;
        skills[config.trait] += answer * config.weight;
      }
    });

    return skills;
  }

  static generateComprehensiveTraits(
    personality,
    interests,
    values,
    skills,
    mbtiType
  ) {
    const traits = [];

    // Extraversion vs Introversion (combine personality and interests)
    const extraversionScore =
      ((personality.extraversion || 0) +
        (personality.communication || 0) +
        (interests.social_interest || 0) +
        (skills.networking_skill || 0) +
        (skills.presentation_skill || 0)) /
      5;

    const introversionScore =
      ((personality.introversion || 0) +
        (values.independence_value || 0) +
        (interests.scientific_interest || 0)) /
      3;

    const extraversionPercentage = Math.round(
      (extraversionScore / (extraversionScore + introversionScore)) * 100
    );

    traits.push({
      name: "Extraversion",
      opposite: "Introversion",
      percentage: extraversionPercentage,
      description:
        extraversionPercentage > 50
          ? "You gain energy from social interactions"
          : "You prefer quieter, more focused environments",
    });

    // Analytical vs Creative Thinking
    const analyticalScore =
      ((skills.analytical_skill || 0) +
        (skills.mathematical_skill || 0) +
        (interests.scientific_interest || 0) +
        (interests.technology_interest || 0)) /
      4;

    const creativeScore =
      ((personality.creativity || 0) +
        (interests.creative_interest || 0) +
        (skills.artistic_skill || 0)) /
      3;

    const analyticalPercentage = Math.round(
      (analyticalScore / (analyticalScore + creativeScore)) * 100
    );

    traits.push({
      name: "Analytical",
      opposite: "Creative",
      percentage: analyticalPercentage,
      description:
        analyticalPercentage > 50
          ? "You excel at logical problem-solving"
          : "You thrive on creative expression and innovation",
    });

    // Leadership vs Team Player
    const leadershipScore =
      ((personality.leadership || 0) +
        (personality.communication || 0) +
        (values.advancement_value || 0) +
        (skills.presentation_skill || 0)) /
      4;

    const teamPlayerScore =
      ((values.collaboration_value || 0) +
        (skills.mediation_skill || 0) +
        (values.helping_value || 0)) /
      3;

    const leadershipPercentage = Math.round(
      (leadershipScore / (leadershipScore + teamPlayerScore)) * 100
    );

    traits.push({
      name: "Leadership",
      opposite: "Team Player",
      percentage: leadershipPercentage,
      description:
        leadershipPercentage > 50
          ? "You naturally take charge and guide others"
          : "You excel at collaboration and supporting team goals",
    });

    // Detail-Oriented vs Big Picture
    const detailScore =
      ((personality.attention_to_detail || 0) +
        (values.structure_value || 0) +
        (skills.organization_skill || 0)) /
      3;

    const bigPictureScore =
      ((interests.strategic_interest || 0) +
        (interests.business_interest || 0) +
        (values.impact_value || 0)) /
      3;

    const detailPercentage = Math.round(
      (detailScore / (detailScore + bigPictureScore)) * 100
    );

    traits.push({
      name: "Detail-Oriented",
      opposite: "Big Picture",
      percentage: detailPercentage,
      description:
        detailPercentage > 50
          ? "You focus on precision and thoroughness"
          : "You see the broader vision and strategic overview",
    });

    // Stability vs Adaptability
    const stabilityScore =
      ((values.security_value || 0) + (values.structure_value || 0)) / 2;

    const adaptabilityScore =
      ((personality.adaptability || 0) +
        (personality.risk_taking || 0) +
        (values.flexibility_value || 0)) /
      3;

    const stabilityPercentage = Math.round(
      (stabilityScore / (stabilityScore + adaptabilityScore)) * 100
    );

    traits.push({
      name: "Stability-Seeking",
      opposite: "Adaptable",
      percentage: stabilityPercentage,
      description:
        stabilityPercentage > 50
          ? "You value consistency and predictable environments"
          : "You thrive in dynamic, changing situations",
    });

    return traits;
  }

  static renderTraits(traits) {
    const traitsContainer = document.getElementById("traits-container");
    if (!traitsContainer || !traits) return;

    traitsContainer.innerHTML = "";

    traits.forEach((trait) => {
      const traitHtml = `
        <div class="trait-item bg-gray-50 rounded-xl p-4 border border-gray-200 mb-4">
          <div class="flex justify-between items-center mb-2">
            <span class="font-semibold text-gray-800">${trait.name}</span>
            <span class="text-sm font-bold text-lime">${trait.percentage}%</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-3">
            <div class="bg-lime h-3 rounded-full transition-all duration-500" style="width: ${trait.percentage}%"></div>
          </div>
          <div class="flex justify-between text-xs text-gray-500 mt-2">
            <span class="font-medium">${trait.name}</span>
            <span class="font-medium">${trait.opposite}</span>
          </div>
          <p class="text-xs text-gray-600 mt-2 italic">${trait.description}</p>
        </div>
      `;
      traitsContainer.innerHTML += traitHtml;
    });

    console.log("[PersonalityRenderer] Rendered comprehensive traits:", traits);
  }

  static updatePersonalityDescription(traits, mbtiType) {
    const descriptionContainer = document.querySelector(
      "#Personality-Traits .space-y-6"
    );
    if (!descriptionContainer) return;

    // Generate dynamic description based on traits
    const dominantTraits = traits.filter((trait) => trait.percentage > 60);
    const balancedTraits = traits.filter(
      (trait) => trait.percentage >= 40 && trait.percentage <= 60
    );

    let description = `<p>Based on your comprehensive assessment across personality, interests, values, and skills, your ${mbtiType} profile reveals a unique blend of characteristics that shape your career preferences and work style.</p>`;

    if (dominantTraits.length > 0) {
      description += `<p>You show strong tendencies toward being <strong>${dominantTraits
        .map((t) => t.name.toLowerCase())
        .join(
          ", "
        )}</strong>. This suggests you thrive in environments that allow you to leverage these dominant traits effectively.</p>`;
    }

    if (balancedTraits.length > 0) {
      description += `<p>You demonstrate balanced approaches to <strong>${balancedTraits
        .map((t) => `${t.name.toLowerCase()} vs ${t.opposite.toLowerCase()}`)
        .join(
          ", "
        )}</strong>, indicating versatility and adaptability in various work situations.</p>`;
    }

    description += `<p>This comprehensive analysis of your responses across all assessment areas provides a more accurate foundation for career recommendations that align with your authentic self and professional aspirations.</p>`;

    descriptionContainer.innerHTML = description;
  }

  static getMBTIDisplay(mbtiType) {
    const mbtiDescriptions = {
      INTJ: "INTJ - The Architect",
      INTP: "INTP - The Thinker",
      ENTJ: "ENTJ - The Commander",
      ENTP: "ENTP - The Debater",
      INFJ: "INFJ - The Advocate",
      INFP: "INFP - The Mediator",
      ENFJ: "ENFJ - The Protagonist",
      ENFP: "ENFP - The Campaigner",
      ISTJ: "ISTJ - The Logistician",
      ISFJ: "ISFJ - The Protector",
      ESTJ: "ESTJ - The Executive",
      ESFJ: "ESFJ - The Consul",
      ISTP: "ISTP - The Virtuoso",
      ISFP: "ISFP - The Adventurer",
      ESTP: "ESTP - The Entrepreneur",
      ESFP: "ESFP - The Entertainer",
    };

    return mbtiDescriptions[mbtiType] || `${mbtiType} - Personality Type`;
  }
}
