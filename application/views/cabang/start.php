<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view('cabang/css/css')?>
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
                  <h4 class="page-title">Cabang</h4>
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
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCabang" id="addCabang">
                        Tambah Cabang
                      </button>
                    </div>
                      <table id="myTable" class="table table-striped">
                        <thead>
                          <th>Id</th>
                          <th>Nama</th>
                          <th>Alamat</th>
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
    <div class="modal fade" id="modalCabang" tabindex="-1" role="dialog" aria-labelledby="modalCabangTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Form Cabang</h5>
          </div>
          <div class="modal-body">
            <form class="forms-sample">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="hidden" name="idCabang" id="idCabang">
                <input type="text" class="form-control" id="nama" placeholder="Nama">
              </div>
              <div class="form-group">
                <label for="Alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" placeholder="Alamat">
              </div>
              <?php if($this->session->userdata('Role') == 1){?>
                <div>
                  <label for="Perusahaan">Perusahaan</label>
                  <select class="form-control" id="idPerusahaan">
                    <option value="0">Pilih Perusahaan</option>
                    <?php foreach ($data['data'] as $data) {?>
                          <option value="<?php echo $data['IdPerusahaan'];?>"><?php echo $data["IdPerusahaan"]." - ".$data["NamaPerusahaan"];?></option>
                      <?php } ?>
                  </select>
                </div>
              <?php } ?>
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
    <?php $this->load->view('cabang/js/js')?>
</html>