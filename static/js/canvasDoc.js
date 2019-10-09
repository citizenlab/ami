function CanvasPage(pageSize, margins, dpiFactor){
	var page = {}
	page.canvas = document.createElement('canvas');
	page.ctx = page.canvas.getContext('2d');
	/// set canvas size representing 300 DPI
	page.canvas.width = pageSize.width;
	page.canvas.height = pageSize.height;

	/// scale all content to fit the 96 DPI display (DPI doesn't really matter here)
	page.canvas.style.width = pageSize.width/dpiFactor/4 + 'px';
	page.canvas.style.height = pageSize.height/dpiFactor/4 + 'px';
	page.canvas.style.margin = 10 + 'px';
	page.canvas.style.border = "1px solid black";

	page.paintPosition = {
		x: margins.left,
		y: margins.top
	}
 
	page.maxPaintPosition = {
		x:  pageSize.width - margins.left - margins.right,
		y:  pageSize.height - margins.bottom
	};

	fontSize = (40 * dpiFactor).toFixed(0);
	page.fontFamily = "Times New Roman, serif"
	page.lineHeight = fontSize * 1.5;

	page.ctx.font = fontSize + 'px' + " " + page.fontFamily;
	page.ctx.fillStyle = '#000';

	page.addBackground = function(){
		destinationCanvas = document.createElement("canvas");
		destinationCanvas.width = pageSize.width;
		destinationCanvas.height = pageSize.height;
		destinationCanvas.style = page.canvas.style;

		destCtx = destinationCanvas.getContext('2d');

		//create a rectangle with the desired color
		destCtx.fillStyle = "#ffffff";
		destCtx.fillRect(0,0,pageSize.width,pageSize.height);

		//draw the original canvas onto the destination canvas
		destCtx.drawImage(page.canvas, 0, 0);
		page.canvas = destinationCanvas;
		page.ctx = destCtx;
		page.canvas.style.width = pageSize.width/dpiFactor/4 + 'px';
	page.canvas.style.height = pageSize.height/dpiFactor/4 + 'px';
	}

	page.wrapText = function(text, options) {
		var continuing = false;
		if(typeof text == "string"){
			var words = textToWords(text);
		}
		else if(typeof text[0] !== "undefined"){
			var words = text;
			continuing = true;
		}

		var maxWidth = page.maxPaintPosition.x;
		var xPos = this.paintPosition.x;

		var line = '';

		var listItem = false;
		var bottomMargin = page.lineHeight*2;

		if(typeof options !== "undefined"){
			if(options.listItem && !continuing){
				listItem = true;
				line = options.listSymbol;
				maxWidth -= 45;
				xPos += 45;
			}
			if(options.listItem && continuing){
				listItem = true;
				maxWidth -= 45+40;
				xPos += 45+50;
			}
			if(options.noBottomMargin){
				bottomMargin = page.lineHeight;
			}
		}
		firstNewLineDone = false;

		for(var n = 0; n < words.length; n++) {
			var testLine = line + words[n] + '';
			var metrics = this.ctx.measureText(testLine);
			var testWidth = metrics.width;
			if (testWidth > maxWidth && n > 0) {
				this.ctx.fillText(line, xPos, this.paintPosition.y);
				if(listItem && !firstNewLineDone && !continuing){

					maxWidth -= 42;
					xPos += 42;
					firstNewLineDone = true;
				}
				line = words[n] + '';
				this.paintPosition.y += page.lineHeight;
			}
			else {
				line = testLine;
			}
			if(this.paintPosition.y >= page.maxPaintPosition.y){
				return words.slice(n);
			}
		}
		this.ctx.fillText(line, xPos, this.paintPosition.y);
		this.paintPosition.y += bottomMargin;
		return null;
	}

	return page;
}

