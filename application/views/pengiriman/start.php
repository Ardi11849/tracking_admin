<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view('pengiriman/css/css')?>
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
                  <h4 class="page-title">Pengiriman</h4>
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
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPengiriman" id="addPenerimaan">
                        Tambah Pengiriman
                      </button>
                    </div>
                      <table id="myTable" class="table table-striped">
                        <thead>
                          <th>No Resi</th>
                          <th>Perusahaan</th>
                          <th>Cabang</th>
                          <th>Pengirim</th>
                          <th>No Pengirim</th>
                          <th>Penerima</th>
                          <th>No Penerima</th>
                          <th>Alamat Penerima</th>
                          <th>Status</th>
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
    <div class="modal fade" id="modalPengiriman" role="dialog" aria-labelledby="modalPengirimanTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Form Pengiriman</h5>
          </div>
          <div class="modal-body">
            <form class="forms-sample">
              <div class="form-group">
                <label for="nama">No Resi</label>
                <input type="text" class="form-control" id="NoResi" placeholder="No Resi">
              </div>
              <?php if ($this->session->userdata('Role') == '1' || $this->session->userdata('Role') == '2') { ?>
              <?php if ($this->session->userdata('Role') == '1') { ?>
                  <div class="form-group">
                    <select class="form-control" data-live-search="true" data-width="100%" id="IdPerusahaan">
                      <option>Pilih Perusahaan</option>
                      <?php foreach ($perusahaan['data'] as $data) {?>
                            <option value="<?php echo $data['IdPerusahaan'];?>"><?php echo $data["IdPerusahaan"]." - ".$data["NamaPerusahaan"];?></option>
                        <?php } ?>
                    </select>
                  </div>
                <?php } ?>
              <div class="form-group" id="divCabang">
                <select class="form-control" data-live-search="true" data-width="100%" id="IdCabang">
                  <option>Pilih Cabang</option>
                  <?php foreach ($cabang['data'] as $data) {?>
                        <option value="<?php echo $data['IdCabang'];?>"><?php echo $data["IdCabang"]." - ".$data["Nama"];?></option>
                    <?php } ?>
                </select>
              </div>
              <?php } ?>
              <div class="form-group">
                <label for="NoTelp">Pengirim</label>
                <input type="text" class="form-control" id="Pengirim" placeholder="Pengirim">
              </div>
              <div class="form-group">
                <label for="nama">No Telp Pengirim</label>
                <input type="text" class="form-control" id="NoTelpPengirim" placeholder="No Telp Pengirim">
              </div>
              <div class="form-group">
                <label for="NoTelp">Penerima</label>
                <input type="text" class="form-control" id="Penerima" placeholder="Penerima">
              </div>
              <div class="form-group">
                <label for="NoTelp">No Telp Penerima</label>
                <input type="text" class="form-control" id="NoTelpPenerima" placeholder="No Telp Penerima">
              </div>
              <div class="form-group">
                <label for="nama">Alamat Penerima</label>
                <input type="text" class="form-control" id="AlamatPenerima" placeholder="Alamat Penerima">
              </div>
              <div class="form-group">
                <select class="form-control" data-live-search="true" data-width="100%" id="Status">
                  <option>Pilih Status</option>
                  <option value="0">Di Batalkan</option>
                  <option value="1">Terkirim</option>
                  <option value="2">Pengiriman Kurir</option>
                  <option value="3">Di Terima Oleh Cabang</option>
                  <option value="4">Pengiriman Ke Cabang</option>
                  <option value="5">Belum Di Proses</option>
                </select>
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
    <?php $this->load->view('pengiriman/js/js')?>
</html>