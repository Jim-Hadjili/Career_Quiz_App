<?php
session_start();
header('Content-Type: application/json');

// Database configuration - corrected path
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
        case 'get_user_data':
            // Get current user data - using mysqli instead of PDO
            $stmt = $conn->prepare("SELECT userName, userEmail FROM users_tb WHERE user_id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user) {
                echo json_encode([
                    'success' => true,
                    'user' => [
                        'fullName' => $user['userName'],
                        'email' => $user['userEmail']
                    ]
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'User not found'
                ]);
            }
            break;

        case 'update_profile':
            // Validate required fields
            if (!isset($input['fullName']) || empty(trim($input['fullName']))) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Full name is required'
                ]);
                exit;
            }

            if (!isset($input['email']) || empty(trim($input['email']))) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Email address is required'
                ]);
                exit;
            }

            $fullName = trim($input['fullName']);
            $email = trim($input['email']);
            $updateName = false;
            $updateEmail = false;
            $updatePassword = false;

            // Validate email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Please enter a valid email address'
                ]);
                exit;
            }

            // Check if email is already taken by another user
            $stmt = $conn->prepare("SELECT user_id FROM users_tb WHERE userEmail = ? AND user_id != ?");
            $stmt->bind_param("si", $email, $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->fetch_assoc()) {
                echo json_encode([
                    'success' => false,
                    'message' => 'This email address is already registered to another account'
                ]);
                exit;
            }

            // Check if password change is requested
            if (isset($input['currentPassword']) && isset($input['newPassword'])) {
                $currentPassword = $input['currentPassword'];
                $newPassword = $input['newPassword'];

                // Simplified password validation - only check minimum length
                if (strlen($newPassword) < 8) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'New password must be at least 8 characters long'
                    ]);
                    exit;
                }

                // Verify current password - using mysqli
                $stmt = $conn->prepare("SELECT userPassword FROM users_tb WHERE user_id = ?");
                $stmt->bind_param("i", $userId);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();

                if (!$user || !password_verify($currentPassword, $user['userPassword'])) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Current password is incorrect'
                    ]);
                    exit;
                }

                $updatePassword = true;
            }

            // Start transaction
            $conn->autocommit(false);

            try {
                // Get current user data to check what changed
                $stmt = $conn->prepare("SELECT userName, userEmail FROM users_tb WHERE user_id = ?");
                $stmt->bind_param("i", $userId);
                $stmt->execute();
                $result = $stmt->get_result();
                $currentUser = $result->fetch_assoc();

                // Check if name or email changed
                $updateName = ($currentUser['userName'] !== $fullName);
                $updateEmail = ($currentUser['userEmail'] !== $email);

                // Update name and email
                $stmt = $conn->prepare("UPDATE users_tb SET userName = ?, userEmail = ? WHERE user_id = ?");
                $stmt->bind_param("ssi", $fullName, $email, $userId);
                $stmt->execute();

                // Update password if requested
                if ($updatePassword) {
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("UPDATE users_tb SET userPassword = ? WHERE user_id = ?");
                    $stmt->bind_param("si", $hashedPassword, $userId);
                    $stmt->execute();
                }

                // Commit transaction
                $conn->commit();

                // Update session data
                $_SESSION['user_name'] = $fullName;
                $_SESSION['user_email'] = $email;

                // Build success message
                $changes = [];
                if ($updateName) $changes[] = 'name';
                if ($updateEmail) $changes[] = 'email';
                if ($updatePassword) $changes[] = 'password';

                if (empty($changes)) {
                    $message = 'No changes were made';
                } else {
                    $message = 'Successfully updated: ' . implode(', ', $changes);
                }

                echo json_encode([
                    'success' => true,
                    'message' => $message,
                    'updatedName' => $updateName ? $fullName : null,
                    'updatedEmail' => $updateEmail ? $email : null
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
    error_log("Profile handler error: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred while processing your request'
    ]);
}
?>