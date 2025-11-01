<?php
function checkAdminAuth() {
    session_start();
    
    if (!isset($_SESSION['user_id']) || strtolower($_SESSION['user_role']) !== 'admin') {
        header('Location: ../index.php');
        exit;
    }
}

function initializeDashboard() {
    checkAdminAuth();
    require_once '../Config/Connection/conn.php';
    return $conn;
}
?>