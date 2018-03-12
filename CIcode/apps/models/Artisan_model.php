<?php  

class Artisan_model extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }

    public static function querys($name,$n=1,$m=0)
    {
        $query = $this->db->get($name,$n,$m);return $query;
    }

    public function getProduct()
    {
        return $this->db->get('product'); 
    }

    public function getList($n,$k='',$v='',$limt=1,$offset=0)
    {
        $k =$k?$k:'id';
        $query = $this->db->get_where($n,array($k=>$v), $limt,$offset);return $query;
    }

    public function delData($n,$k='',$v='')
    {
        $k =$k?$k:'id';
        $this->db->where($k, $v);
        $this->db->delete($n);
    }

    public function insertData($n,$d)
    {
        $this->db->set($d);
        $this->db->insert($n);
    }

    public function updateDate($n,$d,$w){
        $w = is_array($w)?$w:array('id'=>$w);
        $this->db->update($n, $data, $w);
    }

}



