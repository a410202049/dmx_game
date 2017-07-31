<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class DataModel extends CI_Model
{
	var $table;
	function __construct(){
  		parent::__construct();
	}
	
	function setTable($table){
		$this->table = $table;
	}
	

	function add($data,$table=''){
		$table = $table==''?$this->table:$table;
		if($data){
			$this->db->insert($table,$data);
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	function edit($datawhere,$data,$table=''){
		$table = $table==''?$this->table:$table;
		if(!empty($datawhere))
		{
			$this->db->where($datawhere);
		}
		$this->db->update($table,$data);
	}
	
	function del($ids,$table=''){
		$table = $table==''?$this->table:$table;
		if(is_array($ids)){
			$this->db->where_in('id',$ids);
		}else{
			$this->db->where('id',$ids);
		}
		$this->db->delete($table);
	}

	function get($getwhere="",$order_by='',$group_by='',$having='',$table=''){
		$table = $table==''?$this->table:$table;
		if($getwhere){
			$this->db->where($getwhere);
		}
		if($order_by){
			$this->db->order_by($order_by);
		}
		if($group_by){
			$this->db->group_by($group_by);
		}
		if($having){
			$this->db->having($having); 
		}
		$data = $this->db->get($table)->result_array();
		return $data;
	}
	
	function getRow($getwhere="",$table=''){
		$table = $table==''?$this->table:$table;
		if($getwhere){
			$this->db->where($getwhere);
		}
		$row = $this->db->get($table)->row_array();
		return $row;
	}

	function getCount($getwhere='',$table=''){
		$table = $table==''?$this->table:$table;
		if($getwhere){
			$this->db->where($getwhere);
		}
		return $this->db->count_all_results($table);
	}
	
	function setHits($where = array(),$field="",$table='',$symbol ='+',$num = '1'){
		$table = $table==''?$this->table:$table;
		$this->db->where($where);
		$this->db->set($field, $field.$symbol.$num,FALSE);
		$this->db->update($table);
	}

	/**
	 * [join 多表查询]
		$sideTable = array(
			array(
				'table'=>'user_group',
				'alias'=>'g',
				'condition'=>'a.id = b.id',
				'type'=>'left'
			)
		);
	 */
	function join($find = "",$table ="",$sideTable = array(),$isRow = false ,$where,$order_by = '',$group_by = '',$having = ''){
		$this->db->select($find);
		$this->db->from($table);
		foreach ($sideTable as $key => $value) {
			$this->db->join($value['table'].' as '.$value['alias'],$value['condition'],$value['type']);
		}
		if(!empty($where))
		{
			$this->db->where($where);
		}
		if($order_by){
			$this->db->order_by($order_by);
		}
		if($group_by){
			$this->db->group_by($order_by);
		}
		if($having){
			$this->db->having($having); 
		}
		if($isRow){
			$data = $this->db->get()->row_array();
		}else{
			$data = $this->db->get()->result_array();
		}
		return $data;
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

        return array('data'=>$data,'pager'=>$this->pager);
    }

}