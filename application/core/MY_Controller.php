<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use com\google\i18n\phonenumbers\PhoneNumberUtil;
use com\google\i18n\phonenumbers\PhoneNumberFormat;
use com\google\i18n\phonenumbers\NumberParseException;
require_once 'application/libraries/phonenumber/PhoneNumberUtil.php';
class MY_Controller extends CI_Controller
{
	var $template_data = array();
	var $update = array();
	var $blocked_object = array();
	var $title = '..: APES  :..';
	var $secure = true;
	 public function __construct()
	{
		parent::__construct();
		// if($this->secure==false){

		// }else
		// {
		// 	if (!$this->is_logged_in())
		// 	{
		// 		redirect(get_language().'/login');
		// 	}
		// }


	}

	function numberText($arrayOption){
    if(!isset($arrayOption['class'])){
      $className = "form-control form-control-sm";
    }else{
      $className = $arrayOption['class'];
    }

		if(!isset($arrayOption['params']))$arrayOption['params'] = "style='text-align:right;'";
    return "<input type='text' name='".$arrayOption['id']."' id = '".$arrayOption['id']."' value='".$arrayOption['value']."' class='$className' ".$arrayOption['params']." onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup=numberMark(this); >";
  }
	function removeDot($angka){
    $angka = str_replace(".","",$angka);
    return $angka;
  }

