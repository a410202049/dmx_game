<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AccountModel extends DataModel{
	function __construct($table=''){
  		parent::__construct();
		$this->setTable('account');
	}
	

	//给用户充值
	function diamond_recharge($accid,$diamond){
		$this->Data->setHits(array('accid'=>$accid),'diamond','account','+',$diamond);
	}

	//给代理商充值
	function proxy_recharge($proxy_id,$diamond){
		$this->Data->setHits(array('id'=>$proxy_id,'type'=>1),'diamond','dealer','+',$diamond);
	}
	
	//扣除代理商钻石
	function diamond_debit($id,$diamond){
		$this->Data->setHits(array('id'=>$id),'diamond','dealer','-',$diamond);
	}
}