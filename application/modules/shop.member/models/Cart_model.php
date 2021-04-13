<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cart_model extends Base_Model
{

    function __construct()
    {

        parent::__construct();
        // $this->set_schema('dataMaster');
        $this->set_table('cart');
        $this->set_pk('id');
        // $this->set_log(true);
    }

    function get_list($arrayWhere = "")
    {
        $this->db->select('cart.*');
        $this->db->select("( select nama_produk from produk where id = cart.id_produk ) as nama_produk");
        $this->db->select("( select berat from produk where id = cart.id_produk ) as berat");
        if(!empty($arrayWhere)){
          $this->db->where(
            $arrayWhere
          );
        }
        // if ($this->order_by) {
        //     $this->db->order_by($this->pk_field . ' DESC');
        // }
		    $this->db->order_by('id' . ' ASC');
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

    function getListQB($Kondisi = "", $Limit = ""){
      $query= "select *, ( select nama_produk from produk where id = cart.id_produk ) as nama_produk, ( select berat from produk where id = cart.id_produk ) as berat  from cart $Kondisi $Limit";
      return $this->db->query($query);
    }

    function getLastID()
    {
        $this->db->select('id');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get($this->table . ' tbl', 1, 0);
        $data  = $query->row_array();
        return $data['id'];
    }


}
