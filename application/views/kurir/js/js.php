<script src="<?php echo base_url()?>template/jquery.min.js"></script><script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.base.js"></script><script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.addons.js"></script><script src="<?php echo base_url()?>template/DataTables/datatables.js"></script><script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script><script src="<?php echo base_url()?>template/assets/js/shared/off-canvas.js"></script><script src="<?php echo base_url()?>template/assets/js/shared/misc.js"></script><script src="<?php echo base_url()?>template/assets/js/demo_1/dashboard.js"></script><script src="<?php echo base_url()?>template/jQuery-Mask-Plugin-master/src/jquery.mask.js"></script><script src="<?php echo base_url()?>template/Loading-Overlay/waitMe.min.js"></script><script type="text/javascript">$(document).ready( function (){function loading() {$("#loading").waitMe({effect : 'roundBounce',text : '',bg : 'rgba(255,255,255,0.7)',color : '#000',maxSize : '',waitTime : -1,textPos : 'vertical',fontSize : '',source : '',onClose : function() {}});};$('.number').mask('00-0000-0000-000');var table = $('#myTable').DataTable({<?php if ($this->session->userdata('Role') == '1') {?>ajax: '<?php echo base_url()?>Kurir/get_kurir_all',<?php } elseif ($this->session->userdata('Role') == '2') {?>ajax: '<?php echo base_url()?>Kurir/get_kurir',<?php } else {?>ajax: '<?php echo base_url()?>Kurir/get_kurir_cabang',<?php } ?>columns: [{ data: 'IdKurir' },{ data: 'Nama' },{ data: 'NoTelp' },{ data: 'NamaPerusahaan' },{data: null,className: "dt-center updateKurir",defaultContent: '<button class="btn btn-warning updateKurir" data-toggle="modal" data-target="#modalKurir"><i class="fa fa-pencil"></i> Update</button>',orderable: false},{data: null,className: "dt-center deleteKurir",defaultContent: '<button class="btn btn-danger delete"><i class="fa fa-trash"></i> Delete</button'}]});$.fn.dataTable.ext.errMode = 'none';function validation() {if ($('#nama').val() == '') {Swal.fire({icon: 'error',title: 'Oops...',text: "Nama Tidak Boleh Kosong",});return false;}else if ($('#noTelp').val() == '') {Swal.fire({icon: 'error',title: 'Oops...',text: "No Handphone Tidak Boleh Kosong",});return false;}else{return true;}}$("#addKurir").on("click", function() {$('#updateForm').hide();$('#addForm').show();$('#idKurir').prop('disabled', true);$('#nama').val('');$('#noTelp').val('');});$("#addForm").on("click", function() {$('#addForm').prop('disabled', true);loading();if (validation() == true) {$.ajax({type: "post",url: "<?php echo base_url() ?>Kurir/post_kurir",data: "Nama="+$('#nama').val()+"&Email="+$('#email').val()+"&Password="+$('#password').val()+"&NoTelp="+$('#noTelp').val(),dataType: "json",success: function (hasil) {$('#addForm').prop('disabled', false);$('#modalKurir').modal().hide();$(".modal-backdrop").remove();if (!hasil.message) {Swal.fire('Berhasil!','Berhasil Menambahkan = '+hasil[0].affectedRows+' Data','success');table.ajax.reload();}else{Swal.fire({icon: 'error',title: 'Oops...',text: hasil.message,})}$("#loading").waitMe("hide");}});} else {$('#addForm').prop('disabled', false);$("#loading").waitMe("hide");}});$("#myTable").on("click", 'td.updateKurir', function() {console.log(table.row(this).data());const data = table.row(this).data();$('#updateForm').show();$('#addForm').hide();$('#idKurir').prop('disabled', false);$('#idKurir').val(data.IdKurir);$('#nama').val(data.Nama);$('#noTelp').val(data.NoTelp);});$("#updateForm").on("click", function() {$('#updateForm').prop('disabled', true);loading();if (validation() == true) {$.ajax({type: "post",url: "<?php echo base_url() ?>Kurir/put_kurir",data: "IdKurir="+$('#idKurir').val()+"&Nama="+$('#nama').val()+"&NoTelp="+$('#noTelp').val(),dataType: "json",success: function (hasil) {$('#updateForm').prop('disabled', false);$('#modalKurir').modal().hide();$(".modal-backdrop").remove();if (!hasil.message) {Swal.fire('Berhasil!','Berhasil '+hasil[0].info,'success');table.ajax.reload();}else{Swal.fire({icon: 'error',title: 'Oops...',text: hasil.message,})}$("#loading").waitMe("hide");}});} else {$('#updateForm').prop('disabled', false);$("#loading").waitMe("hide");}});$("#myTable").on("click", 'td.deleteKurir', function() {console.log(table.row(this).data());const data = table.row(this).data();$('td.deleteKurir').prop('disabled', true);Swal.fire({title: 'Are you sure?',text: "You won't be able to revert this!",icon: 'warning',showCancelButton: true,confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'}).then((result) => {$('td.deleteKurir').prop('disabled', false);if (result.isConfirmed) {loading();$.ajax({type: "post",url: "<?php echo base_url() ?>Kurir/delete_kurir",data: "IdKurir="+data.IdKurir,dataType: "json",success: function (hasil) {if (!hasil.message) {Swal.fire('Deleted!','Your file has been deleted.','success');table.ajax.reload();}else{Swal.fire({icon: 'error',title: 'Oops...',text: hasil.message,})}$("#loading").waitMe("hide");}});}})})});</script>