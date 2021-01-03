<?php
//enabling the session in this file
include('../Business/session_timeout.php');
session_start();
session_regenerate_id(true);
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../index.php");
}
if (!$_SESSION['admin']) {
    header("Location: ./main.php");
}
//user dao is being included
include('../Persistence/userdao.php');

$error = '';
$message = '';
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST['id'])) {
        $log->info('id given');
        $uId = trim($_POST['id']);
        if (empty($error)) {

        }

        deleteUserModel($uId);
        deleteUser($uId);

        $message .= "User deleted<br />";
    } else {
        $log->warning('no user id given when deleting user');
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
        $users = getAllUsers();
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
