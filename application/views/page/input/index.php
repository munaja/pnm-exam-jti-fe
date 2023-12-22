<?php

$scriptSources[] = '/js/page/input.js?v=20231222';

$boxColWidth = 'col col-md-8 col-lg-7 col-xl-6 col-xxl-5';

?>
<div id="main">
	<h5>{{entryMode}} Data No Handphone</h5>
	<hr />
	<form action="">
		<div class="mb-2">{{formMessage}}</div>
		<div class="mb-3">
			<div>No Handphone</div>
			<div>
				<input v-model="data.number" class="form-control">
				<span class="text-danger" v-if="dataErr.number">{{dataErr.number}}</span>
			</div>
		</div>
		<div class="mb-3">
			<div>Provider</div>
			<div>
				<select class="form-select" v-model="data.provider_id">
					<option v-for="item in providers" :value="item.id">{{item.name}}</option>
				</select>
				<span class="text-danger" v-if="dataErr.provider_id">{{dataErr.provider_id}}</span>
			</div>
		</div>
	</form>
	<div class="text-center mt-4">
		<button @click="submitData" class="btn bg-blue me-2">
			<i class="bi bi-check-lg"></i> Simpan
		</button>
		<button v-if="entryMode=='Tambah'" @click="submitBulkData" class="btn bg-blue">
			<i class="bi bi-check2-all"></i> Auto
		</button>
		<a v-else href="/output" class="btn bg-grey-300">
			<i class="bi bi-check2-all"></i> Batal
		</a>
	</div>
	<hr />
	Lihat hasil di <a href="/output">HALAMAN OUTPUT</a>
</div>
