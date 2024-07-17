<?php

declare(strict_types=1);

namespace BitAcademy;

use BitAcademy\Trials\CommandLineBeginner;
use BitAcademy\Trials\JavascriptBeginner;
use BitAcademy\Trials\Trial;

/**
 * This class is responsible for judging Programming Trials made by Bit Academy students
 */
class Judge
{
    /** @var array<Trial> */
    private array $trials;

    private int $score = 0;

    public function __construct()
    {
        $this->trials = [
            new CommandLineBeginner(),
            new JavascriptBeginner(),
        ];
    }

    public function getTrials(): array
    {
        return $this->trials;
    }

    public function rule(Trial $trial): void
    {
        $this->ruleBash($trial);
        $this->ruleScript($trial);

        echo "De score is: {$this->score}" . PHP_EOL;
        echo $trial->manualCheck() . PHP_EOL;
    }

    private function ruleBash(Trial $trial): void
    {
        $bashChecks = $trial->bashHistory();
        if (empty($bashChecks)) {
            return;
        }

        $history = $this->readHistory();
        foreach ($bashChecks as $regex => $score) {
            foreach ($history as $command) {
                if (preg_match($regex, $command)) {
                    $this->score += $score;
                    continue 2; // you can only get score once
                }
            }
        }
    }

    private function readHistory(): array
    {
        // This doesn't work on my laptop. No idea why not.
        // return explode(PHP_EOL, shell_exec('history 50 | tail -n 50'));

        // yes, the full path is required here. works for the PoC.
        $history = array_slice(file('/Users/bas.deruiter/.zsh_history'), -50);

        // some history lines have a timestamp. Remove that. ": 1721213737:0;ll ~/.zsh_history" -> "ll ~/.zsh_history"
        return array_map(
            fn ($line) => trim(substr($line, strpos($line, ';') ?: 0), ";\r\n\t "),
            $history
        );
    }

    private function ruleScript(Trial $trial): void
    {
        // Check all js, php or html files in the current working directory
        $files = glob('./*.{js,php,html}', GLOB_BRACE);

        foreach ($trial->scriptRules() as $regex => $score) {
            foreach ($files as $file) {
                foreach (file($file) as $line) {
                    if (preg_match($regex, $line)) {
                        $this->score += $score;
                        continue 2; // you can only get score once
                    }
                }
            }
        }
    }
}
