// parse query string to see if page request is coming from OAuth 2.0 server.
var fragmentString = location.hash.substring(1);
var params = {};
var regex = /([^&=]+)=([^&]*)/g, m;
while (m = regex.exec(fragmentString)) {
	params[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
}
if (Object.keys(params).length > 0) {
	localStorage.setItem('oauth2-test-params', JSON.stringify(params) );
	if (params['state'] && params['state'] == 'try_sample_request') {
		trySampleRequest();
	}
}

// send to server
hashParts = window.location.hash.substring(1).split('&');
for(i = 0; i < hashParts.length; i++) {
	kv = hashParts[i].split('=');
	if(kv[0] == 'access_token') {
		ajaxRequest(
			"POST",
			window.location.origin + "/auth/using-google",
			{ key: "Content-Type", value: "application/json;charset=UTF-8" },
			{ submit: 1, access_token: kv[1] },
		).then(function(resp) {
			box = document.getElementById('auth-result-box');
			if(resp.status == 200) {
				data = JSON.parse(resp.responseText)
				box.innerHTML = 
					'<div>'+
						'<div class="mb-2">'+
							'Proses otentikasi berhasil dengan email: ' + data.email +
						'</div>'+
						'<hr />'+
						'<div class="mb-1">'+
							'Untuk lanjut input data bisa menuju <a href="/input">HALAMAN INPUT</a>'+
						'</div>'+
						'<div class="mb-1">'+
							'Untuk melihat hasil input bisa menuju <a href="/output">HALAMAN OUTPUT</a>'+
						'</div>'+
					'</div>';
			} else {
				box.innerHTML = 
					'<div class="text-center">'+
						'Proses authentikasi gagal!!'
					'</div>';
			}
		});
	}
}
