<?php
use PHPUnit\Framework\TestCase;
use ArdaGnsrn\Ollama\Ollama;

final class updateTest extends TestCase
{
    public function testUpdate()
    {
	    $behavior = "This is Test behaviour";
	    $client = Ollama::client('http://ollama-scrum:11434');
	    $modelName = 'wheely';

	    $client->models()->create([
		    'name' => $modelName,
		    'from' => "orca-mini:3b",
		    'system' => $behavior
	    ]);

	    $modelParameters = $client->models()->show('wheely');
	    $modelfile = $modelParameters->modelfile;
	    $systemMsg = '';

	    if (preg_match('/SYSTEM\s+(?:"([^"]*?)"|(.+?))\s+PARAMETER\s+stop/s', $modelfile, $matches)) {
		    $systemMsg = trim($matches[1] ?: $matches[2]);
	    }

		$this->assertEquals($behavior, $systemMsg);
    }
}