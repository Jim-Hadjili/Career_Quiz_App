<?php
class QuizResults {
    private $conn;
    
    public function __construct($connection) {
        $this->conn = $connection;
    }
    
    public function getTotalResults() {
        $query = "SELECT COUNT(*) as total_results FROM quiz_results_tb";
        $result = $this->conn->query($query);
        return $result->fetch_assoc()['total_results'];
    }
    
    public function getCareerDistribution() {
        $query = "SELECT recommended_careers FROM quiz_results_tb WHERE recommended_careers IS NOT NULL";
        $result = $this->conn->query($query);
        $career_counts = [];
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $career_json = json_decode($row['recommended_careers'], true);
                if (isset($career_json['recommended_careers']) && is_array($career_json['recommended_careers'])) {
                    foreach ($career_json['recommended_careers'] as $career) {
                        if (isset($career['title'])) {
                            $title = $career['title'];
                            $career_counts[$title] = ($career_counts[$title] ?? 0) + 1;
                        }
                    }
                }
            }
            
            if (!empty($career_counts)) {
                arsort($career_counts);
                return array_slice($career_counts, 0, 6, true);
            }
        }
        
        // Return empty array if no data found instead of sample data
        return [];
    }
    
    public function getSelectedCareersData() {
        $query = "SELECT recommended_careers, completion_date FROM quiz_results_tb 
                  WHERE recommended_careers IS NOT NULL ORDER BY completion_date DESC";
        $result = $this->conn->query($query);
        
        $selected_careers = [];
        $monthly_data = [];
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $career_json = json_decode($row['recommended_careers'], true);
                $month = date('M Y', strtotime($row['completion_date']));
                
                if (isset($career_json['recommended_careers'][0]['title'])) {
                    $title = $career_json['recommended_careers'][0]['title'];
                    $selected_careers[$title] = ($selected_careers[$title] ?? 0) + 1;
                    $monthly_data[$month] = ($monthly_data[$month] ?? 0) + 1;
                }
            }
            
            if (!empty($selected_careers)) {
                arsort($selected_careers);
                $selected_careers = array_slice($selected_careers, 0, 8, true);
            }
        }
        
        return [
            'selected_careers' => $selected_careers,
            'monthly_data' => $monthly_data
        ];
    }
    
    // NEW: Get user selected careers from selected_career_tb
    public function getUserSelectedCareers($user_id = null) {
        if ($user_id) {
            $query = "SELECT career_selected, COUNT(*) as selection_count 
                      FROM selected_career_tb 
                      WHERE user_id = ? 
                      GROUP BY career_selected 
                      ORDER BY selection_count DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $query = "SELECT career_selected, COUNT(*) as selection_count 
                      FROM selected_career_tb 
                      GROUP BY career_selected 
                      ORDER BY selection_count DESC";
            $result = $this->conn->query($query);
        }
        
        $user_selected_careers = [];
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user_selected_careers[$row['career_selected']] = $row['selection_count'];
            }
        }
        
        return $user_selected_careers;
    }
    
    // NEW: Get recent user selections
    public function getRecentUserSelections($limit = 10) {
        $query = "SELECT sct.career_selected, u.userName, sct.user_id 
                  FROM selected_career_tb sct 
                  LEFT JOIN users_tb u ON sct.user_id = u.user_id 
                  ORDER BY sct.selectedCareer_id DESC 
                  LIMIT ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $recent_selections = [];
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $recent_selections[] = [
                    'career' => $row['career_selected'],
                    'user' => $row['userName'] ?: 'Unknown User',
                    'user_id' => $row['user_id']
                ];
            }
        }
        
        return $recent_selections;
    }
}
?>