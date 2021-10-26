<script src="<?php echo base_url()?>template/jquery.min.js"></script>
<script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.base.js"></script>
<script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.addons.js"></script>
<script src="<?php echo base_url()?>template/DataTables/datatables.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="<?php echo base_url()?>template/assets/js/shared/off-canvas.js"></script>
<script src="<?php echo base_url()?>template/assets/js/shared/misc.js"></script>
<script src="<?php echo base_url()?>template/assets/js/demo_1/dashboard.js"></script>
<script type="text/javascript">
	$("#rowTablePengiriman").hide();
	$("#rowTablePenerimaan").hide();
	var table;
	function datatable(idTable, noManifest) {
		$(idTable).DataTable().clear();
		$(idTable).DataTable().destroy();

		table = $(idTable).DataTable({
			ajax: {
				url: '<?php echo base_url()?>Manifest/get_manifest_by_nomanifest',
				type: 'POST',
				data: {
					"NoManifest": noManifest
				}
			},
			scrollX: true,
			columns: [
				{ 
					"data": null,
					"sortable": false,
			    	render: function (data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
			    },
				{ data: 'NoManifest' },
				{ data: 'NoResi' },
				{ data: 'Tujuan' },
				{ data: 'Penerima' },
				{ data: 'NoSMU' },
				{ data: 'PengirimanDari' },
				{ data: 'CreatedOn' },
	            {
	                data:   "Status",
	                render: function ( data, type, row ) {
	                    if ( type === 'display' ) {
	                        return '<input type="checkbox" class="editor-active" onClick="this.checked=!this.checked;">';
	                    }
	                    return data;
	                },
	                className: "dt-body-center"
            	}
			],
	        rowCallback: function ( row, data ) {
	            // Set the checked state of the checkbox in the table
	            $('input.editor-active', row).prop( 'checked', data.Status == 1 );
        	}
		});

	    $(idTable+' tbody').on( 'click', 'tr', function () {
	        $(this).toggleClass('selected');
	        const checkbox = $(this).find('input.editor-active')
	        if (checkbox.prop('checked') == true) {
	        	checkbox.prop('checked', false);
	        } else {
	        	checkbox.prop('checked', true)
	        }
	    } );
	}

	$.fn.dataTable.ext.errMode = 'none';

	function ajaxKonfirmasi(id) {
		Swal.fire({
			title: 'Apakah anda yakin?',
			text: "Apakah Anda Yakin Ingin Konfirmasi Pengiriman!",
			icon: 'success',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Konfirmasi!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: "post",
					url: "<?php echo base_url() ?>Manifest/konfirmasi",
					data: "IdKurir="+id,
					dataType: "json",
					success: function (hasil) {
						if (!hasil.message) {
							Swal.fire(
								'Berhasil!',
								'Pengiriman Berhasil Di Konfirmasi.',
								'success'
							);
							$('#isiDiv').load(window.location.href + "#isiDiv" );
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
	}

	function ajaxCancel(id) {
		Swal.fire({
			title: 'Apakah anda yakin?',
			text: "Apakah Anda Yakin Ingin Memebatalkan Pengiriman!",
			icon: 'success',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Batalkan!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: "post",
					url: "<?php echo base_url() ?>Manifest/cancel",
					data: "NoManifest="+id,
					dataType: "json",
					success: function (hasil) {
						if (!hasil.message) {
							Swal.fire(
								'Berhasil!',
								'Pengiriman Berhasil Di Batalkan.',
								'success'
							);
							$('#isiDiv').load(window.location.href + "#isiDiv" );
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: hasil.message,
							})
						}}
					});
			}
		})
	}

	$("button.konfirmasiPengiriman").click(function() {
		$("#tablePenerimaan").DataTable().clear();
		$("#tablePenerimaan").DataTable().destroy();
		$("#rowTablePenerimaan").hide();
		$("#rowTablePengiriman").show("show");
		datatable("#tablePengiriman", $(this).data('id'));
		// ajaxKonfirmasi($(this).data('id'));
	});
	$("#cancelTablePengiriman").on('click', function () {
		$("#rowTablePengiriman").hide('hide');
	})
	$("#savePengiriman").on('click', function () {
		var data = table.rows('.selected').data(); 
		if (data.length <= 0) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'tidak ada data yang di pilih',
			})
		} else {
			var json = [];
			for (var i = data.length - 1; i >= 0; i--) {
				json.push({
					NoManifest: data[i].NoManifest,
					NoResi: data[i].NoResi,
					Tujuan: data[i].Tujuan,
					NoSMU: data[i].NoSMU,
					Penerima: data[i].Penerima,
					PengirimDari: data[i].PengirimDari,
					ModifiedBy: "<?php echo $this->session->userdata("Id");?>"
				});
			}
			$.ajax({
				type: "post",
				url: "<?php echo base_url()?>Manifest/konfirmasi_by_noresi",
				data: {data: json},
				dataType: "json",
				success: function (hasil) {
					if (!hasil.message) {
						Swal.fire(
							'Berhasil!',
							'Pengiriman Berhasil Di Konfirmasi.',
							'success'
						);
						$('#isiDiv').load(window.location.href + "#isiDiv" );
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: hasil.message,
						})
					}
				}
			})
	    }
	});
	$(".cancelPengiriman").on('click', function() {
		ajaxCancel($(this).data('id'));
	});


	
	$("button.konfirmasiPenerimaan").on('click', function() {
		$("#tablePengiriman").DataTable().clear();
		$("#tablePengiriman").DataTable().destroy();
		$("#rowTablePengiriman").hide();
		$("#rowTablePenerimaan").show("show");
		datatable("#tablePenerimaan", $(this).data('id'));
	});
	$("#savePenerimaan").on('click', function () {
		var data = table.rows('.selected').data(); 
		if (data.length <= 0) {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'tidak ada data yang di pilih',
			})
		} else {
			var json = [];
			for (var i = data.length - 1; i >= 0; i--) {
				json.push({
					NoManifest: data[i].NoManifest,
					NoResi: data[i].NoResi,
					Tujuan: data[i].Tujuan,
					NoSMU: data[i].NoSMU,
					Penerima: data[i].Penerima,
					PengirimDari: data[i].PengirimDari,
					ModifiedBy: "<?php echo $this->session->userdata("Id");?>"
				});
			}
			$.ajax({
				type: "post",
				url: "<?php echo base_url()?>Manifest/konfirmasi_by_noresi",
				data: {data: json},
				dataType: "json",
				success: function (hasil) {
					if (!hasil.message) {
						Swal.fire(
							'Berhasil!',
							'Pengiriman Berhasil Di Konfirmasi.',
							'success'
						);
						$('#isiDiv').load(window.location.href + "#isiDiv" );
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: hasil.message,
						})
					}
				}
			})
	    }
	});

	$("#cancelTablePenerimaan").on('click', function () {
		$("#rowTablePenerimaan").hide('hide');
	})
	$(".cancelPenerimaan").on('click', function() {
		ajaxCancel($(this).data('id'));
	});
</script>