<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class DealerModel extends DataModel{
	function __construct($table=''){
  		parent::__construct();
		$this->setTable('dealer');
	}
	

	/**
	 * [getUserInfo description]
	 * @param  [type]  $parameter [username or userid]
	 * @param  boolean $isId      [isID]
	 * @return [type]             [userData]
	 */
	function getUserInfo($parameter){
		$where = array('id'=>$parameter);
		$dealer = $this->getRow($where);
		return $dealer;
	}
	
}