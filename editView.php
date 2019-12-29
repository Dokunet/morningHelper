<?php


session_start();
session_regenerate_id(true);

if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php");
}

include('userdao.php');


function dokumentComposer($day, $type, $usermodel)
{
    if (isset($usermodel)) {
        foreach ($usermodel as &$singlemodel) {
            if ($singlemodel['day'] == $day) {
                return $singlemodel[$type];
            }
        }
    } else{
        return "";
    }
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
        <form action="/writeUserModelData.php" method="POST" target="_self">
            <ul class="tilesWrap">
                <li>
                    <h2>Montag</h2>
                    <h3>-</h3>
                    <p>
                        Abfahrtsort
                        <input type="text" name="MondayStart" value="<?php echo dokumentComposer('Monday', 'start', $usermodel) ?>">
                        Ankunftsort
                        <input type="text" name="MondayDestination" value="<?php echo dokumentComposer('Monday', 'destination', $usermodel) ?>">
                        Ankunftszeit
                        <input type="text" name="MondayTime" value="<?php echo dokumentComposer('Monday', 'time', $usermodel) ?>">
                    </p>
                </li>
                <li>
                    <h2>Dienstag</h2>
                    <h3>-</h3>
                    <p>
                        Abfahrtsort
                        <input type="text" name="TuesdayStart" value="<?php echo dokumentComposer('Tuesday', 'start', $usermodel) ?>">
                        Ankunftsort
                        <input type="text" name="TuesdayDestination" value="<?php echo dokumentComposer('Tuesday', 'destination', $usermodel) ?>">
                        Ankunftszeit
                        <input type="text" name="TueasdyTime" value="<?php echo dokumentComposer('Tuesday', 'time', $usermodel) ?>">
                    </p>
                </li>

                <li>
                    <h2>Mittwoch</h2>
                    <h3>-</h3>
                    <p>
                        Abfahrtsort
                        <input type="text" name="WednesdayStart" value="<?php echo dokumentComposer('Wednesday', 'start', $usermodel) ?>">
                        Ankunftsort
                        <input type="text" name="WednesdayDestination" value="<?php echo dokumentComposer('Wednesday', 'destination', $usermodel) ?>">
                        Ankunftszeit
                        <input type="text" name="WednesdayTime" value="<?php echo dokumentComposer('Wednesday', 'time', $usermodel) ?>">
                    </p>
                </li>
                <li>
                    <h2>Donnerstag</h2>
                    <h3>-</h3>
                    <p>
                        Abfahrtsort
                        <input type="text" name="ThursdayStart" value="<?php echo dokumentComposer('Thursday', 'start', $usermodel) ?>">
                        Ankunftsort
                        <input type="text" name="ThursdayDestination" value="<?php echo dokumentComposer('Thursday', 'destination', $usermodel) ?>">
                        Ankunftszeit
                        <input type="text" name="ThursdayTime" value="<?php echo dokumentComposer('Thursday', 'time', $usermodel) ?>">
                    </p>
                </li>
                <br>
                <li>
                    <h2>Freitag</h2>
                    <h3>-</h3>
                    <p>
                        Abfahrtsort
                        <input type="text" name="FridayStart" value="<?php echo dokumentComposer('Friday', 'start', $usermodel) ?>">
                        Ankunftsort
                        <input type="text" name="FridayDestination" value="<?php echo dokumentComposer('Friday', 'destination', $usermodel) ?>">
                        Ankunftszeit
                        <input type="text" name="FridayTime" value="<?php echo dokumentComposer('Friday', 'time', $usermodel) ?>">
                    </p>
                </li>
                <li>
                    <h2>Samstag</h2>
                    <h3>-</h3>
                    <p>
                        Abfahrtsort
                        <input type="text" name="SaturdayStart" value="<?php echo dokumentComposer('Saturday', 'start', $usermodel) ?>">
                        Ankunftsort
                        <input type="text" name="SaturdayDestination" value="<?php echo dokumentComposer('Saturday', 'destination', $usermodel) ?>">
                        Ankunftszeit
                        <input type="text" name="SaturdayTime" value="<?php echo dokumentComposer('Saturday', 'time', $usermodel) ?>">
                    </p>
                </li>
                <li>
                    <h2>Sonntag</h2>
                    <h3>-</h3>
                    <p>
                        Abfahrtsort
                        <input type="text" name="SundayStart" value="<?php echo dokumentComposer('Sunday', 'start', $usermodel) ?>">
                        Ankunftsort
                        <input type="text" name="SundayDestination" value="<?php echo dokumentComposer('Sunday', 'destination', $usermodel) ?>">
                        Ankunftszeit
                        <input type="text" name="SundayTime" value="<?php echo dokumentComposer('Sunday', 'time', $usermodel) ?>">
                    </p>
                </li>
            </ul>
            <input type="submit" id="editButton" value="speichern">
            </a>
        </form>
    </div>
</body>

</html>