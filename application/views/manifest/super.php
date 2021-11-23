<div class="row page-title-header"><div class="col-12"><div class="page-header"><h4 class="page-title">Manifest</h4></div></div><div class="col-md-12"><div class="page-header-toolbar"></div></div></div><div style="padding-bottom: 10px;"><a href="<?php echo base_url()?>Manifest/tambah"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Manifest</button></a></div><div class="row page-title-header"><div class="col-12"><div class="page-header"><h4 class="page-title">Daftar Manifest</h4></div></div><div class="col-md-12"><div class="page-header-toolbar"></div></div></div><div class="row" id="rowTablePengiriman"><div class="col grid-margin stretch-card"><table class="table table-striped" id="tablePengiriman"><thead><th>No</th><th>No Manifest</th><th>No Resi</th><th>Tujuan Pengiriman</th><th>Penerima</th><th>No SMU</th><th>Pengirim</th><th>Tanggal Di Buat</th><th>Check</th></thead><tbody></tbody></table></div><div class="col-sm-2 grid-margin stretch-card"><button class="btn btn-primary" id="savePengiriman"><i class="fa fa-save"></i> Save</button></div><div class="col grid-margin stretch-card"><button class="btn btn-secondary" id="cancelTablePengiriman"><i class="fa fa-arrow-up"></i> cancel</button></div></div><div class="row"><?php if(isset($pengiriman)){ foreach($pengiriman['data'] as $data){?><div class="col-md-4 grid-margin stretch-card"><div class="card"><div class="card-body"><h4 class="card-title mb-0">Pengiriman Manifest</h4><div class="d-flex py-2 border-bottom"><div class="wrapper"><small class="text-muted">No Manifest</small><p class="font-weight-semibold text-gray mb-0"><?php echo $data["NoManifest"];?></p></div></div><div class="d-flex py-2 border-bottom"><div class="wrapper"><small class="text-muted">Tujuan Pengiriman</small><p class="font-weight-semibold text-gray mb-0"><?php echo $data["Tujuan"];?></p></div></div><div class="d-flex py-2 border-bottom"><div class="wrapper"><small class="text-muted">Penerima</small><p class="font-weight-semibold text-gray mb-0"><?php echo $data["Penerima"];?></p></div></div><div class="d-flex py-2 border-bottom"><div class="wrapper"><small class="text-muted">No SMU</small><p class="font-weight-semibold text-gray mb-0"><?php echo $data["NoSMU"];?></p></div></div><div class="d-flex py-2 border-bottom"><div class="wrapper"><small class="text-muted">Jumlah Resi</small><p class="font-weight-semibold text-gray mb-0"><?php echo $data["JumlahResi"];?></p></div></div><div class="d-flex pt-2"><div class="wrapper"><small class="text-muted">Pengiriman Dari</small><p class="font-weight-semibold text-gray mb-0"><?php echo $data['CabangPengirim'];?></p></div></div><div class="d-flex pt-2 border-bottom"><div class="wrapper"><small class="text-muted">Tanggal Pembuatan</small><p class="font-weight-semibold text-gray mb-0"><?php echo $data['TanggalPembuatan'];?></p></div></div><div class="d-flex pt-2"><div class="wrapper"><button class="btn btn-primary konfirmasiPengiriman" id="" data-id="<?php echo $data['NoManifest']?>"><i class="fa fa-list"></i> Detail</button><button class="btn btn-danger cancelPengiriman" id="" data-id="<?php echo $data['NoManifest']?>"><i class="fa fa-trash"></i> Cancel</button></div></div></div></div></div><?php } } ?></div>