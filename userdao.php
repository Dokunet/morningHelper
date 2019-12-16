<?php

print_r($_SESSION);
$usermodel = null;


function selectFromDB($query)
{
    $mysqli = new mysqli('localhost', 'user', 'P@ssw0rd', 'morningHelper');
    $query = $mysqli->prepare($query);
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows) {
        $user = $result->fetch_assoc();
        return $user;
    } else {
        return null;
    }

}

  $user = selectFromDB("SELECT * FROM users;");

  $usermodel = selectFromDB("SELECT * FROM usermodel WHERE userid = " . $user["id"] . ";");
