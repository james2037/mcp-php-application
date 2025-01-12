<?php

namespace App\Tests\Tools;

use PHPUnit\Framework\TestCase;
use App\Tools\ExampleTool;

class ExampleToolTest extends TestCase {
    private ExampleTool $tool;

    protected function setUp(): void {
        $this->tool = new ExampleTool();
    }

    public function testBasicExecution(): void {
        $result = $this->tool->execute([
            'input' => 'hello world'
        ]);

        $this->assertCount(1, $result);
        $this->assertEquals('text', $result[0]['type']);
        $this->assertEquals('You said: hello world', $result[0]['text']);
    }

    public function testMissingParameter(): void {
        $this->expectException(\InvalidArgumentException::class);
        $this->tool->execute([]);
    }
}
