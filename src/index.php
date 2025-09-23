<?php

require __DIR__ . '/../vendor/autoload.php';

use ArdaGnsrn\Ollama\Ollama;
use ArdaGnsrn\Ollama\Resources\Blobs;
use ArdaGnsrn\Ollama\Resources\Chat;
use ArdaGnsrn\Ollama\Resources\Completions;
use ArdaGnsrn\Ollama\Resources\Embed;
use ArdaGnsrn\Ollama\Resources\Models;


echo '<title>Scrum Projekt</title>';
echo '<h1>Hello World!</h1>';

echo '<p> Prompt: Once upon a time...';

$client = \ArdaGnsrn\Ollama\Ollama::client('http://ollama-scrum:11434');

$completions = $client->completions()->create([
	'model' => 'wheely',
	'prompt' => 'Tell me about wheelbarrows'
]);

$response = $completions->response;

echo $response;