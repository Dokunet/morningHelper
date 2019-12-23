<?php
include('userdao.php');
function writeData($query)
{
    $mysqli = new mysqli('localhost', 'user', 'P@ssw0rd', 'morningHelper');
    echo $query;
    if (empty($error)) {
        print_r($query);
        $query = $mysqli->prepare($query);
        print_r($query);
        $query->execute();
        $result = $query->get_result();
        if ($result->num_rows) {
            $user = $result->fetch_assoc();;
            return $user;
        } else {
            return null;
        }
    }
}

$weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];


for ($i = 0; $i < 7; $i++) {
    $databaseParameter[] = null;
    foreach ($_POST as $key => $value) {
        if (strpos($key, $weekdays[$i]) !== false) {
            $key = explode($weekdays[$i], $key);
            $test = $key[1];
            $databaseParameter[] = array($test=>$value);
            print_r($test);
            // das geht nicht in php mit assoziativen arrays, muss das anders schreiben.
        }
    }
    print_r($databaseParameter);
    $usermodel1 = writeData("SELECT * FROM usermodel WHERE day= '$weekdays[$i]'");
    if ($usermodel1 != null) {
        writeData("UPDATE usermodel SET day=$weekdays[$i], time=" . $databaseParameter['Time'] . ", start=" . $databaseParameter['Start'] . ", destination=" . $databaseParameter['Destination'] . ", userid=" . $usermodel1["id"] . ", WHERE day=$weekdays[$i] AND userid=" . $usermodel1["id"]);
    } else {
        writeData("INSERT INTO usermodel (day, time, start, destination, userid)
        VALUES ($weekdays[$i]," . $databaseParameter[2]['Time'] . "," . $databaseParameter[0]['Start'] . "," . $databaseParameter[1]['Destination'] . ", " . $usermodel1["id"] . ";)");
    }
}
