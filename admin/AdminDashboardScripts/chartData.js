// Chart data configuration and initialization
class ChartDataManager {
  constructor() {
    // Chart data from PHP - these will be injected by the main page
    this.careerLabels = window.careerLabels || [];
    this.careerCounts = window.careerCounts || [];
    this.selectedCareerLabels = window.selectedCareerLabels || [];
    this.selectedCareerCounts = window.selectedCareerCounts || [];
    this.monthlyLabels = window.monthlyLabels || [];
    this.monthlyCounts = window.monthlyCounts || [];
    // NEW: User selected careers data
    this.userSelectedCareerLabels = window.userSelectedCareerLabels || [];
    this.userSelectedCareerCounts = window.userSelectedCareerCounts || [];

    // Color palette
    this.careerColors = [
      "#3B82F6",
      "#10B981",
      "#F59E0B",
      "#EF4444",
      "#8B5CF6",
      "#06B6D4",
      "#F97316",
      "#84CC16",
    ];
  }

  getCareerDistributionData() {
    return {
      labels: this.careerLabels,
      counts: this.careerCounts,
      colors: this.careerColors.slice(0, this.careerLabels.length),
    };
  }

  getSelectedCareersData() {
    return {
      labels: this.selectedCareerLabels,
      counts: this.selectedCareerCounts,
      colors: this.careerColors.slice(0, this.selectedCareerLabels.length),
    };
  }

  getMonthlyTrendsData() {
    return {
      labels: this.monthlyLabels,
      counts: this.monthlyCounts,
    };
  }

  // NEW: Get user selected careers data
  getUserSelectedCareersData() {
    return {
      labels: this.userSelectedCareerLabels,
      counts: this.userSelectedCareerCounts,
      colors: this.careerColors.slice(0, this.userSelectedCareerLabels.length),
    };
  }
}

// Export for use in other modules
window.ChartDataManager = ChartDataManager;