	function checkLogin(){
		if ($this->session->userdata('idUser') == '') {
			redirect(base_url());
		}
	}
	function imageToBase($fileLocation){
		return "data:image/jpg;base64,".base64_encode(file_get_contents($fileLocation));
	}
	function baseToImage($base64_string, $output_file) {
	  $ifp = fopen( $output_file, 'wb' );
	  $data = explode( ',', $base64_string );
	  fwrite( $ifp, base64_decode( $data[ 1 ] ) );
	  fclose( $ifp );
	  return $output_file;
	}
	function titiMangsa($date) {
			$BulanIndo    = array("Januari", "Februari", "Maret","April", "Mei", "Juni","Juli", "Agustus", "September","Oktober", "November", "Desember");
			$tahun        = substr($date, 0, 4);
			$bulan        = substr($date, 5, 2);
			$tgl          = substr($date, 8, 2);
			$result       = $tgl." ".$BulanIndo[(int)$bulan-1]." ".$tahun;
			return($result);
	}
	function tableFooter($Jumlah=0,$PerHal=0,$NameHal="Hal",$Hal="", $batas=9, $fnGotoHal = 'gotoHalaman2()'){
    global $HTTP_POST_VARS, $Pg, $SPg;
    if ($Hal==''){
      $Hal = isset($HTTP_POST_VARS[$NameHal])?$HTTP_POST_VARS[$NameHal]:1;
    }
    $JmlHal = ceil($Jumlah / $PerHal);
    $Awal = 1;
    $Akhir = $JmlHal;
    $Sebelum = $Hal > 1 ?$Hal - 1:1;
    $Sesudah = $Hal < $JmlHal ? $Hal + 1 : $JmlHal;
    $disSebelum = $Hal <= 1 ? " disabled ":"";
    $disSesudah = $Hal >= $JmlHal ? " disabled ":"";
    $disGoTo = $Awal==$Akhir ? " disabled " :"";
    //generate pilihan hal
    $Str = ""; $Ops = "";
    $aw= 1; $ak=$JmlHal; //default
    $aw = $Hal-$batas>=1? $Hal-$batas: 1;
    $ak = $Hal+$batas <=$JmlHal? $Hal+$batas : $JmlHal;
    $xarray=array(0.25,5,0.75);
    if ($aw>1){
    $maw=1;
    $Ops .= "<option  value='1'>1</option>";
    } else {
      $maw=0;
    }
    if ($maw>0){
    for ($i=0;$i<3;$i++){
      $mawx=floor($xarray[$i]*$aw);
      if ($mawx<$aw){
        if ($mawx>$maw){
          $Ops .= "<option  value='$mawx'>$mawx</option>";
          // $dataPaggingContent .= "<li class='liPagging'>
          //                           <a onclick=goToPage($mawx)>$mawx</a>
          //                       </li>";
          $dataPaggingContent .= "<li class='page-item' onclick=goToPage($makx)><a class='page-link' >$makx</a></li>";
          $maw=$mawx;
        }
      }
    }
    }
    for ($i = $aw; $i<=$ak; $i++) {
      $sel = $i == $Hal ? " active ":""; $dataPaggingContent .= "<li class='page-item $sel'  onclick=goToPage($i)><a class='page-link'  >$i</a></li>";
    }
    if ($ak<$Akhir){
    $mak=$Akhir;
    } else {
      $mak=0;
    }

    if ($mak>0){
    $tmakx=$ak;
    for ($i=0;$i<3;$i++){
      $arg=$Akhir-$ak;

      $makx=floor($xarray[$i]*$arg)+$ak;
      if ($makx>$ak){
        if ($makx>$tmakx && $makx<$Akhir){
          $Ops .= "<option  value='$makx'>$makx</option>";
          // $dataPaggingContent .= "<li class='liPagging'>
          //                           <a onclick=goToPage($makx)>$makx</a>
          //                       </li>";
          $dataPaggingContent .= "<li class='page-item' onclick=goToPage($makx)><a class='page-link' >$makx</a></li>";
          $tmakx=$makx;
        }
      }
    }
    $Ops .= "<option value='$Akhir'>$Akhir</option>";
    }
    $Ops = "<select name='cbxhalaman'  id='cbxhalaman' onChange=\"$fnGotoHal('page',this.value)\">$Ops</select>";
    $Str = " <input $disSebelum type=button value='Awal' onClick=\"$fnGotoHal('awal',$Awal)\">
        <input $disSebelum type=button value='Sebelum' onClick=\"$fnGotoHal('sebelum',$Sebelum)\">
        $Ops <input $disSesudah type=button value='Sesudah' onClick=\"$fnGotoHal('sesudah',$Sesudah)\">
        <input $disSesudah type=button value='Akhir' onClick=\"$fnGotoHal('akhir',$Akhir)\">
        &nbsp;<input $disGoTo type=button value='Lihat Halaman'
        onClick=\"$fnGotoHal('goto',document.getElementById('".$NameHal."_fmHAL').value )\">&nbsp;:&nbsp;
        <input $disGoTo type='text' size='6' maxlength='10'
          name='".$NameHal."_fmHAL' id='".$NameHal."_fmHAL' value='$Hal'  onkeypress='return isNumberKey(event,1)'> &nbsp;
          <span style='color: red;' >$JmlHal hal &nbsp;/&nbsp; $Jumlah data</span>
        <input type=hidden id='$NameHal' name='$NameHal' value='$Hal'>
        <script language='javascript'> </script> ";
    $content = "
    <div class='card-footer clearfix'>
                  <ul class='pagination pagination-sm m-0 justify-content-center'>
                    <li class='page-item' $disSebelum onclick=goToPage($Awal)><a class='page-link' '>First</a></li>
                    <li class='page-item' $disSebelum onclick=goToPage($Sebelum)><a class='page-link' '>«</a></li>
                    $dataPaggingContent
                    <li class='page-item' $disSesudah onclick=goToPage($Sesudah)><a class='page-link' '>»</a></li>
                    <li class='page-item' $disSesudah onclick=goToPage($Akhir)><a class='page-link' '>Last</a></li>
                  </ul>
                </div>
            <center>
		<span style='color: red;' >$JmlHal hal &nbsp;/&nbsp; $Jumlah data</span></center>

                ";
    return $content;
  }
	function cmbQuery($name='txtField', $value='', $arrayData,$arrayKolom, $param='', $Atas='Pilih', $vAtas='') {
			global $Ref;
			$Input = "<option value='$vAtas'>$Atas</option>";
			foreach($arrayData->result_array() as $row){
				$Sel = $row[$arrayKolom[0]] == $value ? "selected" : "";
				$Input .= "<option $Sel value='".$row[$arrayKolom[0]]."'>".$row[$arrayKolom[1]]."</option>";
			}
			$Input = "<select $param class='form-control' name='$name' id='$name'>$Input</select>";
			return $Input;
	}


	function convertPhoneNumber($nomorTelepon){
		$phoneUtil = PhoneNumberUtil::getInstance();
		try {
				$swissNumberProto = $phoneUtil->parseAndKeepRawInput($nomorTelepon, "ID");
		} catch (NumberParseException $e) {
				$err = $e;
		}
		$nomorWA = $phoneUtil->format($swissNumberProto, PhoneNumberFormat::INTERNATIONAL);
		$nomorWA = str_replace("+","",$nomorWA);
		$nomorWA = str_replace(" ","",$nomorWA);
		$nomorTelepon = str_replace("-","",$nomorWA);
		return $nomorTelepon;
	}
	function connection(){
		 return mysqli_connect("localhost", "root", "rf09thebye", "dtx_concept");
	 }
		function sqlQuery($script){
		 return mysqli_query($this->connection(), $script);
	 }

