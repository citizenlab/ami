amiApp.personal_identifiers_form_controller = function(targetEl, buttonTargetEl, companyNameTargetEl){
	var self = this;
	self.activeStage = "identifiers";
	location.hash = "#id";

	// RESET TEMPLATE
	targetEl.innerHTML = "";
	buttonTargetEl.innerHTML = "";

	// Create next button
	var nextButtonEl = self.createFromTemplate("personal_identifiers_button_template", null)
	self.personal_identifiers_nextButtonEl = nextButtonEl;

	// build out the form containing inputs for the required personal identifiers used in the request letter.
	for (var i = 0; i < self.request.industry.personal_identifiers.length; i++) {
		el = self.createFromTemplate("personal_identifiers_template", self.request.industry.personal_identifiers[i]);
		// Check the personal identifer object and see if there are options associated with it. If there are not, we assume a regular text input. Otherwise we create a select element with options.
		if(!Array.isArray(self.request.industry.personal_identifiers[i].options)){
			el.querySelector("input").name = self.request.industry.	personal_identifiers[i].id
			el.querySelector("input").setAttribute('desc', self.request.industry.personal_identifiers[i].name);
		}
		else{
			// Create select element
			newel = document.createElement("select");
			newel.classList.add("db");
			newel.setAttribute("name", self.request.industry.personal_identifiers[i].id);
			newel.setAttribute('desc', self.request.industry.personal_identifiers[i].name);

			// Loop through options associated with the identifer and add them to the select element.
			for (var j = 0; j < self.request.industry.personal_identifiers[i].options.length; j++) {
					option = document.createElement("option")
					option.value = self.request.industry.personal_identifiers[i].options[j].id;
					option.text = self.request.industry.personal_identifiers[i].options[j].name;
					newel.appendChild(option);
			}

			// Replace input (the element based on the template) with this select element. This is a hacky override.
			el.querySelector("input").outerHTML = newel.outerHTML;
		}

		// Add values to the inputs if the user has already completed this stage. Keep in mind we are still in a huge for loop
		if(typeof self.request['personal_identifiers'] !== "undefined"){
			// Check if there are identifiers associated with the request object
			for (var j = 0; j < self.request['personal_identifiers'].length; j++) {
				// Match identifier by ID
				if(self.request['personal_identifiers'][j].id === self.request.industry.personal_identifiers[i].id){
					if(!Array.isArray(self.request.industry.personal_identifiers[i].options)){
						// add value to input if there's a match
						el.querySelector("input").value = self.request['personal_identifiers'][j].value;
					}
					else{
						// select option if there's a match
						el.querySelector("select").value = self.request['personal_identifiers'][j].value;
					}
				}
			}
		}
		// Any time an input changes value, re-validate the form
		el.oninput = function(){
			self.personal_identifiers_validate(nextButtonEl);
		}
		targetEl.appendChild(el);
	}

	// Put the company name into the template element
	company_name_el = self.createFromTemplate("identifiers_company_template", self.request.company);	
	companyNameTargetEl.innerHTML = "";
	companyNameTargetEl.appendChild(company_name_el);

	// Assign the genereated input and select elements to a variable
	// for use in the validation functions
	self.personal_identifiers_inputs = targetEl.querySelectorAll("input, select");

	// Validate identifiers immediately once the stage is active,
	// since the stage could be accessed by hitting the back button
	self.personal_identifiers_validate(nextButtonEl);

	// Once the next button is clicked, validate the inputs.
	nextButtonEl.onclick = function(){
		completed_identifiers = self.personal_identifiers_validate(nextButtonEl);
		// If at least one identifier passes validation, we can check for the stats opt out and move on
		if(completed_identifiers.length > 0){
			if(typeof amiApp.stats !== "undefined" && typeof amiApp.stats.token !== "undefined"){
				self.assignStatsOptOut();
			}
			self.assignPersonalIdentifiers(completed_identifiers);
		}
	}
	// Set up back button functionality
	self.stages["identifiers"].backEl.onclick = function(){
		if(self.stages["information"].enabled){
			self.showStage("information");
		}
	}
	buttonTargetEl.appendChild(nextButtonEl);

	if(typeof amiApp.stats !== "undefined" && typeof amiApp.stats.token !== "undefined"){
		// set up opt-out checkbox to send stats
		var optout_container = document.getElementById("optout_container");
		var optout = document.getElementById("optout");
		optout_container.classList.remove("dn");
		if(amiApp.stats.optOut){
			optout.checked = false;
		}
		else{
			optout.checked = true;
		}
	}

	// If a user clicks on the top nav element for the next stage, make sure to clean up this stage (i.e. interpret it as a next button click essentially)
	self.stages["request"].navEl.addEventListener('click', amiApp.resolveIdentifierStage, true);
}

// This function checks to see if there's a value in each identifier input
// field and if so, push the value and the id of that identifeir to an array
// If the array has at least some items in it, we enable the next stage.
amiApp.personal_identifiers_validate = function(nextButtonEl){
	var self = this;
	var completedInputsCount = 0;
	var completed_identifiers = [];
	
	var inputs = self.personal_identifiers_inputs;

	// Check input values
	for (var i = 0; i < inputs.length; i++) {
		if(inputs[i].value !== ""){
			completedInputsCount++;
		}
		// Push completed input values to array
		if(inputs[i].value){
			completed_identifiers.push({
				id: inputs[i].getAttribute('name'),
				name: inputs[i].getAttribute("desc"),
				value: inputs[i].value,
			});
		}
	}
	// Enable / disable next stage based on completion of the inputs
	if(completedInputsCount > 0){
		self.enableStage("request");
	}
	else{
		self.disableStage("request");
	}
	// Enable / disable next button based on completion of the inputs
	if(completedInputsCount > 0){
		nextButtonEl.classList.remove("btn-disabled");
		nextButtonEl.classList.add("btn-primary");
	}
	else{
		nextButtonEl.classList.remove("btn-primary");
		nextButtonEl.classList.add("btn-disabled");
	}
	return completed_identifiers;
}

// Assign completed personal identifers to master request object.
amiApp.assignPersonalIdentifiers = function(completed_identifiers){
	var self = this;
	self.request.personal_identifiers = [];
	self.request.personal_identifiers = completed_identifiers;
	self.showStage("request");
}

amiApp.resolveIdentifierStage = function(){
	var self = amiApp;
	// validate identifers
	var completed_identifiers = self.personal_identifiers_validate(self.info_categories_nextButtonEl);
	if(completed_identifiers.length > 0){
		// assign identifers to request object
		if(typeof amiApp.stats !== "undefined" && typeof amiApp.stats.token !== "undefined"){
			self.assignStatsOptOut();
		}
		self.assignPersonalIdentifiers(completed_identifiers);
	}
	// "this" here is the top level nav entry for the next stage, the request stage. Once we click it once, we don't want to trigger it again (i.e. if the user clicks it from another stage. The functionality need only be active when on this current, identifier, stage)
	this.removeEventListener('click', amiApp.resolveIdentifierStage, true);
}
// based on checkbox value, assign opt out status to requester
amiApp.assignStatsOptOut = function(){
	var optout = document.getElementById("optout");
	if(optout.checked){
		amiApp.stats.optOut = false;
	}
	else{
		amiApp.stats.optOut = true;
	}
	console.log("OPPT", amiApp.stats.optOut)
}