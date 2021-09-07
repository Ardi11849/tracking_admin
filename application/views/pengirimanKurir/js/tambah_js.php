
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
    <!-- <script src="<?php echo base_url()?>template/bootstrap-select-1.13.14/dist/js/bootstrap-select.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
    	$(document).ready(function () {
	     //  $('select').selectize({
	     //      // sortField: 'text'
		    // render: {
	     //   		option: function (data, escape) {
	     //   			console.log(data)
	     //        	return "<div data-open-balance='" + data.pengirim + "'>" + data.text + "</div>"
	     //    	}
	     //    }
	     //  });

    	$('select').select2();

	      $("#noresi").change(function(){
	      	console.log($(this).find(':selected').data())
	      	$('#pengirim').val($(this).find(':selected').data('pengirim'))
	      	$('#nohppengirim').val($(this).find(':selected').data('nopengirim'))
	      	$('#penerima').val($(this).find(':selected').data('pengirim'))
	      	$('#nohppenerima').val($(this).find(':selected').data('nopenerima'))
	      	$('#alamat').val($(this).find(':selected').data('alamatpenerima'))
	      })
		});
        var data =[];
		var noresiInput = document.getElementById("noresi");
		var kurirInput = document.getElementById("kurir");
		var pengirimInput = document.getElementById("pengirim");
		var nohppengirimInput = document.getElementById("nohppengirim");
		var penerimaInput = document.getElementById("penerima");
		var nohppenerimaInput = document.getElementById("nohppenerima");
		var alamatInput = document.getElementById("alamat");

		var messageBox = document.getElementById("display");

		function insert() {
			var noresi, kurir, pengirim, nohppengirim, penerima, nohppenerima, alamat;
		  noresi =noresiInput.value;
		  kurir =kurirInput.value;
		  pengirim =pengirimInput.value;
		  nohppengirim =nohppengirimInput.value;
		  penerima =penerimaInput.value;
		  nohppenerima =nohppenerimaInput.value;
		  alamat =alamatInput.value;
			data.push({
		  	noresi:noresi,
		    kurir:kurir,
		    pengirim:pengirim,
		    nohppengirim:nohppengirim,
		    penerima:penerima,
		    nohppenerima:nohppenerima,
		    alamat:alamat,
		    createdBy:<?php echo $this->session->userdata('Id');?>
		  });
		  clearAndShow();
		}

		function deleteArr(no) {
			console.log(no);
			// delete data[no];
			data.splice(no,1);
			$("#tableRow"+no).remove();
		}

		function clearAndShow() {
		  // Clear our fields
		  pengirimInput.value = "";
		  nohppengirimInput.value = "";
		  penerimaInput.value = "";
		  nohppenerimaInput.value = "";
		  alamatInput.value = "";
			messageBox.innerHTML = computeHTML();
		}

		function computeHTML(){
			var html = "<table>";
		  console.log(data)
		  data.forEach(function(item, index){
		 		html += "<tr id='tableRow"+index+"'>";
		    html += "<td>" + item.noresi + "</td>"
		    html += "<td>" + item.kurir + "</td>"
		    html += "<td>" + item.pengirim + "</td>"
		    html += "<td>" + item.nohppengirim + "</td>"
		    html += "<td>" + item.penerima + "</td>"
		    html += "<td>" + item.nohppenerima + "</td>"
		    html += "<td>" + item.alamat + "</td>"
		    html += "<td><button class='btn btn-danger' onclick='deleteArr("+index+")'><i class='fa fa-trash'></i> Hapus</button></td>"
		    html += "</tr>";
		  });
		  html += "</table>"
		  return html;
		}

		function save() {
			$.ajax({
				type: "post",
				url: "<?php echo base_url()?>PengirimanKurir/add",
				data: {data: data},
				dataType: 'json',
				success: function (hasil) {
					console.log(!hasil.message)
					if(!hasil[0] && !hasil.message){
	                    Swal.fire({
	                      icon: 'error',
	                      title: 'Kesalahan Server',
	                      text: 'Hubungi Developer',
	                    })
					}else{
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
								window.location.replace("<?php echo base_url()?>PengirimanKurir");
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
				}
			})
		}
    </script>