// Logic that controls the activating/showing of particular stages in the
// AMI form, as well as enabling and disabling them, and controlling the
// top level nav bar.
// stages are referred to throughout the app, and operations taken elsewhere on the various stages trigger changes to stages being enabled/disabled/activated.

// Enables a given stage, and removes the disabled class from its top nav el
amiApp.enableStage = function(stage){
	var self = this;
	self.stages[stage].enabled = true;
	self.stages[stage].navEl.classList.remove('disabled');
}

// Disables a given stage, and add the disabled class from its top nav el
// Also do the same thing FOR ALL LATER STAGES based on the order in which the stages are defined in init.js' initialize() function, This way if company stage is disabled, info, identifiers, and request stage are also disabled.
amiApp.disableStage = function(stage_to_disable){
	var self = this;
	var disableStage = false;
	for (var stage in self.stages) {
    	if (self.stages.hasOwnProperty(stage)) {
    		if(stage == stage_to_disable){
    			console.log('starting to disable', stage);
    			disableStage = true;
    		}
    		if(disableStage){
    			console.log(stage)
    			self.stages[stage].enabled = false;
    			self.stages[stage].navEl.classList.add("disabled");
    		}
    	}
	}
}

// All the stuff that happens when a new stage is selected and shown (i.e. activated).
amiApp.showStage = function(stage){
	var self = this;
	stageEls = {
		"industry": document.getElementById('stage_industry'),
		"company": document.getElementById('stage_company'),
		"information": document.getElementById('stage_information'),
		"identifiers": document.getElementById('stage_identifiers'),
		"request": document.getElementById('stage_request')
	}
	// hide all stages
	hideOtherStages = function(){
		for (var stage in stageEls) {
	    	if (stageEls.hasOwnProperty(stage)) {
	    		stageEls[stage].classList.add("dn");
	    	}
	    }
	}
	// update the top level stage nav element classes to reflect which stage is active, which are past, and which are future.
	updateStageNav = function(activeStage){
		var stageIndex = 0;
		for (var stage in self.stages) {
	    	if (self.stages.hasOwnProperty(stage)) {
	    		stageIndex++;
	    		self.stages[stage].stageIndex = stageIndex;
	    		// remove active class from all stage navEls
	    		self.stages[stage].navEl.classList.remove("active");
	    	}
	    }
	    for (var stage in self.stages) {
	    	if (self.stages.hasOwnProperty(stage)) {

	    		if(self.stages[stage].stageIndex < self.stages[activeStage].stageIndex){
	    			// do stuff for EARLIER stages than the selected one
	    			// mark stage navel as previous
					self.stages[stage].navEl.classList.add("previous");
					self.stages[stage].navEl.classList.remove("future");
	    		}
	    		else if(self.stages[stage].stageIndex > self.stages[activeStage].stageIndex){
	    			// do stuff for LATER stages than the selected one
	    			// mark stage navel as future
					self.stages[stage].navEl.classList.remove("previous");
					self.stages[stage].navEl.classList.add("future");
	    		}
	    		else{
	    			// do stuff for THE CURRENT stage
	    			// mark as active
	    			self.stages[stage].navEl.classList.remove("previous");
					self.stages[stage].navEl.classList.remove("future");
					self.stages[stage].navEl.classList.add("active");
	    		}
	    	}
	    }
	}
	// show a particular stage
	showStage = function(stage){
		stageEls[stage].classList.remove("dn");
		updateStageNav(stage);
		// scroll to top
        document.body.scrollIntoView();
	}
	// hide all stages
	hideOtherStages();
	// show the selected stage
	showStage(stage);

	// in addition to unhiding the stagee's main container in the showStage function, we trigger the stage's correspdoning controller in order to execute all required javascript for that stage.
	// when the controllers are triggered, we pass DOM elements to them that will contain the outputs from the various templates used in that stage.
	switch(stage){
		case "industry":
			self.industry_list_controller(document.getElementById("industry"));
			break;
		case "company":
			self.company_list_controller(
				document.getElementById("company"),
				document.getElementById("custom_form"),
				document.getElementById("custom_toggle")
				);
			break;
		case "information":
			self.info_categories_form_controller(document.getElementById("info_categories"), document.getElementById("info_category_select_button"),
				document.getElementById("information_company_name"),
				document.getElementById("information_company_name2"));
			break;
		case "identifiers":
			self.personal_identifiers_form_controller(
				document.getElementById("personal_identifiers"), 
				document.getElementById("personal_identifiers_button"),
				document.getElementById("identifiers_company_name")
			);
			break;
		case "request":
			self.requestLetterController(
				{
					"company_name": document.getElementById('request_company_name'),
					"date": document.getElementById('request_date'),
					"contact": document.getElementById('request_company_contact'),
					"info_categories": document.getElementById('request_information_categories'),
					"personal_identifiers": document.getElementById('request_personal_identifiers'),
					"signature": document.getElementById('request_signature'),
					"address": document.getElementById('request_mailing_address'),
					"email": document.getElementById('request_email_address')
				}, 
				document.getElementById('request'), 
				document.getElementById('request_pdf_button'),
				document.getElementById('request_email_button'),
				document.getElementById('method_title_both'),
				document.getElementById('method_title_mail_only'),
				document.getElementById('method_title_email_only'),
				document.getElementById('mail_method'),
				document.getElementById('email_method'),
				document.getElementById('request_copy_button'),
				document.getElementById('request_gmail_button')
			);
			break;
	}
}
// wire up the stage  top level nav to show stages when the stage's navEl is clicked, but only if the stage is enabled.
amiApp.stageListController = function(){
	var self = this;
	for(var stage in self.stages){
		var exec = function(){
			var this_stage = stage;
			self.stages[stage].navEl.onclick = function(e){
				if(self.stages[this_stage].enabled){
					self.showStage(this_stage);
				}
			}
		}();
	}
}