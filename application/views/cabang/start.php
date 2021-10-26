<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('cabang/css/css')?>
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
								<h4 class="page-title">Cabang</h4>
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
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCabang" id="addCabang">Tambah Cabang</button>
									</div>
									<table id="myTable" class="table table-striped">
										<thead>
											<th>Id</th>
											<th>Nama</th>
											<th>Kota Besar</th>
											<th>Kota</th>
											<th>Alamat</th>
											<th></th>
											<th></th>
										</thead>
										<tbody></tbody>
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

		<!-- Modal -->
	<div class="modal fade" id="modalCabang" role="dialog" aria-labelledby="modalCabangTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Form Cabang</h5>
				</div>
				<div class="modal-body">
					<form class="forms-sample">
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="hidden" name="idCabang" id="idCabang">
							<input type="text" class="form-control" id="nama" placeholder="Nama">
						</div>
						<div class="form-group">
							<label>Kota Besar Tujuan</label>
							<select class="form-control" id="kodeKotaBesar" data-live-search="true" placeholder="Pilih Kota Besar" data-width="100%">
								<option value="">Pilih Kota Besar</option>
								<?php  foreach ($kotabesar['data'] as $data) {?>
									<option value="<?php echo $data['KodeKotaBesar'];?>"><?php echo $data["NamaKotaBesar"];?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label>Kota Besar Tujuan</label>
							<select class="form-control" id="kodeKota" data-live-search="true" placeholder="Pilih Kota" data-width="100%">
							</select>
						</div>
						<div class="form-group">
							<label for="Alamat">Alamat</label>
							<textarea class="form-control" id="alamat" placeholder="Alamat Lengkap Cabang"></textarea>
						</div>
						<?php if($this->session->userdata('Role') == 1){?>
						<div class="form-group">
							<select class="form-control" data-live-search="true" data-width="100%" id="idPerusahaan">
								<option value = ''>Pilih Perusahaan</option>
							<?php foreach ($data['data'] as $data) {?>
								<option value="<?php echo $data['IdPerusahaan'];?>"><?php echo $data["IdPerusahaan"]." - ".$data["NamaPerusahaan"];?></option>
							<?php } ?>
							</select>
						</div>
						<?php } ?>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
					<button type="button" class="btn btn-primary" id="addForm">Save changes</button>
					<button type="button" class="btn btn-warning" id="updateForm">Update changes</button>
				</div>
			</div>
		</div>
	</div>
</body>
<?php $this->load->view('cabang/js/js'); ?>
</html>