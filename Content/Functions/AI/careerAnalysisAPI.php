<?php

class CareerAnalysisAPI {
    private $apiKey;
    private $apiUrl;
    private $model;

    public function __construct() {
        $envFile = '../../../Config/API/.env';
        $config = $this->loadEnv($envFile);
        
        $this->apiKey = $config['api_key'];
        $this->apiUrl = $config['api_url'];
        $this->model = $config['model'];
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
        
        $payload = [
            'model' => $this->model,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a career counselor AI with expertise in personality assessment, academic performance analysis, and career matching. Provide comprehensive career recommendations based on quiz responses, academic grades, and MBTI personality type.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'temperature' => 0.7,
            'max_tokens' => 2000
        ];

        return $this->makeAPIRequest($payload);
    }

    private function buildAnalysisPrompt($quizAnswers, $coreSubjects, $mbtiType) {
        $prompt = "Please analyze the following student profile and provide career recommendations:\n\n";
        
        // Add MBTI information
        $prompt .= "MBTI Personality Type: {$mbtiType}\n\n";
        
        // Add core subject grades
        $prompt .= "Academic Performance (Core Subjects):\n";
        foreach ($coreSubjects as $subject => $grade) {
            if ($subject !== 'mbti_type') {
                $subjectName = str_replace('_', ' ', ucwords($subject, '_'));
                $prompt .= "- {$subjectName}: {$grade}/100\n";
            }
        }
        
        // Add quiz responses summary
        $prompt .= "\nPersonality Quiz Responses (1-7 scale):\n";
        foreach ($quizAnswers as $questionId => $answer) {
            $prompt .= "Question {$questionId}: {$answer}\n";
        }
        
        $prompt .= "\nPlease provide:\n";
        $prompt .= "1. Top 5 career recommendations with match percentages\n";
        $prompt .= "2. Brief explanation for each recommendation\n";
        $prompt .= "3. Key personality traits that influence career fit\n";
        $prompt .= "4. Academic strengths based on grades\n";
        $prompt .= "5. Areas for development\n\n";
        $prompt .= "Format the response as JSON with the following structure:\n";
        $prompt .= "{\n";
        $prompt .= '  "recommended_careers": [';
        $prompt .= '    {"title": "Career Name", "match_percentage": 90, "description": "...", "why_good_fit": "...", "salary_range": "$X - $Y", "growth_outlook": "High/Medium/Low"}';
        $prompt .= '  ],';
        $prompt .= '  "personality_analysis": {"key_traits": ["trait1", "trait2"], "strengths": ["strength1"], "areas_for_development": ["area1"]},';
        $prompt .= '  "academic_analysis": {"strongest_subjects": ["subject1"], "recommendations": ["rec1"]}';
        $prompt .= "}";

        return $prompt;
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
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if (curl_error($ch)) {
            curl_close($ch);
            throw new Exception('API request failed: ' . curl_error($ch));
        }
        
        curl_close($ch);

        if ($httpCode !== 200) {
            throw new Exception('API returned error code: ' . $httpCode);
        }

        $decodedResponse = json_decode($response, true);
        
        if (!$decodedResponse || !isset($decodedResponse['choices'][0]['message']['content'])) {
            throw new Exception('Invalid API response format');
        }

        return $decodedResponse['choices'][0]['message']['content'];
    }
}