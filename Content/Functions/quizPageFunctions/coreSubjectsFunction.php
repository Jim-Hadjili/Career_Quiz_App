<?php

function hasUserCoreSubjects($userId) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT id FROM core_subject_tb WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->num_rows > 0;
}

function saveAllUserCoreSubjects($userId, $subjects) {
    global $conn;
    
    // Check if user already has core subjects
    if (hasUserCoreSubjects($userId)) {
        // Update existing record (removed unwanted subjects)
        $sql = "UPDATE core_subject_tb SET 
                Statistics_and_Probability = ?, Physical_Science = ?, mbti_type = ?,
                oral_comm_context = ?, general_math = ?, earth_life_sci = ?, 
                ucsp = ?, reading_writing = ?, lit21_ph_world = ?, 
                media_info_lit = ?, cp_arts_regions = ?
                WHERE user_id = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssi", 
            $subjects['Statistics_and_Probability'], $subjects['Physical_Science'], $subjects['mbti_type'],
            $subjects['oral_comm_context'], $subjects['general_math'], $subjects['earth_life_sci'],
            $subjects['ucsp'], $subjects['reading_writing'], $subjects['lit21_ph_world'],
            $subjects['media_info_lit'], $subjects['cp_arts_regions'], $userId
        );
    } else {
        // Insert new record (removed unwanted subjects)
        $sql = "INSERT INTO core_subject_tb 
                (user_id, Statistics_and_Probability, Physical_Science, mbti_type,
                oral_comm_context, general_math, earth_life_sci, ucsp,
                reading_writing, lit21_ph_world, media_info_lit, cp_arts_regions) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssssssssss", 
            $userId, $subjects['Statistics_and_Probability'], $subjects['Physical_Science'], $subjects['mbti_type'],
            $subjects['oral_comm_context'], $subjects['general_math'], $subjects['earth_life_sci'],
            $subjects['ucsp'], $subjects['reading_writing'], $subjects['lit21_ph_world'],
            $subjects['media_info_lit'], $subjects['cp_arts_regions']
        );
    }
    
    return $stmt->execute();
}

function getUserCoreSubjects($userId) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM core_subject_tb WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    
    return null;
}
?>