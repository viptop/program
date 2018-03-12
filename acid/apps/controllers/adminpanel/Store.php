

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Store extends Admin_Controller {
	
	var $method_config;
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('store_model','artisan_model'));
		$this->load->helper(array('member','auto_codeIgniter','string'));
		
		$this->method_config['upload'] = array(
										'thumb'=>array('upload_size'=>1024,'upload_file_type'=>'jpg|png|gif','upload_path'=>'uploadfile/store','upload_url'=>SITE_URL.'uploadfile/store/'),
										);
	}
	
	function index($page_no=1)
	{
		$page_no = max(intval($page_no),1);
        
        $where_arr = array();
		$orderby = $keyword= "";
        if (isset($_GET['dosubmit'])) {
			$keyword =isset($_GET['keyword'])?safe_replace(trim($_GET['keyword'])):'';
			if($keyword!="") $where_arr[] = "concat(pnina) like '%{$keyword}%'";
        	
        }
        $where = implode(" and ",$where_arr);
        $data_list = $this->artisan_model->getProduct();

		$this->view('index',array('data_list'=>$data_list,'keyword'=>$keyword,'require_js'=>true));

	}
	
	function check_username($username='')
	{
		if(isset($_POST['username'])&&$username==''){
			$username = trim(safe_replace($_POST['username']));
			$c = $this->store_model->count(array('username'=>$username));
			echo  $c>0?'{"valid":false}':'{"valid":true}';
		}else{
			$username = trim(safe_replace($username));
			$c = $this->store_model->count(array('username'=>$username));
			return $c>0?true:false;
		}
		
	}
	
	 /**
     * 删除选中数据
     * @param post pid 
     * @return void
     */
    function delete()
    {
        if(isset($_POST))
		{
			$pidarr = isset($_POST['pid']) ? $_POST['pid'] : $this->showmessage('无效参数', HTTP_REFERER);
			$where = $this->store_model->to_sqls($pidarr, '', 'id');
			$status = $this->store_model->delete($where);
			if($status)
			{
				$this->showmessage('操作成功', HTTP_REFERER);
			}else 
			{
				$this->showmessage('操作失败');
			}
		}
    }
	
	function lock()
	{
		if(isset($_POST))
		{
			$pidarr = isset($_POST['pid']) ? $_POST['pid'] : $this->showmessage('无效参数', HTTP_REFERER);
			$where = $this->store_model->to_sqls($pidarr, '', 'user_id');
			$status = $this->store_model->update(array('is_lock'=>'^1'),$where);
			if($status)
			{
				$this->showmessage('操作成功', HTTP_REFERER);
			}else 
			{
				$this->showmessage('操作失败');
			}
		}
	}
	
	function edit($id=0)
	{
		$id = intval($id);
        
        $data_info =$this->store_model->get_one(array('id'=>$id));
		
		//如果是AJAX请求
    	if($this->input->is_ajax_request())
		{
			if(!$data_info)exit(json_encode(array('status'=>false,'tips'=>'信息不存在')));

			$username = isset($_POST["username"])?trim(safe_replace($_POST["username"])):exit(json_encode(array('status'=>false,'tips'=>'不能为空')));
			$pimg = isset($_POST["thumb"])?trim(safe_replace($_POST["thumb"])):exit(json_encode(array('status'=>false,'tips'=>'不能为空')));
			$price = isset($_POST["changes"])?trim(safe_replace($_POST["changes"])):exit(json_encode(array('status'=>false,'tips'=>'不能为空')));
			$stock = isset($_POST["reku"])?trim(safe_replace($_POST["reku"])):exit(json_encode(array('status'=>false,'tips'=>'不能为空')));
			
            $status = $this->store_model->update(
												array(
													'pnina'=>$username,
													'pimg'=>$pimg,
													'pice'=>$price,
													'stock'=>$stock,
											),array('id'=>$id));
            if($status)
            {
				exit(json_encode(array('status'=>true,'tips'=>'修改成功')));
            }else
            {
            	exit(json_encode(array('status'=>false,'tips'=>'修改失败')));
            }
        }else
        {
			if(!$data_info)$this->showmessage('信息不存在');

        	$this->view('edit',array('is_edit'=>true,'data_info'=>$data_info,'require_js'=>true));
        }
        //username$this->view('edit',array('is_edit'=>true,'data_info'=>$data_info,'require_js'=>true));
	}
	
	function add()
	{
		//如果是AJAX请求
    	if($this->input->is_ajax_request())
		{
        	//接收POST参数

			$username = isset($_POST["username"])?trim(safe_replace($_POST["username"])):exit(json_encode(array('status'=>false,'tips'=>'不能为空')));
			$pimg = isset($_POST["thumb"])?trim(safe_replace($_POST["thumb"])):exit(json_encode(array('status'=>false,'tips'=>'不能为空')));
			$price = isset($_POST["changes"])?trim(safe_replace($_POST["changes"])):exit(json_encode(array('status'=>false,'tips'=>'不能为空')));
			$stock = isset($_POST["reku"])?trim(safe_replace($_POST["reku"])):exit(json_encode(array('status'=>false,'tips'=>'不能为空')));

            $new_id = $this->store_model->insert(
												array(
													'pnina'=>$username,
													'pimg'=>$pimg,
													'pice'=>$price,
													'stock'=>$stock,

													//'reg_ip'=>$this->input->ip_address(),
											));
            if($new_id)
            {
				exit(json_encode(array('status'=>true,'tips'=>'新增成功','new_id'=>$new_id)));
            }else
            {
            	exit(json_encode(array('status'=>false,'tips'=>'新增失败','new_id'=>0)));
            }
        }else
        {
     		//$data_info = (!$data_info)?[]:$data_info;
        	$this->view('edit',array('is_edit'=>false,'require_js'=>true,'data_info'=>''));
        }
	}
	
	/**
     * 上传附件
     * @param string $fieldName 字段名
     * @param string $controlId HTML控件ID
     * @param string $callbackJSfunction 是否返回函数
     * @return void
     */
	function upload($fieldName='',$controlId='',$callbackJSfunction=false)
	{
		$isImage=true;
    	if( isset($this->method_config['upload'][$fieldName]))
        {
        	if(isset($_POST['dosubmit']))
            {
                $upload_path = $this->method_config['upload'][$fieldName]['upload_path'];
               
               
               if($upload_path=='')die('缺少上传参数');
               
                $config['upload_path'] = $upload_path;
                $config['allowed_types'] = $this->method_config['upload'][$fieldName]['upload_file_type'];
                $config['max_size'] = $this->method_config['upload'][$fieldName]['upload_size'];
                $config['overwrite']  = FALSE;
                $config['encrypt_name']=false;
                $config['file_name']=date('Ymdhis').random_string('nozero',4);
               
                dir_create($upload_path);//创建正式文件夹
                $this->load->library('upload', $config);
                 
                if ( ! $this->upload->do_upload('upload')) $this->showmessage("上传失败:".$this->upload->display_errors());
                $filedata =  $this->upload->data();
                
                $file_name = $filedata['file_name'];
                $file_size = $filedata['file_size'];
                $image_width = $isImage?$filedata['image_width']:0;
                $image_height =  $isImage?$filedata['image_height']:0;
                $uc_first_id=  ucfirst($controlId);
                $this->showmessage("上传成功！",'','','',$callbackJSfunction?"window.parent.get{$uc_first_id}(\"$file_name\",\"$file_size\",\"$image_width\",\"$image_height\");":"$(window.parent.document).find(\"#$controlId\").val(\"$file_name\");$(\"#dialog\" ).dialog(\"close\")");	
            }else
            {
            	$this->view('upload',array('field_name'=>$fieldName,'control_id'=>$controlId,'upload_url'=>$this->method_config['upload'][$fieldName]['upload_url'],'is_image'=>$isImage,'hidden_menu'=>true));
            }
        }else
        {
        	die('缺少上传参数');
        }
	}

	/**
	 * 用户弹窗
	 * @return array
	 */
	function user_window($controlId='',$page_no=0)
	{
		$page_no = max(intval($page_no),1);

		$where_arr = array();
		$orderby = $keyword= "";
		if (isset($_GET['dosubmit'])) {
			$keyword =isset($_GET['keyword'])?safe_replace(trim($_GET['keyword'])):'';
			if($keyword!="") $where_arr[] = "concat(pnina) like '%{$keyword}%'";

		}
		$where = implode(" and ",$where_arr);
		$data_list = $this->store_model->listinfo($where,'*',$orderby , $page_no, $this->store_model->page_size,'',$this->store_model->page_size,page_list_url('adminpanel/store/index',true));

		$this->view('choose',array('hidden_menu'=>true,'data_list'=>$data_list,'control_id'=>$controlId,'pages'=>$this->store_model->pages,'keyword'=>$keyword,'require_js'=>true));
	}
}