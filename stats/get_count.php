<?php
require_once('private/db/db_connection.php');
$db_conn = connect();
$result = $db_conn->query("SELECT count(*) as count from stats;");
$value = $result->fetch_object();
print $value->count;
close($db_conn);
?>
