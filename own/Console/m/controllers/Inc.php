<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Inc extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }


	public function index()
	{
		$db_table = 'zero_paper_articles';
		$columns = array('number','title','content_url','pic_url','content','app_tag');
		$terms1=['is_banner'=>false];
		$terms2=['is_banner'=>true];
		//$this->load->model('article');
		//$this->db->start_cache();
		//$this->db->stop_cache();
		//$this->db->flush_cache();
		$q = $this->db->select($columns)->get_where($db_table,$terms1)->result_array();
		$f = $this->db->select($columns)->get_where($db_table,$terms2)->result_array();

		$results = json_encode(["q"=>$q,"f"=>$f,"code"=>333],JSON_UNESCAPED_UNICODE);
		echo ($results);
		//$this->load->view('welcome_message');
	}

	public function api_render() {
		echo '1111111';
	}
}
