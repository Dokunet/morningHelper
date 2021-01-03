<?php
//Included necessary files
include('../Persistence/userDao.php');

//add logging config
include('../Business/loggingConfig.php');

//enabling the session in this file
include('../Business/session_timeout.php');
session_start();
session_regenerate_id(true);

//checking if the user is logged in
if (!isset($_SESSION['loggedIn'])) {
    header('Location: ../index.php');
}

//add needed variables
$logger = getLogger();
$userModel = getActiveUserModel();
$logger->info('Opened editing view');


/**
 * iterates over all the connections of the user and returns the connection which is specified by the parameters
 *
 * @param $day
 * @param $type
 * @param $userModel
 * @return string
 */
function documentComposer($day, $type, $userModel): string
{
    if (isset($userModel)) {
        foreach ($userModel as $model) {
            if ($model['day'] === $day) {
                return $model[$type];
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
                    <input type="text" name="MondayStart"
                           value="<?php echo documentComposer('Monday', 'start', $userModel) ?>" maxlength="250">
                    Ankunftsort
                    <input type="text" name="MondayDestination"
                           value="<?php echo documentComposer('Monday', 'destination', $userModel) ?>" maxlength="250">
                    <br>
                    <br>
                    Ankunftszeit
                    <input type="time" name="MondayTime"
                           value="<?php echo documentComposer('Monday', 'time', $userModel) ?>">
                </p>
            </li>
            <li>
                <h2>Dienstag</h2>
                <h3>-</h3>
                <p>
                    Abfahrtsort
                    <input type="text" name="TuesdayStart"
                           value="<?php echo documentComposer('Tuesday', 'start', $userModel) ?>" maxlength="250">
                    Ankunftsort
                    <input type="text" name="TuesdayDestination"
                           value="<?php echo documentComposer('Tuesday', 'destination', $userModel) ?>" maxlength="250">
                    <br>
                    <br>
                    Ankunftszeit
                    <input type="time" name="TueasdyTime"
                           value="<?php echo documentComposer('Tuesday', 'time', $userModel) ?>">
                </p>
            </li>

            <li>
                <h2>Mittwoch</h2>
                <h3>-</h3>
                <p>
                    Abfahrtsort
                    <input type="text" name="WednesdayStart"
                           value="<?php echo documentComposer('Wednesday', 'start', $userModel) ?>" maxlength="250">
                    Ankunftsort
                    <input type="text" name="WednesdayDestination"
                           value="<?php echo documentComposer('Wednesday', 'destination', $userModel) ?>"
                           maxlength="250">
                    <br>
                    <br>
                    Ankunftszeit
                    <input type="time" name="WednesdayTime"
                           value="<?php echo documentComposer('Wednesday', 'time', $userModel) ?>">
                </p>
            </li>
            <li>
                <h2>Donnerstag</h2>
                <h3>-</h3>
                <p>
                    Abfahrtsort
                    <input type="text" name="ThursdayStart"
                           value="<?php echo documentComposer('Thursday', 'start', $userModel) ?>" maxlength="250">
                    Ankunftsort
                    <input type="text" name="ThursdayDestination"
                           value="<?php echo documentComposer('Thursday', 'destination', $userModel) ?>"
                           maxlength="250">
                    <br>
                    <br>
                    Ankunftszeit
                    <input type="time" name="ThursdayTime"
                           value="<?php echo documentComposer('Thursday', 'time', $userModel) ?>">
                </p>
            </li>
            <br>
            <li>
                <h2>Freitag</h2>
                <h3>-</h3>
                <p>
                    Abfahrtsort
                    <input type="text" name="FridayStart"
                           value="<?php echo documentComposer('Friday', 'start', $userModel) ?>" maxlength="250">
                    Ankunftsort
                    <input type="text" name="FridayDestination"
                           value="<?php echo documentComposer('Friday', 'destination', $userModel) ?>" maxlength="250">
                    <br>
                    <br>
                    Ankunftszeit
                    <input type="time" name="FridayTime"
                           value="<?php echo documentComposer('Friday', 'time', $userModel) ?>">
                </p>
            </li>
            <li>
                <h2>Samstag</h2>
                <h3>-</h3>
                <p>
                    Abfahrtsort
                    <input type="text" name="SaturdayStart"
                           value="<?php echo documentComposer('Saturday', 'start', $userModel) ?>" maxlength="250">
                    Ankunftsort
                    <input type="text" name="SaturdayDestination"
                           value="<?php echo documentComposer('Saturday', 'destination', $userModel) ?>"
                           maxlength="250">
                    <br>
                    <br>
                    Ankunftszeit
                    <input type="time" name="SaturdayTime"
                           value="<?php echo documentComposer('Saturday', 'time', $userModel) ?>">
                </p>
            </li>
            <li>
                <h2>Sonntag</h2>
                <h3>-</h3>
                <p>
                    Abfahrtsort
                    <input type="text" name="SundayStart"
                           value="<?php echo documentComposer('Sunday', 'start', $userModel) ?>" maxlength="250">
                    Ankunftsort
                    <input type="text" name="SundayDestination"
                           value="<?php echo documentComposer('Sunday', 'destination', $userModel) ?>" maxlength="250">
                    <br>
                    <br>
                    Ankunftszeit
                    <input type="time" name="SundayTime"
                           value="<?php echo documentComposer('Sunday', 'time', $userModel) ?>">
                </p>
            </li>
        </ul>
        <input type="submit" id="editButton" value="save">
        </a>
    </form>
</div>
</body>

</html>