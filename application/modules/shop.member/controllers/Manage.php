<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// include 'application/libraries/SimpleEmailService.php';

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Shop_model');
		$this->load->model('Cart_model');
		$this->load->model('Produk_model');
		$this->load->model('users.login/Member_model');

		$this->load->model('Transaksi_model');
		$this->load->model('Mutasi_komisi_model');
		$this->load->model('Transaksi_detail_model');
		$this->load->model('Expedisi_model');
		$this->load->model('Wilayah_model');

	}

	public function index()
	{
		$data = array();
		$data['title'] = 'Shop';
		$data['content'] = "manage";
		$getDataProduk = $this->Shop_model->get_list();
		foreach($getDataProduk->result_array() as $row){
			$arrayJSON[] = array(
				"id" => $row['id'],
				"nama_produk" => $row['nama_produk'],
				"thumbnail" => $row['thumbnail'],
				"media" => $row['media'],
				"harga_jual" => $this->numberFormat($row['harga_jual']),
				"diskon_agen" => $row['diskon_agen'],
				"diskon_reseller" => $row['diskon_reseller'],
				"reward_kumulatif" => $row['reward_kumulatif'],
				"deskripsi" => $row['deskripsi'],
				"berat" => $row['berat'],
			);
		}
		$data['dataJSON'] = $arrayJSON;
		$this->load->view($data['content'],$data);
	}
	public function detail()
	{
		$data = array();
		$data['title'] = 'Shop';
		$data['content'] = "detail";
		$getDataProduk = $this->Produk_model->get($_GET['id']);
		$data['id_produk'] = $getDataProduk['id'];
		$data['nama_produk'] = $getDataProduk['nama_produk'];
		$data['thumbnail'] = $getDataProduk['thumbnail'];
		$data['deskripsi'] = $getDataProduk['deskripsi'];
		$data['harga_jual'] = $this->numberFormat($getDataProduk['harga_jual']);
		$data['berat'] = $this->numberFormat($getDataProduk['berat']);
		$data['id_cart'] = "0";
		$getDataCart = $this->Cart_model->get(array("id_user" => $this->session->userdata('id'),"id_produk" => $getDataProduk['id'] ));
		if(!empty($getDataCart['id'])){
			$data['id_cart'] = $getDataCart['id'];
			$data['kuantiti'] = $getDataCart['qty'];
		}
		$this->load->view($data['content'],$data);
	}

	public function cart()
	{
		$data = array();
		$data['title'] = 'Cart';
		$data['content'] = "cart";
		// $getDataProduk = $this->Produk_model->get($_GET['id']);
		$data['list'] = $this->Cart_model->getListQB(" where id_user = ".$this->session->userdata('id')."" );
		$this->load->view($data['content'],$data);
	}

	public function addToCart()
	{
		foreach ($_REQUEST as $key => $value) {
				$$key = $value;
		}
		$cek = "";
		$err = "";
		$content = "";
		$getDataCart = $this->Cart_model->get(array("id_user" => $this->session->userdata('id'),"id_produk" => $idProduk ));
		if(empty($getDataCart['id'])){
			$getDataProduk = $this->Produk_model->get($idProduk);
			$dataInput['id_produk']=$idProduk;
			$dataInput['qty']=1;
			$dataInput['harga_produk']=$getDataProduk['harga_jual'];
			$dataInput['total']=$getDataProduk['harga_jual'] * 1;
			$dataInput['id_user']=$this->session->userdata('id');
			$this->Cart_model->save($dataInput);


			$content = array("jumlahCart"=>$this->refreshCart($this->session->userdata('id')));
		}else{
			$err = "Produk sudah ada dalam keranjang";
		}

		header('Content-Type: application/json');
		echo json_encode(array ('cek'=>$cek, 'err'=>$err, 'content'=>$content));

	}
	public function updateCart()
	{
		foreach ($_REQUEST as $key => $value) {
				$$key = $value;
		}
		$cek = "";
		$err = "";
		$content = "";

		$getDataProduk = $this->Produk_model->get($idProduk);
		if(!empty($idCart)){
			$dataInput['id']=$idCart;
		}
		$getDataProduk = $this->Produk_model->get($idProduk);
		$dataInput['id_produk']=$idProduk;
		$dataInput['qty']=$kuantiti;
		$dataInput['harga_produk']=$getDataProduk['harga_jual'];
		$dataInput['total']=$getDataProduk['harga_jual'] * $kuantiti;
		$dataInput['id_user']=$this->session->userdata('id');
		$this->Cart_model->save($dataInput);
		$content = array("jumlahCart"=>$this->refreshCart($this->session->userdata('id')));


		header('Content-Type: application/json');
		echo json_encode(array ('cek'=>$cek, 'err'=>$err, 'content'=>$content));

	}
	public function deleteCart()
	{
		foreach ($_REQUEST as $key => $value) {
				$$key = $value;
		}
		$cek = "";
		$err = "";
		$content = "";
		$this->Cart_model->delete($idCart);
		$content = array("jumlahCart"=>$this->refreshCart($this->session->userdata('id')));
		header('Content-Type: application/json');
		echo json_encode(array ('cek'=>$cek, 'err'=>$err, 'content'=>$content));
	}

	function refreshCart($idUser){
		$getDataCart = $this->Cart_model->getListQB(" where id_user = ".$this->session->userdata('id')."");
		foreach($getDataCart->result_array() as $row){
			$totalCart += $row['qty'];
		}
		return $totalCart;
	}
	function getBeratTotal($idUser){
		$getDataCart = $this->Cart_model->getListQB(" where id_user = ".$this->session->userdata('id')."");
		foreach($getDataCart->result_array() as $row){
			$beratTotal += $row['qty'] * $row['berat'];
		}
		return $beratTotal;
	}

	public function checkout()
	{
		$data = array();
		$data['title'] = 'Checkout';
		$data['content'] = "checkout";
		$getDataMember = $this->Member_model->get($this->session->userdata('id'));
		$data['nama'] = $getDataMember['nama'];
		$data['email'] = $getDataMember['email'];
		$data['nomor_telepon'] = $getDataMember['nomor_telepon'];
		$data['alamat'] = $getDataMember['alamat'];
		$data['comboProvinsi'] =  $this->cmbQuery("idProvinsi",$idProvinsi,$this->Wilayah_model->queryComboBox(array("kota_id ='0' ")),array("provinsi_id_raja_ongkir","nama"),"class='form-control form-control-sm' onChange=provinsiChanged() ","-- PROVINSI --");
		$data['comboKota'] =  $this->cmbQuery("idKota",$idKota,$this->Wilayah_model->queryComboBox(array("provinsi_id_raja_ongkir = '$idProvinsi'","kota_id !='0' ","kecamatan_id = 0")),array("kota_id_raja_ongkir","nama"),"class='form-control form-control-sm'  ","-- KOTA --");
		$data['comboExpedisi'] =  $this->cmbQuery("idExpedisi",$idExpedisi,$this->Expedisi_model->queryComboBox(),array("id","nama_expedisi"),"class='form-control form-control-sm' onChange=expedisiPengirimanChanged();  ","-- EXPEDISI --");
		$data['comboStatusOrder'] = $this->cmbArray("statusOrder","PENDING",array(array("PENDING","PENDING"),array("PAID","PAID"),array("COMPLETE","COMPLETE")),"-- STATUS ORDER --","style='font-size: 14px;' class='form-control form-control-sm'");

		$data['beratTotal'] = $this->getBeratTotal($this->session->userdata('id'));

		$this->db->select("sum(total) as totalSemua");
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get("cart" . ' tbl', 1, 0);
		$getSum  = $query->row_array();
		$data['subTotal'] = $getSum['totalSemua'];
		$this->load->view($data['content'],$data);
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
	public function expedisiPengirimanChanged(){
		foreach ($_REQUEST as $key => $value) {
				$$key = $value;
		}
		$err= "";
		$cek= "";

    $getDataExpedisi = $this->Expedisi_model->get($idExpedisi);
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "origin=23&destination=".$idKota."&weight=$beratTotal&courier=".$getDataExpedisi['code'],
      CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: 16c622acb7d2938b0b6a4c4fc148eadd"
      ),
    ));
    $response = curl_exec($curl);
    $decodeResponse = json_decode($response);
    $arrayService =  $decodeResponse->rajaongkir->results[0]->costs;
    $arrayServiceExpedisi = array();
    $arrayCombo[] = array("","-- SERVICE PENGIRIMAN --");
    for ($i=0; $i < sizeof($arrayService) ; $i++) {
      $arrayServiceExpedisi[] = array(
        "service" => $arrayService[$i]->service,
        "description" => $arrayService[$i]->description,
        "tarif" => $arrayService[$i]->cost[0]->value,
        "estimasi" => $arrayService[$i]->cost[0]->etd,
      );
      $arrayCombo[] = array(
        $arrayService[$i]->service.";".$arrayService[$i]->cost[0]->value.";".$arrayService[$i]->cost[0]->etd,
        $arrayService[$i]->service." ( ".$arrayService[$i]->cost[0]->etd." Hari) "
      );
    }
		$arrayResponse = array(
			"err" => $err,
			"cek" => $cek,
			"content" => array(
				"servicePengiriman" => $this->cmbArray("servicePengiriman",  "",$arrayCombo  ,"class='form-control' onChange=getOngkir()")
			  ),
		);

		echo json_encode($arrayResponse);
		die();

	}

