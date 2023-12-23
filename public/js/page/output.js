var data = {
	number: '',
	provider_id: 0
}

const app = Vue.createApp({
	// el: '#main',
	data: function() {
		return {
			data: data,
			selected: { number: '', provider_name: '', refTable:'', refIdx: 0},
			pnOdds: [],
			pnEvens: [],
			showConfirmDel: false,
		}
	},
	created: async function() {
		getPNOdds(this.pnOdds, true);
		getPNEvens(this.pnEvens, true);
	},
	methods: {
		confirmDeleteRecord: function(data, idx, refTable) {
			this.selected.number = data[idx].number;
			this.selected.provider_name = data[idx].provider_name;
			this.selected.refTable = refTable;
			this.selected.refIdx = idx;
			this.showConfirmDel = true;
		},
		editRecord: function(data, idx) {
			window.location = window.location.origin + '/input#id=' + data[idx].id;
		},
		deleteRecord: async function() {
			var refData;
			selected = this.selected 
			if(selected.refTable == 'odd') {
				idx = this.pnOdds[this.selected.refIdx].id;
				refData = this.pnOdds;
			} else {
				idx = this.pnEvens[this.selected.refIdx].id;
				refData = this.pnEvens;
			}
			myShowConfirmDel = true;
			await ajaxRequest('DELETE', '/api/phone-number/' + idx)
				.then(function(resp) {
					if(resp.status === 200) {
						if(selected.refTable == 'odd') {
							getPNOdds(refData);
						} else {
							getPNEvens(refData);
						}
						myShowConfirmDel = false;
					} else if (respData.code == 'token-parse-fail') {
						relogin();
					} else {
					}
				});
			this.showConfirmDel = myShowConfirmDel;
		}
	}
}).mount('#main')

async function getPNOdds(pnOdds, setTimer){
	ajaxRequest('GET', '/api/phone-number?oddStatus=1&pageSize=100')
		.then(function(resp) {
			if(resp.status === 200) {
				respData = JSON.parse(resp.responseText);
				if(Array.isArray(respData.data)) {
					pnOdds.length = 0
					for (var i=0; i < respData.data.length; i++) {
						pnOdds.push(respData.data[i]);
					}
				}
			} else if (respData.status == 401) {
				relogin();
			}
		});
	if(setTimer) {
		setTimeout(() => { getPNOdds(pnOdds, setTimer) }, 10000);
	}
}

async function getPNEvens(pnEvens, setTimer){
	ajaxRequest('GET', '/api/phone-number?oddStatus=1&oddStatus_opt=lt&pageSize=100')
		.then(function(resp) {
			if(resp.status === 200) {
				respData = JSON.parse(resp.responseText);
				if(Array.isArray(respData.data)) {
					pnEvens.length = 0
					for (var i=0; i < respData.data.length; i++) {
						pnEvens.push(respData.data[i]);
					}
				}
			} else if (respData.status == 401) {
				relogin();
			}
		});
	if(setTimer) {
		setTimeout(() => { getPNEvens(pnEvens, setTimer) }, 10000);
	}
}
