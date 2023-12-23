<?php

$scriptSources[] = '/js/page/output.js?v=20231222';

$boxColWidth = 'col col-md-12 col-lg-11 col-xl-10 col xxl-9';

?><h5>Output</h5>
<hr />
<div id="main">
	<div class="card-body">
		<div class="row">
			<div class="col-lg-6">
				<h5>Ganjil</h5>
				<table class="table">
					<thead>
						<tr>
							<th>Nomor</th>
							<th>Provider</th>
							<th style="width:60px"></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(item, idx)  in pnOdds" id="{{item.id}}">
							<td>{{item.number}}</td>
							<td>{{item.provider_name}}</td>
							<td>
								<span @click="editRecord(pnOdds, idx)" class="pointer"><i class="bi bi-pencil me-2"></i></span>
								<span @click="confirmDeleteRecord(pnOdds, idx, 'odd')" class="pointer"><i class="bi bi-trash"></i></span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-lg-6">
				<h5>Genap</h5>
				<table class="table">
					<thead>
						<tr>
							<th>Nomor</th>
							<th>Provider</th>
							<th style="width:60px"></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(item, idx)  in pnEvens" id="{{item.id}}">
							<td>{{item.number}}</td>
							<td>{{item.provider_name}}</td>
							<td>
								<span @click="editRecord(pnEvens, idx)" class="pointer"><i class="bi bi-pencil me-2"></i></span>
								<span @click="confirmDeleteRecord(pnEvens, idx, 'even')" class="pointer"><i class="bi bi-trash"></i></span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div v-if="showConfirmDel" class="modal modal-background">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header py-3 h6 fw-600 mb-0">
					Hapus Data
					<button type="button" @click="showConfirmDel=false" class="btn-close" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="mb-1">Data berikut akan dihapus:</div>
					<div class="row">
						<div class="col-3 ps-3">Nomor HP</div>
						<div class="col">:<span class="ms-2">{{selected.number}}</span></div>
					</div>
					<div class="row mb-3">
						<div class="col-3 ps-3">Provider</div>
						<div class="col">:<span class="ms-2">{{selected.provider_name}}</span></div>
					</div>
					<div class="mb-2">Lasjutkan proses?</div>
					<div>
						<button @click="deleteRecord" class="btn bg-danger me-2"><i class="bi bi-x"></i> Ya, Hapus</button>
						<button @click="showConfirmDel=false" class="btn bg-grey-300">Batal</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	.modal-background {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: rgba(0,0,0,0.5);
		z-index: 2000;
	}
	.modal {
		z-index: 2200;
		display:block;
	}
</style>
