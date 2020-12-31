<?php

//todo: comment
$session_timeout = 1800; // 1800 Sek./60 Sek. = 30 Minuten
if (!isset($_SESSION['last_visit'])) {
  $_SESSION['last_visit'] = time();
  // Aktion der Session wird ausgeführt
}
if((time() - $_SESSION['last_visit']) > $session_timeout) {
  session_destroy();
  // Aktion der Session wird erneut ausgeführt
}
$_SESSION['last_visit'] = time();