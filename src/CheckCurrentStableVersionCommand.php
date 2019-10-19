<?php

declare(strict_types = 1);

namespace Phphub;

use Sunra\PhpSimple\HtmlDomParser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class GetCurrentStableVersionCommand extends Command
{
    /** @var HtmlDomParser */
    private $parser;

    /**
     * GetCurrentStableVersionCommand constructor.
     * @param HtmlDomParser $parser
     */
    public function __construct(HtmlDomParser $parser)
    {
        $this->parser = $parser;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Displays the current stable version of PHP');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    }
}
