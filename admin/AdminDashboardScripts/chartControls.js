// Chart toggle controls and UI interactions
class ChartControls {
  constructor(chartManager) {
    this.chartManager = chartManager;
    this.initializeControls();
  }

  initializeControls() {
    this.setupCareerDistributionControls();
    this.setupSelectedCareersControls();
  }

  setupCareerDistributionControls() {
    const barChartBtn = document.getElementById("barChartBtn");
    const pieChartBtn = document.getElementById("pieChartBtn");

    if (barChartBtn && pieChartBtn) {
      barChartBtn.addEventListener("click", () => {
        this.chartManager.createBarChart();
        this.toggleButtonState(barChartBtn, pieChartBtn);
      });

      pieChartBtn.addEventListener("click", () => {
        this.chartManager.createPieChart();
        this.toggleButtonState(pieChartBtn, barChartBtn);
      });
    }
  }

  setupSelectedCareersControls() {
    const selectedBarBtn = document.getElementById("selectedBarBtn");
    const selectedDoughnutBtn = document.getElementById("selectedDoughnutBtn");

    if (selectedBarBtn && selectedDoughnutBtn) {
      selectedBarBtn.addEventListener("click", () => {
        this.chartManager.createSelectedBarChart();
        this.toggleButtonState(selectedBarBtn, selectedDoughnutBtn);
      });

      selectedDoughnutBtn.addEventListener("click", () => {
        this.chartManager.createSelectedDoughnutChart();
        this.toggleButtonState(selectedDoughnutBtn, selectedBarBtn);
      });
    }
  }

  toggleButtonState(activeBtn, inactiveBtn) {
    // Activate selected button
    activeBtn.classList.add("bg-blue-500", "text-white");
    activeBtn.classList.remove("text-gray-600");

    // Deactivate other button
    inactiveBtn.classList.remove("bg-blue-500", "text-white");
    inactiveBtn.classList.add("text-gray-600");
  }
}

// Export for use in other modules
window.ChartControls = ChartControls;
