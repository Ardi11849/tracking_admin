<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view('perusahaan/css/css')?>
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
                  <h4 class="page-title">Perusahaan</h4>
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
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPerusahaan" id="addPerusahaan">
                        Tambah Perusahaan
                      </button>
                    </div>
                      <table id="myTable" class="table">
                        <thead>
                          <th>Id Perusahaan</th>
                          <th>Nama Perusahaan</th>
                          <th>Status</th>
                          <th></th>
                          <th></th>
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
    <div class="modal fade" id="modalPerusahaan" tabindex="-1" role="dialog" aria-labelledby="modalPerusahaanTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Form Perusahaan</h5>
          </div>
          <div class="modal-body">
            <form class="forms-sample">
              <div class="form-group">
                <label for="Nama">Nama Perusahaan</label>
                <input type="hidden" name="IdPerusahaan" id="IdPerusahaan">
                <input type="text" class="form-control" id="Nama" placeholder="Nama Perusahaan">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
            <button type="button" class="btn btn-primary" id="addForm">Tambah changes</button>
            <button type="button" class="btn btn-warning" id="updateForm">Update changes</button>
          </div>
        </div>
      </div>
    </div>
  </body>
    <?php $this->load->view('perusahaan/js/js')?>
</html>