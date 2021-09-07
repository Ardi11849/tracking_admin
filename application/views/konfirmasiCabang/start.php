<!DOCTYPE html>
<html>
<?php $this->load->view('konfirmasiCabang/css/css.php')?>
<body>
    <div class="container-scroller" id="isiDiv">
      <!-- partial:partials/_navbar.html -->
      <?php $this->load->view('template/navbar');?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php $this->load->view('template/sidebar');?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <!-- Page Title Header Starts-->
            <div class="row page-title-header">
              <div class="col-12">
                <div class="page-header">
                  <h4 class="page-title">Konfirmasi Pengiriman Cabang</h4>
                </div>
              </div>
              <div class="col-md-12">
                <div class="page-header-toolbar">
                </div>
              </div>
            </div>
            <!-- Page Title Header Ends-->
			<div class="row">
				<?php if(!$konfirmasi)die(); foreach($konfirmasi['data'] as $data){?>
		          <div class="col-md-4 grid-margin stretch-card">
		            <div class="card">
		              <div class="card-body">
		                <h4 class="card-title mb-0">Peniriman Cabang</h4>
		                <div class="d-flex py-2 border-bottom">
		                  <div class="wrapper">
		                    <small class="text-muted">Nama Cabang</small>
		                    <p class="font-weight-semibold text-gray mb-0"><?php echo $data["NamaCabang"];?></p>
		                  </div>
		                  <small class="text-muted ml-auto">Lihat Detail</small>
		                </div>
		                <div class="d-flex py-2 border-bottom">
		                  <div class="wrapper">
		                    <small class="text-muted">Tujuan Pengiriman</small>
		                    <p class="font-weight-semibold text-gray mb-0"><?php echo $data["Tujuan"];?></p>
		                  </div>
		                  <!-- <small class="text-muted ml-auto">Lihat Detail</small> -->
		                </div>
		                <div class="d-flex py-2 border-bottom">
		                  <div class="wrapper">
		                    <small class="text-muted">Nama Kurir</small>
		                    <p class="font-weight-semibold text-gray mb-0"><?php echo $data["NamaKurir"];?></p>
		                  </div>
		                  <small class="text-muted ml-auto">Lihat Detail</small>
		                </div>
		                <div class="d-flex py-2 border-bottom">
		                  <div class="wrapper">
		                    <small class="text-muted">Jumlah Resi</small>
		                    <p class="font-weight-semibold text-gray mb-0"><?php echo $data["JumlahResi"];?></p>
		                  </div>
		                  <small class="text-muted ml-auto">Lihat Detail</small>
		                </div>
		                <div class="d-flex pt-2">
		                  <div class="wrapper">
		                    <small class="text-muted">Mar 14, 2019</small>
		                    <p class="font-weight-semibold text-gray mb-0">Change in Directors</p>
		                  </div>
		                  <small class="text-muted ml-auto">Lihat Detail</small>
		                </div>
		                <button class="d-block mt-5 btn btn-primary" id="konfirmasi" data-id="<?php echo $data['IdKurir']?>">Konfirmasi</button>
		              </div>
		            </div>
		          </div>
	          <?php } ?>
	        </div>
		  </div>
		</div>
	  </div>
	</div>
</body>
<?php $this->load->view('konfirmasiCabang/js/js.php')?>
</html>