<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('Announcement_model');
		// $this->load->model('users.login/users_model');
		// $this->load->model('users.login/member_model');

	}

	public function index()
	{
		$data = array();
		$data['content'] = 'manage';
		$data['title'] = 'Announcement';
		$getAnnouncement = $this->Announcement_model->get_list();

		$arrayAnnoucement = array();
		foreach($getAnnouncement->result_array() as $row){
			$arrayAnnoucement[] = array(
				'idAnnouncement' => $row['id'],
				'judul' => $row['judul'],
				'tanggal' => $this->generateDate($row['tanggal']),
			);
		}
		$data['dataJSON'] = $arrayAnnoucement;
		$this->load->view($data['content'],$data);
	}
	public function detail()
	{
		$data = array();
		$data['content'] = 'detail';
		$data['title'] = 'Detail Order';
		$getAnnouncement = $this->Announcement_model->get($_GET['id']);

		$data['dataJSON'] = array(
			"idAnnouncement" => $getAnnouncement['id'],
			"judul" => $getAnnouncement['judul'],
			"isi_content" => base64_decode($getAnnouncement['isi_content']),
			"tanggal" => $this->generateDate($getAnnouncement['tanggal']),
		);
		$this->load->view($data['content'],$data);
	}





}
