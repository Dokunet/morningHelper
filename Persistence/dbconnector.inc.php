<?php
/**
 * @param string $username
 * @param string $password
 * @return mysqli
 */
function getMySqlI($username = 'user', $password = 'P@ssw0rd'): mysqli
{

    $connection = new mysqli('localhost', $username, $password, 'morningHelper');

    if ($connection->connect_error) {
        die('Connect Error ('.$connection->connect_errno.') '.$connection->connect_error);
    }

    return $connection;

}