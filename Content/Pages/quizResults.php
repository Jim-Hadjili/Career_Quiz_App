<?php 
include "../Functions/quizPageFunctions/quizPageFunction.php";

// Get result parameters
$resultId = $_GET['result_id'] ?? null;
$mode = $_GET['mode'] ?? 'guest';

if (!$resultId) {
    header('Location: ../../index.php');
    exit;
}

// Fetch quiz results from database
try {
    $stmt = $conn->prepare("
        SELECT result_id, user_id, session_id, quiz_data, recommended_careers, 
               completion_date, is_guest 
        FROM quiz_results_tb 
        WHERE result_id = ?
    ");
    $stmt->bind_param("i", $resultId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        header('Location: ../../index.php');
        exit;
    }
    
    $quizResult = $result->fetch_assoc();
    $quizData = json_decode($quizResult['quiz_data'], true);
    $allRecommendations = json_decode($quizResult['recommended_careers'], true);
    
    // Extract AI analysis and basic recommendations
    $aiAnalysis = $allRecommendations['ai_analysis'] ?? null;
    $basicRecommendations = $allRecommendations['basic_recommendations'] ?? $allRecommendations;
    
    $isGuest = $quizResult['is_guest'];
    
    // Get user info if not guest
    $userName = 'Guest User';
    if (!$isGuest && $quizResult['user_id']) {
        $userStmt = $conn->prepare("SELECT userName FROM users_tb WHERE user_id = ?");
        $userStmt->bind_param("i", $quizResult['user_id']);
        $userStmt->execute();
        $userResult = $userStmt->get_result();
        if ($userResult->num_rows > 0) {
            $user = $userResult->fetch_assoc();
            $userName = $user['userName'];
        }
    }
    
} catch (Exception $e) {
    header('Location: ../../index.php');
    exit;
}

// Calculate total questions answered
$totalQuestions = count($quizData);
$completionDate = date('F j, Y', strtotime($quizResult['completion_date']));

// Calculate category scores for additional recommendations
function calculateCategoryScores($quizData) {
    $categories = [
        'technology' => 0,
        'business' => 0,
        'healthcare' => 0,
        'education' => 0,
        'finance' => 0,
        'legal' => 0,
        'creative' => 0
    ];
    
    foreach ($quizData as $answer) {
        if (isset($categories[$answer['category']])) {
            $categories[$answer['category']] += (int)$answer['scale_value'];
        }
    }
    
    arsort($categories);
    return $categories;
}

$categoryScores = calculateCategoryScores($quizData);

// Generate additional recommendations if AI analysis doesn't provide enough
function generateAdditionalRecommendations($categoryScores, $existingCount = 0) {
    $philippineCareers = [
        'technology' => [
            ['title' => 'Software Developer', 'salary' => '₱25,000 - ₱80,000/month', 'demand' => 'Very High'],
            ['title' => 'Data Scientist', 'salary' => '₱35,000 - ₱100,000/month', 'demand' => 'High'],
            ['title' => 'Cybersecurity Specialist', 'salary' => '₱40,000 - ₱120,000/month', 'demand' => 'Very High'],
            ['title' => 'IT Support Specialist', 'salary' => '₱18,000 - ₱45,000/month', 'demand' => 'High']
        ],
        'business' => [
            ['title' => 'Business Analyst', 'salary' => '₱30,000 - ₱70,000/month', 'demand' => 'High'],
            ['title' => 'Project Manager', 'salary' => '₱40,000 - ₱100,000/month', 'demand' => 'Very High'],
            ['title' => 'Digital Marketing Specialist', 'salary' => '₱25,000 - ₱60,000/month', 'demand' => 'Very High'],
            ['title' => 'Human Resources Specialist', 'salary' => '₱22,000 - ₱55,000/month', 'demand' => 'High']
        ],
        'healthcare' => [
            ['title' => 'Registered Nurse', 'salary' => '₱20,000 - ₱45,000/month', 'demand' => 'Very High'],
            ['title' => 'Medical Technologist', 'salary' => '₱18,000 - ₱40,000/month', 'demand' => 'High'],
            ['title' => 'Physical Therapist', 'salary' => '₱25,000 - ₱60,000/month', 'demand' => 'High'],
            ['title' => 'Pharmacist', 'salary' => '₱25,000 - ₱70,000/month', 'demand' => 'High']
        ],
        'education' => [
            ['title' => 'Licensed Professional Teacher', 'salary' => '₱20,000 - ₱60,000/month', 'demand' => 'Moderate'],
            ['title' => 'Corporate Trainer', 'salary' => '₱30,000 - ₱70,000/month', 'demand' => 'High']
        ],
        'finance' => [
            ['title' => 'Financial Analyst', 'salary' => '₱30,000 - ₱80,000/month', 'demand' => 'High'],
            ['title' => 'Certified Public Accountant', 'salary' => '₱25,000 - ₱70,000/month', 'demand' => 'High']
        ],
        'legal' => [
            ['title' => 'Lawyer/Attorney', 'salary' => '₱30,000 - ₱150,000/month', 'demand' => 'Moderate'],
            ['title' => 'Paralegal', 'salary' => '₱20,000 - ₱45,000/month', 'demand' => 'Moderate']
        ],
        'creative' => [
            ['title' => 'Graphic Designer', 'salary' => '₱20,000 - ₱50,000/month', 'demand' => 'High'],
            ['title' => 'Content Creator', 'salary' => '₱18,000 - ₱60,000/month', 'demand' => 'Very High']
        ]
    ];
    
    $recommendations = [];
    $rank = $existingCount + 1;
    
    foreach ($categoryScores as $category => $score) {
        if ($score > 0 && isset($philippineCareers[$category]) && count($recommendations) < (4 - $existingCount)) {
            $careers = $philippineCareers[$category];
            $selectedCareer = $careers[0]; // Take the first career from each category
            
            $matchPercentage = min(95, max(60, ($score / 35) * 100)); // Scale score to percentage
            
            $recommendations[] = [
                'career' => $selectedCareer['title'],
                'category' => $category,
                'match_percentage' => round($matchPercentage),
                'why_good_fit' => "Your quiz responses show strong alignment with {$category} careers, particularly in areas that {$selectedCareer['title']} professionals excel at.",
                'required_skills' => getSkillsForCareer($selectedCareer['title']),
                'education_path' => getEducationForCareer($selectedCareer['title']),
                'salary_range' => $selectedCareer['salary'],
                'growth_opportunities' => getGrowthForCareer($selectedCareer['title']),
                'demand_in_ph' => $selectedCareer['demand'] . ' demand in Philippine market'
            ];
            $rank++;
        }
    }
    
    return $recommendations;
}

function getSkillsForCareer($career) {
    $skills = [
        'Software Developer' => ['Programming', 'Problem Solving', 'Database Management', 'Software Testing'],
        'Data Scientist' => ['Python/R Programming', 'Statistical Analysis', 'Machine Learning', 'Data Visualization'],
        'Business Analyst' => ['Data Analysis', 'Process Improvement', 'Project Management', 'Communication'],
        'Registered Nurse' => ['Patient Care', 'Medical Procedures', 'Critical Thinking', 'Compassion'],
        'Licensed Professional Teacher' => ['Curriculum Development', 'Classroom Management', 'Communication', 'Patience'],
        'Financial Analyst' => ['Financial Modeling', 'Data Analysis', 'Excel', 'Report Writing'],
        'Lawyer/Attorney' => ['Legal Research', 'Case Analysis', 'Negotiation', 'Communication'],
        'Graphic Designer' => ['Adobe Creative Suite', 'Typography', 'Color Theory', 'Layout Design']
    ];
    
    return $skills[$career] ?? ['Professional Skills', 'Communication', 'Problem Solving', 'Analytical Thinking'];
}

function getEducationForCareer($career) {
    $education = [
        'Software Developer' => "Bachelor's in Computer Science, Information Technology, or related field",
        'Data Scientist' => "Bachelor's in Statistics, Mathematics, Computer Science, or Engineering",
        'Business Analyst' => "Bachelor's in Business Administration, Economics, or related field",
        'Registered Nurse' => "Bachelor of Science in Nursing + PRC License",
        'Licensed Professional Teacher' => "Bachelor of Elementary/Secondary Education + LET License",
        'Financial Analyst' => "Bachelor's in Finance, Accounting, Economics, or Business",
        'Lawyer/Attorney' => "Bachelor's degree + Juris Doctor + Bar Exam",
        'Graphic Designer' => "Bachelor's in Fine Arts, Multimedia, or related field"
    ];
    
    return $education[$career] ?? "Bachelor's degree in relevant field";
}

function getGrowthForCareer($career) {
    $growth = [
        'Software Developer' => 'Senior Developer → Team Lead → Technical Manager → CTO',
        'Data Scientist' => 'Junior Analyst → Senior Data Scientist → Lead Data Scientist → Chief Data Officer',
        'Business Analyst' => 'Junior Analyst → Senior Business Analyst → Business Consultant → Strategy Director',
        'Registered Nurse' => 'Staff Nurse → Senior Nurse → Nurse Supervisor → Chief Nurse',
        'Licensed Professional Teacher' => 'Teacher → Master Teacher → Principal → Schools Division Superintendent',
        'Financial Analyst' => 'Junior Analyst → Senior Analyst → Finance Manager → Finance Director',
        'Lawyer/Attorney' => 'Associate → Senior Associate → Partner → Managing Partner',
        'Graphic Designer' => 'Junior Designer → Senior Designer → Art Director → Creative Director'
    ];
    
    return $growth[$career] ?? 'Multiple advancement opportunities available in this field';
}

// Ensure we have at least 4 recommendations total
$allCareerRecommendations = [];
if ($aiAnalysis && !empty($aiAnalysis['top_recommendations'])) {
    $allCareerRecommendations = $aiAnalysis['top_recommendations'];
}

// Add additional recommendations if needed
$existingCount = count($allCareerRecommendations);
if ($existingCount < 4) {
    $additionalRecommendations = generateAdditionalRecommendations($categoryScores, $existingCount);
    $allCareerRecommendations = array_merge($allCareerRecommendations, $additionalRecommendations);
}

// Limit to top 4 recommendations
$allCareerRecommendations = array_slice($allCareerRecommendations, 0, 4);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="../../Assets/Scripts/tailwindConfig.js"></script>
    <link rel="stylesheet" href="../../Assets/Styles/index.css">
    <title>AI Career Analysis Results - CareerPath</title>
</head>
<body class="min-h-screen bg-cream text-dark">

    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <!-- Logo and title -->
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-lime rounded-full flex items-center justify-center">
                        <i class="fas fa-brain text-dark"></i>
                    </div>
                    <h1 class="text-xl font-bold text-dark">AI Career Analysis Results</h1>
                </div>

                <!-- User info -->
                <div class="flex items-center space-x-4">
                    <?php if (!$isGuest): ?>
                        <div class="flex items-center space-x-2 bg-lime/20 px-3 py-1.5 rounded-full">
                            <i class="fas fa-user text-dark text-sm"></i>
                            <span class="text-sm font-medium text-dark"><?php echo htmlspecialchars($userName); ?></span>
                        </div>
                    <?php else: ?>
                        <div class="flex items-center space-x-2 bg-yellow-100 px-3 py-1.5 rounded-full">
                            <i class="fas fa-user-clock text-yellow-600 text-sm"></i>
                            <span class="text-sm font-medium text-yellow-700">Guest Results</span>
                        </div>
                    <?php endif; ?>
                    
                    <button onclick="goHome()" class="text-gray-500 hover:text-dark transition-colors">
                        <i class="fas fa-home"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-6">
        
        <!-- Results Header -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-lime to-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-trophy text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-dark mb-2">Your AI-Powered Career Analysis</h2>
                <p class="text-gray-600 mb-4">Personalized recommendations based on advanced AI analysis of your <?php echo $totalQuestions; ?> responses</p>
                <div class="flex items-center justify-center space-x-4 text-sm text-gray-500">
                    <span><i class="fas fa-calendar mr-1"></i>Completed on <?php echo $completionDate; ?></span>
                    <span><i class="fas fa-robot mr-1"></i>AI-Analyzed</span>
                    <span><i class="fas fa-clock mr-1"></i>Result ID: #<?php echo $resultId; ?></span>
                </div>
            </div>
        </div>

        <?php if ($aiAnalysis): ?>
        <!-- AI Personality Summary -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl shadow-lg p-6 mb-6 border border-blue-200">
            <div class="flex items-start space-x-4">
                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-tie text-white"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-blue-900 mb-2">AI Personality Analysis</h3>
                    <p class="text-blue-800 leading-relaxed"><?php echo htmlspecialchars($aiAnalysis['personality_summary']); ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Career Recommendations Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-dark mb-2 flex items-center">
                <i class="fas fa-briefcase text-lime mr-3"></i>Your Top 4 Career Matches
            </h2>
            <p class="text-gray-600">Ranked by compatibility with your interests and skills, all focused on the Philippine job market</p>
        </div>

        <!-- AI Career Recommendations Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <?php if (!empty($allCareerRecommendations)): ?>
                <?php foreach ($allCareerRecommendations as $index => $recommendation): ?>
                    <?php 
                    $gradients = [
                        0 => 'from-lime to-green-500',
                        1 => 'from-blue-400 to-blue-600', 
                        2 => 'from-purple-400 to-purple-600',
                        3 => 'from-pink-400 to-pink-600'
                    ];
                    $badges = [
                        0 => 'Best Match',
                        1 => 'Great Match',
                        2 => 'Good Match', 
                        3 => 'Potential Match'
                    ];
                    $icons = [
                        0 => 'fas fa-crown',
                        1 => 'fas fa-star',
                        2 => 'fas fa-medal',
                        3 => 'fas fa-award'
                    ];
                    
                    $gradient = $gradients[$index] ?? $gradients[3];
                    $badge = $badges[$index] ?? 'Potential Match';
                    $icon = $icons[$index] ?? 'fas fa-award';
                    ?>
                    
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300">
                        <!-- Header -->
                        <div class="bg-gradient-to-r <?php echo $gradient; ?> p-6 text-white">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center space-x-2">
                                    <i class="<?php echo $icon; ?>"></i>
                                    <span class="font-bold text-sm">#<?php echo $index + 1; ?> <?php echo $badge; ?></span>
                                </div>
                                <div class="text-right">
                                    <div class="text-xs opacity-90">Match</div>
                                    <div class="text-xl font-bold"><?php echo $recommendation['match_percentage']; ?>%</div>
                                </div>
                            </div>
                            <h3 class="text-2xl font-bold mb-1"><?php echo htmlspecialchars($recommendation['career']); ?></h3>
                            <p class="text-sm opacity-90 capitalize">
                                <i class="fas fa-tag mr-1"></i><?php echo ucfirst($recommendation['category']); ?> Field
                            </p>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <!-- Why It's a Good Fit -->
                            <div class="mb-4">
                                <h4 class="font-semibold text-dark mb-2 flex items-center">
                                    <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>Why It's a Perfect Fit
                                </h4>
                                <p class="text-gray-700 text-sm leading-relaxed">
                                    <?php echo htmlspecialchars($recommendation['why_good_fit']); ?>
                                </p>
                            </div>

                            <!-- Required Skills -->
                            <div class="mb-4">
                                <h4 class="font-semibold text-dark mb-2 flex items-center">
                                    <i class="fas fa-tools text-blue-500 mr-2"></i>Key Skills Needed
                                </h4>
                                <div class="flex flex-wrap gap-2">
                                    <?php foreach ($recommendation['required_skills'] as $skill): ?>
                                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-xs font-medium">
                                            <?php echo htmlspecialchars($skill); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- Education Path -->
                            <?php if (isset($recommendation['education_path'])): ?>
                            <div class="mb-4">
                                <h4 class="font-semibold text-dark mb-2 flex items-center">
                                    <i class="fas fa-graduation-cap text-green-500 mr-2"></i>Education Path
                                </h4>
                                <p class="text-gray-700 text-xs leading-relaxed">
                                    <?php echo htmlspecialchars($recommendation['education_path']); ?>
                                </p>
                            </div>
                            <?php endif; ?>

                            <!-- Growth & Salary & Demand -->
                            <div class="grid grid-cols-1 gap-3">
                                <div class="bg-green-50 p-3 rounded-lg border border-green-200">
                                    <h5 class="font-medium text-green-800 text-sm mb-1">Career Growth</h5>
                                    <p class="text-green-700 text-xs">
                                        <?php echo htmlspecialchars($recommendation['growth_opportunities'] ?? 'Multiple advancement opportunities available'); ?>
                                    </p>
                                </div>
                                <div class="bg-blue-50 p-3 rounded-lg border border-blue-200">
                                    <h5 class="font-medium text-blue-800 text-sm mb-1">Expected Salary (PH)</h5>
                                    <p class="text-blue-700 text-xs font-semibold">
                                        <?php echo htmlspecialchars($recommendation['salary_range']); ?>
                                    </p>
                                </div>
                                <?php if (isset($recommendation['demand_in_ph'])): ?>
                                <div class="bg-purple-50 p-3 rounded-lg border border-purple-200">
                                    <h5 class="font-medium text-purple-800 text-sm mb-1">Job Market Demand</h5>
                                    <p class="text-purple-700 text-xs font-semibold">
                                        <?php echo htmlspecialchars($recommendation['demand_in_ph']); ?>
                                    </p>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-2 bg-white rounded-2xl shadow-lg p-8 text-center">
                    <i class="fas fa-search text-gray-400 text-4xl mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-600 mb-2">No Clear Preferences Detected</h3>
                    <p class="text-gray-500">Your responses don't show strong preferences. Consider retaking the quiz with more definitive answers.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Career Category Breakdown -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <h3 class="text-xl font-bold text-dark mb-4 flex items-center">
                <i class="fas fa-chart-pie text-lime mr-2"></i>Your Interest Profile
            </h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <?php 
                $maxScore = max($categoryScores);
                $colorClasses = [
                    'technology' => 'bg-blue-500',
                    'business' => 'bg-green-500',
                    'healthcare' => 'bg-red-500',
                    'education' => 'bg-yellow-500',
                    'finance' => 'bg-indigo-500',
                    'legal' => 'bg-gray-600',
                    'creative' => 'bg-pink-500'
                ];
                ?>
                <?php foreach (array_slice($categoryScores, 0, 7) as $category => $score): ?>
                    <?php 
                    $percentage = $maxScore > 0 ? ($score / $maxScore) * 100 : 0;
                    $colorClass = $colorClasses[$category] ?? 'bg-gray-500';
                    ?>
                    <div class="text-center">
                        <div class="mb-2">
                            <div class="w-16 h-16 mx-auto bg-gray-200 rounded-full flex items-center justify-center relative overflow-hidden">
                                <div class="absolute bottom-0 left-0 right-0 <?php echo $colorClass; ?> transition-all duration-500" 
                                     style="height: <?php echo $percentage; ?>%"></div>
                                <span class="relative z-10 text-xs font-bold text-white mix-blend-difference">
                                    <?php echo $score; ?>
                                </span>
                            </div>
                        </div>
                        <p class="text-xs font-medium capitalize text-gray-700"><?php echo $category; ?></p>
                        <p class="text-xs text-gray-500"><?php echo round($percentage); ?>%</p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php if ($aiAnalysis): ?>
        <!-- AI Insights -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Strengths -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-dark mb-4 flex items-center">
                    <i class="fas fa-thumbs-up text-green-500 mr-2"></i>Your Strengths
                </h3>
                <ul class="space-y-2">
                    <?php foreach ($aiAnalysis['strengths'] as $strength): ?>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-check text-green-500 text-sm"></i>
                            <span class="text-sm"><?php echo htmlspecialchars($strength); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Development Areas -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-dark mb-4 flex items-center">
                    <i class="fas fa-chart-line text-blue-500 mr-2"></i>Growth Areas
                </h3>
                <ul class="space-y-2">
                    <?php foreach ($aiAnalysis['areas_for_development'] as $area): ?>
                        <li class="flex items-center space-x-2">
                            <i class="fas fa-arrow-up text-blue-500 text-sm"></i>
                            <span class="text-sm"><?php echo htmlspecialchars($area); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Next Steps -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-dark mb-4 flex items-center">
                    <i class="fas fa-footsteps text-purple-500 mr-2"></i>Next Steps
                </h3>
                <ul class="space-y-2">
                    <?php foreach ($aiAnalysis['next_steps'] as $step): ?>
                        <li class="flex items-start space-x-2">
                            <i class="fas fa-play text-purple-500 text-xs mt-1"></i>
                            <span class="text-sm"><?php echo htmlspecialchars($step); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>

        <!-- Guest Notice -->
        <?php if ($isGuest): ?>
        <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-4 mb-6">
            <div class="flex items-start space-x-3">
                <i class="fas fa-info-circle text-yellow-600 mt-1"></i>
                <div>
                    <h4 class="font-semibold text-yellow-800 mb-1">Guest Mode Results</h4>
                    <p class="text-yellow-700 text-sm mb-3">
                        These AI-powered results are temporary and will not be saved permanently. 
                        Create an account to save your analysis and track your progress over time.
                    </p>
                    <button onclick="openSignUpModal()" class="bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-yellow-700 transition-colors">
                        <i class="fas fa-user-plus mr-2"></i>Create Account to Save AI Analysis
                    </button>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Action Buttons -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="text-center">
                <h3 class="text-xl font-bold text-dark mb-4">Ready to Take Action?</h3>
                <div class="flex flex-wrap justify-center gap-4">
                    <button onclick="retakeQuiz()" class="bg-lime text-dark px-6 py-3 rounded-xl font-bold hover:bg-lime-600 transition-colors">
                        <i class="fas fa-redo mr-2"></i>Retake Quiz
                    </button>
                    
                    <?php if (!$isGuest): ?>
                        <button onclick="viewHistory()" class="bg-dark text-white px-6 py-3 rounded-xl font-bold hover:bg-gray-800 transition-colors">
                            <i class="fas fa-history mr-2"></i>View History
                        </button>
                    <?php endif; ?>
                    
                    <button onclick="shareResults()" class="bg-blue-500 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-600 transition-colors">
                        <i class="fas fa-share mr-2"></i>Share Analysis
                    </button>
                    
                    <button onclick="goHome()" class="bg-gray-200 text-dark px-6 py-3 rounded-xl font-bold hover:bg-gray-300 transition-colors">
                        <i class="fas fa-home mr-2"></i>Back to Home
                    </button>
                </div>
            </div>
        </div>

    </main>

    <!-- JavaScript -->
    <script>
        function goHome() {
            window.location.href = '../../index.php';
        }

        function retakeQuiz() {
            if (confirm('Are you sure you want to retake the quiz? This will start a new AI analysis.')) {
                window.location.href = 'quizPage.php';
            }
        }

        function viewHistory() {
            alert('Quiz history feature coming soon!');
        }

        function shareResults() {
            const url = window.location.href;
            const text = 'Check out my AI-powered career analysis results!';
            
            if (navigator.share) {
                navigator.share({
                    title: 'AI Career Analysis Results',
                    text: text,
                    url: url
                });
            } else {
                navigator.clipboard.writeText(url).then(() => {
                    alert('Results link copied to clipboard!');
                }).catch(() => {
                    alert('Unable to share results at this time.');
                });
            }
        }

        function openSignUpModal() {
            alert('Sign up functionality - redirect to registration');
        }

        // Add smooth animations on page load
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.bg-white, .bg-gradient-to-r');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Animate the interest profile bars
            setTimeout(() => {
                const bars = document.querySelectorAll('[style*="height:"]');
                bars.forEach((bar, index) => {
                    const height = bar.style.height;
                    bar.style.height = '0%';
                    setTimeout(() => {
                        bar.style.height = height;
                    }, index * 200);
                });
            }, 1000);
        });
    </script>

</body>
</html>