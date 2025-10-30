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
        case 'get_quiz_results':
            // Get pagination parameters
            $page = isset($input['page']) ? max(1, intval($input['page'])) : 1;
            $perPage = isset($input['per_page']) ? min(50, max(1, intval($input['per_page']))) : 5;
            $offset = ($page - 1) * $perPage;

            // Get total count
            $countStmt = $conn->prepare("SELECT COUNT(*) as total FROM quiz_results_tb WHERE user_id = ?");
            $countStmt->bind_param("i", $userId);
            $countStmt->execute();
            $countResult = $countStmt->get_result();
            $totalCount = $countResult->fetch_assoc()['total'];

            if ($totalCount == 0) {
                echo json_encode([
                    'success' => false,
                    'message' => 'No quiz results found',
                    'results' => [],
                    'total_count' => 0,
                    'current_page' => $page,
                    'total_pages' => 0
                ]);
                exit;
            }

            // Get paginated results (newest first)
            $stmt = $conn->prepare("
                SELECT result_id, quiz_data, recommended_careers, completion_date, is_guest 
                FROM quiz_results_tb 
                WHERE user_id = ? 
                ORDER BY completion_date DESC 
                LIMIT ? OFFSET ?
            ");
            $stmt->bind_param("iii", $userId, $perPage, $offset);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $results = [];
            while ($row = $result->fetch_assoc()) {
                $results[] = [
                    'result_id' => $row['result_id'],
                    'quiz_data' => $row['quiz_data'],
                    'recommended_careers' => $row['recommended_careers'],
                    'completion_date' => $row['completion_date'],
                    'is_guest' => (bool)$row['is_guest']
                ];
            }

            $totalPages = ceil($totalCount / $perPage);

            echo json_encode([
                'success' => true,
                'results' => $results,
                'total_count' => $totalCount,
                'current_page' => $page,
                'total_pages' => $totalPages,
                'per_page' => $perPage
            ]);
            break;

        case 'delete_quiz_result':
            if (!isset($input['result_id'])) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Result ID is required'
                ]);
                exit;
            }

            $resultId = $input['result_id'];

            // Verify the result belongs to the current user
            $checkStmt = $conn->prepare("SELECT result_id FROM quiz_results_tb WHERE result_id = ? AND user_id = ?");
            $checkStmt->bind_param("ii", $resultId, $userId);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows === 0) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Quiz result not found or access denied'
                ]);
                exit;
            }

            // Delete the result
            $deleteStmt = $conn->prepare("DELETE FROM quiz_results_tb WHERE result_id = ? AND user_id = ?");
            $deleteStmt->bind_param("ii", $resultId, $userId);
            
            if ($deleteStmt->execute()) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Quiz result deleted successfully'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to delete quiz result'
                ]);
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
    error_log("Quiz results handler error: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred while processing your request'
    ]);
}
?>