<?php
use PHPUnit\Framework\TestCase;
use ArdaGnsrn\Ollama\Ollama;
use ArdaGnsrn\Ollama\Responses\Completions\CompletionResponse;
use ArdaGnsrn\Ollama\Responses\StreamResponse;

final class PromptTest extends TestCase
{
    public function promptTest()
    {
        $client = \ArdaGnsrn\Ollama\Ollama::client('http://ollama-scrum:11434');

        $result = $client->completions()->create([
            'model' => 'wheely',
            'prompt' => 'First 5 numbers of the Fibonacci sequence'
        ]);

        $this->assertInstanceOf(CompletionResponse::class, $result);
    }
}