<?php
session_start();

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || strtolower($_SESSION['user_role']) !== 'admin') {
    header('Location: ../index.php');
    exit;
}

// Include database connection
require_once '../Config/Connection/conn.php';

// Pagination for user list
$users_per_page = 10;
$current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($current_page - 1) * $users_per_page;

// Fetch Total Users (excluding admins)
$total_users_query = "SELECT COUNT(*) as total FROM users_tb WHERE userRole IS NULL OR userRole != 'Admin'";
$total_users_result = $conn->query($total_users_query);
$total_users = $total_users_result->fetch_assoc()['total'];

// Calculate total pages for pagination
$total_pages = ceil($total_users / $users_per_page);

// Fetch New Users (last 7 days, excluding admins) - using registration_date
$new_users_query = "SELECT COUNT(*) as new_users FROM users_tb WHERE (userRole IS NULL OR userRole != 'Admin') AND registration_date >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
$new_users_result = $conn->query($new_users_query);
$new_users = $new_users_result->fetch_assoc()['new_users'];

// Fetch Results Generated
$results_query = "SELECT COUNT(*) as total_results FROM quiz_results_tb";
$results_result = $conn->query($results_query);
$total_results = $results_result->fetch_assoc()['total_results'];

// Fetch Popular Career (most recommended career from quiz results)
$popular_career_query = "
    SELECT recommended_careers, COUNT(*) as count 
    FROM quiz_results_tb 
    WHERE recommended_careers IS NOT NULL 
    GROUP BY recommended_careers 
    ORDER BY count DESC 
    LIMIT 1
";
$popular_career_result = $conn->query($popular_career_query);
$popular_career = "Data Scientist"; // Default
if ($popular_career_result && $popular_career_result->num_rows > 0) {
    $career_data = $popular_career_result->fetch_assoc();
    // Extract first career from JSON data (simplified approach)
    $career_json = json_decode($career_data['recommended_careers'], true);
    if (isset($career_json['recommended_careers'][0]['title'])) {
        $career_title = $career_json['recommended_careers'][0]['title'];
        // Remove character limit to show full career name
        $popular_career = $career_title;
    }
    $career_percentage = round(($career_data['count'] / $total_results) * 100);
} else {
    $career_percentage = 34;
}

// Fetch career distribution data for charts
$career_distribution_query = "
    SELECT recommended_careers 
    FROM quiz_results_tb 
    WHERE recommended_careers IS NOT NULL
";
$career_distribution_result = $conn->query($career_distribution_query);
$career_counts_array = [];

if ($career_distribution_result && $career_distribution_result->num_rows > 0) {
    while ($row = $career_distribution_result->fetch_assoc()) {
        $career_json = json_decode($row['recommended_careers'], true);
        if (isset($career_json['recommended_careers']) && is_array($career_json['recommended_careers'])) {
            // Loop through all recommended careers in each result
            foreach ($career_json['recommended_careers'] as $career) {
                if (isset($career['title'])) {
                    $career_title = $career['title'];
                    // Count occurrences of each career
                    if (isset($career_counts_array[$career_title])) {
                        $career_counts_array[$career_title]++;
                    } else {
                        $career_counts_array[$career_title] = 1;
                    }
                }
            }
        }
    }
    
    // Sort by count descending and limit to top 6
    arsort($career_counts_array);
    $career_counts_array = array_slice($career_counts_array, 0, 6, true);
    
    // Prepare data for charts
    $career_labels = [];
    $career_counts = [];
    
    foreach ($career_counts_array as $title => $count) {
        // Truncate long titles for better display
        $career_labels[] = strlen($title) > 15 ? substr($title, 0, 15) . '...' : $title;
        $career_counts[] = $count;
    }
} else {
    // Default data if no results
    $career_labels = ['Data Science', 'Software Dev', 'Engineering', 'Business', 'Healthcare', 'Education'];
    $career_counts = [12, 8, 6, 4, 3, 2];
}

// Update Popular Career calculation to use the aggregated data
if (!empty($career_counts_array)) {
    $most_popular = array_keys($career_counts_array)[0]; // First key after sorting
    $popular_career = strlen($most_popular) > 15 ? substr($most_popular, 0, 15) . '...' : $most_popular;
    $career_percentage = round(($career_counts_array[$most_popular] / array_sum($career_counts_array)) * 100);
} else {
    $popular_career = "Data Scientist";
    $career_percentage = 34;
}

// Fetch users for the current page (excluding admins) - updated with pagination
$recent_users_query = "SELECT userName, userEmail FROM users_tb WHERE (userRole IS NULL OR userRole != 'Admin') ORDER BY user_id DESC LIMIT $users_per_page OFFSET $offset";
$recent_users_result = $conn->query($recent_users_query);
$recent_users = [];
if ($recent_users_result && $recent_users_result->num_rows > 0) {
    while ($row = $recent_users_result->fetch_assoc()) {
        $recent_users[] = $row;
    }
}

