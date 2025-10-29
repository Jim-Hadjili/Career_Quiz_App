<?php

function hasUserCoreSubjects($userId)
{
    global $conn;

    $stmt = $conn->prepare("SELECT id FROM core_subject_tb WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->num_rows > 0;
}

function saveAcademicGrades($userId, $subjects)
{
    global $conn;

    // Check if user already has core subjects record
    if (hasUserCoreSubjects($userId)) {
        // Update existing record with academic grades only
        $sql = "UPDATE core_subject_tb SET 
                Statistics_and_Probability = ?, 
                Physical_Science = ?, 
                oral_comm_context = ?, 
                general_math = ?, 
                earth_life_sci = ?, 
                ucsp = ?, 
                reading_writing = ?, 
                lit21_ph_world = ?, 
                media_info_lit = ?
                WHERE user_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssssssssi",
            $subjects['Statistics_and_Probability'],
            $subjects['Physical_Science'],
            $subjects['oral_comm_context'],
            $subjects['general_math'],
            $subjects['earth_life_sci'],
            $subjects['ucsp'],
            $subjects['reading_writing'],
            $subjects['lit21_ph_world'],
            $subjects['media_info_lit'],
            $userId
        );
    } else {
        // Insert new record with academic grades only (MBTI will be updated later)
        $sql = "INSERT INTO core_subject_tb 
                (user_id, Statistics_and_Probability, Physical_Science, oral_comm_context, 
                 general_math, earth_life_sci, ucsp, reading_writing, lit21_ph_world, 
                 media_info_lit, mbti_type) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '')";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "isssssssss",
            $userId,
            $subjects['Statistics_and_Probability'],
            $subjects['Physical_Science'],
            $subjects['oral_comm_context'],
            $subjects['general_math'],
            $subjects['earth_life_sci'],
            $subjects['ucsp'],
            $subjects['reading_writing'],
            $subjects['lit21_ph_world'],
            $subjects['media_info_lit']
        );
    }

    return $stmt->execute();
}

function updateUserMBTI($userId, $mbtiType)
{
    global $conn;

    // Check if user has a record
    if (hasUserCoreSubjects($userId)) {
        // Update existing record with MBTI type
        $sql = "UPDATE core_subject_tb SET mbti_type = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $mbtiType, $userId);
    } else {
        // This shouldn't happen in normal flow, but create record if needed
        $sql = "INSERT INTO core_subject_tb 
                (user_id, Statistics_and_Probability, Physical_Science, oral_comm_context, 
                 general_math, earth_life_sci, ucsp, reading_writing, lit21_ph_world, 
                 media_info_lit, mbti_type) 
                VALUES (?, '', '', '', '', '', '', '', '', '', ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $userId, $mbtiType);
    }

    return $stmt->execute();
}

function saveAllUserCoreSubjects($userId, $subjects)
{
    global $conn;

    // Check if user already has core subjects
    if (hasUserCoreSubjects($userId)) {
        // Update existing record
        $sql = "UPDATE core_subject_tb SET 
                Statistics_and_Probability = ?, 
                Physical_Science = ?, 
                oral_comm_context = ?, 
                general_math = ?, 
                earth_life_sci = ?, 
                ucsp = ?, 
                reading_writing = ?, 
                lit21_ph_world = ?, 
                media_info_lit = ?, 
                mbti_type = ?
                WHERE user_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssssssssi",
            $subjects['Statistics_and_Probability'],
            $subjects['Physical_Science'],
            $subjects['oral_comm_context'],
            $subjects['general_math'],
            $subjects['earth_life_sci'],
            $subjects['ucsp'],
            $subjects['reading_writing'],
            $subjects['lit21_ph_world'],
            $subjects['media_info_lit'],
            $subjects['mbti_type'],
            $userId
        );
    } else {
        // Insert new record
        $sql = "INSERT INTO core_subject_tb 
                (user_id, Statistics_and_Probability, Physical_Science, oral_comm_context, 
                 general_math, earth_life_sci, ucsp, reading_writing, lit21_ph_world, 
                 media_info_lit, mbti_type) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "issssssssss",
            $userId,
            $subjects['Statistics_and_Probability'],
            $subjects['Physical_Science'],
            $subjects['oral_comm_context'],
            $subjects['general_math'],
            $subjects['earth_life_sci'],
            $subjects['ucsp'],
            $subjects['reading_writing'],
            $subjects['lit21_ph_world'],
            $subjects['media_info_lit'],
            $subjects['mbti_type']
        );
    }

    return $stmt->execute();
}

function getUserCoreSubjects($userId)
{
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
