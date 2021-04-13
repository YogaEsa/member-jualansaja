<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SettingLandingPage_model extends Base_Model{
    function __construct() {
        parent::__construct();
        $this->set_table('pixel_landing_page');
        $this->set_pk('id');
    }
    function get_list(){
        $this->db->select('tbl.*');
        $this->db->where($this->where);
        if ($this->order_by) {
            $this->db->order_by($this->pk_field . ' ASC');
        }
        foreach ($this->order_by as $key => $value) {
            $this->db->order_by($key, $value);
        }
        if (!$this->limit AND !$this->offset)
            $query = $this->db->get($this->table . ' tbl');
        else
            $query = $this->db->get($this->table . ' tbl', $this->limit, $this->offset);
        if ($query->num_rows() > 0) {
            return $query;

        } else {
            $query->free_result();
            return $query;
        }
    }
    function getaDetail($idDetail){
        $this->db->select('tbl.*');
        if ($this->order_by) {
            $this->db->order_by($this->pk_field . ' ASC');
        }
        foreach ($this->order_by as $key => $value) {
            $this->db->order_by($key, $value);
        }
        $this->db->where('id',$idDetail);
        if (!$this->limit AND !$this->offset){
          $query = $this->db->get($this->table . ' tbl');
        }else{
          $query = $this->db->get($this->table . ' tbl', $this->limit, $this->offset);
        }
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            $query->free_result();
            return $query;
        }
    }
    function getLastID(){
        $this->db->select('id');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get($this->table . ' tbl', 1, 0);
        $data  = $query->row_array();
        return $data['id'];
    }

}
