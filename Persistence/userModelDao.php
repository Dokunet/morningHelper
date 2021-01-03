<?php
//Included necessary files
include('userDao.php');

/**
 * update user model for user
 *
 * @param $weekday
 * @param $time
 * @param $start
 * @param $destination
 * @param $userid
 * @return mixed|null
 */
function updateUserModel($weekday, $time, $start, $destination, $userid)
{
    //get mySql connection
    $mySqlI = getMySqlI();


    //prepare query and bind parameters
    $query = $mySqlI->prepare(
        "UPDATE usermodel SET day=?, time=?, start=?, destination=?, userid=? WHERE day=? AND userid=?"
    );

    $query->bind_param("ssssisi", $weekday, $time, $start, $destination, $userid, $weekday, $userid);

    //output error if occurred
    echo $mySqlI->error;

    //execute query and fetch results
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows) {
        $userModel = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();

        return $userModel;
    }

    return null;
}

function createUserModel($weekday, $time, $start, $destination, $userid)
{
    //get mySql connection
    $mySqlI = getMySqlI();

    //prepare query and bind parameters
    $query = $mySqlI->prepare("INSERT INTO usermodel (day, time, start, destination, userid) VALUES (?,?,?,?,?);");
    $query->bind_param("ssssi", $weekday, $time, $start, $destination, $userid);

    //output error if occurred
    echo $mySqlI->error;

    //execute query and fetch results
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows) {
        $userModel = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();

        return $userModel;
    }

    return null;
}