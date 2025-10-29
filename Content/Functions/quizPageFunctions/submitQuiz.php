<?php
session_start();
include "../../../Config/Connection/conn.php";
include "coreSubjectsFunction.php";
include "../AI/careerAnalysisAPI.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$action = $_POST['action'] ?? '';
if ($action !== 'submit_quiz') {
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
    exit;
}

// Get form data
$userId = $_POST['user_id'] ?? '';
$sessionId = $_POST['session_id'] ?? '';
$quizMode = $_POST['quiz_mode'] ?? '';
$quizAnswers = json_decode($_POST['quiz_answers'] ?? '{}', true);
$coreSubjects = json_decode($_POST['core_subjects'] ?? '{}', true);

// Validate required data
if (empty($quizAnswers)) {
    echo json_encode(['success' => false, 'message' => 'Quiz answers are required']);
    exit;
}

if (empty($coreSubjects) || !isset($coreSubjects['mbti_type'])) {
    echo json_encode(['success' => false, 'message' => 'Core subjects and MBTI type are required']);
    exit;
}

try {
    // Initialize AI analysis
    $aiAnalysis = new CareerAnalysisAPI();

    // Request AI analysis — must return valid JSON with exactly 5 recommendations
    $analysisResult = $aiAnalysis->analyzeCareerProfile(
        $quizAnswers, 
        $coreSubjects, 
        $coreSubjects['mbti_type']
    );

    // Validate AI response again to be safe
    if (!$analysisResult || !isset($analysisResult['recommended_careers']) || 
        !is_array($analysisResult['recommended_careers']) || 
        count($analysisResult['recommended_careers']) !== 5) {
        throw new Exception('AI returned an invalid number of recommendations.');
    }

    // Save or return results depending on user mode
    if ($quizMode === 'user' && !empty($userId)) {
        $resultId = saveUserQuizResult($userId, $quizAnswers, $coreSubjects, $analysisResult);
        
        if ($resultId) {
            echo json_encode([
                'success' => true, 
                'message' => 'Quiz submitted successfully',
                'result_id' => $resultId,
                'career_recommendations' => $analysisResult,
                'redirect_url' => '../Pages/quizResults.php?result_id=' . $resultId
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save quiz results']);
        }
    } else {
        // Guest users - store AI result in session
        $guestResultId = 'guest_' . uniqid();
        $_SESSION['guest_quiz_result'] = [
            'result_id' => $guestResultId,
            'quiz_answers' => $quizAnswers,
            'core_subjects' => $coreSubjects,
            'career_recommendations' => $analysisResult,
            'completion_date' => date('Y-m-d H:i:s')
        ];
        
        echo json_encode([
            'success' => true,
            'message' => 'Quiz completed successfully',
            'result_id' => $guestResultId,
            'career_recommendations' => $analysisResult,
            'redirect_url' => '../Pages/quizResults.php?guest=1'
        ]);
    }
    
} catch (Exception $e) {
    error_log("Quiz submission error (AI-only policy): " . $e->getMessage());
    // No fallback allowed. Return error so client can retry.
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'AI analysis failed. No fallback is available. Please try again later.'
    ]);
    exit;
}

function saveUserQuizResult($userId, $quizAnswers, $coreSubjects, $careerRecommendations) {
    global $conn;
    
    $quizData = json_encode([
        'answers' => $quizAnswers,
        'core_subjects' => $coreSubjects
    ]);
    $recommendedCareers = json_encode($careerRecommendations);
    
    $stmt = $conn->prepare("
        INSERT INTO quiz_results_tb (user_id, quiz_data, recommended_careers, is_guest) 
        VALUES (?, ?, ?, 0)
    ");
    
    $stmt->bind_param("iss", $userId, $quizData, $recommendedCareers);
    
    if ($stmt->execute()) {
        return $conn->insert_id;
    }
    
    return false;
}