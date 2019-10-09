amiApp.industry_list_controller = function(targetEl){
	var self = this;
	self.activeStage = "industry";
	location.hash = "#home";

	// RESET TEMPLATE
	targetEl.innerHTML = "";

	// Create elements representing each industry
	for (var i = 0; i < self.industries.length; i++) {
		el = self.createFromTemplate("industry_select_template", self.industries[i]);
		// If the user has gone back a stage, make sure to highlight the industry they had selected
		if(self.industries[i] === self.request.industry){
			el.classList.add("btn-media-select");
		}
		// Clicking an industry element will result in selecting that industry for the request.
		el.onclick = function(el){
			var id = this.querySelector('*[ami_template_value_container="id"]').innerHTML;
			this.classList.add("btn-media-select");
			self.enableStage("company");
			// assign industry to request object here
			self.selectIndustry(id);
		}
		targetEl.appendChild(el);
	}
}
amiApp.selectIndustry = function(industry_id){
	var self = this;
	for (var i = 0; i < self.industries.length; i++) {
		// Reconcile the industry ID with the full industry object that's part of the AMI data structure, and assign that industry object to the request.
		if(self.industries[i].id === industry_id){
			if(self.request.industry && industry_id !== self.request.industry.id){
				// Since the industry has changed, we have to disable later stages because the user must go through the form in order.
				self.disableStage("information");
			}
			self.request.industry = self.industries[i];
			// delete the selected company, since the industry has changed
			delete(self.request.company);
			// Move to next stage
			self.showStage("company")
			return self.request.industry;
		}
	}
	
	new Error("Industry not found");
}