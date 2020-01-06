<?php
function getConnection($start, $destination, $time)
{
    //an API is being called where with the parameters $start, $destination and $time a early connection is being sorted out
    if (isset($start, $destination, $time) && $start != "" && $destination != "") {
        $response = file_get_contents('http://fahrplan.search.ch/api/route.json?from=' . urlencode($start) . '&to=' . urlencode($destination) . '&time=' . urlencode(substr_replace($time, "", 5, 3)) . '&time_type=arrival');
        //the response is being json decoded and send back to whoever called the function
        $response = json_decode($response, true);
        return $response;
    }
}
