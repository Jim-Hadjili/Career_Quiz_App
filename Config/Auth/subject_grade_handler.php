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
        case 'get_subject_grades':
            // Get current user's subject grades
            $stmt = $conn->prepare("SELECT * FROM core_subject_tb WHERE user_id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $grades = $result->fetch_assoc();

            if ($grades) {
                // Remove id and user_id from the response
                unset($grades['id']);
                unset($grades['user_id']);
                
                echo json_encode([
                    'success' => true,
                    'grades' => $grades
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'No grades found',
                    'grades' => []
                ]);
            }
            break;

        case 'save_subject_grades':
            // Define expected grade fields (removed mbti_type)
            $gradeFields = [
                'Statistics_and_Probability',
                'Physical_Science',
                'oral_comm_context',
                'general_math',
                'earth_life_sci',
                'ucsp',
                'reading_writing',
                'lit21_ph_world',
                'media_info_lit'
            ];

            // Validate and collect grade data
            $gradeData = [];
            $filledFields = 0;

            foreach ($gradeFields as $field) {
                if (isset($input[$field]) && !empty(trim($input[$field]))) {
                    $value = trim($input[$field]);
                    $numValue = floatval($value);
                    
                    // Validate numeric grades
                    if ($numValue < 65 || $numValue > 100) {
                        echo json_encode([
                            'success' => false,
                            'message' => "Invalid grade for {$field}. Must be between 65 and 100."
                        ]);
                        exit;
                    }
                    
                    $gradeData[$field] = $numValue;
                    $filledFields++;
                } else {
                    // Set empty fields to empty string
                    $gradeData[$field] = '';
                }
            }

            // Check if user already has grades
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
                    $updateFields = [];
                    $updateValues = [];
                    $types = '';

                    foreach ($gradeFields as $field) {
                        $updateFields[] = "{$field} = ?";
                        $updateValues[] = $gradeData[$field];
                        $types .= 'd'; // All are double/float values
                    }

                    $updateValues[] = $userId;
                    $types .= 'i';

                    $sql = "UPDATE core_subject_tb SET " . implode(', ', $updateFields) . " WHERE user_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param($types, ...$updateValues);
                    $stmt->execute();

                    $message = 'Subject grades updated successfully';
                } else {
                    // Insert new record
                    $fields = implode(', ', array_merge(['user_id'], $gradeFields));
                    $placeholders = str_repeat('?,', count($gradeFields)) . '?';
                    $insertValues = array_merge([$userId], array_values($gradeData));
                    $types = 'i' . str_repeat('d', count($gradeFields)); // user_id (int) + grades (double)

                    $sql = "INSERT INTO core_subject_tb ({$fields}) VALUES ({$placeholders})";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param($types, ...$insertValues);
                    $stmt->execute();

                    $message = 'Subject grades saved successfully';
                }

                // Commit transaction
                $conn->commit();

                echo json_encode([
                    'success' => true,
                    'message' => $message,
                    'filled_subjects' => $filledFields
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
    error_log("Subject grade handler error: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred while processing your request'
    ]);
}
?>