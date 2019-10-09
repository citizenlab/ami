<?php
require_once('db/db_connection.php');

function save_request($company, $hash, $lang){
	date_default_timezone_set('US/Eastern');
	$now = date('Y-m-d H:i:s', time());

	$db_conn = connect();
	$stmt = $db_conn->prepare("INSERT INTO stats (company, request_id, request_date, request_lang) VALUES (?, ?, ?, ?)");
	$stmt->bind_param("ssss", $company, $hash, $now, $lang);
	$stmt->execute();
	$inserted_rows = $stmt->affected_rows;
	$stmt->close();
	close($db_conn);
	if($inserted_rows == 1){
		return true;
	}
	else{
		// Already had this hash
		return false;
	}
}