<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Index extends admin_Auth_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		echo "1";
		// $this->twig->render('Index/index');
	}


}
