<?php
include('Persistence/userdao.php');
//Database connection is included
include('Persistence/dbconnector.inc.php');
include('Business/loggingConfig.php');
//the session for the login is started

include('Business/session_timeout.php');
session_start();
session_regenerate_id(true);

$error = '';
$message = '';

require dirname(__FILE__).'/vendor/autoload.php';

/* use Monolog\Logger;
use Monolog\Handler\StreamHandler; */

// add records to the log
$log->warning('bla');
$log->error('gur');

//establishing that only Post method is accepted, because of security
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $log->info('Output to php://stderr');
    //checking if the text field email is not empty, so 
    if (isset($_POST['email'])) {
        $log->warning('wow');
        $email = trim($_POST['email']);
    } else {
        $log->warning('wow');

        $error .= "Geben Sie bitte eine Emailadresse an.<br />";
    }
    //checking if the password field is empty or not
    if (isset($_POST['password'])) {
        $log->warning('wow');
        $password = trim($_POST['password']);
    } else {
        $log->warning('wow');
        $error .= "Geben Sie bitte das Passwort an.<br />";
    }
    //if the previos fields arent empty the login process is being continued
    if (empty($error)) {
        //a query is written, prepared, the attributes securly bound to the query and query itself is being executed in the end
        $log->warning('wow');
        $query = "SELECT * FROM users WHERE email=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        //the results are saved and formatted
        $result = $stmt->get_result();
        if ($result->num_rows) {
            $user = $result->fetch_assoc();
            //todo: weiss noch nicht ob man das ändern muss, weil es ja noch das klartext passwort ist, jedoch wird bei verify das passwort mit gehasht.
            //if the password is correct the Session gets an attribute which signalizes that the user is is successfully loged in
            if (password_verify($password, $user['password'])) {
                $log->warning('wow');
                $old_session = $_SESSION;
                session_regenerate_id(true);
                //todo: nicht sicher ob das stimmt, ist die session id dann wieder die alte?
                $_SESSION = $old_session;
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['uid'] = $user['id'];
                $_SESSION['admin'] = checkAdmin($user['id']);
                $result->free();
                $stmt->close();
                //if the user did type in the correct password he is being reidrected to the main page
                header("Location: Presentation/main.php");
            } else {
                $log->warning('wow');
                echo "<div class=\"alert alert-danger\" role=\"alert\" style=\"color: red\">Passwort oder Emailadresse sind nicht korrekt</div>";
            }
        } else {
            $log->warning('wow');
            echo "<div class=\"alert alert-danger\" role=\"alert\" style=\"color: red\">Passwort oder Emailadresse sind nicht korrekt</div>";
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
    <h1>Login</h1>

    <?php
    if (!empty($message)) {
        echo "<div class=\"alert alert-success\" role=\"alert\">".$message."</div>";
    } elseif (!empty($error)) {
        echo "<div class=\"alert alert-danger\" role=\"alert\">".$error."</div>";
    }
    ?>
    <form action="" method="POST" class="loginform">
        <label for="email">email *</label>
        <br>
        <input type="text" name="email" class="form-control" id="email" value="" maxlength="30" required>
        <br>
        <br>
        <!-- password -->
        <label for="password">Password *</label>
        <br>
        <input type="password" name="password" class="form-control" id="password" maxlength="255" required>
        <br>
        <br>
        <button type="submit" name="button" value="submit" class="btn btn-info">Senden</button>
        <button type="reset" name="button" value="reset" class="btn btn-warning">Löschen</button>
        <br>
        <br>
        <a href="./Presentation/registration.php">Noch nicht registriert?</a>
    </form>
</div>

</body>

</html>