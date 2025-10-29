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
    
    // Get AI career recommendations
    $analysisResult = $aiAnalysis->analyzeCareerProfile(
        $quizAnswers, 
        $coreSubjects, 
        $coreSubjects['mbti_type']
    );
    
    // Parse AI response
    $careerRecommendations = parseAIResponse($analysisResult);
    
    if ($quizMode === 'user' && !empty($userId)) {
        // Save for registered users
        $resultId = saveUserQuizResult($userId, $quizAnswers, $coreSubjects, $careerRecommendations);
        
        if ($resultId) {
            echo json_encode([
                'success' => true, 
                'message' => 'Quiz submitted successfully',
                'result_id' => $resultId,
                'career_recommendations' => $careerRecommendations,
                'redirect_url' => '../Pages/quizResults.php?result_id=' . $resultId
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save quiz results']);
        }
    } else {
        // Handle guest users - store in session
        $guestResultId = 'guest_' . uniqid();
        $_SESSION['guest_quiz_result'] = [
            'result_id' => $guestResultId,
            'quiz_answers' => $quizAnswers,
            'core_subjects' => $coreSubjects,
            'career_recommendations' => $careerRecommendations,
            'completion_date' => date('Y-m-d H:i:s')
        ];
        
        echo json_encode([
            'success' => true,
            'message' => 'Quiz completed successfully',
            'result_id' => $guestResultId,
            'career_recommendations' => $careerRecommendations,
            'redirect_url' => '../Pages/quizResults.php?guest=1'
        ]);
    }
    
} catch (Exception $e) {
    error_log("Quiz submission error: " . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'message' => 'An error occurred while processing your quiz. Please try again.'
    ]);
}

function parseAIResponse($aiResponse) {
    // Try to extract JSON from AI response
    $jsonStart = strpos($aiResponse, '{');
    $jsonEnd = strrpos($aiResponse, '}') + 1;
    
    if ($jsonStart !== false && $jsonEnd !== false) {
        $jsonString = substr($aiResponse, $jsonStart, $jsonEnd - $jsonStart);
        $decoded = json_decode($jsonString, true);
        
        if ($decoded && isset($decoded['recommended_careers'])) {
            return $decoded;
        }
    }
    
    // Fallback to default structure if AI response parsing fails
    return [
        'recommended_careers' => [
            [
                'title' => 'General Career Path',
                'match_percentage' => 75,
                'description' => 'Based on your responses, this career path aligns with your interests and strengths.',
                'why_good_fit' => 'Your personality profile and academic performance indicate strong potential in this field.',
                'salary_range' => '$50,000 - $80,000',
                'growth_outlook' => 'Medium'
            ]
        ],
        'personality_analysis' => [
            'key_traits' => ['Analytical', 'Detail-oriented'],
            'strengths' => ['Problem-solving', 'Communication'],
            'areas_for_development' => ['Leadership skills', 'Technical expertise']
        ],
        'academic_analysis' => [
            'strongest_subjects' => ['Mathematics', 'Science'],
            'recommendations' => ['Continue developing technical skills']
        ]
    ];
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