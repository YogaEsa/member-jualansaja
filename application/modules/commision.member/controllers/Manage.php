<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('Commision_model');

	}

	public function index()
	{
		$data = array();
		$data['content'] = 'manage';
		$data['title'] = 'Mutasi Komisi';
		$arrayCustom = $this->Commision_model->get_list(" id_member ='".$this->session->userdata('id')."'");
		$arrayData = array();
		$nomorUrut = 1;
		foreach($arrayCustom->result_array() as $row){
			$arrayData[] = array(
				'id' => $row['id'],
				'nomor_daftar' => $nomorUrut,
				'waktu' => $row['waktu'],
				'nama_member' => $row['nama_member'],
				'nomor_transaksi' => $row['id_transaksi'],
				'jenis' => $row['jenis'],
				'keterangan' => $row['keterangan'],
				'total' => $this->numberFormat($row['total']),
			);
			$nomorUrut += 1;
		}
		$data['arrayDaftar'] = $arrayData;
		$this->load->view($data['content'],$data);
	}

}
