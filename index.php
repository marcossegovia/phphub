#!/usr/bin/php

<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application('Phphub');

$client = new \Github\Client();

$product = new \Github\Product();

$application->add(new \Phphub\CreateComposerFileCommand($client));

$application->run();
