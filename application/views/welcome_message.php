<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo base_url()?>template/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>template/Loading-Overlay/waitMe.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>template/assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="<?php echo base_url()?>template/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>template/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?php echo base_url()?>template/assets/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo base_url()?>template/assets/css/shared/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?php echo base_url()?>template/assets/images/favicon.ico" />
  </head>
  <body>
  	<div id="loading">
	    <div class="container-scroller">
	      <div class="container-fluid page-body-wrapper full-page-wrapper">
	        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
	          <div class="row w-100">
	            <div class="col-lg-4 mx-auto">
	              <div class="auto-form-wrapper">
	                  <div class="form-group">
	                    <label class="label">Username</label>
	                    <div class="input-group">
	                      <input type="text" class="form-control" placeholder="Username" id="username">
	                      <div class="input-group-append">
	                        <span class="input-group-text">
	                          <i class="mdi mdi-check-circle-outline"></i>
	                        </span>
	                      </div>
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <label class="label">Password</label>
	                    <div class="input-group">
	                      <input type="password" class="form-control" placeholder="*********" id="password">
	                      <div class="input-group-append">
	                        <span class="input-group-text">
	                          <i class="mdi mdi-check-circle-outline"></i>
	                        </span>
	                      </div>
	                    </div>
	                  </div>
	                  <div class="form-group">
	                    <button class="btn btn-primary submit-btn btn-block" id="login">Login</button>
	                  </div>
	                  <div class="form-group d-flex justify-content-between">
	                    <a href="#" class="text-small forgot-password text-black">Forgot Password</a>
	                  </div>
	              </div>
	              <ul class="auth-footer">
	                <li>
	                  <a href="#">Conditions</a>
	                </li>
	                <li>
	                  <a href="#">Help</a>
	                </li>
	                <li>
	                  <a href="#">Terms</a>
	                </li>
	              </ul>
	              <p class="footer-text text-center">copyright © 2018 Bootstrapdash. All rights reserved.</p>
	            </div>
	          </div>
	        </div>
	        <!-- content-wrapper ends -->
	      </div>
	      <!-- page-body-wrapper ends -->
	    </div>
	</div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo base_url()?>template/jquery.min.js"></script>
    <script src="<?php echo base_url()?>template/Loading-Overlay/waitMe.min.js"></script>
    <script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?php echo base_url()?>template/assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="<?php echo base_url()?>template/assets/js/shared/off-canvas.js"></script>
    <script src="<?php echo base_url()?>template/assets/js/shared/misc.js"></script>
    <!-- endinject -->
  </body>
  <script type="text/javascript">
  	$("#login").click(function() {
  		$("#login").attr("disabled",true)
  		if ($("#username").val() == "") {
	        Swal.fire({
			  icon: 'error',
			  title: 'Gagal',
			  text: 'Masukan username anda'
			})
	    }
  		if ($("#password").val() == "") {
	        Swal.fire({
			  icon: 'error',
			  title: 'Gagal',
			  text: 'Masukan password anda'
			})
	    }
  		try{
	  		$.ajax({
	  			type: "post",
	  			url: "<?php echo base_url()?>Welcome/Login",
	  			data: "Username="+$("#username").val()+"&Password="+$("#password").val(),
	  			dataType: "json",
	  			success: function(hasil) {
	  				$("#login").attr("disabled",false)
	  				console.log(hasil)
	  				if (hasil === 500) {
		         Swal.fire({
							  icon: 'error',
							  title: 'Gagal',
							  text: 'Server Error Harap Hubungi Developer'
							})
	  				}else if (hasil === 0 || !hasil) {
		          Swal.fire({
							  icon: 'error',
							  title: 'Gagal',
							  text: 'Periksa kembali username atau password anda'
							})
	  				}else if (hasil === 401) {
		          Swal.fire({
							  icon: 'error',
							  title: 'Gagal',
							  text: 'Account Telah Di Non Aktifkan'
							})
	  				}else{
	  					window.location.href = "<?php echo base_url()?>Tracking";
	  				}
	  			}
	  		})
	  	}catch(err){
            Swal.fire({
			  icon: 'error',
			  title: 'Gagal',
			  text: err
			})
	  	}
  	})
  </script>
</html>