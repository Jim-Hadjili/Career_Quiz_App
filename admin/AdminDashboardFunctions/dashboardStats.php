<?php
require_once 'userStats.php';
require_once 'quizResults.php';
require_once 'chartProcessor.php';

class DashboardStats {
    private $userStats;
    private $quizResults;
    
    public function __construct($connection) {
        $this->userStats = new UserStats($connection);
        $this->quizResults = new QuizResults($connection);
    }
    
    public function getStatsSummary() {
        $total_users = $this->userStats->getTotalUsers();
        $new_users = $this->userStats->getNewUsers();
        $total_results = $this->quizResults->getTotalResults();
        
        $career_distribution = $this->quizResults->getCareerDistribution();
        $popular_career_data = ChartProcessor::getPopularCareer($career_distribution);
        
        return [
            ['title' => 'Total Users', 'value' => number_format($total_users), 'change' => 'up 1.2% from last month', 'icon' => 'fa-users'],
            ['title' => 'New Users', 'value' => number_format($new_users), 'change' => 'up ' . ($new_users > 0 ? round(($new_users / max($total_users - $new_users, 1)) * 100, 1) : 0) . '% this week', 'icon' => 'fa-user-plus'],
            ['title' => 'Results Generated', 'value' => number_format($total_results), 'change' => 'up 5.1% from last month', 'icon' => 'fa-chart-bar'],
            ['title' => 'Popular Career', 'value' => $popular_career_data['career'], 'change' => $popular_career_data['percentage'] . '% of all results', 'icon' => 'fa-star']
        ];
    }
    
    public function getChartData() {
        // Career distribution chart
        $career_distribution = $this->quizResults->getCareerDistribution();
        $career_chart = ChartProcessor::formatCareerLabels($career_distribution);
        
        // Selected careers data
        $selected_data = $this->quizResults->getSelectedCareersData();
        $selected_chart = ChartProcessor::formatCareerLabels($selected_data['selected_careers'], 20);
        $monthly_trend = ChartProcessor::getMonthlyTrendData($selected_data['monthly_data']);
        
        return [
            'career_distribution' => $career_chart,
            'selected_careers' => $selected_chart,
            'monthly_trend' => $monthly_trend
        ];
    }
}
?>