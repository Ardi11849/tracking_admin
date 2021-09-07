
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-category">Main Menu</li>
            <li class="nav-item">
              <a class="nav-link active" href="<?php echo base_url()?>Tracking">
                
                <i class="fa fa-tachometer-alt"></i> Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url()?>Pengiriman">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Registrasi Pengiriman</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url()?>Kurir">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Kurir</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url()?>PengirimanKurir">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Pengiriman Kurir</span>
              </a>
            </li>
            <?php if ($this->session->userdata('Role') == 1 || $this->session->userdata('Role') == 2) {?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url()?>Cabang">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Cabang</span>
              </a>
            </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url()?>PengirimanCabang">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Pengiriman Cabang</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url()?>KonfirmasiCabang">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Konfirmasi Penerimaan Cabang</span>
              </a>
            </li>
            <?php if ($this->session->userdata('Role') == 1) {?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url()?>Perusahaan">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Perusahaan</span>
              </a>
            </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url()?>User">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">User</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url()?>Welcome/Logout">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Logout</span>
              </a>
            </li>
          </ul>
        </nav>