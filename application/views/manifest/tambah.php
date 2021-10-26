<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('manifest/css/css')?>
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
								<h4 class="page-title">Tambah Manifest</h4>
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
										<form>
											<div class="row">
												<div class="col">
													<label>Tanggal Input</label>
													<input type="text" id="Tanggal" class="form-control tanggal" placeholder="Pilih Tanggal">
												</div>
												<div class="col"></div>
											</div>
											<div class="row" style="padding-top: 5px">
												<div class="col">
													<label>Kota Besar Tujuan</label>
													<select class="form-control" id="KodeKotaBesar" data-live-search="true" placeholder="Pilih KotaBesar">
														<option value="">Pilih Kota Besar</option>
														<?php  foreach ($kotabesar['data'] as $data) {?>
															<option value="<?php echo $data['KodeKotaBesar'];?>"><?php echo $data["NamaKotaBesar"];?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col">
													<label>Kota Tujuan</label>
													<select class="form-control" id="KotaTujuan" data-live-search="true" placeholder="Kota Tujuan">
													</select>
												</div>
											</div>
											<div class="row" style="padding-top: 15px; padding-bottom: 15px;">
												<div class="col">
													<button type="button" id="search" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
												</div>
											</div>
											<div class="row" style="padding-top: 5px">
												<div class="col">
													<label>No Manifest</label>
													<input type="text" class="form-control" id="NoManifest" placeholder="Masukan Nomor Manifest">
												</div>
												<?php if ($this->session->userdata('Role') == 1 || $this->session->userdata('Role') == 1) { ?>
												<div class="col">
													<label>Perusahaan induk</label>
													<select class="form-control" id="Perusahaan" data-live-search="true" placeholder="Pilih Kabupaten / Kota">
														<option value="">Pilih Penerima</option>
														<?php foreach ($perusahaan['data'] as $data) { ?>
															<option value="<?php echo $data["IdPerusahaan"];?>"><?php echo $data["NamaPerusahaan"];?></option>
														<?php } ?>
													</select>
												</div>
												<?php } ?>
												<div class="col">
													<label>Penerima Manifest</label>
													<select class="form-control" id="Cabang" data-live-search="true" placeholder="Pilih Kabupaten / Kota">
														<option value="">Pilih Penerima</option>
														<?php foreach ($cabang['data'] as $data) { ?>
															<option value="<?php echo $data["IdCabang"];?>"><?php echo $data["Nama"];?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="row" style="padding-top: 5px">
												<div class="col">
													<label>Kota Besar Transit</label>
													<select class="form-control" id="KotaBesarTransit" data-live-search="true" placeholder="Pilih Kota Besar Transit">
														<option value="">Pilih Kota Besar</option>
														<?php  foreach ($kotabesar['data'] as $data) {?>
															<option value="<?php echo $data['KodeKotaBesar'];?>"><?php echo $data["NamaKotaBesar"];?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col">
													<label>Kota Transit</label>
													<select class="form-control" id="KotaTransit" data-live-search="true" placeholder="Pilih Kota">
													</select>
												</div>
											</div>
										</form>
									</div>
									<table id="table" class="table table-striped">
										<thead id="isiTable">
											<th>No Resi</th>
											<th>Perusahaan</th>
											<th>Cabang</th>
											<th>Pengirim</th>
											<th>Alamat Pengirim</th>
											<th>No Pengirim</th>
											<th>Penerima</th>
											<th>No Penerima</th>
											<th>Kota Besar</th>
											<th>Kota</th>
											<th>Alamat Lengkap</th>
											<th>Tanggal Pembuatan</th>
										</thead>
										<tbody id="display">
										</tbody>
										<tfoot>
											<th colspan="10">
												<a href="<?php echo base_url()?>manifest">
													<button class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</button>
												</a>
												<button class="btn btn-primary" id="save">
												<i class="fa fa-save"></i> Simpan</button>
											</th>
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
</body>
<?php $this->load->view('manifest/js/tambah_js')?>
</html>