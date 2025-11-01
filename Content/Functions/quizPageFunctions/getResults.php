<?php
session_start();
include "../../../Config/Connection/conn.php";
include "coreSubjectsFunction.php";

header('Content-Type: application/json');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$action = $_POST['action'] ?? '';
if ($action !== 'get_results') {
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
    exit;
}

$resultId = $_POST['result_id'] ?? '';
$isGuest = $_POST['is_guest'] ?? '';

try {
    if ($isGuest) {
        // Load guest results from session
        if (isset($_SESSION['guest_quiz_result'])) {
            $guestData = $_SESSION['guest_quiz_result'];
            
            echo json_encode([
                'success' => true,
                'data' => [
                    'quizAnswers' => $guestData['quiz_answers'] ?? [],
                    'coreSubjects' => $guestData['core_subjects'] ?? [],
                    'careerRecommendations' => $guestData['career_recommendations'] ?? [],
                    'mbtiType' => $guestData['core_subjects']['mbti_type'] ?? 'UNKNOWN'
                ]
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No guest results found']);
        }
    } else {
        // Load user results from database
        if (empty($resultId)) {
            echo json_encode(['success' => false, 'message' => 'Result ID is required']);
            exit;
        }

        // Fixed: Use result_id instead of id
        $stmt = $conn->prepare("SELECT * FROM quiz_results_tb WHERE result_id = ?");
        $stmt->bind_param("i", $resultId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $quizData = json_decode($row['quiz_data'], true);
            $careerRecommendations = json_decode($row['recommended_careers'], true);

            // Ensure data structure is correct
            if (!$quizData || !$careerRecommendations) {
                throw new Exception('Invalid data format in database');
            }

            echo json_encode([
                'success' => true,
                'data' => [
                    'quizAnswers' => $quizData['answers'] ?? [],
                    'coreSubjects' => $quizData['core_subjects'] ?? [],
                    'careerRecommendations' => $careerRecommendations ?? [],
                    'mbtiType' => $quizData['core_subjects']['mbti_type'] ?? 'UNKNOWN'
                ]
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Results not found for ID: ' . $resultId]);
        }
    }
} catch (Exception $e) {
    error_log("Error loading results: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>