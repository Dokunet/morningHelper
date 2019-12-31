 <?php

  session_start();
  session_regenerate_id(true);

  include('../Business/dateManager.php');
  include('../Business/clothes.php');
  include('../ApiCalls/weatherApi.php');
  include('../Persistence/userdao.php');
  include('../ApiCalls/commuteApi.php');

  if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
  }
  if ($usermodel == null) {
    header('Location: editView.php');
  }

  function weatherComposer($currentDay, $weather)
  {
    if (date('l') == $currentDay) {
      return $weather[0] . " " . $weather[1]. "<br> <br>". getClothingRecommendation($weather[1]);
    } else {
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
   <div id="list5">
     <ul class="tilesWrap">
       <li>
         <h2>Montag</h2>
         <h3><?php echo $weekdays['Monday'] ?></h3>
         <p>
           <?php echo weatherComposer('Monday', $weather);
            echo "<br>";
            echo "<br>";
            $response = getConnection($usermodel[0]['start'], $usermodel[0]['destination'], $usermodel[0]['time']);
            print_r($response['connections'][0]['from']);
            print_r(substr_replace($response['connections'][0]['departure'], "", 0, 10));
            ?>

         </p>
       </li>
       <li>
         <h2>Dienstag</h2>
         <h3><?php echo $weekdays['Tuesday'] ?></h3>
         <p>
           <?php $weather = weatherComposer('Tuesday', $weather);
            echo $weather;
            echo "<br>";
            echo "<br>";
            $response = getConnection($usermodel[1]['start'], $usermodel[1]['destination'], $usermodel[1]['time']);
            print_r($response['connections'][0]['from']);
            print_r(substr_replace($response['connections'][0]['departure'], "", 0, 10));
            ?>
         </p>
       </li>

       <li>
         <h2>Mittwoch</h2>
         <h3><?php echo $weekdays['Wednesday'] ?></h3>
         <p>
           <?php echo weatherComposer('Wednesday', $weather);
            echo "<br>";
            echo "<br>";
            $response = getConnection($usermodel[2]['start'], $usermodel[2]['destination'], $usermodel[2]['time']);
            print_r($response['connections'][0]['from']);
            print_r(substr_replace($response['connections'][0]['departure'], "", 0, 10));
            ?>
         </p>
       </li>
       <li>
         <h2>Donnerstag</h2>
         <h3><?php echo $weekdays['Thursday'] ?></h3>
         <p>
           <?php echo weatherComposer('Thursday', $weather);
            echo "<br>";
            echo "<br>";
            $response = getConnection($usermodel[3]['start'], $usermodel[3]['destination'], $usermodel[3]['time']);
            print_r($response['connections'][0]['from']);
            print_r(substr_replace($response['connections'][0]['departure'], "", 0, 10));
            ?>
         </p>
       </li>
       <br>
       <li>
         <h2>Freitag</h2>
         <h3><?php echo $weekdays['Friday'] ?></h3>
         <p>
           <?php echo weatherComposer('Friday', $weather);
            echo "<br>";
            echo "<br>";
            $response = getConnection($usermodel[4]['start'], $usermodel[4]['destination'], $usermodel[4]['time']);
            print_r($response['connections'][0]['from']);
            print_r(substr_replace($response['connections'][0]['departure'], "", 0, 10));
            ?>
         </p>
       </li>
       <li>
         <h2>Samstag</h2>
         <h3><?php echo $weekdays['Saturday'] ?></h3>
         <p>
           <?php echo weatherComposer('Saturday', $weather);
            echo "<br>";
            echo "<br>";
            if (isset($usermodel[5])) {
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
           <?php echo weatherComposer('Sunday', $weather);
            echo "<br>";
            echo "<br>";
            if (isset($usermodel[6])) {
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
         Bearbeiten
       </div>
     </a>

   </div>
 </body>

 </html>
