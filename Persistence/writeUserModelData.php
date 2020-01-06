<?php
//the session is being used in this file which is why the session is being started
session_start();
session_regenerate_id(true);

if (!isset($_SESSION['loggedin'])) {
    header("Location: ../index.php");
}
//the userdao file is being included for the selection of users and their connections
include('./userdao.php');
// a function which has all the parameter which are contained in the usermodel tables, the function is explictly for the updating of existing database tables
function updateData($query, $weekday, $time, $start, $destination, $userid)
{
    //including msqli so a database connection can be established
    include('dbconnector.inc.php');
    //query is prepared and parameters are bound and the query is being executed
    $query = $mysqli->prepare($query);
    $query->bind_param("ssssisi", $weekday, $time, $start, $destination, $userid, $weekday, $userid);
    //if there was an error, he will bei output
    echo $mysqli->error;
    $query->execute();
    if (empty($error)) {
        $result = $query->get_result();
        if ($result->num_rows) {
            $user = $result->fetch_assoc();
            $result->close();
            return $user;
        } else {
            return null;
            $result->close();
        }
    } else {
        return "error";
    }
}

// a function which has all the parameter which are contained in the usermodel tables, the function is explictly for the inserting of existing database tables
function writeData($query, $weekday, $time, $start, $destination, $userid)
{
    //including msqli so a database connection can be established
    include('dbconnector.inc.php');
    //query is prepared and parameters are bound and the query is being executed
    $query = $mysqli->prepare($query);
    echo $mysqli->error;
    $query->bind_param("ssssi", $weekday, $time, $start, $destination, $userid);
    $query->execute();
    if (empty($error)) {
        $result = $query->get_result();
        if ($result->num_rows) {
            $user = $result->fetch_assoc();
            $result->close();
            return $user;
        } else {
            return null;
            $result->close();
        }
    } else {
        return "error";
    }
}

// all the weekdays of a week
$weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

$databaseParameter = [];
//server validation of the form input
foreach ($_POST as $key => $value) {
    $trimedValue = trim(htmlspecialchars($value));
    //all from input values are being saved to an array for further processing. 21 Values are being pushed in to the array of which always 3 of them represent each a day of the week
    array_push($databaseParameter, $trimedValue);
}

//all form input are being looped through in steps of 3 so per day there can be executed as a query seperatly
for ($i = 0; $i < 21; $i += 3) {
    //the weekdays are only seven which is why the steps of 3 is being divded by 3 so an iteration of the weekdays is also passible
    $weekday = $i / 3;
    //a select statment is bein written so the connection of a day of the corresponding user is being returned
    $usermodel1 = selectFromDB("SELECT * FROM usermodel WHERE day= '" . $weekdays[$weekday] . "' AND userid=?", $userid);
    // if the user has already given a connection on this day, is being updated, regardlesslay if he has the same values
    if ($usermodel1 != null) {
        updateData("UPDATE usermodel SET day=?, time=?, start=?, destination=?, userid=? WHERE day=? AND userid=?", $weekdays[$weekday], $databaseParameter[$i + 2], $databaseParameter[$i],  $databaseParameter[$i + 1], $userid);
    } //if the user has not already written a connections a new table is set
    else {
        writeData("INSERT INTO usermodel (day, time, start, destination, userid)
        VALUES (?,?,?,?,?);", $weekdays[$weekday], $databaseParameter[$i + 2], $databaseParameter[$i],  $databaseParameter[$i + 1], $userid);
    }
}
//after everything is written in to the database the user is bein redirected to the main page
header("Location: ../Presentation/main.php");
