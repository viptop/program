<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class control extends CI_Controller {

	private $table_idfa='zero_tj_idfa';
	private $table_idfa_record='zero_record_idfa';
	private $table_vir_users='zero_vir_users';
	private $table_users='zero_users';
	private $table_articles='zero_paper_articles';
	private $table_app_banner='zero_app_banner';
	private $table_tutor_info='zero_tutor_infos';
	private $table_user_info='zero_user_infos';
	private $table_users_dz='zero_users_dz';
	private $table_real_dz='zero_real_dz';
	private $table_courses='zero_courses';
	private $table_course_pay='zero_courses_pay';
	//
	private $table_tutor_comment='zero_comments_app';
	private $table_pl_content='zero_pl_content';

	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Shanghai");
    }

	public function index()
	{
		
	}

	public function api_idfa()
	{
		
		if( $idfa=(string)$this->input->get('idfa')){
			$usid = (string)$this->input->get('uid') ? (string)$this->input->get('uid') : '';
			//$idfa=(string)$this->input->get('idfa');
			$data = array('user_id'=>$usid,'idfa'=>$idfa);
			$querys = $this->db->get_where($this->table_idfa, array('idfa' => $idfa))->result_array();
			if(!$querys){
				$this->db->insert($this->table_idfa, $data);
				$resultS = $this->db->get_where($this->table_idfa_record, array('idfa' =>$idfa ))->result_array();
				
				if($resultS){
					$resultCall = $this->db->select(['callback'])->get_where($this->table_idfa_record, array('idfa' =>$idfa ))->result_array();
					$this->db->update($this->table_idfa_record, array('is_invoke'=>true), array('idfa'=> $idfa));
					json_decode($this->https_request(urldecode($resultCall[0]['callback']),true)); 
				}
				echo (json_encode(['code'=>111]));
			}
		// 查询返回数据
		}else if($query=$this->input->get('Query') && $this->input->get('AppId') && $idfas=$this->input->get('IDFA')){
			$AppId=(string)$this->input->get('AppId');
			$cols=['user_id','idfa','updated_at'];
			$datas = array('app_id'=>$AppId,'idfa'=>$idfas);
			$results = $this->db->select($cols)->get_where($this->table_idfa, array('user_id' => $AppId,'idfa' => $idfas))->result_array();
			$resultss = $this->db->select($cols)->get_where($this->table_idfa, array('idfa' => $idfas))->result_array();
			if($resultss){ echo (json_encode(['Code'=>200,'Message'=>'data available'],JSON_UNESCAPED_UNICODE));
				if($this->input->get('callback')){
					$uri=(string)$this->input->get('callback').'?AppId='.$this->input->get('AppId').'&IDFA='.$this->input->get('IDFA');
					$resInfo = (json_decode($this->https_request($uri),true));
					
        		if($resInfo['Success']){ echo "<hr/>".json_encode(['msg'=>'OK'],JSON_UNESCAPED_UNICODE); }
        		$rest_record = $this->db->get_where($this->table_idfa_record, array('idfa' => $idfas))->result_array();
	        		if($rest_record){ 
						$this->db->update($this->table_idfa_record, array('is_invoke'=>true), array('idfa'=> $idfas));
						$URI = 'http://iosapi.liulianglf.com/CPReports/ActCollect?Appid='.$this->input->get('AppId').'&Idfa='.$this->input->get('IDFA');
						$resIn = (json_decode($this->https_request($URI),true));

						echo "<hr/>".(json_encode($resIn,JSON_UNESCAPED_UNICODE)); 
					}
        		// var_dump ($resInfo); 
				}

			}else{
				echo (json_encode(['Code'=>100,'Message'=>'no data exists'],JSON_UNESCAPED_UNICODE));
				// 保存记录
				$reste = $this->db->select(['id'])->get_where($this->table_idfa_record, array('idfa' => $idfas))->result_array();
				if (!$reste) { return $this->db->insert($this->table_idfa_record, $datas); 
				}	
			}

			if((string)$this->input->get('params') ){
				$Code=array(
					'idfa'=>(string)$this->input->get('IDFA'),
					'appid'=>(string)$this->input->get('AppId'),
					'appname'=>(string)$this->input->get('AppName'),
					'bandleid'=>(string)$this->input->get('BandleId'),
					);
				if($results){
					echo (json_encode(['Code'=>$Code,'Message'=>'data available'],JSON_UNESCAPED_UNICODE));
				}else{
					echo (json_encode(['Code'=>$Code,'Message'=>'no data exists'],JSON_UNESCAPED_UNICODE));
				}
				
			}

		}
	}


