<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view('head') ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <?php $this->load->view('header') ?>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <?php $this->load->view('sidebar') ?>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
         Buku Invoice
         <small>Ds Home</small>
         <small>/ Selamat Datang: <?php echo $this->session->userdata('nama_tampilan') ?>  </small>
       </h1>
       <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>invoice/BuatInvoice"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Buku Invoice</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Detail Invoice</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                 <form action="<?php echo base_url() ?>invoice/CetakDetail" method="POST" id="f1" class="form-horizontal" enctype="multipart/form-data" >
                    <div class="col-md-6">
                     <img style="width: 100px;" src="<?php echo base_url() ?>assets/img/logo2.jpeg" alt="User Image">
                    
                     <hr>
                     <label>Nama Toko</label>
                     <input type="text" name="nm_toko" value="<?php echo $GetDtToko['nm_toko'] ?>" class="form-control input-sm" readonly="true" placeholder="Nama Toko">
                     <label>Alamat Toko </label>
                     <input type="hidden" name="almtToko_1" value="<?php echo $GetDtToko['almt_toko1'] ?>" readonly="true" class="form-control input-sm" placeholder="Alamat 1" >
                     <input type="text" name="" value="" readonly="true" class="form-control input-sm" placeholder="<?php echo $GetDtToko['almt_toko1'] ?> <?php echo "RT". $GetDtToko['rt'] ?>  <?php echo "/ RW". $GetDtToko['rw'] ?>" >
                      <input type="hidden" name="rt" value="<?php echo $GetDtToko['rt'] ?>" readonly="true" class="form-control input-sm" placeholder="Alamat 1" >
                       <input type="hidden" name="rw" value="<?php echo $GetDtToko['rw'] ?>" readonly="true" class="form-control input-sm" placeholder="Alamat 1" >
                     <label>Kota</label>
                     <input type="text" name="kota" value="<?php echo $GetDtToko['kota'] ?>" readonly="true" class="form-control input-sm" placeholder="Alamat 2" >

                   </div>
                   <div class="col-md-6">
                    <label>No Invoice</label>
                    <input type="text" name="noInvoice" value="<?php if(empty($detailInvoice['no_invoice'])){echo "";}else{echo $detailInvoice['no_invoice'];} ?>" class="form-control input-sm" readonly="true" >
                    <label>Tanggal Invoice</label>
                    <input type="text" name="tglInvoice" value="<?php if(empty($detailInvoice['tgl_invoice'])){echo "";}else{echo $detailInvoice['tgl_invoice'];} ?>" class="form-control input-sm"  readonly="true">

                    <label>Tanggal Jatuh Tempo</label>
                    <input type="text" name="tglJtTempo" value="<?php if(empty($detailInvoice['tgl_jt_tempo'])){echo "";}else{echo $detailInvoice['tgl_jt_tempo'];} ?>" class="form-control input-sm"  readonly="true">

                  </div>
                  <div class="col-md-12">
                    <hr>
                  </div> 
                 <!-- Start Copas  -->
                      <div class="col-md-6">
                    <h4>DITAGIH KEPADA</h4>
                    <label>Nama Pelanggan</label>
                    <input type="text" id="nm_plgn" disabled="true"  name="" value="<?php if(empty($detailInvoice['nm_pelanggan'])){echo "";}else{echo $detailInvoice['nm_pelanggan'];} ?>" class="form-control input-sm textbox2" placeholder="Nama Pelanggan">
                    <label>Alamat Pelanggan </label>
                    <input type="text" id="almt_plgn1" disabled="true" name="" value="<?php if(empty($detailInvoice['almt_pelanggan1'])){echo "";}else{echo $detailInvoice['almt_pelanggan1'];} ?>" class="form-control input-sm textbox2" placeholder="Alamat Pelanggan Baris 1" >
                   

                    <!-- Hidden -->
                    <input type="hidden" name="nm_plgn" value="<?php if(empty($detailInvoice['nm_pelanggan'])){echo "";}else{echo $detailInvoice['nm_pelanggan'];} ?>">
                    <input type="hidden" name="almt_plgn1" value="<?php if(empty($detailInvoice['almt_pelanggan1'])){echo "";}else{echo $detailInvoice['almt_pelanggan1'];} ?>" >
                   

                  </div>

                  <div class="col-md-6">
                    <h4>DIKIRIM KEPADA 
                      <input type="checkbox" id="enable" name="enable" disabled="true" checked="true" value="1"> Aktif</h4>
                      <label>Nama Penerima</label>
                      <input type="text" id="nm_penerima" disabled="true" value="<?php if(empty($detailInvoice['nm_penerima'])){echo "";}else{echo $detailInvoice['nm_penerima'];} ?>" name="" class="form-control input-sm textbox" placeholder="Nama Penerima">
                      <label>Alamat Penerima</label>
                      <input type="text" id="almt_penerima1" disabled="true" value="<?php if(empty($detailInvoice['almt_penerima1'])){echo "";}else{echo $detailInvoice['almt_penerima1'];} ?>"  name="" class="form-control input-sm textbox" placeholder="Alamat Penerima Baris 1" >
                       

                      <!-- Hiden -->
                      <input type="hidden" value="<?php if(empty($detailInvoice['nm_penerima'])){echo "";}else{echo $detailInvoice['nm_penerima'];} ?>" name="nm_penerima">
                      <input type="hidden" id="almt_penerima1" value="<?php if(empty($detailInvoice['almt_penerima1'])){echo "";}else{echo $detailInvoice['almt_penerima1'];} ?>"  name="almt_penerima1" >
                     
                      <!-- Hidden -->
                    </div>
                    <div class="col-md-12">
                      <hr>
                      <table class="table table-bordered table-responsive">
                        <thead style="background: grey;">
                          <th style=" width: 39px;">ID</th>

                          <th style=" width: 245px;">NAMA BARANG</th>

                          <th>JUMLAH</th>

                          <th>HARGA SATUAN</th>

                        </thead>
                        <tbody>
                          <?php 
                            $no=1;
                            foreach ($detailProduk->result_array() as $row) {
                              # code...
                            

                          ?>
                          <tr>
                          <td><?php echo $no++;?></td>

                          <td>
                            <textarea name="nm_pdk[]" class="form-control" class="form-control input-sm" disabled="true"><?php echo $row['nm_produk'] ?></textarea></td>

                          <td><input type="text" id="jml_qty1" name="jml_qty[]" placeholder="Jumlah"  class="form-control input-sm"  disabled="true" value="<?php echo number_format($row['jumlah_pemesanan']);?>"></td>

                          <td><input type="text" id="harga1"  name="harga[]" placeholder="Harga Satuan"  class="form-control input-sm"  disabled="true"  value="<?php echo number_format($row['harga']); ?>"></td>

                        <?php }?>

                        </tbody>


                      </table>
                       <div id='TextBoxesGroup'>

                        <div id="TextBoxDiv">

                        </div>  
                      </div>
                      <div class="col-md-8">
                        <div id="" class="col-md-9">
                          <?php 
                         
                          $no_inv=$this->uri->segment(3);
                         
                          $q= $this->db->query("SELECT * FROM tb_invoice WHERE no_invoice='$no_inv'");

                          foreach ($q->result_array() as $value) {
                           if ($value['status']=="1") {
                              ?>

                                <img id="final" src="<?php echo base_url() ?>assets/img/final.png">
                              <?php
                            }elseif ($value['status']=="4") {
                              ?>

                                <img id="dikirm" src="<?php echo base_url() ?>assets/img/dikirim.png">
                              <?php

                            }elseif ($value['status']=="6") {
                                ?>

                                <img id="dikirm" src="<?php echo base_url() ?>assets/img/setuju.png">
                                <?php
                            }elseif ($value['status']=="5") {
                              ?>

                                <img id="final" src="<?php echo base_url() ?>assets/img/final.png">
                                <img id="dikirm" src="<?php echo base_url() ?>assets/img/dikirim.png">
                              <?php
                            }elseif ($value['status']=="7") {
                              ?>
                                <img id="final" src="<?php echo base_url() ?>assets/img/final.png">
                                <img id="dikirm" src="<?php echo base_url() ?>assets/img/setuju.png">
                              <?php
                            }elseif ($value['status']=="10") {
                              ?>
                                <img id="dikirm" src="<?php echo base_url() ?>assets/img/dikirim.png">
                                <img id="dikirm" src="<?php echo base_url() ?>assets/img/setuju.png">

                              <?php
                            }elseif ($value['status']=="11") {
                              ?>

                                <img id="final" src="<?php echo base_url() ?>assets/img/final.png">
                                <img id="dikirm" src="<?php echo base_url() ?>assets/img/dikirim.png">
                                <img id="dikirm" src="<?php echo base_url() ?>assets/img/setuju.png">
                              <?php
                            }
                          }
                          ?>


                              
                        </div>  
                        <!-- <div id="" class="col-md-3">
                         <img id="dikirm" src="<?php echo base_url() ?>assets/img/dikirim.png">
                       </div>  
                       <div class="col-md-3">
                         <img id="setuju" src="<?php echo base_url() ?>assets/img/setuju.png">
                       </div> -->
                     </div>
                     <div class="col-md-4">
                      <label>TOTAL</label>
                      <input type="text" id="jml_total" name="jml_total" value="<?php if(empty($detailInvoice['total'])){echo "";}else{echo number_format($detailInvoice['total']);} ?>" onchange="HitungPesanan()"  class="form-control input-sm pull-right" placeholder="Total" disabled="true"><br>
                      <label>ONGKIR</label>
                      <input type="text" id="ongkir" name="ongkir" value="<?php if(empty($detailInvoice['ongkir'])){echo "";}else{echo number_format($detailInvoice['ongkir']);} ?>" onchange="HitungPesanan()"  class="form-control input-sm pull-right" placeholder="Ongkir" disabled="true"><br>
                      <label>SUB TOTAL</label>
                      <input type="text" id="SubTotal" name="SubTotal" value="<?php if(empty($detailInvoice['grand_total'])){echo "";}else{echo $detailInvoice['grand_total'];} ?>" onchange="HitungPesanan()"  class="form-control input-sm pull-right" placeholder="Sub Total" disabled="true">
                      <label></label>
                    </div>
                  
                    <hr>
                    <br>
                      <label>Catatan</label>
                    <textarea name="catatan" class="form-control"><?php if(empty($detailInvoice['catatan'])){echo "";}else{echo $detailInvoice['catatan'];} ?></textarea>
                    <hr>
                  
                   
              </div><!-- /.box-body -->
                <div class="col-md-12">
                    <input type="submit" name="cetak" value="Cetak" class="input-sm btn btn-primary">
                  </div>
            </form>
          </div>









        </div><!--/.col (left) -->
        <!-- right column -->
        <!--/.col (right) -->
      </div>   <!-- /.row -->
    </section>
  </div><!-- /.content-wrapper -->
  <footer class="main-footer">
    <?php $this->load->view('footer') ?>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-user bg-yellow"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul><!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>
              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>
              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>
              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>
              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul><!-- /.control-sidebar-menu -->

      </div><!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
       
      </div><!-- /.tab-pane -->
    </div>
  </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
       <div class="control-sidebar-bg">

       </div>
     </div><!-- ./wrapper -->

     <?php $this->load->view('javascript') ?> 

   </body>
   </html>
