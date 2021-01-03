<?php

$usermodel = null;
include('../Business/loggingConfig.php');
/**
 * get user model for user based on session id
 *
 * @return mixed|null
 */
function getActiveUserModel()
{
    return selectUserModelFromUserId($_SESSION['uid']);
}

/**
 * get user model for user based on user id
 *
 * @param $uId
 * @return mixed|null
 */
function selectUserModelFromUserId($uId)
{
    //get mySql connection
    $mySqlI = getMySqlI();

    //prepare query and bind parameters
    $query = $mySqlI->prepare("SELECT * FROM usermodel WHERE userid =?");
    $query->bind_param("s", $uId);

    //output error if occurred
    echo $mySqlI->error;

    //execute query and fetch results
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    return null;
}

/**
 * execute sql statement with one parameter, returns result even if empty
 *
 * @param $query
 * @param $param
 * @return mysqli_result|false
 */
function executeQueryWithSingleStringParameter($query, $param)
{
    //get mySql connection
    $mySqlI = getMySqlI();

    //prepare query and bind parameter
    $query = $mySqlI->prepare($query);
    $query->bind_param("s", $param);

    //output error if occurred
    echo $mySqlI->error;

    //execute query and fetch results
    $query->execute();
    $result = $query->get_result();
    $query->close();

    return $result;
}

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

//// the id which is being set to the session in the loggin page is being sent to the function
//$userid = $_SESSION['uid'];
////the function above is called a query and the userid are being send to the function, the query asks for the user table
//list($user) = selectFromDB("SELECT * FROM users WHERE id =?", $userid);
////a second call is being made but this time the Connections and their day and time are being selected
//$usermodel = selectFromDB("SELECT * FROM usermodel WHERE userid =?", $user["id"]);
//
//global $usermodel;

/**
 * checks if user is admin
 *
 * @param int $userId
 * @return bool
 */
function checkAdmin(int $userId): bool
{
    $result = executeQueryWithSingleStringParameter("SELECT admin FROM users WHERE id =?", $userId);

    if ($result->num_rows) {
        $admin = $result->fetch_all(MYSQLI_ASSOC);

        return (bool)$admin[0]['admin'];
    }

    return false;
}

/**
 * fetch all users
 *
 * @return array
 */
function getAllUsers(): array
{
    // the mysql connection is being included
    include('dbconnector.inc.php');
    //a select query is being prepared and the the $id parameter is being bound to the 'where' condition
    $query = $mysqli->prepare("SELECT * FROM users WHERE admin=0");
    echo $mysqli->error;
    //query is being executed and results ar being received
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    return [];
}

/**
 * delete user model for given user
 *
 * @param $uId
 * @return array
 */
function deleteUserModel(int $uId): array
{
    // the mysql connection is being included
    include('dbconnector.inc.php');
    //a select query is being prepared and the the $id parameter is being bound to the 'where' condition
    $query = $mysqli->prepare("DELETE FROM usermodel WHERE userid =?");
    $query->bind_param("i", $uId);
    echo $mysqli->error;
    //query is being executed and results ar being received
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    return [];
}

/**
 * delete user model for given user
 *
 * @param $uId
 * @return array
 */
function deleteUser(int $uId): array
{
    // the mysql connection is being included
    include('dbconnector.inc.php');
    //a select query is being prepared and the the $id parameter is being bound to the 'where' condition
    $query = $mysqli->prepare("DELETE FROM users WHERE id =?");
    $query->bind_param("i", $uId);
    echo $mysqli->error;
    //query is being executed and results ar being received
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    return [];
}

