<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('user/css/css')?>
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
								<h4 class="page-title">User</h4>
								<div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap"></div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="page-header-toolbar"></div>
						</div>
					</div>
					<?php if ($this->session->userdata('Role') == '1' || $this->session->userdata('Role') == '2') { ?>
						<div class="row">
							<div class="col-md-12 grid-margin">
								<div class="card flex-nowrap">
									<div class="card-header">Tabel Users Admin</div>
									<div class="card-body">
										<div class="col-md-12 grid-margin all">
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUserAdmin" id="addUserAdmin">Tambah user admin</button>
										</div>
										<table id="myTable" class="table table-striped">
											<thead>
												<th>Id</th>
												<th>Username</th>
												<th>Password</th>
												<th>Role</th>
												<th>Id Perusahaan</th>
												<th>Nama Perusahaan</th>
												<th>Nama Cabang</th>
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
					<?php } ?>
					<div class="row">
						<div class="col-md-12 grid-margin">
							<div class="card flex-nowrap">
								<div class="card-header">Tabel Users Kurir</div>
								<div class="card-body">
									<div class="col-md-12 grid-margin all">
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUserKurir" id="addUserKurir">Tambah user Kurir</button>
									</div>
									<table id="myTableKurir" class="table table-striped">
										<thead>
											<th>Id</th>
											<th>Nama Kurir</th>
											<th>Username</th>
											<th>Password</th>
											<?php if ($this->session->userdata('Role') == '1') { ?>
												<th>Id Perusahaan</th>
												<th>Nama Perusahaan</th>
											<?php } ?>
											<th>Id Cabang</th>
											<th>Nama Cabang</th>
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
					<div class="row">
						<div class="col-md-12 grid-margin">
							<div class="card flex-nowrap">
								<div class="card-header">List Username</div>
								<div class="card-body">
									<div class="col-md-12 grid-margin all"></div>
									<table id="myTableList" class="table table-striped">
										<thead>
											<th>Username</th>
											<th>Role</th>
											<th>Nama Perusahaan</th>
											<th>Nama Cabang</th>
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
	
	<?php if ($this->session->userdata('Role') == '1' || $this->session->userdata('Role') == '2') { ?>
		<div class="modal fade" id="modalUserAdmin" role="dialog" aria-labelledby="modalUserAdminTitle" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Form user</h5>
					</div>
					<div class="modal-body">
						<form class="forms-sample">
							<div class="form-group">
								<label for="Username">Username</label>
								<input type="hidden" name="IdUser" id="IdUser">
								<input type="text" class="form-control" id="Username" placeholder="Username">
							</div>
							<div class="form-group">
								<label for="Password">Password</label>
								<input type="Password" class="form-control" id="Password" placeholder="Password">
							</div>
							<div class="form-group">
								<select class="form-control" id="Role" data-live-search="true" data-width="100%" placeholder="Pilih Role">
									<option value="">Pilih Role</option>
									<option value="2">Admin</option>
									<option value="3">Admin Cabang</option>
								</select>
							</div>
							<?php if ($this->session->userdata('Role') == '1') { ?>
								<div class="form-group">
									<select class="form-control" id="IdPerusahaan" data-live-search="true" data-width="100%" placeholder="Pilih Perusahaan">
										<option value="">Pilih Perusahaan</option>
										<?php foreach ($perusahaan['data'] as $data) {?>
											<option value="<?php echo $data['IdPerusahaan'];?>"><?php echo $data["IdPerusahaan"]." - ".$data["NamaPerusahaan"];?></option>
										<?php } ?>
									</select>
								</div>
							<?php } ?>
							<div class="form-group" id="divCabang">
								<select class="form-control" id="IdCabang" data-live-search="true" data-width="100%" placeholder="Pilih Cabang">
									<option value="">Pilih Cabang</option>
									<?php foreach ($cabang['data'] as $data) {?>
										<option value="<?php echo $data['IdCabang'];?>"><?php echo $data["IdCabang"]." - ".$data["Nama"];?></option>
									<?php } ?>
								</select>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
						<button type="button" class="btn btn-primary" id="addFormAdmin">Save changes</button>
						<button type="button" class="btn btn-warning" id="updateFormAdmin">Update changes</button>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>

	<div class="modal fade" id="modalUserKurir" role="dialog" aria-labelledby="modalUserKurirTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Form user</h5>
				</div>
				<div class="modal-body">
					<form class="forms-sample">
						<div class="form-group">
							<label for="nama">Username</label>
							<input type="hidden" name="iduser" id="IdUserKurir">
							<input type="text" class="form-control" id="UsernameKurir" placeholder="Username">
						</div>
						<div class="form-group">
							<label for="NoTelp">Password</label>
							<input type="password" class="form-control" id="PasswordKurir" placeholder="Password">
						</div>
						<div class="form-group" id="kurir">
							<select class="form-control" id="IdKurir" data-live-search="true" data-width="100%" placeholder="Pilih Kurir">
								<option value="">Pilih Kurir</option>
								<?php foreach ($kurir['data'] as $kurir) {?>
									<option value="<?php echo $kurir['IdKurir'];?>"><?php echo $kurir["IdKurir"]." - ".$kurir["Nama"];?></option>
								<?php } ?>
							</select>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
					<button type="button" class="btn btn-primary" id="addFormKurir">Save changes</button>
					<button type="button" class="btn btn-warning" id="updateFormKurir">Update changes</button>
				</div>
			</div>
		</div>
	</div>
</body>
<?php $this->load->view('user/js/js')?>
</html>