<?php

include('Business/loggingConfig.php');
//usermodel is set to null, so it doesnt save or cache data from previous calls
$usermodel = null;

function selectFromDB($query)
{
    $mysqli = new mysqli('localhost', 'user', 'P@ssw0rd', 'morningHelper');
    $query = $mysqli->prepare($query);
    echo $mysqli->error;
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows) {
        $user = $result->fetch_all(MYSQLI_ASSOC);
        return $user;
    } else {
        return null;
    }
}
$logger->info ('user entry is selected');
list($user) = selectFromDB("SELECT * FROM users WHERE id =" . $_SESSION['uid'] . ";");
$logger->info ('usermodel is selected');
$usermodel = selectFromDB("SELECT * FROM usermodel WHERE userid = " . $user["id"] . ";");

global $usermodel;
