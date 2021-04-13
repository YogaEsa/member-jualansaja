<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('Reward_model');
		$this->load->model('users.login/Member_model');
		$this->load->model('membership.member/Membership_model');

	}

	public function index()
	{
		$data = array();
		$data['content'] = 'manage';
		$data['title'] = 'Reward';
		$arrayDownline = array(0);
		$getDataMember = $this->Member_model->get($this->session->userdata('id'));
		$getDataReward = $this->Reward_model->get_list();
		$arrayReward = array();
		foreach($getDataReward->result_array() as $row){
			$statusDapatClaim = "BELUM";
			if($getDataMember['akumulasi_omset_pribadi'] >= $row['omset_pribadi'] || ($getDataMember['akumulasi_omset_pribadi'] + $getDataMember['akumulasi_omset_tim']) >= $row['omset_team'])$statusDapatClaim="BISA";
			$arrayReward[] = array(
				"id"=>$row['id'],
				"nama_reward"=>$row['nama_reward'],
				"thumbnail"=>$row['thumbnail'],
				"statusDapatClaim"=>$statusDapatClaim,
				"omset_pribadi"=> $this->numberFormat($row['omset_pribadi']),
				"omset_team"=> $this->numberFormat($row['omset_team']),
				"progresOmsetPribadi"=> $this->numberFormat($getDataMember['akumulasi_omset_pribadi'] / $row['omset_pribadi'] * 100,2),
				"progresOmsetTeam"=> $this->numberFormat(($getDataMember['akumulasi_omset_pribadi'] + $getDataMember['akumulasi_omset_tim']) / $row['omset_team'] * 100,2)
			);
		}
		$data['dataReward'] = $arrayReward;

		// $data['progresOmsetPribadiHP'] = $this->numberFormat($getDataMember['akumulasi_omset_pribadi'] / 50000000 * 100,2);
		// $data['progresOmsetTimHP'] = $this->numberFormat(($getDataMember['akumulasi_omset_pribadi'] + $getDataMember['akumulasi_omset_tim']) / 100000000 * 100,2);


		$this->load->view($data['content'],$data);
	}
	public function withdraw()
	{
		$data = array();
		$data['content'] = 'withdraw';
		$data['title'] = 'Withdraw';
		$getDataMember = $this->Member_model->get($this->session->userdata('id'));
		$data['nomor_rekening']= $getDataMember['nomor_rekening'];
		$data['bank']= $getDataMember['bank'];
		$data['nama_pemilik_rekening']= $getDataMember['nama_pemilik_rekening'];
		$data['saldo']= $getDataMember['saldo'];
		$this->load->view($data['content'],$data);
	}

	function saveWithdraw(){
		foreach ($_REQUEST as $key => $value) {
				$$key = $value;
		}
		$content = "";
		$cek = "";
		$err = "";
		$getDataMember = $this->Member_model->get($this->session->userdata('id'));

		if($getDataMember['saldo'] < $jumlahWithdraw){
			$err = "Saldo Tidak Cukup";
		}
		if(empty($err)){
			$dataWithdraw['tanggal'] = date("Y-m-d");
			$dataWithdraw['jam'] = date("H:i");
			$dataWithdraw['id_member'] = $this->session->userdata('id');
			$dataWithdraw['jumlah_withdraw'] = $jumlahWithdraw;
			$dataWithdraw['status'] = "PENDING";
			$this->Withdraw_model->save($dataWithdraw);

			$dataMember['id'] = $this->session->userdata('id');
			$dataMember['saldo'] = $getDataMember['saldo'] - $jumlahWithdraw;
			$this->Member_model->save($dataMember);
		}
		header('Content-Type: application/json');
		echo json_encode(array ('cek'=>$cek, 'err'=>$err, 'content'=>$content));
	}

}
