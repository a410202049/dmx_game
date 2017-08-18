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
		$proxy_data = '';
		if($this->userInfo['type'] == '0'){
			$proxy_data = $this->db->get_where('dealer',array('id'=>$proxy_id))->row_array();
		}else{
			$proxy_data = $this->db->get_where('dealer',array('id'=>$proxy_id,'pid'=>$this->userInfo['id']))->row_array();
		}
		if(!$proxy_data){
			$this->stdreturn->failed('1','代理商不存在');
		}
		$leves = array('一','二','三','四','五','六','七','八','九','十'); 
		$proxy_data['leve'] = $leves[$proxy_data['leve']-1];

		$proxy_total_diamond_sql = "select sum(diamond) as total_diamond from t_proxy where dealer_id = '".$proxy_data['id']."'";
		$proxy_total_diamond = $this->db->query($proxy_total_diamond_sql)->row_array();
		
		$account_total_diamond_sql = "select sum(diamond) as total_diamond from t_trade where dealer_id = '".$proxy_data['id']."'";
		$account_total_diamond = $this->db->query($account_total_diamond_sql)->row_array();

		$total_diamond = $proxy_total_diamond['total_diamond'] + $account_total_diamond['total_diamond'];

		$proxy_data['total_diamond'] = $total_diamond;
		$this->twig->assign('proxy_data',$proxy_data);
		$this->twig->render('MobileIndex/proxy_detail');
	}

}
