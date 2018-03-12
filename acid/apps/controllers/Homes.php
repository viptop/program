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
		$res = $this->userinfo($this->input->get('account'));
		$datas['a'] = $res->data->account;
		$datas['n'] = $res->data->nickname;
		$datas['u'] = $res->data->userId;
		$os = array('uid'=>$datas['u']);
		$datas['himg'] = $this->artisan_model->getUser($os)->headimg;
		$datas['ticket'] = $res->data->ticket;
		$datas['phone'] = $res->data->phoneNo;
		if(!$res->data->phoneNo){
		}//exit;
		//
		$this->session->set_userdata($datas);
		$datas['list'] = $this->artisan_model->getProduct();
		$this->load->view('store/list',$datas);
	}

	public function showin($f)
	{
		return "<script>alert($f);</script>";
	}

	public function dirvry()
	{
		$datas['list'] = $this->artisan_model->getProduct();
		$this->load->view('store/list',$datas);
	}

	public function userinfo($a)
	{
		$key = '42dfcb34fb02d8cd';
		$account = $a?$a:'abc123';
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
		return $res;
	}

	public function vexy($a)
	{
		$key = '42dfcb34fb02d8cd';
		$account = $a?$a:'abc123';
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
		$os = array('uid'=>$datas['u']);
		$datas['himg'] = $this->artisan_model->getUser($os)->headimg;
		$datas['ticket'] = $res->data->ticket;
		//
		$this->session->set_userdata($datas);
		$datas['list'] = $this->artisan_model->getProduct();

	}

	public function personal()
	{
		$name='stor_users';
		$u=$this->session->u;
		$datas['ticket']=$this->session->ticket;
		$datas['one'] = $this->artisan_model->getList($name,'uid',$u);
		//$datas['order'] = $this->artisan_model->getList($order,'uid',$u);
		$this->load->view('store/person',$datas);
	}

	public function modify()
	{
		$datas=$this->input->post();
		$datas['p']=$this->uri->segment(4);
		$name='stor_adds';
		$u=$this->session->u;
		$ary=['uid'=>$u,'del <>'=>'1'];
		$datas['pdtor']=$this->artisan_model->getModfiy($ary);
		if(!$datas['pdtor']){
			return $this->modifyt();
		}
		return $this->load->view('store/padds',$datas);
	}

	public function modifyt()
	{
		$datas=$this->input->post();
		$name='stor_adds';
		$p=$this->uri->segment(4);
		$ary=['id'=>$p,'del <>'=>1];
		$datas['pdtor']=$this->artisan_model->getModfiy($ary);
		if(!$datas['pdtor']){
			$datas['s']='add';
		}else{
			$datas['s']='edit';
			$datas['pdtor']=$datas['pdtor'][0];
		}
		$this->load->view('store/modifyt',$datas);
	}

	public function shop()
	{
		$name='stor_product';
		$datas['p'] = $this->uri->segment(4);
		$datas['one'] = $this->artisan_model->getList($name,'id',$datas['p']);
		$this->load->view('store/pdetail',$datas);
	}

	public function addList()
	{
		$datas=$this->input->post();
		$datas['p']=$this->uri->segment(4);
		$name='stor_adds';
		$u=$this->session->u;
		$ary=['uid'=>$u,'del <>'=>1];
		$datas['pdtor']=$this->artisan_model->getModfiy($ary);

		$this->load->view('store/pcart',$datas);

	}

	public function records()
	{
		$name='stor_order';
		$u = $this->session->u;
		$datas['one'] = $this->artisan_model->getList($name,'uid',$u);
		return $this->orders();
	}

	public function orders()
	{
		$datas['num'] = $this->input->post('buy_num');
		$name='stor_order';
		$u = $this->session->u;
		$order = array('uid'=>$u);
		$datas['list'] = $this->artisan_model->getOrders($order);

		$this->load->view('store/olist',$datas);
	}

	public function delcarts()
	{
		$ids = $this->input->post('item_ids');
		$this->artisan_model->delAdds('stor_adds',array('del'=>1),$ids);
		
	}

	public function cartok()
	{
		$datas = $this->input->post();
		$t = $this->session->ticket;
		$sum=$datas['stid']*$datas['bnum'];
		if($sum > $this->session->ticket){
			echo json_encode(array('msg'=>$t,'errorCode'=>1));return;
		}
		$res = $this->versy($datas['asid'],$datas['bnum']);
		$datas['tick']=$t - $sum;
		$this->session->set_userdata($datas);
		echo json_encode(array('msg'=>$datas['tick'],'errorCode'=>0));
	}

	public function versy($p,$c)
	{
		$userId = $this->session->u;
		$productId = $this->uri->segment(5)?$this->uri->segment(5):$p;
		$key = '42dfcb34fb02d8cd';
		$account = $this->session->u;

		$tim = time();
		$sign = md5('webShopBuy'.$userId.$productId.$c.$tim.$key);
		$dat=array(
			'act'=>'webShopBuy',
			'userId'=>$userId,
			'productId'=>$productId,
			'count'=>$c,
			'time'=>$tim,
			'sign'=>$sign,
		);

		$dat=json_encode($dat);

		$uri = 'http://119.23.161.142:13000/webGetUser';
		$res = json_decode(post_json($uri,$dat));
		$datas['status'] = $res->status;
		$datas['msg'] = $res->msg;
		$t=$this->session->ticket;
		return $t;
	}

	public function encry($k,$act,$account,$time)
	{
		return md5($act . $account . $time . $k);
	}

	public function plist()
	{
		//echo date( "Y-m-d", strtotime( "2017-04-30 +2 day" ));
		$name='stor_product';
		$datas['list']=$this->artisan_model->getProduct();
		$this->load->view('store/plists',$datas);
	}

	public function pdetail()
	{
		$name='stor_product';
		$datas['list']=$this->artisan_model->getProduct();
		$this->load->view('store/pdetail',$datas);
	}

	public function modifys()
	{
		$datas=array(
			'u'=>$this->session->u,'a'=>$this->session->a,'n'=>$this->session->n,'himg'=>$this->session->headimg,'ticket'=>$this->session->ticket,
		);
		$ary=['uid'=>$datas['u']];
		$datas['list'] = $this->artisan_model->getModfiy($ary);
		$datas['p']=$this->uri->segment(4);

		$u=$this->session->u;
		$ary = array('uid'=>$u);
		$datas['adds']=$this->artisan_model->getModfiy($ary);
		if(!$datas['adds']){
			echo "<script>alert('请编辑地址！');</script>";
			return $this->modifyt();
		}
		$this->load->view('store/padds',$datas);
	}

	public function sales(){
		
		$u=$this->session->u;
		$id = $this->input->post('ites');
		$tid = $this->input->post('textdid');
		$ids = $this->input->post('ituid');
		$sign = $this->input->post('itsign');
		$name='stor_adds';
		$set=['uid'=>$u,'adds'=>$tid];
		$d=array('adds'=>$tid);
		if(!$sign){
			$this->artisan_model->insertData($name,$set);
		}else{
			$this->artisan_model->updateDate($name,$d,$id);
		}
		//$this->versy();
		echo $this->showin('修改成功！');
		//return redirect('/homes/dirvry');
	}

	public function fare()
	{
		$phoneno=$this->input->get('phone');
		$cardnum=$this->input->get('cards');
		$orderid=$this->input->get('oid').date('YmdHis',time());
		$key='9ff0448eaf00ae9cb4ab7633beb9835e';
		$openID='JHd25826a14024e056936cc1a4035bd9fc';
		$uri='http://op.juhe.cn/ofpay/mobile/onlineorder';
		$sign=md5($openID.$key.$phoneno.$cardnum.$orderid);
		$dat=array(
			'phoneno'=>$phoneno,
			'cardnum'=>$cardnum,
			'key'=>$key,
			'orderid'=>$orderid,
			'sign'=>$sign,
		);

		$res=json_decode(http_post($uri,$dat));
		return $res->result->game_userid;
	}

}
