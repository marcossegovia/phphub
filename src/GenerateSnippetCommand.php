<?php

declare(strict_types=1);

namespace Phphub;

use Github\Client;
use Phphub\Persistence\FileSystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

final class GenerateSnippetCommand extends Command
{
    protected static $defaultName = 'create-snippet';

    private $githubClient;
    private $fileSystem;

    public function __construct(Client $githubClient, FileSystem $fileSystem)
    {
        parent::__construct();
        $this->githubClient = $githubClient;
        $this->fileSystem = $fileSystem;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('file-path', InputArgument::REQUIRED, 'path of the file you want to create the gist from')
            ->addArgument('description', InputArgument::OPTIONAL, 'description of the gist', '')
            ->setDescription('Creates a gist from an existing file')
            ->setHelp('Creates a gist in your Github account given an existing file in your local');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $token = $this->fileSystem->get('token');
        if (null === $token) {
            $question = new Question('We need your github access token for that:', 'YOU_GITHUB_TOKEN_HASH');
            $helper = $this->getHelper('question');
            $token = $helper->ask($input, $output, $question);
            $this->fileSystem->set('token', $token);
        }
        $this->githubClient->authenticate($token, Client::AUTH_URL_TOKEN);
        $content = \file_get_contents($input->getArgument('file-path'));
        $file = new \stdClass();
        $file->content = $content;
        $params = [
            'files' => [\basename($input->getArgument('file-path')) => $file],
            'description' => $input->getArgument('description'),
            'public' => false
            ];
        $this->githubClient->api('gists')->create($params);
    }
}
