<?php

$mysqli = new mysqli('localhost', 'user', 'P@ssw0rd', 'morningHelper');
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>