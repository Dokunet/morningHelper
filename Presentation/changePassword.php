<?php

include('../Persistence/dbconnector.inc.php');
session_start();
session_regenerate_id(true);

$error = '';
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 /*   if (isset($_POST['old_password'])) {
        $old_password = trim($_POST['old_password']);
        if (empty($old_password)) {
            $error .= "Der Benutzername entspricht nicht dem geforderten Format.<br />";
        }
    } else {
        $error .= "Geben Sie bitte den Benutzername an.<br />";
    }*/
    if (isset($_POST['password1'])) {
        $password = trim($_POST['password1']);
        if (empty($password) || !preg_match("/(?=^.{8,255}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password)) {
            $error .= "Das Passwort entspricht nicht dem geforderten Format.<br />";
        }
    } else {
        $error .= "Geben Sie bitte das Passwort an.<br />";
    }
    if (empty($error)) {
        $query = "SELECT * FROM users WHERE id=?";
        $stmt = $mysqli->prepare($query);
        $uid = $_SESSION['uid'];
        $stmt->bind_param("i", $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows) {
            $user = $result->fetch_assoc();
            $old_password = $_POST['old_password'];
            echo $old_password;
            echo "<br> test <br>";
            echo $user['password'];
            //if (password_verify($old_password, $user['password'])) {
                echo "success";
                $password1 = $_POST['password1'];
                $password2 = $_POST['password2'];
                if($hashed_password1 === $hashed_password2){
                    $hashed_new_password = password_hash($password1, PASSWORD_DEFAULT);
                    $query = "UPDATE users SET password=? WHERE id = ?";
                    $stmt = $mysqli->prepare($query);
                    $uid = $_SESSION['uid'];
                    $stmt->bind_param("si", $hashed_new_password, $uid);
                    $stmt->execute();
                    header("Location: main.php");
                } else {
                    echo "not so successful";
                }
              
            //} else {
              //  echo "even less successful";
            //}
        } else {
            echo "well thats shit";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>

<body>
    <div class="container">
        <h1>change password</h1>
    
        <?php
        // fehlermeldung oder nachricht ausgeben
        if (!empty($message)) {
            echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
        } else if (!empty($error)) {
            echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
        }
        ?>

        <form action="" method="POST">
            
                <label for="email">old password *</label>
                <br>
                <input type="password" name="old_password" class="form-control" id="email" value="" placeholder="Gross- und Kleinbuchstaben, Zahlen, Sonderzeichen, min. 8 Zeichen, keine Umlaute" title="Gross- und Keinbuchstaben, min 6 Zeichen." pattern="(?=^.{8,}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" maxlength="255" required="true">
                <br>
                <br>
            <!-- password -->
        
                <label for="password">Password *</label>
                <br>
                <input type="password" name="password1" class="form-control" id="password1" placeholder="Gross- und Kleinbuchstaben, Zahlen, Sonderzeichen, min. 8 Zeichen, keine Umlaute" pattern="(?=^.{8,}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="mindestens einen Gross-, einen Kleinbuchstaben, eine Zahl und ein Sonderzeichen, mindestens 8 Zeichen lang,keine Umlaute." maxlength="255" required="true">
                <br>
                <br>
                <label for="password2">Password *</label>
                <br>
                <input type="password" name="password2" class="form-control" id="password2" placeholder="Gross- und Kleinbuchstaben, Zahlen, Sonderzeichen, min. 8 Zeichen, keine Umlaute" pattern="(?=^.{8,}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="mindestens einen Gross-, einen Kleinbuchstaben, eine Zahl und ein Sonderzeichen, mindestens 8 Zeichen lang,keine Umlaute." maxlength="255" required="true">
                <br>
                <br>

            <button type="submit" name="button" value="submit" class="btn btn-info">Senden</button>

            <button type="reset" name="button" value="reset" class="btn btn-warning">Löschen</button>
            <br>
            <br>
    
        </form>
    </div>
 
</body>

</html>