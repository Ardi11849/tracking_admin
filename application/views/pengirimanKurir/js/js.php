
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
                            window.location.replace("<?php echo base_url()?>PengirimanKurir/tambah");
                        }
                    }
                ],
                <?php if ($this->session->userdata("Role") == 1) {?>
                    ajax: '<?php echo base_url()?>PengirimanKurir/get_penerima_all',
                <?php } else if($this->session->userdata("Role") == 2) {?>
                    ajax: '<?php echo base_url()?>PengirimanKurir/get_penerima',
                <?php } else { ?>
                    ajax: '<?php echo base_url()?>PengirimanKurir/get_penerima_cabang',
                <?php } ?>
                "columnDefs": [
                    {
                        "targets": [ 0 ],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        "targets": [ 2 ],
                        "visible": false,
                        "searchable": false
                    },
                ],
                columns: [
                    { data: 'IdPengirimanKurir' },
                    { data: 'NoResi' },
                    { data: 'IdKurir' },
                    { data: 'Nama' },
                    { data: 'Pengirim' },
                    { data: 'NoTelpPengirim' },
                    { data: 'Penerima' },
                    { data: 'NoTelpPenerima' },
                    { data: 'AlamatPenerima' },
                    { 
                        data: 'Status',
                        render: function(data, type, row){
                            if (data == 1) {
                                return "Terkirim"
                            }else{
                                return "Dalam Proses"
                            }
                        }
                    },
                    { data: 'Diterima' },
                    { 
                        data: 'Foto',
                        render: function(data, type, row){
                            if (!data) {
                                return ""
                            }else{
                                return "<img src='https://damp-shore-65068.herokuapp.com/"+data.replace("./public", '')+"' style='width:100px;height:auto;border-radius:0%'></img>"
                            }
                        }
                    },
                    {
                        data: null,
                        className: "dt-center updatePenerima",
                        defaultContent: '<button class="btn btn-warning updatePenerima" data-toggle="modal" data-target="#modalpenerima"><i class="fa fa-pencil"></i> Ubah</button>',
                        orderable: false
                    },
                    {
                        data: null,
                        className: "dt-center deletePenerima",
                        defaultContent: '<button class="btn btn-danger delete"><i class="fa fa-trash"></i> Hapus</button>'
                    }
                ]
            });
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
            
            $.fn.dataTable.ext.errMode = 'none';


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
                    url: '<?php echo base_url();?>PengirimanKurir/upload', // point to server-side PHP script 
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
                window.location = '<?php echo base_url()?>PengirimanKurir/tambah';
            });

            // Update Pengiriman
            $("#myTable").on("click", 'td.updatePenerima', function() {
                const data = table.row(this).data();
                $('#updateForm').show();
                $('#IdPengirimanKurir').val(data.IdPengirimanKurir);
                $('#IdKurir').val(data.IdKurir);
                $('#IdKurir').trigger('change');
                $('#NoResi').val(data.NoResi);
                $('#NoResi').trigger('change');
                $('#Penerima').val(data.Penerima);
                $('#Alamat').val(data.AlamatPenerima);
                $('#NoHpPenerima').val(data.NoTelpPenerima);
            })

            $("#updateForm").on("click", function() {
                $("#updateForm").attr("disabled", true)
                console.log($('#IdPengirimanKurir').val());
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url() ?>PengirimanKurir/put_penerima",
                    data: "IdPengirimanKurir="+$('#IdPengirimanKurir').val()+"&NoResi="+$('#NoResi').val()+"&IdKurir="+$('#IdKurir').val()+"&Penerima="+$('#Penerima').val()+"&Alamat="+$('#Alamat').val()+"&NoHpPenerima="+$('#NoHpPenerima').val(),
                    dataType: "json",
                    success: function (hasil) {
                        $("#updateForm").attr("disabled", false)
                        console.log(hasil)
                        $('#modalpenerima').modal().hide();
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
            $("#myTable").on("click", 'td.deletePenerima', function() {
                const data = table.row(this).data();
                console.log(data)
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
                        url: "<?php echo base_url() ?>PengirimanKurir/delete_penerima",
                        data: "IdPengirimanKurir="+data.IdPengirimanKurir,
                        dataType: "json",
                        success: function (hasil) {
                            console.log(hasil)
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