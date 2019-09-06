<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','form'));
		
		$this->load->model('InvoiceModel');
		$this->load->library('pdf');

		
	}


	public function index()
	{
		$this->load->view('login');
	}

	public function prosesLogin()
	{
		$tgl 	 =date("Y-d-m");
		$usr_nme =$this->input->post('email');
		$pwd	 =$this->input->post('pass');

		$pwdEncript=md5($pwd);
		$cekUserLogin =$this->db->query("SELECT * FROM tb_user WHERE username='$usr_nme' AND password='$pwdEncript' ");

		if ($cekUserLogin->num_rows()>0) {


			foreach ($cekUserLogin->result_array() as $row) {
				$sess_data['islogin']='islogin';
				$sess_data['id_user']=$row['id_user'];
				$sess_data['nama_tampilan']=$row['nama_tampilan'];
				$sess_data['username']=$row['username'];
				$sess_data['password']=$row['password'];
				$sess_data['status']  =$row['status'];
				$sess_data['tgl_login']=$tgl;


				if ($usr_nme==$sess_data['username'] AND $pwdEncript==$sess_data['password'] AND $sess_data['status']=="1") {
					$this->session->set_userdata($sess_data);
					
					redirect('invoice/BuatInvoice');

				}elseif($usr_nme==$sess_data['username'] AND $pwdEncript==$sess_data['password'] AND $sess_data['status']=="0"){
					echo "user Belum Terverifikasi";
				}
			}

		}else{
			print"<script>alert('Maaf Username atau Password anda tidak ada di Sistem .. !	');
			javascript:history.go(-1);</script>";
			exit();

		}

	}

	public function Logout()
	{
		$this->session->sess_destroy();
		redirect('invoice');
	}


	public function BuatInvoice()
	{	

		if (! $this->session->userdata('islogin')) {
			redirect('invoice');
		}else{
			$data['tglSekarang'] = date('d-m-Y');
			$id_user = $this->session->userdata('id_user');
			$data['kode_invoice'] =$this->InvoiceModel->CodeInvoice();
			$data['GetDtToko']    =$this->InvoiceModel->GetDtToko()->row_array();
			$data['getBukuInvoice']=$this->InvoiceModel->getBukuInvoice($id_user);
			$this->load->view('beranda',$data);
		}
		
	}

	public function SimpanInvoice()
	{
		if (! $this->session->userdata('islogin')) {
			redirect('invoice');
		}else{

			$btnsimpan =$this->input->post('simpan');
			$btncetak  =$this->input->post('cetak');

			if ($btnsimpan) {
				
				$nm_toko 		= $this->input->post('nm_toko');
				$almtToko_1 	= $this->input->post('almtToko_1');
				$rt 			= $this->input->post('rt');
				$rw 			= $this->input->post('rw');
				$kota 			= $this->input->post('kota');

				$noInvoice 		= $this->input->post('noInvoice');
				$tglInvoice 	= $this->input->post('tglInvoice');
				$tglJtTempo 	= $this->input->post('tglJtTempo');

				$nm_plgn 		= $this->input->post('nm_plgn');
				$almt_plgn1 	= $this->input->post('almt_plgn1');
				$kota_plgn	 	= $this->input->post('kota_plgn');
				$keckel_plgn	= $this->input->post('keckel_plgn');
				$no_plgn 	 	= $this->input->post('no_plgn');

				$nm_penerima 	= $this->input->post('nm_penerima');
				$almt_penerima1 = $this->input->post('almt_penerima1');
				$keckel_penerima= $this->input->post('keckel_penerima');
				$kota_penerima  = $this->input->post('kota_penerima');
				$no_penerima    = $this->input->post('no_penerima');



				$jml_total 	= $this->input->post('jml_total');
				$ongkir 	= $this->input->post('ongkir');
				$SubTotal 	= $this->input->post('SubTotal');


				$nm_pdk		= $this->input->post('nm_pdk');
				$jml_qty 	= $this->input->post('jml_qty');
				$harga	 	= $this->input->post('harga');
				$total 		= $this->input->post('total');

				$jml_total 	= $this->input->post('jml_total');
				$ongkir 	= $this->input->post('ongkir');
				$GrandTotal = $this->input->post('SubTotal');

				$catatan 	= $this->input->post('catatan');
				
				$chk_enable = $this->input->post('enable');

				$chk_final 	= $this->input->post('chk_final');
				$chk_kirim 	= $this->input->post('chk_kirim');
				$chk_setuju	= $this->input->post('chk_setuju');


				$sts=$chk_final+$chk_kirim+$chk_setuju;

				$dataInvoice = array('no_invoice' =>$noInvoice,
					'tgl_invoice'=>$tglInvoice,
					'tgl_jt_tempo'=>$tglInvoice,
					'nm_pelanggan'=>$nm_plgn,
					'almt_pelanggan1'=>$almt_plgn1,
					'kota_plgn'=>$kota_plgn,
					'keckel_plgn'=>$keckel_plgn,
					'nohp_plgn'=>$no_plgn,
					'nm_penerima'=>$nm_penerima,
					'almt_penerima1'=>$almt_penerima1,
					'kota_penerima'=>'-',
					'keckel_penerima'=>'-',
					'noHp_penerima'=>'-',
					'total'=>$jml_total,
					'ongkir'=>$ongkir,
					'grand_total'=>$GrandTotal,
					'catatan'=>$catatan,
					'status'=>$sts,
					'status_krm'=>$chk_enable,
					'id_user'=>$this->session->userdata('id_user'));



				$result= array();
				foreach ($nm_pdk as $key => $value) {
					$result[]=array('no_invoice'=>$noInvoice,
						'nm_produk'=>$_POST['nm_pdk'][$key],
						'jumlah_pemesanan'=>$_POST['jml_qty'][$key],
						'harga'=>$_POST['harga'][$key]);

			// $a=$result[$key];
			// echo $a->num_rows();
				}



				$this->db->insert_batch('produk',$result);
				$this->InvoiceModel->SaveInvoice($dataInvoice);
				?>
				<script type="text/javascript">alert("Invoice Berhasil Disimpan")</script>

				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."invoice/BuatInvoice'> ";



				

			}elseif ($btncetak) {
				$pathLogo = base_url()."assets/img/logo2.jpeg";

				$pdf = new FPDF('P','mm','A4');
				$pdf->AddPage();
				$pdf->SetFont('Arial','B',14);
				$pdf->Image($pathLogo,12,20,25,20);
				$pdf->Text(140,20,"INVOICE");
				$pdf->SetFont('Arial','',10);
				$pdf->Text(140,26,"Invoice No");$pdf->Text(162,26,":".$this->input->post('noInvoice'));
				$pdf->Text(140,31,"Tanggal");$pdf->Text(162,31,":".$this->input->post('tglInvoice'));
				$pdf->Text(140,36,"Jatuh Tempo");$pdf->Text(162,36,":".$this->input->post('tglJtTempo'));
				$pdf->SetFont('Arial','B',12);
				$pdf->Text(12,50,"".$this->input->post('nm_toko'));
				$pdf->SetFont('Arial','',10);
				$pdf->Text(12,55,$this->input->post('almtToko_1'));
				$pdf->Text(12,60,$this->input->post('kota'));

				$pdf->Ln(55);

				$pdf->Cell(190,7,'',1,0);
				if ($this->input->post('enable')==1) {
					$pdf->Text(12,70,"Ditagih Kepada");
					$pdf->Text(12,80,$this->input->post('nm_plgn'));
					$start_awal=$pdf->GetX();
					$get_xxx	   =$pdf->GetX();
					$get_yyy	   =$pdf->GetY();

					$width_cell=95;
					$height_cell=5;
					$pdf->Ln(18);
					$almt_plgn1=$this->input->post('almt_plgn1');
					// $nb=$pdf->WordWrap($almt_plgn1,,120);
					// $pdf->Write(5,$almt_plgn1);
					$pdf->MultiCell($width_cell,$height_cell,$this->input->post('almt_plgn1'));
					$get_xxx+=$width_cell;
					$pdf->SetXY($get_xxx, $get_yyy);

				}else{
					$pdf->Text(12,70,"Dikirim Kepada");
					$pdf->Text(12,80,$this->input->post('nm_penerima'));
					$start_awal=$pdf->GetX();
					$get_xxx	   =$pdf->GetX();
					$get_yyy	   =$pdf->GetY();

					$width_cell=95;
					$height_cell=5;
					$pdf->Ln(18);
					$pdf->Text(140,80,"");

					$pdf->MultiCell($width_cell,$height_cell,$this->input->post('almt_penerima1'));

					$get_xxx+=$width_cell;
					$pdf->SetXY($get_xxx, $get_yyy);
				}
				
				$pdf->Ln(55);
				$pdf->Cell(10,10,'NO',1,0,'C');
				$pdf->Cell(90,10,'DESKRIPSI',1,0,'C');
				$pdf->Cell(20,10,'Jumlah',1,0,'C');
				$pdf->Cell(33,10,'Harga Satuan (Rp)',1,0,'C');
				$pdf->Cell(33,10,'Total (Rp)',1,0,'C');
				$pdf->Ln(10);

				$noInvoice 	= $this->input->post('noInvoice');
				$nm_pdk		= $this->input->post('nm_pdk');
				$jml_qty 	= $this->input->post('jml_qty');
				$harga	 	= $this->input->post('harga');
				$total 		= $this->input->post('total');
				$pathFinal  = base_url()."assets/img/final.png";
				$pathKirim	= base_url()."assets/img/dikirim.png";
				$pathSetuju = base_url()."assets/img/setuju.png";
				$chk_final 	= $this->input->post('chk_final');
				$chk_kirim 	= $this->input->post('chk_kirim');
				$chk_setuju	= $this->input->post('chk_setuju');
				$no=1;	
				$total=0;
				$SubTotal=0;
				$GrandTotal=0;
				$result= array();

				foreach ($nm_pdk as $key => $value) {
					$result[]=array('no_invoice'=>$noInvoice,
						'nm_produk'=>$_POST['nm_pdk'][$key],
						'jumlah_pemesanan'=>$_POST['jml_qty'][$key],
						'harga'=>$_POST['harga'][$key]);

					$total =$result[$key]['jumlah_pemesanan']*$result[$key]['harga'];
					$SubTotal +=$total;
					$GrandTotal = $SubTotal+$this->input->post('ongkir');

					$pdf->Cell(10,10,$no++,1,0);
					$pdf->Cell(90,10,$result[$key]['nm_produk'],1,0);
					$pdf->Cell(20,10,$result[$key]['jumlah_pemesanan'],1,0);
					$pdf->Cell(33,10,number_format($result[$key]['harga']),1,0);
					$pdf->Cell(33,10,number_format($total),1,0);
					$pdf->Ln(10);
				}
				$pdf->Cell(10,10,'',0,0);
				$pdf->Cell(90,10,'',0,0);
				$pdf->Cell(20,10,'',0,0);
				$pdf->Cell(33,10,'Sub Total ',0,0);
				$pdf->Cell(33,10,number_format($SubTotal),1,0);
				$pdf->Ln(10);
				$pdf->Cell(10,10,'',0,0);
				$pdf->Cell(90,10,'',0,0);
				$pdf->Cell(20,10,'',0,0);
				$pdf->Cell(33,10,'Biaya Kirim ',0,0);
				$pdf->Cell(33,10,number_format($this->input->post('ongkir')),1,0);
				$pdf->Ln(10);

				$chk_final 	= $this->input->post('chk_final');
				$chk_kirim 	= $this->input->post('chk_kirim');
				$chk_setuju	= $this->input->post('chk_setuju');


				$sts=$chk_final+$chk_kirim+$chk_setuju;


				if ($sts==1) {
					$pdf->Image($pathFinal,30,125,25,20);
					//$pdf->Image($pathFinal,30,125,25,20);
					// $pdf->Image('path_file',x,y,W,H,Link);
				}elseif ($sts==4) {
					$pdf->Image($pathKirim,45,125,25,20);
				}elseif ($sts==6) {
					$pdf->Image($pathSetuju,60,125,25,20);
				}elseif ($sts==5) {

					$pdf->Image($pathFinal,30,125,25,20);

					$pdf->Image($pathKirim,45,125,25,20);
				}elseif ($sts==7) {
					$pdf->Image($pathFinal,30,125,25,20);

					$pdf->Image($pathSetuju,60,125,25,20);
				}elseif ($sts==10) {

					$pdf->Image($pathKirim,45,125,25,20);
					$pdf->Image($pathSetuju,60,125,25,20);
				}elseif ($sts==11) {

					$pdf->Image($pathFinal,30,125,25,20);
					$pdf->Image($pathKirim,45,125,25,20);
					$pdf->Image($pathSetuju,60,125,25,20);
				}

				
				$pdf->Cell(10,10,'',0,0);
				$pdf->Cell(90,10,'',0,0);
				$pdf->Cell(20,10,'',0,0);
				$pdf->Cell(33,10,'Grand Total ',0,0);
				$pdf->Cell(33,10,number_format($GrandTotal),1,0);
				$pdf->Ln(30);
				$pdf->Cell(185,9,'Catatan:'.$this->input->post('catatan'),1,0);
				$pdf->Output($this->input->post('noInvoice')."_".$this->input->post('tglInvoice').".pdf",'I');
			}


		}
	}

	public function DetailInvoice()
	{
		
		if (! $this->session->userdata('islogin')) {
			redirect('invoice');
		}else{
			$data['tglSekarang'] = date('d-m-Y');
			$id_user = $this->session->userdata('id_user');
			$noInv = $this->uri->segment(3);
			$data['getBukuInvoice']=$this->InvoiceModel->getBukuInvoice($id_user);
			$data['GetDtToko']    =$this->InvoiceModel->GetDtToko()->row_array();
			$data['detailInvoice']=$this->InvoiceModel->getDetailInvoice($noInv)->row_array();
			$data['detailProduk'] =$this->InvoiceModel->getDetailProduk($noInv);
			$this->load->view('InvoiceDetail',$data);
		}
	}

	public function EditInvoice()
	{
		
		if (! $this->session->userdata('islogin')) {
			redirect('invoice');
		}else{
			$data['tglSekarang'] = date('d-m-Y');
			$id_user = $this->session->userdata('id_user');
			$noInv = $this->uri->segment(3);
			$data['getBukuInvoice']=$this->InvoiceModel->getBukuInvoice($id_user);
			$data['GetDtToko']    =$this->InvoiceModel->GetDtToko()->row_array();
			$data['detailInvoice']=$this->InvoiceModel->getDetailInvoice($noInv)->row_array();
			$data['detailProduk'] =$this->InvoiceModel->getDetailProduk($noInv);
			$this->load->view('EditInvoice',$data);
		}
	}

	public function SimpanEditInvoice()
	{
		if (! $this->session->userdata('islogin')) {
			redirect('invoice');	
		}else{

			$btnsimpan =$this->input->post('simpan');
			$btncetak  =$this->input->post('cetak');

			if ($btnsimpan) {
				
				$nm_toko 		= $this->input->post('nm_toko');
				$almtToko_1 	= $this->input->post('almtToko_1');
				$rt 			= $this->input->post('rt');
				$rw 			= $this->input->post('rw');
				$kota 			= $this->input->post('kota');

				$noInvoice 		= $this->input->post('noInvoice');
				$tglInvoice 	= $this->input->post('tglInvoice');
				$tglJtTempo 	= $this->input->post('tglJtTempo');

				$nm_plgn 		= $this->input->post('nm_plgn');
				$almt_plgn1 	= $this->input->post('almt_plgn1');
				$kota_plgn	 	= $this->input->post('kota_plgn');
				$keckel_plgn	= $this->input->post('keckel_plgn');
				$no_plgn 	 	= $this->input->post('no_plgn');

				$nm_penerima 	= $this->input->post('nm_penerima');
				$almt_penerima1 = $this->input->post('almt_penerima1');
				$keckel_penerima= $this->input->post('keckel_penerima');
				$kota_penerima  = $this->input->post('kota_penerima');
				$no_penerima    = $this->input->post('no_penerima');



				$jml_total 	= $this->input->post('jml_total');
				$ongkir 	= $this->input->post('ongkir');
				$SubTotal 	= $this->input->post('SubTotal');


				$nm_pdk		= $this->input->post('nm_pdk');
				$jml_qty 	= $this->input->post('jml_qty');
				$harga	 	= $this->input->post('harga');
				$total 		= $this->input->post('total');

				$jml_total 	= $this->input->post('jml_total');
				$ongkir 	= $this->input->post('ongkir');
				$GrandTotal = $this->input->post('SubTotal');

				$catatan 	= $this->input->post('catatan');

				$chk_final 	= $this->input->post('chk_final');
				$chk_kirim 	= $this->input->post('chk_kirim');
				$chk_setuju	= $this->input->post('chk_setuju');


				$sts=$chk_final+$chk_kirim+$chk_setuju;

				$dataInvoice = array('no_invoice' =>$noInvoice,
					'tgl_invoice'=>$tglInvoice,
					'tgl_jt_tempo'=>$tglInvoice,
					'nm_pelanggan'=>$nm_plgn,
					'almt_pelanggan1'=>$almt_plgn1,
					'kota_plgn'=>$kota_plgn,
					'keckel_plgn'=>$keckel_plgn,
					'nohp_plgn'=>$no_plgn,
					'nm_penerima'=>$nm_penerima,
					'almt_penerima1'=>$almt_penerima1,
					'kota_penerima'=>$kota_penerima,
					'keckel_penerima'=>$keckel_penerima,
					'noHp_penerima'=>$no_penerima,
					'total'=>$jml_total,
					'ongkir'=>$ongkir,
					'grand_total'=>$GrandTotal,
					'catatan'=>$catatan,
					'status'=>$sts,
					'id_user'=>$this->session->userdata('id_user'));



				$result= array();
				foreach ($nm_pdk as $key => $value) {
					$result[]=array('id_produk'=>$_POST['id_produk'][$key],
						'no_invoice'=>$noInvoice,
						'nm_produk'=>$_POST['nm_pdk'][$key],
						'jumlah_pemesanan'=>$_POST['jml_qty'][$key],
						'harga'=>$_POST['harga'][$key]);

			// // $a=$result[$key];
			// // echo $a->num_rows();
				}


				$this->db->update_batch('produk',$result,'id_produk');
				$this->InvoiceModel->UpdateInvoice($noInvoice,$dataInvoice);
				print"<script>alert('Data Berhasil Di Update');
				javascript:history.go(-2);</script>";
				exit();
				

			}else{
				$pathLogo = base_url()."assets/img/logo2.jpeg";

				$pdf = new FPDF('P','mm','A4');
				$pdf->AddPage();
				$pdf->SetFont('Arial','B',14);
				$pdf->Image($pathLogo,12,20,25,20);
				$pdf->Text(140,20,"INVOICE");
				$pdf->SetFont('Arial','',10);
				$pdf->Text(140,26,"Invoice No");$pdf->Text(162,26,":".$this->input->post('noInvoice'));
				$pdf->Text(140,31,"Tanggal");$pdf->Text(162,31,":".$this->input->post('tglInvoice'));
				$pdf->Text(140,36,"Jatuh Tempo");$pdf->Text(162,36,":".$this->input->post('tglJtTempo'));
				$pdf->SetFont('Arial','B',12);
				$pdf->Text(12,50,"".$this->input->post('nm_toko'));
				$pdf->SetFont('Arial','',10);
				$pdf->Text(12,55,"".$this->input->post('almtToko_1'));
				$pdf->Text(11,60," RT/RW ".$this->input->post('rt_rw')." ".$this->input->post('kota'));

				$pdf->Ln(55);

				$pdf->Cell(190,7,'',1,0);

				if($this->input->post('nm_plgn')){
					$pdf->Text(12,70,"Ditagih Kepada");
					$pdf->Text(12,80,$this->input->post('nm_plgn'));
					$start_awal=$pdf->GetX();
					$get_xxx	   =$pdf->GetX();
					$get_yyy	   =$pdf->GetY();

					$width_cell=95;
					$height_cell=5;
					$pdf->Ln(18);
					$pdf->MultiCell($width_cell,$height_cell,$this->input->post('almt_plgn1'));
					$get_xxx+=$width_cell;
					$pdf->SetXY($get_xxx, $get_yyy);

				}else{
					$pdf->Text(12,70,"Dikirim Kepada");
					$pdf->Text(12,80,$this->input->post('nm_penerima'));
					$start_awal=$pdf->GetX();
					$get_xxx	   =$pdf->GetX();
					$get_yyy	   =$pdf->GetY();

					$width_cell=95;
					$height_cell=5;
					$pdf->Ln(18);
					$pdf->MultiCell($width_cell,$height_cell,$this->input->post('almt_penerima1'));
					$get_xxx+=$width_cell;
					$pdf->SetXY($get_xxx, $get_yyy);
				}

				// $pdf->Text(12,80,$this->input->post('nm_plgn'));
				// $pdf->Text(12,85,$this->input->post('almt_plgn1'));
				// $pdf->Text(12,90,$this->input->post('keckel_plgn'));
				// $pdf->Text(12,95,$this->input->post('kota_plgn'));
				// $pdf->Text(12,100,$this->input->post('no_plgn'));
				
				// $pdf->Text(120,80,$this->input->post('nm_penerima'));
				// $pdf->Text(120,85,$this->input->post('almt_penerima1'));
				// $pdf->Text(120,90,$this->input->post('keckel_penerima'));
				// $pdf->Text(120,95,$this->input->post('kota_penerima'));
				// $pdf->Text(120,100,$this->input->post('no_penerima'));

				$pdf->Ln(55);
				$pdf->Cell(10,10,'NO',1,0);
				$pdf->Cell(90,10,'DESKRIPSI',1,0);
				$pdf->Cell(20,10,'Jumlah',1,0);
				$pdf->Cell(33,10,'Harga Satuan (Rp)',1,0);
				$pdf->Cell(33,10,'Total (Rp)',1,0);
				$pdf->Ln(10);

				$noInvoice 	= $this->input->post('noInvoice');
				$nm_pdk		= $this->input->post('nm_pdk');
				$jml_qty 	= $this->input->post('jml_qty');
				$harga	 	= $this->input->post('harga');
				$total 		= $this->input->post('total');
				$pathFinal  = base_url()."assets/img/final.png";
				$pathKirim	= base_url()."assets/img/dikirim.png";
				$pathSetuju = base_url()."assets/img/setuju.png";
				$chk_final 	= $this->input->post('chk_final');
				$chk_kirim 	= $this->input->post('chk_kirim');
				$chk_setuju	= $this->input->post('chk_setuju');
				$no=1;
				$total=0;
				$SubTotal=0;
				$GrandTotal=0;
				$result= array();
				foreach ($nm_pdk as $key => $value) {
					$result[]=array('no_invoice'=>$noInvoice,
						'nm_produk'=>$_POST['nm_pdk'][$key],
						'jumlah_pemesanan'=>$_POST['jml_qty'][$key],
						'harga'=>$_POST['harga'][$key]);

					$total =$result[$key]['jumlah_pemesanan']*$result[$key]['harga'];
					$SubTotal +=$total;
					$GrandTotal = $SubTotal+$this->input->post('ongkir');

					$pdf->Cell(10,10,$no++,1,0);
					$pdf->Cell(90,10,$result[$key]['nm_produk'],1,0);
					$pdf->Cell(20,10,$result[$key]['jumlah_pemesanan'],1,0);
					$pdf->Cell(33,10,number_format($result[$key]['harga']),1,0);
					$pdf->Cell(33,10,number_format($total),1,0);
					$pdf->Ln(10);
				}
				$pdf->Cell(10,10,'',0,0);
				$pdf->Cell(90,10,'',0,0);
				$pdf->Cell(20,10,'',0,0);
				$pdf->Cell(33,10,'Sub Total ',0,0);
				$pdf->Cell(33,10,number_format($SubTotal),1,0);
				$pdf->Ln(10);
				$pdf->Cell(10,10,'',0,0);
				$pdf->Cell(90,10,'',0,0);
				$pdf->Cell(20,10,'',0,0);
				$pdf->Cell(33,10,'Biaya Kirim ',0,0);
				$pdf->Cell(33,10,number_format($this->input->post('ongkir')),1,0);
				$pdf->Ln(10);



				$chk_final 	= $this->input->post('chk_final');
				$chk_kirim 	= $this->input->post('chk_kirim');
				$chk_setuju	= $this->input->post('chk_setuju');


				$sts=$chk_final+$chk_kirim+$chk_setuju;


				if ($sts==1) {
					$pdf->Image($pathFinal,30,125,25,20);
				}elseif ($sts==4) {
					$pdf->Image($pathKirim,45,125,25,20);
				}elseif ($sts==6) {
					$pdf->Image($pathSetuju,60,125,25,20);
				}elseif ($sts==5) {

					$pdf->Image($pathFinal,30,125,25,20);

					$pdf->Image($pathKirim,45,125,25,20);
				}elseif ($sts==7) {
					$pdf->Image($pathFinal,30,125,25,20);

					$pdf->Image($pathSetuju,60,125,25,20);
				}elseif ($sts==10) {

					$pdf->Image($pathKirim,45,125,25,20);
					$pdf->Image($pathSetuju,60,125,25,20);
				}elseif ($sts==11) {

					$pdf->Image($pathFinal,30,125,25,20);
					$pdf->Image($pathKirim,45,125,25,20);
					$pdf->Image($pathSetuju,60,125,25,20);
				}
				$pdf->Cell(10,10,'',0,0);
				$pdf->Cell(90,10,'',0,0);
				$pdf->Cell(20,10,'',0,0);
				$pdf->Cell(33,10,'Grand Total ',0,0);
				$pdf->Cell(33,10,number_format($GrandTotal),1,0);
				$pdf->Ln(30);
				$pdf->Cell(185,9,'Catatan:'.$this->input->post('catatan'),1,0);
				$pdf->Output($this->input->post('noInvoice')."_".$this->input->post('tglInvoice').".pdf",'I');
			}
		}
	}

	public function DeleteBukuInvoice()
	{
		$noInvoice=$this->uri->segment(3);
		$this->InvoiceModel->deleteInvoice($noInvoice);
		$this->InvoiceModel->deleteProduk($noInvoice);
		?>
		<script type="text/javascript">alert("Data Berhasil Di Hapus")</script>

		<?php
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."invoice/BuatInvoice'> ";
	}

	public function CetakDetail()
	{
		if (! $this->session->userdata('islogin')) {
			redirect('invoice');
			
		}else{
			$noInvoice=$this->input->post('noInvoice');
			$pathFinal  = base_url()."assets/img/final.png";
			$pathKirim	= base_url()."assets/img/dikirim.png";
			$pathSetuju = base_url()."assets/img/setuju.png";
			$getInvoice=$this->db->query("SELECT * FROM tb_invoice WHERE no_invoice='$noInvoice'")->row_array();

			
			$code=$getInvoice['no_invoice'];
			$getProduk=$this->db->query("SELECT * FROM produk WHERE no_invoice='$code' ");

			
			
			$pathLogo = base_url()."assets/img/logo2.jpeg";

			$pdf = new FPDF('P','mm','A4');
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',14);
			$pdf->Image($pathLogo,12,20,25,20);
			$pdf->Text(140,20,"INVOICE");
			$pdf->SetFont('Arial','',10);
			$pdf->Text(140,26,"Invoice No");$pdf->Text(162,26,":".$this->input->post('noInvoice'));
			$pdf->Text(140,31,"Tanggal");$pdf->Text(162,31,":".$this->input->post('tglInvoice'));
			$pdf->Text(140,36,"Jatuh Tempo");$pdf->Text(162,36,":".$this->input->post('tglJtTempo'));
			$pdf->SetFont('Arial','B',12);
			$pdf->Text(12,50,"".$this->input->post('nm_toko'));
			$pdf->SetFont('Arial','',10);
			$pdf->Text(12,55,"".$this->input->post('almtToko_1'));
			$pdf->Text(12,60,$this->input->post('kota'));
			
			
			$pdf->Ln(55);
			$pdf->Cell(190,7,'',1,0);
			if ($getInvoice['status_krm']==1) {
				$pdf->Text(12,70,"Ditagih Kepada");
				$pdf->Text(12,70,"Ditagih Kepada");
				$pdf->Text(12,80,$this->input->post('nm_plgn'));
				$start_awal=$pdf->GetX();
				$get_xxx	   =$pdf->GetX();
				$get_yyy	   =$pdf->GetY();

				$width_cell=95;
				$height_cell=5;
				$pdf->Ln(18);
				$pdf->MultiCell($width_cell,$height_cell,$this->input->post('almt_plgn1'));
				$get_xxx+=$width_cell;
				$pdf->SetXY($get_xxx, $get_yyy);
			}else{

				$pdf->Text(12,70,"Dikirim Kepada");
			}

			$pdf->Text(12,80,$this->input->post('nm_penerima'));

			$start_awal=$pdf->GetX();
			$get_xxx	   =$pdf->GetX();
			$get_yyy	   =$pdf->GetY();
			$width_cell=95;
			$height_cell=5;
			$pdf->Ln(18);
			$pdf->MultiCell($width_cell,$height_cell,$this->input->post('almt_penerima1'));
			$get_xxx+=$width_cell;
			$pdf->SetXY($get_xxx, $get_yyy);

			$pdf->Ln(55);
			$pdf->Cell(10,10,'NO',1,0);
			$pdf->Cell(90,10,'DESKRIPSI',1,0);
			$pdf->Cell(20,10,'Jumlah',1,0);
			$pdf->Cell(33,10,'Harga Satuan (Rp)',1,0);
			$pdf->Cell(33,10,'Total (Rp)',1,0);
			$pdf->Ln(10);
			$no=1;
			$total=0;
			$SubTotal=0;
			$GrandTotal=0;
			foreach ($getProduk->result_array() as $value) {
				$total =$value['jumlah_pemesanan']*$value['harga'];
				$SubTotal +=$total;
				$GrandTotal = $SubTotal+$getInvoice['ongkir'];

				$pdf->Cell(10,10,$no++,1,0);
				$pdf->Cell(90,10,$value['nm_produk'],1,0);
				$pdf->Cell(20,10,$value['jumlah_pemesanan'],1,0);
				$pdf->Cell(33,10,number_format($value['harga']),1,0);
				$pdf->Cell(33,10,number_format($total),1,0);
				$pdf->Ln(10);

			}

			$pdf->Cell(10,10,'',0,0);
			$pdf->Cell(90,10,'',0,0);
			$pdf->Cell(20,10,'',0,0);
			$pdf->Cell(33,10,'Sub Total ',0,0);
			$pdf->Cell(33,10,number_format($SubTotal),1,0);
			$pdf->Ln(10);
			$pdf->Cell(10,10,'',0,0);
			$pdf->Cell(90,10,'',0,0);
			$pdf->Cell(20,10,'',0,0);
			$pdf->Cell(33,10,'Biaya Kirim ',0,0);
			$pdf->Cell(33,10,number_format($getInvoice['ongkir']),1,0);
			$pdf->Ln(10);


			$pdf->Cell(10,10,'',0,0);
			$pdf->Cell(90,10,'',0,0);
			$pdf->Cell(20,10,'',0,0);
			$pdf->Cell(33,10,'Grand Total ',0,0);
			$pdf->Cell(33,10,number_format($GrandTotal),1,0);
			$pdf->Ln(30);
			$pdf->Cell(185,9,'Catatan:'.$this->input->post('catatan'),1,0);

			
			$q= $this->db->query("SELECT * FROM tb_invoice WHERE no_invoice='$noInvoice' ");

			foreach ($q->result_array() as $value) {
				if ($value['status']=="1") {
					$pdf->Image($pathFinal,30,125,25,20);
				}elseif ($value['status']=="4") {
					$pdf->Image($pathKirim,45,125,25,20);

				}elseif ($value['status']=="6") {
					$pdf->Image($pathSetuju,60,125,25,20);
				}elseif ($value['status']=="5") {
					$pdf->Image($pathFinal,30,125,25,20);

					$pdf->Image($pathKirim,45,125,25,20);
				}elseif ($value['status']=="7") {
					$pdf->Image($pathFinal,30,125,25,20);

					$pdf->Image($pathSetuju,60,125,25,20);
				}elseif ($value['status']=="10") {
					$pdf->Image($pathKirim,45,125,25,20);
					$pdf->Image($pathSetuju,45,150,25,20);
				}elseif ($value['status']=="11") {
					$pdf->Image($pathFinal,30,125,25,20);
					$pdf->Image($pathKirim,45,125,25,20);
					$pdf->Image($pathSetuju,60,125,25,20);
				}
			}

			$pdf->Output($this->input->post('noInvoice')."_".$this->input->post('tglInvoice').".pdf",'I');
		}
		

	}

	public function SimpanResi()
	{

	if (! $this->session->userdata('islogin')) {
		redirect('Invoice');
	}else{
		$no_invoice = $this->input->post('no_invoice');
		$ekspedisi 	= $this->input->post('ekspedisi');
		$no_resi 	= $this->input->post('no_resi');
		$ket 		= $this->input->post('ket');
		$tgl 		= date('d-m-Y H:i:s');
		$id_user    = $this->session->userdata('id_user');
		$data = array('no_invoice' =>$no_invoice,
					  'no_resi'	   =>$no_resi,
					  'ekspedisi'  =>$ekspedisi,
					  'keterangan' =>$ket,
					  'tgl_input'  =>$tgl,
					  'id_user'	   =>$id_user);

		$getDataResi = $this->db->query("SELECT * FROM tb_resi WHERE no_invoice='$no_invoice' AND id_user='$id_user'  ")->num_rows();
		if ($getDataResi==1) {
			
			$this->InvoiceModel->UpdateResi($no_invoice,$data);
			?>
			<script type="text/javascript">alert("Data Berhasil Di Update")</script> 
			  	<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."Invoice/BuatInvoice'>";
			
		}else{

			$simpan=$this->InvoiceModel->InsertResi($data);
			if ($simpan) {
			 	?>
			<script type="text/javascript">alert("Data Berhasil Di simpan")</script> 
			  	<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."Invoice/BuatInvoice'>";
			}else{
			echo "gagal";
			}
		}


		

		 // echo $ekspedisi;


	}
		

		

		
	}


	
	public function DanaCair()
	{
		if (!$this->session->userdata('islogin')) {
			redirect('Invoice');
		}else{
			$id_user = $this->session->userdata('id_user');
			$data['getBukuInvoice']=$this->InvoiceModel->getBukuInvoice($id_user);
			$this->load->view('dana_cair',$data);
		}
	}

	public function testcetak()
	{
		$this->load->library('pdf');
		$pdf= new FPDF('P','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','',12);	
		$text=$this->input->post('judul');
		$nb=$pdf->WordWrap($text,120);
		$pdf->Cell(33,50,$text,0,0);
		$pdf->Write(5,"This paragraph has $nb lines:\n\n");
		$pdf->Write(5,$text);

		$pdf->Output();

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */