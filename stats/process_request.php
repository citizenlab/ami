<?php
session_start();
header('Content-Type: application/json');
require_once('private/validate_token.php');
require_once('private/validate_company.php');
require_once('private/validate_lang.php');
require_once('private/validate_hash.php');
require_once('private/save_request.php');

$valid_token = validate_token();
$valid_lang = validate_lang();
$valid_company = validate_company($valid_lang);
$valid_hash = validate_hash();

if(!$valid_token || !$valid_company || !$valid_hash || !$valid_lang ){
	$msg = "Request denied.";
	// Uncomment these to debug as needed.
	// if (!$valid_token) {
	// 	$msg .= " Invalid Token";
	// }
	// if (!$valid_company) {
	// 	$msg .= " Invalid Company";
	// }
	// if (!$valid_hash) {
	// 	$msg .= " Invalid Hash";
	// }
	// if (!$valid_lang) {
	// 	$msg .= " Invalid Lang"; 
	// }
	header('HTTP/1.0 403 Forbidden');
	$res = array(
		"msg" => $msg
	);
	print json_encode($res);
	die();
}
if(save_request($valid_company, $valid_hash, $valid_lang)){
	// Valid token and form data
	$res = array(
		"msg" => "Thank you for your request to ".$valid_company."!"
	);
	print json_encode($res);
	die();
}
else{
	$res = array(
		"msg" => "You already made this request before."
	);
	print json_encode($res);
	die();
}