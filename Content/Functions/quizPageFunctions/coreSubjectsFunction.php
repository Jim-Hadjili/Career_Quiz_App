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
        // Update existing record
        $sql = "UPDATE core_subject_tb SET 
                Statistics_and_Probability = ?, Physical_Science = ?, mbti_type = ?,
                oral_comm_context = ?, komunikasyon_pananaliksik = ?, general_math = ?,
                earth_life_sci = ?, personal_dev = ?, ucsp = ?, pe_health_1 = ?,
                pe_health_2 = ?, reading_writing = ?, pagbasa_pagsusuri = ?,
                lit21_ph_world = ?, media_info_lit = ?, stats_prob = ?,
                physical_sci = ?, cp_arts_regions = ?, intro_philo_human = ?,
                pe_health_3 = ?, pe_health_4 = ?
                WHERE user_id = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssssssssssssssi", 
            $subjects['Statistics_and_Probability'], $subjects['Physical_Science'], $subjects['mbti_type'],
            $subjects['oral_comm_context'], $subjects['komunikasyon_pananaliksik'], $subjects['general_math'],
            $subjects['earth_life_sci'], $subjects['personal_dev'], $subjects['ucsp'], $subjects['pe_health_1'],
            $subjects['pe_health_2'], $subjects['reading_writing'], $subjects['pagbasa_pagsusuri'],
            $subjects['lit21_ph_world'], $subjects['media_info_lit'], $subjects['stats_prob'],
            $subjects['physical_sci'], $subjects['cp_arts_regions'], $subjects['intro_philo_human'],
            $subjects['pe_health_3'], $subjects['pe_health_4'], $userId
        );
    } else {
        // Insert new record
        $sql = "INSERT INTO core_subject_tb 
                (user_id, Statistics_and_Probability, Physical_Science, mbti_type,
                oral_comm_context, komunikasyon_pananaliksik, general_math,
                earth_life_sci, personal_dev, ucsp, pe_health_1,
                pe_health_2, reading_writing, pagbasa_pagsusuri,
                lit21_ph_world, media_info_lit, stats_prob,
                physical_sci, cp_arts_regions, intro_philo_human,
                pe_health_3, pe_health_4) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssssssssssssssssssss", 
            $userId, $subjects['Statistics_and_Probability'], $subjects['Physical_Science'], $subjects['mbti_type'],
            $subjects['oral_comm_context'], $subjects['komunikasyon_pananaliksik'], $subjects['general_math'],
            $subjects['earth_life_sci'], $subjects['personal_dev'], $subjects['ucsp'], $subjects['pe_health_1'],
            $subjects['pe_health_2'], $subjects['reading_writing'], $subjects['pagbasa_pagsusuri'],
            $subjects['lit21_ph_world'], $subjects['media_info_lit'], $subjects['stats_prob'],
            $subjects['physical_sci'], $subjects['cp_arts_regions'], $subjects['intro_philo_human'],
            $subjects['pe_health_3'], $subjects['pe_health_4']
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