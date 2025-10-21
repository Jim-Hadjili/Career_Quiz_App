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

// Extract all subject grades
$subjects = [
    'Statistics_and_Probability' => $_POST['Statistics_and_Probability'] ?? '',
    'Physical_Science' => $_POST['Physical_Science'] ?? '',
    'oral_comm_context' => $_POST['oral_comm_context'] ?? '',
    'komunikasyon_pananaliksik' => $_POST['komunikasyon_pananaliksik'] ?? '',
    'general_math' => $_POST['general_math'] ?? '',
    'earth_life_sci' => $_POST['earth_life_sci'] ?? '',
    'personal_dev' => $_POST['personal_dev'] ?? '',
    'ucsp' => $_POST['ucsp'] ?? '',
    'pe_health_1' => $_POST['pe_health_1'] ?? '',
    'pe_health_2' => $_POST['pe_health_2'] ?? '',
    'reading_writing' => $_POST['reading_writing'] ?? '',
    'pagbasa_pagsusuri' => $_POST['pagbasa_pagsusuri'] ?? '',
    'lit21_ph_world' => $_POST['lit21_ph_world'] ?? '',
    'media_info_lit' => $_POST['media_info_lit'] ?? '',
    'stats_prob' => $_POST['stats_prob'] ?? '',
    'physical_sci' => $_POST['physical_sci'] ?? '',
    'cp_arts_regions' => $_POST['cp_arts_regions'] ?? '',
    'intro_philo_human' => $_POST['intro_philo_human'] ?? '',
    'pe_health_3' => $_POST['pe_health_3'] ?? '',
    'pe_health_4' => $_POST['pe_health_4'] ?? '',
    'mbti_type' => $_POST['mbti_type'] ?? ''
];

// Validate required fields
foreach ($subjects as $key => $value) {
    if (empty($value)) {
        echo json_encode(['success' => false, 'message' => "Field $key is required"]);
        exit;
    }
}

try {
    if ($quizMode === 'user' && !empty($userId)) {
        // Save for registered user
        $success = saveAllUserCoreSubjects($userId, $subjects);
        
        if ($success) {
            echo json_encode(['success' => true, 'message' => 'Core subjects saved successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save core subjects']);
        }
    } else {
        // For guest users, store in session
        $_SESSION['guest_core_subjects'] = $subjects;
        echo json_encode(['success' => true, 'message' => 'Core subjects stored for guest user']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>