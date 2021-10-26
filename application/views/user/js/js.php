<script src="<?php echo base_url()?>template/jquery.min.js"></script>
<script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.base.js"></script>
<script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.addons.js"></script>
<script src="<?php echo base_url()?>template/DataTables/datatables.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="<?php echo base_url()?>template/assets/js/shared/off-canvas.js"></script>
<script src="<?php echo base_url()?>template/assets/js/shared/misc.js"></script>
<script src="<?php echo base_url()?>template/assets/js/demo_1/dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function (){
		$('select').select2({theme: 'classic'});
		ruleDiv();
		$.fn.dataTable.ext.errMode = 'none';
		var table = $('#myTable').DataTable({
			scrollX: true,
			<?php if ($this->session->userdata('Role') == 1) {?>
				ajax: '<?php echo base_url()?>User/get_user_all_admin',
			<?php } else {?>
				ajax: '<?php echo base_url()?>User/get_user_admin',
			<?php } ?>
			columns: [
				{ data: 'IdUsers' },
				{ data: 'Username' },
				{ data: 'Password' },
				{ 
					data: 'Role',
					render: function(data, type, row) {
						if (data == 1) {
							return 'Super Admin'
						}if (data == 2) {
							return 'Admin'
						}if (data == 3) {
							return 'Admin Cabang'
						}
					}
				},
				{ data: 'IdPerusahaan' },
				{ data: 'NamaPerusahaan' },
				{ data: 'NamaCabang' },
				{
					data: null,
					className: "dt-center updateUserAdmin",
					defaultContent: '<button class="btn btn-warning updateUserAdmin" data-toggle="modal" data-target="#modalUserAdmin"><i class="fa fa-pencil"></i> Update</button>',
					orderable: false
				},
				{
					data: null,
					className: "dt-center deleteUser",
					defaultContent: '<button class="btn btn-danger delete"><i class="fa fa-trash"></i> Delete</button'
				}
			]
		});

		function ruleDiv() {
			if ($("#Role").val() == '3') {
				$("#divCabang").show('show');
				$("#IdCabang").prop('disabled', false);
			}else{
				$("#divCabang").hide('hide');
				$("#IdCabang").prop('disabled', true);
			}
		};

		$("select#Role").on('change', () => {
			ruleDiv();
		});

		function validationFormAdmin(type) {
			if ($('#Username').val() == '') {
				alert("Masukan Username");
				return false;
			}else if ($('#Role').val() == '') {
				alert("Masukan Role");
				return false;
			}else if ($('#Password').val() == '') {
				if (type == 'update') {
					return true
				}
				alert("Masukan Password");
				return false;
			}else{
				return true;
			}
		}

		$("#addUserAdmin").on("click", function() {
			$('#updateFormAdmin').hide();
			$('#addFormAdmin').show();
			$('#IdUser').prop('disabled', true);
			$('#Username').val('');
			$('#Role').val('');
			$('#Password').val('');
			$('#IdCabang').val('');
			$('#IdPerusahaan').val('');
			$('#IdCabang').trigger('change');
			$('#IdPerusahaan').trigger('change');
			$('#Role').trigger('change');
			ruleDiv();
		});

		$("#addFormAdmin").on("click", function() {
			$("#addFormAdmin").prop('disabled', true);
			if (validationFormAdmin('insert') == true) {
				$.ajax({
					type: "post",
					url: "<?php echo base_url() ?>User/post_user",
					data: "IdKurir=null&Username="+$('#Username').val()+"&Password="+$('#Password').val()+"&Role="+$('#Role').val()+"&IdPerusahaan="+$('#IdPerusahaan').val()+"&IdCabang="+$("#IdCabang").val(),
					dataType: "json",
					success: function (hasil) {
						$("#addFormAdmin").prop('disabled', false);
							console.log(hasil);
						$('#modalUserAdmin').modal().hide();
						$(".modal-backdrop").remove();
						if (!hasil.message) {
							Swal.fire(
								'Berhasil!',
								'Berhasil Menambahkan = '+hasil[0].affectedRows+' Data',
								'success'
							);
							table.ajax.reload();
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: hasil.message,
							})
						}    
						$('#Username').val('');
						$('#Password').val('');
						$('#Role').val('');
						$('#IdPerusahaan').val('');
					}
				});
			} else {
				$("#addFormAdmin").prop('disabled', false);
			}
		});

		$("#myTable").on("click", 'td.updateUserAdmin', function() {
			console.log(table.row(this).data());
			const data = table.row(this).data();
			$('#updateFormAdmin').show();
			$('#addFormAdmin').hide();
			$('#IdUser').prop('disabled', false);
			$('#IdUser').val(data.IdUsers);
			$('#Username').val(data.Username);
			$('#Password').val('');
			$('#Role').val(data.Role);
			$('#IdCabang').val(data.IdCabang);
			$('#IdPerusahaan').val(data.IdPerusahaan);
			$('#IdCabang').trigger('change');
			$('#IdPerusahaan').trigger('change');
			$('#Role').trigger('change');
			ruleDiv();
		});

		$("#updateFormAdmin").on("click", function() {
			$("#updateFormAdmin").prop('disabled', true);
			if (validationFormAdmin('update') == true) {
				$.ajax({
					type: "post",
					url: "<?php echo base_url() ?>User/put_user",
					data: "IdKurir=null&IdUser="+$('#IdUser').val()+"&Username="+$('#Username').val()+"&Password="+$('#Password').val()+"&Role="+$('#Role').val()+"&IdPerusahaan="+$('#IdPerusahaan').val()+"&IdCabang="+$("#IdCabang").val(),
					dataType: "json",
					success: function (hasil) {
						$("#updateFormAdmin").prop('disabled', false);
						console.log(hasil);
						$('#modalUserAdmin').modal().hide();
						$(".modal-backdrop").remove();
						if (!hasil.message) {
							Swal.fire(
								'Berhasil!',
								'Berhasil '+hasil[0].info,
								'success'
							);
							table.ajax.reload();
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: hasil.message,
							})
						}
						$('#Username').val('');
						$('#Role').val('');
						$('#Password').val('');
						$('#IdPerusahaan').val('');
					}
				});
			} else {
				$("#updateFormAdmin").prop('disabled', false);
			}
		});

		$("#myTable").on("click", 'td.deleteUser', function() {
			console.log(table.row(this).data());
			const data = table.row(this).data();
			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						type: "post",
						url: "<?php echo base_url() ?>User/delete_User",
						data: "IdUsers="+data.IdUsers,
						dataType: "json",
						success: function (hasil) {
							if (!hasil.message) {
								Swal.fire(
									'Deleted!',
									'Your file has been deleted.',
									'success'
								);
								table.ajax.reload();
							}else{
								Swal.fire({
									icon: 'error',
									title: 'Oops...',
									text: hasil.message,
								})
							}
						}
					});
				}
			})
		})
	});
