<?php

declare(strict_types=1);

namespace BitAcademy\Trials;

class JavascriptBeginner implements Trial
{
    #[\Override]
    public function name(): string
    {
        return 'Javascript Beginner';
    }

    #[\Override]
    public function bashHistory(): array
    {
        return [
            '/^node /' => 15,
            '/^node \w+\.js \"Bit Academy\"/' => 15,
            '/^node \w+\.js Bit Academy/' => 10,
        ];
    }

    #[\Override]
    public function scriptRules(): array
    {
        return [
            // white list
            '/^(let|const) /' => 15,
            '/(<|>)+/' => 15,
            '/(==|!=)+/' => 15,
            '/\b(if|else)\b/' => 15,

            // black list
            '/^var /' => -5,
        ];
    }

    #[\Override]
    public function manualCheck(): string
    {
        return <<<'TXT'
            - Als de winnende tekst is samengesteld uit een variabele en tekst is dat 5 punten.
                - BV. `De kandidaat wordt premier met ${procentGekregenStemmen}% van de stemmen`
                - BV 'De kandidaat wordt premier met ' + procentGekregenStemmen + '% van de stemmen'
            - De aantallen studenten worden opgeslagen in arrays, levert 10 punten op
            - Het totaal aantal studenten wordt berekend door door de arrays heen te loopen, en levert 10 punten op.
            TXT;
    }
}
