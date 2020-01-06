<?php 
// Unset all of the session variables.
$_SESSION = array();

//Session Cookie is being deleted so the user is correctly and completly loggedout
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// The Session is being destroyed
session_destroy();
//the User is being redirected to the Login Page
header("Location: ../index.php");
