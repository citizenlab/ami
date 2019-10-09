amiApp.requestLetterController = function(
	requestTargetEls, 
	requestEl, 
	pdfButtonTargetEl, 
	emailButtonTargetEl, 
	method_title_bothEl,
	method_title_mail_onlyEl,
	method_title_email_onlyEl,
	mail_methodEl,
	email_methodEl,
	request_copy_button,
	gmailButtonTargetEl
){
	var data;
	var self = this;
	self.activeStage = "request";
	location.hash = "#requestLetter";

	// The request stage is much more complicated than the others, due to
	// the number of different components. For this reason, we loop
	// through target elements for each of those components, and then
	// in the "switch" statement, match them to templates and create
	// the templates based on the appropirate request data.
	for (var property in requestTargetEls) {
	    if (requestTargetEls.hasOwnProperty(property)) {
	    	switch(property){
	    		case "company_name":
	    			// add company name to stage heading
	    			el = self.createFromTemplate("request_company_template", self.request.company);	
					requestTargetEls[property].innerHTML = "";
	    			requestTargetEls[property].appendChild(el);
	    			break;
	    		case "date":
	    			// add date to request letter
	    			el = self.createFromTemplate("request_date_template", {
	    				date: new Date().toDateString(),
	    			});	
					requestTargetEls[property].innerHTML = "";
	    			requestTargetEls[property].appendChild(el);
	    			break;
	    		case "contact":
	 				// Add the company contact information to the request letter
	    			el = self.createFromTemplate("request_company_contact_template", self.request.company.contact);
	    			requestTargetEls[property].innerHTML = "";
	    			requestTargetEls[property].appendChild(el);
	    			break;
	    		case "info_categories":
	    			// Add the selected info categories to the request letter
	    			requestTargetEls[property].innerHTML = "";
	    			for (var i = 0; i < self.request.info_categories.length; i++) {
	    				el = self.createFromTemplate("request_information_category_template", self.request.info_categories[i]);
	    				requestTargetEls[property].appendChild(el);
	    			}
	    			break;
	    		case "personal_identifiers":
	    			// Add the completed personal identifiers to the request letter
	    			requestTargetEls[property].innerHTML = "";
	    			for (var i = 0; i < self.request.personal_identifiers.length; i++) {
	    				console.log(self.request.personal_identifiers[i])
	    				el = self.createFromTemplate("request_personal_identifier_template", self.request.personal_identifiers[i]);
	    				requestTargetEls[property].appendChild(el);
	    			}
	    			break;
	    		case "signature":
	    			requestTargetEls[property].innerHTML = "";
	    			// Add the first name and last name from the completed personal identifiers (if available) to the request letter
	    			signature_components = ["firstname", "lastname"];
	    			signature_data = {};
	    			for (var i = 0; i < self.request.personal_identifiers.length; i++) {
	    				if(signature_components.indexOf(self.request.personal_identifiers[i].id) >= 0){
	    					signature_data[self.request.personal_identifiers[i].id] = self.request.personal_identifiers[i].value;
	    				}
	    			}
	    			el = self.createFromTemplate("request_signature_template", signature_data);
	    			requestTargetEls[property].appendChild(el);
	    			break;
	    		case "address":
	    			// Create instructinon area for sending request letter
	    			// via postal mail
	    			el = self.createFromTemplate("request_company_address_template", self.request.company.contact);
	    			requestTargetEls[property].innerHTML = "";
	    			requestTargetEls[property].appendChild(el);
	    			break;
	    		case "email":
	    			// Create instructinon area for sending request letter
	    			// via email
	    			el = self.createFromTemplate("request_company_email_template", self.request.company.contact);
	    			requestTargetEls[property].innerHTML = "";
	    			requestTargetEls[property].appendChild(el);
	    			break;
	    	}
	    }
	    
	    // Display letter generating tools based on company contact method booleans
	    if(self.request.company.contact.has_email && self.request.company.contact.has_mail){
	    	// Display both postal and email options
	    	method_title_bothEl.classList.remove('dn');
	    	method_title_mail_onlyEl.classList.add('dn');
			method_title_email_onlyEl.classList.add('dn');
	    	mail_methodEl.classList.remove("dn");
	    	email_methodEl.classList.remove("dn");
	    }
	    else if (self.request.company.contact.has_email){
	    	// display only email option
	    	method_title_bothEl.classList.add('dn');
	    	method_title_mail_onlyEl.classList.add('dn');
			method_title_email_onlyEl.classList.remove('dn');
	    	mail_methodEl.classList.add("dn");
	    	email_methodEl.classList.remove("dn");
	    }
	    else if (self.request.company.contact.has_mail){
	    	// display only postal mail option
	    	method_title_bothEl.classList.add('dn');
	    	method_title_mail_onlyEl.classList.remove('dn');
			method_title_email_onlyEl.classList.add('dn');
	    	mail_methodEl.classList.remove("dn");
	    	email_methodEl.classList.add("dn");
	    }
	    else {
	    	method_title_bothEl.classList.add('dn');
	    	method_title_mail_onlyEl.classList.add('dn');
			method_title_email_onlyEl.classList.add('dn');
	    	mail_methodEl.classList.add("dn");
	    	email_methodEl.classList.add("dn");
	    }
	}

	// Create the PDF Generating button 
	pdfButtonTargetEl.innerHTML = "";
	var pdfButtonEl = self.createFromTemplate("request_pdf_button_template", null)
	// Wire up the button so it creates a PDF when clicked
	pdfButtonEl.onclick = function(){
		amiApp.makePDF(requestEl, "letter");
	}
	// Add button to the DOM
	pdfButtonTargetEl.appendChild(pdfButtonEl);

	// Create email and gmail buttons
	emailButtonTargetEl.innerHTML = "";
	gmailButtonTargetEl.innerHTML = "";
	var emailButtonEl = self.createFromTemplate("request_email_button_template", null)
	var gmailButtonEl = self.createFromTemplate("request_gmail_button_template", null)

	// Add email links to each button
	emailButtonEl.setAttribute("href", amiApp.buildEmail(amiApp.dataSource.request_subject_line, requestEl, "mailto"));
	gmailButtonEl.setAttribute("href", amiApp.buildEmail(amiApp.dataSource.request_subject_line, requestEl, "gmail"));

	// add email and gmail buttons to DOM
	emailButtonTargetEl.appendChild(emailButtonEl);
	gmailButtonTargetEl.appendChild(gmailButtonEl);

	// Wire up the back button
	self.stages["request"].backEl.onclick = function(){
		if(self.stages["identifiers"].enabled){
			self.showStage("identifiers");
		}
	}

	// wire up the button that lets you copy the request's text.
	request_copy_button.onclick = function(){
		var lastChar = request_copy_button.innerHTML[request_copy_button.innerHTML.length -1]
		if(lastChar !== "✓"){
			request_copy_button.innerHTML += " ✓"; 
		}
		copyText(document.getElementById("request"));
	}

	// If the statistics functioality is enabled, and if the user has not opted-out, generate an HMAC of the request and send it to the server.
	if(typeof amiApp.stats !== "undefined" && typeof amiApp.stats.token !== "undefined" && !amiApp.stats.optOut){
		console.log("ass")
		// Wait until the crypto key is available
		amiApp.ami_key_promise.then(function(ami_key){
			var msg = "";
			msg = msg + amiApp.request.company.name;

			// creat the HMAC based on the company name and the private key
			amiApp.hmacSha256(ami_key, msg).then(function(hmac_sig){
				// populate the hidden stats form with the HMAC value, the CSRF token, and the company id.
				var companyInput = document.getElementById("request_form_company");
				var hmacInput = document.getElementById("request_form_hmac");
				var tokenInput = document.getElementById("request_form_token");

				companyInput.setAttribute('value', amiApp.request.company.id);
				hmacInput.setAttribute('value', hmac_sig);
				tokenInput.setAttribute('value', amiApp.stats.token);

				// submit the form (function is in the stats_helpers.js file)
				makePostRequest(amiApp.stats.postURL);
			});
		});
	}
}