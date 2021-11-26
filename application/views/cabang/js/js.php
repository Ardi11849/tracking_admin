<script src="<?php echo base_url()?>template/jquery.min.js"></script><script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.base.js"></script><script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.addons.js"></script><script src="<?php echo base_url()?>template/DataTables/datatables.js"></script><script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script><script src="<?php echo base_url()?>template/assets/js/shared/off-canvas.js"></script><script src="<?php echo base_url()?>template/assets/js/shared/misc.js"></script><script src="<?php echo base_url()?>template/assets/js/demo_1/dashboard.js"></script><script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script><script src="<?php echo base_url()?>template/Loading-Overlay/waitMe.min.js"></script><script type="text/javascript">$(document).ready( function () {function loading() {$("#loading").waitMe({effect : 'roundBounce',text : '',bg : 'rgba(255,255,255,0.7)',color : '#000',maxSize : '',waitTime : -1,textPos : 'vertical',fontSize : '',source : '',onClose : function() {}});};$('select').select2({theme: 'classic'});var table = $('#myTable').DataTable({<?php if($this->session->userdata('Role') == 1){ ?>ajax: '<?php echo base_url()?>Cabang/get_cabang_all',<?php }else{ ?>ajax: '<?php echo base_url()?>Cabang/get_cabang',<?php } ?>scrollX: true,columns: [{ data: 'IdCabang' },{ data: 'Nama' },{ data: 'NamaKotaBesar' },{ data: 'NamaKota' },{ data: 'Alamat' },{data: null,className: "dt-center updateCabang",defaultContent: '<button class="btn btn-warning updateCabang" data-toggle="modal" data-target="#modalCabang"><i class="fa fa-pencil"></i> Update</button>',orderable: false},{data: null,className: "dt-center deleteCabang",defaultContent: '<button class="btn btn-danger delete"><i class="fa fa-trash"></i> Delete</button'}]});$.fn.dataTable.ext.errMode = 'none';function validation() {if ($('#nama').val() == '') {Swal.fire({icon: 'error',title: 'Oops...',text: "Nama Tidak Boleh Kosong"});return false;}else if ($('#kodeKotaBesar').val() == '') {Swal.fire({icon: 'error',title: 'Oops...',text: "Pilih Kota Besar"});return false;}else if ($('#kodeKota').val() == '') {Swal.fire({icon: 'error',title: 'Oops...',text: "Pilih Kota"});return false;}else if ($('#alamat').val() == '') {Swal.fire({icon: 'error',title: 'Oops...',text: "Alamat Tidak Boleh Kosong"});return false;}else{return true;}}function ajaxGetKota(update, kodekota) {$("select#kodeKota").val('');let option = new Option("Pilih Kota",'',false,false);$("select#kodeKota").html(option);loading();$.ajax({type: 'post',url: '<?php echo base_url()?>Kota/get_kota_bykkb',data: 'KodeKotaBesar='+$("#kodeKotaBesar").val(),dataType: 'json',success: function (hasil) {for (let i = hasil.data.length - 1; i >= 0; i--) {console.log(hasil.data[i].NamaKota);let option = new Option(hasil.data[i].NamaKota,hasil.data[i].KodeKota,false,false);$("select#kodeKota").append(option);}if (update = true) {$('#kodeKota').val(kodekota);$('#kodeKota').trigger('change');}$("#loading").waitMe("hide");}})}$("#kodeKotaBesar").on('change', function() {ajaxGetKota(false);});$("#addCabang").on("click", function() {$('#updateForm').hide();$("#addForm").prop('disabled', false);$('#addForm').show();$('#idCabang').prop('disabled', true);$('#nama').val('');$('#kodeKotaBesar').val('');$('#kodeKota').val('');$('#kodeKotaBesar').trigger('change');$('#kodeKota').trigger('change');$('#alamat').val('');$('#idPerusahaan').val('');$('#idPerusahaan').trigger('change');	});$("#addForm").on("click", function() {$("#addForm").prop('disabled', true);loading();if (validation() == true) {$.ajax({type: "post",url: "<?php echo base_url() ?>Cabang/post_cabang",data: "Nama="+$('#nama').val()+"&KodeKotaBesar="+$('#kodeKotaBesar').val()+"&KodeKota="+$('#kodeKota').val()+"&Alamat="+$('#alamat').val()+"&IdPerusahaan="+$('#idPerusahaan').val(),dataType: "json",success: function (hasil) {$("#addForm").prop('disabled', false);$('#modalCabang').modal().hide();$(".modal-backdrop").remove();if (!hasil.message) {Swal.fire('Berhasil!','Berhasil Menambahkan = '+hasil[0].affectedRows+' Data','success');table.ajax.reload();}else{Swal.fire({icon: 'error',title: 'Oops...',text: hasil.message})}$("#loading").waitMe("hide");     }});}else{$("#addForm").prop('disabled', false);$("#loading").waitMe("hide");}});$("#myTable").on("click", 'td.updateCabang', function() {$("#updateForm").prop('disabled', false);console.log(table.row(this).data());const data = table.row(this).data();$('#updateForm').show();$('#addForm').hide();$('#idCabang').prop('disabled', false);$('#idCabang').val(data.IdCabang);$('#nama').val(data.Nama);$('#kodeKotaBesar').val(data.KodeKotaBesar);$('#kodeKotaBesar').trigger('change');ajaxGetKota(true, data.KodeKota);$('#alamat').val(data.Alamat);$('#idPerusahaan').val(data.IdPerusahaan);$('#idPerusahaan').trigger('change');});$("#updateForm").on("click", function() {$("#updateForm").prop('disabled', true);loading();if (validation() == true) {$.ajax({type: "post",url: "<?php echo base_url() ?>Cabang/put_cabang",data: "IdCabang="+$('#idCabang').val()+"&Nama="+$('#nama').val()+"&KodeKotaBesar="+$('#kodeKotaBesar').val()+"&KodeKota="+$('#kodeKota').val()+"&Alamat="+$('#alamat').val()+"&IdPerusahaan="+$('#idPerusahaan').val(),dataType: "json",success: function (hasil) {$("#updateForm").prop('disabled', false);$('#modalCabang').modal().hide();$(".modal-backdrop").remove();if (!hasil.message) {Swal.fire('Berhasil!','Berhasil '+hasil[0].info,'success');table.ajax.reload();}else{Swal.fire({icon: 'error',title: 'Oops...',text: hasil.message})}$("#loading").waitMe("hide");}});}else{$("#updateForm").prop('disabled', false);$("#loading").waitMe("hide");}});$("#myTable").on("click", 'td.deleteCabang', function() {console.log(table.row(this).data());const data = table.row(this).data();Swal.fire({title: 'Are you sure?',text: "You won't be able to revert this!",icon: 'warning',showCancelButton: true,confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'}).then((result) => {if (result.isConfirmed) {loading();$.ajax({type: "post",url: "<?php echo base_url() ?>Cabang/delete_cabang",data: "IdCabang="+data.IdCabang,dataType: "json",success: function (hasil) {if (!hasil.message) {Swal.fire('Deleted!','Your file has been deleted.','success');table.ajax.reload();}else{Swal.fire({icon: 'error',title: 'Oops...',text: hasil.message})}$("#loading").waitMe("hide");}});}})});});</script>