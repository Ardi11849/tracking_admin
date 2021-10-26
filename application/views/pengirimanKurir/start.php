<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('pengirimanKurir/css/css')?>
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
								<h4 class="page-title">Penerima</h4>
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
									<table id="myTable" class="table">
										<thead>
											<th>Id</th>
											<th>No Resi</th>
											<th>Id Kurir</th>
											<th>Kurir</th>  <th>Pengirim</th>
											<th>Hp Pengirim</th>
											<th>Penerima</th>
											<th>Hp Penerima</th>
											<th>Alamat Penerima</th>
											<th>Status</th>
											<th>Diterima</th>
											<th>Foto</th>
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

	<div class="modal fade" id="modalpenerima" tabindex="-1" role="dialog" aria-labelledby="modalpenerimaTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Form Penerima</h5>
				</div>
				<div class="modal-body">
					<form class="forms-sample">
						<div class="form-group">
							<input type="hidden" name="IdPengirimanKurir" id="IdPengirimanKurir">
							<select class="form-control" data-live-search="true" data-width="100%" id="NoResi" placeholder="Pilih No Resi">
								<option value="">Pilih No Resi</option>
								<?php foreach ($pengiriman['data'] as $data) {?>
									<option value="<?php echo $data['NoResi'];?>" data-pengirim="<?php echo $data['Pengirim']; ?>" data-noPengirim="<?php echo $data['NoTelpPengirim'];?>" data-penerima="<?php echo $data['Penerima'];?>" data-noPenerima="<?php echo $data['NoTelpPenerima'];?>" data-alamatPenerima="<?php echo $data['AlamatPenerima'];?>"><?php echo $data["NoResi"]; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control" id="IdKurir" data-live-search="true" data-width="100%" placeholder="Pilih Kurir">
								<option value="">Pilih Kurir</option>
								<?php foreach ($kurir['data'] as $kurir) {?>
									<option value="<?php echo $kurir['IdKurir'];?>"><?php echo $kurir["IdKurir"]." - ".$kurir["Nama"];?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="Pengirim">Pengirim</label>
							<input type="text" class="form-control" readonly id="Pengirim" placeholder="Pengirim">
						</div>
						<div class="form-group">
							<label for="NoHpPengirim">Handphone Pengirim</label>
							<input type="text" class="form-control" readonly id="NoHpPengirim" placeholder="NoHpPengirim">
						</div>
						<div class="form-group">
							<label for="Penerima">Penerima</label>
							<input type="text" class="form-control" readonly id="Penerima" placeholder="Penerima">
						</div>
						<div class="form-group">
							<label for="NoHpPenerima">Handphone Penerima</label>
							<input type="text" class="form-control" readonly id="NoHpPenerima" placeholder="NoHpPenerima">
						</div>
						<div class="form-group">
							<label for="Alamat">Alamat</label>
							<input type="text" class="form-control" readonly id="Alamat" placeholder="Alamat">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
					<button type="button" class="btn btn-warning" id="updateForm">Update changes</button>
				</div>
			</div>
		</div>
	</div>
</body>
<?php $this->load->view('pengirimanKurir/js/js')?>
</html>