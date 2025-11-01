<?php
require_once 'auth.php';
require_once 'dashboardStats.php';
require_once 'userStats.php';

// Initialize dashboard
$conn = initializeDashboard();

// Pagination setup
$users_per_page = 10;
$current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Initialize dashboard statistics
$dashboardStats = new DashboardStats($conn);
$userStats = new UserStats($conn);

// Get all dashboard data
$stats = $dashboardStats->getStatsSummary();
$chart_data = $dashboardStats->getChartData();
$recent_users = $userStats->getUsersForPage($current_page, $users_per_page);
$total_pages = $userStats->getTotalPages($users_per_page);
$total_users = $userStats->getTotalUsers();

// Get user selections data
$user_selections_data = $dashboardStats->getUserSelectionsData();

// Extract chart data for backward compatibility
$career_labels = $chart_data['career_distribution']['labels'];
$career_counts = $chart_data['career_distribution']['counts'];
$full_career_names = $chart_data['career_distribution']['fullNames']; // NEW

$selected_career_labels = $chart_data['selected_careers']['labels'];
$selected_career_counts = $chart_data['selected_careers']['counts'];
$full_selected_career_names = $chart_data['selected_careers']['fullNames']; // NEW

$monthly_labels = $chart_data['monthly_trend']['labels'];
$monthly_counts = $chart_data['monthly_trend']['counts'];

// Extract user selected careers data
$user_selected_career_labels = $chart_data['user_selected_careers']['labels'] ?? [];
$user_selected_career_counts = $chart_data['user_selected_careers']['counts'] ?? [];
$full_user_selected_career_names = $chart_data['user_selected_careers']['fullNames'] ?? []; // NEW

$recent_user_selections = $user_selections_data['recent_selections'];

// Sample courses data (keep as is for now)
$courses = [
    ['course' => 'Digital Marketing', 'student' => 'Aria', 'id' => '#3456791', 'amount' => '$372.00', 'status' => 'Paid'],
    ['course' => 'Web Development', 'student' => 'John', 'id' => '#3456792', 'amount' => '$450.00', 'status' => 'Pending'],
    ['course' => 'UI/UX Design', 'student' => 'Sarah', 'id' => '#3456793', 'amount' => '$320.00', 'status' => 'Paid'],
];
?>