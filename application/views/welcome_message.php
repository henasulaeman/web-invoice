<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
</style>
</head>
<body>

	<div id="container">
		<h1>Welcome to CodeIgniter!</h1>

		<div id="body">
			<form action="<?php echo base_url() ?>index.php/welcome/Save" method="POST">

				<label>Nama Toko</label>
				<input type="text" name="nm_toko" value="A" class="form-control input-sm" readonly="true" placeholder="Nama Toko">
				<label>Alamat Toko 1</label>
				<input type="text" name="almtToko_1" value="B" readonly="true" class="form-control input-sm" placeholder="Alamat 1" >
				<label>Alamat Toko 2</label>
				<input type="text" name="almtToko_2" value="C" readonly="true" class="form-control input-sm" placeholder="Alamat 2" >
				<label>No Invoice</label>
				<input type="text" name="noInvoice" value="123" class="form-control input-sm" readonly="true" >
				<label>Tanggal Invoice</label>
				<input type="text" name="tglInvoice" value="12/12/1222" class="form-control input-sm"  readonly="true">

				<label>Tanggal Jatuh Tempo</label>
				<input type="text" name="tglJtTempo" value="12/12/1222" class="form-control input-sm"  readonly="true">
				<h4>DITAGIH KEPADA</h4>
				<label>Nama Pelanggan</label>
				<input type="text" id="nm_plgn"  name="nm_plgn" value="" class="form-control input-sm textbox2" placeholder="Nama Pelanggan">
				<label>Alamat Pelanggan Baris 1</label>
				<input type="text" id="almt_plgn1" name="almt_plgn1" value="" class="form-control input-sm textbox2" placeholder="Alamat Pelanggan Baris 1" >
				<label>Alamat Pelanggan Baris 2</label>
				<input type="text" id="almt_plgn2" name="almt_plgn2" value="" class="form-control input-sm textbox2" placeholder="Alamat Pelanggan Baris 2" >
				<label>Alamat Pelanggan Baris 3</label> 
				<input type="text" id="almt_plgn3" name="almt_plgn3" value="" class="form-control input-sm textbox2" placeholder="Alamat Pelanggan Baris 3" >
				<h4>DIKIRIM KEPADA 
					<input id="enable" name="enable" checked="true" type="checkbox"> Aktif</h4>
					<label>Nama Penerima</label>
					<input type="text" id="nm_penerima" disabled="true" value="" name="nm_penerima" class="form-control input-sm textbox" placeholder="Nama Penerima" >
					<label>Alamat Penerima Baris 1</label>
					<input type="text" id="almt_penerima1" disabled="true" value=""  name="almt_penerima1" class="form-control input-sm textbox" placeholder="Alamat Penerima Baris 1" >
					<label>Alamat Penerima Baris 2</label>
					<input type="text" id="almt_penerima2" disabled="true" value=""   name="almt_penerima2" class="form-control input-sm textbox" placeholder="Alamat Penerima Baris 2" >
					<label>Alamat Penerima Baris 3</label>
					<input type="text" id="almt_penerima3" disabled="true" value="" name="almt_penerima3" class="form-control input-sm textbox" placeholder="Alamat Penerima Baris 3" >
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

							<td><textarea name="nm_brg" value="" class="form-control" class="form-control input-sm"></textarea></td>

							<td><input type="text" name="jml_qty" value="0"  placeholder="Jumlah"  class="form-control input-sm" ></td>

							<td><input type="text"  name="harga" value="0"  placeholder="Harga Satuan"  class="form-control input-sm input_uang"  ></td>

							<td><input type="text" name="total" value="0"  placeholder="Total"  class="form-control input-sm" ></td>



						</tbody>


					</table>
					<input type="text" name="jml_total" value="0"  class="form-control input-sm pull-right" placeholder="Total">
					<label></label>
					<input type="text" name="ongkir" value="0"  class="form-control input-sm pull-right input_uang" placeholder="Ongkir">
					<label></label>
					<input type="text" name="SubTotal" value="0"  class="form-control input-sm pull-right" placeholder="Sub Total">
					<label></label>
					<label>Catatan</label>
					<textarea name="catatan" class="form-control"></textarea>
					<label>Stample</label><br>
					<input type="checkbox" id="chk_final" name="chk_final">FINAL

					<input type="checkbox" id="chk_kirim" name="chk_kirim">DIKIRIM

					<input type="checkbox" id="chk_setuju" name="chk_setuju">SETUJU
					<input type="submit" value="Cetak Dan Simpan" class="form-control input-sm btn btn-primary">
				</form>
			</div>

			<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
		</div>

	</body>
	</html>