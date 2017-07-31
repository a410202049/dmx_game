<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('DataModel','Data');
        $this->load->model('DealerModel','Dealer');
        $this->load->library('LoginAuth');//加载token验证类
        $this->regular = $this->config->item('regular');
    }

    /**
     * @name 错误跳转公共方法
     * @param string $message 错误提示信息
     * @param number $time 跳转时间
     * @param string $url 跳转的URL
     */
    public function error($message,$url = FALSE,$time = 3)
    {
        if( !$url ) {
            $data['url'] = 'javascript:history.back(-1);';
        } else {
            $data['url'] = $url;
        }
        $data['message'] = $message;
        $data['time'] = $time;
        die($this->load->view('public/error',$data,true));
    }

    /**
     * @name 成功跳转公共方法
     * @param string $message 成功提示信息
     * @param number $time 跳转时间
     * @param string $url 跳转的URL
     */
    public function success($message,$url = FALSE,$time = 3)
    {
        if( !$url ) {
            $data['url'] = 'javascript:history.back(-1);';
        } else {
            $data['url'] = $url;
        }
        $data['message'] = $message;
        $data['time'] = $time;
        die($this->load->view('public/success',$data,true));
    }

    /**
     * ajax返回
     */
    function response_data($status,$message = "",$data = array()) {
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        $array= array(
            'status' =>$status,
            'message' =>$message,
            'data' =>$data
        );
        echo json_encode($array);
        exit;
    }


    /**
     * 分页函数
     */
    function page($array){
        $perpage = isset($array['perpage']) ? $array['perpage'] : '15';
        $part = isset($array['part']) ? $array['part'] : '2';
        $seg3 = $this->uri->segment(3) ? $this->uri->segment(3) : 'index';
        $default_url = $this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$seg3;
        $url = isset($array['url']) ? $array['url'] : $default_url;
        $seg = isset($array['seg']) ? $array['seg'] : '4';
        $tableName = isset($array['tableName']) ? $array['tableName'] : '';
        $where = isset($array['where']) ? $array['where'] : '1=1';
        $page_config['page'] = isset($array['page']) ? $array['page'] : '';
        $page_config['perpage']=$perpage;   //每页条数
        $page_config['part']=$part;//当前页前后链接数量
        $page_config['url']=$url;//url
        $page_config['pre_page']='<span aria-hidden="true">«</span>';
        $page_config['next_page']='<span aria-hidden="true">»</span>';//url
        $page_config['seg']=$seg;//参数取 index.php之后的段数，默认为3，即index.php/control/function/18 这种形式
        if(!$array['nowindex']){
            $page_config['nowindex']=$this->uri->segment($page_config['seg']) ? $this->uri->segment($page_config['seg']):1;//当前页
        }else{
            $page_config['nowindex'] = $array['nowindex'];
        }
        $this->load->library('Pager');
        if(isset($array['query'])){
            $query = $this->db->query($array['query']);
            $page_config['total'] = count($query->result_array());
        }else{
            $page_config['total'] = $this->db->where($where)->count_all_results($tableName);
        }
        $this->pager->initialize($page_config);

        if(isset($array['query'])){
            $data = $this->db->query($array['query'].' LIMIT '.$page_config['perpage'] * ($page_config['nowindex'] - 1).','.$page_config['perpage'])->result_array();
        }else{
            $this->db->limit($page_config['perpage'],$page_config['perpage'] * ($page_config['nowindex'] - 1));
            $data = $this->db->order_by('id','desc')->get_where($tableName,$where)->result_array();
        }
        return $data;
    }

}

class admin_Auth_Controller extends Base_Controller {
    public $uid;//用户id
    public function __construct() {
        parent::__construct();
        $this->config->load('twig');//加载twig配置文件
        $twig_config = $this->config->item('twig_admin');//后台模板引擎设置
        $tplName = 'default';//数据库查询当前模板名字
        $twig_config['template_dir'] = $twig_config['template_dir'].$tplName;
        $this->load->library('Twig',$twig_config);
        $this->uid = $this->loginauth->isLogin();
        // $this->userInfo = $this->user->getUserInfo($this->uid,true);
         if(!$this->loginauth->isLogin()){
             redirect(base_url('login'));
         }

        // $this->twig->assign('userInfo',$this->userInfo);
        // $this->twig->assign('uid',$this->uid);
    }
}

