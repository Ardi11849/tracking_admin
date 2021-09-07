
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo base_url()?>template/jquery.min.js"></script>
    <script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url()?>template/DataTables/datatables.js"></script>
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
        $(document).ready( function () {
            var table = $('#myTable').DataTable({
                <?php if($this->session->userdata('Role') == 1){ ?>
                                ajax: '<?php echo base_url()?>Cabang/get_cabang_all',
                <?php }else{ ?>
                                ajax: '<?php echo base_url()?>Cabang/get_cabang',
                <?php }?>
                columns: [
                    { data: 'IdCabang' },
                    { data: 'Nama' },
                    { data: 'Alamat' },
                    {
                        data: null,
                        className: "dt-center updateCabang",
                        defaultContent: '<button class="btn btn-warning updateCabang" data-toggle="modal" data-target="#modalCabang"><i class="fa fa-pencil"></i> Update</button>',
                        orderable: false
                    },
                    {
                        data: null,
                        className: "dt-center deleteCabang",
                        defaultContent: '<button class="btn btn-danger delete"><i class="fa fa-trash"></i> Delete</button'
                    }
                ]
            });
            $.fn.dataTable.ext.errMode = 'none';

            // Add Cabang
            $("#addCabang").on("click", function() {
                $('#updateForm').hide();
                $('#addForm').show();
                $('#idCabang').prop('disabled', true);
                $('#nama').val('');
                $('#alamat').val('');
                $('#idPerusahaan').val();
            });

            $("#addForm").on("click", function() {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url() ?>Cabang/post_cabang",
                    data: "Nama="+$('#nama').val()+"&Alamat="+$('#alamat').val()+"&IdPerusahaan="+$('#idPerusahaan').val(),
                    dataType: "json",
                    success: function (hasil) {
                        $('#modalCabang').modal().hide();
                        $(".modal-backdrop").remove();
                        if (!hasil.message) {
                            Swal.fire(
                              'Berhasil!',
                              'Berhasil Menambahkan = '+hasil[0].affectedRows+' Data',
                              'success'
                            );
                            table.ajax.reload();
                        }else{
                            Swal.fire({
                              icon: 'error',
                              title: 'Oops...',
                              text: hasil.message,
                            })
                        }                    }
                });
            })

            // Update Cabang
            $("#myTable").on("click", 'td.updateCabang', function() {
                $("#updateForm").prop('disabled', false);
                console.log(table.row(this).data());
                const data = table.row(this).data();
                $('#updateForm').show();
                $('#addForm').hide();
                $('#idCabang').prop('disabled', false);
                $('#idCabang').val(data.IdCabang);
                $('#nama').val(data.Nama);
                $('#alamat').val(data.Alamat);
                $('#idPerusahaan').val(data.IdPerusahaan);
            })

            $("#updateForm").on("click", function() {
                $("#updateForm").prop('disabled', true);
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url() ?>Cabang/put_cabang",
                    data: "IdCabang="+$('#idCabang').val()+"&Nama="+$('#nama').val()+"&Alamat="+$('#alamat').val()+"&IdPerusahaan="+$('#idPerusahaan').val(),
                    dataType: "json",
                    success: function (hasil) {
                        $('#modalCabang').modal().hide();
                        $(".modal-backdrop").remove();
                        console.log(hasil)
                        if (!hasil.message) {
                            Swal.fire(
                              'Berhasil!',
                              'Berhasil '+hasil[0].info,
                              'success'
                            );
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
            })

            // Delete Cabang
            $("#myTable").on("click", 'td.deleteCabang', function() {
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
                        url: "<?php echo base_url() ?>Cabang/delete_cabang",
                        data: "IdCabang="+data.IdCabang,
                        dataType: "json",
                        success: function (hasil) {
                            if (!hasil.message) {
                                Swal.fire(
                                  'Deleted!',
                                  'Your file has been deleted.',
                                  'success'
                                )
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
            })
        } );
    </script>