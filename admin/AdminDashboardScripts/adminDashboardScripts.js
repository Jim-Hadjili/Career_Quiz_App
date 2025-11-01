// Main dashboard initialization script
document.addEventListener("DOMContentLoaded", function () {
  // Initialize data manager with PHP data
  const dataManager = new ChartDataManager();

  // Initialize chart manager
  const chartManager = new ChartManager(dataManager);

  // Initialize chart controls
  const chartControls = new ChartControls(chartManager);

  // Initialize profile dropdown
  const profileDropdown = new ProfileDropdown();

  // Initialize logout modal
  const logoutModal = new LogoutModal();

  // Initialize all charts
  chartManager.initializeCharts();
});
