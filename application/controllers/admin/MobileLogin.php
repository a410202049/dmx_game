<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MobileLogin extends Base_Controller {
	
    public function __construct() {  
        parent::__construct();
        $this->config->load('twig');//加载twig配置文件
        $twig_config = $this->config->item('twig_admin');//后台模板引擎设置
        $tplName = 'default';//数据库查询当前模板名字
        $twig_config['template_dir'] = $twig_config['template_dir'].$tplName;
        $this->load->library('Twig',$twig_config);
        // $this->site = $this->site->getSiteInfo();
        // $this->twig->assign('site',$this->site);
    }
    
	public function index() {
         if($this->loginauth->isLogin()){
             redirect(base_url('mobile-index'));
         }
         // $this->session->set_flashdata('error','账号不能为空');
         // print_r($this->session->flashdata('error'));exit;
    	$this->twig->render(
    		'MobileLogin/index',
    		array('error_flashdata'=>$this->session->flashdata('error'))
    	);
	}


	/**
	 * 登陆
	 */
	public function do_login(){
		$postData = $this->input->post();
		$username = $postData['username'];
		$password = $postData['password'];
		$user = $this->Dealer->getUserInfo($username);

		if(!$username){
			$this->session->set_flashdata('error','账号不能为空');
		}else if(!$password){
			$this->session->set_flashdata('error','密码不能为空');
		}else if($user['passwd']!=do_hash($password)){
			$this->session->set_flashdata('error','用户名或密码错误');//用户名或密码错误
		}else if(!$user['status']){
			$this->session->set_flashdata('error','该用户已经被禁用，请联系管理员');//该用户已经被禁用，请联系管理员
		}

		if($this->session->flashdata('error')){
			redirect(base_url('admin/MobileLogin'));
		}
        $this->loginauth->setAuthCookie($username,true);//当前用户设置cookie
		$this->loginauth->genToken();//登录成功生成token

		redirect(base_url('mobile-index'));
		// if($user['type'] == 0){
		// 	redirect(base_url('mobile-index'));
		// }else{
		// 	redirect(base_url('/mobile-player-manage'));
		// }

	}

	/**
	 * 退出登陆
	 */
	public function logout(){
		$this->session->sess_destroy();
		setcookie(AUTH_COOKIE_NAME, ' ', time() - 31536000, '/');
	 	redirect(base_url('login'));
	}


}
