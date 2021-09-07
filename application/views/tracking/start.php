<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view('tracking/css/css')?>
  </head>
  <body>
    <div class="container-scroller">
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
                  <h4 class="page-title">Dashboard <?php echo $this->session->userdata("Username");?></h4>
                </div>
              </div>
              <div class="col-md-12">
                <div class="page-header-toolbar">
                </div>
              </div>
            </div>
            <!-- Page Title Header Ends-->
            <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="card flex-nowrap">
                  <div class="card-body">
                    <div class="col-md-12 grid-margin all">
                      <input type="text" name="search" id="search" placeholder="cari.......">
                      <!-- <button class="all">Lacak Semua</button> -->
                    </div>
                    <div class="row scroll" id="area">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" id="cardMap">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title mb-0">Tracking Maps Overview</h4>
                    <div class="d-flex flex-column flex-lg-row">
                      <p>Lihat Pengemudi di bawah</p>
                    </div>
                    <div id="map"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php $this->load->view('template/footer');?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
  </body>
    <?php $this->load->view('tracking/js/js')?>
</html>