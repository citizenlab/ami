// Here be nasty home-brewed template system.
amiApp.createFromTemplate = function(template_id, data){
	var self = this;
	var template = {};
	template.el = self.getTemplate(template_id);
	template.valueHolders = self.getTemplateValueHolders(template.el);
	for (var property in template.valueHolders) {
	    if (template.valueHolders.hasOwnProperty(property)) {
	        if(data.hasOwnProperty(property)){
	        	template.valueHolders[property].innerHTML = data[property];
	        }
	    }
	}
	template.imageHolders = self.getTemplateImageHolders(template.el);
	for (var property in template.imageHolders) {
	    if (template.imageHolders.hasOwnProperty(property)) {
	        if(data.hasOwnProperty(property)){
	        	template.imageHolders[property].setAttribute('src', data[property]);
	        }
	    }
	}
	template.conditionalValueHolders = self.getTemplateConditionalValueHolders(template.el);
	for (var property in template.conditionalValueHolders) {
	    if (template.conditionalValueHolders.hasOwnProperty(property)) {
	    	// console.log(data[property], typeof data[property] !== "undefined");
	    	template.valueHolders[property] = template.conditionalValueHolders[property];
	        if(data.hasOwnProperty(property) && typeof data[property] !== "undefined" && data[property] !== false){
		        	template.valueHolders[property].innerHTML = data[property];
        	}
        	else{
        		template.valueHolders[property].innerHTML = "";
        	}
	    }
	}
	return template.el;
}
amiApp.getTemplate = function(templateid){
	var self = this;

	if(!self.templates.hasOwnProperty(templateid)){
		var template = document.querySelector('*[ami_template_id="'+templateid+'"]');
		self.templates[templateid] = template.outerHTML;
		template.outerHTML = "";
	}
	var el = document.createElement('div');
	el.innerHTML = self.templates[templateid];
	el = el.firstChild;
	return el;
}
amiApp.getTemplateValueHolders = function(template){
	var valueHolderEls = template.querySelectorAll('*[ami_template_value_container]');
	var valueHolders = {};
	for (var i = 0; i < valueHolderEls.length; i++) {
		key = valueHolderEls[i].getAttribute('ami_template_value_container');
		valueHolders[key] = valueHolderEls[i];
	}
	return valueHolders;
}
amiApp.getTemplateImageHolders = function(template){
	var imageHolderEls = template.querySelectorAll('*[ami_template_image_container]');
	var imageHolders = {};
	for (var i = 0; i < imageHolderEls.length; i++) {
		key = imageHolderEls[i].getAttribute('ami_template_image_container');
		imageHolders[key] = imageHolderEls[i];
	}
	return imageHolders;
}
amiApp.getTemplateConditionalValueHolders = function(template){
	var valueHolderEls = template.querySelectorAll('*[ami_template_value_container_conditional]');
	var valueHolders = {};
	for (var i = 0; i < valueHolderEls.length; i++) {
		key = valueHolderEls[i].getAttribute('ami_template_value_container_conditional');
		valueHolders[key] = valueHolderEls[i];
	}
	return valueHolders;
}