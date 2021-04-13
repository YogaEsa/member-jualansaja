<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('Landing_page_model');
		$this->load->model('profile.member/Profile_model');
	}

	public function index(){
		$data = array();
		$data['content'] = 'manage';
		$data['title'] = 'Landing Page';
		$data['dataJSON'] = $this->Landing_page_model->get_list();
		$this->load->view($data['content'],$data);
	}
	public function detail(){
		$data = array();
		$data['content'] = 'detail';
		$data['title'] = 'Landing Page Detail';
		$data['idMember'] = $this->session->userdata('id');
		$data['dataLandingPage'] = $this->Landing_page_model->getaDetail($_GET['id']);
		$data['dataMember'] =  $this->Profile_model->get($this->session->userdata('id'));
		// print_r($this->Landing_page_model->getImageLandingPage($_GET['id']));
		// exit;

		$this->load->view($data['content'],$data);
	}
	function saveSettingLandingPage(){
		$content = "";
		$cek = "";
		$err = "";
		$dataSettingLandingPage = array();
		$getDataSettingLandingPage = $this->settingLanding_page_model->get(
			array(
				'id_member'=>$this->session->userdata('id'),
				'id_landing_page'=>$_POST['idLandingPage']
			)
		);
		if(empty($err)){
			if(empty($getDataSettingLandingPage['id']) ){
				$dataSettingLandingPage['id_member'] = $this->session->userdata('id');
			}else{
				$dataSettingLandingPage['id'] = $getDataSettingLandingPage['id'];
			}
			$dataSettingLandingPage['id_landing_page'] = $_POST['idLandingPage'];
			$dataSettingLandingPage['pixel_id'] = $_POST['pixelId'];
			$dataSettingLandingPage['event_onload'] = $_POST['pixelEventOnLoad'];
			$dataSettingLandingPage['event_onsubmit'] = $_POST['pixelEventOnSubmit'];
			$dataSettingLandingPage['tanggal_update'] = date("Y-m-d");
		  $this->settingLanding_page_model->save($dataSettingLandingPage);
		}
		$content = array("hai" => 'test');
		header('Content-Type: application/json');
		echo json_encode(array ('cek'=>$cek, 'err'=>$err, 'content'=>$content));
	}


}
