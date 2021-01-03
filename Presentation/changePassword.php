<?php
include('../Business/loggingConfig.php');
//a mysql connection is being established
include('../Persistence/dbconnector.inc.php');
//the session is being used and therby started
include('../Business/session_timeout.php');
session_start();
session_regenerate_id(true);

$error = '';
$message = '';
//if condition so the sever only processes post methods becaus of security
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //validation
    if (isset($_POST['password1'])) {
        $password = trim($_POST['password1']);
        if (empty($password) || !preg_match("/(?=^.{8,255}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password)) {
            $error .= "Das Passwort entspricht nicht dem geforderten Format.<br />";
        }
    } else {
        $error .= "Geben Sie bitte das Passwort an.<br />";
    }
    if (empty($error)) {
        //saved information of the logged in user are being accuired for the validation of the password
        $query = "SELECT * FROM users WHERE id=?";
        //query is being prepared, parameters bound and the query executed
        $stmt = $mysqli->prepare($query);
        $uid = $_SESSION['uid'];
        $stmt->bind_param("i", $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows) {
            $user = $result->fetch_assoc();
            $old_password = $_POST['old_password'];
            //verifying if the user typed in his current password correctly
            if (password_verify($old_password, $user['password'])) {
                $password1 = $_POST['password1'];
                $password2 = $_POST['password2'];
                //verifying if the the new password he wrote is the 2 times the same
                if (strcmp($password1, $password2) == 0) {
                    //the new password is being hashed and saved to the databse
                    $hashed_new_password = password_hash($password1, PASSWORD_DEFAULT);
                    $query = "UPDATE users SET password=? WHERE id = ?";
                    $stmt = $mysqli->prepare($query);
                    $uid = $_SESSION['uid'];
                    $stmt->bind_param("si", $hashed_new_password, $uid);
                    $stmt->execute();
                    //user is being redirected to the main page
                    header("Location: main.php");
                } else {
                    echo "<div class=\"alert alert-danger\" role=\"alert\" style=\"color: red\">the 2 new passwords are not the same</div>";
                }
            } else {
                echo "<div class=\"alert alert-danger\" role=\"alert\" style=\"color: red\">password not correct</div>";
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

    <link rel="stylesheet" type="text/css" href="../style/style.css">
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

        <form action="" method="POST" class="loginform">

            <label for="email">old password *</label>
            <br>
            <input type="password" name="old_password" class="form-control" id="old_password" value="" placeholder="old password..." maxlength="255" required="true">
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

            <button type="submit" name="button" value="submit" class="btn btn-info">save</button>
            <a href="main.php">Back</a>
            <br>
            <br>

        </form>
    </div>

</body>

</html>