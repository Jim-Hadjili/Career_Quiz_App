<?php
session_start();
require_once '../Connection/conn.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$action = $input['action'] ?? '';

switch ($action) {
    case 'signup':
        handleSignup($conn, $input);
        break;
    case 'signin':
        handleSignin($conn, $input);
        break;
    case 'logout':
        handleLogout();
        break;
    case 'check_auth':
        checkAuth();
        break;
    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
}

function handleSignup($conn, $data) {
    $fullName = trim($data['fullName'] ?? '');
    $email = trim($data['email'] ?? '');
    $password = $data['password'] ?? '';
    
    // Validation
    if (empty($fullName) || empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        return;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        return;
    }
    
    if (strlen($password) < 8) {
        echo json_encode(['success' => false, 'message' => 'Password must be at least 8 characters long']);
        return;
    }
    
    // Check if email already exists
    $stmt = $conn->prepare("SELECT user_id FROM users_tb WHERE userEmail = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Email already exists']);
        return;
    }
    
    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Get current Philippines time
    $philippinesTime = new DateTime('now', new DateTimeZone('Asia/Manila'));
    $registrationDate = $philippinesTime->format('Y-m-d H:i:s');
    
    // Insert new user with registration timestamp
    $stmt = $conn->prepare("INSERT INTO users_tb (userName, userEmail, userPassword, registration_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullName, $email, $hashedPassword, $registrationDate);
    
    if ($stmt->execute()) {
        $userId = $conn->insert_id;
        
        // Format registration date for display (12-hour format)
        $displayDate = $philippinesTime->format('F j, Y g:i A');
        
        // Set session
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_name'] = $fullName;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_role'] = null; // Default role for new users
        $_SESSION['registration_date'] = $registrationDate;
        
        echo json_encode([
            'success' => true, 
            'message' => 'Account created successfully!',
            'user' => [
                'id' => $userId,
                'name' => $fullName,
                'email' => $email,
                'role' => null,
                'registration_date' => $displayDate
            ],
            'redirect' => null // No special redirect for new users
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to create account']);
    }
}

function handleSignin($conn, $data) {
    $email = trim($data['email'] ?? '');
    $password = $data['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Email and password are required']);
        return;
    }
    
    // Get user from database including userRole and registration_date
    $stmt = $conn->prepare("SELECT user_id, userName, userEmail, userPassword, userRole, registration_date FROM users_tb WHERE userEmail = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
        return;
    }
    
    $user = $result->fetch_assoc();
    
    // Verify password
    if (password_verify($password, $user['userPassword'])) {
        // Format registration date for display (12-hour format, Philippines timezone)
        $registrationDateTime = new DateTime($user['registration_date']);
        $registrationDateTime->setTimezone(new DateTimeZone('Asia/Manila'));
        $displayDate = $registrationDateTime->format('F j, Y g:i A');
        
        // Set session
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['userName'];
        $_SESSION['user_email'] = $user['userEmail'];
        $_SESSION['user_role'] = $user['userRole'];
        $_SESSION['registration_date'] = $user['registration_date'];
        
        // Determine redirect based on user role
        $redirectUrl = null;
        if (strtolower($user['userRole']) === 'admin') {
            $redirectUrl = 'admin/dashboard.php'; // Adjust path as needed
        }
        
        echo json_encode([
            'success' => true,
            'message' => 'Welcome back!',
            'user' => [
                'id' => $user['user_id'],
                'name' => $user['userName'],
                'email' => $user['userEmail'],
                'role' => $user['userRole'],
                'registration_date' => $displayDate
            ],
            'redirect' => $redirectUrl
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
    }
}

function handleLogout() {
    session_destroy();
    echo json_encode(['success' => true, 'message' => 'Logged out successfully']);
}

function checkAuth() {
    if (isset($_SESSION['user_id'])) {
        // Format registration date for display if available
        $displayDate = null;
        if (isset($_SESSION['registration_date'])) {
            $registrationDateTime = new DateTime($_SESSION['registration_date']);
            $registrationDateTime->setTimezone(new DateTimeZone('Asia/Manila'));
            $displayDate = $registrationDateTime->format('F j, Y g:i A');
        }
        
        echo json_encode([
            'success' => true,
            'authenticated' => true,
            'user' => [
                'id' => $_SESSION['user_id'],
                'name' => $_SESSION['user_name'],
                'email' => $_SESSION['user_email'],
                'role' => $_SESSION['user_role'] ?? null,
                'registration_date' => $displayDate
            ]
        ]);
    } else {
        echo json_encode(['success' => true, 'authenticated' => false]);
    }
}
?>