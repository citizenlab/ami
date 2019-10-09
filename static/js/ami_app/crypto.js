window.crypto = window.crypto || window.msCrypto;
amiApp.enc = new TextEncoder("utf-8");
amiApp.ami_jwk_key = null;

// Generate private key for HMAC message signing
// output as JWK format so it can be persisted in localStorage
amiApp.generate_ami_key = function(){
	return window.crypto.subtle.generateKey(
	  {
	    name: "HMAC",
	    hash: {name: "SHA-256"}
	  },
	  true,
	  ["sign", "verify"]
	)
	.then(function(key){
		return crypto.subtle.exportKey("jwk", key)
	});
}

// import the private key from JWK format into the full format
amiApp.import_ami_key = function(ami_jwk_key){
	return window.crypto.subtle.importKey(
		'jwk', 
		amiApp.ami_jwk_key, 
		{
			name: "HMAC",
			hash: {name: "SHA-256"}
		}, 
		true, 
		["sign", "verify"]
	);
}

// retrieve the key from localstorage
amiApp.retrieve_ami_key = function(){
	var ami_jwk_key = localStorage.getItem("ami_key");
	return JSON.parse(ami_jwk_key);
}

// Generate or retreive the key if it exists
amiApp.ami_key_promise = new Promise(function(resolve, reject) {
	// Try to get the key
	amiApp.ami_jwk_key = amiApp.retrieve_ami_key();
	// if no key we have to generate it
	if(amiApp.ami_jwk_key === null || Object.keys(amiApp.ami_jwk_key).length === 0){
		// generate key
		amiApp.generate_ami_key().then(function(jwtKey){
			// save key to localStorage for future use, and return key
			str_key = JSON.stringify(jwtKey);
			amiApp.ami_jwk_key = jwtKey;
			localStorage.setItem("ami_key", str_key);
			resolve(amiApp.ami_jwk_key);
		});
	}
	else{
		// if key already existed in localstorage, return key
		resolve(amiApp.ami_jwk_key)
	}
}).then(function(ami_jwk_key){
	// return non jwk key
	return amiApp.import_ami_key(ami_jwk_key)
});

// convert buffer to hex
amiApp.buf2hex = function(buf) {
  var fu = function(x){return ('00'+x.toString(16)).slice(-2)};
  return Array.prototype.map.call(new Uint8Array(buf), fu).join('');
}

// generate HMAC from key and message
amiApp.hmacSha256= function(key, str) {
  var buf = amiApp.enc.encode(str);
  window.theKey = key;
  return window.crypto.subtle.sign({name: "HMAC", hash: "SHA-256"}, key, buf).then(function(sig){
  	return amiApp.buf2hex(sig);
  })
}