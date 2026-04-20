<?php
class CareerAnalysisAPI {
    private $apiKey;
    private $apiUrl;
    private $model;
    private $maxRetries = 3;
    private $retryDelaySeconds = 1;

    public function __construct() {
        $envFile = file_exists('../../../.env') ? '../../../.env' : '../../../Config/API/.env';
        $config = $this->loadEnv($envFile);
        
        $this->apiKey = $config['GROQ_API_KEY'];
        $this->apiUrl = $config['GROQ_API_URL'] ?? 'https://api.groq.com/openai/v1/chat/completions';
        $this->model = $config['GROQ_ANALYSIS_MODEL'] ?? 'llama-3.3-70b-versatile';
    }

    private function loadEnv($filepath) {
        $config = [];
        if (file_exists($filepath)) {
            $lines = file($filepath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos($line, '=>') !== false) {
                    list($key, $value) = explode(' => ', $line, 2);
                    $config[trim($key)] = trim($value);
                }
            }
        }
        return $config;
    }

    public function analyzeCareerProfile($quizAnswers, $coreSubjects, $mbtiType) {
        $prompt = $this->buildAnalysisPrompt($quizAnswers, $coreSubjects, $mbtiType);

        $lastException = null;
        for ($attempt = 1; $attempt <= $this->maxRetries; $attempt++) {
            try {
                $payload = [
                    'model' => $this->model,
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'Expert career counselor AI. Always provide exactly 5 career recommendations in valid JSON format.'
                        ],
                        [
                            'role' => 'user',
                            'content' => $prompt
                        ]
                    ],
                    'temperature' => 0.3,
                    'max_tokens' => 2500
                ];

                $result = $this->makeAPIRequest($payload);

                if (is_array($result) && isset($result['recommended_careers']) && 
                    is_array($result['recommended_careers']) && 
                    count($result['recommended_careers']) === 5) {
                    return $result;
                }

                throw new Exception('AI returned invalid recommendation structure.');
            } catch (Exception $ex) {
                $lastException = $ex;
                if ($attempt < $this->maxRetries) {
                    sleep($this->retryDelaySeconds);
                }
            }
        }

        throw new Exception('AI analysis failed: ' . ($lastException ? $lastException->getMessage() : 'unknown error'));
    }

    private function buildAnalysisPrompt($quizAnswers, $coreSubjects, $mbtiType) {
        if (empty($mbtiType) || $mbtiType === 'unknown') {
            $mbtiType = 'ISFJ';
        }

        // Build concise profile
        $profile = "MBTI: {$mbtiType}\n";
        
        // Academic performance summary
        $grades = [];
        $total = 0;
        $count = 0;
        
        foreach ($coreSubjects as $subject => $grade) {
            if ($subject !== 'mbti_type' && is_numeric($grade)) {
                $numGrade = floatval($grade);
                $grades[$this->formatSubjectName($subject)] = $numGrade;
                $total += $numGrade;
                $count++;
            }
        }
        
        $avgGrade = $count > 0 ? round($total / $count, 1) : 75;
        arsort($grades);
        $topSubjects = array_slice(array_keys($grades), 0, 3);
        
        $profile .= "Avg Grade: {$avgGrade}/100\n";
        $profile .= "Top Subjects: " . implode(', ', $topSubjects) . "\n";
        
        // Quiz personality summary
        $personalityScores = $this->analyzeQuizResponses($quizAnswers);
        $profile .= "Personality Scores: ";
        foreach ($personalityScores as $trait => $score) {
            $profile .= "{$trait}:{$score} ";
        }
        
        return $profile . "\n\n" . $this->getCompactInstructions();
    }

    private function formatSubjectName($subject) {
        $nameMap = [
            'Statistics_and_Probability' => 'Statistics',
            'Physical_Science' => 'Physics',
            'oral_comm_context' => 'Communication',
            'general_math' => 'Math',
            'earth_life_sci' => 'Earth Science',
            'ucsp' => 'Social Studies',
            'reading_writing' => 'English',
            'lit21_ph_world' => 'Literature',
            'media_info_lit' => 'Media Literacy'
        ];
        
        return $nameMap[$subject] ?? str_replace('_', ' ', $subject);
    }

    private function analyzeQuizResponses($quizAnswers) {
        $traitScores = [
            'Analytical' => 0,
            'Social' => 0,
            'Creative' => 0,
            'Leadership' => 0
        ];
        $traitCounts = [
            'Analytical' => 0,
            'Social' => 0,
            'Creative' => 0,
            'Leadership' => 0
        ];
        
        foreach ($quizAnswers as $questionId => $answer) {
            $questionNum = intval(str_replace('q', '', $questionId));
            
            if ($questionNum <= 10) $trait = 'Analytical';
            elseif ($questionNum <= 20) $trait = 'Social';
            elseif ($questionNum <= 30) $trait = 'Creative';
            else $trait = 'Leadership';
            
            $traitScores[$trait] += intval($answer);
            $traitCounts[$trait]++;
        }
        
        $averageScores = [];
        foreach ($traitScores as $trait => $totalScore) {
            if ($traitCounts[$trait] > 0) {
                $averageScores[$trait] = round($totalScore / $traitCounts[$trait], 1);
            }
        }
        
        return $averageScores;
    }

    private function getCompactInstructions() {
        return "Generate exactly 5 career recommendations as JSON. Use Philippine context.

Required JSON format:
{
  \"recommended_careers\": [
    {
      \"title\": \"Career Name\",
      \"match_percentage\": 85,
      \"description\": \"2-3 sentences about role, responsibilities, and impact.\",
      \"why_good_fit\": \"3-4 sentences explaining fit with MBTI, grades, and personality scores.\",
      \"educational_path\": {
        \"degree_programs\": [\"Bachelor of Science in Computer Science\", \"Bachelor of Science in Information Technology\", \"Bachelor of Science in Software Engineering\"]
      },
      \"salary_range\": \"₱30,000 - ₱75,000\",
      \"growth_outlook\": \"High\",
      \"icon\": \"fa-briefcase\"
    }
  ]
}

