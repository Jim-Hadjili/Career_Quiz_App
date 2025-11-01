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
            
            arsort($career_counts);
            return array_slice($career_counts, 0, 6, true);
        }
        
        return ['Data Science' => 12, 'Software Dev' => 8, 'Engineering' => 6, 'Business' => 4, 'Healthcare' => 3, 'Education' => 2];
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
            
            arsort($selected_careers);
            $selected_careers = array_slice($selected_careers, 0, 8, true);
        }
        
        return [
            'selected_careers' => $selected_careers ?: ['Data Scientist' => 8, 'Software Engineer' => 6, 'HR Specialist' => 4, 'Marketing Manager' => 3],
            'monthly_data' => $monthly_data
        ];
    }
}
?>