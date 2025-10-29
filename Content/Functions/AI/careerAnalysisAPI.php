<?php
class CareerAnalysisAPI {
    private $apiKey;
    private $apiUrl;
    private $model;
    private $maxRetries = 3;
    private $retryDelaySeconds = 1;

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

        // Attempt requests with retries to improve reliability
        $lastException = null;
        for ($attempt = 1; $attempt <= $this->maxRetries; $attempt++) {
            try {
                $payload = [
                    'model' => $this->model,
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'You are an expert career counselor AI with deep knowledge of personality assessment, academic performance analysis, and career matching. You MUST always provide exactly 5 career recommendations in valid JSON format. Never provide fewer than 5 recommendations, and always ensure your response is properly formatted JSON.'
                        ],
                        [
                            'role' => 'user',
                            'content' => $prompt
                        ]
                    ],
                    'temperature' => 0.2,
                    'max_tokens' => 3000
                ];

                $result = $this->makeAPIRequest($payload);

                // makeAPIRequest already validates and returns decoded JSON array
                if (is_array($result) && isset($result['recommended_careers']) && is_array($result['recommended_careers']) && count($result['recommended_careers']) === 5) {
                    return $result;
                }

                throw new Exception('AI returned invalid recommendation structure or not exactly 5 recommendations.');
            } catch (Exception $ex) {
                $lastException = $ex;
                // small backoff
                if ($attempt < $this->maxRetries) {
                    sleep($this->retryDelaySeconds);
                }
            }
        }

        // If all retries failed, bubble up last exception
        throw new Exception('AI analysis failed after retries: ' . ($lastException ? $lastException->getMessage() : 'unknown error'));
    }

    private function buildAnalysisPrompt($quizAnswers, $coreSubjects, $mbtiType) {
        // Ensure we have valid MBTI type
        if (empty($mbtiType) || $mbtiType === 'unknown') {
            $mbtiType = 'ISFJ'; // Default for prompt completeness
        }

        $prompt = "As a career counselor, analyze this student profile and provide EXACTLY 5 career recommendations. You must respond with valid JSON only.\n\n";
        
        // Add MBTI information with characteristics
        $prompt .= "MBTI Personality Type: {$mbtiType}\n";
        $prompt .= $this->getMBTICharacteristics($mbtiType) . "\n\n";
        
        // Add core subject grades with analysis
        $prompt .= "Academic Performance (Grades out of 100):\n";
        $totalGrade = 0;
        $subjectCount = 0;
        $strongSubjects = [];
        $weakSubjects = [];
        
        foreach ($coreSubjects as $subject => $grade) {
            if ($subject !== 'mbti_type' && is_numeric($grade)) {
                $subjectName = $this->formatSubjectName($subject);
                $prompt .= "- {$subjectName}: {$grade}/100\n";
                
                $numGrade = floatval($grade);
                $totalGrade += $numGrade;
                $subjectCount++;
                
                if ($numGrade >= 85) {
                    $strongSubjects[] = $subjectName;
                } elseif ($numGrade < 75) {
                    $weakSubjects[] = $subjectName;
                }
            }
        }
        
        $averageGrade = $subjectCount > 0 ? $totalGrade / $subjectCount : 75;
        $prompt .= "Average Grade: " . round($averageGrade, 1) . "/100\n";
        if (!empty($strongSubjects)) {
            $prompt .= "Strong Subjects: " . implode(', ', $strongSubjects) . "\n";
        }
        if (!empty($weakSubjects)) {
            $prompt .= "Areas for Improvement: " . implode(', ', $weakSubjects) . "\n";
        }
        
        // Add quiz responses analysis
        $prompt .= "\nPersonality Quiz Analysis (Scale 1-7):\n";
        $personalityScores = $this->analyzeQuizResponses($quizAnswers);
        foreach ($personalityScores as $trait => $score) {
            $prompt .= "- {$trait}: {$score}/7\n";
        }
        
        // Detailed instructions for response format
        $prompt .= "\n" . $this->getResponseInstructions();

        return $prompt;
    }

    private function getMBTICharacteristics($mbtiType) {
        $characteristics = [
            'INTJ' => 'Strategic thinker, independent, analytical, prefers complex problems',
            'INTP' => 'Logical thinker, curious, theoretical, loves understanding systems',
            'ENTJ' => 'Natural leader, strategic, efficient, goal-oriented',
            'ENTP' => 'Innovative, enthusiastic, strategic, good at seeing possibilities',
            'INFJ' => 'Insightful, creative, inspiring, focused on helping others',
            'INFP' => 'Idealistic, loyal, adaptable, interested in understanding people',
            'ENFJ' => 'Warm, empathetic, responsive, responsible for others',
            'ENFP' => 'Enthusiastic, creative, spontaneous, people-focused',
            'ISTJ' => 'Practical, fact-minded, reliable, responsible',
            'ISFJ' => 'Warm-hearted, conscientious, cooperative, supportive',
            'ESTJ' => 'Practical, realistic, matter-of-fact, decisive',
            'ESFJ' => 'Warm-hearted, conscientious, cooperative, harmonious',
            'ISTP' => 'Tolerant, flexible, quiet observer, hands-on problem solver',
            'ISFP' => 'Quiet, friendly, sensitive, kind, artistic',
            'ESTP' => 'Flexible, tolerant, pragmatic, focused on immediate results',
            'ESFP' => 'Outgoing, friendly, accepting, enthusiastic about life'
        ];
        
        return $characteristics[$mbtiType] ?? 'Balanced personality with diverse interests';
    }

    private function formatSubjectName($subject) {
        $nameMap = [
            'Statistics_and_Probability' => 'Statistics and Probability',
            'Physical_Science' => 'Physical Science',
            'oral_comm_context' => 'Oral Communication',
            'general_math' => 'General Mathematics',
            'earth_life_sci' => 'Earth and Life Science',
            'ucsp' => 'Understanding Culture, Society and Politics',
            'reading_writing' => 'Reading and Writing',
            'lit21_ph_world' => 'Literature (21st Century Philippine and World)',
            'media_info_lit' => 'Media and Information Literacy'
        ];
        
        return $nameMap[$subject] ?? str_replace('_', ' ', ucwords($subject, '_'));
    }

    private function analyzeQuizResponses($quizAnswers) {
        // Group questions by personality traits and calculate averages
        $traitScores = [];
        $traitCounts = [];
        
        foreach ($quizAnswers as $questionId => $answer) {
            // Simple trait mapping based on question patterns
            $trait = $this->mapQuestionToTrait($questionId);
            
            if (!isset($traitScores[$trait])) {
                $traitScores[$trait] = 0;
                $traitCounts[$trait] = 0;
            }
            
            $traitScores[$trait] += intval($answer);
            $traitCounts[$trait]++;
        }
        
        $averageScores = [];
        foreach ($traitScores as $trait => $totalScore) {
            $averageScores[$trait] = round($totalScore / $traitCounts[$trait], 1);
        }
        
        return $averageScores;
    }

    private function mapQuestionToTrait($questionId) {
        // Map questions to personality traits (this is a simplified mapping)
        $questionNumber = intval(str_replace('q', '', $questionId));
        
        if ($questionNumber <= 25) return 'Analytical Thinking';
        elseif ($questionNumber <= 50) return 'Social Interaction';
        elseif ($questionNumber <= 75) return 'Creative Expression';
        elseif ($questionNumber <= 100) return 'Leadership Tendency';
        else return 'Problem Solving';
    }

    private function getResponseInstructions() {
        return "CRITICAL INSTRUCTIONS:
1. You MUST provide exactly 5 career recommendations
2. Response MUST be valid JSON only (no additional text before or after)
3. Each career MUST have realistic match percentages (60-95%)
4. Base recommendations on the provided data
5. Include diverse career options from different fields

Required JSON format:
{
  \"recommended_careers\": [
    {
      \"title\": \"Career Name\",
      \"match_percentage\": 85,
      \"description\": \"Brief 1-2 sentence description of the career\",
      \"why_good_fit\": \"Specific explanation based on MBTI, grades, and personality scores\",
      \"salary_range\": \"$40,000 - $80,000\",
      \"growth_outlook\": \"High\",
      \"education_required\": \"Bachelor's degree in relevant field\",
      \"key_skills\": [\"skill1\", \"skill2\", \"skill3\"]
    }
  ],
  \"personality_analysis\": {
    \"key_traits\": [\"trait1\", \"trait2\", \"trait3\"],
    \"strengths\": [\"strength1\", \"strength2\"],
    \"areas_for_development\": [\"area1\", \"area2\"]
  },
  \"academic_analysis\": {
    \"strongest_subjects\": [\"subject1\", \"subject2\"],
    \"recommendations\": [\"recommendation1\", \"recommendation2\"]
  }
}

