<?php
// the current Date is being received and formatted
$current_date = date('Y-m-d');
$date = strtotime($current_date);
$weekdays = [];
//every date and day is being saved in the $weekdays to later being set to frontend
for ($i = 0; $i < 7; $i++) {
    $weekdays += [date('l', strtotime("+$i day", $date)) => date('d-m-Y', strtotime("+$i day", $date))];
}
