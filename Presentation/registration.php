<?php
//Included necessary files
include('../Persistence/userDao.php');

//add logging config
include('Business/loggingConfig.php');

//enabling the session in this file
include('Business/session_timeout.php');
session_start();
session_regenerate_id(true);

//add needed variables
$error = $message = '';
$firstname = $lastname = $email = $username = '';

//allowing only the post methods to be processes
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // validating all user inputs
    if (isset($_POST['firstname'])) {
        $firstname = trim(htmlspecialchars($_POST['firstname']));

        if (empty($firstname) || strlen($firstname) > 30) {
            $error .= "Geben Sie bitte einen korrekten Vornamen ein.<br />";
        }
    } else {
        $error .= "Geben Sie bitte einen Vornamen ein.<br />";
    }

    if (isset($_POST['lastname'])) {
        $lastname = trim(htmlspecialchars($_POST['lastname']));

        if (empty($lastname) || strlen($lastname) > 30) {
            $error .= "Geben Sie bitte einen korrekten Nachname ein.<br />";
        }
    } else {
        $error .= "Geben Sie bitte einen Nachname ein.<br />";
    }

    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);

        if (empty($email) || strlen($email) > 100 || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $error .= "Geben Sie bitte eine korrekten Emailadresse ein.<br />";
        }
    } else {
        $error .= "Geben Sie bitte eine Emailadresse ein.<br />";
    }

    if (isset($_POST['username'])) {
        $username = trim($_POST['username']);

        if (empty($username) || !preg_match("/(?=.*[a-z])(?=.*[A-Z])[a-zA-Z]{6,30}/", $username)) {
            $error .= "Geben Sie bitte einen korrekten Usernamen ein.<br />";
        }
    } else {
        $error .= "Geben Sie bitte einen Username ein.<br />";
    }

    if (isset($_POST['password'])) {
        $password = trim($_POST['password']);

        if (empty($password) || !preg_match(
                "/(?=^.{8,255}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/",
                $password
            )) {
            $error .= "Geben Sie bitte einen korrektes Password ein.<br />";
        } else {
            //salt wird anscheinend automatisch generiert, nice. Es wird jedoch empfohlen nicht default zu verwenden sondern bcrypt
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        }
    } else {
        $error .= "Geben Sie bitte ein Password ein.<br />";
    }

    if (empty($error)) {
        //preparing the query, binding the attributes finally executing the query
        createUser($firstname, $lastname, $email, $username, $hashed_password);
        header("Location: ../index.php");
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrierung</title>
    <link rel='stylesheet' href='../style/style.css'>
</head>

<body>

<div class="loginform">
    <h1>Registration</h1>

    <?php
    // Ausgabe der Fehlermeldungen
    if (!empty($error)) {
        echo "<div class=\"alert alert-danger\" role=\"alert\">".$error."</div>";
    } elseif (!empty($message)) {
        echo "<div class=\"alert alert-success\" role=\"alert\">".$message."</div>";
    }
    ?>
    <form action="" method="post">
        <!-- vorname -->

        <label for="firstname">Prename *</label>
        <input type="text" name="firstname" class="form-control" value="<?php echo $firstname ?>" maxlength="30"
               required>

        <!-- nachname -->
        <br>
        <br>
        <label for="lastname">Lastname *</label>
        <input type="text" name="lastname" class="form-control" value="<?php echo $lastname ?>" maxlength="30"
               required>

        <!-- email -->

        <br>
        <br>
        <label for="email">Email *</label>
        <input type="email" name="email" class="form-control" value="<?php echo $email ?>" maxlength="100"
               required>

        <!-- benutzername -->
        <br>
        <br>
        <label for="username">Username *</label>
        <input type="text" name="username" class="form-control" value="<?php echo $username ?>"
               pattern="(?=.*[a-z])(?=.*[A-Z])[a-zA-Z]{6,}" title="Gross- und Keinbuchstaben, min 6 Zeichen."
               maxlength="30" required>

        <!-- password -->
        <br>
        <br>
        <label for="password">Password *</label>
        <input type="password" name="password" class="form-control"
               pattern="(?=^.{8,}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
               title="mindestens einen Gross-, einen Kleinbuchstaben, eine Zahl und ein Sonderzeichen, mindestens 8 Zeichen lang,keine Umlaute."
               maxlength="255" required>
        <br>
        <br>
        <button type="submit" name="button" value="submit" class="btn btn-info">save</button>
        <a href="../index.php">cancel</a>
    </form>
</div>

</body>

</html>