<?php

$usermodel = null;

function selectFromDB($query, $id)
{
    // the mysql connection is being included
    include('dbconnector.inc.php');
    //a select query is being prepared and the the $id parameter is being bound to the 'where' condition
    $query = $mysqli->prepare($query);
    $query->bind_param("s", $id);
    echo $mysqli->error;
    //query is being executed and results ar being received
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows) {
        $user = $result->fetch_all(MYSQLI_ASSOC);
        return $user;
    } else {
        return null;
    }
}
// the id which is being set to the session in the loggin page is being sent to the function
$userid = $_SESSION['uid'];
//the function above is called a query and the userid are being send to the function, the query asks for the user table
list($user) = selectFromDB("SELECT * FROM users WHERE id =?", $userid);
//a second call is being made but this time the Connections and their day and time are being selected
$usermodel = selectFromDB("SELECT * FROM usermodel WHERE userid =?", $user["id"]);

global $usermodel;

/**
 * checks if user is admin
 *
 * @param int $userId
 * @return bool
 */
function checkAdmin(int $userId): bool
{
    $admin = selectFromDB("SELECT admin FROM users WHERE id =?", $userId);

    return (bool)$admin[0]['admin'];
}
