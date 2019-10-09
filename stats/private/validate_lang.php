<?php
function validate_lang(){
	$DENIED = true;
	// perform validation here
	if(
		isset(
			$_POST['ami_lang']
		)
	)
	{
		// Add supported language options here
		if($_POST['ami_lang'] == "en"){
			$valid_lang = "en";
			$DENIED = false;
		}
		elseif ($_POST['ami_lang'] == "fr"){
			$valid_lang = "fr";
			$DENIED = false;
		}
	}
	if($DENIED){
		return false;
	}
	else{
		return $valid_lang;
	}
}