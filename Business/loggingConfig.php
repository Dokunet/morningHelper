<?php

require __DIR__.'/../vendor/autoload.php';

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

// create a log channel
$log = new Logger('test');
$log->pushHandler(new StreamHandler('../logs/log.log', Logger::WARNING));

/* // add records to the log
$log->warning('Foo');
$log->error('Bar'); */