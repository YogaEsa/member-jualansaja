<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('Withdraw_model');

	}

	public function index()
	{
		$data = array();
		$data['content'] = 'manage';
		$data['title'] = 'History Withdraw';
		$arrayCustom = $this->Withdraw_model->get_list("id_member = '".$this->session->userdata('id')."' ");
		$arrayData = array();
		$nomorUrut = 1;
		foreach($arrayCustom->result_array() as $row){
			$arrayData[] = array(
				'id' => $row['id'],
				'nomor_daftar' => $nomorUrut,
				'tanggal' => $this->generateDate($row['tanggal']),
				'jam' => $row['jam'],
				'status' => $row['status'],
				'total' => $this->numberFormat($row['jumlah_withdraw']),
			);
			$nomorUrut += 1;
		}
		$data['arrayDaftar'] = $arrayData;
		$this->load->view($data['content'],$data);
	}

}
