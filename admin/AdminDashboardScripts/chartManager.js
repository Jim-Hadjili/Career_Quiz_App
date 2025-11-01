// Chart creation and management functionality
class ChartManager {
  constructor(dataManager) {
    this.dataManager = dataManager;
    this.currentChart = null;
    this.selectedCareersChart = null;
    this.trendsChart = null;
    this.userSelectedChart = null;

    // Canvas contexts
    this.careerCtx = document.getElementById("careerChart");
    this.selectedCtx = document.getElementById("selectedCareersChart");
    this.trendsCtx = document.getElementById("careerTrendsChart");
    this.userSelectedCtx = document.getElementById("userSelectedCareersChart");

    // Store full names for tooltips
    this.fullCareerNames = window.fullCareerNames || [];
    this.fullSelectedCareerNames = window.fullSelectedCareerNames || [];
    this.fullUserSelectedCareerNames = window.fullUserSelectedCareerNames || [];
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
      options: this.getBarChartOptions(this.fullCareerNames),
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
      options: this.getPieChartOptions(this.fullCareerNames),
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
      options: this.getSelectedBarChartOptions(this.fullSelectedCareerNames),
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
      options: this.getDoughnutChartOptions(this.fullSelectedCareerNames),
    });
  }

  // NEW: Career Trends Chart
  createTrendsChart() {
    if (this.trendsChart) {
      this.trendsChart.destroy();
    }

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
            backgroundColor: "rgba(59, 130, 246, 0.1)",
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

  // User Selected Careers Charts
  createUserSelectedBarChart() {
    if (this.userSelectedChart) {
      this.userSelectedChart.destroy();
    }

    const data = this.dataManager.getUserSelectedCareersData();

    this.userSelectedChart = new Chart(this.userSelectedCtx, {
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
      options: this.getSelectedBarChartOptions(
        this.fullUserSelectedCareerNames
      ),
    });
  }

  createUserSelectedPieChart() {
    if (this.userSelectedChart) {
      this.userSelectedChart.destroy();
    }

    const data = this.dataManager.getUserSelectedCareersData();

    this.userSelectedChart = new Chart(this.userSelectedCtx, {
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
      options: this.getPieChartOptions(this.fullUserSelectedCareerNames),
    });
  }

  // Chart Options with Full Names in Tooltips
  getBarChartOptions(fullNames = []) {
    return {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        },
        tooltip: {
          callbacks: {
            title: function (context) {
              const index = context[0].dataIndex;
              return fullNames[index] || context[0].label;
            },
            label: function (context) {
              return `Results: ${context.parsed.y}`;
            },
          },
        },
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1,
          },
        },
        x: {
          ticks: {
            display: false,
          },
        },
      },
    };
  }

  getPieChartOptions(fullNames = []) {
    return {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: "bottom",
          labels: {
            padding: 20,
            usePointStyle: true,
          },
        },
        tooltip: {
          callbacks: {
            title: function (context) {
              const index = context[0].dataIndex;
              return fullNames[index] || context[0].label;
            },
            label: function (context) {
              return `${context.parsed} Times Selected`;
            },
          },
        },
      },
    };
  }

  getSelectedBarChartOptions(fullNames = []) {
    return {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        },
        tooltip: {
          callbacks: {
            title: function (context) {
              const index = context[0].dataIndex;
              return fullNames[index] || context[0].label;
            },
            label: function (context) {
              return `Selected: ${context.parsed.y} times`;
            },
          },
        },
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1,
          },
        },
        x: {
          ticks: {
            display: false,
          },
        },
      },
    };
  }

  getDoughnutChartOptions(fullNames = []) {
    return {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: "right",
          labels: {
            padding: 15,
            usePointStyle: true,
          },
        },
        tooltip: {
          callbacks: {
            title: function (context) {
              const index = context[0].dataIndex;
              return fullNames[index] || context[0].label;
            },
            label: function (context) {
              return `${context.parsed} selections`;
            },
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
        legend: {
          display: false,
        },
        tooltip: {
          callbacks: {
            label: function (context) {
              return `Completions: ${context.parsed.y}`;
            },
          },
        },
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1,
          },
        },
        x: {
          grid: {
            display: false,
          },
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
    if (
      this.userSelectedCtx &&
      this.dataManager.userSelectedCareerLabels.length > 0
    ) {
      this.createUserSelectedBarChart();
    }
  }
}

// Export for use in other modules
window.ChartManager = ChartManager;