// 	function cmbArray($name='txtField',$value='',$arrList = '', $param='') {
//      	$isi = $value;
//     	for($i=0;$i<count($arrList);$i++) {
//     		$Sel = $isi==$arrList[$i][0]?" selected ":"";
//     		$Input .= "<option $Sel value='{$arrList[$i][0]}'>{$arrList[$i][1]}</option>";
//     	}
//     	$Input  = "<select $param name='$name'  id='$name' >$Input</select>";
//     	return $Input;
//   }
	function submitCheckOut() {
		foreach ($_REQUEST as $key => $value) {
				$$key = $value;
		}
		$dataInput['provinsi'] = $idProvinsi;
		$dataInput['kota'] = $idKota;
		$dataInput['id_member'] = $this->session->userdata('id');
		$dataInput['nama_penerima'] = $namaPembeli;
		$dataInput['email'] = $emailPembeli;
		$dataInput['nomor_telepon'] = $nomorTelepon;
		$dataInput['alamat'] = $alamatPembeli;
		$dataInput['tanggal'] = date("Y-m-d");
		$dataInput['jam'] = date("H:i:s");
		$dataInput['kecamatan'] = $kecamatanPembeli;
		$dataInput['id_expedisi_pengiriman'] = $idExpedisi;
		$dataInput['nomor_resi'] = "";
		$dataInput['service_pengiriman'] = $servicePengiriman;
		$dataInput['status_order'] = "PENDING";
		$dataInput['catatan_order'] = $catatanOrder;
		$this->Transaksi_model->save($dataInput);
		$idTransaksi = $this->db->insert_id();
		$getDataTemp = $this->Cart_model->getListQB(" where id_user = ".$this->session->userdata('id')."");
		foreach($getDataTemp->result_array() as $row){
			$dataDetail['id_transaksi'] = $idTransaksi;
			$dataDetail['id_produk'] = $row['id_produk'];
			$dataDetail['harga'] = $row['harga_produk'];
			$dataDetail['qty'] = $row['qty'];
			$dataDetail['sub_total'] = $row['total'];
			$getDataProduk = $this->Produk_model->get($row['id_produk']);
			$totalHPP += $getDataProduk['hpp'];
			$this->Transaksi_detail_model->save($dataDetail);
			$totalBelanja += $row['total'];
			$this->Cart_model->delete($row['id']);
		}
		$dataInput['id'] = $idTransaksi;
		$dataInput['hpp'] = $totalHPP;
		$this->Transaksi_model->save($dataInput);

		$dataUpdateHarga['id'] = $idTransaksi;
		$dataUpdateHarga['sub_total'] = $totalBelanja;
		$dataUpdateHarga['shiping'] = $hargaOngkir;
		$digits = 3;
		$kodeUnik = rand(pow(10, $digits-1), pow(10, $digits)-1);
		$dataUpdateHarga['kode_unik'] = $kodeUnik;
		$dataUpdateHarga['total'] = $totalBelanja + $kodeUnik + $hargaOngkir;
		$this->Transaksi_model->save($dataUpdateHarga);

		$content = array(
			"jumlahCart"=>$this->refreshCart($this->session->userdata('id')),
			"idTransaksi" => $idTransaksi
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
