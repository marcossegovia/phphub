#!/usr/bin/php

<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application('Phphub');

$client = new \Github\Client();

$application->add(new \Phphub\CreateComposerFileCommand($client));
$application->add(new \Phphub\CheckCurrentStableVersionCommand());

$application->run();
