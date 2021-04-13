<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('shop.member/Transaksi_model');
		$this->load->model('shop.member/Transaksi_detail_model');
		$this->load->model('shop.member/Wilayah_model');

	}

	public function index()
	{
		$data = array();
		$data['content'] = 'manage';
		$data['title'] = 'Order';
		$getTransaksi = $this->Transaksi_model->get_list("id_member = ".$this->session->userdata('id'));
		// $data['dataJSON'] = $getTransaksi;
		$arrayTransaksi = array();
		foreach($getTransaksi->result_array() as $row){
			$arrayTransaksi[] = array(
				'idTransaksi' => $row['id'],
				'nama' => $row['nama_penerima'],
				'tanggal' => $this->generateDate($row['tanggal']),
				'jam' => $row['jam'],
				'nomor_telepon' => $row['nomor_telepon'],
				'status_order' => $row['status_order'],
				'total' => $this->numberFormat($row['total']),
			);
		}
		$data['dataJSON'] = $arrayTransaksi;
		$this->load->view($data['content'],$data);
	}
	public function detail()
	{
		$data = array();
		$data['content'] = 'detail';
		$data['title'] = 'Detail Order';
		$getDataTransaksi = $this->Transaksi_model->get($_GET['id']);
		$arrayDetail = $this->Transaksi_detail_model->get_list("id_transaksi = ".$_GET['id']);

		$getNamaProvinsi = $this->Wilayah_model->get(array("provinsi_id_raja_ongkir"=>$getDataTransaksi['provinsi'],"kota_id_raja_ongkir"=>"0") );
		$getNamaKota = $this->Wilayah_model->get(
			array(
			"provinsi_id_raja_ongkir"=>$getDataTransaksi['provinsi'],
			"kota_id_raja_ongkir"=>$getDataTransaksi['kota'],
			"kecamatan_id"=>"0"
			)
		 );

		$arrayDetailTransaksi = array();
		foreach($arrayDetail->result_array() as $row){
			$arrayDetailTransaksi[] = array(
				"id_produk" => $row['id_produk'],
				"nama_produk" => $row['nama_produk'],
				"harga" => $this->numberFormat($row['harga']),
				"qty" => $row['qty'],
				"total" => $this->numberFormat($row['sub_total']),
			);
		}
		$data['dataJSON'] = array(
			"idTransaksi" => $getDataTransaksi['id'],
			"nomor_telepon" => $getDataTransaksi['nomor_telepon'],
			"nama" => $getDataTransaksi['nama_penerima'],
			"alamat" => $getDataTransaksi['alamat'].", Kecamatan ".$getDataTransaksi['kecamatan'].", ".$getNamaKota['nama']." ".$getNamaProvinsi['nama'],
			"tanggal" => $this->generateDate($getDataTransaksi['tanggal']),
			"jam" =>$getDataTransaksi['jam'],
			"sub_total" =>$this->numberFormat($getDataTransaksi['sub_total']),
			"shiping" =>$this->numberFormat($getDataTransaksi['shiping']),
			"kode_unik" =>$getDataTransaksi['kode_unik'],
			"total" => $this->numberFormat($getDataTransaksi['total']),
			"arrayDetailTransaksi" => $arrayDetailTransaksi
		);


		$this->load->view($data['content'],$data);
	}

	function konfirmasiOrder(){
		foreach ($_REQUEST as $key => $value) {
				$$key = $value;
		}
		$getDataTransaksi = $this->Transaksi_model->get($idTransaksi);
		$arrayResponse = array(
			"err" =>  "",
			"cek" =>  "",
			"content" => array("url"=>"https://api.whatsapp.com/send?phone=6281223744803&text=Halo admin saya ingin konfirmasi order nomor *$idTransaksi* ")
		);
		echo json_encode($arrayResponse);
		die();
	}

	function generateTextFollowUp($idTransaksi,$idFollowUp){

    $arrayReplace = array(
      "{{tanggal}}",
      "{{jam}}",
      "{{code_coupon}}",
      "{{sub_total}}",
      "{{shiping}}",
      "{{discount}}",
      "{{total}}",
      "{{expedisi_pengiriman}}",
      "{{service_pengiriman}}",
      "{{nomor_resi}}",
      "{{nama}}",
      "{{provinsi}}",
      "{{kota}}",
      "{{kecamatan}}",
      "{{kode_pos}}",
      "{{alamat}}",
      "{{email}}",
      "{{nomor_telepon}}",
      "{{kode_unik}}",
      "{{status_order}}",
      "{{lunas}}",
      "{{tanggal_lunas}}",
      "{{jenis_pembayaran}}",
      "{{catatan}}",
      "{{type_motor}}",
      "{{single_product_name}}",
      "{{single_product_price}}",
      "{{rincian_order}}",

    );
    $getDataTransaksi = $this->sqlArray($this->sqlQuery("select * from transaksi where id = '$idTransaksi'"));

    $getDataFollowUp = $this->sqlArray($this->sqlQuery("select * from follow_up where id ='$idFollowUp'"));
    $returnText = $getDataFollowUp['deskripsi'];
    $returnText = str_replace("{{tanggal}}",$this->generateDate($getDataTransaksi['tanggal']),$returnText);
    $returnText = str_replace("{{jam}}",$getDataTransaksi['jam'],$returnText);
    $returnText = str_replace("{{code_coupon}}",$getDataTransaksi['code_coupon'],$returnText);
    $returnText = str_replace("{{sub_total}}",$this->numberFormat($getDataTransaksi['sub_total']),$returnText);
    $returnText = str_replace("{{shiping}}",$this->numberFormat($getDataTransaksi['shiping']),$returnText);
    $returnText = str_replace("{{discount}}",$this->numberFormat($getDataTransaksi['discount']),$returnText);
    $returnText = str_replace("{{total}}",$this->numberFormat($getDataTransaksi['total']),$returnText);
    $getDataExpedisi = $this->sqlArray($this->sqlQuery("select * from expedisi_pengiriman where id ='".$getDataTransaksi['id_expedisi_pengiriman']."'"));
    $returnText = str_replace("{{expedisi_pengiriman}}",$getDataExpedisi['nama_expedisi'],$returnText);
    $explodeService = explode(";",$getDataTransaksi['service_pengiriman']);
    $servicePengiriman = $explodeService[0]." ( ".$explodeService[2]." Hari )";
    $returnText = str_replace("{{service_pengiriman}}",$servicePengiriman,$returnText);
    $returnText = str_replace("{{nomor_resi}}",$getDataTransaksi['nomor_resi'],$returnText);
    $returnText = str_replace("{{nama}}",$getDataTransaksi['nama'],$returnText);
    $getDataProvinsi = $this->sqlArray($this->sqlQuery("select * from wilayah where provinsi_id_raja_ongkir ='".$getDataTransaksi['provinsi']."' and kota_id_raja_ongkir ='0' and kecamatan_id = '0'"));
    $getDataKota = $this->sqlArray($this->sqlQuery("select * from wilayah where provinsi_id_raja_ongkir ='".$getDataTransaksi['provinsi']."' and kota_id_raja_ongkir ='".$getDataTransaksi['kota']."' and kecamatan_id = '0'"));
    $getDataKecamatan = $this->sqlArray($this->sqlQuery("select * from wilayah where kecamatan_id='".$getDataTransaksi['kecamatan']."'"));
    if($getDataTransaksi['status_order'] == '1'){
      $statusTransaksi = "PENDING";
    }elseif($getDataTransaksi['status_order'] == '2'){
      $statusTransaksi = "PAID";
    }elseif($getDataTransaksi['status_order'] == '3'){
      $statusTransaksi = "PROCESSING";
    }elseif($getDataTransaksi['status_order'] == '4'){
      $statusTransaksi = "SHIPING";
    }elseif($getDataTransaksi['status_order'] == '5'){
      $statusTransaksi = "COMPLETED";
    }
    $returnText = str_replace("{{provinsi}}",$getDataProvinsi['nama'],$returnText);
    $returnText = str_replace("{{kota}}",$getDataKota['nama'],$returnText);
    $returnText = str_replace("{{kecamatan}}",$getDataKecamatan['nama'],$returnText);
    $returnText = str_replace("{{kode_pos}}",$getDataTransaksi['kode_pos'],$returnText);
    $returnText = str_replace("{{alamat}}",$getDataTransaksi['alamat'],$returnText);
    $returnText = str_replace("{{nomor_telepon}}",$getDataTransaksi['nomor_telepon'],$returnText);
    $returnText = str_replace("{{kode_unik}}",$getDataTransaksi['kode_unik'],$returnText);
    $returnText = str_replace("{{status_order}}",$statusTransaksi,$returnText);
    // $returnText = str_replace("{{lunas}}",$statusLunas,$returnText);
    $returnText = str_replace("{{tanggal_lunas}}",$this->generateDate($getDataTransaksi['tanggal_lunas']),$returnText);
    $returnText = str_replace("{{jenis_pembayaran}}",$getDataTransaksi['jenis_pembayaran'],$returnText);
    $returnText = str_replace("{{catatan}}",$getDataTransaksi['catatan'],$returnText);
    $returnText = str_replace("{{type_motor}}",$getDataTransaksi['type_motor'],$returnText);
    $getSingleProductTransaksi = $this->sqlArray($this->sqlQuery("select * from detail_transaksi where id_transaksi ='$idTransaksi' limit 1"));
    $returnText = str_replace("{{single_product_price}}",$this->numberFormat($getSingleProductTransaksi['harga_after_discount']),$returnText);
    $getDataSingleProduk = $this->sqlArray($this->sqlQuery("select * from produk where id = '".$getSingleProductTransaksi['id_produk']."'"));
    $returnText = str_replace("{{single_product_name}}",$getDataSingleProduk['nama_produk'],$returnText);
    $getDetailTransaksi = $this->sqlQuery("select * from detail_transaksi where id_transaksi = '$idTransaksi'");
		$itemOrder = "";
    while ($dataTransaksi = $this->sqlArray($getDetailTransaksi)) {
      $getDataProduk = $this->sqlArray($this->sqlQuery("select * from produk where id = '".$dataTransaksi['id_produk']."'"));
      if($dataTransaksi['harga'] != $dataTransaksi['harga_after_discount']){
        $hargaProduk = "~".$this->numberFormat($dataTransaksi['harga'])."~ ".$this->numberFormat($dataTransaksi['harga_after_discount']);
      }else{
        $hargaProduk = $this->numberFormat($dataTransaksi['harga_after_discount']);
      }
      $itemOrder.= $getDataProduk['nama_produk']." ( ".$dataTransaksi['kuantiti']." X $hargaProduk ) = *".$this->numberFormat($dataTransaksi['total'])."*\n";
    }
    $textRincianOrder = "
*Rincian Order :*
$itemOrder";
    $returnText = str_replace("{{rincian_order}}",$textRincianOrder,$returnText);

    return urlencode($returnText);

  }



}