Guidelines:
- Match %: 70-95% realistic range
- Salary: Use ₱ format, Philippine market rates
- Growth: \"High\", \"Medium\", or \"Low\" only
- Educational paths: 2-4 relevant degree programs from Philippine universities
- Use full degree names (e.g., \"Bachelor of Science in Industrial Engineering\")
- Diverse career fields
- Reference actual grades and MBTI in why_good_fit

Examples by field:
IT: Bachelor of Science in Computer Science, Bachelor of Science in Information Technology
Engineering: Bachelor of Science in Civil Engineering, Bachelor of Science in Mechanical Engineering
Healthcare: Bachelor of Science in Nursing, Bachelor of Medicine
Business: Bachelor of Science in Business Administration, Bachelor of Science in Accountancy
Education: Bachelor of Elementary Education, Bachelor of Secondary Education

Return only valid JSON, no other text.";
    }

    private function makeAPIRequest($payload) {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apiKey
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 45);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if (curl_error($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new Exception('API request failed: ' . $error);
        }
        
        curl_close($ch);

        if ($httpCode < 200 || $httpCode >= 300) {
            throw new Exception('API returned error code: ' . $httpCode);
        }

        $decodedResponse = json_decode($response, true);
        if (!$decodedResponse || !isset($decodedResponse['choices'][0]['message']['content'])) {
            throw new Exception('Invalid API response format');
        }

        $content = trim($decodedResponse['choices'][0]['message']['content']);

        $jsonStart = strpos($content, '{');
        $jsonEnd = strrpos($content, '}');

        if ($jsonStart === false || $jsonEnd === false) {
            throw new Exception('AI response does not contain JSON');
        }

        $jsonString = substr($content, $jsonStart, $jsonEnd - $jsonStart + 1);
        $decodedJson = json_decode($jsonString, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Failed to decode AI JSON: ' . json_last_error_msg());
        }

        if (!isset($decodedJson['recommended_careers']) || !is_array($decodedJson['recommended_careers'])) {
            throw new Exception('Invalid JSON structure');
        }

        return $decodedJson;
    }
}
?>