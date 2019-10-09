window.onbeforeunload = function () {
  window.scrollTo(0, 0);
}
if(document.location.protocol === 'http:'){
	document.getElementById('securityWarning').classList.remove("dn");
}

var amiApp = {}
amiApp.industries = []
amiApp.request = {}

amiApp.initialize = function(){
	var self = this;
	self.templates = {}
	self.getTemplate("industry_select_template");
	self.getTemplate("company_select_template");
	self.getTemplate("info_category_select_template");
	self.getTemplate("info_category_select_button_template")
	self.getTemplate("personal_identifiers_template");
	self.getTemplate("personal_identifiers_button_template")
	self.getTemplate("request_date_template")
	self.getTemplate("request_industry_name_template")
	self.getTemplate("request_company_contact_template")
	self.getTemplate("request_information_category_template")
	self.getTemplate("request_personal_identifier_template")
	self.getTemplate("request_signature_template")
	self.getTemplate("request_email_button_template")
	self.getTemplate("request_gmail_button_template")
	self.getTemplate("request_pdf_button_template")
	self.getTemplate("request_company_address_template")
	self.getTemplate("request_company_email_template")
	self.getTemplate("info_company_template")
	self.getTemplate("identifiers_company_template")
	self.getTemplate("request_company_template")

	self.industries = self.dataSource.industries;
	for (var i = 0; i < self.industries.length; i++) {
		self.industries[i].companies = self.getIndustryCompanies(self.industries[i])
		self.industries[i].info_categories = self.getIndustryInfoCategories(self.industries[i]);
		self.industries[i].personal_identifiers = self.getIndustryPersonalIdentifiers(self.industries[i]);
	}
	self.stages = {
		"industry": {
			enabled: false,
			navEl: document.getElementById('nav_el_industry'), 
		},
		"company": {
			enabled: false,
			navEl: document.getElementById('nav_el_company'), 
			backEl: document.getElementById('back_el_company'),
			nextEl: document.getElementById('next_el_company')
		},
		"information": {
			enabled: false,
			navEl: document.getElementById('nav_el_information'), 
			backEl: document.getElementById('back_el_information'),
			nextEl: document.getElementById('next_el_information')
		},
		"identifiers": {
			enabled: false,
			navEl: document.getElementById('nav_el_identifiers'), 
			backEl: document.getElementById('back_el_identifiers'),
			nextEl: document.getElementById('next_el_identifiers')
		},
		"request": {
			enabled: false,
			navEl: document.getElementById('nav_el_request'), 
			backEl: document.getElementById('back_el_request')
		}
	}
	self.stageListController();
	self.disableStage("industry");
	self.enableStage("industry");
	self.showStage("industry");
}