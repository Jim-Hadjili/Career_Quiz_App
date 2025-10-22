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
$userId = $_POST['user_id'] ?? '';
$sessionId = $_POST['session_id'] ?? '';
$quizMode = $_POST['quiz_mode'] ?? '';

if ($action !== 'save_core_subjects') {
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
    exit;
}

$subjects = [
    'Statistics_and_Probability' => $_POST['Statistics_and_Probability'] ?? '',
    'Physical_Science' => $_POST['Physical_Science'] ?? '',
    'oral_comm_context' => $_POST['oral_comm_context'] ?? '',
    'general_math' => $_POST['general_math'] ?? '',
    'earth_life_sci' => $_POST['earth_life_sci'] ?? '',
    'ucsp' => $_POST['ucsp'] ?? '',
    'reading_writing' => $_POST['reading_writing'] ?? '',
    'lit21_ph_world' => $_POST['lit21_ph_world'] ?? '',
    'media_info_lit' => $_POST['media_info_lit'] ?? '',
    'mbti_type' => $_POST['mbti_type'] ?? ''
];

foreach ($subjects as $key => $value) {
    if (empty($value)) {
        echo json_encode(['success' => false, 'message' => "Field $key is required"]);
        exit;
    }
}

try {
    if ($quizMode === 'user' && !empty($userId)) {
        $success = saveAllUserCoreSubjects($userId, $subjects);

        if ($success) {
            echo json_encode(['success' => true, 'message' => 'Core subjects saved successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save core subjects']);
        }
    } else {
        $_SESSION['guest_core_subjects'] = $subjects;
        echo json_encode(['success' => true, 'message' => 'Core subjects stored for guest user']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
