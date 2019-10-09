// the router watches the location.hash property and shows the appropriate stage.
// the showStage function and most of the stage logic is in stages.js

amiApp.router = {}

amiApp.router.handle = function(){
	var self = amiApp;
	console.log("hi");
	switch (location.hash) {
		case "#home":
		case "#":
		case "":
			if (self.activeStage !== "industry"){
				self.showStage("industry");
			}
		break;
		case "#org":
			if(self.stages["company"].enabled && self.activeStage !== "company"){
				self.showStage("company");
			}
		break;
		case "#info":
			if(self.stages["information"].enabled && self.activeStage !== "information"){
				self.showStage("information");
			}
		break;
		case "#id":
			if(self.stages["identifiers"].enabled && self.activeStage !== "identifiers"){
				self.showStage("identifiers");
			}
		break;
		case "#request":
			if(self.stages["request"].enabled && self.activeStage !== "request"){
				self.showStage("request");
			}
		break;
	}
}

window.onhashchange = amiApp.router.handle;