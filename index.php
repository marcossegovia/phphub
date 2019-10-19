#!/usr/bin/php

<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application("Welcome to Phphub \u{1F418}", 0.1);

$client = new \Github\Client();

$application->add(new \Phphub\CreateComposerFileCommand($client));

$application->run();
