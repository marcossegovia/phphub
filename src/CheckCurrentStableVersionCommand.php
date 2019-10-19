<?php

declare(strict_types = 1);

namespace Phphub;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

final class CheckCurrentStableVersionCommand extends Command
{
    private const DOWNLOADS_PAGE = 'https://www.php.net/downloads.php';
    private const MESSAGE = 'Current stable PHP version is %s';

    protected function configure(): void
    {
        $this->setName('phphub:check-current-stable-version')
            ->setDescription('Displays the current stable version of PHP');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $content = file_get_contents(self::DOWNLOADS_PAGE);

        if (!$content) {
            $output->writeln('Unable to get the current stable version...');
        }

        $crawler = new Crawler($content);

        $current = $crawler->filter('section#layout-content > h3.title')->eq(0);

        $output->writeln(sprintf(self::MESSAGE, $current->attr('id')));
    }
}
