<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('Membership_model');
		$this->load->model('users.login/Member_model');
		$this->load->model('withdraw.member/Withdraw_model');

	}

	public function index()
	{
		$data = array();
		$data['content'] = 'manage';
		$data['title'] = 'Membership';
		$arrayDownline = array(0);
		$getDataMember = $this->Member_model->get($this->session->userdata('id'));
		$getDownline = $this->Membership_model->getDownline("where id_upline_direct = '".$this->session->userdata('id')."' or id_upline_undirect = '".$this->session->userdata('id')."'");
		foreach ($getDownline->result_array() as $rows) {
			$arrayDownline[] = $rows['id'];
		}
		$arrayOmsetJaringan = $this->Membership_model->getPersonalOmset(" and id_member in (".implode(",",$arrayDownline).") ");
		$arrayOmsetPersonal = $this->Membership_model->getPersonalOmset(" and id_member ='".$this->session->userdata('id')."'");
		$arrayKomisiPersonal = $this->Membership_model->getPersonalKomisi(" and id_member ='".$this->session->userdata('id')."'");
		$arrayKomisiJaringan = $this->Membership_model->getJaringanKomisi(" and id_member ='".$this->session->userdata('id')."'");
		$arrayTotalKomisi = $this->Membership_model->getTotalKomisi(" and id_member ='".$this->session->userdata('id')."'");
		$arrayKomisiReferal = $this->Membership_model->getKomisiReferal(" and id_member ='".$this->session->userdata('id')."'");
		$arrayJumlahReferal = $this->Membership_model->getJumlahReferal(" and id_member ='".$this->session->userdata('id')."'");
		$data['personalOmset'] = $this->numberFormat($arrayOmsetPersonal['omset_personal']);
		$data['jumlahTransaksi'] = $this->numberFormat($arrayOmsetPersonal['jumlah_transaksi']);
		$data['komisiPeronal'] = $this->numberFormat($arrayKomisiPersonal['komisi_personal']);
		$data['omsetTIM'] = $this->numberFormat($arrayOmsetJaringan['omset_personal']);

		$data['komisiTIM'] = $this->numberFormat($arrayKomisiJaringan['komisi_jaringan']);
		$data['komisiBulanIni'] = $this->numberFormat($arrayTotalKomisi['total_komisi']);
		$data['komisiReferal'] = $this->numberFormat($arrayKomisiReferal['komisi_referal']);
		$data['jumlahReferal'] = $this->numberFormat($arrayJumlahReferal['jumlah_referal']);

		$data['komisiBelumBayar'] = $this->numberFormat($getDataMember['saldo']);
		$data['saldoUmroh'] = $this->numberFormat($getDataMember['akumulasi_omset_pribadi']);

		$data['progresOmsetPribadi'] = $this->numberFormat($getDataMember['akumulasi_omset_pribadi'] / 5000000 * 100,2);
		$data['progresOmsetTim'] = $this->numberFormat(($getDataMember['akumulasi_omset_pribadi'] + $getDataMember['akumulasi_omset_tim']) / 10000000 * 100,2);
		$getJumlahReseller = $this->Membership_model->getDownline("where id_upline_direct = '".$this->session->userdata('id')."' ");
		$arrayReseller = array();
		foreach ($getJumlahReseller->result_array() as $rows) {
			$arrayReseller[] = $rows['id'];
		}
		$data['progressJumlahReseller'] = $this->numberFormat( ((sizeof($arrayReseller) - 1) / 50) * 100  );
		if($getDataMember['level_member'] == "AGEN"){
			$data['progresOmsetPribadi'] = "100";
			$data['progresOmsetTim'] = "100";
			$data['progressJumlahReseller'] = "100";
		}



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
