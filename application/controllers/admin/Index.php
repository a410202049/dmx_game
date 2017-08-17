<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Index extends admin_Auth_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		// $this->twig->assign('page_num',12);
		// if($this->userInfo['type'] != 0){
		// 	redirect(base_url('/player-manage'));
		// }
		$this->twig->render('Index/index');
	}

	public function player_manage(){
		// $this->twig->assign('page_num',12);
		$this->twig->render('Index/player_manage');
	}

	public function account_manage(){
		$total_diamond = 0;
		if($this->userInfo['type'] == '0'){
			$proxy_total_diamond_sql = "select sum(diamond) as total_diamond from t_proxy where dealer_id = '".$this->userInfo['id']."'";
			$proxy_total_diamond = $this->db->query($proxy_total_diamond_sql)->row_array();
			
			$account_total_diamond_sql = "select sum(diamond) as total_diamond from t_trade where dealer_id = '".$this->userInfo['id']."'";
			$account_total_diamond = $this->db->query($account_total_diamond_sql)->row_array();

			$total_diamond = $proxy_total_diamond['total_diamond'] + $account_total_diamond['total_diamond'];

		}else{
			$account_total_diamond_sql = "select sum(diamond) as total_diamond from t_trade where dealer_id = '".$this->userInfo['id']."'";
			$account_total_diamond = $this->db->query($account_total_diamond_sql)->row_array();
			$total_diamond = $account_total_diamond['total_diamond'];
		}
		$total_diamond = $total_diamond ? $total_diamond : 0;
		$this->twig->assign('total_diamond',$total_diamond);
		$this->twig->render('Index/account_manage');
	}

	public function recharge(){
		$accid = $this->input->post('accid');
		$confirm_accid = $this->input->post('confirm_accid');
		$diamond = $this->input->post('diamond');
		$max_diamond = $this->config->item('max_diamond');

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

		if($this->userInfo['type'] != 0){
			if($diamond > $max_diamond){
				$this->stdreturn->failed('1','钻石数量不能大于'.$max_diamond.'颗');
			}
		}
		$account = $this->db->get_where('account',array('accid'=>$accid))->row_array();

		if(!$account){
			$this->stdreturn->failed('1','玩家不存在');
		}
		if($this->userInfo['type'] == 0){
			//系统管理员
			$this->Account->diamond_recharge($accid,$diamond);

			//插入充值记录
			$data = array(
				"accid"=>$accid,
				"diamond"=>$diamond,
				"dealer_id"=>$this->userInfo['id']
			);
			$this->Data->add($data,'trade');
			$this->stdreturn->ok();

		}else{
			if($this->userInfo['diamond'] < $diamond){
				$this->stdreturn->failed('1','钻石余额不足，请联系管理员充值');
			}

			try {
				$this->Account->diamond_debit($this->userInfo['id'],$diamond);
				$this->Account->diamond_recharge($accid,$diamond);
				//插入充值记录
				$data = array(
					"accid"=>$accid,
					"diamond"=>$diamond,
					"dealer_id"=>$this->userInfo['id']
				);
				$this->Data->add($data,'trade');
				$this->stdreturn->ok();
				
			} catch (Exception $e) {
				$this->stdreturn->failed('1','充值失败');
			}

		}
	}


	public function recharge_list(){
		$starttime = $this->input->post('starttime');
		$endtime = $this->input->post('endtime');
		$where = "";
		if($this->userInfo['type'] == 0){
			$where.= '1=1';
		}else{
			$where.= 'dealer_id = "'.$this->userInfo['id'].'"';
		}

		if($starttime && $endtime ){
			$where.= " and create_time BETWEEN '".$starttime." 00:00:00' AND '".$endtime." 23:59:59'" ; 
		}

		$where.=" order by create_time desc";

		$sql = "select * from t_trade where ".$where;
		$total_diamond_sql = "select sum(diamond) as total_diamond from t_trade where ".$where;
		$total_diamond = $this->db->query($total_diamond_sql)->row_array();
        $page['perpage'] = $this->input->post('pagesize') ? $this->input->post('pagesize') : 10;
        $page['query'] = $sql;
        $page['seg'] = '2';
        $page['url'] = 'recharge-list';
        $record = $this->page($page);
        $arr['list'] = $record;
        $arr['total'] = $this->pager->total;
        $arr['total_diamond'] = $total_diamond['total_diamond'];
		$this->stdreturn->ok($arr);
	}


	public function proxy_recharge(){

		$proxy_id = $this->input->post('proxy_id');
		$confirm_proxy_id = $this->input->post('confirm_proxy_id');
		$diamond = $this->input->post('diamond');
		$max_diamond = $this->config->item('max_diamond');

		if(empty($proxy_id)){
			$this->stdreturn->failed('1','代理商id不能为空');
		}else if(empty($confirm_proxy_id)){
			$this->stdreturn->failed('1','确认代理商id不能为空');
		}else if($proxy_id !=$confirm_proxy_id){
			$this->stdreturn->failed('1','确认代理商ID不一致');
		}else if(empty($diamond)){
			$this->stdreturn->failed('1','钻石数量不能为空');
		}else if(!is_numeric($diamond) || $diamond <=0){
			$this->stdreturn->failed('1','钻石数量必须为正整数');
		}

		$proxy = $this->db->get_where('dealer',array('id'=>$proxy_id,'type'=>1))->row_array();

		if(!$proxy){
			$this->stdreturn->failed('1','代理商不存在');
		}

		if($this->userInfo['type'] != 0){
			if($diamond > $max_diamond){
				$this->stdreturn->failed('1','钻石数量不能大于'.$max_diamond.'颗');
			}
			if($this->userInfo['diamond'] < $diamond){
				$this->stdreturn->failed('1','钻石余额不足，请联系管理员充值');
			}

			$you_proxy = $this->db->get_where('dealer',array('id'=>$proxy_id,'type'=>1,'pid'=>$this->userInfo['id']))->row_array();
			if(!$you_proxy){
				$this->stdreturn->failed('1','您的账户下没有该代理商！');
			}

			try {
				$this->Account->diamond_debit($this->userInfo['id'],$diamond);
				$this->Account->proxy_recharge($proxy_id,$diamond);
	
				$data = array(
					"proxy_id"=>$proxy_id,
					"diamond"=>$diamond,
					"dealer_id"=>$this->userInfo['id']
				);
				$this->Data->add($data,'proxy');
				
			} catch (Exception $e) {
				$this->stdreturn->failed('1','充值失败');
			}

		}else{
			$this->Account->proxy_recharge($proxy_id,$diamond);
			//插入充值记录
			$data = array(
				"proxy_id"=>$proxy_id,
				"diamond"=>$diamond,
				"dealer_id"=>$this->userInfo['id']
			);
			$this->Data->add($data,'proxy');

		}


		$this->stdreturn->ok();

	}


	public function proxy_recharge_list(){
		$starttime = $this->input->post('starttime');
		$endtime = $this->input->post('endtime');
		$where = "";
		if($this->userInfo['type'] == 0){
			$where.= '1=1';
		}else{
			$where.= 'dealer_id="'.$this->userInfo['id'].'"';
		}

		if($starttime && $endtime ){
			$where.= " and create_time BETWEEN '".$starttime." 00:00:00' AND '".$endtime." 23:59:59'" ; 
		}

		$where.=" order by create_time desc";
		$sql = "select * from t_proxy where ".$where;
		$total_diamond_sql = "select sum(diamond) as total_diamond from t_proxy where ".$where;
		$total_diamond = $this->db->query($total_diamond_sql)->row_array();

        $page['perpage'] = $this->input->post('pagesize') ? $this->input->post('pagesize') : 10;
        $page['query'] = $sql;
        $page['seg'] = '2';
        $page['url'] = 'recharge-list';
        $record = $this->page($page);
        $arr['list'] = $record;
        $arr['total'] = $this->pager->total;
        $arr['total_diamond'] = $total_diamond['total_diamond'];
		$this->stdreturn->ok($arr);
	}


	public function modify_passwd(){

		$oldpasswd = $this->input->post('oldpasswd');
		$newpasswd = $this->input->post('newpasswd');
		$confpasswd = $this->input->post('confpasswd');

		if(empty($oldpasswd)){
			$this->stdreturn->failed('1','原密码不能为空');
		}else if(empty($newpasswd)){
			$this->stdreturn->failed('1','新密码不能为空');
		}else if($newpasswd !=$confpasswd){
			$this->stdreturn->failed('1','确认密码不一致');
		}

		$dealer = $this->db->get_where('dealer',array('id'=>$this->userInfo['id']))->row_array();
		if($dealer['passwd'] != do_hash($oldpasswd)){
			$this->stdreturn->failed('1','原密码不正确');
		}
		$this->Data->edit(array('id'=>$this->userInfo['id']),array('passwd'=>do_hash($newpasswd)),'dealer');
		$this->stdreturn->ok();


	}


	public function add_proxy_page(){
		$this->twig->render('Index/add_proxy_page');
	}

	public function add_proxy(){
		$proxyid = $this->input->post('proxyid');
		$confirm_proxyid = $this->input->post('confirm_proxyid');
		$passwd = '123456';

		$proxy_data = $this->db->get_where('dealer',array('id'=>$proxyid))->row_array();
		if(!$proxyid){
			$this->stdreturn->failed('1','账号不能为空');
		}
		if($confirm_proxyid !=$proxyid){
			$this->stdreturn->failed('1','确认ID不一致');
		}	
		if($proxy_data){
			$this->stdreturn->failed('1','该账号已存在');
		}

		if(($this->userInfo['leve'] + 1) > 10){
			$this->stdreturn->failed('1','代理商层级不能超过10');
		}
		$data = array(
			"id"=>$proxyid,
			"passwd"=>do_hash($passwd),
			"type"=>1,
			"pid"=>$this->uid,
			"leve"=>$this->userInfo['leve'] + 1
		);

		$this->Data->add($data,'dealer');
		$this->stdreturn->ok();

	}

	public function proxy_list(){
		$starttime = $this->input->post('starttime');
		$endtime = $this->input->post('endtime');
		$where = "";
		if($this->userInfo['type'] == 0){
			$where.= 'd.type != 0';
		}else{
			$where.= 'd.pid = \''.$this->uid.'\'';
		}

		// SELECT d.*, case when sum(p.diamond) is null then 0 else sum(p.diamond) end as total_diamond  from t_dealer as d LEFT JOIN t_proxy as p on d.id = p.proxy_id where d.pid = 'admin' GROUP BY p.proxy_id

		if($starttime && $endtime ){
			$where.= " and d.create_time BETWEEN '".$starttime." 00:00:00' AND '".$endtime." 23:59:59'" ; 
		}
		$where.=" GROUP BY d.id";
		$where.=" order by create_time desc";
		$sql = "SELECT d.id,d.status,d.create_time, case when sum(p.diamond) is null then 0 else sum(p.diamond) end as total_diamond  from t_dealer as d LEFT JOIN t_proxy as p on d.id = p.proxy_id where ".$where;


		// echo $sql;exit;
        $page['perpage'] = $this->input->post('pagesize') ? $this->input->post('pagesize') : 10;
        $page['query'] = $sql;
        $page['seg'] = '2';
        $page['url'] = 'recharge-list';
        $record = $this->page($page);
        $arr['list'] = $record;
        $arr['total'] = $this->pager->total;
        // $arr['total_diamond'] = $total_diamond['total_diamond'];
		$this->stdreturn->ok($arr);
	}



	public function proxy_manage(){
		$this->twig->render('Index/proxy_manage');
	}

	public function proxy_status(){
		$proxyid = $this->input->post('proxyid');
		$proxy_data = "";
		if($this->userInfo['type'] != 0){
			$proxy_data = $this->db->get_where('dealer',array('id'=>$proxyid,'pid'=>$this->uid))->row_array();

		}else{
			$proxy_data = $this->db->get_where('dealer',array('id'=>$proxyid))->row_array();
		}
		if(!$proxy_data){
			$this->stdreturn->failed('1','你没有创建该代理商');
		}
		if($proxy_data['status'] == 1){
			$data = array(
				"status"=>0
			);
			$this->Data->edit(array('id'=>$proxyid),$data,'dealer');
		}else{
			$data = array(
				"status"=>1
			);
			$this->Data->edit(array('id'=>$proxyid),$data,'dealer');
		}

		$this->stdreturn->ok();

	}



}
