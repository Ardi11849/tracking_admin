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
                  <h4 class="page-title">Tambah Penerima</h4>
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
					    <form>
						  <div class="row">
						    <div class="col">
                  <select class="selectpicker form-control" data-live-search="true" id="noresi" placeholder="Pilih No Resi">
                    <option value="">Pilih No Resi</option>
                    <?php foreach ($pengiriman['data'] as $data) {?>
                      <option value="<?php echo $data['NoResi'];?>" data-pengirim="<?php echo $data['Pengirim']; ?>" data-noPengirim="<?php echo $data['NoTelpPengirim'];?>" data-penerima="<?php echo $data['Penerima'];?>" data-noPenerima="<?php echo $data['NoTelpPenerima'];?>" data-alamatPenerima="<?php echo $data['AlamatPenerima'];?>"><?php echo $data["NoResi"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
						    <div class="col">
						    	<select class="form-control" id="kurir" placeholder="Pilih Kurir">
                    <option value="">Pilih Kurir</option>
                    <?php foreach ($kurir['data'] as $data) {?>
                          <option value="<?php echo $data['IdKurir'];?>"><?php echo $data["IdKurir"]." - ".$data["Nama"];?></option>
                      <?php } ?>
						    	</select>
						    </div>
						  </div>
              <div class="row" style="padding-top: 5px">
                <div class="col">
                  <input type="text" class="form-control" placeholder="Pengirim" id="pengirim">
                </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="No Pengirim" id="nohppengirim">
                </div>
              </div>
						  <div class="row" style="padding-top: 5px">
						    <div class="col">
						      <input type="text" class="form-control" placeholder="Penerima" id="penerima">
						    </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="No Penerima" id="nohppenerima">
                </div>
						  </div>
						  <div class="row" style="padding-top: 10px">
                <div class="col">
                  <input type="text" class="form-control" placeholder="Alamat" id="alamat">
                </div>
						    <div class="col">
						  		<input type="button" class="btn btn-primary" value="Masukan" onclick="insert()" />
						    </div>
						  </div>
						</form>
                    </div>
                    	<table class="table" style="overflow-x: scroll; width: auto; display: block;">
                    		<thead>
                    			<th>No Resi</th>
                    			<th>Kurir</th>
                          <th>Pengirim</th>
                          <th>No Pengirim</th>
                    			<th>Penerima</th>
                    			<th>No Penerima</th>
                          <th>Alamat</th>
                    		</thead>
                    		<tbody id="display"></tbody>
                    		<tfoot><th colspan="10"><button class="btn btn-primary" onclick="save()">Simpan</button></th></tfoot>
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
  </body>
    <?php $this->load->view('pengirimanKurir/js/tambah_js')?>
</html>