<?php

namespace App\AiDevs3\Prework;

use App\AiDevs3\Base\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'ai:test')]
class Test extends Command
{
    public const TASK_NAME = 'POLIGON';

    protected function solveTask(): mixed
    {
        $data = file_get_contents('https://poligon.aidevs.pl/dane.txt');

        return explode("\n", trim($data));
    }
}
