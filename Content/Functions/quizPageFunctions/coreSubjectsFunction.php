<?php


function hasUserCoreSubjects($userId) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT id FROM core_subject_tb WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->num_rows > 0;
}

function saveUserCoreSubjects($userId, $statisticsGrade, $physicalScienceGrade, $mbtiType) {
    global $conn;
    
    // Check if user already has core subjects
    if (hasUserCoreSubjects($userId)) {
        // Update existing record
        $stmt = $conn->prepare("UPDATE core_subject_tb SET Statistics_and_Probability = ?, Physical_Science = ?, mbti_type = ? WHERE user_id = ?");
        $stmt->bind_param("sssi", $statisticsGrade, $physicalScienceGrade, $mbtiType, $userId);
    } else {
        // Insert new record
        $stmt = $conn->prepare("INSERT INTO core_subject_tb (user_id, Statistics_and_Probability, Physical_Science, mbti_type) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $userId, $statisticsGrade, $physicalScienceGrade, $mbtiType);
    }
    
    return $stmt->execute();
}

function getUserCoreSubjects($userId) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT Statistics_and_Probability, Physical_Science, mbti_type FROM core_subject_tb WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    
    return null;
}
?>