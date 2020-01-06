 <?php
  //enabling the session in this file
  session_start();
  session_regenerate_id(true);

  //including all the necessary files
  include('../Business/dateManager.php');
  include('../Business/clothes.php');
  include('../ApiCalls/weatherApi.php');
  include('../Persistence/userdao.php');
  include('../ApiCalls/commuteApi.php');

  //checking if the user is infact logged in
  if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
  }
  //checking if the user has already given some input, if not he will be redirected to de editview file where he inputs some data
  if ($usermodel == null) {
    header('Location: editView.php');
  }
  //calling a function which in response returns information about the current weather
  function weatherComposer($currentDay, $day)
  {
    //checking if the the given date is the todays date, because the api doesnt provide data about weather predictions
    if (date('l') == $currentDay && !$day['start'] == null) {
      $weather = getWeather($day['start']);
      //the temperatur and weather alongside the output of another function where the clothing recommendations are given, are being returned
      return $weather[0] . " " . $weather[1] . "<br> <br>" . getClothingRecommendation($weather[1]);
    } else {
      //if the date is not todays date a "-" is returned and outputed to indicate that there are no informations yet available
      return '-';
    }
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
     </div>
   </div>
   <div id="list5">
     <ul class="tilesWrap">
       <li>
         <h2>Montag</h2>
         <h3><?php echo $weekdays['Monday'] ?></h3>
         <p>
           <?php
            if (isset($usermodel[4])) {
              echo weatherComposer('Monday', $usermodel[0]);
              echo "<br>";
              echo "<br>";
              $response = getConnection($usermodel[0]['start'], $usermodel[0]['destination'], $usermodel[0]['time']);
              print_r($response['connections'][0]['from']);
              print_r(substr_replace($response['connections'][0]['departure'], "", 0, 10));
            }
            ?>

         </p>
       </li>
       <li>
         <h2>Dienstag</h2>
         <h3><?php echo $weekdays['Tuesday'] ?></h3>
         <p>
           <?php
            if (isset($usermodel[1])) {
              echo weatherComposer('Tuesday', $usermodel[1]);
              echo "<br>";
              echo "<br>";
              $response = getConnection($usermodel[1]['start'], $usermodel[1]['destination'], $usermodel[1]['time']);
              print_r($response['connections'][0]['from']);
              print_r(substr_replace($response['connections'][0]['departure'], "", 0, 10));
            }
            ?>
         </p>
       </li>

       <li>
         <h2>Mittwoch</h2>
         <h3><?php echo $weekdays['Wednesday'] ?></h3>
         <p>
           <?php
            if (isset($usermodel[2])) {
              echo weatherComposer('Wednesday',  $usermodel[2]);
              echo "<br>";
              echo "<br>";
              $response = getConnection($usermodel[2]['start'], $usermodel[2]['destination'], $usermodel[2]['time']);
              print_r($response['connections'][0]['from']);
              print_r(substr_replace($response['connections'][0]['departure'], "", 0, 10));
            }
            ?>
         </p>
       </li>
       <li>
         <h2>Donnerstag</h2>
         <h3><?php echo $weekdays['Thursday'] ?></h3>
         <p>
           <?php echo weatherComposer('Thursday', $usermodel[3]);
            if (isset($usermodel[3])) {
              echo "<br>";
              echo "<br>";
              $response = getConnection($usermodel[3]['start'], $usermodel[3]['destination'], $usermodel[3]['time']);
              print_r($response['connections'][0]['from']);
              print_r(substr_replace($response['connections'][0]['departure'], "", 0, 10));
            }
            ?>
         </p>
       </li>
       <br>
       <li>
         <h2>Freitag</h2>
         <h3><?php echo $weekdays['Friday'] ?></h3>
         <p>
           <?php
            if (isset($usermodel[4])) {
              echo weatherComposer('Friday',  $usermodel[4]);
              echo "<br>";
              echo "<br>";
              $response = getConnection($usermodel[4]['start'], $usermodel[4]['destination'], $usermodel[4]['time']);
              print_r($response['connections'][0]['from']);
              print_r(substr_replace($response['connections'][0]['departure'], "", 0, 10));
            }
            ?>
         </p>
       </li>
       <li>
         <h2>Samstag</h2>
         <h3><?php echo $weekdays['Saturday'] ?></h3>
         <p>
           <?php
            if (isset($usermodel[5])) {
              echo weatherComposer('Saturday', $usermodel[5]);
              echo "<br>";
              echo "<br>";
              $response = getConnection($usermodel[5]['start'], $usermodel[5]['destination'], $usermodel[5]['time']);
              print_r($response['connections'][0]['from']);
              print_r(substr_replace($response['connections'][0]['departure'], "", 0, 10));
            }
            ?>
         </p>
       </li>
       <li>
         <h2>Sonntag</h2>
         <h3><?php echo $weekdays['Sunday'] ?></h3>
         <p>
           <?php
            if (isset($usermodel[6])) {
              echo weatherComposer('Sunday', $usermodel[6]);
              echo "<br>";
              echo "<br>";
              $response = getConnection($usermodel[6]['start'], $usermodel[6]['destination'], $usermodel[6]['time']);
              if (!isset($response['error'])) {
                print_r($response['connections'][0]['from']);
                print_r(substr_replace($response['connections'][0]['departure'], "", 0, 10));
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