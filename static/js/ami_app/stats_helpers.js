
// send request to stats server, based on contents of #requestForm
var httpRequest;
function makePostRequest(url) {
  httpRequest = new XMLHttpRequest();

  if (!httpRequest) {
    console.log('Giving up :( Cannot create an XMLHTTP instance');
    return false;
  }
  httpRequest.onreadystatechange = logContents;
  httpRequest.open('POST', url);
  var formData = new FormData(document.getElementById("requestForm")); 
  httpRequest.send(formData);
}
function logContents() {
  if (httpRequest.readyState === XMLHttpRequest.DONE) {
    var msg = JSON.parse(httpRequest.responseText);
    var msgHolder = document.getElementById("serverResponse");
    msgHolder.innerHTML = msg.msg;
    console.log(msg);
    if(httpRequest.status == 200){
      amiApp.stats.requestSent = true;
    }
  }
}

function getSearchParameters() {
  var prmstr = window.location.search.substr(1);
  return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
}

function transformToAssocArray( prmstr ) {
  var params = {};
  var prmarr = prmstr.split("&");
  for ( var i = 0; i < prmarr.length; i++) {
      var tmparr = prmarr[i].split("=");
      params[tmparr[0]] = tmparr[1];
  }
  return params;
}

// Check for the existnace of a debug url flag
amiApp.urlParams = getSearchParameters();
if(amiApp.urlParams.hasOwnProperty("debug")){
  // if urlflag is set, then make the request form visible for debugging.
  document.getElementById("requestForm").classList.remove("dn");
} 