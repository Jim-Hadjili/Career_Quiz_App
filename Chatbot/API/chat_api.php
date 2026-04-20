<?php
// Enhanced error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 0); // Don't display errors to user, but log them

// Set proper headers
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Log the request for debugging
error_log("Chat API called - Method: " . $_SERVER['REQUEST_METHOD'] . " - Time: " . date('Y-m-d H:i:s'));

// Load environment variables
function loadEnv($filePath) {
    if (!file_exists($filePath)) {
        error_log("Env file not found: " . $filePath);
        return false;
    }
    
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=>') !== false) {
            list($key, $value) = explode('=>', $line, 2);
            $key = trim($key);
            $value = trim($value, ' "\'');
            $_ENV[$key] = $value;
        }
    }
    return true;
}

// Try multiple paths for environment file
$envPaths = [
    __DIR__ . '/../API/.env',
    __DIR__ . '/../../Config/API/.env',
    $_SERVER['DOCUMENT_ROOT'] . '/Config/API/.env',
    dirname($_SERVER['DOCUMENT_ROOT']) . '/Config/API/.env',
    __DIR__ . '/.env'
];

$envLoaded = false;
foreach ($envPaths as $envPath) {
    if (loadEnv($envPath)) {
        $envLoaded = true;
        error_log("Loaded env from: " . $envPath);
        break;
    }
}

if (!$envLoaded) {
    error_log("Could not load environment file from any path");
    echo json_encode([
        'success' => false,
        'error' => 'Configuration error',
        'response' => "I'm experiencing configuration issues. Please check back in a moment!"
    ]);
    exit;
}

// Add a simple GET endpoint for testing
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode([
        'success' => true,
        'message' => 'Chat API is accessible',
        'timestamp' => date('Y-m-d H:i:s'),
        'env_loaded' => $envLoaded
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    error_log("JSON decode error: " . json_last_error_msg());
    echo json_encode(['success' => false, 'error' => 'Invalid JSON']);
    exit;
}

if (!isset($input['message'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Message is required']);
    exit;
}

$userMessage = trim($input['message']);
$chatHistory = isset($input['chat_history']) ? $input['chat_history'] : [];

if (empty($userMessage)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Message cannot be empty']);
    exit;
}

// Prepare conversation context
$messages = [
    [
        "role" => "system",
        "content" => "You are CareerPath AI, a helpful career guidance assistant. You help users with career advice, quiz questions, educational paths, and professional development. 

IMPORTANT FORMATTING GUIDELINES:
- Structure your responses with clear sections using emojis and headings
- Use bullet points for lists and options
- Format university/course information clearly with 'Course:' and 'Details:' labels
- Break down complex information into digestible sections
- Use emojis like 🎓 for education, 🧭 for steps/guidance, 💼 for career info, 📚 for programs
- Keep responses conversational but well-organized
- Use headers like '🎓 Universities Offering [Program] Programs' or '🧭 Steps to Become a [Career]'

Example format:
🎓 Universities Offering Meteorology Programs

University of the Philippines (UP) – Diliman
Course: BS Meteorology  
Details: Offered by the UP College of Science under IESM

🧭 Steps to Become a Meteorologist
- Complete a BS in Meteorology
- Join internship programs 
- Obtain required certifications

Focus on careers, education, skills development, and professional growth in the Philippines context when applicable."
    ]
];

// Add chat history to context (last 5 messages to keep context manageable)
$recentHistory = array_slice($chatHistory, -5);
foreach ($recentHistory as $msg) {
    $role = $msg['sender'] === 'user' ? 'user' : 'assistant';
    $messages[] = [
        "role" => $role,
        "content" => $msg['message']
    ];
}

// Add current user message
$messages[] = [
    "role" => "user",
    "content" => $userMessage
];

// Check if API credentials are available
if (!isset($_ENV['GROQ_API_KEY']) || empty($_ENV['GROQ_API_KEY'])) {
    error_log("Groq API key not found in environment variables");
    echo json_encode([
        'success' => true,
        'response' => "I'd be happy to help you with career guidance! While I'm experiencing some technical connectivity issues, I can still provide general advice. What specific career questions do you have?"
    ]);
    exit;
}

// Prepare API request
$apiData = [
    "model" => $_ENV['GROQ_CHAT_MODEL'] ?? "llama-3.1-8b-instant",
    "messages" => $messages,
    "max_tokens" => 500,
    "temperature" => 0.7
];

// Get the current domain for referer
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$domain = $protocol . '://' . $_SERVER['HTTP_HOST'];

// Make API request
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $_ENV['GROQ_API_URL'] ?? 'https://api.groq.com/openai/v1/chat/completions',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $_ENV['GROQ_API_KEY']
    ],
    CURLOPT_POSTFIELDS => json_encode($apiData),
    CURLOPT_TIMEOUT => 30,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_FOLLOWLOCATION => true
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

if ($error) {
    error_log("CURL Error: " . $error);
    echo json_encode([
        'success' => true, 
        'response' => "I'm having trouble connecting to my knowledge base right now. However, I can still help you with basic career guidance! What specific career questions do you have?"
    ]);
    exit;
}

if ($httpCode !== 200) {
    $errorBody = json_decode($response, true);
    $errorDetail = isset($errorBody['error']['message']) ? $errorBody['error']['message'] : $response;
    error_log("Groq API Error: HTTP " . $httpCode . " - " . $errorDetail);
    error_log("Groq API Key used (first 10 chars): " . substr($_ENV['GROQ_API_KEY'] ?? '', 0, 10));
    error_log("Groq API URL: " . ($_ENV['GROQ_API_URL'] ?? 'not set'));
    error_log("Groq Model: " . ($_ENV['GROQ_CHAT_MODEL'] ?? 'not set'));
    echo json_encode([
        'success' => false,
        'debug_http_code' => $httpCode,
        'debug_error' => $errorDetail,
        'response' => "I'm experiencing some technical difficulties (HTTP $httpCode). Please try again."
    ]);
    exit;
}

$apiResponse = json_decode($response, true);

if (!$apiResponse || !isset($apiResponse['choices'][0]['message']['content'])) {
    echo json_encode([
        'success' => true, 
        'response' => "I'm having a moment of technical difficulty. Could you please rephrase your question? I'm here to help with career guidance, education paths, and professional development!"
    ]);
    exit;
}

$aiMessage = trim($apiResponse['choices'][0]['message']['content']);

// Ensure the response is career-focused if it seems off-topic
if (!empty($aiMessage)) {
    echo json_encode([
        'success' => true,
        'response' => $aiMessage
    ]);
} else {
    echo json_encode([
        'success' => true,
        'response' => "I'd be happy to help you with career guidance! What specific questions do you have about careers, education, or professional development?"
    ]);
}
?>