<?php
session_start();
include "../../../Config/Connection/conn.php";
include "coreSubjectsFunction.php";

header('Content-Type: application/json');

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$action = $_POST['action'] ?? '';
$userId = $_POST['user_id'] ?? '';
$sessionId = $_POST['session_id'] ?? '';
$quizMode = $_POST['quiz_mode'] ?? '';

if (!in_array($action, ['save_academic_grades', 'update_mbti', 'save_core_subjects'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
    exit;
}

// Validate user ID for registered users
if ($quizMode === 'user' && empty($userId)) {
    echo json_encode(['success' => false, 'message' => 'User ID is required for registered users']);
    exit;
}

try {
    if ($action === 'save_academic_grades') {
        // Handle saving only academic grades (no MBTI)
        $subjects = [
            'Statistics_and_Probability' => $_POST['Statistics_and_Probability'] ?? '',
            'Physical_Science' => $_POST['Physical_Science'] ?? '',
            'oral_comm_context' => $_POST['oral_comm_context'] ?? '',
            'general_math' => $_POST['general_math'] ?? '',
            'earth_life_sci' => $_POST['earth_life_sci'] ?? '',
            'ucsp' => $_POST['ucsp'] ?? '',
            'reading_writing' => $_POST['reading_writing'] ?? '',
            'lit21_ph_world' => $_POST['lit21_ph_world'] ?? '',
            'media_info_lit' => $_POST['media_info_lit'] ?? ''
        ];

        // Validate that all academic fields are present and not empty
        $missingFields = [];
        foreach ($subjects as $key => $value) {
            if (empty($value)) {
                $missingFields[] = $key;
            }
        }

        if (!empty($missingFields)) {
            echo json_encode([
                'success' => false, 
                'message' => 'The following academic fields are required: ' . implode(', ', $missingFields)
            ]);
            exit;
        }

        // Validate grade values (should be numeric and between 65-100)
        $invalidGrades = [];
        foreach ($subjects as $key => $value) {
            if (!is_numeric($value) || $value < 65 || $value > 100) {
                $invalidGrades[] = $key;
            }
        }

        if (!empty($invalidGrades)) {
            echo json_encode([
                'success' => false, 
                'message' => 'Invalid grade values for: ' . implode(', ', $invalidGrades) . '. Grades must be between 65 and 100.'
            ]);
            exit;
        }

        if ($quizMode === 'user' && !empty($userId)) {
            // Save academic grades to database
            $success = saveAcademicGrades($userId, $subjects);

            if ($success) {
                error_log("Successfully saved academic grades for user ID: " . $userId);
                echo json_encode(['success' => true, 'message' => 'Academic grades saved successfully']);
            } else {
                error_log("Failed to save academic grades for user ID: " . $userId);
                echo json_encode(['success' => false, 'message' => 'Failed to save academic grades to database']);
            }
        } else {
            // Handle guest users
            if (!isset($_SESSION['guest_core_subjects'])) {
                $_SESSION['guest_core_subjects'] = [];
            }
            $_SESSION['guest_core_subjects'] = array_merge($_SESSION['guest_core_subjects'], $subjects);
            error_log("Stored academic grades in session for guest user");
            echo json_encode(['success' => true, 'message' => 'Academic grades stored for guest user']);
        }
    } 
    elseif ($action === 'update_mbti') {
        // Handle updating MBTI type only
        $mbtiType = $_POST['mbti_type'] ?? '';

        if (empty($mbtiType)) {
            echo json_encode(['success' => false, 'message' => 'MBTI type is required']);
            exit;
        }

        if ($quizMode === 'user' && !empty($userId)) {
            // Update MBTI type in database
            $success = updateUserMBTI($userId, $mbtiType);

            if ($success) {
                error_log("Successfully updated MBTI type for user ID: " . $userId);
                echo json_encode(['success' => true, 'message' => 'MBTI type updated successfully']);
            } else {
                error_log("Failed to update MBTI type for user ID: " . $userId);
                echo json_encode(['success' => false, 'message' => 'Failed to update MBTI type in database']);
            }
        } else {
            // Handle guest users
            if (!isset($_SESSION['guest_core_subjects'])) {
                $_SESSION['guest_core_subjects'] = [];
            }
            $_SESSION['guest_core_subjects']['mbti_type'] = $mbtiType;
            error_log("Stored MBTI type in session for guest user");
            echo json_encode(['success' => true, 'message' => 'MBTI type stored for guest user']);
        }
    }
    elseif ($action === 'save_core_subjects') {
        // Legacy support for saving all data at once
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

        // Validate that all required fields are present and not empty
        $missingFields = [];
        foreach ($subjects as $key => $value) {
            if (empty($value)) {
                $missingFields[] = $key;
            }
        }

        if (!empty($missingFields)) {
            echo json_encode([
                'success' => false, 
                'message' => 'The following fields are required: ' . implode(', ', $missingFields)
            ]);
            exit;
        }

        // Validate grade values (should be numeric and between 65-100)
        $invalidGrades = [];
        foreach ($subjects as $key => $value) {
            if ($key !== 'mbti_type') {
                if (!is_numeric($value) || $value < 65 || $value > 100) {
                    $invalidGrades[] = $key;
                }
            }
        }

        if (!empty($invalidGrades)) {
            echo json_encode([
                'success' => false, 
                'message' => 'Invalid grade values for: ' . implode(', ', $invalidGrades) . '. Grades must be between 65 and 100.'
            ]);
            exit;
        }

        if ($quizMode === 'user' && !empty($userId)) {
            $success = saveAllUserCoreSubjects($userId, $subjects);

            if ($success) {
                error_log("Successfully saved all core subjects for user ID: " . $userId);
                echo json_encode(['success' => true, 'message' => 'Core subjects saved successfully']);
            } else {
                error_log("Failed to save core subjects for user ID: " . $userId);
                echo json_encode(['success' => false, 'message' => 'Failed to save core subjects to database']);
            }
        } else {
            $_SESSION['guest_core_subjects'] = $subjects;
            error_log("Stored core subjects in session for guest user");
            echo json_encode(['success' => true, 'message' => 'Core subjects stored for guest user']);
        }
    }
} catch (Exception $e) {
    error_log("Database error while processing request: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
