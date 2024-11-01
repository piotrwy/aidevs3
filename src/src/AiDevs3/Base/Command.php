<?php

namespace App\AiDevs3\Base;

use GuzzleHttp\RequestOptions;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use GuzzleHttp\Client;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Webmozart\Assert\Assert;

abstract class Command extends SymfonyCommand
{
    public const TASK_NAME = null;

    private const VERIFY_URL = 'https://poligon.aidevs.pl/verify';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        Assert::notNull(static::TASK_NAME, 'add TASK_NAME const to your Command');

        $client = new Client();

        $body = [
            'task' => static::TASK_NAME,
            'apikey' => $_ENV['AIDEVS_API_KEY'],
            'answer' => $this->solveTask(),
        ];

        if ($output->isVerbose()) {
            $output->writeln('<comment>Request Body:</comment>');
            $output->writeln(print_r($body, true));
        }

        $response = $client->request('POST', self::VERIFY_URL, [
            RequestOptions::JSON => $body,
        ]);
        $response = json_decode($response->getBody()->getContents());

        if ($output->isVerbose()) {
            $output->writeln('<comment>Response:</comment>');
            $output->writeln(print_r($response, true));
        }

        Assert::eq(
            $response->code, 0, $response->code . ': ' . $response->message ?? 'undefined error'
        );

        $output->writeln('<info>' . $response->message . '</info>');

        return SymfonyCommand::SUCCESS;
    }

    abstract protected function solveTask(): mixed;
}
