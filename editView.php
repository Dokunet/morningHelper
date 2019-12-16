<?php


session_start();
session_regenerate_id(true);

if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php");
}

include('userdao.php');
print_r($user['id']);
echo "test 2";

class editView
{
    function __construct($userModel)
    { }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="list5">
        <form>
            <ul class="tilesWrap">
                <li>
                    <h2>Montag</h2>
                    <h3>-</h3>
                    <p>
                        Abfahrtsort
                        <input type="text" name="">
                        Ankunftsort
                        <input type="text" name="">
                        Ankunftszeit
                        <input type="text" name="">
                    </p>
                </li>
                <li>
                    <h2>Dienstag</h2>
                    <h3>-</h3>
                    <p>
                        Abfahrtsort
                        <input type="text" name="">
                        Ankunftsort
                        <input type="text" name="">
                        Ankunftszeit
                        <input type="text" name="">
                    </p>
                </li>

                <li>
                    <h2>Mittwoch</h2>
                    <h3>-</h3>
                    <p>
                        Abfahrtsort
                        <input type="text" name="">
                        Ankunftsort
                        <input type="text" name="">
                        Ankunftszeit
                        <input type="text" name="">
                    </p>
                </li>
                <li>
                    <h2>Donnerstag</h2>
                    <h3>-</h3>
                    <p>
                        Abfahrtsort
                        <input type="text" name="">
                        Ankunftsort
                        <input type="text" name="">
                        Ankunftszeit
                        <input type="text" name="">
                    </p>
                </li>
                <br>
                <li>
                    <h2>Freitag</h2>
                    <h3>-</h3>
                    <p>
                        Abfahrtsort
                        <input type="text" name="">
                        Ankunftsort
                        <input type="text" name="">
                        Ankunftszeit
                        <input type="text" name="">
                    </p>
                </li>
                <li>
                    <h2>Samstag</h2>
                    <h3>-</h3>
                    <p>
                        Abfahrtsort
                        <input type="text" name="">
                        Ankunftsort
                        <input type="text" name="">
                        Ankunftszeit
                        <input type="text" name="">
                    </p>
                </li>
                <li>
                    <h2>Sonntag</h2>
                    <h3>-</h3>
                    <p>
                        Abfahrtsort
                        <input type="text" name="">
                        Ankunftsort
                        <input type="text" name="">
                        Ankunftszeit
                        <input type="text" name="">
                    </p>
                </li>
            </ul>
            <a href="main.php">
                <div id="editButton">
                    Abbrechen
                </div>
            </a>
        </form>
    </div>
</body>

</html>