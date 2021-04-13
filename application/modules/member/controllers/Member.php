<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('shop.member/Cart_model');
		$this->load->model('users.login/Member_model');
	}

	public function index()
	{
   	if (!$this->session->userdata('id'))
		{
			redirect(base_url());
		}else{

			$data['title'] = 'Login';
			$data['jumlahCart'] =$this->refreshCart($this->session->userdata('id'));
			$getDataMember = $this->Member_model->get($this->session->userdata('id'));
			$data['level_member'] =$getDataMember['level_member'];
			if($getDataMember['level_member'] == "RESELLER"){
				$data['color'] ='warning';
			}elseif($getDataMember['level_member'] == "AGEN"){
				$data['color'] ='primary';
			}elseif($getDataMember['level_member'] == "DISTRIBUTOR"){
				$data['color'] ='success';
			}
			$this->load->view('member/tpl_member',$data);

		}
	}
	function refreshCart($idUser){
		$getDataCart = $this->Cart_model->getListQB(" where id_user = ".$this->session->userdata('id')."");
		foreach($getDataCart->result_array() as $row){
			$totalCart += $row['qty'];
		}
		return $totalCart;
	}

	function Logout()
	{
		$array_items = array(
				'id',
				'nama',
				'email',
				'nomor_telepon',
				'lisensi',
				'status'
			);

		$this->session->unset_userdata($array_items);
		$this->success('behasil');
	}
}
