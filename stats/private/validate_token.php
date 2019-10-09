<?php
function validate_token(){
	// Set a one hour timeout for a token
	$TOKEN_TIMEOUT_SECONDS = 60*60*1;
	$DENIED = true;
	if(
		isset(
			$_SESSION['ami_stats_token']
		)
		&&
		isset(
			$_POST['ami_stats_token']
		)
	){
		$token_age = time() - $_SESSION['ami_stats_token_time'];
	}

	if(
		isset(
			$token_age
		)
		&&
		$token_age <= $TOKEN_TIMEOUT_SECONDS
		&&
		$_SESSION['ami_stats_token'] == $_POST['ami_stats_token']
	)
	{
		$DENIED = false;
	}

	if($DENIED == false){
		// Kill token so it's no longer useable
		unset($_SESSION['ami_stats_token']);
		unset($_SESSION['ami_stats_token_time']);
		return true;
	}
	else{
		return false;
	}
}