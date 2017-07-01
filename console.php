<?php
require __DIR__.'/vendor/autoload.php';

use landingSILEX\Command\GreetCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new GreetCommand());
$application->run();