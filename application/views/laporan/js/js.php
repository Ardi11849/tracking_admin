<script src="<?php echo base_url()?>template/jquery.min.js"></script>
<script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.base.js"></script>
<script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.addons.js"></script>
<script src="<?php echo base_url()?>template/DataTables/datatables.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="<?php echo base_url()?>template/assets/js/shared/off-canvas.js"></script>
<script src="<?php echo base_url()?>template/datepicker/src/js/datepicker.js"></script>
<script src="<?php echo base_url()?>template/assets/js/shared/misc.js"></script>
<script src="<?php echo base_url()?>template/assets/js/demo_1/dashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="<?php echo base_url()?>template/jQuery-Mask-Plugin-master/src/jquery.mask.js"></script>
<script type="text/javascript">
	var laporan = [];
	function jumlah(pemasukan, pengeluaran) {
		laporan.push({pemasukan, pengeluaran});
	}

	$('select').select2({
		theme: 'classic'
	});
	$('.harga').mask("#,##0", {reverse: true});
	$('.tanggal').mask('0000-00-00');
	$("#TanggalPengeluaran").datepicker({
		"setDate": new Date(),
		format: 'yyyy-mm-dd'
	});
	var numberRenderer = $.fn.dataTable.render.number( ',', '.', 0, 'Rp. '  ).display;

	var tablePengeluaran = $('#myTable').DataTable({
		<?php if($this->session->userdata('Role') == 1){ ?>
			ajax: '<?php echo base_url()?>Laporan/get_pengeluaran_all',
		<?php }else if($this->session->userdata('Role') == 2){ ?>
			ajax: '<?php echo base_url()?>Laporan/get_pengeluaran',
		<?php }else{ ?>
			ajax: '<?php echo base_url()?>Laporan/get_pengeluaran_cabang',
		<?php } ?>
		scrollX: true,
		dom: 'Bfrtip',
		buttons: [
			'excel', 
			'pdf', 
			'print',
		],
		columns: [
			{ data: 'NamaPerusahaan' },
			{ data: 'NamaCabang' },
			{ data: 'AlasanPengeluaran' },
		 	{ 
		 		data: 'JumlahPengeluaran',
		 		render: function(data, type, row) {
		 			return "Rp. "+data
		 		}
		 	},
			{ data: 'TanggalPengeluaran' },
			{
				data: null,
				className: "dt-center updatePengeluaran",
				defaultContent: '<button class="btn btn-warning updatePengeluaran" data-toggle="modal" data-target="#modalPengeluaran"><i class="fa fa-pencil"></i> Update</button>',
				orderable: false
			},
			{
				data: null,
				className: "dt-center deletePengeluaran",
				defaultContent: '<button class="btn btn-danger delete"><i class="fa fa-trash"></i> Delete</button'
			}
		],
		"footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 2 ).footer() ).html(
                numberRenderer(pageTotal) +' ( '+numberRenderer(total) +' Total Semua Page)'
            );
            jumlah(0, total);
        }
	});

	$.fn.dataTable.ext.errMode = 'none';

	function validation() {
		if ($('#AlasanPengeluaran').val() == '') {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: "Alasan Pengeluaran Tidak Boleh Kosong"
			});
			return false;
		}else if ($('#JumlahPengeluaran').val() == '') {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: "Jumlah Pengeluaran Tidak Boleh Kosong"
			});
			return false;
		}else if ($('#TanggalPengeluaran').val() == '') {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: "Tanggal Pengeluaran Tidak Boleh Kosong"
			});
			return false;
		}else{
			return true;
		}
	}

	$("#addPengeluaran").on("click", function() {
		$('#updateFormPengeluaran').hide();
		$("#addFormPengeluaran").prop('disabled', false);
		$('#addFormPengeluaran').show();
		$('#IdPengeluaran').prop('disabled', true);
		$('#AlasanPengeluaran').val('');
		$('#JumlahPengeluaran').val('');
		$('#TanggalPengeluaran').val('');
		$('#IdPerusahaan').val('');
		$('#IdPerusahaan').trigger('change');
		$('#IdCabang').val('');
		$('#IdCabang').trigger('change');
	});

	$("#addFormPengeluaran").on("click", function() {
		$("#addFormPengeluaran").prop('disabled', true);
		if (validation() == true) {
			$.ajax({
				type: "post",
				url: "<?php echo base_url() ?>Laporan/post_pengeluaran",
				data: "AlasanPengeluaran="+$('#AlasanPengeluaran').val()+
					  "&JumlahPengeluaran="+$('#JumlahPengeluaran').val()+
					  "&TanggalPengeluaran="+$('#TanggalPengeluaran').val()+
					  "&IdPerusahaan="+$('#IdPerusahaan').val()+
					  "&IdCabang="+$('#IdCabang').val(),
				dataType: "json",
				success: function (hasil) {
					$("#addFormPengeluaran").prop('disabled', false);
					$('#modalPengeluaran').modal().hide();
					$(".modal-backdrop").remove();
					if (!hasil.message) {
						Swal.fire(
							'Berhasil!',
							'Berhasil Menambahkan = '+hasil[0].affectedRows+' Data',
							'success'
						);
					tablePengeluaran.ajax.reload();
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: hasil.message
						})
					}             
				}
			});
		}else{
			$("#addFormPengeluaran").prop('disabled', false);
		}
	});

	$("#myTable").on("click", 'td.updatePengeluaran', function() {
		$("#updateFormPengeluaran").prop('disabled', false);
		console.log(tablePengeluaran.row(this).data());
		const data = tablePengeluaran.row(this).data();
		$('#updateFormPengeluaran').show();
		$('#addFormPengeluaran').hide();
		$('#IdPengeluaran').prop('disabled', false);
		$('#IdPengeluaran').val(data.IdPengeluaran);
		$('#AlasanPengeluaran').val(data.AlasanPengeluaran);
		$('#JumlahPengeluaran').val(data.JumlahPengeluaran);
		$('#TanggalPengeluaran').val(data.TanggalPengeluaran);
		$('#IdPerusahaan').val(data.IdPerusahaan);
		$('#IdPerusahaan').trigger('change');
		$('#IdCabang').val(data.IdCabang);
		$('#IdCabang').trigger('change');
	});

	$("#updateFormPengeluaran").on("click", function() {
		$("#updateFormPengeluaran").prop('disabled', true);
		if (validation() == true) {
			$.ajax({
				type: "post",
				url: "<?php echo base_url() ?>Laporan/put_pengeluaran",
				data: "IdPengeluaran="+$('#IdPengeluaran').val()+
					  "&AlasanPengeluaran="+$('#AlasanPengeluaran').val()+
					  "&JumlahPengeluaran="+$('#JumlahPengeluaran').val()+
					  "&TanggalPengeluaran="+$('#TanggalPengeluaran').val()+
					  "&IdPerusahaan="+$('#IdPerusahaan').val()+
					  "&IdCabang="+$('#IdCabang').val(),
				dataType: "json",
				success: function (hasil) {
					$("#updateFormPengeluaran").prop('disabled', false);
					$('#modalPengeluaran').modal().hide();
					$(".modal-backdrop").remove();
					if (!hasil.message) {
						Swal.fire(
							'Berhasil!',
							'Berhasil '+hasil[0].info,'success'
						);
						tablePengeluaran.ajax.reload();
					}else{
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: hasil.message
						})
					}
				}
			});
		}else{
			$("#updateFormPengeluaran").prop('disabled', false);
		}
	});

	$("#myTable").on("click", 'td.deletePengeluaran', function() {
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
					url: "<?php echo base_url() ?>Laporan/delete_pengeluaran",
					data: "IdPengeluaran="+data.IdPengeluaran,
					dataType: "json",
					success: function (hasil) {
						if (!hasil.message) {
							Swal.fire('Deleted!',
								'Your file has been deleted.',
								'success'
							);
							tablePengeluaran.ajax.reload();
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: hasil.message
							})
						}
					}
				});
			}
		})
	});
