<?php
// Make sure this file is called via AJAX or your plugin's endpoint
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Get incoming POST data (FormData)
$msg = isset($_POST['msg']) ? $_POST['msg'] : '';
$history = isset($_POST['history']) ? $_POST['history'] : '';

// Prepare POST data to forward
$postData = [
    'msg' => $msg,
    'history' => $history
];

// Use cURL to forward the request
$ch = curl_init('http://scrum-app'); // target URL
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);

// Optional: set timeout
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

// Send request
$response = curl_exec($ch);

if (curl_errno($ch)) {
    http_response_code(500);
    echo json_encode(['error' => 'cURL error: ' . curl_error($ch)]);
    curl_close($ch);
    exit;
}

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Forward the response to the client
http_response_code($httpCode);
echo $response;
exit;
