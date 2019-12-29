<?php
function getConnection($start, $destination, $time)
{
    if (isset($start, $destination, $time) && $start != "" && $destination != "") {
        $response = file_get_contents('http://fahrplan.search.ch/api/route.json?from=' . urlencode($start) . '&to=' . urlencode($destination) . '&time=' . urlencode(substr_replace($time, "", 5, 3)) . '&time_type=arrival');
        $response = json_decode($response, true);
            return $response;
        
    }
}
