<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 登录验证
 */

class MenuAuth{
    public $CI;
    public function __construct($user) {
        $this->CI =& get_instance();
        $this->CI->load->model('data_model','data');//加载二次封装ar操作
        $this->CI->load->model('user_model','user');
        $this->user = $user;
    }

    public function authMenus(){
        $user = $this->user;
        $this->CI->data->setTable('auth_menu');
        $menus = $this->CI->data->get(array('status'=>'1'),'sort asc');
        if($user['id'] =='1' or $user['group_id']=='1'){
            $menus = $this->tree($menus,'0','parent','child');
            return $menus;
        }
        $userRules = unserialize($user['group_rules']);
        $menusArr = array();
        foreach ($menus as $key => $value) {
            foreach ($userRules as $k => $v) {
                if($value['id'] == $v['id']){
                    array_push($menusArr,$menus[$key]);
                }
            }
        }
        $data = $this->tree($menusArr,'0','parent','child');
        return $data;
    }

    public function check(){
        $userRules = unserialize($this->user['group_rules']) ? unserialize($this->user['group_rules']) : array();
        $class = $this->CI->router->fetch_class();
        $method = $this->CI->router->fetch_method();
        $menu = $this->CI->db->get_where('auth_menu',array('class'=>$class))->row_array();
        $methods = $menu['method'] ? explode(',', $menu['method']) : array();
        $newArr = array();
        if($this->user['id'] == '1' || $this->user['group_id'] =='1'){
            return true;
        }

        foreach ($userRules as $key => $value) {
            if($value['id']==$menu['id']){
                $newArr = $value['rule'];
                array_push($newArr,'index');
            }
        }
        if($class != 'Index' && $method == 'index'){
            array_push($methods,'index');
        }

        $result = array_diff($methods, $newArr);
        if(in_array($method, $result)){
            return false;
        }
        return true;
    }

    /**
     * [tree 递归分类]
     */
    public function tree($table,$pid='0',$pidName = 'pid',$childName = 'child') {
        $tree = array();
        foreach($table as $row){
            if($row[$pidName]==$pid){
                $tmp = $this->tree($table,$row['id'],$pidName,$childName);
                if($tmp){
                    $row[$childName]=$tmp;
                }
                $tree[]=$row;                
            }
        }
        return $tree;        
    }
}
