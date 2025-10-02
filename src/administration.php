<?php
require __DIR__ . '/../vendor/autoload.php';

use ArdaGnsrn\Ollama\Ollama;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $behavior = trim($_POST['behavior'] ?? '');

    $client = Ollama::client('http://ollama-scrum:11434');

    $modelName = 'wheely';

    $client->models()->create([
    'name' => $modelName,
    'from' => "orca-mini:3b",
    'system' => $behavior
    ]);

    echo "Modell '$modelName' neu erstellt.";
    exit;
}
?>
<form method="POST">
  <textarea name="behavior" rows="8" cols="80">YOUR NAME IS WHEELY, the Wheelbarrow sales assistant...
Respond to EVERY question by first stating your name and role...</textarea>
  <br><button type="submit">Update Modelfile</button>
</form>