// Calculate growth percentages (mock calculations based on current vs previous period)
$total_users_growth = "up 1.2% from last month";
$new_users_growth = "up " . ($new_users > 0 ? round(($new_users / max($total_users - $new_users, 1)) * 100, 1) : 0) . "% this week";
$results_growth = "up 5.1% from last month";
$popular_career_growth = $career_percentage . "% of all results";

// Updated stats array with real data
$stats = [
    ['title' => 'Total Users', 'value' => number_format($total_users), 'change' => $total_users_growth, 'icon' => 'fa-users'],
    ['title' => 'New Users', 'value' => number_format($new_users), 'change' => $new_users_growth, 'icon' => 'fa-user-plus'],
    ['title' => 'Results Generated', 'value' => number_format($total_results), 'change' => $results_growth, 'icon' => 'fa-chart-bar'],
    ['title' => 'Popular Career', 'value' => $popular_career, 'change' => $popular_career_growth, 'icon' => 'fa-star']
];

$courses = [
    ['course' => 'Digital Marketing', 'student' => 'Aria', 'id' => '#3456791', 'amount' => '$372.00', 'status' => 'Paid'],
    ['course' => 'Web Development', 'student' => 'John', 'id' => '#3456792', 'amount' => '$450.00', 'status' => 'Pending'],
    ['course' => 'UI/UX Design', 'student' => 'Sarah', 'id' => '#3456793', 'amount' => '$320.00', 'status' => 'Paid'],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Skillset</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
       
        <!-- Main Content -->
        <main class="flex-1 overflow-auto">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b sticky top-0 z-10">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <h2 class="text-2xl font-bold text-gray-900">CareerPath Dashboard</h2>
                        <div class="flex items-center gap-4">
                            <!-- Admin Profile -->
                            <div class="relative" id="profile-dropdown">
                                <button 
                                    onclick="toggleProfileDropdown()"
                                    class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                >
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-blue-600 text-sm"></i>
                                    </div>
                                    <div class="hidden sm:block text-left">
                                        <p class="text-sm font-medium text-gray-900"><?php echo $_SESSION['user_name'] ?? 'Admin User'; ?></p>
                                        <p class="text-xs text-gray-500"><?php echo ucfirst($_SESSION['user_role'] ?? 'admin'); ?></p>
                                    </div>
                                    <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                                </button>

                                <!-- Dropdown Menu -->
                                <div id="dropdown-menu" class="absolute right-0 top-full mt-2 w-64 bg-white rounded-lg shadow-lg border border-gray-200 z-50 hidden">
                                    <div class="p-4 border-b border-gray-200">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-blue-600"></i>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900"><?php echo $_SESSION['user_name'] ?? 'Admin User'; ?></p>
                                                <p class="text-sm text-gray-500"><?php echo $_SESSION['user_email'] ?? 'admin@example.com'; ?></p>
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mt-1">
                                                    <i class="fas fa-shield-alt mr-1"></i>
                                                    <?php echo ucfirst($_SESSION['user_role'] ?? 'Admin'); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="p-2">
                                        <button 
                                            onclick="showLogoutModal()"
                                            class="w-full flex items-center gap-3 px-3 py-2 text-left text-red-600 hover:bg-red-50 rounded-lg transition-colors group"
                                        >
                                            <i class="fas fa-sign-out-alt text-red-500 group-hover:text-red-600"></i>
                                            <span class="font-medium">Logout</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Notifications -->
                            <button class="relative p-2 text-gray-400 hover:text-gray-600 rounded-lg">
                                <i class="fas fa-bell text-lg"></i>
                                <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-4 sm:p-6 lg:p-8">
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <?php foreach ($stats as $stat): ?>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 min-w-0">
                                <p class="text-gray-600 text-sm font-medium"><?php echo $stat['title']; ?></p>
                                <p class="text-2xl font-bold text-gray-900 mt-2 <?php echo ($stat['title'] === 'Popular Career') ? 'text-lg break-words' : ''; ?>"><?php echo $stat['value']; ?></p>
                                <p class="text-xs text-gray-500 mt-2"><?php echo $stat['change']; ?></p>
                            </div>
                            <div class="text-2xl text-blue-400 flex-shrink-0 ml-3">
                                <i class="fas <?php echo $stat['icon']; ?>"></i>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Charts and User List Row -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Career Distribution Chart -->
                    <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-gray-900">Career Distribution</h3>
                            <div class="flex items-center gap-2">
                                <!-- Chart Type Toggle -->
                                <div class="flex bg-gray-100 rounded-lg p-1">
                                    <button id="barChartBtn" class="px-3 py-1 text-xs font-medium rounded-md bg-blue-500 text-white transition-colors">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Bar
                                    </button>
                                    <button id="pieChartBtn" class="px-3 py-1 text-xs font-medium rounded-md text-gray-600 hover:text-gray-800 transition-colors">
                                        <i class="fas fa-chart-pie mr-1"></i>
                                        Pie
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="relative h-64">
                            <canvas id="careerChart"></canvas>
                        </div>
                    </div>

                    <!-- User List Widget -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-gray-900">Recent Users</h3>
                            <?php if ($total_users > 10): ?>
                            <div class="text-xs text-gray-500">
                                Page <?php echo $current_page; ?> of <?php echo $total_pages; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- User List -->
                        <div class="space-y-4 mb-6">
                            <?php if (!empty($recent_users)): ?>
                                <?php foreach ($recent_users as $user): ?>
                                    <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-user text-blue-600 text-sm"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">
                                                <?php echo htmlspecialchars($user['userName']); ?>
                                            </p>
                                            <p class="text-xs text-gray-500 truncate">
                                                <?php echo htmlspecialchars($user['userEmail']); ?>
                                            </p>
                                        </div>
                                        <div class="w-2 h-2 bg-green-400 rounded-full flex-shrink-0"></div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center py-8">
                                    <i class="fas fa-users text-gray-300 text-3xl mb-3"></i>
                                    <p class="text-gray-500 text-sm">No users found</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Pagination - Only show if more than 10 users -->
                        <?php if ($total_users > 10 && $total_pages > 1): ?>
                        <div class="border-t pt-4">
                            <div class="flex items-center justify-between">
                                <!-- Previous Button -->
                                <?php if ($current_page > 1): ?>
                                    <a href="?page=<?php echo $current_page - 1; ?>" 
                                       class="flex items-center px-3 py-2 text-xs font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-700 transition-colors">
                                        <i class="fas fa-chevron-left mr-1"></i>
                                        Previous
                                    </a>
                                <?php else: ?>
                                    <button disabled class="flex items-center px-3 py-2 text-xs font-medium text-gray-300 bg-gray-100 border border-gray-200 rounded-md cursor-not-allowed">
                                        <i class="fas fa-chevron-left mr-1"></i>
                                        Previous
                                    </button>
                                <?php endif; ?>

                                <!-- Page Numbers -->
                                <div class="flex items-center space-x-1">
                                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                        <?php if ($i == $current_page): ?>
                                            <span class="px-3 py-2 text-xs font-medium text-white bg-blue-500 rounded-md">
                                                <?php echo $i; ?>
                                            </span>
                                        <?php else: ?>
                                            <a href="?page=<?php echo $i; ?>" 
                                               class="px-3 py-2 text-xs font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-700 transition-colors">
                                                <?php echo $i; ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>

                                <!-- Next Button -->
                                <?php if ($current_page < $total_pages): ?>
                                    <a href="?page=<?php echo $current_page + 1; ?>" 
                                       class="flex items-center px-3 py-2 text-xs font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:text-gray-700 transition-colors">
                                        Next
                                        <i class="fas fa-chevron-right ml-1"></i>
                                    </a>
                                <?php else: ?>
                                    <button disabled class="flex items-center px-3 py-2 text-xs font-medium text-gray-300 bg-gray-100 border border-gray-200 rounded-md cursor-not-allowed">
                                        Next
                                        <i class="fas fa-chevron-right ml-1"></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
        </main>
    </div>

    <!-- Include Logout Modal -->
    <?php include_once '../Assets/Components/logoutModal.php'; ?>

    <script>
        // Chart data from PHP
        const careerLabels = <?php echo json_encode($career_labels); ?>;
        const careerCounts = <?php echo json_encode($career_counts); ?>;
        // Updated to light colors
        const careerColors = ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#06B6D4'];

        let currentChart = null;
        const ctx = document.getElementById('careerChart');

        // Create Bar Chart
        function createBarChart() {
            if (currentChart) {
                currentChart.destroy();
            }
            
            currentChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: careerLabels,
                    datasets: [{
                        label: 'Quiz Results',
                        data: careerCounts,
                        backgroundColor: careerColors.slice(0, careerLabels.length),
                        borderRadius: 8,
                        barThickness: 40
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                callback: function(value) {
                                    return Math.floor(value);
                                }
                            },
                            grid: {
                                color: '#f3f4f6'
                            }
                        },
                        x: {
                            display: false,
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        // Create Pie Chart
        function createPieChart() {
            if (currentChart) {
                currentChart.destroy();
            }
            
            // Use full career names from PHP for tooltips
            const fullCareerNames = <?php echo json_encode(array_keys($career_counts_array)); ?>;
            
            currentChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: careerLabels,
                    datasets: [{
                        data: careerCounts,
                        backgroundColor: careerColors.slice(0, careerLabels.length),
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                boxWidth: 12,
                                padding: 20,
                                font: {
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                title: function(context) {
                                    return fullCareerNames[context[0].dataIndex];
                                }
                            }
                        }
                    }
                }
            });
        }

        // Toggle functionality
        const barChartBtn = document.getElementById('barChartBtn');
        const pieChartBtn = document.getElementById('pieChartBtn');

        barChartBtn.addEventListener('click', () => {
            createBarChart();
            barChartBtn.classList.add('bg-blue-500', 'text-white');
            barChartBtn.classList.remove('text-gray-600');
            pieChartBtn.classList.remove('bg-blue-500', 'text-white');
            pieChartBtn.classList.add('text-gray-600');
        });

        pieChartBtn.addEventListener('click', () => {
            createPieChart();
            pieChartBtn.classList.add('bg-blue-500', 'text-white');
            pieChartBtn.classList.remove('text-gray-600');
            barChartBtn.classList.remove('bg-blue-500', 'text-white');
            barChartBtn.classList.add('text-gray-600');
        });

        // Initialize with bar chart
        if (ctx) {
            createBarChart();
        }

        // Profile dropdown functions
        function toggleProfileDropdown() {
            const dropdown = document.getElementById('dropdown-menu');
            if (dropdown) {
                dropdown.classList.toggle('hidden');
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const profileDropdown = document.getElementById('profile-dropdown');
            const dropdownMenu = document.getElementById('dropdown-menu');
            
            if (profileDropdown && dropdownMenu && !profileDropdown.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        // Logout Modal Functions (adapted for admin dashboard)
        function showLogoutModal() {
            const modal = document.getElementById('logout-modal');
            const modalContent = document.getElementById('logout-modal-content');

            // Close profile dropdown if open
            const profileDropdown = document.getElementById('dropdown-menu');
            if (profileDropdown && !profileDropdown.classList.contains('hidden')) {
                profileDropdown.classList.add('hidden');
            }

            // Show modal
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeLogoutModal() {
            const modal = document.getElementById('logout-modal');
            const modalContent = document.getElementById('logout-modal-content');

            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }, 300);
        }

        // Handle logout confirmation
        async function confirmLogout() {
            const confirmButton = document.getElementById('confirm-logout');
            const originalText = confirmButton.innerHTML;

            // Show loading state
            confirmButton.disabled = true;
            confirmButton.innerHTML = `
                <div class="relative z-10 flex items-center gap-2">
                    <i class="fas fa-spinner fa-spin"></i>
                    Logging out...
                </div>
            `;

            try {
                const response = await fetch('../Config/Auth/auth_handler.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ action: 'logout' }),
                });

                const data = await response.json();

                if (data.success) {
                    // Show success message briefly
                    confirmButton.innerHTML = `
                        <div class="relative z-10 flex items-center gap-2">
                            <i class="fas fa-check"></i>
                            Logged out!
                        </div>
                    `;

                    // Close modal and redirect after short delay
                    setTimeout(() => {
                        closeLogoutModal();
                        window.location.href = '../index.php';
                    }, 1000);
                } else {
                    throw new Error(data.message || 'Logout failed');
                }
            } catch (error) {
                console.error('Logout error:', error);

                // Show error state
                confirmButton.innerHTML = `
                    <div class="relative z-10 flex items-center gap-2">
                        <i class="fas fa-exclamation-triangle"></i>
                        Error occurred
                    </div>
                `;

                // Reset button after delay
                setTimeout(() => {
                    confirmButton.disabled = false;
                    confirmButton.innerHTML = originalText;
                }, 2000);
            }
        }

        // Initialize logout modal event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Close logout modal button
            const closeLogoutButton = document.getElementById('close-logout-modal');
            if (closeLogoutButton) {
                closeLogoutButton.addEventListener('click', closeLogoutModal);
            }

            // Cancel logout button
            const cancelLogoutButton = document.getElementById('cancel-logout');
            if (cancelLogoutButton) {
                cancelLogoutButton.addEventListener('click', closeLogoutModal);
            }

            // Confirm logout button
            const confirmLogoutButton = document.getElementById('confirm-logout');
            if (confirmLogoutButton) {
                confirmLogoutButton.addEventListener('click', confirmLogout);
            }

            // Close modal when clicking outside
            const logoutModal = document.getElementById('logout-modal');
            if (logoutModal) {
                logoutModal.addEventListener('click', function(e) {
                    if (e.target === logoutModal) {
                        closeLogoutModal();
                    }
                });
            }

            // ESC key to close logout modal
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const modal = document.getElementById('logout-modal');
                    if (modal && !modal.classList.contains('hidden')) {
                        closeLogoutModal();
                    }
                }
            });
        });
    </script>
</body>
</html>
