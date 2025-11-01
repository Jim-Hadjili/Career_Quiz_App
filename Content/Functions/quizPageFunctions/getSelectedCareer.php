<?php
session_start();
include "../../../Config/Connection/conn.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$action = $_POST['action'] ?? '';
if ($action !== 'get_selected_career') {
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
    exit;
}

$resultId = $_POST['result_id'] ?? '';
$userId = $_POST['user_id'] ?? '';

if (empty($resultId) || empty($userId)) {
    echo json_encode(['success' => false, 'message' => 'Missing required data']);
    exit;
}

try {
    // Check if selection_date column exists, if not just query basic fields
    $stmt = $conn->prepare("SELECT selectedCareer_id, career_selected FROM selected_career_tb WHERE result_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $resultId, $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode([
            'success' => true, 
            'career' => $row['career_selected'],
            'selection_id' => $row['selectedCareer_id']
        ]);
    } else {
        echo json_encode(['success' => true, 'career' => null]);
    }
} catch (Exception $e) {
    error_log("Error getting selected career: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
?>