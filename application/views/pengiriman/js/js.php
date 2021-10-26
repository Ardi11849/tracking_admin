<script src="<?php echo base_url()?>template/jquery.min.js"></script>
<script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.base.js"></script>
<script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.addons.js"></script>
<script src="<?php echo base_url()?>template/DataTables/datatables.js"></script>
<script src="<?php echo base_url()?>template/bootstrap-select/select.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="<?php echo base_url()?>template/assets/js/shared/off-canvas.js"></script>
<script src="<?php echo base_url()?>template/assets/js/shared/misc.js"></script>
<script src="<?php echo base_url()?>template/assets/js/demo_1/dashboard.js"></script>
<script src="<?php echo base_url()?>template/jQuery-Mask-Plugin-master/src/jquery.mask.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
	$(document).ready( function () {

		$('select').select2({
			theme: 'classic'
		});

		$('.number').mask('00-0000-0000-000');

		var table = $('#myTable').DataTable({
			<?php if ($this->session->userdata('Role') == '1') {?>
				ajax: '<?php echo base_url()?>Pengiriman/get_all',
			<?php } else {?>
				ajax: '<?php echo base_url()?>Pengiriman/get_createdby',
			<?php } ?>
			scrollX: true,
			columns: [ 
				{ 
					"data": null,
					"sortable": false,
			    	render: function (data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
			    },
				{data: 'NoResi' },
				{ data: 'NamaPerusahaan' },
				{ data: 'NamaCabang' },
				{ data: 'Pengirim' },
				{ data: 'AlamatPengirim' },
				{ data: 'NoTelpPengirim' },
				{ data: 'Penerima' },
				{ data: 'NoTelpPenerima' },
				{ data: 'NamaKotaBesar' },
				{ data: 'NamaKota' },
				{ data: 'AlamatPenerima' },
			 	{ 
			 		data: 'Status',
			 		render: function(data, type, row) {
			 			if (data === '0') {return 'Pengiriman Di Batalkan'}
			 			if (data === '1') {return 'Terkirim'}
			 			if (data === '2') {return 'Pengiriman Kurir'}
			 			if (data === '3') {return 'Di Terima Oleh Cabang'}
			 			if (data === '4') {return 'Pengiriman Ke Cabang'}
			 			if (data === '5') {return 'Belum Di Proses'}
			 		}
			 	},
				{ data: 'CreatedOn' },
				{
					data: null,
					className: "dt-center updatePengiriman",
					defaultContent: '<button class="btn btn-warning updatePengiriman" data-toggle="modal" data-target="#modalPengiriman"><i class="fa fa-pencil"></i> Update</button>',
					orderable: false
				},

				{
					data: null,
					className: "dt-center deletePengiriman",
					defaultContent: '<button class="btn btn-danger delete"><i class="fa fa-trash"></i> Delete</button'
				}
			]
		});

		$.fn.dataTable.ext.errMode = 'none';

		function validation() {
			if ($('#NoResi').val() == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: "No Resi Tidak Boleh Kosong",
				});
				return false;
			}else if ($('#Pengirim').val() == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: "Nama Pengirim Tidak Boleh Kosong",

				});
				return false;
			}else if ($('#AlamatPengirim').val() == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: "Alamat Pengirim Tidak Boleh Kosong",

				});
				return false;
			}else if($('#NoTelpPengirim').val() == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: "No Handphone Pengirim Tidak Boleh Kosong",
				});
				return false;
			}else if ($('#Penerima').val() == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: "Nama Penerima Tidak Boleh Kosong",
				});
				return false;
			}else if ( $('#NoTelpPenerima').val() == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: "No Handphone Penerima Tidak Boleh Kosong",
				});
				return false;
			}else if ($('#IdProvinsi').val() == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: "Provinsi Tidak Boleh Kosong",
				});
				return false;
			}else if ($('#IdKabupaten').val() == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: "Kabupaten Atau Kota Tidak Boleh Kosong",
				});
				return false;
			}else if ($('#IdKecamatan').val() == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: "Kecamatan Tidak Boleh Kosong",
				});
				return false;
			}else if ($('#IdDesa').val() == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: "Desa Tidak Boleh Kosong",
				});
				return false;
			}else if ($('#AlamatPenerima').val() == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: "Alamat Penerima Tidak Boleh Kosong",
				});
				return false;
			}else if ($('#Status').val() == '') {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: "Mohon Pilih Status",
				});
				return false;
			}else{
				return true;
			}
		}

		function hideWilayah() {
			$("#divKabupaten").hide();
			$("#divKecamatan").hide();
			$("#divDesa").hide();
		}

		function showWilayah() {
			$("#divKabupaten").show();
			$("#divKecamatan").show();
			$("#divDesa").show();
		}

		function ajaxGetKota(update, kodekota) {
			$("select#KodeKota").val('');
			let option = new Option("Pilih Kota",'',false,false);
			$("select#KodeKota").html(option);
			$.ajax({
				type: "post",
				url: "<?php echo base_url();?>Kota/get_kota_bykkb",
				data: "KodeKotaBesar="+$("#KodeKotaBesar").val(),
				dataType: "json",
				success: function(hasil){
					for (let i = hasil.data.length - 1; i >= 0; i--) {
						console.log(hasil.data[i].NamaKota);
						let option = new Option(hasil.data[i].NamaKota,hasil.data[i].KodeKota,false,false);
						$("select#KodeKota").append(option);
					}
					if (update = true) {
						$('#KodeKota').val(kodekota);
						$('#KodeKota').trigger('change');
					}
				},
			    error: function (jqXHR, exception) {
			        var msg = '';
			        if (jqXHR.status === 0) {
			            msg = 'Not connect.\n Verify Network.';
			        } else if (jqXHR.status == 404) {
			            msg = 'Requested page not found. [404]';
			        } else if (jqXHR.status == 500) {
			            msg = 'Internal Server Error [500].';
			        } else if (exception === 'parsererror') {
			            msg = 'Requested JSON parse failed.';
			        } else if (exception === 'timeout') {
			            msg = 'Time out error.';
			        } else if (exception === 'abort') {
			            msg = 'Ajax request aborted.';
			        } else {
			            msg = 'Uncaught Error.\n' + jqXHR.responseText;
			        }
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: msg,
					});
			    },
			});
		}

		$("select#KodeKotaBesar").on("change", function() {
			ajaxGetKota(false);
		});

		$("select#IdProvinsi").on("change", function() {
			$("select#IdKabupaten").val('');
			let option = new Option("Pilih Kabupaten",'',false,false);
			$("select#IdKabupaten").html(option);
			$.ajax({
				type: "post",
				url: "<?php echo base_url();?>Pengiriman/get_kabupaten",
				data: "IdProvinsi="+$("#IdProvinsi").val(),
				dataType: "json",
				success: function(hasil){
					for (let i = hasil.data.length - 1; i >= 0; i--) {
						let option = new Option(hasil.data[i].Namakabupaten,hasil.data[i].Idkabupaten,false,false);
						$("select#IdKabupaten").append(option);
					}
					$("#divKabupaten").show('show');
				},
			    error: function (jqXHR, exception) {
			        var msg = '';
			        if (jqXHR.status === 0) {
			            msg = 'Not connect.\n Verify Network.';
			        } else if (jqXHR.status == 404) {
			            msg = 'Requested page not found. [404]';
			        } else if (jqXHR.status == 500) {
			            msg = 'Internal Server Error [500].';
			        } else if (exception === 'parsererror') {
			            msg = 'Requested JSON parse failed.';
			        } else if (exception === 'timeout') {
			            msg = 'Time out error.';
			        } else if (exception === 'abort') {
			            msg = 'Ajax request aborted.';
			        } else {
			            msg = 'Uncaught Error.\n' + jqXHR.responseText;
			        }
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: msg,
					});
			    },
			});
		});

		$("select#IdKabupaten").on("change", function() {
			$("select#IdKecamatan").val('');
			let option = new Option("Pilih Kecamatan",'',false,false);
			$("select#IdKecamatan").html(option);
			$.ajax({
				type: "post",
				url: "<?php echo base_url();?>Pengiriman/get_kecamatan",
				data: "IdKabupaten="+$("#IdKabupaten").val(),
				dataType: "json",
				success: function(hasil){
					for (let i = hasil.data.length - 1; i >= 0; i--) {
						let option = new Option(hasil.data[i].Namakecamatan,hasil.data[i].Idkecamatan,false,false);
						$("select#IdKecamatan").append(option);
					}
					$("#divKecamatan").show('show');
				},
			    error: function (jqXHR, exception) {
			        var msg = '';
			        if (jqXHR.status === 0) {
			            msg = 'Not connect.\n Verify Network.';
			        } else if (jqXHR.status == 404) {
			            msg = 'Requested page not found. [404]';
			        } else if (jqXHR.status == 500) {
			            msg = 'Internal Server Error [500].';
			        } else if (exception === 'parsererror') {
			            msg = 'Requested JSON parse failed.';
			        } else if (exception === 'timeout') {
			            msg = 'Time out error.';
			        } else if (exception === 'abort') {
			            msg = 'Ajax request aborted.';
			        } else {
			            msg = 'Uncaught Error.\n' + jqXHR.responseText;
			        }
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: msg,
					});
			    },
			});
		});

		$("select#IdKecamatan").on("change", function() {
			$("select#IdDesa").val('');
			let option = new Option("Pilih Desa",'',false,false);
			$("select#IdDesa").html(option);
			$.ajax({
				type: "post",
				url: "<?php echo base_url();?>Pengiriman/get_desa",
				data: "IdKecamatan="+$("#IdKecamatan").val(),
				dataType: "json",
				success: function(hasil){
					for (let i = hasil.data.length - 1; i >= 0; i--) {
						let option = new Option(hasil.data[i].NamaDesa,hasil.data[i].IdDesa,false,false);
						$("select#IdDesa").append(option);
					}
					$("#divDesa").show('show');
				},
			    error: function (jqXHR, exception) {
			        var msg = '';
			        if (jqXHR.status === 0) {
			            msg = 'Not connect.\n Verify Network.';
			        } else if (jqXHR.status == 404) {
			            msg = 'Requested page not found. [404]';
			        } else if (jqXHR.status == 500) {
			            msg = 'Internal Server Error [500].';
			        } else if (exception === 'parsererror') {
			            msg = 'Requested JSON parse failed.';
			        } else if (exception === 'timeout') {
			            msg = 'Time out error.';
			        } else if (exception === 'abort') {
			            msg = 'Ajax request aborted.';
			        } else {
			            msg = 'Uncaught Error.\n' + jqXHR.responseText;
			        }
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: msg,
					});
			    },
			});
		});

		$("#addPenerimaan").on("click", function() {
			hideWilayah();
			$('#updateForm').hide();
			$('#addForm').show();
			$('#NoResi').val('');
			$('#IdPerusahaan').val('');
			$('#IdCabang').val('');
			$('#IdPerusahaan').trigger('change');
			$('#IdCabang').trigger('change');
			$('#Pengirim').val('');
			$('#AlamatPengirim').val('');
			$('#NoTelpPengirim').val('');
			$('#Penerima').val('');
			$('#NoTelpPenerima').val('');
			$('#IdProvinsi').val('');
			$('#IdKabupaten').val('');
			$('#IdKecamatan').val('');
			$('#IdDesa').val('');
			$('#KodeKotaBesar').val('');
			$('#KodeKota').val('');
			$('#IdProvinsi').trigger('change');
			$('#IdKabupaten').trigger('change');
			$('#IdKecamatan').trigger('change');
			$('#IdDesa').trigger('change');
			$('#KodeKotaBesar').trigger('change');
			$('#KodeKota').trigger('change');
			$('#AlamatPenerima').val('');
			$('#Status').val('');
			$('#Status').trigger('change');
		});

		$("#addForm").on("click", function() {
			$('#addForm').prop('disabled', true);
			if (validation() == true) {
				$.ajax({
					type: "post",
					url: "<?php echo base_url() ?>Pengiriman/post",
					data: "NoResi="+$('#NoResi').val()+
						  "&IdPerusahaan="+$('#IdPerusahaan').val()+
						  "&IdCabang="+$('#IdCabang').val()+
						  "&Pengirim="+$('#Pengirim').val()+
						  "&AlamatPengirim="+$('#AlamatPengirim').val()+
						  "&NoTelpPengirim="+$('#NoTelpPengirim').val()+
						  "&Penerima="+$('#Penerima').val()+
						  "&NoTelpPenerima="+$('#NoTelpPenerima').val()+
						  "&IdProvinsi="+$('#IdProvinsi').val()+
						  "&IdKabupaten="+$('#IdKabupaten').val()+
						  "&IdKecamatan="+$('#IdKecamatan').val()+
						  "&IdDesa="+$('#IdDesa').val()+
						  "&KodeKotaBesar="+$('#KodeKotaBesar').val()+
						  "&KodeKota="+$('#KodeKota').val()+
						  "&AlamatPenerima="+$('#AlamatPenerima').val()+
						  "&Status="+$('#Status').val(),
					dataType: "json",
					success: function (hasil) {
						$('#addForm').prop('disabled', false);
						$('#modalPengiriman').modal().hide();
						$(".modal-backdrop").remove();
						if (!hasil.message) {
							Swal.fire('Berhasil!','Berhasil Menambahkan = '+hasil[0].affectedRows+' Data','success');
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
				$('#addForm').prop('disabled', false);
			}
		});

		$("#myTable").on("click", 'td.updatePengiriman', function() {
			console.log(table.row(this).data());
			showWilayah();
			const data = table.row(this).data();
			$('#updateForm').prop('disabled', false);
			$('#updateForm').show();
			$('#addForm').hide();
			$('#NoResi2').val(data.NoResi);
			$('#NoResi').val(data.NoResi);
			$('#IdPerusahaan').val(data.IdPerusahaan);
			$('#IdPerusahaan').trigger('change');
			$('#KodeKotaBesar').val(data.KodeKotaBesar);
			$('#KodeKotaBesar').trigger('change');
			$('#IdCabang').val(data.IdCabang);
			$('#IdCabang').trigger('change');
			$('#Pengirim').val(data.Pengirim);
			$('#AlamatPengirim').val(data.AlamatPengirim);
			$('#NoTelpPengirim').val(data.NoTelpPengirim);
			$('#Penerima').val(data.Penerima);
			$('#NoTelpPenerima').val(data.NoTelpPenerima);
			$('#IdProvinsi').val(data.IdProvinsi);
			$('#IdKabupaten').val(data.IdKabupaten);
			$('#IdKecamatan').val(data.IdKecamatan);
			$('#IdDesa').val(data.IdDesa);
			ajaxGetKota(true, data.KodeKota);
			$('#IdProvinsi').trigger('change');
			$('#IdKabupaten').trigger('change');
			$('#IdKecamatan').trigger('change');
			$('#IdDesa').trigger('change');
			$('#AlamatPenerima').val(data.AlamatPenerima);
			$('#Status').val(data.Status);
			$('#Status').trigger('change');
		});

		$("#updateForm").on("click", function() {
			$('#updateForm').prop('disabled', true);
			if (validation() == true) {
				$.ajax({
					type: "post",
					url: "<?php echo base_url() ?>Pengiriman/put",
					data: "NoResi2="+$('#NoResi2').val()+
						  "&NoResi="+$('#NoResi').val()+
						  "&IdPerusahaan="+$('#IdPerusahaan').val()+
						  "&IdCabang="+$('#IdCabang').val()+
						  "&Pengirim="+$('#Pengirim').val()+
						  "&AlamatPengirim="+$('#AlamatPengirim').val()+
						  "&NoTelpPengirim="+$('#NoTelpPengirim').val()+
						  "&Penerima="+$('#Penerima').val()+
						  "&NoTelpPenerima="+$('#NoTelpPenerima').val()+
						  "&IdProvinsi="+$('#IdProvinsi').val()+
						  "&IdKabupaten="+$('#IdKabupaten').val()+
						  "&IdKecamatan="+$('#IdKecamatan').val()+
						  "&IdDesa="+$('#IdDesa').val()+
						  "&KodeKotaBesar="+$('#KodeKotaBesar').val()+
						  "&KodeKota="+$('#KodeKota').val()+
						  "&AlamatPenerima="+$('#AlamatPenerima').val()+
						  "&Status="+$('#Status').val(),
					dataType: "json",
					success: function (hasil) {
						$('#updateForm').prop('disabled', false);
						$('#modalPengiriman').modal().hide();
						$(".modal-backdrop").remove();
						if (!hasil.message) {
							Swal.fire('Berhasil!','Berhasil '+hasil[0].info,'success');
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
				$('#updateForm').prop('disabled', false);
			}
		});

		$("#myTable").on("click", 'td.deletePengiriman', function() {
			console.log(table.row(this).data());
			const data = table.row(this).data();
			$('td.deletePengiriman').prop('disabled', true);
			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				$('td.deletePengiriman').prop('disabled', false);
				if (result.isConfirmed) {
					$.ajax({
						type: "post",
						url: "<?php echo base_url() ?>Pengiriman/delete",
						data: "NoResi="+data.NoResi,
						dataType: "json",
						success: function (hasil) {
							$('td.deletePengiriman').prop('disabled', false);
							if (!hasil.message) {
								Swal.fire('Deleted!','Your file has been deleted.','success');
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
		});
	})
</script>
<script type="text/javascript">

		var table = $('#myTableFromManifest').DataTable({
			<?php if ($this->session->userdata('Role') == '1') {?>
				ajax: '<?php echo base_url()?>Pengiriman/get_all',
			<?php } elseif ($this->session->userdata('Role') == '2') {?>
				ajax: '<?php echo base_url()?>Pengiriman/get',
			<?php } else {?>
				ajax: '<?php echo base_url()?>Pengiriman/get_cabang',
			<?php } ?>
			scrollX: true,
			columns: [ 
				{ 
					"data": null,
					"sortable": false,
			    	render: function (data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
			    },
				{data: 'NoResi' },
				{ data: 'NamaPerusahaan' },
				{ data: 'NamaCabang' },
				{ data: 'Pengirim' },
				{ data: 'AlamatPengirim' },
				{ data: 'NoTelpPengirim' },
				{ data: 'Penerima' },
				{ data: 'NoTelpPenerima' },
				{ data: 'NamaKotaBesar' },
				{ data: 'NamaKota' },
				{ data: 'AlamatPenerima' },
			 	{ 
			 		data: 'Status',
			 		render: function(data, type, row) {
			 			if (data === '0') {return 'Pengiriman Di Batalkan'}
			 			if (data === '1') {return 'Terkirim'}
			 			if (data === '2') {return 'Pengiriman Kurir'}
			 			if (data === '3') {return 'Di Terima Oleh Cabang'}
			 			if (data === '4') {return 'Pengiriman Ke Cabang'}
			 			if (data === '5') {return 'Belum Di Proses'}
			 		}
			 	},
				{ data: 'CreatedOn' },
				{
					data: null,
					className: "dt-center updatePengiriman",
					defaultContent: '<button class="btn btn-warning updatePengiriman" data-toggle="modal" data-target="#modalPengiriman"><i class="fa fa-pencil"></i> Update</button>',
					orderable: false
				},

				{
					data: null,
					className: "dt-center deletePengiriman",
					defaultContent: '<button class="btn btn-danger delete"><i class="fa fa-trash"></i> Delete</button'
				}
			]
		});
</script>