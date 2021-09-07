
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
            ruleDiv();
            $.fn.dataTable.ext.errMode = 'none';
            var table = $('#myTable').DataTable({
                scrollX: true,
                <?php if ($this->session->userdata('Role') == 1) {?>
                    ajax: '<?php echo base_url()?>User/get_user_all_admin',
                <?php } else {?>
                    ajax: '<?php echo base_url()?>User/get_user_admin',
                <?php } ?>
                columns: [
                    { data: 'IdUsers' },
                    { data: 'Username' },
                    { data: 'Password' },
                    { 
                        data: 'Role',
                        render: function(data, type, row) {
                            if (data == 1) {return 'Super Admin'}
                            if (data == 2) {return 'Admin'}
                            if (data == 3) {return 'Admin Cabang'}
                        }
                    },
                    { data: 'IdPerusahaan' },
                    { data: 'NamaPerusahaan' },
                    { data: 'NamaCabang' },
                    {
                        data: null,
                        className: "dt-center updateUserAdmin",
                        defaultContent: '<button class="btn btn-warning updateUserAdmin" data-toggle="modal" data-target="#modalUserAdmin"><i class="fa fa-pencil"></i> Update</button>',
                        orderable: false
                    },
                    {
                        data: null,
                        className: "dt-center deleteUser",
                        defaultContent: '<button class="btn btn-danger delete"><i class="fa fa-trash"></i> Delete</button'
                    }
                ]
            });

            function ruleDiv() {
                if ($("#Role").val() == '3') {
                    $("#divCabang").show('show')
                    $("#IdCabang").prop('disabled', false)
                }else{
                    $("#divCabang").hide('hide')
                    $("#IdCabang").prop('disabled', true)
                }
            }

            $("select#Role").on('change', () => {
                ruleDiv();
            })

            // Add User
            $("#addUserAdmin").on("click", function() {
                $('#updateFormAdmin').hide();
                $('#addFormAdmin').show();
                $('#IdUser').prop('disabled', true);
                $('#Username').val('');
                $('#Role').val('');
                $('#Password').val('');
                $('#IdCabang').val('');
                $('#IdPerusahaan').val('');
                ruleDiv();
            });

            $("#addFormAdmin").on("click", function() {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url() ?>User/post_user",
                    data: "IdKurir=null&Username="+$('#Username').val()+"&Password="+$('#Password').val()+"&Role="+$('#Role').val()+"&IdPerusahaan="+$('#IdPerusahaan').val()+"&IdCabang="+$("#IdCabang").val(),
                    dataType: "json",
                    success: function (hasil) {
                        console.log(hasil)
                        $('#modalUserAdmin').modal().hide();
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
                        $('#Username').val('');
                        $('#Password').val('');
                        $('#Role').val('');
                        $('#IdPerusahaan').val('');
                    }
                });
            })

            // Update User
            $("#myTable").on("click", 'td.updateUserAdmin', function() {
                console.log(table.row(this).data());
                const data = table.row(this).data();
                $('#updateFormAdmin').show();
                $('#addFormAdmin').hide();
                $('#IdUser').prop('disabled', false);
                $('#IdUser').val(data.IdUsers);
                $('#Username').val(data.Username);
                $('#Role').val(data.Role);
                $('#IdCabang').val(data.IdCabang);
                $('#IdPerusahaan').val(data.IdPerusahaan);
                ruleDiv();
            })

            $("#updateFormAdmin").on("click", function() {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url() ?>User/put_user",
                    data: "IdKurir=null&IdUser="+$('#IdUser').val()+"&Username="+$('#Username').val()+"&Password="+$('#Password').val()+"&Role="+$('#Role').val()+"&IdPerusahaan="+$('#IdPerusahaan').val()+"&IdCabang="+$("#IdCabang").val(),
                    dataType: "json",
                    success: function (hasil) {
                        console.log(hasil)
                        $('#modalUserAdmin').modal().hide();
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
                        $('#Username').val('');
                        $('#Role').val('');
                        $('#Password').val('');
                        $('#IdPerusahaan').val('');
                    }
                });
            })

            // Delete User
            $("#myTable").on("click", 'td.deleteUser', function() {
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
                        url: "<?php echo base_url() ?>User/delete_User",
                        data: "IdUsers="+data.IdUsers,
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

    <script type="text/javascript">
        $(document).ready( function () {
            var table = $('#myTableKurir').DataTable({
                scrollX: true,
                <?php if ($this->session->userdata('Role') == 1) {?>
                    ajax: '<?php echo base_url()?>User/get_user_all_kurir',
                <?php } else if ($this->session->userdata('Role') == 2) {?>
                    ajax: '<?php echo base_url()?>User/get_user_kurir',
                <?php } else { ?>
                    ajax: '<?php echo base_url()?>User/get_user_kurir_cabang',
                <?php } ?>
                columns: [
                    { data: 'IdUsers' },
                    { data: 'NamaKurir' },
                    { data: 'Username' },
                    { data: 'Password' },
                    <?php if (($this->session->userdata('Role') == '1')) {?>
                        { data: 'IdPerusahaan' },
                        { data: 'NamaPerusahaan' },
                    <?php } ?>
                    { data: 'IdCabang' },
                    { data: 'NamaCabang' },
                    {
                        data: null,
                        className: "dt-center updateUserKurir",
                        defaultContent: '<button class="btn btn-warning updateUserKurir" data-toggle="modal" data-target="#modalUserKurir"><i class="fa fa-pencil"></i> Update</button>',
                        orderable: false
                    },
                    {
                        data: null,
                        className: "dt-center deleteUser",
                        defaultContent: '<button class="btn btn-danger delete"><i class="fa fa-trash"></i> Delete</button'
                    }
                ]
            });

            // Add User
            $("#addUserKurir").on("click", function() {
                $('#updateFormKurir').hide();
                $('#addFormKurir').show();
                $('#kurir').show();
                $('#IdUserKurir').prop('disabled', true);
                $('#UsernameKurir').val('');
                $('#PasswordKurir').val('');
                $('#IdKurir').val('');
            });

            $("#addFormKurir").on("click", function() {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url() ?>User/post_User",
                    data: "Role=null&IdPerusahaan=null&IdCabang=null&Username="+$('#UsernameKurir').val()+"&Password="+$('#PasswordKurir').val()+"&IdKurir="+$('#IdKurir').val(),
                    dataType: "json",
                    success: function (hasil) {
                        console.log(hasil)
                        $('#modalUserKurir').modal().hide();
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
                        $('#Username').val('');
                        $('#Password').val('');
                    }
                });
            })

            // Update User
            $("#myTableKurir").on("click", 'td.updateUserKurir', function() {
                console.log(table.row(this).data());
                const data = table.row(this).data();
                $('#updateFormKurir').show();
                $('#addFormKurir').hide();
                $('#kurir').hide();
                $('#IdUserKurir').prop('disabled', false);
                $('#IdUserKurir').val(data.IdUsers);
                $('#UsernameKurir').val(data.Username);
            })

            $("#updateFormKurir").on("click", function() {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url() ?>User/put_user",
                    data: "IdUser="+$('#IdUserKurir').val()+"&Username="+$('#UsernameKurir').val()+"&Password="+$('#PasswordKurir').val(),
                    dataType: "json",
                    success: function (hasil) {
                        console.log(hasil)
                        $('#modalUserKurir').modal().hide();
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
                        $('#Username').val('');
                        $('#Role').val('');
                        $('#Password').val('');
                        $('#IdPerusahaan').val('');
                    }
                });
            })

            // Delete User
            $("#myTableKurir").on("click", 'td.deleteUser', function() {
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
                        url: "<?php echo base_url() ?>User/delete_User",
                        data: "IdUsers="+data.IdUsers,
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