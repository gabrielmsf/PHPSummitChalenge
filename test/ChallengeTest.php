<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Challenge\Challenge;

class ChallengeTest extends TestCase
{
    private $challenge;

    public function tearUp()
    {
        $this->challenge = new Challenge;
    }

    public function testSum()
    {
        $result = $this->challenge->sum(3, 9);
        $this->assertSame(12, $result);
    }
}
