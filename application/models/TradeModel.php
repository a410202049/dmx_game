<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class TradeModel extends DataModel{
	function __construct($table=''){
  		parent::__construct();
		$this->setTable('trade');
	}
	

	/**
	 * [getUserInfo description]
	 * @param  [type]  $parameter [username or userid]
	 * @param  boolean $isId      [isID]
	 * @return [type]             [userData]
	 */
	// function insert_trade($data){
	// 	$this->Data->add($data);
	// }
	
}