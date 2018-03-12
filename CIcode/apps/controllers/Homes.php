<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Homes extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('app');
		$this->load->model('artisan_model');
	}

	public function index()
	{
		$key = '42dfcb34fb02d8cd';
		$account = $this->input->get('account')?$this->input->get('account'):'abc123';
		$tim = time();
		$sign = $this->encry($key,'webGetUser',$account,$tim);
		$dat=array(
			'act'=>'webGetUser',
			'account'=>$account,
			'time'=>$tim,
			'sign'=>$sign,
		);
		$dat=json_encode($dat);
		$uri = 'http://119.23.161.142:13000/webGetUser';
		$res = json_decode(post_json($uri,$dat));
		$datas['a'] = $res->data->account;
		$datas['n'] = $res->data->nickname;
		$datas['u'] = $res->data->userId;

		$this->session->set_userdata($datas);
		$this->artisan_model->getProduct();
		$this->load->view('store/list',$datas);
	}

	public function personal()
	{
		$this->load->view('store/person');
	}

	public function modify()
	{
		$this->load->view('store/modify');
	}

	public function modifyt()
	{
		$this->load->view('store/modifyt');
	}

	public function shop()
	{
		$datas['p'] = $this->uri->segment(9);
		$this->load->view('store/shopping',$datas);
	}

	public function carts()
	{
		$datas['k'] = $this->uri->segment(3);
		$datas['tex'] = $this->input->post('tex');
		$this->load->view('store/carts',$datas);
	}

	public function records()
	{
		$this->load->view('store/records');
	}

	public function orders()
	{
		$this->load->view('store/orders');
	}

	public function delcarts()
	{
		$this->load->view('store/carts');
	}

	public function versy()
	{
		//$userId = $this->uri->segment(4);
		$userId = $this->session->u;
		$productId = $this->uri->segment(3);
		$key = '42dfcb34fb02d8cd';
		$account = $this->input->get('account')?$this->input->get('account'):'abc123';
		$tim = time();
		$sign = md5('webShopBuy'.$userId.$productId.'1'.$tim.$key);
		$dat=array(
			'act'=>'webShopBuy',
			'userId'=>$userId,
			'productId'=>$productId,
			'count'=>'1',
			'time'=>$tim,
			'sign'=>$sign,
		);

		$dat=json_encode($dat);
		$uri = 'http://119.23.161.142:13000/webGetUser';
		$res = json_decode(post_json($uri,$dat));
		$datas['status'] = $res->status;
		$datas['msg'] = $res->msg;
		echo "<script>alert('成功！');</script>";
		return $this->index();
	}

	public function encry($k,$act,$account,$time)
	{
		return md5($act . $account . $time . $k);
	}

}

