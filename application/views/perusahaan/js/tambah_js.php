
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
    <script type="text/javascript">
    	$(document).ready(function () {
	      $('select').selectize({
	          sortField: 'text'
	      });
	  });
        var data =[];
		var noresiInput = document.getElementById("noresi");
		var kurirInput = document.getElementById("kurir");
		var penerimaInput = document.getElementById("penerima");
		var alamatInput = document.getElementById("alamat");
		var nohpInput = document.getElementById("nohp");

		var messageBox = document.getElementById("display");

		function insert() {
			var noresi, kurir, penerima;
		  noresi =noresiInput.value;
		  kurir =kurirInput.value;
		  penerima =penerimaInput.value;
		  alamat =alamatInput.value;
		  nohp =nohpInput.value;
			data.push({
		  	noresi:noresi,
		    kurir:kurir,
		    penerima:penerima,
		    alamat:alamat,
		    nohp:nohp
		  });
		  clearAndShow();
		}

		function clearAndShow() {
		  // Clear our fields
		  noresiInput.value = "";
		  penerimaInput.value = "";
		  alamatInput.value = "";
		  nohpInput.value = "";
			messageBox.innerHTML = computeHTML();
		}

		function computeHTML(){
			var html = "<table>";
		  console.log(data)
		  data.forEach(function(item){
		 		html += "<tr>";
		    html += "<td>" + item.noresi + "</td>"
		    html += "<td>" + item.kurir + "</td>"
		    html += "<td>" + item.penerima + "</td>"
		    html += "<td>" + item.alamat + "</td>"
		    html += "<td>" + item.nohp + "</td>"
		    html += "</tr>";
		  });
		  html += "</table>"
		  return html;
		}

		function save() {
			$.ajax({
				type: "post",
				url: "<?php echo base_url()?>Penerima/add",
				data: {data: data},
				dataType: 'json',
				success: function (hasil) {
					if (hasil === 0) {
				        Swal.fire({
						  icon: 'error',
						  title: 'Gagal',
						  text: 'Gagal Menyimpan Data'
						})
					}else{
						window.location.replace("<?php echo base_url()?>Penerima");
					}					
				}
			})
		}
    </script>