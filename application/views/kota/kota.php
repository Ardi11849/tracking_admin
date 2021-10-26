
<div class="content-wrapper">
	<div class="row page-title-header">
		<div class="col-12">
			<div class="page-header">
				<h4 class="page-title">Kota </h4>
			</div>
		</div>
		<div class="col-md-12">
			<div class="page-header-toolbar"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 grid-margin">
			<div class="card flex-nowrap">
				<div class="card-body">
					<div class="col-md-12 grid-margin all">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalKota" id="addKota">Tambah Kota </button>
					</div>
					<table id="tableKota" class="table table-striped">
						<thead>
							<th>Kode Kota</th>
							<th>Nama Kota</th>
							<th>Nama Kota Besar</th>
							<th>Pembuat</th>
							<th>Tanggal Di Buat</th>
							<th></th>
							<th></th>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalKota" role="dialog" aria-labelledby="modalKotaTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Form Kota</h5>
			</div>
			<div class="modal-body">
				<form class="forms-sample">
					<input type="hidden" name="KodeKota2" id="KodeKota2">
					<div class="form-group">
						<label>Kode Kota Besar</label>
							<select class="form-control" data-live-search="true" data-width="100%" id="KodeKotaBesar3">
								<option value = ''>Pilih KotaBesar</option>
							<?php foreach ($data['data'] as $data) {?>
								<option value="<?php echo $data['KodeKotaBesar'];?>" data-namakotabesar="<?php echo $data['NamaKotaBesar']; ?>"><?php echo $data["KodeKotaBesar"]." - ".$data["NamaKotaBesar"];?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="Nama">Nama Kota Besar</label>
						<input type="text" class="form-control" id="NamaKotaBesar3" placeholder="Nama Kota Besar" readonly>
					</div>
					<div class="form-group">
						<label>Kode Kota</label>
						<input type="text" class="form-control" name="KodeKota" id="KodeKota" placeholder="Kode Kota">
					</div>
					<div class="form-group">
						<label for="NamaKota">Nama Kota</label>
						<input type="text" class="form-control" id="NamaKota" placeholder="Nama Kota">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
				<button type="button" class="btn btn-primary" id="addFormKota">Tambah</button>
				<button type="button" class="btn btn-warning" id="updateFormKota">Update changes</button>
			</div>
		</div>
	</div>
</div>