</script>
<script type="text/javascript">
	var numberRenderer = $.fn.dataTable.render.number( ',', '.', 0, 'Rp. '  ).display;

	var tablePemasukan = $('#tablePemasukan').DataTable({
		<?php if ($this->session->userdata('Role') == '1') {?>
			ajax: '<?php echo base_url()?>Pengiriman/get_all',
		<?php } else {?>
			ajax: '<?php echo base_url()?>Pengiriman/get_createdby',
		<?php } ?>
		dom: 'Bfrtip',
		buttons: [
			'excel', 
			'pdf', 
			'print',
		],
		columns: [
			{ data: 'NamaPerusahaan' },
			{ data: 'NamaCabang' },
			{ data: 'NoResi' },
		 	{ 
		 		data: 'Harga',
		 		render: function(data, type, row) {
		 			return "Rp. "+data
		 		}
		 	},
			{ data: 'CreatedOn' }
		],
		"footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                numberRenderer(pageTotal) +' ( '+numberRenderer(total) +' Total Semua Page)'
            );
            jumlah(total, 0);
        }
	});
</script>
<script type="text/javascript">
	setTimeout(function() {
		console.log(laporan[3].pemasukan - laporan[2].pengeluaran);
		showTableLaporan(laporan[3].pemasukan, laporan[2].pengeluaran);
	},5000)
	function showTableLaporan(pemasukan, pengeluaran) {
		arr = {
			'data':[
				{
					'pemasukan': pemasukan,
					'pengeluaran': pengeluaran
				}
			]
		}
		$('#tableLaporan').DataTable({
			dom: 'Bfrtip',
			buttons: [
				'excel', 
				'pdf', 
				'print',
			],
			data: arr.data,
			columns: [
			 	{ 
			 		data: 'pemasukan',
			 		render: function(data, type, row) {
			 			return numberRenderer(data)
			 		}
			 	},
			 	{ 
			 		data: 'pengeluaran',
			 		render: function(data, type, row) {
			 			return numberRenderer(data)
			 		}
			 	},
			],
			"footerCallback": function ( row, data, start, end, display ) {
            	var api = this.api(), data;
	            $( api.column( 0 ).footer() ).html(
	                "Total Semua: "+numberRenderer(pemasukan - pengeluaran)
	            );
	        }
		});
	}
</script>