<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view('kurir/css/css')?>
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
                  <h4 class="page-title">Kurir</h4>
                  <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">
                  </div>
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
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalKurir" id="addKurir">
                        Tambah Kurir
                      </button>
                    </div>
                      <table id="myTable" class="table table-striped">
                        <thead>
                          <th>Id</th>
                          <th>Nama</th>
                          <th>No Telp</th>
                          <th>Perusahaan</th>
                          <th></th>
                          <th></th>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title mb-0">kurir Maps Overview</h4>
                    <div class="d-flex flex-column flex-lg-row">
                      <p>Lihat Pengemudi di bawah</p>
                    </div>
                    <div id="map"></div>
                  </div>
                </div>
              </div>
            </div> -->
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
    <!-- Modal -->
    <div class="modal fade" id="modalKurir" tabindex="-1" role="dialog" aria-labelledby="modalKurirTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Form Kurir</h5>
          </div>
          <div class="modal-body">
            <form class="forms-sample">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="hidden" name="idKurir" id="idKurir">
                <input type="text" class="form-control" id="nama" placeholder="Nama">
              </div>
              <div class="form-group">
                <label for="NoTelp">No Telepon</label>
                <input type="text" class="form-control" id="noTelp" placeholder="No Telepon">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
            <button type="button" class="btn btn-primary" id="addForm">Save changes</button>
            <button type="button" class="btn btn-warning" id="updateForm">Update changes</button>
          </div>
        </div>
      </div>
    </div>
  </body>
    <?php $this->load->view('kurir/js/js')?>
</html>