<script src="<?php echo base_url()?>template/jquery.min.js"></script><script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.base.js"></script><script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.addons.js"></script><script src="<?php echo base_url()?>template/DataTables/datatables.js"></script><script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script><script src="<?php echo base_url()?>template/assets/js/shared/off-canvas.js"></script><script src="<?php echo base_url()?>template/assets/js/shared/misc.js"></script><script src="<?php echo base_url()?>template/assets/js/demo_1/dashboard.js"></script><script type="text/javascript">$(document).ready( function () {var data = [];var table = $('#myTable').DataTable({dom: 'Bfrtip',buttons: ['excel', 'pdf', 'print',],ajax: '<?php echo base_url()?>Perusahaan/get_perusahaan',columns: [{ data: 'IdPerusahaan' },{ data: 'NamaPerusahaan' },{ data: 'Status',render: function(data, type, row) {if (data === '0') {return 'Tidak Aktif'}if (data === '1') {return 'Aktif'}}},{data: null,className: "dt-center aktifPerusahaan",defaultContent: '<button class="btn btn-success nonAktif"><i class="fa fa-check"></i> Aktikan</button>'},{data: null,className: "dt-center nonAktifPerusahaan",defaultContent: '<button class="btn btn-warning aktif"><i class="fa fa-close"></i> Non Aktifkan</button>'},{data: null,className: "dt-center updatePerusahaan",defaultContent: '<button class="btn btn-warning updatePerusahaan" data-toggle="modal" data-target="#modalPerusahaan"><i class="fa fa-pencil"></i> Ubah</button>',orderable: false},{data: null,className: "dt-center deletePerusahaan",defaultContent: '<button class="btn btn-danger delete"><i class="fa fa-trash"></i> Hapus</button>'}]});$('#myTable tbody').on( 'click', 'tr', function () {data.length = 0;data.push(table.row( this ).data());console.log( data );if ( $(this).hasClass('selected') ) {$(this).removeClass('selected');}else {table.$('tr.selected').removeClass('selected');$(this).addClass('selected');}} );function validation() {if ($('#Nama').val() == '') {Swal.fire({icon: 'error',title: 'Oops...',text: "Nama Tidak Boleh Kosong",});return false;} else {return true;}}$("#addPerusahaan").on("click", function() {$('#updateForm').hide();$('#addForm').show();$('#IdPerusahaan').prop('disabled', true);$('#Nama').val('');});$("#addForm").on("click", function() {$("#addForm").prop('disabled',true);if (validation() == true) {$.ajax({type: "post",url: "<?php echo base_url() ?>Perusahaan/post_perusahaan",data: "Nama="+$('#Nama').val(),dataType: "json",success: function (hasil) {$("#addForm").prop('disabled',false);table.ajax.reload();$('#modalPerusahaan').modal().hide();$(".modal-backdrop").remove();if (!hasil.message) {Swal.fire('Berhasil!','Berhasil Menambahkan = '+hasil[0].affectedRows+' Data','success');table.ajax.reload();}else{Swal.fire({icon: 'error',title: 'Oops...',text: hasil.message,})}   }});} else {$("#addForm").prop('disabled',false);}});$("#myTable").on("click", 'td.updatePerusahaan', function() {console.log(table.row(this).data());const data = table.row(this).data();$('#updateForm').show();$('#addForm').hide();$('#IdPerusahaan').prop('disabled', false);$('#IdPerusahaan').val(data.IdPerusahaan);$('#Nama').val(data.NamaPerusahaan);});$("#updateForm").on("click", function() {$("#updateForm").prop('disabled',true);if (validation() == true) {$.ajax({type: "post",url: "<?php echo base_url() ?>Perusahaan/put_perusahaan",data: "IdPerusahaan="+$('#IdPerusahaan').val()+"&Nama="+$('#Nama').val(),dataType: "json",success: function (hasil) {$("#updateForm").prop('disabled',false);console.log(hasil);$('#modalPerusahaan').modal().hide();$(".modal-backdrop").remove();if (!hasil.message) {Swal.fire('Berhasil!','Berhasil '+hasil[0].info,'success');table.ajax.reload();}else{Swal.fire({icon: 'error',title: 'Oops...',text: hasil.message,})}                    }});} else {$("#updateForm").prop('disabled',false);}});$("#myTable").on("click", 'td.aktifPerusahaan', function() {console.log(table.row(this).data());const data = table.row(this).data();Swal.fire({title: 'Konfirmasi',text: "apakah anda yakin ingin mengaktifkan data?",icon: 'info',showCancelButton: true,confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Aktifkan Data'}).then((result) => {if (result.isConfirmed) {$.ajax({type: "post",url: "<?php echo base_url() ?>Perusahaan/active_perusahaan",data: "IdPerusahaan="+data.IdPerusahaan,dataType: "json",success: function (hasil) {Swal.fire('Berhasil','Data Sudah Di Aktifkan.','success');table.ajax.reload();}});}})});$("#myTable").on("click", 'td.nonAktifPerusahaan', function() {console.log(table.row(this).data());const data = table.row(this).data();Swal.fire({title: 'Konfirmasi',text: "apakah anda yakin ingin non aktifkan data?",icon: 'warning',showCancelButton: true,confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Non Aktikkan Data'}).then((result) => {if (result.isConfirmed) {$.ajax({type: "post",url: "<?php echo base_url() ?>Perusahaan/inActive_perusahaan",data: "IdPerusahaan="+data.IdPerusahaan,dataType: "json",success: function (hasil) {Swal.fire('No Aktif!','Berhasil Data Sudah Di Non Aktifkan.','success');table.ajax.reload();}});}})});$("#myTable").on("click", 'td.deletePerusahaan', function() {console.log(table.row(this).data());const data = table.row(this).data();Swal.fire({title: 'Konfirmasi',text: "You won't be able to revert this!",icon: 'warning',showCancelButton: true,confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'}).then((result) => {if (result.isConfirmed) {$.ajax({type: "post",url: "<?php echo base_url() ?>Perusahaan/delete_Perusahaan",data: "IdPerusahaan="+data.IdPerusahaan,dataType: "json",success: function (hasil) {if (!hasil.message) {Swal.fire('Deleted!','Your file has been deleted.','success');table.ajax.reload();}else{Swal.fire({icon: 'error',title: 'Oops...',text: hasil.message,})}}});}})})} );</script>