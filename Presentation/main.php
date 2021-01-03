<?php
//Included necessary files
include('../Persistence/userDao.php');
include('Persistence/dbconnector.inc.php');
include('../Business/dateManager.php');
include('../Business/clothes.php');
include('../ApiCalls/weatherApi.php');
include('../ApiCalls/commuteApi.php');

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
$weekdays = getWeekdays();
$userModel = getActiveUserModel();
$logger = getLogger();

//checking if the user has already given some input, if not he will be redirected to the editView file where he inputs some data
if ($userModel === null) {
    header('Location: editView.php');
}

//calling a function which in response returns information about the current weather
function weatherComposer($currentDay, $day)
{
    //checking if the the given date is the todays date, because the api doesnt provide data about weather predictions
    if (date('l') === $currentDay && $day['start'] !== null) {
        $weather = getWeather($day['start']);

        //the temperature and weather alongside the output of another function where the clothing recommendations are given, are being returned
        return $weather[0]." ".$weather[1]."<br> <br>".getClothingRecommendation($weather[1]);
    }

    //if the date is not today's date a "-" is returned and outputted to indicate that there are no information yet available
    return '-';
}

?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <link rel='stylesheet' href='../style/style.css'>
    <title>Home</title>
</head>

<body>
<h1>Morning Helper</h1>
<div class="dropdown">
    <button class="dropbtn">Account</button>
    <div class="dropdown-content">
        <a href="../Business/logout.php">log out</a>
        <a href="changePassword.php">change password</a>
        <a href="adminView.php">Admin Area</a>
    </div>
</div>
<div id="list5">
    <ul class="tilesWrap">
        <li>
            <h2>Montag</h2>
            <h3><?php echo htmlspecialchars($weekdays['Monday']) ?></h3>
            <p>
                <?php
                if (isset($userModel[4])) {
                    echo htmlspecialchars(weatherComposer('Monday', $userModel[0]));
                    echo "<br>";
                    echo "<br>";
                    $response = getConnection(
                        $userModel[0]['start'],
                        $userModel[0]['destination'],
                        $userModel[0]['time']
                    );
                    print_r(htmlspecialchars($response['connections'][0]['from']));
                    print_r(htmlspecialchars(substr_replace($response['connections'][0]['departure'], "", 0, 10)));
                }
                ?>

            </p>
        </li>
        <li>
            <h2>Dienstag</h2>
            <h3><?php echo htmlspecialchars($weekdays['Tuesday']) ?></h3>
            <p>
                <?php
                if (isset($userModel[1])) {
                    echo htmlspecialchars(weatherComposer('Tuesday', $userModel[1]));
                    echo "<br>";
                    echo "<br>";
                    $response = getConnection(
                        $userModel[1]['start'],
                        $userModel[1]['destination'],
                        $userModel[1]['time']
                    );
                    print_r(htmlspecialchars($response['connections'][0]['from']));
                    print_r(htmlspecialchars(substr_replace($response['connections'][0]['departure'], "", 0, 10)));
                }
                ?>
            </p>
        </li>

        <li>
            <h2>Mittwoch</h2>
            <h3><?php echo htmlspecialchars($weekdays['Wednesday']) ?></h3>
            <p>
                <?php
                if (isset($userModel[2])) {
                    echo htmlspecialchars(weatherComposer('Wednesday', $userModel[2]));
                    echo "<br>";
                    echo "<br>";
                    $response = getConnection(
                        $userModel[2]['start'],
                        $userModel[2]['destination'],
                        $userModel[2]['time']
                    );
                    print_r(htmlspecialchars($response['connections'][0]['from']));
                    print_r(htmlspecialchars(substr_replace($response['connections'][0]['departure'], "", 0, 10)));
                }
                ?>
            </p>
        </li>
        <li>
            <h2>Donnerstag</h2>
            <h3><?php echo htmlspecialchars($weekdays['Thursday']) ?></h3>
            <p>
                <?php echo htmlspecialchars(weatherComposer('Thursday', $userModel[3]));
                if (isset($userModel[3])) {
                    echo "<br>";
                    echo "<br>";
                    $response = getConnection(
                        $userModel[3]['start'],
                        $userModel[3]['destination'],
                        $userModel[3]['time']
                    );
                    print_r(htmlspecialchars($response['connections'][0]['from']));
                    print_r(htmlspecialchars(substr_replace($response['connections'][0]['departure'], "", 0, 10)));
                }
                ?>
            </p>
        </li>
        <li>
            <h2>Freitag</h2>
            <h3><?php echo htmlspecialchars($weekdays['Friday']) ?></h3>
            <p>
                <?php
                if (isset($userModel[4])) {
                    echo htmlspecialchars(weatherComposer('Friday', $userModel[4]));
                    echo "<br>";
                    echo "<br>";
                    $response = getConnection(
                        $userModel[4]['start'],
                        $userModel[4]['destination'],
                        $userModel[4]['time']
                    );
                    print_r(htmlspecialchars($response['connections'][0]['from']));
                    print_r(htmlspecialchars(substr_replace($response['connections'][0]['departure'], "", 0, 10)));
                }
                ?>
            </p>
        </li>
        <li>
            <h2>Samstag</h2>
            <h3><?php echo htmlspecialchars($weekdays['Saturday']) ?></h3>
            <p>
                <?php
                if (isset($userModel[5])) {
                    echo htmlspecialchars(weatherComposer('Saturday', $userModel[5]));
                    echo "<br>";
                    echo "<br>";
                    $response = getConnection(
                        $userModel[5]['start'],
                        $userModel[5]['destination'],
                        $userModel[5]['time']
                    );
                    print_r(htmlspecialchars($response['connections'][0]['from']));
                    print_r(htmlspecialchars(substr_replace($response['connections'][0]['departure'], "", 0, 10)));
                }
                ?>
            </p>
        </li>
        <li>
            <h2>Sonntag</h2>
            <h3><?php echo htmlspecialchars($weekdays['Sunday']) ?></h3>
            <p>
                <?php
                if (isset($userModel[6])) {
                    echo htmlspecialchars(weatherComposer('Sunday', $userModel[6]));
                    echo "<br>";
                    echo "<br>";
                    $response = getConnection(
                        $userModel[6]['start'],
                        $userModel[6]['destination'],
                        $userModel[6]['time']
                    );
                    if (!isset($response['error'])) {
                        print_r(htmlspecialchars($response['connections'][0]['from']));
                        print_r(htmlspecialchars(substr_replace($response['connections'][0]['departure'], "", 0, 10)));
                    }
                }
                ?>
            </p>
        </li>
    </ul>
    <a href="editView.php">
        <div id="editButton">
            Edit
        </div>
    </a>

</div>
</body>

</html>