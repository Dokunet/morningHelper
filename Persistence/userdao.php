<?php

$usermodel = null;

function selectFromDB($query, $id)
{
    $mysqli = new mysqli('localhost', 'user', 'P@ssw0rd', 'morningHelper');
    $query = $mysqli->prepare($query);
    $query->bind_param("s", $id);
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
$userid = $_SESSION['uid'];
list($user) = selectFromDB("SELECT * FROM users WHERE id =?", $userid);

$usermodel = selectFromDB("SELECT * FROM usermodel WHERE userid =?", $user["id"] );

global $usermodel;
