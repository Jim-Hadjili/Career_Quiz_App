<?php
session_start();
include "../../../Config/Connection/conn.php";
include "coreSubjectsFunction.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$action = $_POST['action'] ?? '';
$statisticsGrade = $_POST['statistics_grade'] ?? '';
$physicalScienceGrade = $_POST['physical_science_grade'] ?? '';
$mbtiType = $_POST['mbti_type'] ?? '';
$userId = $_POST['user_id'] ?? '';
$sessionId = $_POST['session_id'] ?? '';
$quizMode = $_POST['quiz_mode'] ?? '';

if ($action !== 'save_core_subjects') {
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
    exit;
}

if (empty($statisticsGrade) || empty($physicalScienceGrade) || empty($mbtiType)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

try {
    if ($quizMode === 'user' && !empty($userId)) {
        // Save for registered user
        $success = saveUserCoreSubjects($userId, $statisticsGrade, $physicalScienceGrade, $mbtiType);
        
        if ($success) {
            echo json_encode(['success' => true, 'message' => 'Core subjects saved successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save core subjects']);
        }
    } else {
        // For guest users, store in session temporarily
        $_SESSION['guest_core_subjects'] = [
            'statistics_grade' => $statisticsGrade,
            'physical_science_grade' => $physicalScienceGrade,
            'mbti_type' => $mbtiType
        ];
        
        echo json_encode(['success' => true, 'message' => 'Core subjects stored for guest user']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>