<?php

declare(strict_types = 1);

namespace Phphub;

use Github\Api\Issue;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class DisplayIssuesListCommand extends Command
{
    const POSSIBLE_STATES = array("open", "closed", "all"); 
    
    protected static $defaultName = 'display-issues-list';
    
    public function __construct(Issue $issues)
    {
        parent::__construct();
        $this->issues = $issues;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('state', InputArgument::OPTIONAL, "issue state ( open, closed, all )", 'open')
            ->setDescription('Display all issues in this repository')
            ->setHelp('Display a list of all issues in this repository');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $state = strtolower($input->getArgument('state'));
        if(! in_array($state, self::POSSIBLE_STATES )) {
            $output->writeln("Invalid issue state");
        }
        $allIssues = $this->issues->all('marcossegovia', 'phphub', array("state" => $state));
        foreach($allIssues as $issue) {
            $issueDescripiton = "Number: " . $issue["number"] . " Title: " . $issue["title"] . " State: " . $issue["state"];
            $output->writeln($issueDescripiton);
        }
    }
}
