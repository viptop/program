<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stors extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();
	}

	function go_43(){echo '123';die;
		$this->view('index',array('require_js'=>true));
	}
}