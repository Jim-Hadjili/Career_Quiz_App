<?php 
include "../Functions/quizPageFunctions/quizPageFunction.php";

// Determine quiz mode and user info
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
$quizMode = $isLoggedIn ? 'user' : 'guest';
$userName = $isLoggedIn ? $_SESSION['userName'] : 'Guest User';
$userEmail = $isLoggedIn ? $_SESSION['userEmail'] : null;

// Generate session ID for guest users
if (!$isLoggedIn && !isset($_SESSION['guest_session_id'])) {
    $_SESSION['guest_session_id'] = 'guest_' . uniqid('', true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="../../Assets/Scripts/tailwindConfig.js"></script>
    <link rel="stylesheet" href="../../Assets/Styles/index.css">
    <title>Career Quiz - <?php echo $quizMode === 'user' ? 'Registered User' : 'Guest Mode'; ?></title>
</head>
<body class="min-h-screen bg-cream text-dark">
    
    <!-- Header with mode indicator -->
    <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <!-- Logo and title -->
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-lime rounded-full flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-dark"></i>
                    </div>
                    <h1 class="text-xl font-bold text-dark">Career Quiz</h1>
                </div>

                <!-- Mode indicator -->
                <div class="flex items-center space-x-4">
                    <?php if ($quizMode === 'user'): ?>
                        <div class="flex items-center space-x-2 bg-lime/20 px-3 py-1.5 rounded-full">
                            <i class="fas fa-user-check text-dark text-sm"></i>
                            <span class="text-sm font-medium text-dark"><?php echo htmlspecialchars($userName); ?></span>
                        </div>
                    <?php else: ?>
                        <div class="flex items-center space-x-2 bg-yellow-100 px-3 py-1.5 rounded-full">
                            <i class="fas fa-user-clock text-yellow-600 text-sm"></i>
                            <span class="text-sm font-medium text-yellow-700">Guest Mode</span>
                        </div>
                    <?php endif; ?>
                    
                    <button onclick="goHome()" class="text-gray-500 hover:text-dark transition-colors">
                        <i class="fas fa-home"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Quiz Container -->
    <main class="max-w-4xl mx-auto px-4 py-6">
        <!-- Quiz Info Card -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-2xl font-bold text-dark mb-2">Career Interests Assessment</h2>
                    <p class="text-gray-600">Discover careers that match your interests and preferences</p>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-500">Progress</div>
                    <div class="text-2xl font-bold text-dark">
                        <span id="current-question">1</span>/<span id="total-questions">5</span>
                    </div>
                </div>
            </div>

            <!-- Progress bar -->
            <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                <div id="progress-bar" class="bg-lime h-2 rounded-full transition-all duration-300" style="width: 20%"></div>
            </div>

            <!-- Mode notification -->
            <?php if ($quizMode === 'guest'): ?>
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mb-4">
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-info-circle text-yellow-600 text-sm mt-0.5"></i>
                        <div class="text-sm">
                            <p class="font-medium text-yellow-800">Guest Mode Active</p>
                            <p class="text-yellow-700">Your quiz results won't be saved. Consider creating an account to save your progress.</p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="bg-lime/10 border border-lime/30 rounded-lg p-3 mb-4">
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-shield-alt text-lime-600 text-sm mt-0.5"></i>
                        <div class="text-sm">
                            <p class="font-medium text-dark">Your Progress is Being Saved</p>
                            <p class="text-gray-700">You can return to this quiz anytime and view your results later.</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Quiz Form -->
        <div id="quiz-container" class="bg-white rounded-2xl shadow-lg p-6">
            <form id="quiz-form">
                <input type="hidden" id="quiz-mode" value="<?php echo $quizMode; ?>">
                <input type="hidden" id="user-id" value="<?php echo $isLoggedIn ? $_SESSION['user_id'] : ''; ?>">
                <input type="hidden" id="session-id" value="<?php echo $isLoggedIn ? '' : $_SESSION['guest_session_id']; ?>">
                
                <!-- Question will be loaded here -->
                <div id="question-container"></div>
                
                <!-- Navigation buttons -->
                <div class="flex justify-between mt-6">
                    <button type="button" id="prev-btn" class="px-6 py-3 bg-gray-200 text-dark font-medium rounded-xl hover:bg-gray-300 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                        <i class="fas fa-chevron-left mr-2"></i>Previous
                    </button>
                    
                    <button type="button" id="next-btn" class="px-6 py-3 bg-dark text-white font-medium rounded-xl hover:bg-gray-800 transition-colors">
                        Next<i class="fas fa-chevron-right ml-2"></i>
                    </button>
                    
                    <button type="button" id="submit-btn" class="px-6 py-3 bg-lime text-dark font-bold rounded-xl hover:bg-lime-600 transition-colors hidden">
                        <i class="fas fa-check mr-2"></i>Submit Quiz
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Loading overlay -->
    <div id="loading-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-2xl p-8 text-center">
            <div class="w-12 h-12 border-4 border-lime border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
            <p class="text-dark font-medium">Processing your quiz...</p>
        </div>
    </div>

    <script src="../Scripts/quizPageScripts/quizPage.js"></script>
    <script>
        function goHome() {
            window.location.href = '../../index.php';
        }
    </script>
</body>
</html>