<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Index extends admin_Auth_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->twig->render('Index/index');
	}

	public function account_manage(){
		$this->twig->render('Index/account_manage');
	}

	public function recharge(){
		$accid = $this->input->post('accid');
		$confirm_accid = $this->input->post('confirm_accid');
		$diamond = $this->input->post('diamond');
		if(empty($accid)){
			$this->stdreturn->failed('1','玩家id不能为空');
		}else if(empty($confirm_accid)){
			$this->stdreturn->failed('1','确认玩家id不能为空');
		}else if($accid !=$confirm_accid){
			$this->stdreturn->failed('1','确认玩家ID不一致');
		}else if(empty($diamond)){
			$this->stdreturn->failed('1','钻石数量不能为空');
		}else if(!is_numeric($diamond) || $diamond <=0){
			$this->stdreturn->failed('1','钻石数量必须为正整数');
		}
		
	}


}
