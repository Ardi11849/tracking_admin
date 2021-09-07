
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo base_url()?>template/jquery.min.js"></script>
    <script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="<?php echo base_url()?>template/assets/js/shared/off-canvas.js"></script>
    <script src="<?php echo base_url()?>template/assets/js/shared/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?php echo base_url()?>template/assets/js/demo_1/dashboard.js"></script>
    <!-- End custom js for this page-->
    <script type="text/javascript">
        $("button.d-block").on('click', function() {
            Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Apakah Anda Yakin Ingin Konfirmasi Pengiriman!",
              icon: 'success',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Konfirmasi!'
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url() ?>KonfirmasiCabang/konfirmasi",
                    data: "IdKurir="+$(this).data('id'),
                    dataType: "json",
                    success: function (hasil) {
                        if (!hasil.message) {
                            Swal.fire(
                              'Berhasil!',
                              'Pengiriman Berhasil Di Konfirmasi.',
                              'success'
                            )
                            $('#isiDiv').load(window.location.href + "#isiDiv" );
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
    </script>