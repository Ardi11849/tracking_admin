
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
                <?php if ($this->session->userdata('Role') == '1') {?>
                    ajax: '<?php echo base_url()?>Kurir/get_kurir_all',
                <?php } elseif ($this->session->userdata('Role') == '2') {?>
                    ajax: '<?php echo base_url()?>Kurir/get_kurir',
                <?php } else {?>
                    ajax: '<?php echo base_url()?>Kurir/get_kurir_cabang',
                <?php } ?>
                columns: [
                    { data: 'IdKurir' },
                    { data: 'Nama' },
                    { data: 'NoTelp' },
                    { data: 'NamaPerusahaan' },
                    {
                        data: null,
                        className: "dt-center updateKurir",
                        defaultContent: '<button class="btn btn-warning updateKurir" data-toggle="modal" data-target="#modalKurir"><i class="fa fa-pencil"></i> Update</button>',
                        orderable: false
                    },
                    {
                        data: null,
                        className: "dt-center deleteKurir",
                        defaultContent: '<button class="btn btn-danger delete"><i class="fa fa-trash"></i> Delete</button'
                    }
                ]
            });
            $.fn.dataTable.ext.errMode = 'none';

            // Add Kurir
            $("#addKurir").on("click", function() {
                $('#updateForm').hide();
                $('#addForm').show();
                $('#idKurir').prop('disabled', true);
                $('#nama').val('');
                $('#email').val('');
                $('#password').val('');
                $('#noTelp').val('');
            });

            $("#addForm").on("click", function() {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url() ?>Kurir/post_kurir",
                    data: "Nama="+$('#nama').val()+"&Email="+$('#email').val()+"&Password="+$('#password').val()+"&NoTelp="+$('#noTelp').val(),
                    dataType: "json",
                    success: function (hasil) {
                        $('#modalKurir').modal().hide();
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
                        }
                    }
                });
            })

            // Update Kurir
            $("#myTable").on("click", 'td.updateKurir', function() {
                console.log(table.row(this).data());
                const data = table.row(this).data();
                $('#updateForm').show();
                $('#addForm').hide();
                $('#idKurir').prop('disabled', false);
                $('#idKurir').val(data.IdKurir);
                $('#nama').val(data.Nama);
                $('#email').val(data.Email);
                $('#password').val(data.Password);
                $('#noTelp').val(data.NoTelp);
            })

            $("#updateForm").on("click", function() {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url() ?>Kurir/put_kurir",
                    data: "IdKurir="+$('#idKurir').val()+"&Nama="+$('#nama').val()+"&NoTelp="+$('#noTelp').val(),
                    dataType: "json",
                    success: function (hasil) {
                        $('#modalKurir').modal().hide();
                        $(".modal-backdrop").remove();
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

            // Delete Kurir
            $("#myTable").on("click", 'td.deleteKurir', function() {
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
                        url: "<?php echo base_url() ?>Kurir/delete_kurir",
                        data: "IdKurir="+data.IdKurir,
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