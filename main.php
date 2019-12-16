 <?php

  session_start();
  session_regenerate_id(true);

  include('dateManager.php');
  include('weatherApi.php');
  include('userdao.php');
  include('commuteApi.php');

  if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
  }
  if($usermodel==null){
    header('Location: editView.php');
  }

  function weatherComposer($currentDay, $weather){
    if (date('l') == $currentDay) {
      return $weather[0]. " ". $weather[1];
    } else {
      return 'Weather is not yet known, wait until its ' . date('l');
    }
  }
  ?>

 <!DOCTYPE html>
 <html lang='en'>
 <head>
   <meta charset='UTF-8'>
   <meta name='viewport' content='width=device-width, initial-scale=1.0'>
   <meta http-equiv='X-UA-Compatible' content='ie=edge'>
   <link rel='stylesheet' href='style.css'>
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
          $response = getConnection($usermodel['start'], $usermodel['destination'], $usermodel['time']);
          print_r($response['connections'][0]['from']);
          print_r($response['connections'][0]['departure']);
          ?>

         </p>
       </li>
       <li>
         <h2>Dienstag</h2>
         <h3><?php echo $weekdays['Tuesday'] ?></h3>
         <p>
         <?php echo weatherComposer('Tuesday', $weather); ?>
         </p>
         <p>
           7:52 (10) Therwil -> Dornach
         </p>
       </li>

       <li>
         <h2>Mittwoch</h2>
         <h3><?php echo $weekdays['Wednesday'] ?></h3>
         <p>
         <?php echo weatherComposer('Wednesday', $weather); ?>
         </p>
       </li>
       <li>
         <h2>Donnerstag</h2>
         <h3><?php echo $weekdays['Thursday'] ?></h3>
         <p>
         <?php echo weatherComposer('Thursday', $weather); ?>
         </p>
       </li>
       <br>
       <li>
         <h2>Freitag</h2>
         <h3><?php echo $weekdays['Friday'] ?></h3>
         <p>
         <?php echo weatherComposer('Friday', $weather); ?>
         </p>
       </li>
       <li>
         <h2>Samstag</h2>
         <h3><?php echo $weekdays['Saturday'] ?></h3>
         <p>
         <?php echo weatherComposer('Saturday', $weather); ?>
         </p>
       </li>
       <li>
         <h2>Sonntag</h2>
         <h3><?php echo $weekdays['Sunday'] ?></h3>
         <p>
         <?php echo weatherComposer('Sunday', $weather); ?>
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