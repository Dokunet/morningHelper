<?php
//the session is being used so the user has to be logged in
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

$users = getAllUsers();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Users</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
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
        </tr>
        <?php
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>".$user['username']."</td>";
            echo "<td>".$user['firstname']."</td>";
            echo "<td>".$user['lastname']."</td>";
            echo "<td>".$user['email']."</td>";
            echo "<td><input type='submit' name='username' value='Delete'/></td>";
            echo "</tr>";
        }
        ?>
    </table>
</form>
</body>
</html>
