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
                 <form action="<?php echo base_url() ?>invoice/SimpanEditInvoice" method="POST" id="f1" class="form-horizontal" enctype="multipart/form-data" >
                    <div class="col-md-6">
                     <img style="width: 100px;" src="<?php echo base_url() ?>assets/img/logo2.jpeg" alt="User Image">
                    
                     <hr>
                     <label>Nama Toko</label>
                     <input type="text" name="nm_toko" value="<?php echo $GetDtToko['nm_toko'] ?>" class="form-control input-sm" readonly="true" placeholder="Nama Toko">
                     <label>Alamat Toko </label>
                     <input type="text" name="almtToko_1" value="<?php echo $GetDtToko['almt_toko1'] ?> <?php echo "RT". $GetDtToko['rt'] ?>  <?php echo "/ RW". $GetDtToko['rw'] ?>" readonly="true" class="form-control input-sm" placeholder="Alamat 1" >
                      <input type="hidden" name="rt" value="<?php echo $GetDtToko['rt'] ?>" readonly="true" class="form-control input-sm" placeholder="Alamat 1" >
                       <input type="hidden" name="rw" value="<?php echo $GetDtToko['rw'] ?>" readonly="true" class="form-control input-sm" placeholder="Alamat 1" >
                     <label>Kota</label>
                     <input type="text" name="kota" value="<?php echo $GetDtToko['kota'] ?>" readonly="true" class="form-control input-sm" placeholder="Alamat 2" >

                   </div>
                   <div class="col-md-6">
                    <label>No Invoice</label>
                    <input type="text" name="noInvoice" value="<?php if(empty($detailInvoice['no_invoice'])){echo "-";}else{echo $detailInvoice['no_invoice'];} ?>" class="form-control input-sm" readonly="true" >
                    <label>Tanggal Invoice</label>
                    <input type="text" name="tglInvoice" value="<?php if(empty($detailInvoice['tgl_invoice'])){echo "-";}else{echo $detailInvoice['tgl_invoice'];} ?>" class="form-control input-sm"  readonly="true">

                    <label>Tanggal Jatuh Tempo</label>
                    <input type="text" name="tglJtTempo" value="<?php if(empty($detailInvoice['tgl_jt_tempo'])){echo "-";}else{echo $detailInvoice['tgl_jt_tempo'];} ?>" class="form-control input-sm"  readonly="true">

                  </div>
                  <div class="col-md-12">
                    <hr>
                  </div> 
                 <!-- Start Copas  -->
                      <div class="col-md-6">
                    <h4>DITAGIH KEPADA</h4>
                    <label>Nama Pelanggan</label>
                    <input type="text" id="nm_plgn" name="nm_plgn" value="<?php if(empty($detailInvoice['nm_pelanggan'])){echo "";}else{echo $detailInvoice['nm_pelanggan'];} ?>" class="form-control input-sm textbox2" placeholder="Nama Pelanggan">
                    <label>Alamat Pelanggan </label>
                    <input type="text" id="almt_plgn1" name="almt_plgn1" value="<?php if(empty($detailInvoice['almt_pelanggan1'])){echo "";}else{echo $detailInvoice['almt_pelanggan1'];} ?>" class="form-control input-sm textbox2" placeholder="Alamat Pelanggan Baris 1" >
                   

                  </div>

                  <div class="col-md-6">
                    <h4>DIKIRIM KEPADA</h4>
                      <!-- <input type="checkbox" id="enable" name="enable" value="1"> Aktif</h4> -->
                      <label>Nama Penerima</label>
                      <input type="text" id="nm_penerima"  value="<?php if(empty($detailInvoice['nm_penerima'])){echo "";}else{echo $detailInvoice['nm_penerima'];} ?>" name="nm_penerima" class="form-control input-sm textbox" placeholder="Nama Penerima">
                      <label>Alamat Penerima</label>
                      <input type="text" id="almt_penerima1"  value="<?php if(empty($detailInvoice['almt_penerima1'])){echo "";}else{echo $detailInvoice['almt_penerima1'];} ?>"  name="almt_penerima1" class="form-control input-sm textbox" placeholder="Alamat Penerima Baris 1" >
                      


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
                          <?php 
                            $noqty=1;
                            $noHrg=1;
                            $noTotal=1;
                            $no=1;
                            $total=0;
                            foreach ($detailProduk->result_array() as $row) {
                              
                              $total = $row['jumlah_pemesanan']*$row['harga'];
                           
                            

                          ?>
                          <tr>
                          <td><?php echo $no++;?></td>

                          <td>
                            <textarea name="nm_pdk[]" class="form-control" class="form-control input-sm" ><?php echo $row['nm_produk'] ?></textarea></td>

                          <td><input type="text" id="jml_qty<?php echo $noqty++ ?>" name="jml_qty[]" placeholder="  class="form-control input-sm" value="<?php echo $row['jumlah_pemesanan'] ?>" onchange="HitungPesanan()"></td>

                          <td><input type="text" id="harga<?php echo $noHrg++ ?>"  name="harga[]" placeholder=""  class="form-control input-sm" value="<?php echo $row['harga'] ?>" onchange="HitungPesanan()"></td>
                          <td><input type="text" id="total<?php echo $noTotal++ ?>"  name="total[]" placeholder=""  class="form-control input-sm" value="<?php echo $total ?>" onchange="HitungPesanan()"></td>
                          <input type="hidden" name="id_produk[]" placeholder="" class="form-control input-sm" value="<?php echo $row['id_produk'] ?>" onchange="HitungPesanan()">
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
                          $q= $this->db->query("SELECT * FROM tb_invoice WHERE no_invoice='$no_inv' ");

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
                      <input type="text" id="jml_total" name="jml_total" value="<?php if(empty($detailInvoice['total'])){echo "0";}else{echo $detailInvoice['total'];} ?>" onchange="HitungPesanan()"  class="form-control input-sm pull-right" placeholder=""><br>
                      <label>ONGKIR</label>
                      <input type="text" id="ongkir" name="ongkir" value="<?php if(empty($detailInvoice['ongkir'])){echo "0";}else{echo $detailInvoice['ongkir'];} ?>" onchange="HitungPesanan()"  class="form-control input-sm pull-right" placeholder="" ><br>
                      <label>SUB TOTAL</label>
                      <input type="text" id="SubTotal" name="SubTotal" value="<?php if(empty($detailInvoice['grand_total'])){echo "0";}else{echo $detailInvoice['grand_total'];} ?>" onchange="HitungPesanan()"  class="form-control input-sm pull-right" placeholder="">
                      <label></label>
                    </div>
                  
                    <hr>
                    <br>
                      <label>Catatan</label>
                    <textarea name="catatan" class="form-control"><?php if(empty($detailInvoice['catatan'])){echo "-";}else{echo $detailInvoice['catatan'];} ?></textarea>
                    <hr>
                   
                   
                  <label>Stample</label><br>
                    <?php 
                         
                          $no_inv=$this->uri->segment(3);
                          $q= $this->db->query("SELECT * FROM tb_invoice WHERE no_invoice='$no_inv' ");

                          foreach ($q->result_array() as $value) {
                           if ($value['status']=="1") {
                              ?>
                                <input type="checkbox" id="chk_final" name="chk_final" checked="true" value="1" >FINAL
                                <input type="checkbox" id="chk_kirim" name="chk_kirim"  value="4" >DIKIRIM
                                <input type="checkbox" id="chk_setuju" name="chk_setuju" value="6" >SETUJU
                              <?php
                            }elseif ($value['status']=="4") {
                              ?>

                               <input type="checkbox" id="chk_final" name="chk_final" value="1" >FINAL
                                <input type="checkbox" id="chk_setuju" name="chk_setuju" value="6" >SETUJU
                               <input type="checkbox" id="chk_kirim" name="chk_kirim" checked="true" value="4" >DIKIRIM
                              <?php

                            }elseif ($value['status']=="6") {
                                ?>
                                  <input type="checkbox" id="chk_final" name="chk_final" value="1" >FINAL
                                  <input type="checkbox" id="chk_kirim" name="chk_kirim" value="4" >DIKIRIM
                                  <input type="checkbox" id="chk_setuju" name="chk_setuju" checked="true" value="6" >SETUJU
                                <?php
                            }elseif ($value['status']=="5") {
                              ?>

                                 <input type="checkbox" id="chk_final" name="chk_final" checked="true" value="1" >FINAL
                                <input type="checkbox" id="chk_kirim" name="chk_kirim" checked="true" value="4" >DIKIRIM
                                <input type="checkbox" id="chk_setuju" name="chk_setuju" value="6" >SETUJU
                              <?php
                            }elseif ($value['status']=="7") {
                              ?>
                                <input type="checkbox" id="chk_final" name="chk_final" checked="true" value="1" >FINAL
                                <input type="checkbox" id="chk_kirim" name="chk_kirim"  value="4" >DIKIRIM
                                <input type="checkbox" id="chk_setuju" name="chk_setuju" checked="true" value="6" >SETUJU
                              <?php
                            }elseif ($value['status']=="10") {
                              ?>
                                <input type="checkbox" id="chk_final" name="chk_final" value="1" >FINAL
                                <input type="checkbox" id="chk_kirim" name="chk_kirim" checked="true" value="4" >DIKIRIM
                                <input type="checkbox" id="chk_setuju" name="chk_setuju" checked="true" value="6" >SETUJU

                              <?php
                            }elseif ($value['status']=="11") {
                              ?>

                                <input type="checkbox" id="chk_final" name="chk_final" checked="true" value="1" >FINAL
                                <input type="checkbox" id="chk_kirim" name="chk_kirim" checked="true" value="4" >DIKIRIM
                                <input type="checkbox" id="chk_setuju" name="chk_setuju" checked="true" value="6" >SETUJU
                              <?php
                            }else{
                              ?>
                                 <input type="checkbox" id="chk_final" name="chk_final"  value="1" >FINAL
                                <input type="checkbox" id="chk_kirim" name="chk_kirim"  value="4" >DIKIRIM
                                <input type="checkbox" id="chk_setuju" name="chk_setuju" value="6" >SETUJU
                              <?php
                            }
                          }
                          ?>
                    
                    </div>
                 <!-- End Copas -->
                  <div class="col-md-12">
                    <hr>
                    <br>
                  <?php
                    $id = $this->uri->segment(3);
                    $query=$this->db->query("SELECT * FROM tb_invoice WHERE no_invoice='$id' ");

                    foreach ($query->result_array() as $key) {
                      $nomorID=$key['no_invoice'];
                    }
                    if ($no_inv =="" or $no_inv != $nomorID) {
                      ?>
                     <input type="submit" name="simpan" disabled="true" value="Simpan" class="input-sm btn btn-primary"> &nbsp;&nbsp;   
                    
                    <input type="submit" name="cetak" disabled="true" value="Cetak" class="input-sm btn btn-primary">
                      <?php
                    }else{

                      ?>
                     <input type="submit" name="simpan" value="Simpan" class="input-sm btn btn-primary"> &nbsp;&nbsp;   
                    
                    <input type="submit" name="cetak" value="Cetak" class="input-sm btn btn-primary">
                      <?php
                    }
                  ?>
                   
                  </div>   
              </div><!-- /.box-body -->
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

 
     </div><!-- ./wrapper -->

     <?php $this->load->view('javascript') ?> 

   </body>
   </html>
