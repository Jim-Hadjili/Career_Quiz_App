// Chart creation and management functionality
class ChartManager {
  constructor(dataManager) {
    this.dataManager = dataManager;
    this.currentChart = null;
    this.selectedCareersChart = null;
    this.trendsChart = null;

    // Canvas contexts
    this.careerCtx = document.getElementById("careerChart");
    this.selectedCtx = document.getElementById("selectedCareersChart");
    this.trendsCtx = document.getElementById("careerTrendsChart");
  }

  // Career Distribution Charts
  createBarChart() {
    if (this.currentChart) {
      this.currentChart.destroy();
    }

    const data = this.dataManager.getCareerDistributionData();

    this.currentChart = new Chart(this.careerCtx, {
      type: "bar",
      data: {
        labels: data.labels,
        datasets: [
          {
            label: "Quiz Results",
            data: data.counts,
            backgroundColor: data.colors,
            borderRadius: 8,
            barThickness: 40,
          },
        ],
      },
      options: this.getBarChartOptions(),
    });
  }

  createPieChart() {
    if (this.currentChart) {
      this.currentChart.destroy();
    }

    const data = this.dataManager.getCareerDistributionData();

    this.currentChart = new Chart(this.careerCtx, {
      type: "pie",
      data: {
        labels: data.labels,
        datasets: [
          {
            data: data.counts,
            backgroundColor: data.colors,
            borderWidth: 2,
            borderColor: "#ffffff",
          },
        ],
      },
      options: this.getPieChartOptions(),
    });
  }

  // Selected Careers Charts
  createSelectedBarChart() {
    if (this.selectedCareersChart) {
      this.selectedCareersChart.destroy();
    }

    const data = this.dataManager.getSelectedCareersData();

    this.selectedCareersChart = new Chart(this.selectedCtx, {
      type: "bar",
      data: {
        labels: data.labels,
        datasets: [
          {
            label: "Times Selected",
            data: data.counts,
            backgroundColor: data.colors,
            borderRadius: 8,
            barThickness: 30,
          },
        ],
      },
      options: this.getSelectedBarChartOptions(),
    });
  }

  createSelectedDoughnutChart() {
    if (this.selectedCareersChart) {
      this.selectedCareersChart.destroy();
    }

    const data = this.dataManager.getSelectedCareersData();

    this.selectedCareersChart = new Chart(this.selectedCtx, {
      type: "doughnut",
      data: {
        labels: data.labels,
        datasets: [
          {
            data: data.counts,
            backgroundColor: data.colors,
            borderWidth: 2,
            borderColor: "#ffffff",
          },
        ],
      },
      options: this.getDoughnutChartOptions(),
    });
  }

  // Trends Chart
  createTrendsChart() {
    const data = this.dataManager.getMonthlyTrendsData();

    this.trendsChart = new Chart(this.trendsCtx, {
      type: "line",
      data: {
        labels: data.labels,
        datasets: [
          {
            label: "Quiz Completions",
            data: data.counts,
            borderColor: "#3B82F6",
            backgroundColor: "#3B82F610",
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: "#3B82F6",
            pointBorderColor: "#ffffff",
            pointBorderWidth: 2,
            pointRadius: 6,
          },
        ],
      },
      options: this.getLineChartOptions(),
    });
  }

  // Chart Options
  getBarChartOptions() {
    return {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1,
            callback: function (value) {
              return Math.floor(value);
            },
          },
          grid: { color: "#f3f4f6" },
        },
        x: {
          display: false,
          grid: { display: false },
        },
      },
    };
  }

  getPieChartOptions() {
    return {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: "right",
          labels: {
            boxWidth: 12,
            padding: 20,
            font: { size: 12 },
          },
        },
      },
    };
  }

  getSelectedBarChartOptions() {
    return {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1,
            callback: function (value) {
              return Math.floor(value);
            },
          },
          grid: { color: "#f3f4f6" },
        },
        x: {
          ticks: {
            maxRotation: 45,
            font: { size: 10 },
          },
        },
      },
    };
  }

  getDoughnutChartOptions() {
    return {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: "right",
          labels: {
            boxWidth: 12,
            padding: 15,
            font: { size: 11 },
          },
        },
      },
    };
  }

  getLineChartOptions() {
    return {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1,
            callback: function (value) {
              return Math.floor(value);
            },
          },
          grid: { color: "#f3f4f6" },
        },
        x: {
          grid: { display: false },
        },
      },
    };
  }

  // Initialize all charts
  initializeCharts() {
    if (this.careerCtx) {
      this.createBarChart();
    }
    if (this.selectedCtx) {
      this.createSelectedBarChart();
    }
    if (this.trendsCtx) {
      this.createTrendsChart();
    }
  }
}

// Export for use in other modules
window.ChartManager = ChartManager;
