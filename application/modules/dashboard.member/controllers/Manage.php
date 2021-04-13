<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('Dashboard_model');
		$this->load->model('users.login/Member_model');
		$this->load->model('withdraw.member/Withdraw_model');

	}

	public function index()
	{
		$data = array();
		$data['content'] = 'manage';
		$data['title'] = 'Dashboard';
		$arrayDownline = array(0);
		$getDataMember = $this->Member_model->get($this->session->userdata('id'));
		$getDownline = $this->Dashboard_model->getDownline("where id_upline_direct = '".$this->session->userdata('id')."' or id_upline_undirect = '".$this->session->userdata('id')."'");
		foreach ($getDownline->result_array() as $rows) {
			$arrayDownline[] = $rows['id'];
		}
		$arrayOmsetJaringan = $this->Dashboard_model->getPersonalOmset(" and id_member in (".implode(",",$arrayDownline).") ");
		$arrayOmsetPersonal = $this->Dashboard_model->getPersonalOmset(" and id_member ='".$this->session->userdata('id')."'");
		$arrayKomisiPersonal = $this->Dashboard_model->getPersonalKomisi(" and id_member ='".$this->session->userdata('id')."'");
		$arrayKomisiJaringan = $this->Dashboard_model->getJaringanKomisi(" and id_member ='".$this->session->userdata('id')."'");
		$arrayTotalKomisi = $this->Dashboard_model->getTotalKomisi(" and id_member ='".$this->session->userdata('id')."'");
		$data['personalOmset'] = $this->numberFormat($arrayOmsetPersonal['omset_personal']);
		$data['jumlahTransaksi'] = $this->numberFormat($arrayOmsetPersonal['jumlah_transaksi']);
		$data['komisiPeronal'] = $this->numberFormat($arrayKomisiPersonal['komisi_personal']);
		$data['omsetJaringan'] = $this->numberFormat($arrayOmsetJaringan['omset_personal']);

		$data['komisiJaringan'] = $this->numberFormat($arrayKomisiJaringan['komisi_jaringan']);
		$data['komisiBulanIni'] = $this->numberFormat($arrayTotalKomisi['total_komisi']);

		$data['komisiBelumBayar'] = $this->numberFormat($getDataMember['saldo']);
		$data['saldoUmroh'] = $this->numberFormat($getDataMember['akumulasi_omset_pribadi']);


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