Provide ONLY the JSON response above, no other text.";
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
        curl_setopt($ch, CURLOPT_TIMEOUT, 60); // Increased timeout
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For development

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if (curl_error($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new Exception('API request failed: ' . $error);
        }
        
        curl_close($ch);

        if ($httpCode < 200 || $httpCode >= 300) {
            throw new Exception('API returned error code: ' . $httpCode . '. Response: ' . $response);
        }

        $decodedResponse = json_decode($response, true);
        if (!$decodedResponse || !isset($decodedResponse['choices'][0]['message']['content'])) {
            throw new Exception('Invalid API response format: ' . $response);
        }

        $content = trim($decodedResponse['choices'][0]['message']['content']);

        // Attempt to locate JSON content and decode it
        $jsonStart = strpos($content, '{');
        $jsonEnd = strrpos($content, '}');

        if ($jsonStart === false || $jsonEnd === false) {
            throw new Exception('AI response does not contain JSON object: ' . $content);
        }

        $jsonString = substr($content, $jsonStart, $jsonEnd - $jsonStart + 1);
        $decodedJson = json_decode($jsonString, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Failed to decode AI JSON: ' . json_last_error_msg() . '. Raw: ' . $content);
        }

        // Validate required structure minimally
        if (!isset($decodedJson['recommended_careers']) || !is_array($decodedJson['recommended_careers'])) {
            throw new Exception('Decoded JSON missing recommended_careers: ' . json_encode(array_keys($decodedJson)));
        }

        return $decodedJson;
    }
}