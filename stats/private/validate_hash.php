<?php
function validate_hash(){
	$DENIED = true;
	// perform validation here
	if(
		isset(
			$_POST['ami_hmac']
		)
	)
	{
		// ensure its a proper hexadecimal string
		if(ctype_xdigit($_POST['ami_hmac']) && strlen($_POST['ami_hmac']) == 64){
			$sanitized_hash = $_POST['ami_hmac'];
			$DENIED = false;
		}
	}
	if($DENIED){
		return false;
	}
	else{
		return $sanitized_hash;
	}
}