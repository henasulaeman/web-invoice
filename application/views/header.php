<header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url() ?>invoice/BuatInvoice" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>E</b>Invoice</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>E-</b>INVOICE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"  title="Total Jumlah Transaksi">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">
                    <?php
                      $jumlahData=$getBukuInvoice->num_rows();

                      echo $jumlahData;

                    ?>

                  </span>
                </a>
                <ul class="dropdown-menu">
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <!-- Tasks: style can be found in dropdown.less -->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="<?php echo base_url()?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $this->session->userdata('nama_tampilan') ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url()?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    <p>
                     <?php echo $this->session->userdata('nama_tampilan') ?>
                      <small><?php echo "tgl login: ".$this->session->userdata('tgl_login') ?></small>
                    </p>
                  </li>
                    <div class="pull-right">
                      <a href="<?php echo base_url() ?>invoice/Logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              
            </ul>
          </div>
        </nav>
      </header>