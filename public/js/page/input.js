var data = {
	number: '',
	provider_id: 0
}

const app = Vue.createApp({
	// el: '#main',
	data: function() {
		return {
			id: 0,
			data: data,
			providers: [],
			dataErr: { number: '', provider_id: 0},
			formMessage: '',
			entryMode: 'Tambah',
		}
	},
	methods: {
		submitData: async function() {
			//
			appRef = this;
			data = this.data;
			dataErr = this.dataErr;
			// 
			appRef.formMessage = '';
			dataErr.number = '';
			dataErr.provider_id = 0;
			// 
			if(this.entryMode == 'Tambah') {
				await ajaxRequest('POST', '/api/phone-number', null, this.data)
					.then(function(resp) {
						if(resp.status === 200) {
							appRef.formMessage = 'Data telah tersimpan'
							data.number = ""
							data.provider_id = 0
						} else if (resp.status == 401) {
							relogin();
						} else {
							// NOTE BISA DIBUAT FUNGSI
							respData = JSON.parse(resp.responseText);
							if(typeof respData.errors == 'object') {
								if(respData.errors.number) {
									dataErr.number = respData.errors.number.message;
								}
								if(respData.errors.provider_id) {
									dataErr.provider_id = respData.errors.provider_id.message;
								}
							} else {
								appRef.formMessage = 'Terjadi kesalahan'
							}
						}
					});
			} else {
				id = this.id;
				await ajaxRequest('PATCH', '/api/phone-number/' + id, null, this.data)
					.then(function(resp) {
						if(resp.status === 200) {
							window.location = window.location.origin + '/output';
						} else if (resp.status == 401) {
							relogin();
						} else {
							// NOTE BISA DIBUAT FUNGSI
							respData = JSON.parse(resp.responseText);
							if(typeof respData.errors == 'object') {
								if(respData.errors.number) {
									dataErr.number = respData.errors.number.message;
								}
								if(respData.errors.provider_id) {
									dataErr.provider_id = respData.errors.provider_id.message;
								}
							} else {
								appRef.formMessage = 'Terjadi kesalahan'
							}
						}
					});
			}
		},
		submitBulkData: async function() {
			await ajaxRequest('GET', '/api/phone-number/gen-random')
				.then(function(resp) {
					if(resp.status === 200) {
						appRef.formMessage = 'Telah berhasil membuat data random';
					} else if (resp.status == 401) {
						relogin();
					} else {
						// NOTE BISA DIBUAT FUNGSI
						respData = JSON.parse(resp.responseText);
						if(typeof respData.errors == 'object') {
							if(respData.errors.number) {
								dataErr.number = respData.errors.number.message;
							}
							if(respData.errors.provider_id) {
								dataErr.provider_id = respData.errors.provider_id.message;
							}
						} else {
							appRef.formMessage = 'Terjadi kesalahan'
						}
					}
				}).catch(function(err) {
				});
		},
	},
	created: async function() {
		fragString = window.location.hash;
		if(fragString) {
			fragParts = fragString.substring(1).split('&');
			for(i = 0; i < fragParts.length; i++) {
				kv = fragParts[i].split('=');
				if(kv.length == 2 && kv[0] == 'id')  {
					this.id = kv[1];
					this.entryMode = 'Edit',
					data = this.data;
					await ajaxRequest('GET', '/api/phone-number/' + kv[1])
						.then(function(resp) {
							if(resp.status === 200) {
								respData = JSON.parse(resp.responseText);
								if(typeof respData === 'object') {
									data.number = respData.number;
									data.provider_id = respData.provider_id;
								}
							} else if (resp.status == 401) {
								relogin();
							} else {
								// ..... 
							}
						});		
				}
			}
		}
		var providers = this.providers
		await ajaxRequest('GET', '/api/provider')
			.then(function(resp) {
				if(resp.status === 200) {
					respData = JSON.parse(resp.responseText);
					if(Array.isArray(respData.data)) {
						for (var i=0; i < respData.data.length; i++) {
							providers.push(respData.data[i]);
						}
					}
				} else if (respData.status == 401) {
					relogin();
				} else {
					// ..... 
				}
			});
	},
}).mount('#main')
