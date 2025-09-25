<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $behavior = trim($_POST['behavior'] ?? '');

    $modelName = 'wheely';

    // Modelfile-Text erzeugen
    $modelfile = "FROM orca-mini:3b\n";
    $modelfile .= "PARAMETER temperature 1\n";
    $modelfile .= "SYSTEM \"\"\"\n$behavior\n\"\"\"\n";

    // Ziel: models-Ordner im Projekt-Hauptverzeichnis
    $projectModelFile = __DIR__ . "/../models/Modelfile";

    // sicherstellen, dass es den Ordner gibt
    $dir = dirname($projectModelFile);
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    file_put_contents($projectModelFile, $modelfile);

    // Ollama aufrufen (überschreibt altes Modell)
    shell_exec("ollama create " . escapeshellarg($modelName) . " -f " . escapeshellarg($projectModelFile));

    echo "Modell '$modelName' neu erstellt.";
    exit;
}
?>
<form method="POST">
  <textarea name="behavior" rows="8" cols="80">YOUR NAME IS WHEELY, the Wheelbarrow sales assistant...
Respond to EVERY question by first stating your name and role...</textarea>
  <br><button type="submit">Update Modelfile</button>
</form>
