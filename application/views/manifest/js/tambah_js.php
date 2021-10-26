<script src="<?php echo base_url()?>template/jquery.min.js"></script>
<script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.base.js"></script>
<script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.addons.js"></script>
<script src="<?php echo base_url()?>template/DataTables/datatables.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="<?php echo base_url()?>template/assets/js/shared/off-canvas.js"></script>
<script src="<?php echo base_url()?>template/assets/js/shared/misc.js"></script>
<script src="<?php echo base_url()?>template/datepicker/src/js/datepicker.js"></script>
<script src="<?php echo base_url()?>template/assets/js/demo_1/dashboard.js"></script>
<script src="<?php echo base_url()?>template/jQuery-Mask-Plugin-master/src/jquery.mask.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
	$('select').select2({
		theme: 'classic'
	});
	$('.tanggal').mask('0000-00-00');
	$("#Tanggal").datepicker({
		"setDate": new Date(),
		format: 'yyyy-mm-dd'
	});
	$("#isiTable").hide();

	function ajaxGetKota(type, kodekotabesar) {
		$.ajax({
			type: "post",
			url: "<?php echo base_url();?>Kota/get_kota_bykkb",
			data: "KodeKotaBesar="+kodekotabesar,
			dataType: "json",
			success: function(hasil){
				if (type == 1) {
					for (let i = hasil.data.length - 1; i >= 0; i--) {
						let option = new Option(hasil.data[i].NamaKota,hasil.data[i].KodeKota,false,false);
						$("select#KotaTujuan").append(option);
					}
				} else {
					for (let i = hasil.data.length - 1; i >= 0; i--) {
						let option = new Option(hasil.data[i].NamaKota,hasil.data[i].KodeKota,false,false);
						$("select#KotaTransit").append(option);
					}
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
		$("select#KotaTujuan").val('');
		let option = new Option("Pilih Kota",'',false,false);
		$("select#KotaTujuan").html(option);
		ajaxGetKota(1, $("#KodeKotaBesar").val());
	});

	$("select#KotaBesarTransit").on("change", function() {
		$("select#KotaTransit").val('');
		let option = new Option("Pilih Kota",'',false,false);
		$("select#KotaTransit").html(option);
		ajaxGetKota(2, $("#KotaBesarTransit").val());
	});

	$("select#Perusahaan").on("change", function() {
		$("select#Cabang").val('');
		let option = new Option("Pilih Penerima",'',false,false);
		$("select#Cabang").html(option);
		$.ajax({
			type: "post",
			url: "<?php echo base_url();?>Cabang/get_cabang_input",
			data: "IdPerusahaan="+$("#Perusahaan").val(),
			dataType: "json",
			success: function(hasil){
				for (let i = hasil.data.length - 1; i >= 0; i--) {
					let option = new Option(hasil.data[i].Nama,hasil.data[i].IdCabang,false,false);
					$("select#Cabang").append(option);
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
	});

	function validation() {
		if ($('#KodeKotaBesar').val() == '') {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: "Kota Besar Tidak Boleh Kosong",
			});
			return false;
		}else if ($('#KodeKota').val() == '') {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: "KodeKota Atau Kota Tidak Boleh Kosong",
			});
			return false;
		}else if ($('#Tanggal').val() == '') {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: "Tanggal Tidak Boleh Kosong",
			});
			return false;
		}else{
			return true;
		}
	}

	var table;

	function dataTable(tanggal, kodekotabesar, kodekota) {
		$('#table').DataTable().clear();
		$('#table').DataTable().destroy();
		table = $("#table").DataTable({
					scrollX: true,
					ajax: {
						url: '<?php echo base_url()?>pengiriman/get_by_wilayah',
						type: 'POST',
						data: {
							"CreatedOn": tanggal,
							"KodeKotaBesar": kodekotabesar,
							"KodeKota": kodekota
						}
					},
					columns:[
						{ data: 'NoResi' },
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
						{ data: 'CreatedOn' },
					]
				});
		$("#isiTable").show("show");
	}

	$("#search").on("click", function () {
		if (validation() == true) {
			dataTable($("#Tanggal").val(), $("#KodeKotaBesar").val(), $("#KotaTujuan").val());
		} else {

		}
	});

	function validationSave() {
		if ($('#NoManifest').val() == '') {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: "Nomor Manifest TransitTidak Boleh Kosong",
			});
			return false;
		}else if ($('#KotaBesarTransit').val() == '') {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: "Kota Besar TransitTidak Boleh Kosong",
			});
			return false;
		}else if ($('#KotaTransit').val() == '') {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: "Kota Transit Tidak Boleh Kosong",
			});
			return false;
		}else if ($('#Cabang').val() == '') {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: "Penerima Manifest Tidak Boleh Kosong",
			});
			return false;
		}else{
			return true;
		}
	}

	$("#save").on("click", function () {
		$('button').prop('disabled', true);
		console.log($("#table tbody tr").text());
		if ($("#table tbody tr").text() == '' || $("#table tbody tr").text() == 'No data available in table') {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: "Belum Ada Data",
			});
			$('button').prop('disabled', false);
		}else if (validationSave() == true) {
			var fromTable = table.rows().data();
			var data = [];
			var IdPerusahaan = $("#Perusahaan").val();
			if (IdPerusahaan == null ||IdPerusahaan == undefined || IdPerusahaan == 'null' || IdPerusahaan == 'undefined' || IdPerusahaan == '') {
				IdPerusahaan = "<?php echo $this->session->userdata("IdPerusahaan");?>"
			}
			for (var i = fromTable.length - 1; i >= 0; i--) {
				data.push({
					NoManifest: $("#NoManifest").val(),
					NoResi: fromTable[i].NoResi,
					IdPerusahaan: IdPerusahaan,
					IdCabang: $("#Cabang").val(),
					KodeKotaBesar: $("#KotaBesarTransit").val(),
					KodeKota: $("#KotaTransit").val(),
					CreatedBy: "<?php echo $this->session->userdata("Id");?>"
				});
			}
			$.ajax({
				type: "post",
				url: "<?php echo base_url()?>Manifest/add",
				data: {data: data},
				dataType: 'json',
				success: function (hasil) {
					$('button').prop('disabled',false);
					if (!hasil.message) {
						Swal.fire({
							title: 'Berhasil',
							text: 'Berhasil Menambahkan = '+hasil[0].affectedRows+' Data',
							icon: 'success',
							showCancelButton: false,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'ok'
						}).then((result) => {
							if (result.isConfirmed) {
								window.location.replace("<?php echo base_url()?>Manifest");
							}
						})
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: hasil.message,
						})
					}
				}
			});
		}else{
			$('button').prop('disabled', false);
		}
	})
</script>