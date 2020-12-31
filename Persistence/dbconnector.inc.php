<?php
include('../Business/loggingConfig.php');
//a mysql connection to the localhost s being established

//todo: change to user with less right
$mysqli = new mysqli('localhost', 'user', 'P@ssw0rd', 'morningHelper');
// if an error occures the connection will be cancelled.
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
