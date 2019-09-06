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
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">BUAT INVOICE</a></li>
              <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">BUKU INVOICE</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="activity">
                <!-- Post -->
                <div class="row">
                  <form action="<?php echo base_url() ?>invoice/SimpanInvoice" method="POST" id="f1" class="form-horizontal" enctype="multipart/form-data" >
                    <div class="col-md-6">
                     <img style="width:200px;" src="<?php echo base_url() ?>assets/img/logo2.jpeg" alt="User Image">

                     <hr>
                     <label>Nama Toko</label>
                     <input type="text" name="nm_toko" value="<?php echo $GetDtToko['nm_toko'] ?>" class="form-control input-sm" readonly="true" placeholder="Nama Toko">
                     <label>Alamat Toko </label>
                     <input type="text" name="almtToko_1" value="<?php echo $GetDtToko['almt_toko1'] ?>" readonly="true" class="form-control input-sm" placeholder="Alamat 1" >
                     <input type="hidden" name="rt" value="<?php echo $GetDtToko['rt'] ?>" readonly="true" class="form-control input-sm" placeholder="Alamat 1" >
                     <input type="hidden" name="rw" value="<?php echo $GetDtToko['rw'] ?>" readonly="true" class="form-control input-sm" placeholder="Alamat 1" >
                     <label>Kota</label>
                     <input type="text" name="kota" value="<?php echo $GetDtToko['kota'] ?>" readonly="true" class="form-control input-sm" placeholder="Alamat 2" >

                   </div>
                   <div class="col-md-6">
                    <label>No Invoice</label>
                    <input type="text" name="noInvoice" value="<?php echo $kode_invoice ?>" class="form-control input-sm" readonly="true" >
                    <label>Tanggal Invoice</label>
                    <input type="text" name="tglInvoice" value="<?php echo $tglSekarang ?>" class="form-control input-sm"  readonly="true">

                    <label>Tanggal Jatuh Tempo</label>
                    <input type="text" name="tglJtTempo" value="<?php echo $tglSekarang ?>" class="form-control input-sm"  readonly="true">

                  </div>
                  <div class="col-md-12">
                    <hr>
                  </div> 
                  <!-- Start Copas  -->
                  <div class="col-md-6">
                    <h4>DITAGIH KEPADA</h4>
                    <label>Nama Pelanggan</label>
                    <input type="text" id="nm_plgn"  name="nm_plgn" value="" class="form-control input-sm textbox2" placeholder="Nama Pelanggan">
                    <label>Alamat Pelanggan </label>
                    <input type="text" id="almt_plgn1" name="almt_plgn1" value="" class="form-control input-sm textbox2" placeholder="Alamat Pelanggan Baris " > 
                   </div>

                   <div class="col-md-6">
                    <h4>DIKIRIM KEPADA 
                      <input type="checkbox" id="enable" name="enable" checked="true" value="1"> Aktif</h4>
                      <label>Nama Penerima</label>
                      <input type="text" id="nm_penerima" disabled="true" value="" name="nm_penerima" class="form-control input-sm textbox" placeholder="Nama Penerima" >
                      <label>Alamat Penerima Baris 1</label>
                      <input type="text" id="almt_penerima1" disabled="true" value=""  name="almt_penerima1" class="form-control input-sm textbox" placeholder="Alamat Penerima Baris " >


                    </div>
                    <div class="col-md-12">
                      <hr>
                      <table class="table table-bordered table-responsive">
                        <thead style="background: grey;">
                          <th style=" width: 39px;">ID</th>

                          <th style=" width: 245px;">NAMA BARANG</th>

                          <th>JUMLAH</th>

                          <th>HARGA SATUAN</th>

                          <th>TOTAL</th>

                        </thead>
                        <tbody>
                          <td>1</td>

                          <td><textarea name="nm_pdk[]" value="" class="form-control" class="form-control input-sm" required></textarea></td>

                          <td><input type="number" id="jml_qty1" name="jml_qty[]" value=""  placeholder="Jumlah"  class="form-control input-sm" onchange="HitungPesanan()" required ></td>

                          <td><input type="number" id="harga1"  name="harga[]" value=""  placeholder="Harga Satuan"  class="form-control input-sm" onchange="HitungPesanan()" required  ></td>

                          <td><input type="text" id="total1" readonly="true" name="total[]" value=""  placeholder="Total"  class="form-control input-sm" onchange="HitungPesanan()" required ></td>



                        </tbody>


                      </table>
                      <div id='TextBoxesGroup'>

                        <div id="TextBoxDiv">

                        </div>  
                      </div>
                      <div class="col-md-8">
                        <div id="box3" class="col-md-3" style="display: none;">
                          <img id="final" src="<?php echo base_url() ?>assets/img/final.png">
                        </div>  
                        <div id="box2" class="col-md-3" style="display: none;" >
                         <img id="dikirm" src="<?php echo base_url() ?>assets/img/dikirim.png">
                       </div>  
                       <div class="col-md-3" id="box1" style="display:none;">
                         <img id="setuju" src="<?php echo base_url() ?>assets/img/setuju.png">
                       </div>
                     </div>
                     <div class="col-md-4">
                      <label>TOTAL</label>
                      <input type="text" id="jml_total" readonly="true" name="jml_total" value="" onchange="HitungPesanan()"  class="form-control input-sm pull-right" placeholder="Total"><br>
                      <label>ONGKIR</label>
                      <input type="number" id="ongkir" name="ongkir" value="0" onchange="HitungPesanan()"  class="form-control input-sm pull-right" placeholder="Ongkir" ><br>
                      <label>SUB TOTAL</label>
                      <input type="text" id="SubTotal" readonly="true" name="SubTotal" value="" onchange="HitungPesanan()"  class="form-control input-sm pull-right" placeholder="Sub Total">
                      <label></label>
                    </div>
                    <br><br> <br><br> <br><br> <br><br> <br>
                    <input type="button" name="" id="addButton" value="Tambah Item" class="btn-danger input-sm pull-right">&nbsp;
                    <input type="button" name="" id="removeButton" value="Remove Item" class="btn-danger input-sm pull-right">

                    <hr>
                    <br>
                    <label>Catatan</label>
                    <textarea name="catatan" class="form-control"></textarea>

                    <br>
                    <label>Stample</label><br>

                    <input type="checkbox" id="chk_final" name="chk_final" value="1" >FINAL

                    <input type="checkbox" id="chk_kirim" name="chk_kirim" value="4" >DIKIRIM

                    <input type="checkbox" id="chk_setuju" name="chk_setuju" value="6" >SETUJU
                  </div>
                  <!-- End Copas -->
                  <div class="col-md-12">
                    <hr>
                    <br>
                    <input type="submit" name="simpan" value="Simpan" class="input-sm btn btn-primary"> &nbsp;&nbsp;   
                    
                    <input type="submit" name="cetak" value="Cetak" class="input-sm btn btn-primary">
                  </div>
                </form>

              </div><!-- /.post -->

              <!-- Post -->
              <!-- /.post -->

              <!-- Post -->
              <!-- /.post -->
            </div><!-- /.tab-pane -->
            <div class="tab-pane" id="timeline">
             <table id="example1" class="table table-bordered table-striped">
              <thead style="text-align-last: center; background-color: #00ffa1" >
                <tr>
                  <th>No Invoice</th>
                  <th>Tanggal Pesan</th>
                  <th>Nama Pelanggan</th>
                  <th>Status Pengiriman</th>
                  <th>No AWB / Resi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($getBukuInvoice->result_array() as $row) {

                      $q =$this->db->query("SELECT * FROM tb_resi WHERE no_invoice= '$row[no_invoice] ' ")->row_array();


                  ?>
                  <tr>
                    <td><?php echo $row['no_invoice'] ?></td>
                    <td><?php echo $row['tgl_invoice'] ?></td>
                    <td><?php if ($row['nm_pelanggan']=="0") {
                      echo "-";
                    }else{
                      echo $row['nm_pelanggan'];
                    } ?>

                  </td>
                  <td>
                    <center>
                      <?php  
                        if (isset($q['keterangan'])) {
                          if ($q['keterangan']==1) {
                            echo "Telah Di Terima";
                          }else{
                            echo "<p style=color:red>Gagal Di Terima </p>";
                          }
                        }else{
                          echo "-";
                        }


                      ?>
                    </center>
                      
                  </td>
                  <td>
                      <?php
                        
                        if (isset($q['no_resi'])) {
                          echo $q['no_resi'];
                        }else{
                          echo "-";
                        }
                      ?>

                  </td>
                  <td>
                    <center>
                      
                    <a href="<?php echo base_url() ?>invoice/DetailInvoice/<?php echo $row['no_invoice'] ?>"><i class="fa fa-fw fa-eye" title="Detail"></i>Detail </a>||
                    <a href="<?php echo base_url() ?>invoice/EditInvoice/<?php echo $row['no_invoice'] ?>"><i class="fa fa-fw fa-edit"  title="Edit"></i> Edit</a>||
                    <a onclick="return confirm('Yakin Data Akan Di Hapus ?')" href="<?php echo base_url() ?>invoice/DeleteBukuInvoice/<?php echo $row['no_invoice'] ?>"><i class="fa fa-fw fa-minus-square"  title="Hapus"></i></i>Hapus</a>||  
                    <a href="#" data-toggle="modal" data-target="#myModal<?php echo $row['id_invoice'] ?>"><i class="fa fa-money"  title="Cairkan Dana"></i> </i>Input AWB</a>

                    </center>
                  </td>
                </tr>
              <?php }?>
            </tbody>

          </table>

          <?php
            foreach ($getBukuInvoice->result_array() as $data) {
            
            ?>
                 <!-- Modal -->
          <div id="myModal<?php echo $data['id_invoice'] ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Modal Header <?php echo $data['id_invoice'] ?></h4>
                </div>
                <div class="modal-body">
                  <form action="<?php echo base_url() ?>Invoice/SimpanResi" method="POST">
                    <?php
                      $get_invoice = $this->db->query("SELECT * FROM tb_invoice WHERE id_invoice='$data[id_invoice]' ")->row_array();
                      
                      $get_resi=$this->db->query("SELECT * FROM tb_resi WHERE no_invoice='$get_invoice[no_invoice]' ");
                    ?>
                    <label>* No Invoice</label>
                    <input type="text" name="no_invoice" class="form-control" value="<?php echo $get_invoice['no_invoice'] ?>">
                    <label>* Atas Nama</label>
                    <input type="text" name="atas_nama" class="form-control" value=
                    "<?php
                        echo $get_invoice['nm_pelanggan'];
                    ?>">
                    <label>* Ekspedisi </label>
                     <select name="ekspedisi" class="form-control">

                      <?php
                        $getDataResi =  $get_resi->row_array();
                        $cekDataResi = $get_resi->num_rows(); 
                        if ($cekDataResi !=0) {
                          ?>
                            <option>-Pilih Ekspedisi-</option>
                         <?php
                          foreach ($get_resi->result_array() as $data) {
                            $ekspedisi = $data['ekspedisi'];
                          

                         ?>
                         <option value="sap" <?php if($ekspedisi=="sap"){echo "selected=true";}else{echo "";} ?> >SAP Ekspress</option>
                         <option value="jne" <?php if($ekspedisi=="jne"){echo "selected=true";}else{echo "";} ?> >JNE</option>
                         <option value="j&t" <?php if($ekspedisi=="j&t"){echo "selected=true";}else{echo "";} ?> >J&T</option>
                         <option value="post" <?php if($ekspedisi=="post"){echo "selected=true";}else{echo "";} ?> >POST</option>
                         <option value="tiki" <?php if($ekspedisi=="tiki"){echo "selected=true";}else{echo "";} ?> >TIKI</option>
                         <option value="wahana" <?php if($ekspedisi=="wahana"){echo "selected=true";}else{echo "";} ?> >WAHANA</option>
                       <?php }?>
                       </select>
                     <?php
                        }else{

                          ?>
                            <option>-Pilih Ekspedisi-</option>
                           <option value="sap" >SAP Ekspress</option>
                           <option value="jne">JNE</option>
                           <option value="j&t" >J&T</option>
                           <option value="post">POST</option>
                           <option value="tiki">TIKI</option>
                           <option value="wahana">WAHANA</option>
                           <option value="gosend">GOSEND</option>

                          <?php
                        }

                      ?>
                     
                     
                     </select>
                    <label>* No AWB / No Resi</label>
                    <input type="text" name="no_resi" class="form-control" value="<?php if(isset($getDataResi['no_resi'])){echo $getDataResi['no_resi']; }else{echo "";} ?>">
                     
                    <label>* Keterangan </label>
                   <select class="form-control" name="ket">
                      <?php
                         if ($cekDataResi !=0) {
                          foreach ($get_resi->result_array() as $data) {
                            $keterangan = $data['keterangan'];
                              ?>
                                 <option value="-" >-Status Pengiriman-</option>
                                 <option value="1"  <?php if($keterangan==1){echo" selected=true";}else{echo "";} ?>>Terkirim</option>
                                 <option value="2" <?php if($keterangan==2){echo" selected=true";}else{echo "";} ?>>Gagal</option>


                              <?php

                            }

                        }else{
                          ?>
                               <option value="-">-Status Pengiriman-</option>
                               <option value="1">Terkirim</option>
                               <option value="2">Gagal</option>
                          <?php
                        }
                      ?>

                      
                     </select>
                  </div>
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" name="" value="Simpan">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  </div>

                </form>
              </div>

            </div>
          </div>
          <!-- End Modal -->

              <?php
            }

          ?>

        </div><!-- /.tab-pane -->

        <div class="tab-pane" id="settings">
          <form class="form-horizontal">




            <div class="form-group">
              <label for="inputSkills" class="col-sm-2 control-label">Skills</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label>
                    <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Submit</button>
              </div>
            </div>
          </form>
        </div><!-- /.tab-pane -->
      </div><!-- /.tab-content -->
    </div><!-- /.nav-tabs-custom -->
  </div>

</div><!-- /.row -->
</section><!-- /.content -->
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
      <form method="post">
        <h3 class="control-sidebar-heading">General Settings</h3>
        <div class="form-group">
          <label class="control-sidebar-subheading">
            Report panel usage
            <input type="checkbox" class="pull-right" checked>
          </label>
          <p>
            Some information about this general settings option
          </p>
        </div><!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Allow mail redirect
            <input type="checkbox" class="pull-right" checked>
          </label>
          <p>
            Other sets of options are available
          </p>
        </div><!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Expose author name in posts
            <input type="checkbox" class="pull-right" checked>
          </label>
          <p>
            Allow the user to show his name in blog posts
          </p>
        </div><!-- /.form-group -->

        <h3 class="control-sidebar-heading">Chat Settings</h3>

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Show me as online
            <input type="checkbox" class="pull-right" checked>
          </label>
        </div><!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Turn off notifications
            <input type="checkbox" class="pull-right">
          </label>
        </div><!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Delete chat history
            <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
          </label>
        </div><!-- /.form-group -->
      </form>
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
