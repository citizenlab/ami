amiApp.makePDF = function(element, papersize){
    var requestLetter = new CanvasDocument(papersize, [11.7647, 11.7647, 11.7647, 11.7647]);

    // convert HTML in #request element to canvas-based document
    requestLetter.writeHTMLtoDoc(element);

    // convert series of canvases into PDF
    requestLetter.createPDF();
    requestLetter.savePDF(amiApp.dataSource.request_pdf_filename);
}

amiApp.buildEmail = function(subject, el, option){
    var self = this;
    var to, subject, body, email, el, clone, listItems;
    to = self.request.company.contact.email;

    listItems = el.getElementsByTagName("li");
    var listIndex = 0;
    for (var i = 0; i < listItems.length; i++) {
        var listSymbol = "* ";
        var newList = true;
        if(i > 0 && listItems[i-1].parentNode !== listItems[i].parentNode){
        var newList = true;
        }
        else{
        newList = false;
        }
        if(newList){
            listIndex = 0;
        }
        if(listItems[i].parentNode.tagName == "OL"){
        if(listItems[i].parentNode.getAttribute("type") == "A"){
            listSymbol = String.fromCharCode(97 + listIndex).toUpperCase()+". ";
        }
        else{
            listSymbol = listIndex+1+". ";
        }
        }
        listItems[i].innerHTML = listSymbol + listItems[i].innerHTML + "<br/>";
        listIndex++;
    };
    
    body = getInnerText(el).replace(/^\s+|\s+$/g, '').replace(/\n,'\r\n'/);
    
    for (var i = 0; i < listItems.length; i++) {
        listItems[i].innerHTML = listItems[i].innerHTML.substring(2);
    };
    // console.log("body", body, el);
    if(option == "gmail"){
        email = "https://mail.google.com/mail/?view=cm&fs=1&to=" + to + "&su=" + encodeURIComponent(subject);
    }
    else{
        email = "mailto:" + to + "?subject=" + encodeURIComponent(subject);
    }
    return email;
}

var getInnerText = function(el) {
    var sel, range, innerText = "";
    if (typeof document.selection != "undefined" && typeof document.body.createTextRange != "undefined") {
        range = document.body.createTextRange();
        range.moveToElementText(el);
        innerText = range.text;
    } else if (typeof window.getSelection != "undefined" && typeof document.createRange != "undefined") {
        sel = window.getSelection();
        sel.selectAllChildren(el);
        innerText = "" + sel;
        sel.removeAllRanges();
    }
    return innerText;
}
function copyText(node) {
    if (document.body.createTextRange) {
        const range = document.body.createTextRange();
        range.moveToElementText(node);
        range.select();
        document.execCommand("copy");
    } else if (window.getSelection) {
        const selection = window.getSelection();
        const range = document.createRange();
        range.selectNodeContents(node);
        selection.removeAllRanges();
        selection.addRange(range);
        document.execCommand("copy");
        selection.removeAllRanges();
    } else {
        console.warn("Could not select text in node: Unsupported browser.");
    }
}