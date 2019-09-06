<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class InvoiceModel extends Ci_Model{


	function CodeInvoice()
	{
		$this->db->select('Right(tb_invoice.no_invoice,3)as kode',false);
		$this->db->order_by('id_invoice','desc');
		$this->db->limit(1);

		$query=$this->db->get('tb_invoice');

		if ($query->num_rows()<>0) {
			$data=$query->row();
			$kode=intval($data->kode)+1;
		}else{
			$kode=1;
		}

		$kodemax = str_pad($kode,3,"0",STR_PAD_LEFT);
		$kodejadi= "INV".$kodemax;

		return $kodejadi;
	}

	function GetDtToko()
	{
		$q = $this->db->get('dt_toko');
		return $q;
	}

	function SaveInvoice($data)
	{
		$q = $this->db->insert('tb_invoice',$data);
		return $q;
	}

	function getBukuInvoice($id_user)
	{
		$q = $this->db->query("SELECT * FROM tb_invoice WHERE id_user='$id_user'");
		return $q;
	}

	function getDetailInvoice($no_invoice)
	{
		$q = $this->db->query("SELECT * FROM tb_invoice WHERE no_invoice='$no_invoice' ");
		return $q;
	}
	function getDetailProduk($no_invoice)
	{
		$q = $this->db->query("SELECT * FROM produk WHERE no_invoice='$no_invoice' ");
		return $q;
	}

	function deleteInvoice($no_invoice)
	{
		$this->db->where('no_invoice',$no_invoice);
		$this->db->delete('tb_invoice');
		
	}

	function deleteProduk($no_invoice)
	{
		$this->db->where('no_invoice',$no_invoice);
		$this->db->delete('produk');
	
	}
	function UpdateInvoice($no_invoice,$data)
	{
		$this->db->where('no_invoice',$no_invoice);
		$this->db->update('tb_invoice',$data);

	}


	// Query Input Resi

	public function InsertResi($data)
	{
		$q = $this->db->insert('tb_resi',$data);
		return $q;
	}
	
	public function UpdateResi($no_invoice,$data)
	{
		$this->db->where('no_invoice',$no_invoice);
		$this->db->update('tb_resi',$data);
	}
	


}