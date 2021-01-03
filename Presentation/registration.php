<?php
//mysql connection is being established
include('../Persistence/dbconnector.inc.php');
include('../Business/loggingConfig.php');
$error = $message = '';
$firstname = $lastname = $email = $username = '';

//allowing only the post methods to be processes
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $logger->info('user is trying to create an account');
    // validating all user inputs
    if (isset($_POST['firstname'])) {
        $firstname = trim(htmlspecialchars($_POST['firstname']));

        if (empty($firstname) || strlen($firstname) > 30) {
            $logger->alert('entered firstname by the user does not match the requirements');
            $error .= "Geben Sie bitte einen korrekten Vornamen ein.<br />";
        }
    } else {
        $logger->alert('user has not entered a firstname');
        $error .= "Geben Sie bitte einen Vornamen ein.<br />";
    }

    if (isset($_POST['lastname'])) {
        $lastname = trim(htmlspecialchars($_POST['lastname']));

        if (empty($lastname) || strlen($lastname) > 30) {
            $logger->alert('entered lastname by the user does not match the requirements');
            $error .= "Geben Sie bitte einen korrekten Nachname ein.<br />";
        }
    } else {
        $logger->alert('user has not entered a lastname');
        $error .= "Geben Sie bitte einen Nachname ein.<br />";
    }

    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);

        if (empty($email) || strlen($email) > 100 || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $logger->alert('entered email by the user does not match the requirements');
            $error .= "Geben Sie bitte eine korrekten Emailadresse ein.<br />";
        }
    } else {
        $logger->alert('user has not entered an emailaddress');
        $error .= "Geben Sie bitte eine Emailadresse ein.<br />";
    }

    if (isset($_POST['username'])) {
        $username = trim($_POST['username']);

        if (empty($username) || !preg_match("/(?=.*[a-z])(?=.*[A-Z])[a-zA-Z]{6,30}/", $username)) {
            $logger->alert('entered username by the user does not match the requirements');
            $error .= "Geben Sie bitte einen korrekten Usernamen ein.<br />";
        }
    } else {
        $logger->alert('user has not entered an username');
        $error .= "Geben Sie bitte einen Username ein.<br />";
    }

    if (isset($_POST['password'])) {
        $password = trim($_POST['password']);

        if (empty($password) || !preg_match(
                "/(?=^.{8,255}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/",
                $password
            )) {
            $logger->alert('entered password by the user does not match the requirements');
            $error .= "Geben Sie bitte einen korrektes Password ein.<br />";
        } else {
            //salt wird anscheinend automatisch generiert, nice. Es wird jedoch empfohlen nicht default zu verwenden sondern bcrypt
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        }
    } else {
        $logger->alert('user has not entered a password');
        $error .= "Geben Sie bitte ein Password ein.<br />";
    }

    if (empty($error)) {
        $logger->info('loginform is entered correctly');
        //preparing the query, binding the attributes finally executing the query
        $logger->info('statement is created and user is inserted in to the database');
        $query = "INSERT INTO users (firstname, lastname, email, username, password, admin)
                   VALUES (?, ?, ?, ?, ?, 0)";

        $stmt = $mysqli->prepare($query);
        if ($stmt === false) {
            echo $mysqli->error;
        }
        $stmt->bind_param("sssss", $firstname, $lastname, $email, $username, $hashed_password);
        $stmt->execute();
        $stmt->close();
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