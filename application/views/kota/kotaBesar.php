
<div class="content-wrapper">
	<div class="row page-title-header">
		<div class="col-12">
			<div class="page-header">
				<h4 class="page-title">Kota Besar</h4>
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
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalKotaBesar" id="addKotaBesar">Tambah Kota Besar</button>
					</div>
					<table id="tableKotaBesar" class="table table-striped">
						<thead>
							<th>Kode kota Besar</th>
							<th>Nama kotaBesar</th>
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

<div class="modal fade" id="modalKotaBesar" role="dialog" aria-labelledby="modalkotaBesarTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Form Kota Besar</h5>
			</div>
			<div class="modal-body">
			<form class="forms-sample">
				<div class="form-group">
					<input type="hidden" id="KodeKotaBesar2">
					<label>Kode Kota Besar</label>
					<input type="text" class="form-control" name="KodeKotaBesar" id="KodeKotaBesar" placeholder="Kode Kota Besar">
				</div>
				<div class="form-group">
					<label for="Nama">Nama Kota Besar</label>
					<input type="text" class="form-control" id="NamaKotaBesar" placeholder="Nama Kota Besar">
				</div>
			</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
				<button type="button" class="btn btn-primary" id="addFormKotaBesar">Tambah</button>
				<button type="button" class="btn btn-warning" id="updateFormKotaBesar">Update changes</button>
			</div>
		</div>
	</div>
</div>