	 function sqlInsert($table, $data){
				 if (is_array($data)) {
						 $key   = array_keys($data);
						 $kolom = implode(',', $key);
						 $v     = array();
						 for ($i = 0; $i < count($data); $i++) {
								 array_push($v, "'" . $data[$key[$i]] . "'");
						 }
						 $values = implode(',', $v);
						 $query  = "INSERT INTO $table ($kolom) VALUES ($values)";
				 } else {
						 $query = "INSERT INTO $table $data";
				 }
				 return $query;

		 }

	 function sqlUpdate($table, $data, $where){
			 if (is_array($data)) {
					 $key   = array_keys($data);
					 $kolom = implode(',', $key);
					 $v     = array();
					 for ($i = 0; $i < count($data); $i++) {
							 array_push($v, $key[$i] . " = '" . $data[$key[$i]] . "'");
					 }
					 $values = implode(',', $v);
					 $query  = "UPDATE $table SET $values WHERE $where";
			 } else {
					 $query = "UPDATE $table SET $data WHERE $where";
			 }

			return $query;
	 }

	 function sqlArray($sqlQuery){
			 return mysqli_fetch_assoc($sqlQuery);
	 }

	 function sqlRowCount($sqlQuery){
			 return mysqli_num_rows($sqlQuery);
	 }



	function numberFormat($angka,$jumlahNol = 0){
		return number_format($angka,$jumlahNol,',','.');
	}
	function generateDate($tanggal){
        $tanggal = explode('-',$tanggal);
        $tanggal = $tanggal[2]."-".$tanggal[1]."-".$tanggal[0];
        return $tanggal;
  }
	function cmbArray($name='txtField',$value='',$arrList = '',$default='Pilih', $param='') {
		$isi = $value;
		$Input = "<option value=''>$default</option>";
		for($i=0;$i<count($arrList);$i++) {
			$Sel = $isi==$arrList[$i][0]?" selected ":"";
			$Input .= "<option $Sel value='{$arrList[$i][0]}'>{$arrList[$i][1]}</option>";
		}
		$Input  = "<select $param class='form-control' name='$name'  id='$name' >$Input</select>";
		return $Input;
	}
	// function ini untuk mengConvert inputan tanggal dari jQuery ke format database
	function convert_date($value)
	{
		$value = trim($value);
		$year = substr($value, 6,4);
		$month = substr($value, 3,2);
		$day = substr($value, 0,2);
		$value = $year.$month.$day;
		if (!$value)
			$value = null;
		return $value;
	}
	// function ini berfungsi untuk memvalidasi data secara operator
	function validation_input($objName,$min=0,$max=0)
	{
		$value = $this->input->post($objName);
		$isBlocked = false;
		$msg = '';
		// value-nya empty / kosong
		if (!$value)
		{
			$isBlocked = true;
			$msg = 'Please enter';
		}else
		{
			// jumlah digit dibawah minimum
			if ($min)
			{
				if (strlen($value) < $min)
				{
					$isBlocked = true;
					$msg = 'Minimum lenght is '.$min;
				}
			}
			// jumlah digit dibawah maximum
			if ($max)
			{
				if (strlen($value) > $max)
					$isBlocked = true;
			}
		}
		// here we goes
		if ($isBlocked)
		{
			// $obj_blocked['obj_name'] = $objName;
			// $obj_blocked['obj_msg'] = $msg;
			// $this->blocked_object[] = $obj_blocked;
			$this->set_blocked($objName,$msg);
		}

		return $value;
	}
	function set_blocked($objName='',$msg='')
	{
		$obj_blocked['obj_name'] = $objName;
		$obj_blocked['obj_msg'] = $msg;
		$this->blocked_object[] = $obj_blocked;
	}
	function set($name, $value)
	{
		$this->template_data[$name] = $value;
	}

	function load($template = '', $view = '' , $view_data = array(), $return = FALSE)
	{
		if (!isset($view_data['title']))
			$view_data['title'] = $this->title;

		$this->CI =& get_instance();
		$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
		return $this->CI->load->view($template, $this->template_data, $return);
	}

	public function is_logged_in()
	{
		return is_logged_in();
	}

