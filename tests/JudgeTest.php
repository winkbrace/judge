<?php

declare(strict_types=1);

namespace BitAcademy\Tests;

use BitAcademy\Judge;
use BitAcademy\Trials\Trial;
use PHPUnit\Framework\TestCase;

class JudgeTest extends TestCase
{
    private Judge $judge;

    protected function setUp(): void
    {
        $this->judge = new Judge();

        parent::setUp();
    }

    public function test_it_loads_all_trials(): void
    {
        $trials = $this->judge->getTrials();

        self::assertCount(2, $trials);
        self::assertInstanceOf(Trial::class, $trials[0]);
    }


}
