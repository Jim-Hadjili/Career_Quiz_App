<?php
session_start();
header('Content-Type: application/json');

// Database configuration
require_once '../Connection/conn.php';

try {
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input || !isset($input['action'])) {
        throw new Exception('Invalid request');
    }

    $action = $input['action'];

    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo json_encode([
            'success' => false,
            'message' => 'User not authenticated'
        ]);
        exit;
    }

    $userId = $_SESSION['user_id'];

    switch ($action) {
        case 'get_mbti_type':
            // Get current user's MBTI type from core_subject_tb
            $stmt = $conn->prepare("SELECT mbti_type FROM core_subject_tb WHERE user_id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();

            if ($data && !empty($data['mbti_type'])) {
                echo json_encode([
                    'success' => true,
                    'mbti_type' => $data['mbti_type']
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'No MBTI type found',
                    'mbti_type' => null
                ]);
            }
            break;

        case 'save_mbti_type':
            // Validate MBTI type
            if (!isset($input['mbti_type']) || empty(trim($input['mbti_type']))) {
                echo json_encode([
                    'success' => false,
                    'message' => 'MBTI type is required'
                ]);
                exit;
            }

            $mbtiType = trim($input['mbti_type']);

            // Validate MBTI type format
            $validMBTITypes = ['INTJ', 'INTP', 'ENTJ', 'ENTP', 'INFJ', 'INFP', 'ENFJ', 'ENFP', 
                             'ISTJ', 'ISFJ', 'ESTJ', 'ESFJ', 'ISTP', 'ISFP', 'ESTP', 'ESFP'];
            
            if (!in_array($mbtiType, $validMBTITypes)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Invalid MBTI type selected'
                ]);
                exit;
            }

            // Check if user already has a record in core_subject_tb
            $stmt = $conn->prepare("SELECT id FROM core_subject_tb WHERE user_id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $existingRecord = $result->fetch_assoc();

            // Start transaction
            $conn->autocommit(false);

            try {
                if ($existingRecord) {
                    // Update existing record
                    $stmt = $conn->prepare("UPDATE core_subject_tb SET mbti_type = ? WHERE user_id = ?");
                    $stmt->bind_param("si", $mbtiType, $userId);
                    $stmt->execute();

                    $message = 'MBTI type updated successfully';
                } else {
                    // Insert new record with only MBTI type and empty grades
                    $sql = "INSERT INTO core_subject_tb (user_id, Statistics_and_Probability, Physical_Science, oral_comm_context, general_math, earth_life_sci, ucsp, reading_writing, lit21_ph_world, media_info_lit, mbti_type) VALUES (?, '', '', '', '', '', '', '', '', '', ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("is", $userId, $mbtiType);
                    $stmt->execute();

                    $message = 'MBTI type saved successfully';
                }

                // Commit transaction
                $conn->commit();

                echo json_encode([
                    'success' => true,
                    'message' => $message
                ]);

            } catch (Exception $e) {
                $conn->rollback();
                throw $e;
            }
            break;

        default:
            echo json_encode([
                'success' => false,
                'message' => 'Invalid action'
            ]);
            break;
    }

} catch (Exception $e) {
    error_log("MBTI handler error: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred while processing your request'
    ]);
}
?>