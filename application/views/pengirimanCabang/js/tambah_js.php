
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo base_url()?>template/jquery.min.js"></script>
    <script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url()?>template/DataTables/datatables.js"></script>
    <script src="<?php echo base_url()?>template/bootstrap-select/select.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="<?php echo base_url()?>template/assets/js/shared/off-canvas.js"></script>
    <script src="<?php echo base_url()?>template/assets/js/shared/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?php echo base_url()?>template/assets/js/demo_1/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
    	$(document).ready(function () {
	      // $('select').selectize({
	      //     sortField: 'text'
	      // });


    	$('select').select2();

	      $("#noresi").change(function(){
	      	console.log($(this).find(':selected').data())
	      	$('#pengirim').val($(this).find(':selected').data('pengirim'))
	      	$('#nohppengirim').val($(this).find(':selected').data('nopengirim'))
	      	$('#penerima').val($(this).find(':selected').data('pengirim'))
	      	$('#nohppenerima').val($(this).find(':selected').data('nopenerima'))
	      	$('#alamatpenerima').val($(this).find(':selected').data('alamatpenerima'))
	      })
	  });
        var data =[];
		var noresiInput = document.getElementById("noresi");
		var cabangInput = document.getElementById("cabang");
		var kurirInput = document.getElementById("kurir");
		var alamatInput = document.getElementById("alamat");
		var pengirimInput = document.getElementById("pengirim");
		var nohppengirimInput = document.getElementById("nohppengirim");
		var penerimaInput = document.getElementById("penerima");
		var nohppenerimaInput = document.getElementById("nohppenerima");
		var alamatpenerimaInput = document.getElementById("alamatpenerima");

		var messageBox = document.getElementById("display");

		function insert() {
			var noresi, cabang, alamattransit, kurir, pengirim, nohppengirim, penerima, nohppenerima,  alamatpenerima;
		  noresi =noresiInput.value;
		  cabang =cabangInput.value;
		  alamattransit =alamatInput.value;
		  kurir =kurirInput.value;
		  pengirim =pengirimInput.value;
		  nohppengirim =nohppengirimInput.value;
		  penerima =penerimaInput.value;
		  nohppenerima =nohppenerimaInput.value;
		  alamatpenerima =alamatpenerimaInput.value;
			data.push({
		  	noresi:noresi,
		    cabang:cabang,
		    alamattransit:alamattransit,
		    kurir:kurir,
		  	pengirim:pengirim,
		    nohppengirim:nohppengirim,
		    penerima:penerima,
		    nohppenerima:nohppenerima,
		    alamatpenerima:alamatpenerima,
		    createdBy:<?php echo $this->session->userdata('Id');?>
		  });
		  clearAndShow();
		}

		function deleteArr(no) {
			console.log(no);
			// delete data[no];
			data.splice(no,1);
			$("#tableRow"+no).remove();
			console.log(data)
		}

		function clearAndShow() {
		  // Clear our fields
		  noresiInput.value = "";
		  alamatInput.value = "";
		  pengirimInput.value = "";
		  nohppengirimInput.value = "";
		  penerimaInput.value = "";
		  nohppenerimaInput.value = "";
		  alamatpenerimaInput.value = "";
			messageBox.innerHTML = computeHTML();
		}

		function computeHTML(){
			var html = "<table>";
		  console.log(data)
		  data.forEach(function(item, index){
		 		html += "<tr id='tableRow"+index+"'>";
		    html += "<td>" + item.noresi + "</td>"
		    html += "<td>" + item.cabang + "</td>"
		    html += "<td>" + item.kurir + "</td>"
		    html += "<td>" + item.alamattransit + "</td>"
		    html += "<td>" + item.pengirim + "</td>"
		    html += "<td>" + item.nohppengirim + "</td>"
		    html += "<td>" + item.penerima + "</td>"
		    html += "<td>" + item.nohppenerima + "</td>"
		    html += "<td>" + item.alamatpenerima + "</td>"
		    html += "<td><button class='btn btn-danger' onclick='deleteArr("+index+")'><i class='fa fa-trash'></i> Hapus</button></td>"
		    html += "</tr>";
		  });
		  html += "</table>"
		  return html;
		}

		function save() {
			$.ajax({
				type: "post",
				url: "<?php echo base_url()?>PengirimanCabang/add",
				data: {data: data},
				dataType: 'json',
				success: function (hasil) {
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
							window.location.replace("<?php echo base_url()?>PengirimanCabang");
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
			})
		}
    </script>