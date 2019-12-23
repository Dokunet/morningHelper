<?php

$usermodel = null;

function selectFromDB($query)
{
    $mysqli = new mysqli('localhost', 'user', 'P@ssw0rd', 'morningHelper');
    $query = $mysqli->prepare($query);
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows) {
        $user = $result->fetch_all(MYSQLI_ASSOC);
        return $user;
    } else {
        return null;
    }
}

list($user) = selectFromDB("SELECT * FROM users;");

$usermodel = selectFromDB("SELECT * FROM usermodel WHERE userid = " . $user["id"] . ";");

global $usermodel;
