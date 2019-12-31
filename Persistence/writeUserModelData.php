<?php
session_start();
session_regenerate_id(true);
include('./userdao.php');

function updateData($query, $weekday, $time, $start, $destination, $userid)
{
    echo "this should not happen: <br>";
    $mysqli = new mysqli('localhost', 'user', 'P@ssw0rd', 'morningHelper');
    $query = $mysqli->prepare($query);
    $query->bind_param("ssssisi", $weekday, $time, $start, $destination, $userid, $weekday, $userid);
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

function writeData($query, $weekday, $time, $start, $destination, $userid)
{
    echo "something should follow here: <b>";
    echo $query;
    $mysqli = new mysqli('localhost', 'user', 'P@ssw0rd', 'morningHelper');
    $query = $mysqli->prepare($query);
    echo $mysqli->error;
    $query->bind_param("ssssi", $weekday, $time, $start, $destination, $userid);
    echo $query;
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


$weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

$databaseParameter = [];
foreach ($_POST as $key => $value) {
    $trimedValue = trim(htmlspecialchars($value));
    array_push($databaseParameter, $trimedValue);
}


for ($i = 0; $i < 21; $i += 3) {
    $weekday = $i / 3;
    echo "this is a test";
    $usermodel1 = selectFromDB("SELECT * FROM usermodel WHERE day= '".$weekdays[$weekday]."' AND userid=?", $userid);
    if ($usermodel1 != null) {
        updateData("UPDATE usermodel SET day=?, time=?, start=?, destination=?, userid=? WHERE day=? AND userid=?", $weekdays[$weekday], $databaseParameter[$i + 2], $databaseParameter[$i],  $databaseParameter[$i + 1], $userid);
    } else {
        writeData("INSERT INTO usermodel (day, time, start, destination, userid)
        VALUES (?,?,?,?,?);", $weekdays[$weekday], $databaseParameter[$i + 2], $databaseParameter[$i],  $databaseParameter[$i + 1], $userid);
    }
}

header("Location: ../Presentation/main.php");
