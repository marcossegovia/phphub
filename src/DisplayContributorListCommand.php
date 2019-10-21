<?php

declare(strict_types = 1);

namespace Phphub;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class DisplayContributorListCommand extends Command
{
    protected static $defaultName = 'display-contributors-list';

    private $githubClient;

    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Display All Contributors')
            ->setHelp('Display Contributors List');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $content = file_get_contents('CONTRIBUTING.md');

        if (!$content) {
            $output->writeln('Unable to get the current Contributors List...');
        }

        $output->writeln($content);

    }
}
