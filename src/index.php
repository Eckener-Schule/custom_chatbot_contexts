<?php

require __DIR__ . '/../vendor/autoload.php';

use ArdaGnsrn\Ollama\Ollama;
use ArdaGnsrn\Ollama\Resources\Blobs;
use ArdaGnsrn\Ollama\Resources\Chat;
use ArdaGnsrn\Ollama\Resources\Completions;
use ArdaGnsrn\Ollama\Resources\Embed;
use ArdaGnsrn\Ollama\Resources\Models;

$client = \ArdaGnsrn\Ollama\Ollama::client('http://ollama-scrum:11434');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Assume POST came from completion.php
    $msg = isset($_POST['msg']) ? $_POST['msg'] : '';
    $history = isset($_POST['history']) ? $_POST['history'] : '[]';

    // Decode history JSON to include in prompt
    $historyArray = json_decode($history, true) ?: [];

    // Build a prompt combining history + current message
    $promptText = "";
    foreach ($historyArray as $item) {
        $role = $item['role'] ?? 'bot';
        $text = $item['text'] ?? '';
        $promptText .= strtoupper($role) . ": " . $text . "\n";
    }
    $promptText .= "USER: " . $msg . "\nBOT:";

    // Send prompt to Wheely model
    $completions = $client->completions()->create([
        'model' => 'wheely',
        'prompt' => $promptText
    ]);
	
    $responseText = $completions->response ?? '';

    // Return only the response (could be JSON or raw text)
    header('Content-Type: application/json');
    echo json_encode(['msg' => $responseText]);
    exit;
}

echo '<title>Scrum Projekt</title>';
echo '<h1>Hello World!</h1>';

echo '<p> Prompt: First 5 numbers of the Fibonacci sequence';


$completions = $client->completions()->create([
	'model' => 'wheely',
	'prompt' => 'First 5 numbers of the Fibonacci sequence'
]);

$response = $completions->response;

echo $response;