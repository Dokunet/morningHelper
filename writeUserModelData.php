<?php
include('userdao.php');
function writeData($query)
{
    $mysqli = new mysqli('localhost', 'user', 'P@ssw0rd', 'morningHelper');
    $query = $mysqli->prepare($query);
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
    }
}

$weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

$databaseParameter = [];
foreach ($_POST as $key => $value) {
    array_push($databaseParameter, $value);
}


for ($i = 0; $i < 21; $i += 3) {
    $weekday = $i/3;
    echo "this is a test";
    $usermodel1 = writeData("SELECT * FROM usermodel WHERE day= '$weekdays[$weekday]' AND userid=$userid");
    if ($usermodel1 != null) {
        writeData("UPDATE usermodel SET day='$weekdays[$weekday]', time='" . $databaseParameter[$i+2] . "', start='" . $databaseParameter[$i] . "', destination='" . $databaseParameter[$i+1] . "', userid=" . $userid . " WHERE day='$weekdays[$weekday]' AND userid=" . $userid);
    } else {
        writeData("INSERT INTO usermodel (day, time, start, destination, userid)
    VALUES ('" . $weekdays[$weekday] . "','" . $databaseParameter[$i+2] . "','" . $databaseParameter[$i] . "','" . $databaseParameter[$i+1] . "', " . $userid . ");");
    }
}

header("Location: main.php");
