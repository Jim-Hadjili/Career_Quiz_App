<?php

class AICareerAnalyzer {
    private $apiKey;
    private $apiUrl;
    private $model;
    private $philippineCareers;

    public function __construct() {
        // Load environment variables
        $envPath = '../../../Config/API/.env';
        $this->loadEnvVariables($envPath);
        $this->initializePhilippineCareers();
    }

    private function loadEnvVariables($path) {
        if (file_exists($path)) {
            $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
                    list($key, $value) = explode('=', $line, 2);
                    $key = trim($key);
                    $value = trim($value);
                    
                    switch($key) {
                        case 'api_key':
                            $this->apiKey = $value;
                            break;
                        case 'api_url':
                            $this->apiUrl = $value;
                            break;
                        case 'model':
                            $this->model = $value;
                            break;
                    }
                }
            }
        }
    }

    private function initializePhilippineCareers() {
        $this->philippineCareers = [
            'technology' => [
                [
                    'title' => 'Software Developer',
                    'specializations' => ['Web Developer', 'Mobile App Developer', 'Game Developer', 'Full-Stack Developer'],
                    'skills' => ['Programming (PHP, JavaScript, Python)', 'Database Management', 'Problem Solving', 'Software Testing'],
                    'education' => 'Bachelor\'s in Computer Science, Information Technology, or related field',
                    'salary_range' => '₱25,000 - ₱80,000/month',
                    'growth' => 'Senior Developer → Team Lead → Technical Manager → CTO',
                    'demand' => 'Very High - Growing IT-BPO industry in PH'
                ],
                [
                    'title' => 'Data Scientist',
                    'specializations' => ['Business Intelligence Analyst', 'Machine Learning Engineer', 'Data Analyst', 'Statistician'],
                    'skills' => ['Python/R Programming', 'SQL', 'Statistical Analysis', 'Machine Learning', 'Data Visualization'],
                    'education' => 'Bachelor\'s in Statistics, Mathematics, Computer Science, or Engineering',
                    'salary_range' => '₱35,000 - ₱100,000/month',
                    'growth' => 'Junior Analyst → Senior Data Scientist → Lead Data Scientist → Chief Data Officer',
                    'demand' => 'High - Growing demand for data-driven decisions'
                ],
                [
                    'title' => 'Cybersecurity Specialist',
                    'specializations' => ['Security Analyst', 'Ethical Hacker', 'Security Consultant', 'Network Security Engineer'],
                    'skills' => ['Network Security', 'Risk Assessment', 'Incident Response', 'Ethical Hacking', 'Compliance'],
                    'education' => 'Bachelor\'s in IT, Computer Science, or Cybersecurity certifications',
                    'salary_range' => '₱40,000 - ₱120,000/month',
                    'growth' => 'Security Analyst → Senior Security Specialist → Security Manager → CISO',
                    'demand' => 'Very High - Critical need for cybersecurity in digital transformation'
                ],
                [
                    'title' => 'IT Support Specialist',
                    'specializations' => ['Help Desk Technician', 'Network Administrator', 'Systems Administrator', 'IT Consultant'],
                    'skills' => ['Technical Troubleshooting', 'Customer Service', 'Network Management', 'Hardware/Software Installation'],
                    'education' => 'Associate/Bachelor\'s in IT or relevant certifications (CompTIA, Cisco)',
                    'salary_range' => '₱18,000 - ₱45,000/month',
                    'growth' => 'IT Support → Senior Technician → IT Manager → IT Director',
                    'demand' => 'High - Essential role in all industries'
                ]
            ],
            'business' => [
                [
                    'title' => 'Business Analyst',
                    'specializations' => ['Process Analyst', 'Systems Analyst', 'Financial Analyst', 'Market Research Analyst'],
                    'skills' => ['Data Analysis', 'Process Improvement', 'Project Management', 'Requirements Gathering', 'Communication'],
                    'education' => 'Bachelor\'s in Business Administration, Economics, or related field',
                    'salary_range' => '₱30,000 - ₱70,000/month',
                    'growth' => 'Junior Analyst → Senior Business Analyst → Business Consultant → Strategy Director',
                    'demand' => 'High - Digital transformation driving demand'
                ],
                [
                    'title' => 'Project Manager',
                    'specializations' => ['IT Project Manager', 'Construction Project Manager', 'Marketing Project Manager', 'Operations Manager'],
                    'skills' => ['Project Planning', 'Team Leadership', 'Risk Management', 'Budget Management', 'Stakeholder Communication'],
                    'education' => 'Bachelor\'s degree + PMP/PRINCE2 certification preferred',
                    'salary_range' => '₱40,000 - ₱100,000/month',
                    'growth' => 'Assistant PM → Project Manager → Senior PM → Program Manager → Portfolio Manager',
                    'demand' => 'Very High - Essential in all major projects'
                ],
                [
                    'title' => 'Digital Marketing Specialist',
                    'specializations' => ['Social Media Manager', 'SEO Specialist', 'Content Marketing Manager', 'PPC Specialist'],
                    'skills' => ['Digital Marketing', 'Social Media Management', 'SEO/SEM', 'Content Creation', 'Analytics'],
                    'education' => 'Bachelor\'s in Marketing, Communications, or related field',
                    'salary_range' => '₱25,000 - ₱60,000/month',
                    'growth' => 'Marketing Assistant → Specialist → Marketing Manager → Marketing Director',
                    'demand' => 'Very High - E-commerce and digital business growth'
                ],
                [
                    'title' => 'Human Resources Specialist',
                    'specializations' => ['Recruiter', 'Training Specialist', 'Compensation Analyst', 'Employee Relations Specialist'],
                    'skills' => ['Recruitment', 'Employee Relations', 'Training & Development', 'Performance Management', 'Labor Law'],
                    'education' => 'Bachelor\'s in HR, Psychology, or Business Administration',
                    'salary_range' => '₱22,000 - ₱55,000/month',
                    'growth' => 'HR Assistant → HR Specialist → HR Manager → HR Director',
                    'demand' => 'High - Growing focus on employee experience'
                ]
            ],
            'healthcare' => [
                [
                    'title' => 'Registered Nurse',
                    'specializations' => ['ICU Nurse', 'OR Nurse', 'Pediatric Nurse', 'Community Health Nurse'],
                    'skills' => ['Patient Care', 'Medical Procedures', 'Critical Thinking', 'Communication', 'Compassion'],
                    'education' => 'Bachelor of Science in Nursing + PRC License',
                    'salary_range' => '₱20,000 - ₱45,000/month (Local), $3,000-5,000/month (Abroad)',
                    'growth' => 'Staff Nurse → Senior Nurse → Nurse Supervisor → Chief Nurse',
                    'demand' => 'Very High - Global demand, especially abroad'
                ],
                [
                    'title' => 'Medical Technologist',
                    'specializations' => ['Clinical Laboratory Scientist', 'Blood Bank Technologist', 'Microbiology Technologist', 'Pathology Assistant'],
                    'skills' => ['Laboratory Testing', 'Quality Control', 'Equipment Operation', 'Data Analysis', 'Attention to Detail'],
                    'education' => 'Bachelor of Science in Medical Technology + PRC License',
                    'salary_range' => '₱18,000 - ₱40,000/month',
                    'growth' => 'Staff MedTech → Senior MedTech → Laboratory Supervisor → Laboratory Manager',
                    'demand' => 'High - Essential in hospitals and diagnostic centers'
                ],
                [
                    'title' => 'Physical Therapist',
                    'specializations' => ['Sports Physical Therapist', 'Pediatric PT', 'Geriatric PT', 'Orthopedic PT'],
                    'skills' => ['Manual Therapy', 'Exercise Prescription', 'Patient Assessment', 'Rehabilitation Planning', 'Empathy'],
                    'education' => 'Doctor of Physical Therapy + PRC License',
                    'salary_range' => '₱25,000 - ₱60,000/month',
                    'growth' => 'Staff PT → Senior PT → PT Supervisor → Rehabilitation Manager',
                    'demand' => 'High - Aging population and sports medicine growth'
                ],
                [
                    'title' => 'Pharmacist',
                    'specializations' => ['Clinical Pharmacist', 'Community Pharmacist', 'Hospital Pharmacist', 'Industrial Pharmacist'],
                    'skills' => ['Drug Knowledge', 'Patient Counseling', 'Prescription Review', 'Clinical Assessment', 'Regulatory Compliance'],
                    'education' => 'Doctor of Pharmacy + PRC License',
                    'salary_range' => '₱25,000 - ₱70,000/month',
                    'growth' => 'Staff Pharmacist → Senior Pharmacist → Pharmacy Manager → Director of Pharmacy',
                    'demand' => 'High - Healthcare expansion and aging population'
                ]
            ],
            'education' => [
                [
                    'title' => 'Licensed Professional Teacher',
                    'specializations' => ['Elementary Teacher', 'High School Teacher', 'Special Education Teacher', 'ESL Teacher'],
                    'skills' => ['Curriculum Development', 'Classroom Management', 'Student Assessment', 'Communication', 'Patience'],
                    'education' => 'Bachelor\'s of Elementary/Secondary Education + LET License',
                    'salary_range' => '₱20,000 - ₱40,000/month (Public), ₱25,000 - ₱60,000/month (Private)',
                    'growth' => 'Teacher → Master Teacher → Principal → Schools Division Superintendent',
                    'demand' => 'Moderate - Stable demand in public and private sectors'
                ],
                [
                    'title' => 'Corporate Trainer',
                    'specializations' => ['Technical Trainer', 'Soft Skills Trainer', 'Leadership Development Specialist', 'E-learning Developer'],
                    'skills' => ['Training Design', 'Presentation Skills', 'Adult Learning Principles', 'Assessment Methods', 'Technology Tools'],
                    'education' => 'Bachelor\'s degree + Training certifications',
                    'salary_range' => '₱30,000 - ₱70,000/month',
                    'growth' => 'Trainer → Senior Trainer → Training Manager → Learning & Development Director',
                    'demand' => 'High - Corporate focus on employee development'
                ]
            ],
            'finance' => [
                [
                    'title' => 'Financial Analyst',
                    'specializations' => ['Investment Analyst', 'Credit Analyst', 'Budget Analyst', 'Risk Analyst'],
                    'skills' => ['Financial Modeling', 'Data Analysis', 'Excel/Financial Software', 'Report Writing', 'Critical Thinking'],
                    'education' => 'Bachelor\'s in Finance, Accounting, Economics, or Business',
                    'salary_range' => '₱30,000 - ₱80,000/month',
                    'growth' => 'Junior Analyst → Senior Analyst → Finance Manager → Finance Director',
                    'demand' => 'High - Growing financial services sector'
                ],
                [
                    'title' => 'Certified Public Accountant',
                    'specializations' => ['Auditor', 'Tax Consultant', 'Management Accountant', 'Forensic Accountant'],
                    'skills' => ['Financial Reporting', 'Auditing', 'Tax Preparation', 'Compliance', 'Analytical Skills'],
                    'education' => 'Bachelor of Science in Accountancy + CPA License',
                    'salary_range' => '₱25,000 - ₱70,000/month',
                    'growth' => 'Staff Accountant → Senior Accountant → Accounting Manager → CFO',
                    'demand' => 'High - Required in all businesses'
                ]
            ],
            'legal' => [
                [
                    'title' => 'Lawyer/Attorney',
                    'specializations' => ['Corporate Lawyer', 'Criminal Defense Attorney', 'Family Lawyer', 'Labor Lawyer'],
                    'skills' => ['Legal Research', 'Case Analysis', 'Negotiation', 'Court Representation', 'Communication'],
                    'education' => 'Bachelor\'s degree + Juris Doctor + Bar Exam',
                    'salary_range' => '₱30,000 - ₱150,000/month (varies widely)',
                    'growth' => 'Associate → Senior Associate → Partner → Managing Partner',
                    'demand' => 'Moderate - Competitive field with steady demand'
                ],
                [
                    'title' => 'Paralegal',
                    'specializations' => ['Litigation Paralegal', 'Corporate Paralegal', 'Real Estate Paralegal', 'Criminal Paralegal'],
                    'skills' => ['Legal Research', 'Document Preparation', 'Case Management', 'Client Communication', 'Attention to Detail'],
                    'education' => 'Bachelor\'s degree + Paralegal certification',
                    'salary_range' => '₱20,000 - ₱45,000/month',
                    'growth' => 'Paralegal → Senior Paralegal → Paralegal Supervisor → Legal Manager',
                    'demand' => 'Moderate - Support role for law firms'
                ]
            ],
            'creative' => [
                [
                    'title' => 'Graphic Designer',
                    'specializations' => ['Web Designer', 'Brand Designer', 'UI/UX Designer', 'Print Designer'],
                    'skills' => ['Adobe Creative Suite', 'Typography', 'Color Theory', 'Layout Design', 'Client Communication'],
                    'education' => 'Bachelor\'s in Fine Arts, Multimedia, or related field',
                    'salary_range' => '₱20,000 - ₱50,000/month',
                    'growth' => 'Junior Designer → Senior Designer → Art Director → Creative Director',
                    'demand' => 'High - Digital marketing and branding growth'
                ],
                [
                    'title' => 'Content Creator',
                    'specializations' => ['Social Media Content Creator', 'Video Producer', 'Blog Writer', 'Podcast Host'],
                    'skills' => ['Content Writing', 'Video Editing', 'Social Media Management', 'SEO', 'Audience Engagement'],
                    'education' => 'Bachelor\'s in Communications, Marketing, or Multimedia Arts',
                    'salary_range' => '₱18,000 - ₱60,000/month',
                    'growth' => 'Content Creator → Senior Creator → Content Manager → Content Strategy Director',
                    'demand' => 'Very High - Social media and digital content boom'
                ]
            ]
        ];
    }

    public function analyzeCareerFit($quizData, $userName = 'User') {
        // Prepare the quiz responses for AI analysis
        $responses = $this->formatQuizResponses($quizData);
        
        // Create the AI prompt with Philippine career context
        $prompt = $this->createPhilippineCareerPrompt($responses, $userName);
        
        // Make API call to OpenRouter
        $analysis = $this->callAI($prompt);
        
        if ($analysis) {
            return $this->parseAIResponse($analysis);
        }
        
        // Fallback to basic analysis if AI fails
        return $this->fallbackPhilippineAnalysis($quizData);
    }

    private function formatQuizResponses($quizData) {
        $categories = [
            'technology' => [],
            'business' => [],
            'healthcare' => [],
            'education' => [],
            'finance' => [],
            'legal' => [],
            'creative' => []
        ];
        
        $questions = [
            1 => "I enjoy working with computers and technology",
            2 => "I like leading teams and managing projects", 
            3 => "I find satisfaction in helping people with their health",
            4 => "I enjoy analyzing data and solving complex problems",
            5 => "I like developing business strategies and plans"
        ];

        foreach ($quizData as $response) {
            $questionId = (int)$response['question_id'];
            $score = (int)$response['scale_value'];
            $category = $response['category'];
            
            if (isset($questions[$questionId])) {
                $categories[$category][] = [
                    'question' => $questions[$questionId],
                    'score' => $score,
                    'agreement_level' => $this->getAgreementLevel($score)
                ];
            }
        }

        return $categories;
    }

    private function getAgreementLevel($score) {
        $levels = [
            1 => 'Strongly Disagree',
            2 => 'Disagree', 
            3 => 'Somewhat Disagree',
            4 => 'Neutral',
            5 => 'Somewhat Agree',
            6 => 'Agree',
            7 => 'Strongly Agree'
        ];
        
        return $levels[$score] ?? 'Unknown';
    }

    private function createPhilippineCareerPrompt($responses, $userName) {
        $prompt = "You are a professional career counselor specializing in the Philippine job market. Analyze the following quiz responses from {$userName} and provide detailed career recommendations specifically relevant to the Philippines job market, salary ranges, and educational requirements.\n\n";
        
        $prompt .= "Quiz Responses:\n";
        foreach ($responses as $category => $categoryResponses) {
            if (!empty($categoryResponses)) {
                $prompt .= "\n" . ucfirst($category) . " Category:\n";
                foreach ($categoryResponses as $response) {
                    $prompt .= "- \"{$response['question']}\" - Response: {$response['score']}/7 ({$response['agreement_level']})\n";
                }
            }
        }

        $prompt .= "\n\nAvailable Philippine Career Categories and Examples:\n";
        foreach ($this->philippineCareers as $category => $careers) {
            $prompt .= "\n" . ucfirst($category) . ":\n";
            foreach (array_slice($careers, 0, 2) as $career) {
                $prompt .= "- {$career['title']}: {$career['salary_range']}\n";
            }
        }

        $prompt .= "\n\nPlease provide a comprehensive career analysis in the following JSON format, focusing on specific Philippine careers:\n";
        $prompt .= "{\n";
        $prompt .= "  \"personality_summary\": \"Brief personality analysis based on responses\",\n";
        $prompt .= "  \"top_recommendations\": [\n";
        $prompt .= "    {\n";
        $prompt .= "      \"career\": \"Specific Career Title (e.g., Software Developer, Registered Nurse)\",\n";
        $prompt .= "      \"category\": \"technology|business|healthcare|education|finance|legal|creative\",\n";
        $prompt .= "      \"match_percentage\": 85,\n";
        $prompt .= "      \"why_good_fit\": \"Detailed explanation based on quiz responses\",\n";
        $prompt .= "      \"required_skills\": [\"skill1\", \"skill2\", \"skill3\"],\n";
        $prompt .= "      \"education_path\": \"Philippine educational requirements\",\n";
        $prompt .= "      \"salary_range\": \"Philippine peso salary range\",\n";
        $prompt .= "      \"growth_opportunities\": \"Career progression in Philippines\",\n";
        $prompt .= "      \"demand_in_ph\": \"Job market demand in Philippines\"\n";
        $prompt .= "    }\n";
        $prompt .= "  ],\n";
        $prompt .= "  \"strengths\": [\"strength1\", \"strength2\", \"strength3\"],\n";
        $prompt .= "  \"areas_for_development\": [\"area1\", \"area2\"],\n";
        $prompt .= "  \"next_steps\": [\"actionable step1 for Philippines\", \"actionable step2 for Philippines\"]\n";
        $prompt .= "}\n\n";
        $prompt .= "Provide 3-5 specific career recommendations ranked by fit. Use Philippine peso for salaries and focus on careers available in the Philippines. Be encouraging and provide actionable Philippine-specific advice.";

        return $prompt;
    }

    private function callAI($prompt) {
        $headers = [
            'Authorization: Bearer ' . $this->apiKey,
            'Content-Type: application/json',
            'HTTP-Referer: http://localhost',
            'X-Title: Career Quiz App Philippines'
        ];

        $data = [
            'model' => $this->model,
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'max_tokens' => 2500,
            'temperature' => 0.7
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200 && $response) {
            $decodedResponse = json_decode($response, true);
            if (isset($decodedResponse['choices'][0]['message']['content'])) {
                return $decodedResponse['choices'][0]['message']['content'];
            }
        }

        return false;
    }

    private function parseAIResponse($response) {
        // Try to extract JSON from the response
        $jsonStart = strpos($response, '{');
        $jsonEnd = strrpos($response, '}');
        
        if ($jsonStart !== false && $jsonEnd !== false) {
            $jsonString = substr($response, $jsonStart, $jsonEnd - $jsonStart + 1);
            $decoded = json_decode($jsonString, true);
            
            if ($decoded) {
                return $decoded;
            }
        }
        
        // If JSON parsing fails, return a structured fallback
        return $this->createFallbackFromText($response);
    }

    private function createFallbackFromText($response) {
        return [
            'personality_summary' => 'Based on your quiz responses, you show diverse interests across multiple career areas with strong potential for success in the Philippine job market.',
            'top_recommendations' => [
                [
                    'career' => 'Software Developer',
                    'category' => 'technology',
                    'match_percentage' => 75,
                    'why_good_fit' => 'Your responses indicate strong interest in technology and problem-solving, which are essential for software development.',
                    'required_skills' => ['Programming (PHP, JavaScript, Python)', 'Problem Solving', 'Database Management'],
                    'education_path' => 'Bachelor\'s in Computer Science, Information Technology, or related field',
                    'salary_range' => '₱25,000 - ₱80,000/month',
                    'growth_opportunities' => 'Senior Developer → Team Lead → Technical Manager → CTO',
                    'demand_in_ph' => 'Very High - Growing IT-BPO industry and digital transformation'
                ]
            ],
            'strengths' => ['Analytical thinking', 'Problem solving', 'Adaptability'],
            'areas_for_development' => ['Technical skills', 'Communication skills'],
            'next_steps' => ['Enroll in programming courses at local universities or online', 'Build a portfolio with Philippine-relevant projects']
        ];
    }

    private function fallbackPhilippineAnalysis($quizData) {
        $categories = ['technology' => 0, 'business' => 0, 'healthcare' => 0];
        
        foreach ($quizData as $answer) {
            if (isset($categories[$answer['category']])) {
                $categories[$answer['category']] += (int)$answer['scale_value'];
            }
        }
        
        arsort($categories);
        $topCategory = array_key_first($categories);
        
        // Get specific Philippine career for top category
        $topCareer = $this->philippineCareers[$topCategory][0] ?? $this->philippineCareers['business'][0];
        
        return [
            'personality_summary' => "Your responses show a strong alignment with {$topCategory} careers, which have excellent opportunities in the Philippine job market.",
            'top_recommendations' => [
                [
                    'career' => $topCareer['title'],
                    'category' => $topCategory,
                    'match_percentage' => 80,
                    'why_good_fit' => "Your quiz responses indicate strong interest and aptitude for {$topCategory}, particularly suited for " . $topCareer['title'] . " role.",
                    'required_skills' => $topCareer['skills'],
                    'education_path' => $topCareer['education'],
                    'salary_range' => $topCareer['salary_range'],
                    'growth_opportunities' => $topCareer['growth'],
                    'demand_in_ph' => $topCareer['demand']
                ]
            ],
            'strengths' => ['Strong interest alignment', 'Good analytical foundation', 'Adaptability'],
            'areas_for_development' => ['Industry-specific skills', 'Professional networking'],
            'next_steps' => [
                'Research specific educational programs in Philippines for ' . $topCareer['title'],
                'Connect with professionals in the field through LinkedIn or local professional organizations',
                'Consider internships or entry-level positions to gain experience'
            ]
        ];
    }
}
?>