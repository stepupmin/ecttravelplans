<?php
// Connecting, selecting database
require("config/connectionDB.php");
// Performing SQL query
$query = 'SELECT * FROM LOCATIONPLANS;';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
// Printing results in HTML
$data = array();
while ($row = pg_fetch_assoc($result)) {
    array_push($data, array(
        'location_id' => $row['location_id'],
        'plans_id' => $row['plans_id'],
        'location_name' => $row['location_name'],
        'spend_time' => $row['spend_time'],
        'time_open' => $row['time_open'],
        'time_close' => $row['time_close'],
        'lat' => $row['lat'],
        'lng' => $row['lng']
    ));
}
$json = json_encode($data);
echo $json;
// Free resultset
pg_free_result($result);
// Closing connection
pg_close($dbconn);
?>
