<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mutasi_komisi_model extends Base_Model{
  function __construct(){
      parent::__construct();
      $this->set_table('mutasi_komisi');
      $this->set_pk('id');
  }
  function get_list($arrayWhere = ""){
      $this->db->select('tbl.*');
      if(!empty($arrayWhere)){
        $this->db->where(
          $arrayWhere
        );
      }
      // if ($this->order_by) {
      //     $this->db->order_by($this->pk_field . ' ASC');
      // }
      $this->db->order_by("id desc");
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
  function getQB($Kondisi = "", $Limit = ""){
    $query= "select * from mutasi_komisi $Kondisi $Limit";
    return $this->db->query($query);
  }
  function queryComboBox($arrayKondisi = array()){
    $Kondisi = join(' and ', $arrayKondisi);
    $Kondisi = $Kondisi == '' ? '' : ' Where ' . $Kondisi;
    $query= "select * from mutasi_komisi $Kondisi";
    return $this->db->query($query);
  }
  function getLastID(){
      $this->db->select('id');
      $this->db->order_by('id', 'DESC');
      $query = $this->db->get($this->table . ' tbl', 1, 0);
      $data  = $query->row_array();
      return $data['id'];
  }

}
