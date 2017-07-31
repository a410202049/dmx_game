<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Index extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		require_once APPPATH.'libraries/Api.php';
		$a = new Api('xxx_api');
		echo $a->request('xxx_ooo');
		echo "admin";
	}

}
