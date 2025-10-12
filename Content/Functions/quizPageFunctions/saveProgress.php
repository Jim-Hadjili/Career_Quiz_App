<?php
session_start();
include "../../../Config/Connection/conn.php";

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

$userId = $input['user_id'] ?? null;
$answers = $input['answers'] ?? [];
$currentQuestion = $input['current_question'] ?? 0;

// Validate user authentication
if (empty($userId) || !isset($_SESSION['user_id']) || $_SESSION['user_id'] != $userId) {
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

try {
    // Check if progress already exists
    $stmt = $conn->prepare("
        SELECT result_id FROM quiz_results_tb 
        WHERE user_id = ? AND completion_date IS NULL
    ");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $progressData = json_encode([
        'answers' => $answers,
        'current_question' => $currentQuestion,
        'last_saved' => date('Y-m-d H:i:s')
    ]);
    
    if ($result->num_rows > 0) {
        // Update existing progress
        $row = $result->fetch_assoc();
        $resultId = $row['result_id'];
        
        $updateStmt = $conn->prepare("
            UPDATE quiz_results_tb 
            SET quiz_data = ? 
            WHERE result_id = ?
        ");
        $updateStmt->bind_param("si", $progressData, $resultId);
        $updateStmt->execute();
    } else {
        // Create new progress entry
        $insertStmt = $conn->prepare("
            INSERT INTO quiz_results_tb (user_id, quiz_data, recommended_careers, is_guest, completion_date) 
            VALUES (?, ?, '{}', 0, NULL)
        ");
        $insertStmt->bind_param("is", $userId, $progressData);
        $insertStmt->execute();
    }
    
    echo json_encode(['success' => true, 'message' => 'Progress saved']);
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>