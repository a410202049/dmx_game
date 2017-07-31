<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ArticleModel extends DataModel{
	function __construct(){
  		parent::__construct();
	}
	
	/**
	 * [getArticle 获取文章]
	 */
	function getArticle($id){
		// $article = $this->getRow(array('id'=>$id),'article');

		$sql = "select a.*,u.nickname, case when cate.name IS NULL then '未分类' else cate.name end as cname from ci_article as a left join ci_article_category as cate on a.cid = cate.id left join ci_user as u on a.author_id = u.id where a.is_del = 0 and a.id = '".$id."'";
		$article = $this->db->query($sql)->row_array();

		$sideTable = array(
			array(
				'table'=>'tags',
				'alias'=>'tag',
				'condition'=>'r.tag_id = tag.id',
				'type'=>'left'
			)
		);
		$tags = $this->join("tag.id,tag.name,tag.color,tag.fontcolor,tag.bordercolor","relation_tags as r",$sideTable,false ,array('r.object_id'=>$id,'r.type'=>'article'));
    	$article['tags'] = $tags;
        return $article;
	}

	/**
	 * [gets_by_latest 获取最新文章列表]
	 * $type latest:按发布日期排序 hot：按浏览量排序 common：按评论数排序 rand：随机 top置顶
	 * @return [type] [description]
	 */
	function gets_by_article($page_index,$page_size = 5,$type = 'latest',$arg = null,$user_id = null,$cid = null){
		$where = '';
    	$page['url'] = 'list';
		if($user_id){
			$where.= "and a.author_id = ".$user_id;
		}
		if($cid){
			$where.= " and a.cid = ".$cid;
		}
    	$sql = "select a.*,u.nickname, case when cate.name IS NULL then '未分类' else cate.name end as cname from";
    	$sql.= " ci_article as a left join ci_article_category as cate on a.cid = cate.id ";
    	$sql.= " left join ci_user as u on a.author_id = u.id";
		switch ($type) {
			case 'latest':
				$order_by = "a.is_top desc,a.publishtime desc,a.createtime desc";
				break;
			case 'hot':
				$where.= " and a.cover_img != ''";
				$order_by = "a.hit_num desc,a.real_hit_num desc";
				break;
			case 'rand':
				$where.= " and a.cover_img != ''";
				$order_by = "RAND()";
				break;
			case 'date':
				$page['url'] = 'article/date/'.$arg;
				$where.= " and date_format(a.publishtime,'%Y-%m')= '".$arg."' ";
				$order_by = "a.is_top desc,a.publishtime desc,a.createtime desc";
				break;
			case 'tags':
				$page['url'] = 'tags/'.$arg;
				$sql.=" left join ci_relation_tags as tag on tag.object_id = a.id ";
				$where.= " and tag.type='article' and tag.tag_id = '".$arg."'";
				$order_by = "a.is_top desc,a.publishtime desc,a.createtime desc";
				break;
			case 'search':
				$page['url'] = 'search';
				$where.= " and (a.title like '%".urldecode($arg)."%' or a.content like '%".urldecode($arg)."%')";
				$order_by = "a.is_top desc,a.publishtime desc,a.createtime desc";
				break;
			case 'category':
				$page['url'] = 'category';
				$data = $this->db->get_where('article_category')->result_array();
				// echo $arg;
				$ids = array_column(getMenuTree($data,$arg), 'id');
				$id_str = implode(',', $ids);
				$in_id = $id_str ? $id_str.','.$arg : $arg;
				$where.= " and a.cid in (".$in_id.")";
				$order_by = "a.is_top desc,a.publishtime desc,a.createtime desc";
				break;
		}
    	$sql.= " where a.is_del = 0 ".$where;
    	$sql.= " order by ".$order_by;
    	// echo $sql;exit;
    	$page['query'] = $sql;
    	$page['perpage'] = $page_size;
    	$page['nowindex'] = $page_index;
    	$pager = $this->page($page);
    	$data = $pager['data'];
        foreach ($data as $key => $value) {
			$sideTable = array(
				array(
					'table'=>'tags',
					'alias'=>'tag',
					'condition'=>'r.tag_id = tag.id',
					'type'=>'left'
				)
			);
			$tags = $this->data->join("tag.id,tag.name,tag.color,tag.fontcolor,tag.bordercolor","relation_tags as r",$sideTable,false ,array('r.object_id'=>$value['id'],'r.type'=>'article'));
	        	$data[$key]['tags'] = $tags;
        }

        return array('articles'=>$data,'pager'=>$pager['pager']->show(4));
	}

	/**
	 * [about_articles 获取相关文章]
	 * @param  [type] $article_id [description]
	 * @return [type]             [description]
	 */
	function about_articles($article_id,$limit = 5){
		$sql = "select * from ci_article as a where id in (SELECT object_id from ci_relation_tags 
		where type ='article' and tag_id in 
		(SELECT tag_id from ci_relation_tags where type ='article' and object_id = '".$article_id."') 
		and object_id !='".$article_id."') and a.is_del = 0 limit 0,".$limit;
		$data = $this->db->query($sql)->result_array();
		return $data;
	}
	
	function article_prev_next($article_id){

		$where = "";
    	$sql = "select a.*,u.nickname, case when cate.name IS NULL then '未分类' else cate.name end as cname from";
    	$sql.= " ci_article as a left join ci_article_category as cate on a.cid = cate.id ";
    	$sql.= " left join ci_user as u on a.author_id = u.id";
    	$sql.= " where a.is_del = 0 and a.id > ".$article_id;
    	$sql.= " order by a.id asc,a.is_top desc,a.publishtime desc,a.createtime desc limit 0,1";


    	$sql1 = "select a.*,u.nickname, case when cate.name IS NULL then '未分类' else cate.name end as cname from";
    	$sql1.= " ci_article as a left join ci_article_category as cate on a.cid = cate.id ";
    	$sql1.= " left join ci_user as u on a.author_id = u.id";
    	$sql1.= " where a.is_del = 0 and a.id < ".$article_id;
    	$sql1.= " order by a.id desc,a.is_top desc,a.publishtime desc,a.createtime desc limit 0,1";
    	
    	$prev = $this->db->query($sql)->row_array();
    	$next = $this->db->query($sql1)->row_array();
    	
    	return array('prev'=>$prev,'next'=>$next);
	}

	/**
	 * [add_hit_num description]
	 */
	function add_hit_num($article_id){
        $this->db->set('hit_num', 'hit_num + 1', false);
        $this->db->set('real_hit_num', 'real_hit_num + 1', false);
        $this->db->where('id', $article_id);
        return $this->db->update('ci_article');
	}

	function get_article_comments($article_id){
		$data = $this->db->order_by('createtime','desc')->get_where('ci_article_comment',array('is_del'=>'0','is_show'=>'1','article_id'=>$article_id))->result_array();
		return $data;
	}

	/**
	 * 获取文章归档年月
	 */
	function article_filed(){
		$data = $this->db->query("select count(*) as num,DATE_FORMAT(a.publishtime, '%Y年%m月') as ymtime,DATE_FORMAT(a.publishtime, '%Y-%m') as ym from ci_article as a where a.is_del = 0 group by DATE_FORMAT(a.publishtime, '%Y-%m')  order by a.publishtime DESC LIMIT 8")->result_array();
		// select * from ci_article as a where date_format(a.publishtime,'%Y-%m')='2017-02' and a.is_del = 0;
		return $data;
	}
}