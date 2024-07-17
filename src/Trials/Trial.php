<?php

declare(strict_types=1);

namespace BitAcademy\Trials;

interface Trial
{
    public function name(): string;

    public function bashHistory(): array;

    public function scriptRules(): array;

    public function manualCheck(): string;
}
