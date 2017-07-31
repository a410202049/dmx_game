<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UserModel extends DataModel{
	function __construct($table=''){
  		parent::__construct();
	}
	
	// function login($username,$userpass){
	// 	$this->setTable('user');
	// 	$user = $this->getRow(array('username'=>$username));
	// 	print_r($user);
	// 	// if(isset($user['status'])&&$user['status']==1&&$user['password']==md5pass($userpass,$user['salt'])){
	// 	// 	$this->CI->Data_model->editData(array('id'=>$user['id']),array('logincount'=>$user['logincount']+1,'lasttime'=>time()));
	// 	// 	$this->setLogin($user);
	// 	// 	return true;
	// 	// }else{
	// 	// 	return false;
	// 	// }
	// }

	/**
	 * [getUserInfo description]
	 * @param  [type]  $parameter [username or userid]
	 * @param  boolean $isId      [isID]
	 * @return [type]             [userData]
	 */
	function getUserInfo($parameter,$isId = false){
		if($isId){
			$where = array('u.id'=>$parameter);
		}else{
			$where = array('u.username'=>$parameter);
		}
		$sideTable = array(
			array(
				'table'=>'user_group',
				'alias'=>'g',
				'condition'=>'u.group_id = g.id',
				'type'=>'left'
			)
		);
		$userData = $this->join("u.*,g.id as gid,g.name as group_name,g.status as group_status,g.rules as group_rules,g.create_time as group_createtime,g.description as group_description,","user as u",$sideTable,true ,$where);
		return $userData;
	}
	
}