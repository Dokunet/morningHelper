<?php
//Included necessary files
include('Persistence/userdao.php');
include('Persistence/dbconnector.inc.php');

//add logging config
include('Business/loggingConfig.php');
require __DIR__.'/vendor/autoload.php';

//the session for the login is started
include('Business/session_timeout.php');
session_start();
session_regenerate_id(true);

//add needed variables
$error = '';
$message = '';
$logger = getLogger();

//establishing that only Post method is accepted, because of security
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $logger->info('Login Attempt');
    $logger->info('Validating Login-Data');
    //validate email
    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
    } else {
        $error .= "Please enter a email address<br />";
    }

    //validate password
    if (isset($_POST['password'])) {
        $password = trim($_POST['password']);
    } else {
        $error .= "Please enter a password<br />";
    }


    if (empty($error)) {
        //a query is written, prepared, the attributes securely bound to the query and query itself is being executed in the end
        $result = executeQueryWithSingleStringParameter("SELECT * FROM users WHERE email=?", $email);

        if ($result->num_rows) {
            $user = $result->fetch_assoc();
            var_dump(password_verify($password, $user['password']));
            if (password_verify($password, $user['password'])) {
                session_regenerate_id(true);
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['uid'] = $user['id'];
                $_SESSION['admin'] = checkAdmin($user['id']);
                $logger->info('Login successful');

                header("Location: Presentation/main.php");
            } else {
                $logger->warning('Login failed');
                echo "<div class='alert alert-danger' role='alert' style='color: red'>Login attempt failed</div>";
            }
        } else {
            $logger->info('Validation failed');
            echo "<div class='alert alert-danger' role='alert' style='color: red'>Please check your credentials</div>";
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
        echo "<div class='alert alert-success' role='alert'>".$message."</div>";
    } elseif (!empty($error)) {
        echo "<div class='alert alert-danger' role='alert'>".$error."</div>";
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