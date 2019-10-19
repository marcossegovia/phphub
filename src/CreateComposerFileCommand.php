<?php

namespace Phphub;

use Github\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CreateComposerFileCommand extends Command
{
    protected static $defaultName = 'create-composer';

    private $githubClient;

    public function __construct(Client $githubClient)
    {
        parent::__construct();
        $this->githubClient = $githubClient;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Creates a default composer.json')
            ->setHelp('Creates a standard awesome composer.json');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $this->githubClient->api('repo')->contents()->download('marcossegovia', 'my-php-default-skeleton', 'composer.json', 'master');
        \file_put_contents('./composer.json', $file);
    }
}