</script>
<script type="text/javascript">
	$(document).ready( function (){
		var table = $('#myTableKurir').DataTable({
			scrollX: true,
			<?php if ($this->session->userdata('Role') == 1) {?>
				ajax: '<?php echo base_url()?>User/get_user_all_kurir',
			<?php } else if ($this->session->userdata('Role') == 2) {?>
				ajax: '<?php echo base_url()?>User/get_user_kurir',
			<?php } else { ?>
				ajax: '<?php echo base_url()?>User/get_user_kurir_cabang',
			<?php } ?>
			columns: [
				{ data: 'IdUsers' },
				{ data: 'NamaKurir' },
				{ data: 'Username' },
				{ data: 'Password' },
				<?php if (($this->session->userdata('Role') == '1')) {?>
					{ data: 'IdPerusahaan' },{ data: 'NamaPerusahaan' },
				<?php } ?>
				{ data: 'IdCabang' },
				{ data: 'NamaCabang' },
				{
					data: null,
					className: "dt-center updateUserKurir",
					defaultContent: '<button class="btn btn-warning updateUserKurir" data-toggle="modal" data-target="#modalUserKurir"><i class="fa fa-pencil"></i> Update</button>',
					orderable: false
				},
				{
					data: null,
					className: "dt-center deleteUser",
					defaultContent: '<button class="btn btn-danger delete"><i class="fa fa-trash"></i> Delete</button'
				}
			]
		});

		function validationFormKurir() {
			if ($('#UsernameKurir').val() == '') {
				alert("Masukan Username");
				return false;
			}else if ($('#PasswordKurir').val() == '') {
				alert("Masukan Password");
				return false;
			}else if ($('#IdKurir').val() == '') {
				alert("Mohon Pilih Kurir");
				return false;
			}else {
				return true;
			}
		}

		$("#addUserKurir").on("click", function() {
			$('#updateFormKurir').hide();
			$('#addFormKurir').show();
			$('#kurir').show();
			$('#IdUserKurir').prop('disabled', true);
			$('#UsernameKurir').val('');
			$('#PasswordKurir').val('');
			$('#IdKurir').val('');
			$('#IdKurir').trigger('change');
		});

		$("#addFormKurir").on("click", function() {
			$("#addFormKurir").prop('disabled', true);
			if (validationFormKurir() == true) {
				$.ajax({
					type: "post",
					url: "<?php echo base_url() ?>User/post_User",
					data: "Role=null&IdPerusahaan=null&IdCabang=null&Username="+$('#UsernameKurir').val()+"&Password="+$('#PasswordKurir').val()+"&IdKurir="+$('#IdKurir').val(),
					dataType: "json",
					success: function (hasil) {
						$("#addFormKurir").prop('disabled', false);
						$('#modalUserKurir').modal().hide();
						$(".modal-backdrop").remove();
						if (!hasil.message) {
							Swal.fire(
								'Berhasil!',
								'Berhasil Menambahkan = '+hasil[0].affectedRows+' Data',
								'success'
							);
							table.ajax.reload();
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: hasil.message,
							})
						}    
						$('#Username').val('');
						$('#Password').val('');
					}
				});
			} else {
				$("#addFormKurir").prop('disabled', false);
			}
		});

		$("#myTableKurir").on("click", 'td.updateUserKurir', function() {
			console.log(table.row(this).data());
			const data = table.row(this).data();
			$('#updateFormKurir').show();
			$('#addFormKurir').hide();
			$('#kurir').hide();
			$('#IdUserKurir').prop('disabled', false);
			$('#IdUserKurir').val(data.IdUsers);
			$('#UsernameKurir').val(data.Username);
			$('#PasswordKurir').val('');
			$('#IdKurir').trigger('change');
		});

		$("#updateFormKurir").on("click", function() {
			$("#updateFormKurir").prop('disabled', true);
			if (validationFormKurir() == true) {
				$.ajax({
					type: "post",
					url: "<?php echo base_url() ?>User/put_user",
					data: "Role=null&IdPerusahaan=null&IdCabang=null&IdUser="+$('#IdUserKurir').val()+"&Username="+$('#UsernameKurir').val()+"&Password="+$('#PasswordKurir').val(),
					dataType: "json",
					success: function (hasil) {
						$("#updateFormKurir").prop('disabled', false);
						console.log(hasil);
						$('#modalUserKurir').modal().hide();
						$(".modal-backdrop").remove();
						if (!hasil.message) {
							Swal.fire(
								'Berhasil!',
								'Berhasil '+hasil[0].info,
								'success'
							);
							table.ajax.reload();
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: hasil.message,
							})
						}
						$('#Username').val('');
						$('#Role').val('');
						$('#Password').val('');
						$('#IdPerusahaan').val('');
					}
				});
			} else {
				$("#updateFormKurir").prop('disabled', false);
			}
		});

		$("#myTableKurir").on("click", 'td.deleteUser', function() {
			console.log(table.row(this).data());
			const data = table.row(this).data();
			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						type: "post",
						url: "<?php echo base_url() ?>User/delete_User",
						data: "IdUsers="+data.IdUsers,
						dataType: "json",
						success: function (hasil) {
							if (!hasil.message) {
								Swal.fire(
									'Deleted!',
									'Your file has been deleted.',
									'success'
								);
								table.ajax.reload();
							}else{
								Swal.fire({
									icon: 'error',
									title: 'Oops...',
									text: hasil.message,
								})
							}
						}
					});
				}
			})
		})
	});
</script><script type="text/javascript">
	var table = $('#myTableList').DataTable({
		<?php if ($this->session->userdata('Role') == 1) {?>
			ajax: '<?php echo base_url()?>User/get_username_all',
		<?php } else { ?>
			ajax: '<?php echo base_url()?>User/get_username',
		<?php } ?>
		columns: [
			{ data: 'Username' },
			{ 
				data: 'Role',
				render: function(data, type, row) {
					if (data == 1) {return 'Super Admin'}
						if (data == 2) {return 'Admin'}
						if (data == 3) {return 'Admin Cabang'}
						if (data == 4) {return 'Kurir'}
					}
			},
			{ data: 'NamaPerusahaan' },
			{ data: 'NamaCabang' }
		]
	});
</script>