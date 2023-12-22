// coba buat fungsi simpel sendiri, tidak mengandalkan jquery
function ajaxRequest(method, url, header, body) {
	return new Promise((resolve, reject) => {
		let xhr = new XMLHttpRequest();

		xhr.open(method, url, true);
		xhr.onreadystatechange = function () {
			if (this.readyState == 4) {
				resolve({
					status: this.status,
					responseText: this.responseText
				});
			}
		}
		xhr.addEventListener("error", function (err) {
			reject(err)
		});

		if(Array.isArray(header)) {
			for (let i = 0; i < header.length; i++) {
				if (typeof header[i] == "object" && header[i].key != undefined && header[i].val != undefined) {
					xhr.setRequestHeader(header[i].key, header[i].value);
				}
			}
		} else if (header && typeof header == "object" && header.key != undefined && header.val != undefined) {
			xhr.setRequestHeader(header.key, header.value);
		}

		if(body) {
			if(typeof body == "object") {
				xhr.send(JSON.stringify(body));	
			} else {
				xhr.send(body);	
			}
		} else {
			xhr.send();
		}
	});
}

function getCookie(name){
    return document.cookie.split(';').some(c => {
        return c.trim().startsWith(name + '=');
    });
}

function deleteCookie( name, path, domain ) {
	if( getCookie( name ) ) {
	  document.cookie = name + "=" +
		((path) ? ";path="+path:"")+
		((domain)?";domain="+domain:"") +
		";expires=Thu, 01 Jan 1970 00:00:01 GMT";
	}
}

function relogin() {
	deleteCookie('PHPSESSID', '/', window.location.hostname);
	window.location = window.location.origin
}
