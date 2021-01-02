<?php
//the session is being used so the user has to be loggedin
session_start();
session_regenerate_id(true);
include('../Business/session_timeout.php');
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../index.php");
}
include('../Business/loggingConfig.php');
//userdao is being included
include('../Persistence/userdao.php');
//function which iterates over all the connections of the user and returns the connection whiich is specified by the parameters
$log->error('sodhfowsiudhfbgiwsubfd now in editview');
function dokumentComposer($day, $type, $usermodel)
{
    if (isset($usermodel)) {
        foreach ($usermodel as &$singlemodel) {
            if ($singlemodel['day'] == $day) {
                return $singlemodel[$type];
            }
        }
    } else {
        return "";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <div id="list5">
        <form action="../Persistence/writeUserModelData.php" method="POST" target="_self">
            <ul class="tilesWrap">
                <li>
                    <h2>Montag</h2>
                    <h3>-</h3>
                    <p>
                        Abfahrtsort
                        <input type="text" name="MondayStart" value="<?php echo dokumentComposer('Monday', 'start', $usermodel) ?>" maxlength="250">
                        Ankunftsort
                        <input type="text" name="MondayDestination" value="<?php echo dokumentComposer('Monday', 'destination', $usermodel) ?>" maxlength="250">
                        <br>
                        <br>
                        Ankunftszeit
                        <input type="time" name="MondayTime" value="<?php echo dokumentComposer('Monday', 'time', $usermodel) ?>">
                    </p>
                </li>
                <li>
                    <h2>Dienstag</h2>
                    <h3>-</h3>
                    <p>
                        Abfahrtsort
                        <input type="text" name="TuesdayStart" value="<?php echo dokumentComposer('Tuesday', 'start', $usermodel) ?>" maxlength="250">
                        Ankunftsort
                        <input type="text" name="TuesdayDestination" value="<?php echo dokumentComposer('Tuesday', 'destination', $usermodel) ?>" maxlength="250">
                        <br>
                        <br>
                        Ankunftszeit
                        <input type="time" name="TueasdyTime" value="<?php echo dokumentComposer('Tuesday', 'time', $usermodel) ?>">
                    </p>
                </li>

                <li>
                    <h2>Mittwoch</h2>
                    <h3>-</h3>
                    <p>
                        Abfahrtsort
                        <input type="text" name="WednesdayStart" value="<?php echo dokumentComposer('Wednesday', 'start', $usermodel) ?>" maxlength="250">
                        Ankunftsort
                        <input type="text" name="WednesdayDestination" value="<?php echo dokumentComposer('Wednesday', 'destination', $usermodel) ?>" maxlength="250">
                        <br>
                        <br>
                        Ankunftszeit
                        <input type="time" name="WednesdayTime" value="<?php echo dokumentComposer('Wednesday', 'time', $usermodel) ?>">
                    </p>
                </li>
                <li>
                    <h2>Donnerstag</h2>
                    <h3>-</h3>
                    <p>
                        Abfahrtsort
                        <input type="text" name="ThursdayStart" value="<?php echo dokumentComposer('Thursday', 'start', $usermodel) ?>" maxlength="250">
                        Ankunftsort
                        <input type="text" name="ThursdayDestination" value="<?php echo dokumentComposer('Thursday', 'destination', $usermodel) ?>" maxlength="250">
                        <br>
                        <br>
                        Ankunftszeit
                        <input type="time" name="ThursdayTime" value="<?php echo dokumentComposer('Thursday', 'time', $usermodel) ?>">
                    </p>
                </li>
                <br>
                <li>
                    <h2>Freitag</h2>
                    <h3>-</h3>
                    <p>
                        Abfahrtsort
                        <input type="text" name="FridayStart" value="<?php echo dokumentComposer('Friday', 'start', $usermodel) ?>" maxlength="250">
                        Ankunftsort
                        <input type="text" name="FridayDestination" value="<?php echo dokumentComposer('Friday', 'destination', $usermodel) ?>" maxlength="250">
                        <br>
                        <br>
                        Ankunftszeit
                        <input type="time" name="FridayTime" value="<?php echo dokumentComposer('Friday', 'time', $usermodel) ?>">
                    </p>
                </li>
                <li>
                    <h2>Samstag</h2>
                    <h3>-</h3>
                    <p>
                        Abfahrtsort
                        <input type="text" name="SaturdayStart" value="<?php echo dokumentComposer('Saturday', 'start', $usermodel) ?>" maxlength="250">
                        Ankunftsort
                        <input type="text" name="SaturdayDestination" value="<?php echo dokumentComposer('Saturday', 'destination', $usermodel) ?>" maxlength="250">
                        <br>
                        <br>
                        Ankunftszeit
                        <input type="time" name="SaturdayTime" value="<?php echo dokumentComposer('Saturday', 'time', $usermodel) ?>">
                    </p>
                </li>
                <li>
                    <h2>Sonntag</h2>
                    <h3>-</h3>
                    <p>
                        Abfahrtsort
                        <input type="text" name="SundayStart" value="<?php echo dokumentComposer('Sunday', 'start', $usermodel) ?>" maxlength="250">
                        Ankunftsort
                        <input type="text" name="SundayDestination" value="<?php echo dokumentComposer('Sunday', 'destination', $usermodel) ?>" maxlength="250">
                        <br>
                        <br>
                        Ankunftszeit
                        <input type="time" name="SundayTime" value="<?php echo dokumentComposer('Sunday', 'time', $usermodel) ?>">
                    </p>
                </li>
            </ul>
            <input type="submit" id="editButton" value="save">
            </a>
        </form>
    </div>
</body>

</html>