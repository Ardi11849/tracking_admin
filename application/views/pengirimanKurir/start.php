<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view('pengirimanKurir/css/css')?>
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
                  <h4 class="page-title">Penerima</h4>
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
                    <!-- <div class="col-md-12 grid-margin all">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalpenerima" id="addPenerima">
                        Tambah Penerima
                      </button> -->
                      <!-- <form action="<?php echo base_url();?>Penerima/upload" class="excel-upl" id="excel-upl" enctype="multipart/form-data" method="post" accept-charset="utf-8"> 
                      <form class="excel-upl" id="excel-upl" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        <div class="row padall">
                          <div class="col-lg-6 order-lg-1">
                            <input type="file" class="custom-file-input" id="validatedCustomFile" name="fileURL">
                            <label class="custom-file-label" for="validatedCustomFile" id="textvalidatedCustomFile">Choose file...</label>
                          </div>
                          <div class="col-lg-6 order-lg-2">
                            <button type="button" name="import" id="import" class="float-right btn btn-primary">Import</button>
                          </div>
                        </div>
                      </form>
                    </div> -->
                      <table id="myTable" class="table">
                        <thead>
                          <th>Id</th>
                          <th>No Resi</th>
                          <th>Id Kurir</th>
                          <th>Kurir</th>  
                          <th>Pengirim</th>
                          <th>Hp Pengirim</th>
                          <th>Penerima</th>
                          <th>Hp Penerima</th>
                          <th>Alamat Penerima</th>
                          <th>Status</th>
                          <th>Diterima</th>
                          <th>Foto</th>
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
                    <h4 class="card-title mb-0">penerima Maps Overview</h4>
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
    <div class="modal fade" id="modalpenerima" tabindex="-1" role="dialog" aria-labelledby="modalpenerimaTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Form Penerima</h5>
          </div>
          <div class="modal-body">
            <form class="forms-sample">
              <div class="form-group">
                <input type="hidden" name="IdPengirimanKurir" id="IdPengirimanKurir">
                <select class="form-control" data-live-search="true" data-width="100%" id="NoResi" placeholder="Pilih No Resi">
                  <option value="">Pilih No Resi</option>
                  <?php foreach ($pengiriman['data'] as $data) {?>
                    <option value="<?php echo $data['NoResi'];?>" data-pengirim="<?php echo $data['Pengirim']; ?>" data-noPengirim="<?php echo $data['NoTelpPengirim'];?>" data-penerima="<?php echo $data['Penerima'];?>" data-noPenerima="<?php echo $data['NoTelpPenerima'];?>" data-alamatPenerima="<?php echo $data['AlamatPenerima'];?>"><?php echo $data["NoResi"]; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <select class="form-control" id="IdKurir" data-live-search="true" data-width="100%" placeholder="Pilih Kurir">
                  <option value="">Pilih Kurir</option>
                  <?php foreach ($kurir['data'] as $kurir) {?>
                        <option value="<?php echo $kurir['IdKurir'];?>"><?php echo $kurir["IdKurir"]." - ".$kurir["Nama"];?></option>
                    <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="Penerima">Penerima</label>
                <input type="text" class="form-control" id="Penerima" placeholder="Penerima">
              </div>
              <div class="form-group">
                <label for="Alamat">Alamat</label>
                <input type="text" class="form-control" id="Alamat" placeholder="Alamat">
              </div>
              <div class="form-group">
                <label for="NoHpPenerima">Handphone Penerima</label>
                <input type="text" class="form-control" id="NoHpPenerima" placeholder="NoHpPenerima">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
            <button type="button" class="btn btn-warning" id="updateForm">Update changes</button>
          </div>
        </div>
      </div>
    </div>
  </body>
    <?php $this->load->view('pengirimanKurir/js/js')?>
</html>