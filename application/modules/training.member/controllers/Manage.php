<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// include 'application/libraries/SimpleEmailService.php';

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Training_model');
		$this->load->model('Modul_model');

	}

	public function index()
	{
		$data = array();
		$data['title'] = 'Training';
		$data['content'] = "manage";
		$getDataKategori = $this->Training_model->getQB("select * from kategori_training");
		for ($i=0; $i < sizeof($getDataKategori) ; $i++) {
			$dataModul = "";
			$getDataModul = $this->Training_model->getQB("select * from modul where id_kategori ='".$getDataKategori[$i]['id']."'");
			for ($iM=0; $iM < sizeof($getDataModul) ; $iM++) {
				$dataModul.= "
				<div class='col-lg-4 col-md-6 mb-3' style='cursor:pointer;' onClick=loadMainContentMember('/training.member/manage/modul/?id=".$getDataModul[$iM]['id']."'); >
					<div class='card stl-card shadow-lg' style='min-width:263px;'>
						<img class='card-img-top' src='".$getDataModul[$iM]['thumbnail']."' />
						<div class='card-body'>
						<h5 class='card-title text-center'>".$getDataModul[$iM]['nama_modul']."</h5>
						</div>
					</div>
				</div>";
			}
			if(sizeof($getDataModul) !=0){
				$dataKategori .= "
				<div class='card shadow-lg mb-4'>
					<div class='card-body'>
						<div class='d-flex align-items-center mb-3 border-bottom'>
							<h4 class='card-title'><i class='icon-social-youtube menu-icon py-2 mr-2'></i>".$getDataKategori[$i]['nama']."</h4>
						</div>
						<div class='card-deck'>
							<div class='row mb-4'>
							".$dataModul."
							</div>
						</div>
					</div>
				</div>";
			}
		}
		$data['html'] = $dataKategori;
		$this->load->view($data['content'],$data);
	}
	public function modul()
	{
		$getDataModul = $this->Modul_model->get($_GET['id']);
		$data = array();
		$data['title'] = $getDataModul['nama_modul'];
		$data['content'] = "modul";

		$dataTraining = "";
		$getDataTraining = $this->Training_model->getQB("select * from training where id_modul ='".$_GET['id']."'");
		for ($iT=0; $iT < sizeof($getDataTraining) ; $iT++) {
			$dataTraining .= "
				<div class='col-lg-4 col-md-6 mb-3' style='cursor:pointer;' onClick=loadMainContentMember('/training.member/manage/detail/?id=".$getDataTraining[$iT]['id']."');>
					<div class='card stl-card shadow-lg' style='min-width:263px;'>
						<img class='card-img-top' src='".$getDataTraining[$iT]['thumbnail_video']."' />
						<div class='card-body'>
							<h5 class='card-title text-center'>".$getDataTraining[$iT]['judul']."</h5>
						</div>
					</div>
				</div>";
		}


		$data['html'] = "<div class='row'>".$dataTraining."</div>";
		$this->load->view($data['content'],$data);
	}
	public function detail()
	{

		$getDataTraining = $this->Training_model->get($_GET['id']);
		$data = array();
		$data['title'] = $getDataTraining['judul'];
		$data['content'] = "detail";

		$dataTraining = "";
		$dataTraining .= "
		 <div class='card stl-card shadow-lg'>
			<iframe style='width:100%;height:300px;' src='".$getDataTraining['youtube_source']."' frameborder='0'
			allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture'
			allowfullscreen></iframe>
			<div class='card-body'>
			 <h4 class='card-title'>".$getDataTraining['judul']."</h4>
			<div class='text-justify'>
				<p>".$getDataTraining['deskripsi']."</p>
			</div>
			</div>
		</div>";


		$data['html'] = "<div class='row'>".$dataTraining."</div>";
		$this->load->view($data['content'],$data);
	}



}
