<?php
// Connecting, selecting database
require("config/connectionDB.php");

// Performing SQL query
$query = 'SELECT * FROM users';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());
// Printing results in HTML
$data = array();
while ($row = pg_fetch_assoc($result)) {
    array_push($data, array(
        'users_id' => $row['users_id'],
        'fb_users_id' => $row['fb_users_id']
    ));
}
$json = json_encode($data);
echo $json;
// Free resultset
pg_free_result($result);
// Closing connection
pg_close($dbconn);
?>
