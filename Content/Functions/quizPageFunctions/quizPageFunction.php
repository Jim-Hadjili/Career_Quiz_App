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

// Check if logged-in user has core subjects and load existing data
$needsCoreSubjects = true;
$existingCoreSubjects = null;
$existingCoreSubjectsJson = '{}';

if ($isLoggedIn) {
    $existingCoreSubjects = getUserCoreSubjects($_SESSION['user_id']);
    $needsCoreSubjects = ($existingCoreSubjects === null);
    
    // If user has existing data, convert to JSON for JavaScript
    if ($existingCoreSubjects) {
        $existingCoreSubjectsJson = json_encode([
            'Statistics_and_Probability' => $existingCoreSubjects['Statistics_and_Probability'],
            'Physical_Science' => $existingCoreSubjects['Physical_Science'],
            'oral_comm_context' => $existingCoreSubjects['oral_comm_context'],
            'general_math' => $existingCoreSubjects['general_math'],
            'earth_life_sci' => $existingCoreSubjects['earth_life_sci'],
            'ucsp' => $existingCoreSubjects['ucsp'],
            'reading_writing' => $existingCoreSubjects['reading_writing'],
            'lit21_ph_world' => $existingCoreSubjects['lit21_ph_world'],
            'media_info_lit' => $existingCoreSubjects['media_info_lit'],
            'mbti_type' => $existingCoreSubjects['mbti_type']
        ]);
    }
}

// Set variables for compatibility with the new design
$is_registered = $isLoggedIn;
$user_name = $userName;
$quiz_mode = $quizMode;
?>