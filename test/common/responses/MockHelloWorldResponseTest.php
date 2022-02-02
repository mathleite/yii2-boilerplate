<?php

namespace test\common\responses;

use common\responses\MockHelloWorldResponse;
use PHPUnit\Framework\TestCase;

class MockHelloWorldResponseTest extends TestCase
{
    public function test_Respond_ShouldBeArray(): void
    {
        $response = new MockHelloWorldResponse();
        $this->assertIsArray($response->respond());
    }

    public function test_Respond_ShouldAssertArrayStructure(): void
    {
        $response = new MockHelloWorldResponse();
        $this->assertSame(['Hello', 'status', 'datetime'], array_keys($response->respond()));
    }
}
