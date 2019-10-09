// These functions convert the data in the data.js file into the AMI data structure for use by the app.
amiApp.getIndustry = function(industry_id){
	var industry = null;
	for (var i = 0; i < amiApp.dataSource.industries.length; i++) {
		if(amiApp.dataSource.industries[i].id === industry_id){
			industry = amiApp.dataSource.industries[i];
			return industry;
		}
		else{
			new Error("Industry with id " + industry_id + " not found.");
		}
	}
}
amiApp.getIndustryCompanies = function(industry){
	var companies = [];
	for (var i = 0; i < amiApp.dataSource.companies.length; i++) {
		if(amiApp.dataSource.companies[i].industry == industry.id){
			companies.push(amiApp.dataSource.companies[i]);
		}
	}
	return companies;
}
amiApp.getIndustryInfoCategories = function(industry){
	var info_categories = [];
	for (var i = 0; i < amiApp.dataSource.info_categories.length; i++) {
		for (var j = 0; j < amiApp.dataSource.info_categories[i].industries.length; j++) {
			if(amiApp.dataSource.info_categories[i].industries[j] == industry.id){
				info_categories.push(amiApp.dataSource.info_categories[i]);
			}
		}
	}
	return info_categories;
}
amiApp.getIndustryPersonalIdentifiers = function(industry){
	var personal_identifiers = [];
	for (var i = 0; i < amiApp.dataSource.personal_identifiers.length; i++) {
		for (var j = 0; j < amiApp.dataSource.personal_identifiers[i].industries.length; j++) {
			if(amiApp.dataSource.personal_identifiers[i].industries[j] == industry.id){
				personal_identifiers.push(amiApp.dataSource.personal_identifiers[i]);
			}
		}
	}
	return personal_identifiers;
}
amiApp.getData = function(url, callback){
 	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var myArr = JSON.parse(this.responseText);
			callback(myArr);
		}
	};
	xmlhttp.open("GET", url, true);
	xmlhttp.send();
}