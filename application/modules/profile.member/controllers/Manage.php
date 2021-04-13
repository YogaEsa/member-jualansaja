<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('users.login/Member_model');
		$this->load->model('users.login/Users_model');
		$this->load->model('shop.member/Wilayah_model');
		$this->load->model('Profile_model');

	}

	public function index()
	{
		$data = array();
		$data['content'] = 'manage';
		$data['title'] = 'Profile';
		$getDataMember = $this->Member_model->get($this->session->userdata('id'));
		$data['nama'] = $getDataMember['nama'];
		$data['email'] = $getDataMember['email'];
		$data['nomor_telepon'] = $getDataMember['nomor_telepon'];
		$data['alamat'] = $getDataMember['alamat'];
		$data['bank'] = $getDataMember['bank'];
		$data['affiliate'] = $getDataMember['affiliate'];
		$data['level_member'] = $getDataMember['level_member'];
		$data['nama_pemilik_rekening'] = $getDataMember['nama_pemilik_rekening'];
		$getDataUpline = $this->Member_model->get($getDataMember['id_upline_direct']);
		$data['usernameUpline'] = $getDataUpline['affiliate'];

		$data['comboProvinsi'] =  $this->cmbQuery("idProvinsi",$getDataMember['id_provinsi'],$this->Wilayah_model->queryComboBox(array("kota_id ='0' ")),array("provinsi_id_raja_ongkir","nama"),"class='form-control form-control-sm' onChange=provinsiChanged() ","-- PROVINSI --");
		$data['comboKota'] =  $this->cmbQuery("idKota",$getDataMember['id_kota'],$this->Wilayah_model->queryComboBox(array("provinsi_id_raja_ongkir = '".$getDataMember['id_provinsi']."'","kota_id !='0' ","kecamatan_id = 0")),array("kota_id_raja_ongkir","nama"),"class='form-control form-control-sm'  ","-- KOTA --");

		$data['dataJSON'] = $this->Profile_model->get($this->session->userdata('id'));

		$this->load->view($data['content'],$data);
	}



	function saveProfile(){
		$content = "";
		$cek = "";
		$err = "";
		if(empty($err)){
			$dataProfile = array();
			$dataProfile['id'] = $this->session->userdata('id');
			$dataProfile['nama'] = $_POST['nama'];
			$dataProfile['nomor_telepon'] = $_POST['nomorTelepon'];
			$dataProfile['id_provinsi'] = $_POST['idProvinsi'];
			$dataProfile['id_kota'] = $_POST['idKota'];
			$dataProfile['alamat'] = $_POST['alamat'];
			$dataProfile['bank'] = $_POST['namaBank'];
			$dataProfile['nomor_rekening'] = $_POST['nomorRekening'];
			$dataProfile['nama_pemilik_rekening'] = $_POST['namaRekening'];
			$this->Profile_model->save($dataProfile);
		}
		$content = array("hai" => 'test');
		header('Content-Type: application/json');
		echo json_encode(array ('cek'=>$cek, 'err'=>$err, 'content'=>$content));
	}

	function saveAccess()
	{
		$content = "";
		$cek = "";
		$err = "";
		$old_pass = $this->input->post('old_pass');
		$new_pass = $this->input->post('new_pass');
		$kon_pass = $this->input->post('kon_pass');
		$checkPass  =  $this->Member_model->get($this->session->userdata('id'));
		if ($old_pass =='' || $new_pass =='' || $kon_pass =='') {
			$err  = 'Semua inputan wajib diisi!';
		}elseif (md5($old_pass) != $checkPass['password']) {
			$err = 'Password Lama Salah ';
		}elseif ($new_pass != $kon_pass) {
			$err = 'Password Baru Tidak Sama';
		}
		if(empty($err)){
			$dataMember = array();
			$dataMember['id'] = $checkPass['id'];
			$dataMember['password'] = md5($kon_pass);
			$saveMember = $this->Member_model->save($dataMember);
			if ($saveMember) {
			}else{
				$err = "Ubah Password Gagal";
			}
		}



		header('Content-Type: application/json');
		echo json_encode(array ('cek'=>$cek, 'err'=>$err, 'content'=>$content));
	}


	public function provinsiChanged(){
		foreach ($_REQUEST as $key => $value) {
				$$key = $value;
		}
		$err= "";
		$cek= "";
		$arrayResponse = array(
			"err" => $err,
			"cek" => $cek,
			"content" => array("idKota"=> $this->cmbQuery("idKota",$idKota,$this->Wilayah_model->queryComboBox(array("provinsi_id_raja_ongkir = '$idProvinsi'","kota_id !='0' ","kecamatan_id = 0")),array("kota_id_raja_ongkir","nama"),"class='form-control form-control-sm'  ","-- KOTA --")  ),
		);
		echo json_encode($arrayResponse);
		die();

	}


}
