<?php
//Included necessary files
include('../Persistence/userDao.php');

//add logging config
include('../Business/loggingConfig.php');

//enabling the session in this file
include('../Business/session_timeout.php');
session_start();
session_regenerate_id(true);

//checking if the user is logged in and admin
if (!isset($_SESSION['loggedIn'])) {
    header('Location: ../index.php');
}

if (!$_SESSION['admin']) {
    header("Location: ./main.php");
}


//add needed variables
$logger = getLogger();
$error = '';
$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $logger->info('Validating Admin Action Input');
    if (isset($_POST['id'])) {
        $uId = trim(htmlspecialchars($_POST['id']));

        deleteUserModel($uId);
        deleteUser($uId);

        $message .= "User deleted<br />";
    } else {
        $logger->warning('no user id given when deleting user');
        $error .= "Something went wrong please reload the page and try again<br />";
    }


}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Users</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
<?php
if (!empty($message)) {
    echo "<div class='alert alert-success' role='alert'>".$message."</div>";
} elseif (!empty($error)) {
    echo "<div class='alert alert-danger' role='alert'>".$error."</div>";
}
?>
<h1>Morning Helper Users</h1>
<a href='main.php'>
    <button class='adminButton'>Back</button>
</a>
<form method='post'>
    <table class='userTable'>
        <tr>
            <th id="username">Username</th>
            <th id="fistName">Name</th>
            <th id="lastName">Surname</th>
            <th id="email">Email</th>
            <th id="email">Delete</th>
        </tr>
        <?php
        $users = getAllNonAdminUsers();
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>".$user['username']."</td>";
            echo "<td>".$user['firstname']."</td>";
            echo "<td>".$user['lastname']."</td>";
            echo "<td>".$user['email']."</td>";
            echo "<td><input type='submit' name='id' value=".$user["id"]."></td>";
            echo "</tr>";
        }
        ?>
    </table>
</form>
</body>
</html>
