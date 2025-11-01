<?php
session_start();
include "../../../Config/Connection/conn.php";

header('Content-Type: application/json');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$action = $_POST['action'] ?? '';
if (!in_array($action, ['select_career', 'remove_career_selection'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
    exit;
}

$resultId = $_POST['result_id'] ?? '';
$userId = $_POST['user_id'] ?? '';

// Validate required data
if (empty($resultId) || empty($userId)) {
    echo json_encode(['success' => false, 'message' => 'Missing required data']);
    exit;
}

try {
    if ($action === 'remove_career_selection') {
        // Remove existing selection
        $deleteStmt = $conn->prepare("DELETE FROM selected_career_tb WHERE result_id = ? AND user_id = ?");
        $deleteStmt->bind_param("ii", $resultId, $userId);
        
        if ($deleteStmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Career selection removed successfully']);
        } else {
            throw new Exception('Failed to remove career selection');
        }
    } else {
        // Handle career selection
        $careerSelected = $_POST['career_selected'] ?? '';
        if (empty($careerSelected)) {
            echo json_encode(['success' => false, 'message' => 'Career selection is required']);
            exit;
        }

        // Check if user already has a career selection for this result
        $checkStmt = $conn->prepare("SELECT selectedCareer_id FROM selected_career_tb WHERE result_id = ? AND user_id = ?");
        $checkStmt->bind_param("ii", $resultId, $userId);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            // Update existing selection
            $updateStmt = $conn->prepare("UPDATE selected_career_tb SET career_selected = ? WHERE result_id = ? AND user_id = ?");
            $updateStmt->bind_param("sii", $careerSelected, $resultId, $userId);
            
            if ($updateStmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Career selection updated successfully']);
            } else {
                throw new Exception('Failed to update career selection');
            }
        } else {
            // Insert new selection
            $insertStmt = $conn->prepare("INSERT INTO selected_career_tb (result_id, user_id, career_selected) VALUES (?, ?, ?)");
            $insertStmt->bind_param("iis", $resultId, $userId, $careerSelected);
            
            if ($insertStmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Career selected successfully']);
            } else {
                throw new Exception('Failed to insert career selection');
            }
        }
    }
} catch (Exception $e) {
    error_log("Career selection error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>