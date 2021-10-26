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
	$(document).ready( function () {
		var data = [];

		var table = $('#tableKotaBesar').DataTable({
			dom: 'Bfrtip',
			buttons: ['excel', 'pdf', 'print',],
			ajax: '<?php echo base_url()?>Kota/get_kota_besar',
			columns: [
				{ data: 'KodeKotaBesar' },
				{ data: 'NamaKotaBesar' },
				{ data: 'CreatedBy' },
				{ data: 'CreatedOn' },
				{
					data: null,
					className: "dt-center updateKotaBesar",
					defaultContent: '<button class="btn btn-warning updateKotaBesar" data-toggle="modal" data-target="#modalKotaBesar"><i class="fa fa-pencil"></i> Ubah</button>',
					orderable: false
				},
				{
					data: null,
					className: "dt-center deleteKotaBesar",
					defaultContent: '<button class="btn btn-danger delete"><i class="fa fa-trash"></i> Hapus</button>'
				}
			]
		});

		$('#tableKotaBesar tbody').on( 'click', 'tr', function () {
			data.length = 0;
			data.push(table.row( this ).data());
			console.log( data );
			if ( $(this).hasClass('selected') ) {
				$(this).removeClass('selected');
			}else {
				table.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}
		} );

		function validation() {
			if ($('#NamaKotaBesar').val() == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: "Nama Tidak Boleh Kosong",
				});
				return false;
			} else if ($('#IdKotaBesar').val() == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: "Nama Tidak Boleh Kosong",
				});
				return false;
			} else {
				return true;
			}
		}

		$("#addKotaBesar").on("click", function() {
			$('#updateFormKotaBesar').hide();
			$('#addFormKotaBesar').show();
			$('#KodeKotaBesar').val('');
			$('#NamaKotaBesar').val('');
		});

		$("#addFormKotaBesar").on("click", function() {
			$("#addFormKotaBesar").prop('disabled',true);
			if (validation() == true) {
				$.ajax({
					type: "post",
					url: "<?php echo base_url() ?>Kota/post_kota_besar",
					data: "KodeKotaBesar="+$('#KodeKotaBesar').val()+
						  "&NamaKotaBesar="+$('#NamaKotaBesar').val(),
					dataType: "json",
					success: function (hasil) {
						$("#addFormKotaBesar").prop('disabled',false);
						table.ajax.reload();
						$('#modalKotaBesar').modal().hide();
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
					}
				});
			} else {
				$("#addFormKotaBesar").prop('disabled',false);
			}
		});

		$("#tableKotaBesar").on("click", 'td.updateKotaBesar', function() {
			console.log(table.row(this).data());
			const data = table.row(this).data();
			$('#updateFormKotaBesar').show();
			$('#addFormKotaBesar').hide();
			$('#KodeKotaBesar2').prop('disabled', false);
			$('#KodeKotaBesar2').val(data.KodeKotaBesar);
			$('#KodeKotaBesar').val(data.KodeKotaBesar);
			$('#NamaKotaBesar').val(data.NamaKotaBesar);
		});

		$("#updateFormKotaBesar").on("click", function() {
			$("#updateFormKotaBesar").prop('disabled',true);
			if (validation() == true) {
				$.ajax({
					type: "post",
					url: "<?php echo base_url() ?>Kota/put_kota_besar",
					data: "KodeKotaBesar2="+$('#KodeKotaBesar2').val()+
						  "&KodeKotaBesar="+$('#KodeKotaBesar').val()+
						  "&NamaKotaBesar="+$('#NamaKotaBesar').val(),
					dataType: "json",
					success: function (hasil) {
						$("#updateFormKotaBesar").prop('disabled',false);
						console.log(hasil);
						$('#modalKotaBesar').modal().hide();
						$(".modal-backdrop").remove();
						if (!hasil.message) {Swal.fire('Berhasil!','Berhasil '+hasil[0].info,'success');
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
			} else {
				$("#updateFormKotaBesar").prop('disabled',false);
			}
		});

		$("#tableKotaBesar").on("click", 'td.deleteKotaBesar', function() {
			console.log(table.row(this).data());
			const data = table.row(this).data();
			Swal.fire({
				title: 'Konfirmasi',
				text: "Apakah Anda Yakin Ingin Menghapus Data?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						type: "post",
						url: "<?php echo base_url() ?>Kota/delete_kota_besar",
						data: "KodeKotaBesar="+data.KodeKotaBesar,
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
	$(document).ready( function () {
		$('select').select2({
			theme: 'classic'
		});
		var data = [];
		$("#KodeKotaBesar3").on('change',function(){
			console.log($(this).find(':selected').data());
			$('#NamaKotaBesar3').val($(this).find(':selected').data('namakotabesar'));
		});

		var table = $('#tableKota').DataTable({
			dom: 'Bfrtip',
			buttons: ['excel', 'pdf', 'print',],
			ajax: '<?php echo base_url()?>Kota/get_kota',
			columns: [
				{ data: 'KodeKota' },
				{ data: 'NamaKota' },
				{ data: 'NamaKotaBesar' },
				{ data: 'CreatedBy' },
				{ data: 'CreatedOn' },
				{
					data: null,
					className: "dt-center updateKota",
					defaultContent: '<button class="btn btn-warning updateKota" data-toggle="modal" data-target="#modalKota"><i class="fa fa-pencil"></i> Ubah</button>',orderable: false
				},
				{
					data: null,
					className: "dt-center deleteKota",
					defaultContent: '<button class="btn btn-danger delete"><i class="fa fa-trash"></i> Hapus</button>'
				}
			]
		});

		$('#tableKota tbody').on( 'click', 'tr', function () {
			data.length = 0;
			data.push(table.row( this ).data());
			console.log( data );
			if ( $(this).hasClass('selected') ) {
				$(this).removeClass('selected');
			}else {
				table.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}
		} );

		function validation() {
			if ($('#NamaKota').val() == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: "Nama Kota Tidak Boleh Kosong",
				});
				return false;
			} else if ($('#KodeKotaBesar3').val() == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: "Mohon Pilih Kode Kota Besar",
				});
				return false;
			} else if ($('#KodeKota').val() == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: "Kode Kota Tidak Boleh Kosong",
				});
				return false;
			} else {
				return true;
			}
		}

		$("#addKota").on("click", function() {
			$('#KodeKota2').prop('disabled', true);
			$('#updateFormKota').hide();
			$('#addFormKota').show();
			$('#NamaKota').val('');
			$('#KodeKotaBesar3').val('');
			$('#KodeKotaBesar3').trigger('change');
			$("#KodeKota").val('');
		});

		$("#addFormKota").on("click", function() {
			$("#addFormKota").prop('disabled',true);
			if (validation() == true) {
				$.ajax({
					type: "post",
					url: "<?php echo base_url() ?>Kota/post_kota",
					data: "NamaKota="+$('#NamaKota').val()+
						  "&KodeKotaBesar3="+$('#KodeKotaBesar3').val()+
						  "&KodeKota="+$('#KodeKota').val(),
					dataType: "json",
					success: function (hasil) {
						$("#addFormKota").prop('disabled',false);
						table.ajax.reload();
						$('#modalKota').modal().hide();
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
					}
				});
			} else {
				$("#addFormKota").prop('disabled',false);
			}
		});

		$("#tableKota").on("click", 'td.updateKota', function() {
			console.log(table.row(this).data());
			const data = table.row(this).data();
			$('#updateFormKota').show();
			$('#addFormKota').hide();
			$('#KodeKota2').prop('disabled', false);
			$('#KodeKota2').val(data.KodeKota);
			$('#KodeKota').val(data.KodeKota);
			$('#NamaKota').val(data.NamaKota);
			$('#KodeKotaBesar3').val(data.KodeKotaBesar);
			$('#KodeKotaBesar3').trigger('change');
		});

		$("#updateFormKota").on("click", function() {
			$("#updateFormKota").prop('disabled',true);
			if (validation() == true) {
				$.ajax({
					type: "post",
					url: "<?php echo base_url() ?>Kota/put_kota",
					data: "KodeKota2="+$('#KodeKota2').val()+
						  "&KodeKota="+$('#KodeKota').val()+
						  "&NamaKota="+$('#NamaKota').val()+
						  "&KodeKotaBesar3="+$('#KodeKotaBesar3').val(),
					dataType: "json",
					success: function (hasil) {
						$("#updateFormKota").prop('disabled',false);
						console.log(hasil);
						$('#modalKota').modal().hide();
						$(".modal-backdrop").remove();
						if (!hasil.message) {Swal.fire('Berhasil!','Berhasil '+hasil[0].info,'success');
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
			} else {
				$("#updateFormKota").prop('disabled',false);
			}
		});

		$("#tableKota").on("click", 'td.deleteKota', function() {
			console.log(table.row(this).data());
			const data = table.row(this).data();
			Swal.fire({
				title: 'Konfirmasi',
				text: "Apakah Anda Yakin Ingin Menghapus Data?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						type: "post",
						url: "<?php echo base_url() ?>Kota/delete_Kota",
						data: "KodeKota="+data.KodeKota,
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