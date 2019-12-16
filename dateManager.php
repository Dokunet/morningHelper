<?php
$current_date = date('Y-m-d');
$date = strtotime($current_date); 
$weekdays = [];
for ($i=0; $i<7; $i++){
    $weekdays += [date('l', strtotime("+$i day",$date)) =>date('d-m-Y', strtotime("+$i day",$date))];
}

