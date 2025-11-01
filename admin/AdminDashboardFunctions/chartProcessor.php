<?php
class ChartProcessor {
    
    public static function formatCareerLabels($career_data, $max_length = 15) {
        $labels = [];
        $counts = [];
        
        foreach ($career_data as $title => $count) {
            $labels[] = strlen($title) > $max_length ? substr($title, 0, $max_length) . '...' : $title;
            $counts[] = $count;
        }
        
        return ['labels' => $labels, 'counts' => $counts];
    }
    
    public static function getMonthlyTrendData($monthly_data, $months_back = 6) {
        $labels = [];
        $counts = [];
        
        for ($i = $months_back - 1; $i >= 0; $i--) {
            $month = date('M Y', strtotime("-$i months"));
            $labels[] = $month;
            $counts[] = $monthly_data[$month] ?? 0;
        }
        
        return ['labels' => $labels, 'counts' => $counts];
    }
    
    public static function getPopularCareer($career_data) {
        if (empty($career_data)) {
            return ['career' => 'Data Scientist', 'percentage' => 34];
        }
        
        $most_popular = array_keys($career_data)[0];
        $career_name = strlen($most_popular) > 15 ? substr($most_popular, 0, 15) . '...' : $most_popular;
        $percentage = round(($career_data[$most_popular] / array_sum($career_data)) * 100);
        
        return ['career' => $career_name, 'percentage' => $percentage];
    }
}
?>