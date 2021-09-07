<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view('penerima/css/css')?>
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
						      <input type="text" class="form-control" placeholder="No Resi" id="noresi">
						    </div>
						    <div class="col">
						    	<select class="form-control" id="kurir" placeholder="Pilih Kurir">
                    <?php foreach ($data['data'] as $data) {?>
                          <option value="<?php echo $data['IdKurir'];?>"><?php echo $data["IdKurir"]." - ".$data["Nama"];?></option>
                      <?php } ?>
						    	</select>
						    </div>
						  </div>
						  <div class="row" style="padding-top: 5px">
						    <div class="col">
						      <input type="text" class="form-control" placeholder="Penerima" id="penerima">
						    </div>
						    <div class="col">
						      <input type="text" class="form-control" placeholder="Alamat" id="alamat">
						    </div>
						  </div>
						  <div class="row" style="padding-top: 10px">
						    <div class="col">
						      <input type="text" class="form-control" placeholder="No Handphone" id="nohp">
						    </div>
						    <div class="col">
						  		<input type="button" class="btn btn-primary" value="Masukan" onclick="insert()" />
						    </div>
						  </div>
						</form>
                    </div>
                    	<table class="table">
                    		<thead>
                    			<th>No Resi</th>
                    			<th>Kurir</th>
                    			<th>Penerima</th>
                    			<th>Alamat</th>
                    			<th>No Handphone</th>
                    		</thead>
                    		<tbody id="display"></tbody>
                    		<tfoot><th colspan="5"><button class="btn btn-primary" onclick="save()">Simpan</button></th></tfoot>
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
    <?php $this->load->view('penerima/js/tambah_js')?>
</html>