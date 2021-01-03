<?php

require __DIR__.'/../vendor/autoload.php';

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * create logger and set verbosity level
 *
 * @return Logger
 */
function getLogger(): Logger
{
    $logger = new Logger('logger');
    $logger->pushHandler(new StreamHandler('../logs/log.log', Logger::EMERGENCY));

    return $logger;
}