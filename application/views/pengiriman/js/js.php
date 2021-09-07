
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
        $(document).ready( function () {
            $('select').select2({
                theme: 'classic'
            });
            var table = $('#myTable').DataTable({
                <?php if ($this->session->userdata('Role') == '1') {?>
                    ajax: '<?php echo base_url()?>Pengiriman/get_all',
                <?php } elseif ($this->session->userdata('Role') == '2') {?>
                    ajax: '<?php echo base_url()?>Pengiriman/get',
                <?php } else {?>
                    ajax: '<?php echo base_url()?>Pengiriman/get_cabang',
                <?php } ?>
                scrollX: true,
                columns: [
                    { data: 'NoResi' },
                    { data: 'NamaPerusahaan' },
                    { data: 'Nama' },
                    { data: 'Pengirim' },
                    { data: 'NoTelpPengirim' },
                    { data: 'Penerima' },
                    { data: 'NoTelpPenerima' },
                    { data: 'AlamatPenerima' },
                    { 
                        data: 'Status',
                        render: function(data, type, row) {
                            if (data === '0') {return 'Pengiriman Di Batalkan'}
                            if (data === '1') {return 'Terkirim'}
                            if (data === '2') {return 'Pengiriman Kurir'}
                            if (data === '3') {return 'Di Terima Oleh Cabang'}
                            if (data === '4') {return 'Pengiriman Ke Cabang'}
                            if (data === '5') {return 'Belum Di Proses'}
                        }
                    },
                    {
                        data: null,
                        className: "dt-center updatePenerimaan",
                        defaultContent: '<button class="btn btn-warning updatePenerimaan" data-toggle="modal" data-target="#modalPengiriman"><i class="fa fa-pencil"></i> Update</button>',
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
            $("#addPenerimaan").on("click", function() {
                $('#updateForm').hide();
                $('#addForm').show();
                $('#NoResi').val('');
                $('#IdPerusahaan').val('');
                $('#IdCabang').val('');
                $('#Pengirim').val('');
                $('#NoTelpPengirim').val('');
                $('#Penerima').val('');
                $('#NoTelpPenerima').val('');
                $('#AlamatPenerima').val('');
                $('#Status').val('');
            });

            $("#addForm").on("click", function() {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url() ?>Pengiriman/post",
                    data: "NoResi="+$('#NoResi').val()+"&IdPerusahaan="+$('#IdPerusahaan').val()+"&IdCabang="+$('#IdCabang').val()+"&Pengirim="+$('#Pengirim').val()+"&NoTelpPengirim="+$('#NoTelpPengirim').val()+"&Penerima="+$('#Penerima').val()+"&NoTelpPenerima="+$('#NoTelpPenerima').val()+"&AlamatPenerima="+$('#AlamatPenerima').val()+"&Status="+$('#Status').val(),
                    dataType: "json",
                    success: function (hasil) {
                        $('#modalPengiriman').modal().hide();
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
            $("#myTable").on("click", 'td.updatePenerimaan', function() {
                console.log(table.row(this).data());
                const data = table.row(this).data();
                $('#updateForm').show();
                $('#addForm').hide();
                $('#NoResi').val(data.NoResi);
                $('#IdPerusahaan').val(data.IdPerusahaan);
                $('#IdPerusahaan').trigger('change');
                $('#IdCabang').val(data.IdCabang);
                $('#IdCabang').trigger('change');
                $('#Pengirim').val(data.Pengirim);
                $('#NoTelpPengirim').val(data.NoTelpPengirim);
                $('#Penerima').val(data.Penerima);
                $('#NoTelpPenerima').val(data.NoTelpPenerima);
                $('#AlamatPenerima').val(data.AlamatPenerima);
                $('#Status').val(data.Status);
            })

            $("#updateForm").on("click", function() {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url() ?>Pengiriman/put",
                    data: "NoResi="+$('#NoResi').val()+"&IdPerusahaan="+$('#IdPerusahaan').val()+"&IdCabang="+$('#IdCabang').val()+"&Pengirim="+$('#Pengirim').val()+"&NoTelpPengirim="+$('#NoTelpPengirim').val()+"&Penerima="+$('#Penerima').val()+"&NoTelpPenerima="+$('#NoTelpPenerima').val()+"&AlamatPenerima="+$('#AlamatPenerima').val()+"&Status="+$('#Status').val(),
                    dataType: "json",
                    success: function (hasil) {
                        $('#modalPengiriman').modal().hide();
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
                        url: "<?php echo base_url() ?>Pengiriman/delete",
                        data: "NoResi="+data.NoResi,
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