public function https_request($url)
{       
	$curl = curl_init();       
	curl_setopt($curl, CURLOPT_URL, $url);       
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);       
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);       
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);       
	$data = curl_exec($curl);       
	if (curl_errno($curl)) {return 'ERROR '.curl_error($curl);}       
	curl_close($curl);       
	return $data;
}

	public function appBan(){ 
		$app_ban = $this->db->get_where($this->table_app_banner)->result_array();
		if($app_ban){ 
			echo (json_encode(['data'=>$app_ban,'Message'=>'data available'],JSON_UNESCAPED_UNICODE)); 
		}else{
			echo (json_encode(['Message'=>'no data exists'],JSON_UNESCAPED_UNICODE)); 
		}

	}

	public function keyWords(){ //var_dump( $this->input->get('keys') );die;
		$keys = !empty($this->input->get('keys')) ? 1 : '';
		$appTag = [
		1, //关系推进
		2, //婚姻维系
		3, //摆脱单身
		4, //失恋挽回
		];

		if ($keys) {
			$appTag_1 = $this->db->get_where($this->table_articles, array('app_tag' =>$appTag[0] ))->result_array();
			$appTag_2 = $this->db->get_where($this->table_articles, array('app_tag' =>$appTag[1] ))->result_array();
			$appTag_3 = $this->db->get_where($this->table_articles, array('app_tag' =>$appTag[2] ))->result_array();
			$appTag_4 = $this->db->get_where($this->table_articles, array('app_tag' =>$appTag[3] ))->result_array();
			$Code =array('boost'=>$appTag_1,'keep'=>$appTag_2,'away'=>$appTag_3,'redeem'=>$appTag_4);
			echo (json_encode(['data'=>$Code,'Message'=>'data available'],JSON_UNESCAPED_UNICODE));
		} else { echo (json_encode(['Message'=>'no data exists'],JSON_UNESCAPED_UNICODE)); }

	}



	public function queryIdfa(){
		if ( $IDFA=$this->input->get('IDFA') ){// die('1111111');
			$resulte = $this->db->get_where($this->table_idfa, array('idfa' =>$IDFA ))->result_array();
			
			if(!empty($resulte)){
				//json_decode($this->https_request(urldecode($this->input->get('callback')),true));
				echo (json_encode([(string)$IDFA=>1,'Message'=>'data available'],JSON_UNESCAPED_UNICODE));
			}else{
				echo (json_encode([(string)$IDFA=>0,'Message'=>'no data exists'],JSON_UNESCAPED_UNICODE));
			}
		}
	}


	public function clickIdfa(){
		if( $Idfa=$this->input->get('IDFA') ){
			$resultS = $this->db->select(['id'])->get_where($this->table_idfa, array('idfa' =>$Idfa ))->result_array();
			if( $this->input->get('callback') ){
				$data= ['idfa'=>$Idfa,'app_id'=>$this->input->get('APPID'),'callback'=>$this->input->get('callback')];
				$this->db->insert($this->table_idfa_record, $data);
				echo (json_encode(['code'=>0,'Message'=>'success'],JSON_UNESCAPED_UNICODE));
			}else{
				echo (json_encode(['code'=>1,'Message'=>'error'],JSON_UNESCAPED_UNICODE));
			}
		}
	}

	
	public function tutorIf(){
		if( $tutorId=$this->input->get('tutorId') ){
			$cols = array('id','user_id','user_pl','dz_sum','pl_hot');
			$usId = !empty((int)$this->input->get('usId'))? (int)$this->input->get('usId') : 0;
			$tutorRes = $this->db->select(['user_id','id'])->order_by('id','desc')->get_where($this->table_tutor_info, array('tutor_id' =>$tutorId ))->result_array();

			$user=[];$tutor=[];$isDz=[];
			foreach ($tutorRes as $key=>$value) {
				$user[$key]=$this->db->select(['user_nickname','user_headimg'])->get_where($this->table_user_info, array('user_id' =>$value['user_id'] ))->result_array();
				if(!$user[$key] && $usId!=0){
					$user[$key]=$this->db->select(['nickname','headimgurl'])->get_where($this->table_users, array('id' =>$usId ))->result_array();
				}
				$tutor[$key]=$this->db->select($cols)->get_where($this->table_tutor_info, array('id' =>$value['id'] ))->result_array();
				$isDz[$key]=$this->db->select(['is_dz'])->get_where($this->table_real_dz, array('pl_id' =>$value['id'],'user_real' =>$usId ))->result_array();
				echo '<pre>';var_dump($isDz[$key]);die;
				if ($isDz[$key]){ $tutorRe[$key] = $user[$key][0] + $tutor[$key][0] + $isDz[$key][0]; }else{
					$tutorRe[$key] = $user[$key][0] + $tutor[$key][0];
				}
				
			}

			//echo '<pre>';var_dump($tutorRe);die;
			//echo '<pre>';var_dump(json_encode(['code'=>$tutorRes],JSON_UNESCAPED_UNICODE));die;

			echo (json_encode(['code'=>$tutorRe,'tutors'=>$tutorId],JSON_UNESCAPED_UNICODE));
		}
	}


	public function userPl(){
		if($this->input->get('tutorId') && $this->input->get('userId') && $this->input->get('userPl')){
			$data= array(
				'tutor_id'=>$this->input->get('tutorId'),
				'user_id'=>$this->input->get('userId'),
				'user_pl'=>$this->input->get('userPl'),// Pl content
			);
			$this->db->insert($this->table_tutor_info, $data);
		}else if($this->input->get('plId')){
			$usersId = (int)$this->input->get('userId');
			$plId = (int)$this->input->get('plId');
			$isDz = (string)$this->input->get('userDz');//Dz boolean
			$pl_res = $this->db->select(['dz_sum'])->get_where($this->table_tutor_info, array('id' =>$plId ))->result_array();
			switch ($isDz) {
				case '1':
					$userRest = $this->db->get_where($this->table_real_dz, array('user_real'=>$usersId ))->result_array();
					if($userRest){
						$this->db->update($this->table_real_dz, array('is_dz'=>true), array('pl_id' => $plId,'user_real'=>$usersId));
					}else{
						$dat = array(
							'user_real'=>(int)$this->input->get('userId'),
							'is_dz'=>true,
							'pl_id'=>(int)$this->input->get('plId'),
						);
						$this->db->insert($this->table_real_dz, $dat);
					}
					
					$this->db->update($this->table_tutor_info, array('dz_sum'=>($pl_res[0]['dz_sum']+1) ), array('id' => $plId));break;	
				case '0':
					$userReste = $this->db->get_where($this->table_real_dz, array('user_real'=>$usersId ))->result_array();
					if($userReste){
						$this->db->update($this->table_real_dz, array('is_dz'=>false), array('pl_id' => $plId,'user_real'=>$usersId));
					}else{
						$dat = array(
							'user_real'=>(int)$this->input->get('userId'),
							'is_dz'=>false,
							'pl_id'=>(int)$this->input->get('plId'),
						);
						$this->db->insert($this->table_real_dz, $dat);
					}

					$this->db->update($this->table_tutor_info, array('dz_sum'=>($pl_res[0]['dz_sum']-1) ), array('id' => $plId));break;
			}
			
		}
		
	}


	public function addPl(){
		$data = array(
		'tutor_id'=>$this->input->get('tutorId'),
		'user_pl'=>$this->input->get('conPl'),
		);
		$this->db->insert($this->table_tutor_info, $data);
	}


	public function addUser(){
		$data = array(
		'user_headimg'=>$this->input->get('headimg'),
		'user_nickname'=>$this->input->get('nickname'),
		);
		$this->db->insert($this->table_user_info, $data);
	}


	public function courseModify(){
		if( $this->input->post('modify') && $this->input->post('userId') && $this->input->post('courseId') && $this->input->post('pay')){
			$courseId = (int)$this->input->post('courseId');
			$userId = (int)$this->input->post('userId');
			$pay = (int)$this->input->post('pay');
			$modif = (int)$this->input->post('modify');
			$courseRete = $this->db->get_where($this->table_course_pay,array('course_id'=>$courseId,'user_id'=>$userId,'is_cost'=>false) )->result_array();
			$resCon = $this->db->get_where($this->table_course_pay,array('user_id'=>$userId))->result_array();

			switch ($modif) { // 支付
				case '1':
				if($courseRete){
					$this->db->update($this->table_course_pay, array('is_cost'=>true), array('course_id' =>$courseId,'user_id'=>$userId));
				}else{
					//$this->db->insert($this->table_course_pay, array('user_id'=>$userId,'course_id'=>$courseId,'pay'=>$pay));
					$this->db->update($this->table_course_pay, array('is_cost'=>true), array('course_id' =>$courseId,'user_id'=>$userId));
				}			
			echo (json_encode(['data'=>$courseId,'message'=>'OK'],JSON_UNESCAPED_UNICODE)); 
					break;				
				default:
					# code...
					break;
			}

		}
	}


	public function coursePay(){
		if($this->input->post('userId') && $this->input->post('isCost')){
			$userId=(int)$this->input->post('userId');
			$isCost=(int)$this->input->post('isCost');

			if($isCost==1){// 未支付
			//$courseRes = $this->db->select(['course_name'])->from($this->table_course_pay)->join($this->table_courses,$this->table_course_pay.'.course_id ='.$this->table_courses.'.id','left')->where(['user_id'=>$userId])->get()->result();var_dump($courseRes);die;
			$courseRes=$this->db->get_where($this->table_course_pay, array('user_id'=>$userId ))->result_array();	
				if(!$courseRes){

					//$resNo=$this->db->select(['course_id','course_href','pay','course_name','is_cost'])->from($this->table_course_pay)->join($this->table_courses,$this->table_course_pay.'.course_id ='.$this->table_courses.'.id','left')->where(['user_id'=>$userId,'is_cost'=>false])->order_by('updated_at','desc')->get()->result_array();
					$courseNs = $this->db->get_where($this->table_courses)->result_array();
					foreach ($courseNs as $value) {
						$courseId=$value['id'];$this->db->insert($this->table_course_pay, array('user_id'=>$userId,'course_id'=>$courseId,));

					}
					$resNo=$this->db->get_where($this->table_courses)->result_array();
					echo (json_encode(['data'=>$resNo,'message'=>'OK'],JSON_UNESCAPED_UNICODE)); 
				}else if($courseRes){
				$resNo=$this->db->select(['course_id','course_href','pay','course_name','is_cost'])->from($this->table_course_pay)->join($this->table_courses,$this->table_course_pay.'.course_id ='.$this->table_courses.'.id','left')->where(['user_id'=>$userId,'is_cost'=>false])->order_by('updated_at','desc')->get()->result_array();
				echo (json_encode(['data'=>$resNo,'message'=>'OK!'],JSON_UNESCAPED_UNICODE));
					
				}
 			//unset();
			}else if($isCost==2){// 已支付
				$resYes = $this->db->select(['course_id','course_href','pay','course_name','is_cost'])->from($this->table_course_pay)->join($this->table_courses,$this->table_course_pay.'.course_id ='.$this->table_courses.'.id','left')->where(['user_id'=>$userId,'is_cost'=>true])->order_by('updated_at','desc')->get()->result_array();
				echo (json_encode(['data'=>$resYes,'message'=>'OK'],JSON_UNESCAPED_UNICODE));
			}
		}		

	}


	public function courseInfor(){
		if($this->input->post('tutorId') && $this->input->post('courseId') ){
			$tutorId = (int)$this->input->post('tutorId');
			$courseId = (int)$this->input->post('courseId');
			$resIn1 = $this->db->select(['long_intro'])->get_where($this->table_users ,array('id'=>$tutorId))->result_array()[0]['long_intro'];
			//echo '<pre>';var_dump($resIn);die;
			$resIn2 = $this->db->select(['course_name','course_intro','course_img','pay'])->get_where($this->table_courses, array('id'=>$courseId))->result_array();
			//echo '<pre>';var_dump($resIn2);die;
			$resIn=[$resIn1,$resIn2];
			echo (json_encode(['data'=>$resIn,'message'=>'OK'],JSON_UNESCAPED_UNICODE));
		}
		
	}


	public function virDate($sign){
		
		$s=isset($sign) ? $sign : '';
		$format = 'DATE_W3C';
		if($s){
/*
for($i=0;$i<=45000;$i++){
			//var_dump( $this->vscount('t') );die;
			//var_dump( $this->vscount('m') );die;
			$Insertime=standard_date($format,$this->vscount('t'));
			$nick = 'zw-'.uniqid();
			$check_mobile = $this->vscount('m');
			//echo $nick;die;
			$ary = array(
				'nickname'=>$nick,
				'headimgurl'=>'http://zhiwoo.com.cn/zero/images/user.png',
				'sex'=>'0',
				'mobile'=>$check_mobile,
				'password_digest'=>'$10$p'.uniqid(),
				'created_at'=>$Insertime,
				);
			$check_mobile = $this->db->get_where($this->table_vir_users, array('mobile' =>$check_mobile))->result_array();
			$check_time = $this->db->get_where($this->table_vir_users, array('created_at' =>$Insertime))->result_array();
			if(!$check_mobile && !$check_time){ $this->db->insert($this->table_vir_users,$ary); }
}
*/
for ($i=143253;$i<=180615;$i++){
	
	$ary = array(
		'sex'=> (string)rand(0,2) ,
	);

	//var_dump ( $this->vscount('t'));die;
	$this->db->update('zero_vir_users', $ary, array('id' => $i));
	//$this->db->delete('zero_vir_users', array('id' => $i));
	

/*	$ary = array(
		'nickname'=>'zw-'.uniqid(),
		'headimgurl'=>'http://zhiwoo.com.cn/zero/images/user.png',
		'sex'=>'0',
		'mobile'=>$this->vscount('m'),
		'password_digest'=>'',
		'created_at'=>(int)$this->vscount('t'),
	);
	$check_mobile = $this->db->get_where($this->table_vir_users, array('mobile' =>$this->vscount('m')))->result_array();
	$check_time = $this->db->get_where($this->table_vir_users, array('created_at' =>$this->vscount('t')))->result_array();
	if(!$check_mobile && !$check_time){ $this->db->insert($this->table_vir_users,$ary); }
*/
}			
		}else{
			
			var_dump ($this->db->select('*')->get_where('zero_vir_users', array('id' => 8))->result_array());die;
			//echo human_to_unix('2016-11-29 11:50 PM');die;
			var_dump ($this->db->select('*')->get_where('zero_users', array('id' => 9))->result_array());die;
		}


	}



	public function tutorCom(){
		if($this->input->post('tutorId') && $this->input->post('userId') && $this->input->post('plContent')){
		$tutorId = (int)$this->input->post('tutorId');
		$userId = (int)$this->input->post('userId');
		$plContent = (string)$this->input->post('plContent');
		$datas = array(
			'tutor_id'=>$tutorId,
			'user_id'=>$userId,
			'user_pl'=>$plContent,
		);
		$resCom = $this->db->get_where($this->table_tutor_info,array('tutor_id'=>$tutorId,'user_id'=>$userId))->result_array();

		if(!$resCom){
			$this->db->insert($this->table_tutor_info,$datas);
		}
		$avs = $this->db->get_where($this->table_tutor_info,array('tutor_id'=>$tutorId,'user_id'=>$userId))->result_array();
		echo (json_encode(['message'=>'OK'],JSON_UNESCAPED_UNICODE));
		//echo (json_encode(['data'=>$plId,'message'=>'OK'],JSON_UNESCAPED_UNICODE));
		}
	}

	public function vscount($s){
		$a[0]=[3,5,8];
		$a[1]=[0,1,2,3,4,5,6,7,8,9];
			shuffle($a[0]);
			$a[0] = substr(implode($a[0]), rand(0,2), 1);
			shuffle($a[1]);
			$a[2] = substr(implode($a[1]),1,3);
			shuffle($a[1]);
			$a[3] = substr(implode($a[1]),1,2);
			shuffle($a[1]);
			$a[4] = substr(implode($a[1]),1,2);
			shuffle($a[1]);
			$a[5] = substr(implode($a[1]),1,2);
		if($s=='m'){
			$str = '1'.$a[0].''.$a[2].''.$a[3].''.$a[4].''.$a[5]; $str = (string)$str;return $str;
		}else if($s=='t'){
			$sertime = rand(1463560680,1480434633); return $sertime;
		}
		
	}


}
