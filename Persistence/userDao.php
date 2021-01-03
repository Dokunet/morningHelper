<?php
include('dbconnector.inc.php');
/**
 * get user model for user based on session id
 *
 * @return mixed|null
 */
function getActiveUserModel()
{
    return selectUserModelFromUserId($_SESSION['uid']);
}

/**
 * create user
 * @param $firstname
 * @param $lastname
 * @param $email
 * @param $username
 * @param $hashed_password
 */
function createUser($firstname, $lastname, $email, $username, $hashed_password)
{
    //get mySql connection
    $mySqlI = getMySqlI();

    //prepare query and bind parameter
    $query = $mySqlI->prepare(
        "INSERT INTO users (firstname, lastname, email, username, password, admin) VALUES (?, ?, ?, ?, ?, 0)"
    );

    $query->bind_param("sssss", $firstname, $lastname, $email, $username, $hashed_password);
    $query->execute();
    $query->close();
}

/**
 * set new password
 *
 * @param $hashed_new_password
 * @param $uid
 */
function updatePassword($hashed_new_password, $uid)
{
    //get mySql connection
    $mySqlI = getMySqlI();

    //prepare query and bind parameter
    $query = $mySqlI->prepare("UPDATE users SET password=? WHERE id = ?");

    $query->bind_param("si", $hashed_new_password, $uid);
    $query->execute();
    $query->close();
}

/**
 * get user model for user based on user id
 *
 * @param $uId
 * @return mixed|null
 */
function selectUserModelFromUserId($uId)
{
    $result = executeQueryWithSingleStringParameter("SELECT * FROM usermodel WHERE userid =?", $uId);
    if ($result->num_rows) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    return null;
}

/**
 * checks if user is admin
 *
 * @param int $userId
 * @return bool
 */
function checkAdmin(int $userId): bool
{
    $result = executeQueryWithSingleStringParameter("SELECT admin FROM users WHERE id =?", $userId);

    if ($result->num_rows) {
        $admin = $result->fetch_all(MYSQLI_ASSOC);
        print_r((bool)$admin[0]['admin']);

        return (bool)$admin[0]['admin'];
    }

    return false;
}

/**
 * fetch all users
 *
 * @return array
 */
function getAllNonAdminUsers(): array
{
    $result = executeQueryWithSingleStringParameter("SELECT * FROM users WHERE admin=?", 0);
    if ($result->num_rows) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    return [];
}

/**
 * delete user model for given user
 *
 * @param $uId
 * @return array
 */
function deleteUserModel($uId): array
{
    $result = executeQueryWithSingleStringParameter("DELETE FROM usermodel WHERE userid =?", $uId);
    if ($result->num_rows) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    return [];
}

/**
 * delete user model for given user
 *
 * @param $uId
 * @return array
 */
function deleteUser($uId): array
{
    $result = executeQueryWithSingleStringParameter("DELETE FROM users WHERE id =?", $uId);
    if ($result->num_rows) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    return [];
}

/**
 * execute sql statement with one parameter, returns result even if empty
 *
 * @param $query
 * @param $param
 * @return mysqli_result|false
 */
function executeQueryWithSingleStringParameter($query, $param)
{
    //get mySql connection
    $mySqlI = getMySqlI();

    //prepare query and bind parameter
    $query = $mySqlI->prepare($query);
    $query->bind_param("s", $param);

    //output error if occurred
    echo $mySqlI->error;

    //execute query and fetch results
    $query->execute();
    $result = $query->get_result();
    $query->close();

    return $result;
}
