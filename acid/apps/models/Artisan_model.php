<?php  

class Artisan_model extends CI_Model {

    public $page_size = 10;
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
        $query = $this->db->get('stor_product');
        return $query->result(); 
    }

    public function getUser($v='',$limt=1,$offset=0)
    {
        $query = $this->db->get_where('stor_users',$v, $limt,$offset);
        return $query->result()[0];
    }

    public function getNav()
    {
        $query = $this->db->get('stor_nav');
        return $query->result(); 
    }

    public function getAdds()
    {
        $this->db->where('del <>',1);
        $query = $this->db->get('stor_adds');
        return $query->result(); 
    }

    public function getOrders($o)
    {
        $this->db->select('*')->from('stor_order');
        $this->db->join('stor_product','stor_product.id=stor_order.oid','left');
        $query = $this->db->where($o)->get()->result();
        return $query; 
    }

    public function getModfiy($o)
    {
        $this->db->where($o);
        $query = $this->db->get('stor_adds')->result();
        return $query; 
    }

    public function getList($n,$k='',$v='',$limt=1,$offset=0)
    {
        $k =$k?$k:'id';
        $query = $this->db->get_where($n,array($k=>$v), $limt,$offset);return $query->result();
    }

    public function delData($n,$k='',$v='')
    {
        $k =$k?$k:'id';
        $this->db->where($k, $v);
        $this->db->delete($n);
    }

    public function delAdds($n,$d,$w)
    {
        $w = is_array($w)?$w:array('id'=>$w);
        $this->db->update($n, $d, $w);
    }

    public function insertData($n,$d)
    {
        $this->db->set($d);
        $this->db->insert($n);
    }

    public function updateDate($n,$data,$w){
        $w = is_array($w)?$w:array('id'=>$w);
        $this->db->update($n, $data, $w);
    }

    public function obj2ary($obj){
      $_arr = is_object($obj) ? get_object_vars($obj) :$obj;
      foreach ($_arr as $key=>$val){
       $val = (is_array($val) || is_object($val)) ? $this->obj2ary($val):$val;
       $arr[$key] = $val;
      }
      return $arr;
    }

    final public function listinfo($where = '',$data='*', $order = '', $page = 1, $pagesize = 20, $key='', $setpages = 10,$urlrule = '',$array = array()) {

    }


}



