
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
            var data = []
            var table = $('#myTable').DataTable({
                scrollX: true,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print',
                    {
                        text: 'Tambah',
                        action: function ( e, dt, node, config ) {
                            window.location.replace("<?php echo base_url()?>PengirimanCabang/tambah");
                        }
                    }
                ],
                ajax: '<?php echo base_url()?>PengirimanCabang/get_pengiriman',
                "columnDefs": [
                    {
                        "targets": [ 2 ],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        "targets": [ 4 ],
                        "visible": false,
                        "searchable": false
                    }
                ],
                columns: [
                    { data: 'IdPengirimanCabang' },
                    { data: 'NoResi' },
                    { data: 'IdCabang' },
                    { data: 'Nama' },
                    { data: 'IdKurir' },
                    { data: 'NamaKurir' },
                    { data: 'AlamatTransit' },
                    { data: 'Pengirim' },
                    { data: 'NoTelpPengirim' },
                    { data: 'Penerima' },
                    { data: 'NoTelpPenerima' },
                    { data: 'AlamatPenerima' },
                    { 
                        data: 'Status',
                        render: function(data, type, row) {
                            if (data === '0') {return 'Belum Terkirim'}
                            if (data === '1') {return 'Terkirim'}
                        }
                    },
                    {
                        data: null,
                        className: "dt-center updatePengirimanCabang",
                        defaultContent: '<button class="btn btn-warning updatePengirimanCabang" data-toggle="modal" data-target="#modalPengirimanCabang"><i class="fa fa-pencil"></i> Ubah</button>',
                        orderable: false
                    },
                    {
                        data: null,
                        className: "dt-center deletePengrimanCabang",
                        defaultContent: '<button class="btn btn-danger delete"><i class="fa fa-trash"></i> Hapus</button>'
                    }
                ]
            });
            
            $.fn.dataTable.ext.errMode = 'none';
            $('#myTable tbody').on( 'click', 'tr', function () {
                data.length = 0
                data.push(table.row( this ).data())
                console.log( data );
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            } );


            // Import From Excel
            $("#validatedCustomFile").on('change', function() {
                console.log($('#validatedCustomFile').prop('files')[0]['name']);
                $("#textvalidatedCustomFile").text($('#validatedCustomFile').prop('files')[0]['name']);
            })
            $('#import').on('click', function() {
                var file_data = $('#validatedCustomFile').prop('files')[0];   
                var form_data = new FormData();                  
                form_data.append('file', file_data);
                console.log(form_data);       
                $.ajax({
                    url: '<?php echo base_url();?>Penerima/upload', // point to server-side PHP script 
                    dataType: 'text',  // what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,                         
                    type: 'post',
                    success: function(data){
                        table.ajax.reload();
                        Swal.fire(
                          'Berhasil!',
                          'Data Berhasil Ditambahkan.',
                          'success'
                        );
                    }
                 });
            });

            // Add Pengiriman
            $(".addPenerima").on("click", function() {
                window.location = '<?php echo base_url()?>Penerima/tambah';
            });

            // Update Pengiriman
            $("#myTable").on("click", 'td.updatePengirimanCabang', function() {
                const data = table.row(this).data();
                $('#updateForm').show();
                $('#IdPengirimanCabang').val(data.IdPengirimanCabang);
                $('#NoResi').val(data.NoResi);
                $('#NoResi').trigger('change');
                $('#Kurir').val(data.Kurir);
                $('#Kurir').trigger('change');
                $('#IdCabang').val(data.IdCabang);
                $('#IdCabang').trigger('change');
                $('#IdKurir').val(data.IdKurir);
                $('#IdKurir').trigger('change');
                $('#AlamatTransit').val(data.AlamatTransit);
                $('#Pengirim').val(data.Pengirim);
                $('#NoTelpPengirim').val(data.NoTelpPengirim);
                $('#Penerima').val(data.Penerima);
                $('#NoTelpPenerima').val(data.NoTelpPenerima);
                $('#AlamatPenerima').val(data.AlamatPenerima);
            })

            $("#updateForm").on("click", function() {
                $("#updateForm").attr("disabled", true)
                console.log($('#IdPengirimanCabang').val());
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url() ?>PengirimanCabang/put_pengiriman",
                    data: "IdPengirimanCabang="+$('#IdPengirimanCabang').val()+"&NoResi="+$('#NoResi').val()+"&IdCabang="+$('#IdCabang').val()+"&IdKurir="+$('#IdKurir').val()+"&AlamatTransit="+$('#AlamatTransit').val()+"&Pengirim="+$('#Pengirim').val()+"&NoTelpPengirim="+$('#NoTelpPengirim').val()+"&Penerima="+$('#Penerima').val()+"&NoTelpPenerima="+$('#NoTelpPenerima').val()+"&AlamatPenerima="+$('#AlamatPenerima').val(),
                    dataType: "json",
                    success: function (hasil) {
                        $("#updateForm").attr("disabled", false)
                        console.log(hasil)
                        $('#modalPengirimanCabang').modal().hide();
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
            $("#myTable").on("click", 'td.deletePengrimanCabang', function() {
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
                        url: "<?php echo base_url() ?>PengirimanCabang/delete",
                        data: "IdPengirimanCabang="+data.IdPengirimanCabang,
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
                            }                        }
                    });
                  }
                })
            })
        } );
    </script>