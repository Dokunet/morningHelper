<?php
//Included necessary files
include('userModelDao.php');
include('../Business/dateManager.php');

//add logging config
include('../Business/loggingConfig.php');

//enabling the session in this file
include('../Business/session_timeout.php');
session_start();
session_regenerate_id(true);

//checking if the user is logged in
if (!isset($_SESSION['loggedIn'])) {
    header('Location: ../index.php');
}

//add needed variables
$weekdays = getWeekdays();
$logger = getLogger();

$databaseParameter = [];
//server validation of the form input
$logger->info('Validating User Model Input');
foreach ($_POST as $key => $value) {
    $trimmedValue = trim(htmlspecialchars($value));
    //all from input values are being saved to an array for further processing. 21 Values are being pushed in to the array of which always 3 of them represent each a day of the week
    $databaseParameter[] = $trimmedValue;
}

$logger->info('Writing User Model');
//all form input are being looped through in steps of 3 so per day there can be executed as a query separately
for ($i = 0; $i < 21; $i += 3) {
    //the weekdays are only seven which is why the steps of 3 is being divided by 3 so an iteration of the weekdays is also possible
    $weekday = $i / 3;
    //a select statement is being written so the connection of a day of the corresponding user is being returned
    $result = executeQueryWithSingleStringParameter("SELECT * FROM usermodel WHERE day='".$weekdays[$weekday]."' AND userid=?", $_SESSION['uid']);

    if ($result->num_rows) {
        $userModelDay = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $userModelDay = null;
    }

    // if the user has already given a connection on this day, is being updated, regardless if he has the same values
    if ($userModelDay !== null) {
        updateUserModel(
            $weekdays[$weekday],
            $databaseParameter[$i + 2],
            $databaseParameter[$i],
            $databaseParameter[$i + 1],
            $_SESSION['uid']
        );
    } else {
        createUserModel(
            $weekdays[$weekday],
            $databaseParameter[$i + 2],
            $databaseParameter[$i],
            $databaseParameter[$i + 1],
            $_SESSION['uid']
        );
    }
}

//after everything is written in to the database the user is being redirected to the main page
header("Location: ../Presentation/main.php");