	function success($msg='',$uri='')
	{
		$this->update['error']='';
		$this->update['message']=$msg;
		echo json_encode($this->update);
	}
	function error($err)
	{
		$this->update['blocked_object']=$this->blocked_object;
		$this->update['error']=$err;
		$this->update['message']='';
		echo json_encode($this->update);
		exit;
	}

	function success_redirect($msg='',$uri='')
	{
		redirect(get_language().'/'.$uri);
	}


	function gen_paging($page_data=array())
	{
		$func_name = "pageLoad";
		if (isset($page_data['load_func_name']))
		{
			if ($page_data['load_func_name'])
				$func_name = $page_data['load_func_name'];
		}
		$limit = $page_data['limit'];
		$limit = $limit?$limit:1;
		$count = ceil($page_data['count_row'] / $limit) ;
		$last_row = $limit*$page_data['current'];
		if ($last_row > $page_data['count_row'])
			$last_row = $page_data['count_row'];
		$page_result = '<div class="row" style="margin-top:1%;">';
		$page_result .= '<div class="col-sm-5">
							Showing '.(($limit*($page_data['current']-1))+1)
								.' to '.$last_row.' of '.$page_data['count_row'].' rows
						</div>';

		$page_result .= '	<div class="col-sm-1" style="left:10%;right:0;width:10%">
								<input type="number" value="'.$page_data['current'].'" min="0" max="'.$last_row.'" class="form-control" placeholder="Page..." value="" onkeydown="if (event.keyCode == 13) '.$func_name.'(this.value)">
							</div>

						';
		$page_result .= '<div class="col-sm-6" style="float: right;">
						';
		$page_result .= '<ul class="pagination d-flex justify-content-right pagination-success" style="float: right;"><li class="prev page-item '.($page_data['current']==1?'active':'').'"><a href="javascript:void(0)" '.($page_data['current']==1?'':'onclick="'.$func_name.'(1)"').' class="page-link">&lt; First</a></li>';

		$paging_show = 2;
		$page_start = $page_data['current'] - $paging_show;
		$page_start = $page_start<1?1:$page_start;
		//$page_end	= $count;
		$page_end = $page_data['current'] + $paging_show;
		$page_end = $count > $page_end ? $page_end : $count;
		$page_end = $count > 1 ? $page_end : 1;

		//
		if ($page_start > 1)
		{
			$page_result .= '<li class="active"><a href="javascript:void(0)" class="page-link">...</a></li>';
		}
		// before current
		for($i=$page_start; $i<=$page_end; $i++)
		{
			$page_result .= '<li class="page-item '.($page_data['current']==$i?'active':'').'" >'
							.'<a href="javascript:void(0)" '.($page_data['current']==$i?'':'onclick="'.$func_name.'('.$i.')"').' class="page-link">'.$i.'</a>'
							.'</li>';
		}
		// after current
		if ($page_end < $count)
		{
			$page_result .= '<li class="active" class="page-item"><a href="javascript:void(0)" class="page-link">...</a></li>';
		}

		$page_result .= '<li class="next page-item '.($page_data['current']==$page_end?'active':'').'"><a href="javascript:void(0)" onclick="'.$func_name.'('.$count.')" class="page-link">Last &gt; </a></li></ul>';
		$page_result .= '</div></div>';
		return $page_result;
	}

	function reject()
	{
		$this->load->view('rejected');
	}

	/*
	 * untuk mencari no transaksi yang baru
	 */
	function _get_tr_no($pref=null,$model=null,$date=true)
	{
		if (!$pref)
			$pref = '';
		else
			$pref .= '.';

		if ($date)
			$pref .= date('ym').'.';

		$pref_ln = strlen($pref);

		$tr_no = '';
		$no_last = $model->get_last_no($pref);
		$no_next = 1;
		if ($no_last)
		{
			$no_next = substr($no_last,$pref_ln,5)+1;
		}

		$tr_no = $pref.sprintf('%05s', $no_next);
		return $tr_no;
	}

		function getMonthList()
	{
		$month_list=array(
					1=>'Januari'
					,2=>'Februari'
					,3=>'Maret'
					,4=>'April'
					,5=>'Mei'
					,6=>'Juni'
					,7=>'Juli'
					,8=>'Agustus'
					,9=>'September'
					,10=>'Oktober'
					,11=>'November'
					,12=>'Desember'
					);
		return $month_list;
	}
	function getYearList($start=0,$end=0)
	{
		$year_list = array();
		for($x = $start; $x < $end; $x++) {
			$year_list[] = $x;
		}
		return $year_list;
	}

}
