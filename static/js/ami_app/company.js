amiApp.company_list_controller = function(targetEl, customEl, customBtnEl){
	var self = this;
	self.activeStage = "company";
	location.hash = "#org";
	targetEl.innerHTML = "";

	// Create elements representing each company belonging to the selected industry.
	for (var i = 0; i < self.request.industry.companies.length; i++) {
		el = self.createFromTemplate("company_select_template", self.request.industry.companies[i]);
		// If the user has gone back a stage, make sure to highlight the company they had selected
		if(self.request.industry.companies[i] === self.request.company){
			el.classList.add("btn-media-select");
		}
		// Clicking a company element will result in selecting that company for the request.
		el.onclick = function(){
			var id = this.querySelector('*[ami_template_value_container="id"]').innerHTML;
			self.selectCompany(id);
		}
		targetEl.appendChild(el);
	}
	// Toggle to display the custom company form
	customBtnEl.onclick = function(){
		customEl.classList.toggle("dn");
	}
	// monitor custom inputs
	self.customInputs = customEl.querySelectorAll('input');
	for (var i = 0; i < self.customInputs.length; i++) {
		self.customInputs[i].oninput = function(){
			self.customCompanyValidate();
		}
	}

	// Back button
	self.stages["company"].backEl.onclick = function(){
		if(self.stages["industry"].enabled){
			self.showStage("industry");
		}
	}
	// If a company has been previously selected, ensure that the next button is active, otherwise disable it.
	if(self.request.hasOwnProperty("company")){
		self.stages["company"].nextEl.classList.remove("btn-disabled");
		self.stages["company"].nextEl.classList.add("btn-primary");
	}
	else{
		self.stages["company"].nextEl.classList.remove("btn-primary");
		self.stages["company"].nextEl.classList.add("btn-disabled");
	}
	// If the next button is active, you can use it to move to the next stage.
	self.stages["company"].nextEl.onclick = function(){
		var validation_results = self.customCompanyValidate(self.customInputs);
		if(validation_results !== false){
			self.selectCustomCompany(customEl, validation_results);
		}
		else if(self.stages["information"].enabled){
			self.showStage("information");
		}
	}
}

amiApp.selectCompany = function(company_id){
	var self = this;
	for (var i = 0; i < self.request.industry.companies.length; i++) {
		// Reconcile the company ID with the full company object that's part of the AMI request data structure, and assign that company object to the request.
		if(self.request.industry.companies[i].id === company_id){
			self.request.company = self.request.industry.companies[i];
			// Enable the next stage and move the user to it.
			self.enableStage("information");
			self.showStage("information");
			self.clearCustomInputs();
			return self.request.company;
		}
	}
	
	new Error("Company not found");
}

amiApp.selectCustomCompany = function(customEl, validation_results){
	var self = this;

	var company = {
		"name": customEl.querySelector('input[name="custom_name"]').value,
		"id": "custom",
		"logo": null,
		"contact": {
			"title": customEl.querySelector('input[name="custom_title"]').value,
			"has_mail": validation_results.has_mail,
			"has_email": validation_results.has_email,
			"address1": customEl.querySelector('input[name="custom_address_1"]').value,
			"address2": customEl.querySelector('input[name="custom_address_2"]').value,
			"city": customEl.querySelector('input[name="custom_city"]').value,
			"region": customEl.querySelector('input[name="custom_province"]').value,
			"postalcode": customEl.querySelector('input[name="custom_postal_code"]').value,
			"country": customEl.querySelector('input[name="custom_country"]').value,
			"email": customEl.querySelector('input[name="custom_email"]').value
		},
		"industry": "telco"
	}
	
	self.request.company = company;
	// Enable the next stage and move the user to it.
	self.enableStage("information");
	self.showStage("information");

}

amiApp.clearCustomInputs = function(){
	var self = this;
	for (var i = 0; i < self.customInputs.length; i++) {
		self.customInputs[i].value = "";
	}
}

amiApp.customCompanyValidate = function(){
	var self = this;
	var completedInputs = 0;
	var completedInputsNeeded = 0;
	var has_email = false;
	var has_mail = false;

	for (var i = 0; i < self.customInputs.length; i++) {
		name = self.customInputs[i].getAttribute("name");
		if(name !== "custom_address_2" && name !== "custom_country" && name !== "custom_email"){
			completedInputsNeeded++;
			if(self.customInputs[i].value && self.customInputs[i].value !== ""){
				completedInputs++;
			}
		}
		if(name == "custom_email" && self.customInputs[i].value && self.customInputs[i].value !== ""){
			has_email = true;
		}
	}

	if(completedInputs >= completedInputsNeeded || has_email){
		if(completedInputs >= completedInputsNeeded){
			has_mail = true;
		}
		self.stages["company"].nextEl.classList.remove("btn-disabled");
		self.stages["company"].nextEl.classList.add("btn-primary");
		return {
			has_mail: has_mail,
			has_email: has_email
		};
	}
	else{
		return false;
	}
}