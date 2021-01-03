<?php
//a mysql connection to the localhost s being established

$mysqli = new mysqli('localhost', 'user', 'P@ssw0rd', 'morningHelper');
// if an error occures the connection will be cancelled.

if ($mysqli->connect_error) {
    die('Connect Error ('.$mysqli->connect_errno.') '.$mysqli->connect_error);
}

/**
 * @param string $username
 * @param string $password
 * @return mysqli
 */
function getMySqlI($username = 'user', $password = 'P@ssw0rd'): mysqli
{
    return new mysqli('localhost', $username, $password, 'morningHelper');
}