#!/usr/bin/php

<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;

define('ROOT_DIR', __DIR__);
$application = new Application("Welcome to Phphub \u{1F418}", 0.1);

$client = new \Github\Client();
$fileSystem = new \Phphub\Persistence\FileSystem();

$application->add(new \Phphub\CreateComposerFileCommand($client));
$application->add(new \Phphub\CheckCurrentStableVersionCommand());
$application->add(new \Phphub\GenerateSnippetCommand($client, $fileSystem));
$application->add(new \Phphub\DisplayContributorListCommand());


$application->run();
