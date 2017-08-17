<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MobileIndex extends admin_Auth_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->twig->render('MobileIndex/index');
	}


	public function player_recharge(){
		$this->twig->render('MobileIndex/player_recharge');
	}

	public function recharge_list(){
		$this->twig->render('MobileIndex/recharge_list');
	}

	public function proxy_recharge(){
		$this->twig->render('MobileIndex/proxy_recharge');
	}

	public function proxy_recharge_list(){
		$this->twig->render('MobileIndex/proxy_recharge_list');
	}


	public function proxy_manage_list(){
		$this->twig->render('MobileIndex/proxy_manage_list');
	}

	public function account_manage(){
		$this->twig->render('MobileIndex/account_manage');
	}

	public function add_proxy(){
		$this->twig->render('MobileIndex/add_proxy');
	}

	public function proxy_detail(){
		$proxy_id = $this->input->get('proxy_id');
		
		if(!$proxy_id){
			$this->stdreturn->failed('1','代理商id不能为空');
		}
		$this->twig->render('MobileIndex/add_proxy');
	}

}
