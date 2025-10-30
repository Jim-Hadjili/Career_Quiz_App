<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Load environment variables
function loadEnv($filePath) {
    if (!file_exists($filePath)) {
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

// Load environment variables
$envPath = '../API/.env';
if (!loadEnv($envPath)) {
    // Fallback to absolute path
    $envPath = __DIR__ . '/../../Config/API/.env';
    loadEnv($envPath);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

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
        "content" => "You are CareerPath AI, a helpful career guidance assistant. You help users with career advice, quiz questions, educational paths, and professional development. Keep responses conversational, helpful, and concise. Focus on careers, education, skills development, and professional growth."
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

// Prepare API request
$apiData = [
    "model" => $_ENV['model'] ?? "mistralai/mistral-7b-instruct:free",
    "messages" => $messages,
    "max_tokens" => 500,
    "temperature" => 0.7
];

// Make API request
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $_ENV['api_url'] ?? 'https://openrouter.ai/api/v1/chat/completions',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Authorization: Bearer ' . ($_ENV['api_key'] ?? ''),
        'HTTP-Referer: http://localhost',
        'X-Title: CareerPath AI Chatbot'
    ],
    CURLOPT_POSTFIELDS => json_encode($apiData),
    CURLOPT_TIMEOUT => 30,
    CURLOPT_SSL_VERIFYPEER => false
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

if ($error) {
    error_log("CURL Error: " . $error);
    echo json_encode([
        'success' => false, 
        'error' => 'Connection error',
        'response' => "I'm having trouble connecting to my knowledge base right now. However, I can still help you with basic career guidance! What specific career questions do you have?"
    ]);
    exit;
}

if ($httpCode !== 200) {
    error_log("API Error: HTTP " . $httpCode . " - " . $response);
    echo json_encode([
        'success' => false, 
        'error' => 'API error',
        'response' => "I'm experiencing some technical difficulties, but I'm here to help! What career questions can I assist you with today?"
    ]);
    exit;
}

$apiResponse = json_decode($response, true);

if (!$apiResponse || !isset($apiResponse['choices'][0]['message']['content'])) {
    echo json_encode([
        'success' => false, 
        'error' => 'Invalid response',
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