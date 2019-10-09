<?php
DEFINE('DB_USERNAME', 'root');
DEFINE('DB_PASSWORD', 'root');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_DATABASE', 'ami_stats');

function connect(){
	$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

	if (mysqli_connect_error()) {
		die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
	}
	return $mysqli;
}
function close($mysqli){
	$mysqli->close();
}
function install($mysqli){
	$sql_statement = file_get_contents("install.sql");
	if ($mysqli->query($sql_statement) == TRUE) {
    	print("DB installation successful\n");
	}
}
// $db_conn = connect();
// install($db_conn);
// close($db_conn);
