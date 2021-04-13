<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends Base_Model
{
    function __construct()
    {
        parent::__construct();
        $this->set_table('komisi');
        $this->set_pk('id');
    }

    function get_list()
    {
        $this->db->select('tbl.*');
        $this->db->where($this->where);
        if ($this->order_by) {
            $this->db->order_by($this->pk_field . ' DESC');
        }

        foreach ($this->order_by as $key => $value) {
            $this->db->order_by($key, $value);
        }

        if (!$this->limit AND !$this->offset)
            $query = $this->db->get($this->table . ' tbl');
        else
            $query = $this->db->get($this->table . ' tbl', $this->limit, $this->offset);
        // echo $this->db->last_query();
        // exit;
        if ($query->num_rows() > 0) {
            return $query;

        } else {
            $query->free_result();
            return $query;
        }
    }

    function getPersonalOmset($Kondisi = ""){
      $query= "select sum(sub_total) as omset_personal, count(id) as jumlah_transaksi from transaksi where status_order ='COMPLETE' and month(tanggal) =".date("m")." and year(tanggal) ='".date("Y")."' and 1=1 $Kondisi $Limit";
      
      $execute = $this->db->query($query);
      $arrayIndex = $execute->result_array();
      return $arrayIndex[0];
    }
    function getPersonalKomisi($Kondisi = ""){
      $query= "select sum(total) as komisi_personal from mutasi_komisi where jenis ='WIDRAW ABLE' and keterangan like 'PEMBELIAN PRIBADI SENILAI %' and month(waktu) =".date("m")." and year(waktu) ='".date("Y")."' and 1=1 $Kondisi $Limit";
      $execute = $this->db->query($query);
      $arrayIndex = $execute->result_array();
      return $arrayIndex[0];
    }
    function getJaringanKomisi($Kondisi = ""){
      $query= "select sum(total) as komisi_jaringan from mutasi_komisi where jenis ='KOMISI PEMBELIAN JARINGAN'and month(waktu) =".date("m")." and year(waktu) ='".date("Y")."' and 1=1 $Kondisi $Limit";
      $execute = $this->db->query($query);
      $arrayIndex = $execute->result_array();
      return $arrayIndex[0];
    }
    function getTotalKomisi($Kondisi = ""){
      $query= "select sum(total) as total_komisi from mutasi_komisi where jenis ='WIDRAW ABLE' and month(waktu) =".date("m")." and year(waktu) ='".date("Y")."' and 1=1 $Kondisi $Limit";
      $execute = $this->db->query($query);
      $arrayIndex = $execute->result_array();
      return $arrayIndex[0];
    }
    function getDownline($Kondisi = "", $Limit = ""){
      $query= "select * from member $Kondisi $Limit";
      return $this->db->query($query);
    }


}
