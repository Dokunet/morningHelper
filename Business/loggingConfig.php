<?php

require dirname(__FILE__).'/../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('test');
$log->pushHandler(new StreamHandler('../logs/log.log', Logger::WARNING));

/* // add records to the log
$log->warning('Foo');
$log->error('Bar'); */