<?php
// Enhanced API test with detailed error checking
require_once 'careerAnalysisAPI.php';

echo "<h2>Enhanced CareerAnalysisAPI Test</h2>\n";

// First, let's check the API key status
echo "<h3>1. Checking API Key Status</h3>\n";

try {
    // Load config directly to check the key
    $envFile = file_exists('../../../.env') ? '../../../.env' : '../../../Config/API/.env';
    $config = [];
    if (file_exists($envFile)) {
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos($line, '=>') !== false) {
                list($key, $value) = explode(' => ', $line, 2);
                $config[trim($key)] = trim($value);
            }
        }
    }
    
    echo "<p><strong>API Key:</strong> " . substr($config['api_key'], 0, 10) . "..." . substr($config['api_key'], -4) . "</p>\n";
    echo "<p><strong>Model:</strong> " . $config['model'] . "</p>\n";
    
    // Test API key validity and check credits
    $headers = [
        'Authorization: Bearer ' . $config['api_key'],
        'Content-Type: application/json'
    ];
    
    // Check available models (lighter request)
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://openrouter.ai/api/v1/models');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    echo "<p><strong>Models API Status:</strong> HTTP {$httpCode}</p>\n";
    
    if ($httpCode === 200) {
        echo "<p>✅ API Key is valid and working</p>\n";
        $modelsData = json_decode($response, true);
        if (isset($modelsData['data'])) {
            echo "<p>✅ Found " . count($modelsData['data']) . " available models</p>\n";
        }
    } elseif ($httpCode === 401) {
        echo "<p>❌ Invalid API Key</p>\n";
    } elseif ($httpCode === 402) {
        echo "<p>❌ Payment Required - No credits available</p>\n";
    } else {
        echo "<p>⚠️ Unexpected response: {$httpCode}</p>\n";
        echo "<pre>" . htmlspecialchars(substr($response, 0, 500)) . "</pre>\n";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Error checking API key: " . $e->getMessage() . "</p>\n";
}

// Test with a minimal request to check credit usage
echo "<h3>2. Testing Minimal API Request</h3>\n";

try {
    $minimalPayload = [
        'model' => $config['model'],
        'messages' => [
            [
                'role' => 'user',
                'content' => 'Hello'
            ]
        ],
        'max_tokens' => 10
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $config['api_url']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($minimalPayload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    echo "<p><strong>Minimal Request Status:</strong> HTTP {$httpCode}</p>\n";
    
    if ($httpCode === 200) {
        echo "<p>✅ API is working! The issue may be with request size or complexity</p>\n";
        $data = json_decode($response, true);
        if (isset($data['choices'][0]['message']['content'])) {
            echo "<p><strong>Response:</strong> " . $data['choices'][0]['message']['content'] . "</p>\n";
        }
    } else {
        echo "<p>❌ Same error with minimal request</p>\n";
        echo "<pre style='color: red;'>" . htmlspecialchars(substr($response, 0, 500)) . "</pre>\n";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>Error with minimal request: " . $e->getMessage() . "</p>\n";
}

// Check OpenRouter dashboard link and suggestions
echo "<h3>3. Next Steps</h3>\n";
echo "<div style='background: #f0f8ff; padding: 15px; border-left: 4px solid #0066cc;'>\n";
echo "<h4>To resolve the 402 Payment Required error:</h4>\n";
echo "<ol>\n";
echo "<li><strong>Check your OpenRouter account:</strong><br>\n";
echo "   Visit <a href='https://openrouter.ai/credits' target='_blank'>https://openrouter.ai/credits</a></li>\n";
echo "<li><strong>Add credits:</strong><br>\n";
echo "   You may need to purchase credits or add a payment method</li>\n";
echo "<li><strong>Check usage limits:</strong><br>\n";
echo "   Verify if you have daily/monthly limits enabled</li>\n";
echo "<li><strong>Alternative free models:</strong><br>\n";
echo "   Consider switching to a free model temporarily for testing</li>\n";
echo "</ol>\n";
echo "</div>\n";

// Suggest free models
echo "<h4>Free Models You Can Try:</h4>\n";
echo "<ul>\n";
echo "<li><code>mistralai/mistral-7b-instruct:free</code></li>\n";
echo "<li><code>huggingfaceh4/zephyr-7b-beta:free</code></li>\n";
echo "<li><code>openchat/openchat-7b:free</code></li>\n";
echo "</ul>\n";

echo "<p><em>To use a free model, update your .env file with one of the above model names.</em></p>\n";

echo "<h4>Current Configuration Check:</h4>\n";
if (isset($config)) {
    echo "<pre style='background: #f5f5f5; padding: 10px;'>\n";
    foreach ($config as $key => $value) {
        if ($key === 'api_key') {
            echo "$key => " . substr($value, 0, 10) . "..." . substr($value, -4) . "\n";
        } else {
            echo "$key => $value\n";
        }
    }
    echo "</pre>\n";
}

?>