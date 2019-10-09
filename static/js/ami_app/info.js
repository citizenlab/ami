amiApp.info_categories_form_controller = function(targetEl, nextButtonTargetEl, companyNameTargetEl, companyNameTargetEl2){
	var self = this;
	self.activeStage = "information";
	location.hash = "#info";

	// RESET TEMPLATE
	targetEl.innerHTML = "";
	nextButtonTargetEl.innerHTML = "";

	// Create next button
	var nextButtonEl = self.createFromTemplate("info_category_select_button_template", null)

	// Loop through the information categories associated with the
	// selected industry, and create checkboxes for them.
	for (var i = 0; i < self.request.industry.info_categories.length; i++) {
		// build checkbox element from template
		el = self.createFromTemplate("info_category_select_template", self.request.industry.info_categories[i]);
		// associate the checkbox with a particular info category id
		el.querySelector("input[type='checkbox']").value = self.request.industry.info_categories[i].id;

		// Another level loop, through the request object's info categories 
		// if they are set.
		// This is used to check/uncheck the checkboxes if the user has 
		// already completed this stage, to preserve their previous inputs
		if(typeof self.request['info_categories'] !== "undefined"){
			hasMatch = false;
			for (var j = 0; j < self.request['info_categories'].length; j++) {
				if(self.request['info_categories'][j].id === self.request.industry.info_categories[i].id){
					el.querySelector("input[type='checkbox']").checked = true;
					hasMatch = true;
				}
			}
			if(!hasMatch){
				el.querySelector("input[type='checkbox']").checked = false;
			}
		}
		// If a checkbox is checked or unchecked, we want to re-validate
		el.onclick = function(){
			self.info_categories_validate(nextButtonEl);
		}
		// add checkbox to DOM
		targetEl.appendChild(el);
	}

	// This is a messy bit of functions that add the company name to a few spots in the overall form.
	company_name_el = self.createFromTemplate("info_company_template", self.request.company);	
	companyNameTargetEl.innerHTML = "";
	companyNameTargetEl.appendChild(company_name_el);
	company_name_el2 = self.createFromTemplate("info_company_template", self.request.company);	
	companyNameTargetEl2.innerHTML = "";
	companyNameTargetEl2.appendChild(company_name_el2);

	// Assign the checkbox elements to a variable we can re use in different contexts (i.e. validations)
	self.info_categories_checkboxes = targetEl.querySelectorAll("input[type='checkbox']")

	// Wire up the next button to validate checkboxes, and if there are some checked items, assign them to the request
	nextButtonEl.onclick = function(){
		var selected_info_categories = self.info_categories_validate(self.info_categories_nextButtonEl);
		if(selected_info_categories.length > 0){
			// assign selected info categories to the request
			self.selectInfoCategories(selected_info_categories);
		}
	}

	// Wire up back button to go back one stage
	self.stages["information"].backEl.onclick = function(){
		if(self.stages["company"].enabled){
			self.showStage("company");
		}
	}
	
	// validate the checkboxes upon stage load in case of previous input.
	self.info_categories_validate(nextButtonEl);

	self.info_categories_nextButtonEl = nextButtonEl;
	nextButtonTargetEl.appendChild(nextButtonEl);

	// If a user clicks on the top nav element for the next stage, make sure to clean up this stage (i.e. interpret it as a next button click essentially)
	self.stages["identifiers"].navEl.addEventListener('click', amiApp.assignInfoCategories, true);
}

// This function checks to see if at least one checkbox is checked.
// If so, push the value of the checked info category to an array
// If the array has at least some items in it, we enable the next stage.
amiApp.info_categories_validate = function(nextButtonEl){
	var self = this;
	var selectedInfosCount = 0;
	var selected_info_categories = [];

	for (var i = 0; i < self.info_categories_checkboxes.length; i++) {
		// determine if it's checked
		if(self.info_categories_checkboxes[i].checked){
			selectedInfosCount++;
			// assign checked info category to array
			selected_info_categories.push(self.info_categories_checkboxes[i].value);
		}
	}
	// Enable / disable next stage based on completion of the checkboxes
	if(selectedInfosCount){
		self.enableStage("identifiers");
	}
	else{
		self.disableStage("identifiers");
	}
	// Enable / disable next button based on completion of the inputs
	if(selectedInfosCount){
		nextButtonEl.classList.remove("btn-disabled");
		nextButtonEl.classList.add("btn-primary");
	}
	else{
		nextButtonEl.classList.remove("btn-primary");
		nextButtonEl.classList.add("btn-disabled");
	}
	return selected_info_categories;
}

// Asssign completed info categories to master request object.
amiApp.assignInfoCategories = function(){
	var self = amiApp;
	var selected_info_categories = self.info_categories_validate(self.info_categories_nextButtonEl);
	if(selected_info_categories.length > 0){
		// assign selected info categires to request object
		self.selectInfoCategories(selected_info_categories);
	}
	// "this" here is the top level nav entry for the next stage, the identifiers stage. Once we click it once, we don't want to trigger it again (i.e. if the user clicks it from another stage. The functionality need only be active when on this current, info, stage)
	this.removeEventListener('click', amiApp.assignInfoCategories, true);
}

// Assign selected info categories to master request object.
amiApp.selectInfoCategories = function(selected_info_categories){
	var self = this;
	self.request.info_categories = [];
	for (var i = 0; i < self.request.industry.info_categories.length; i++) {
		info_cat = self.request.industry.info_categories[i];
		for (var j = 0; j < selected_info_categories.length; j++) {
			// reconcile checked input id with info category object, and assign the object to the request, not just the ID.
			if (selected_info_categories[j] == info_cat.id) {
				self.request.info_categories.push(info_cat);
			}
		}
	}
	// Move to next stage.
	self.enableStage("identifiers");
	self.showStage("identifiers");
}
