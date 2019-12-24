<?php

include('dbconnector.inc.php');
session_start();
session_regenerate_id(true);

$error = '';
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
        if (empty($email)) {
            $error .= "Der Benutzername entspricht nicht dem geforderten Format.<br />";
        }
    } else {
        $error .= "Geben Sie bitte den Benutzername an.<br />";
    }
    if (isset($_POST['password'])) {
        $password = trim($_POST['password']);
        if (empty($password) || !preg_match("/(?=^.{8,255}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password)) {
            $error .= "Das Passwort entspricht nicht dem geforderten Format.<br />";
        }
    } else {
        $error .= "Geben Sie bitte das Passwort an.<br />";
    }
    if (empty($error)) {
        $query = "SELECT * FROM users WHERE email=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['uid'] =  $user['id'];
                $result->free();
                $stmt->close();
                header("Location: main.php");
            }
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

    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Login</h1>
    
        <?php
        // fehlermeldung oder nachricht ausgeben
        if (!empty($message)) {
            echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
        } else if (!empty($error)) {
            echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
        }
        ?>
        <form action="" method="POST" class="loginform">
            
                <label for="email">email *</label>
                <br>
                <input type="text" name="email" class="form-control" id="email" value="" placeholder="Gross- und Keinbuchstaben, min 6 Zeichen." title="Gross- und Keinbuchstaben, min 6 Zeichen." maxlength="30" required="true">
                <br>
                <br>
            <!-- password -->
        
                <label for="password">Password *</label>
                <br>
                <input type="password" name="password" class="form-control" id="password" placeholder="Gross- und Kleinbuchstaben, Zahlen, Sonderzeichen, min. 8 Zeichen, keine Umlaute" pattern="(?=^.{8,}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="mindestens einen Gross-, einen Kleinbuchstaben, eine Zahl und ein Sonderzeichen, mindestens 8 Zeichen lang,keine Umlaute." maxlength="255" required="true">
                <br>
                <br>

            <button type="submit" name="button" value="submit" class="btn btn-info">Senden</button>

            <button type="reset" name="button" value="reset" class="btn btn-warning">Löschen</button>
            <br>
            <br>
            <a href="./registration.php">Noch nicht registriert?</a>
        </form>
    </div>
 
</body>

</html>