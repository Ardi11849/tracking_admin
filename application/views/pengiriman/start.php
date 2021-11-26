<!DOCTYPE html><html lang="en"><head><?php $this->load->view('pengiriman/css/css')?></head><body><div id="loading"><div class="container-scroller"><?php $this->load->view('template/navbar');?><div class="container-fluid page-body-wrapper"><?php $this->load->view('template/sidebar');?><div class="main-panel"><div class="content-wrapper"><div class="row page-title-header"><div class="col-12"><div class="page-header"><h4 class="page-title">Pengiriman</h4><div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap"></div></div></div><div class="col-md-12"><div class="page-header-toolbar"></div></div></div><div class="row"><div class="col-md-12 grid-margin"><div class="card flex-nowrap"><div class="card-body"><div class="col-md-12 grid-margin all"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPengiriman" id="addPenerimaan"><i class="fa fa-plus"></i> Tambah Pengiriman</button></div><table id="myTable" class="table table-striped"><thead><th>No</th><th>No Resi</th><th>Perusahaan</th><th>Cabang</th><th>Pengirim</th><th>Alamat Pengirim</th><th>No Pengirim</th><th>Penerima</th><th>No Penerima</th><th>Kota Besar</th><th>Kota</th><th>Alamat Lengkap</th><th>Sistem Pembayaran</th><th>Berat</th><th>Harga</th><th>Status</th><th>Tanggal Pembuatan</th><th></th><th></th></thead><tbody></tbody></table></div></div></div></div><div class="row page-title-header"><div class="col-12"><div class="page-header"><h4 class="page-title">Daftar Barang Yang Ada Di Tempat</h4></div></div><div class="col-md-12"><div class="page-header-toolbar"></div></div></div><div class="row"><div class="col-md-12 grid-margin"><div class="card flex-nowrap"><div class="card-body"><table id="myTableFromManifest" class="table table-striped"><thead><th>No</th><th>No Resi</th><th>Perusahaan</th><th>Cabang</th><th>Pengirim</th><th>Alamat Pengirim</th><th>No Pengirim</th><th>Penerima</th><th>No Penerima</th><th>Kota Besar</th><th>Kota</th><th>Alamat Lengkap</th><th>Berat</th><th>Status</th><th>Tanggal Pembuatan</th></thead><tbody></tbody></table></div></div></div></div></div><?php $this->load->view('template/footer');?></div></div></div><!-- Modal --><div class="modal fade" id="modalPengiriman" role="dialog" aria-labelledby="modalPengirimanTitle" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLongTitle">Form Pengiriman</h5></div><div class="modal-body"><form class="forms-sample"><div class="form-group"><input type="hidden" class="form-control" id="NoResi2" placeholder="No Resi"><label for="nama">No Resi</label><input type="text" class="form-control" id="NoResi" placeholder="No Resi"></div><?php if ($this->session->userdata('Role') == '1' || $this->session->userdata('Role') == '2') { ?><?php if ($this->session->userdata('Role') == '1') { ?><div class="form-group"><select class="form-control" data-live-search="true" data-width="100%" id="IdPerusahaan"><option value = ''>Pilih Perusahaan</option><?php foreach ($perusahaan['data'] as $data) {?><option value="<?php echo $data['IdPerusahaan'];?>"><?php echo $data["IdPerusahaan"]." - ".$data["NamaPerusahaan"];?></option><?php } ?></select></div><?php } ?><div class="form-group" id="divCabang"><select class="form-control" data-live-search="true" data-width="100%" id="IdCabang"><option value = ''>Pilih Cabang</option><?php foreach ($cabang['data'] as $data) {?><option value="<?php echo $data['IdCabang'];?>"><?php echo $data["IdCabang"]." - ".$data["Nama"];?></option><?php } ?></select></div><?php } ?><div class="form-group"><label for="NoTelp">Pengirim</label><input type="text" class="form-control" id="Pengirim" placeholder="Pengirim"></div><div class="form-group"><label for="NoTelp">Alamat Pengirim</label><textarea class="form-control" id="AlamatPengirim" placeholder="Alamat Pengirim"></textarea></div><div class="form-group"><label for="nama">No Telp Pengirim</label><input type="text" class="form-control number" id="NoTelpPengirim" placeholder="No Telp Pengirim"></div><div class="form-group"><label for="NoTelp">Penerima</label><input type="text" class="form-control" id="Penerima" placeholder="Penerima"></div><div class="form-group"><label for="NoTelp">No Telp Penerima</label><input type="text" class="form-control number" id="NoTelpPenerima" placeholder="No Telp Penerima"></div><div class="separator">Alamat Penerima</div><div class="form-group" id="divKotaBesar"><label>KotaBesar</label><select class="form-control" data-live-search="true" data-width="100%" id="KodeKotaBesar"><option value = ''>Pilih KotaBesar</option><?php foreach ($kotabesar['data'] as $data) {?><option value="<?php echo $data['KodeKotaBesar'];?>"><?php echo $data["KodeKotaBesar"]." - ".$data["NamaKotaBesar"];?></option><?php } ?></select></div><div class="form-group" id="divKota"><label>Kota</label><select class="form-control" data-live-search="true" data-width="100%" id="KodeKota"><option value = ''>Pilih Kota</option></select></div><div class="form-group"><label for="nama">Detail Alamat</label><textarea class="form-control" id="AlamatPenerima" placeholder="Alamat Penerima"></textarea></div><div class="form-group"><label>Sistem Pembayaran</label><select class="form-control" data-live-search="true" data-width="100%" id="SistemPembayaran"><option value = ''>Pilih SistemPembayaran</option><option value="1">Pembayaran Di Tempat</option><option value="2">COD</option><option value="3">Pembayaran Nanti</option></select></div><div class="form-group"><label for="nama">Berat</label><input type="text" class="form-control berat" id="Berat" placeholder="Berat"></div><div class="form-group"><label for="nama">Harga</label><input type="text" class="form-control harga" id="Harga" placeholder="Harga"></div><div class="form-group"><label>Status Pengiriman</label><select class="form-control" data-live-search="true" data-width="100%" id="Status"><option value = ''>Pilih Status</option><option value="0">Di Batalkan</option><option value="1">Terkirim</option><option value="2">Pengiriman Kurir</option><option value="3">Di Terima Oleh Cabang</option><option value="4">Pengiriman Ke Cabang</option><option value="5">Belum Di Proses</option></select></div></form></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button><button type="button" class="btn btn-primary" id="addForm">Save changes</button><button type="button" class="btn btn-warning" id="updateForm">Update changes</button></div></div></div></div></div></body><?php $this->load->view('pengiriman/js/js')?></html>