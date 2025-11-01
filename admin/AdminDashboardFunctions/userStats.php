<?php
class UserStats {
    private $conn;
    
    public function __construct($connection) {
        $this->conn = $connection;
    }
    
    public function getTotalUsers() {
        $query = "SELECT COUNT(*) as total FROM users_tb WHERE userRole IS NULL OR userRole != 'Admin'";
        $result = $this->conn->query($query);
        return $result->fetch_assoc()['total'];
    }
    
    public function getNewUsers($days = 7) {
        $query = "SELECT COUNT(*) as new_users FROM users_tb 
                  WHERE (userRole IS NULL OR userRole != 'Admin') 
                  AND registration_date >= DATE_SUB(NOW(), INTERVAL $days DAY)";
        $result = $this->conn->query($query);
        return $result->fetch_assoc()['new_users'];
    }
    
    public function getUsersForPage($page = 1, $per_page = 10) {
        $offset = ($page - 1) * $per_page;
        $query = "SELECT userName, userEmail FROM users_tb 
                  WHERE (userRole IS NULL OR userRole != 'Admin') 
                  ORDER BY user_id DESC LIMIT $per_page OFFSET $offset";
        
        $result = $this->conn->query($query);
        $users = [];
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        
        return $users;
    }
    
    public function getTotalPages($per_page = 10) {
        $total_users = $this->getTotalUsers();
        return ceil($total_users / $per_page);
    }
}
?>