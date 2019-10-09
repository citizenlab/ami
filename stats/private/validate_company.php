<?php
function validate_company($lang){
	$DENIED = true;
	// perform validation here
	if(
		isset(
			$_POST['ami_company']
		)
	)
	{
		// Ensure company is present in master data list, depending on language
		switch ($lang) {
			case 'fr':
				$strJsonFileContents = file_get_contents("../static/data/fr.json");
				break;
			
			default:
				$strJsonFileContents = file_get_contents("../static/data/en.json");
				break;
		}
		
		if($strJsonFileContents != null){
			$AMI_DATA = json_decode($strJsonFileContents, true);
		}
		if(isset($AMI_DATA) && $AMI_DATA != null && isset($AMI_DATA['companies'])){
			$companies = [];
			for ($i=0; $i < count($AMI_DATA['companies']); $i++) { 
				$companies[] = $AMI_DATA['companies'][$i]['id'];
			}
		}
		if(isset($companies) && count($companies) > 0){
			if(in_array($_POST['ami_company'], $companies)){
				$company_index = array_search($_POST['ami_company'], $companies);
				$sanitized_company = $companies[$company_index];
				$DENIED = false;
			}
		}
	}
	if($DENIED){
		return false;
	}
	else{
		return $sanitized_company;
	}
}