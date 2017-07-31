<?php
require_once 'ApiProxy.php';
class Api extends ApiProxy{
	public function __construct($_apiFlag){
		parent::__construct($_apiFlag);
	}
	protected function _sign(&$params){
	}
}

