<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('kurir/css/css')?>
</head>
<body>
	<div class="container-scroller">
		<?php $this->load->view('template/navbar');?>
		<div class="container-fluid page-body-wrapper">
			<?php $this->load->view('template/sidebar');?>
			<div class="main-panel">
				<div class="content-wrapper">
					<div class="row page-title-header">
						<div class="col-12">
							<div class="page-header">
								<h4 class="page-title">Kurir</h4>
								<div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap"></div>
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
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalKurir" id="addKurir"><i class="fa fa-plus"></i> Tambah Kurir</button>
									</div>
									<table id="myTable" class="table table-striped">
										<thead>
											<th>Id</th>
											<th>Nama</th>
											<th>No Telp</th>
											<th>Perusahaan</th>
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
				<?php $this->load->view('template/footer');?>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalKurir" tabindex="-1" role="dialog" aria-labelledby="modalKurirTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Form Kurir</h5>
				</div>
				<div class="modal-body">
					<form class="forms-sample">
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="hidden" name="idKurir" id="idKurir">
							<input type="text" class="form-control" id="nama" placeholder="Nama">
						</div>
						<div class="form-group">
							<label for="NoTelp">No Telepon</label>
							<input type="text" class="form-control number" id="noTelp" placeholder="No Telepon">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
					<button type="button" class="btn btn-primary" id="addForm"><i class="fa fa-save"></i> Save changes</button>
					<button type="button" class="btn btn-warning" id="updateForm"><i class="fa fa-pencil"></i> Update changes</button>
				</div>
			</div>
		</div>
	</div>
</body>
<?php $this->load->view('kurir/js/js')?>
</html>