function CanvasDocument(paperType, margins){
	var self = this;
	self.pages = [];

	// Paper types expressed as pixel values at 300ppi
	// self.paperTypes = {
	// 	"letter": {width: 2550, height: 3300},
	// 	"legal": {width: 2550, height: 4200},
	// 	"A4": {width: 2480, height: 3508}
	// }

	self.paperTypes = {
		"letter": {width: 2550/(3.125/2), height: 3300/(3.125/2), pdfSize: {width: 612, height: 792}},
		"legal": {width: 2550/(3.125/2), height: 4200/(3.125/2), pdfSize: {width: 612, height: 1008}},
		"A4": {width: 2480/(3.125/2), height: 3508/(3.125/2), pdfSize: {width: 595.28, height: 841.89}}
	}
	try{
		self.paperType = self.paperTypes[paperType];
		self.paperType.width = self.paperType.width;
		self.paperType.height = self.paperType.height;
	}
	catch(e){
		throw new Error("Paper type " + paperType + " not supported");
	}

	// DPI factor sets it to 300 relative to default 96
	// var dpiFactor = 300 / 96;
	var dpiFactor = 1;

	var marginCalc = function(pageSize, margins){
		return {
			top: pageSize.width * margins[0] / 100,
			right: pageSize.width * margins[1] / 100,
			bottom: pageSize.width * margins[2] / 100,
			left: pageSize.width * margins[3] / 100
		}
	}
	self.activePageIndex = 0;

	self.getActivePageIndex = function(){
		return self.activePageIndex;
	}

	// Set page widths in pixels relative to DPI factor
	self.pageSize = {
		width: self.paperType.width * dpiFactor,
		height: self.paperType.height * dpiFactor
	}
	self.margins = marginCalc(self.pageSize, margins);

	// Add first page
	self.pages.push(new CanvasPage(self.pageSize, self.margins, dpiFactor));

	self.writeText = function(text, options){
		activePage = self.pages[self.getActivePageIndex()];
		text = activePage.wrapText(text, options);
		if(text == null){
			return;
		}
		else{
			console.log('new page')
			// Add new page, and keep writing
			self.pages.push(new CanvasPage(self.pageSize, self.margins, dpiFactor));
			self.activePageIndex += 1;
			self.writeText(text, options);
		}
	}

	self.parseHTMLBlockLevelElements = function(containerEl, selector){
		// strip out inline elements, the non-regex way
		els = containerEl.querySelectorAll('span, strong, i, em, bold, big, small, tt, abbr, acronym, cite, code, dfn, em, kbd, strong, samp, time, var, a, bdo, br, img, map, object, q, script, span, sub, sup, button, input, label, select, textarea');

		for(var i=els.length-1; i >= 0; i--){
			var el = els[i];
			text = document.createTextNode(el.innerText);
			el.parentNode.replaceChild(text, el);
		}

		nodes = self.getDescendants(containerEl);
		return nodes;
	}
	self.getDescendants = function(node, accum, textNodes) {
	    var i;
	    accum = accum || [];
	    for (i = 0; i < node.children.length; i++) {
	    	accum.push({el: node.children[i], parentTagName: node.tagName, tagName: node.tagName});
	        self.getDescendants(node.children[i], accum);
	    }
	    return accum;
	}

	self.parseEl = function(el){
		var pdfContent = [];
		nodes = self.parseHTMLBlockLevelElements(el);

		for(var i=0; i < nodes.length; i++){
			// Check if leaf node
			if(nodes[i].el.children.length === 0 && nodes[i].el.innerText.length > 0){
				pdfContent.push({
					'tag': nodes[i].el.tagName,
					'text': nodes[i].el.innerText,
					'parent': nodes[i].el.parentNode
				});
			}
		}
		for(var i=0; i < pdfContent.length; i++){
			pdfContent[i].options = {};
			if(i>0 && pdfContent[i].tag == "LI" && pdfContent.length && pdfContent[i-1].tag !== "LI"){
				list_position = 0;
			}
			if(pdfContent[i].tag == "LI"){
				pdfContent[i].options.listItem = true;
				if(pdfContent[i].parent.tagName == "OL"){
					pdfContent[i].options.listSymbol = list_position+1+".  ";
				}
				else{
					pdfContent[i].options.listSymbol = "•   ";
				}
				if(pdfContent[i].parent.tagName == "OL" && pdfContent[i].parent.getAttribute("type") == "A"){
					pdfContent[i].options.listSymbol = String.fromCharCode(97 + list_position).toUpperCase()+".  ";
				}
				if(i+1 < pdfContent.length && pdfContent[i+1].tag == "LI"){
					pdfContent[i].options.noBottomMargin = true;
					list_position++
				}
			}
			else if(pdfContent[i].tag == "DIV"){
				if(i+1 < pdfContent.length && pdfContent[i+1].tag == "DIV"){
					pdfContent[i].options.noBottomMargin = true;
				}
			}
		}
		return pdfContent;
	}
	self.writeHTMLtoDoc = function(el){
		pdfContent = self.parseEl(el);
		for(var i=0; i < pdfContent.length; i++){
			self.writeText(pdfContent[i].text, pdfContent[i].options);
		}
		for (var i = 0; i < self.pages.length; i++) {
			self.pages[i].addBackground();
			self.pages[i].dataURL = self.pages[i].canvas.toDataURL("image/jpeg");
		}
	}

	self.createPDF = function(){
		var dd = {
			pageSize: paperType,
			content: [],
			pageMargins: 1
		}
		// Add our canvas pages to the PDF, scale to size
		for (var i = 0; i < self.pages.length; i++) {
			console.log("adding page " + i);
			dd.content.push({
				image: self.pages[i].dataURL,
				width: self.paperType.pdfSize.width-(dd.pageMargins*2),
				alignment: 'center'
			})
		}
		self.pdf = createPdf(dd);
	}
	self.openPDF = function(){
		self.pdf.open();
	}
	self.savePDF = function(filename){
		self.pdf.download(filename);
	}
}
function textToWords(text){
 	var re = /[\0-\uD7FF\uE000-\uFFFF]|[\uD800-\uDBFF][\uDC00-\uDFFF]|[\uD800-\uDBFF](?![\uDC00-\uDFFF])|(?:[^\uD800-\uDBFF]|^)[\uDC00-\uDFFF]/g
	var characters = text.match(re);

	var el = document.createElement('div');
	el.style.width = 0;
	el.style.position = 'absolute';
	el.style.visibility = 'hidden';
	var oldHeight = 0;
	var newHeight;
	var words = [];
	var currentWordIndex = -1;

	document.body.appendChild(el);

	for (var i = 0; i < characters.length; i++) {
		char = characters[i];
		oldHeight = el.offsetHeight;
		el.innerHTML += char;
		newHeight = el.offsetHeight;
		if(newHeight > oldHeight){
			//new array item
			words.push(char)
			currentWordIndex++;
			el.innerText = char;
			newHeight = 0;
		}
		else{
			//append to same word
			words[currentWordIndex] += char;
		}
	}
	return words;
}