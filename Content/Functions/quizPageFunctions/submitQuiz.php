<?php
session_start();
include "../../../Config/Connection/conn.php";
require_once "aiAnalysis.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['success' => false, 'error' => 'Invalid JSON data']);
    exit;
}

$quizMode = $input['quiz_mode'] ?? '';
$userId = $input['user_id'] ?? null;
$sessionId = $input['session_id'] ?? null;
$quizData = $input['quiz_data'] ?? [];

// Validate required data
if (empty($quizData)) {
    echo json_encode(['success' => false, 'error' => 'No quiz data provided']);
    exit;
}

if ($quizMode === 'user' && empty($userId)) {
    echo json_encode(['success' => false, 'error' => 'User ID required for registered users']);
    exit;
}

if ($quizMode === 'guest' && empty($sessionId)) {
    echo json_encode(['success' => false, 'error' => 'Session ID required for guest users']);
    exit;
}

try {
    // Get user name for personalized analysis
    $userName = 'User';
    if ($quizMode === 'user' && $userId) {
        $userStmt = $conn->prepare("SELECT userName FROM users_tb WHERE user_id = ?");
        $userStmt->bind_param("i", $userId);
        $userStmt->execute();
        $userResult = $userStmt->get_result();
        if ($userResult->num_rows > 0) {
            $user = $userResult->fetch_assoc();
            $userName = $user['userName'];
        }
    }

    // Initialize AI analyzer
    $aiAnalyzer = new AICareerAnalyzer();
    
    // Get AI-powered career analysis
    $aiAnalysis = $aiAnalyzer->analyzeCareerFit($quizData, $userName);
    
    // Also calculate basic recommendations for backup
    $basicRecommendations = calculateCareerRecommendations($quizData);
    
    // Combine AI analysis with basic recommendations
    $finalRecommendations = [
        'ai_analysis' => $aiAnalysis,
        'basic_recommendations' => $basicRecommendations
    ];
    
    // Prepare data for database
    $quizDataJson = json_encode($quizData);
    $recommendationsJson = json_encode($finalRecommendations);
    $isGuest = ($quizMode === 'guest') ? 1 : 0;
    
    // For guest users, set user_id to NULL explicitly
    $userIdForDb = ($quizMode === 'guest') ? null : (int)$userId;
    
    // Insert into database with proper NULL handling
    if ($quizMode === 'guest') {
        $stmt = $conn->prepare("
            INSERT INTO quiz_results_tb (user_id, session_id, quiz_data, recommended_careers, is_guest, completion_date) 
            VALUES (NULL, ?, ?, ?, ?, NOW())
        ");
        
        $stmt->bind_param(
            "sssi", 
            $sessionId, 
            $quizDataJson, 
            $recommendationsJson, 
            $isGuest
        );
    } else {
        $stmt = $conn->prepare("
            INSERT INTO quiz_results_tb (user_id, session_id, quiz_data, recommended_careers, is_guest, completion_date) 
            VALUES (?, ?, ?, ?, ?, NOW())
        ");
        
        $stmt->bind_param(
            "isssi", 
            $userIdForDb, 
            $sessionId, 
            $quizDataJson, 
            $recommendationsJson, 
            $isGuest
        );
    }
    
    if ($stmt->execute()) {
        $resultId = $conn->insert_id;
        
        echo json_encode([
            'success' => true, 
            'result_id' => $resultId,
            'recommendations' => $finalRecommendations
        ]);
    } else {
        throw new Exception('Failed to save quiz results: ' . $stmt->error);
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

function calculateCareerRecommendations($quizData) {
    $categories = [
        'technology' => 0,
        'business' => 0,
        'healthcare' => 0
    ];
    
    foreach ($quizData as $answer) {
        $category = $answer['category'];
        $score = (int)$answer['scale_value'];
        
        if (isset($categories[$category])) {
            $categories[$category] += $score;
        }
    }
    
    // Sort by highest score
    arsort($categories);
    
    // Define career mappings
    $careerMappings = [
        'technology' => [
            'Software Developer',
            'Data Scientist', 
            'Cybersecurity Specialist',
            'Web Developer',
            'IT Consultant'
        ],
        'business' => [
            'Business Analyst',
            'Project Manager',
            'Marketing Manager',
            'Sales Manager',
            'Entrepreneur'
        ],
        'healthcare' => [
            'Nurse',
            'Doctor',
            'Physical Therapist',
            'Healthcare Administrator',
            'Medical Researcher'
        ]
    ];
    
    $recommendations = [];
    $rank = 1;
    
    foreach ($categories as $category => $score) {
        if ($score > 0 && isset($careerMappings[$category])) {
            $recommendations[] = [
                'category' => $category,
                'score' => $score,
                'rank' => $rank,
                'careers' => $careerMappings[$category]
            ];
            $rank++;
        }
    }
    
    return $recommendations;
}
?>