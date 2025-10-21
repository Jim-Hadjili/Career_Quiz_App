<?php 
session_start();
include "../../Config/Connection/conn.php";
include "coreSubjectsFunction.php";

// Determine quiz mode and user info
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
$quizMode = $isLoggedIn ? 'user' : 'guest';
$userName = $isLoggedIn ? ($_SESSION['userName'] ?? 'User') : 'Guest User';
$userEmail = $isLoggedIn ? ($_SESSION['userEmail'] ?? null) : null;

// Generate session ID for guest users
if (!$isLoggedIn && !isset($_SESSION['guest_session_id'])) {
    $_SESSION['guest_session_id'] = 'guest_' . uniqid('', true);
}

// Check if logged-in user has core subjects
$needsCoreSubjects = true;
$existingCoreSubjects = null;
if ($isLoggedIn) {
    $existingCoreSubjects = getUserCoreSubjects($_SESSION['user_id']);
    $needsCoreSubjects = ($existingCoreSubjects === null);
}

// Set variables for compatibility with the new design
$is_registered = $isLoggedIn;
$user_name = $userName;
$quiz_mode = $quizMode;
?>