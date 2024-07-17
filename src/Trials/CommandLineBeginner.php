<?php

declare(strict_types=1);

namespace BitAcademy\Trials;

class CommandLineBeginner implements Trial
{
    #[\Override]
    public function name(): string
    {
        return 'Command Line Beginner';
    }

    #[\Override]
    public function bashHistory(): array
    {
        return [
            '/^(ls|tree) /' => 25,
            '/^cd /' => 25,
            '/^mkdir /' => 15,
            '/^(rm|rmdir) /' => 15,
            '/^ls -/' => 10,
            '/^rm -/' => 10,
        ];
    }

    #[\Override]
    public function scriptRules(): array
    {
        return [];
    }

    #[\Override]
    public function manualCheck(): string
    {
        return '';
    }
}
