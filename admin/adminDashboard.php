<?php
include "AdminDashboardFunctions/adminDashboardFunctions.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerPath Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <link rel="icon" type="image/png" href="../Assets/Images/logo.png">
</head>

<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">

        <!-- Main Content -->
        <main class="flex-1 overflow-auto">
            <!-- Header -->
            <?php include_once 'AdminDashboardComponents/adminHeader.php'; ?>

            <!-- Dashboard Content -->
            <div class="p-4 sm:p-6 lg:p-8">
                <!-- Stats Grid -->
                <?php include_once 'AdminDashboardComponents/adminStats.php'; ?>

                <!-- Charts and User List Row -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Career Distribution Chart -->
                    <?php include_once 'AdminDashboardComponents/careerDistributionChart.php'; ?>

                    <!-- User List Widget -->
                    <?php include_once 'AdminDashboardComponents/adminUserList.php'; ?>
                </div>

                <!-- User Selected Careers Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- User Selected Careers Chart and Recent Selections -->
                    <?php include_once 'AdminDashboardComponents/userSelectedCareers.php'; ?>
                </div>

                <!-- Selected Careers Analytics Row -->
                <div class="grid grid-cols-1 lg:grid-cols-1 gap-6 mb-6">
                    <!-- Career Trends Over Time -->
                    <?php include_once 'AdminDashboardComponents/careerTrendsChart.php'; ?>
                </div>

                
            </div>
        </main>
    </div>

    <!-- Include Logout Modal -->
    <?php include_once '../Assets/Components/logoutModal.php'; ?>

    <script>
        window.careerLabels = <?php echo json_encode($career_labels); ?>;
        window.careerCounts = <?php echo json_encode($career_counts); ?>;
        window.fullCareerNames = <?php echo json_encode($full_career_names ?? []); ?>;
        
        window.selectedCareerLabels = <?php echo json_encode($selected_career_labels); ?>;
        window.selectedCareerCounts = <?php echo json_encode($selected_career_counts); ?>;
        window.fullSelectedCareerNames = <?php echo json_encode($full_selected_career_names ?? []); ?>;
        
        window.monthlyLabels = <?php echo json_encode($monthly_labels); ?>;
        window.monthlyCounts = <?php echo json_encode($monthly_counts); ?>;
        
        // User selected careers data
        window.userSelectedCareerLabels = <?php echo json_encode($user_selected_career_labels); ?>;
        window.userSelectedCareerCounts = <?php echo json_encode($user_selected_career_counts); ?>;
        window.fullUserSelectedCareerNames = <?php echo json_encode($full_user_selected_career_names ?? []); ?>;
    </script>

    <!-- Load modules in order -->
    <script src="./AdminDashboardScripts/chartData.js"></script>
    <script src="./AdminDashboardScripts/chartManager.js"></script>
    <script src="./AdminDashboardScripts/chartControls.js"></script>
    <script src="./AdminDashboardScripts/profileDropdown.js"></script>
    <script src="./AdminDashboardScripts/logoutModal.js"></script>
    <script src="./AdminDashboardScripts/adminDashboardScripts.js"></script>
</body>

</html>