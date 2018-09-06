<?php

use PHPUnit\Framework\TestCase;
use Challenge\Challenge;

class ChallengeTest extends TestCase
{
    private $challenge;

    public function tearUp()
    {
        $this->challenge = new Challenge;
    }
}
