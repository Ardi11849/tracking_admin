<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('laporan/css/css')?>
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
								<h4 class="page-title">Laporan Pengeluaran</h4>
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
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPengeluaran" id="addPengeluaran"><i class="fa fa-plus"></i> Tambah Pengeluaran</button>
									</div>
									<table id="myTable" class="table table-striped">
										<thead>
											<th>Perusahaan</th>
											<th>Cabang</th>
											<th>Alasan Pngeluaran</th>
											<th>Jumlah Pengeluaran</th>
											<th>Tanggal Pengeluaran</th>
											<th></th>
											<th></th>
										</thead>
										<tbody></tbody>
								        <tfoot>
								            <tr>
								                <th colspan="2" style="text-align:left">Total Page Ini:</th>
								                <th></th>
								            </tr>
								        </tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="row page-title-header">
						<div class="col-12">
							<div class="page-header">
								<h4 class="page-title">Laporan Pemasukan</h4>
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
									<table id="tablePemasukan" class="table table-striped">
										<thead>
											<th>Perusahaan</th>
											<th>Cabang</th>
											<th>No Resi</th>
											<th>Jumlah Pemasukan</th>
											<th>Tanggal Pemasukan</th>
										</thead>
										<tbody></tbody>
								        <tfoot>
								            <tr>
								                <th colspan="4" style="text-align:left">Total Page Ini:</th>
								                <th></th>
								            </tr>
								        </tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="row page-title-header">
						<div class="col-12">
							<div class="page-header">
								<h4 class="page-title">Laporan Keuangan</h4>
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
									<table id="tableLaporan" class="table table-striped">
										<thead>
											<th>Pemasukan</th>
											<th>Pengeluaran</th>
										</thead>
										<tbody></tbody>
								        <tfoot>
								            <tr>
								                <th colspan="1" style="text-align:left">Total Page Ini:</th>
								                <th></th>
								            </tr>
								        </tfoot>
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
	<div class="modal fade" id="modalPengeluaran" role="dialog" aria-labelledby="modalPengeluaranTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Form Pengeluran</h5>
				</div>
				<div class="modal-body">
					<form class="forms-sample">
						<div class="form-group">
							<input type="hidden" name="IdPengeluaran" id="IdPengeluaran">
						</div>
						<?php if ($this->session->userdata('Role') == '1' || $this->session->userdata('Role') == '2') { ?>
								<?php if ($this->session->userdata('Role') == '1') { ?>
									<div class="form-group">
										<select class="form-control" data-live-search="true" data-width="100%" id="IdPerusahaan">
											<option value = ''>Pilih Perusahaan</option>
											<?php foreach ($perusahaan['data'] as $data) {?>
												<option value="<?php echo $data['IdPerusahaan'];?>"><?php echo $data["IdPerusahaan"]." - ".$data["NamaPerusahaan"];?></option>
											<?php } ?>
										</select>
									</div>
								<?php } ?>
								<div class="form-group" id="divCabang">
									<select class="form-control" data-live-search="true" data-width="100%" id="IdCabang">
										<option value = ''>Pilih Cabang</option>
										<?php foreach ($cabang['data'] as $data) {?>
											<option value="<?php echo $data['IdCabang'];?>"><?php echo $data["IdCabang"]." - ".$data["Nama"];?></option>
										<?php } ?>
									</select>
								</div>
						<?php } ?>
						<div class="form-group">
							<label>Alasan Pngeluaran</label>
							<input type="text" class="form-control" placeholder="Alasan Pengeluaran" id="AlasanPengeluaran">
						</div>
						<div class="form-group">
							<label>Jumlah Pengeluaran</label>
							<input type="text" class="form-control harga" placeholder="Jumlah Pengeluaran" id="JumlahPengeluaran">
						</div>
						<div class="form-group">
							<label for="Tanggal Pengeluaran">Tanggal Pengeluaran</label>
							<input type="text" min="1990-01-01" class="form-control tanggal" id="TanggalPengeluaran" placeholder="Tanggal Pengeluaran">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
					<button type="button" class="btn btn-primary" id="addFormPengeluaran">Save changes</button>
					<button type="button" class="btn btn-warning" id="updateFormPengeluaran">Update changes</button>
				</div>
			</div>
		</div>
	</div>
</body>
<?php $this->load->view('laporan/js/js'); ?>
</html>