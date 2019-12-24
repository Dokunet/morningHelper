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
            $result ->close();
            return $user;
        } else {
            return null;
            $result->close();
        }
    } else {
    }
}

$weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];


for ($i = 0; $i < 7; $i++) {
    
    foreach ($_POST as $key => $value) {
         
        if (strpos($key, $weekdays[$i]) !== false) {
            $key = explode($weekdays[$i], $key);
            $test = $key[1];
            $databaseParameter[] = array($test=>$value);
          
            // das geht nicht in php mit assoziativen arrays, muss das anders schreiben.
        }
    }
  
    $usermodel1 = writeData("SELECT * FROM usermodel WHERE day= '$weekdays[$i]'");
    if ($usermodel1['id']==null){
        $usermodel1['id']=$user["id"];
    }
    if ($usermodel1 != null) {
        writeData("UPDATE usermodel SET day='$weekdays[$i]', time='" . $databaseParameter[2]['Time'] . "', start='" . $databaseParameter[0]['Start'] . "', destination='" . $databaseParameter[1]['Destination'] . "', userid=" . $usermodel1["id"] . " WHERE day='$weekdays[$i]' AND userid=" . $usermodel1["id"]);
    } else {
        echo "INSERT INTO usermodel (day, time, start, destination, userid)
        VALUES ('$weekdays[$i],'" . $databaseParameter[2]['Time'] . "','" . $databaseParameter[0]['Start'] . "','" . $databaseParameter[1]['Destination'] . "', " . $usermodel1['id'] . ");";

        writeData("INSERT INTO usermodel (day, time, start, destination, userid)
        VALUES ('". $weekdays[$i] . "','" . $databaseParameter[2]['Time'] . "','" . $databaseParameter[0]['Start'] . "','" . $databaseParameter[1]['Destination'] . "', " . $usermodel1['id'] . ");");
    }
}
header("Location: main.php");
