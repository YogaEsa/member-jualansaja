<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('Leads_model');
		$this->load->model('shop.member/Wilayah_model');

	}

	public function index()
	{
		$data = array();
		$data['content'] = 'manage';
		$data['title'] = 'Leads';
		$arrayCustom = $this->Leads_model->get_list("id_member = '".$this->session->userdata('id')."' ");
		$arrayData = array();
		$nomorUrut = 1;
		foreach($arrayCustom->result_array() as $row){
			$getDataProvinsi = $this->Wilayah_model->get(array("provinsi_id_raja_ongkir"=>$row['provinsi'],"kota_id_raja_ongkir"=>"0","kecamatan_id"=>"0"));
			$getDataKota = $this->Wilayah_model->get(array("provinsi_id_raja_ongkir"=>$row['provinsi'],"kota_id_raja_ongkir"=>$row['kota'],"kecamatan_id"=>"0"));
			$arrayData[] = array(
				'id' => $row['id'],
				'nomor_daftar' => $nomorUrut,
				'waktu' => $row['waktu'],
				'nama' => $row['nama'],
				'nomor_telepon' => $this->convertPhoneNumber($row['nomor_telepon']),
				'email' => $row['email'],
				'provinsi_kota' => $getDataKota['nama']." ".$getDataProvinsi['nama'],
				'username' => $row['username'],
				'status' => $row['status'],
			);
			$nomorUrut += 1;
		}
		$data['arrayDaftar'] = $arrayData;
		$this->load->view($data['content'],$data);
	}
	public function filter(){
		foreach ($_REQUEST as $key => $value) {
				$$key = $value;
		}
		$data = array();
		$data['content'] = 'filter';
		$data['filterNama'] = $filterNama;
		$data['comboStatus'] = $this->cmbArray("filterStatus",$levelMember,array(array("LEADS","LEADS"),array("RESELLER","RESELLER"),array("AGEN","AGEN")),"-- STATUS --","style='font-size: 14px;' class='form-control'");

		$data['jumlahData'] = $jumlahData;

		$this->load('filter', $data['content'], $data);
	}
	public function daftar(){
		foreach ($_REQUEST as $key => $value) {
				$$key = $value;
		}
		$data = array();
		$data['content'] = 'daftar';
		$arrayData = array();
		if(empty($pageKe))$pageKe = 1;
		if(empty($jumlahData))$jumlahData = 50;
		if($pageKe == 1){
			$nomorUrut = 1;
			$numberStart = 0;
		}else{
			$nomorUrut = (($pageKe - 1) * $jumlahData ) + 1;
			$numberStart = $nomorUrut - 1;
		}
		$arrayCustom = $this->Leads_model->getQB($this->generateCondition()," limit $numberStart,$jumlahData");
		foreach($arrayCustom->result_array() as $row){
			$getDataProvinsi = $this->Wilayah_model->get(array("provinsi_id_raja_ongkir"=>$row['provinsi'],"kota_id_raja_ongkir"=>"0","kecamatan_id"=>"0"));
			$getDataKota = $this->Wilayah_model->get(array("provinsi_id_raja_ongkir"=>$row['provinsi'],"kota_id_raja_ongkir"=>$row['kota'],"kecamatan_id"=>"0"));
			$arrayData[] = array(
				'id' => $row['id'],
				'nomor_daftar' => $nomorUrut,
				'waktu' => $row['waktu'],
				'nama' => $row['nama'],
				'nomor_telepon' => $this->convertPhoneNumber($row['nomor_telepon']),
				'email' => $row['email'],
				'provinsi_kota' => $getDataKota['nama']." ".$getDataProvinsi['nama'],
				'username' => $row['username'],
				'status' => $row['status'],
			);
			$nomorUrut += 1;
		}
		$data['arrayDaftar'] = $arrayData;
		$this->load('daftar', $data['content'], $data);
	}

	public function viewDetail(){
		$data['content'] = 'view_detail';
		$this->load('view_detail',$data['content']);
	}

	function generateCondition(){
		foreach ($_REQUEST as $key => $value) {
				$$key = $value;
		}
		$arrayKondisi = array();
		if(!empty($filterNama)){
			$arrayKondisi[] = "nama like '%$filterNama%'";
		}
		if(!empty($filterStatus)){
			$arrayKondisi[] = "status = '$filterStatus'";
		}
		$arrayKondisi[] = "id_member = '".$this->session->userdata('id')."'";
		$Kondisi = join(' and ', $arrayKondisi);
	  $Kondisi = $Kondisi == '' ? '' : ' Where ' . $Kondisi;
	  return  $Kondisi;
	}
	public function paging(){
		$getData = $this->Leads_model->getQB($this->generateCondition());
		$pageKe = $_POST['pageKe'];
		$data['paging'] = $this->tableFooter(sizeof($getData->result_array()),50,"",$pageKe,10,"");
		$this->load('paging', "paging", $data);
	}

	public function add(){
		$data = array();
		$data['content'] = 'add';
		$data['title'] = 'Tambah Leads';
		$data['comboProvinsi'] =  $this->cmbQuery("idProvinsi",$idProvinsi,$this->Wilayah_model->queryComboBox(array("kota_id ='0' ")),array("provinsi_id_raja_ongkir","nama"),"class='form-control form-control-sm' onChange=provinsiChanged() ","-- PROVINSI --");
		$data['comboKota'] =  $this->cmbQuery("idKota",$idKota,$this->Wilayah_model->queryComboBox(array("provinsi_id_raja_ongkir = '$idProvinsi'","kota_id !='0' ","kecamatan_id = 0")),array("kota_id_raja_ongkir","nama"),"class='form-control form-control-sm'  ","-- KOTA --");
		$this->load->view($data['content'],$data);
	}

	function save() {
		foreach ($_REQUEST as $key => $value) {
				$$key = $value;
		}
		$dataInput['provinsi'] = $idProvinsi;
		$dataInput['kota'] = $idKota;
		$dataInput['id_member'] = $this->session->userdata('id');
		$dataInput['nama'] = $namaLeads;
		$dataInput['email'] = $emailLeads;
		$dataInput['nomor_telepon'] = $nomorTelepon;
		$dataInput['waktu'] = date("Y-m-d H:i:s");
		$dataInput['status'] = "LEADS";
		$dataInput['username'] = $usernameLeads;
		$this->Leads_model->save($dataInput);
		$idLeads = $this->db->insert_id();
		$content = array(
			"idLeads" => $idLeads
		);
		$arrayResponse = array(
			"err" =>  "",
			"cek" =>  "",
			"content" => $content
		);
		echo json_encode($arrayResponse);
		die();
  }

}
