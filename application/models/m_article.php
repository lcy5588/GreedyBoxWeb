<?php

class M_article extends CI_Model{

        var $article_table = '';
        var $cat_table = '';


	function __construct()
	{
		parent::__construct();
                $this->article_table = $this->db->dbprefix('article');
                $this->cat_table = $this->db->dbprefix('cat');
	}


	function add_article()
	{
        $data_decode = json_decode($_POST['data']);
        foreach($data_decode as $article){
            $data = array(
                           'article_id' => $article -> id ,
                           'article_cid' => $article -> cid ,
                           'article_title' =>$article -> title,
                           'article_content' =>$article -> content
                        );
            $this->db->insert($this->article_table, $data);
        }
    }
	
	function add_article_by($article)
	{
            $data = array(
                           'article_id' => $article['id'] ,
                           'article_cid' =>$article['cid'],
                           'article_title' =>$article['title'],
                           'article_content' =>$article['content']
                        );
            return $this->db->insert($this->article_table, $data);
    }

	
	function get_article_by_id($id = ''){
    	if(!empty($id)){
    		$result = $this->db->get_where($this->article_table, array('id'=>$id))->result();
    		return $result[0];
    	}else {
    		return null;
    	}
    }
	
	function get_all_articles($order = "adddatetime desc")
	{
		$this->db->order_by($order);
		$query = $this->db->get($this->article_table);
		
		return $query;
	}

	function update_article(){
		 $data_decode = json_decode($_POST['data']);
		foreach($data_decode as $article){
			$data = array(
               'article_id' => $article -> id ,
			   'article_cid' => $article -> cid ,
			   'article_title' =>$article -> title,
			   'article_content' =>$article -> content
            );

			$this->db->where('id', $article -> id);
			$this->db->update($this->article_table, $data);
        }
	}

	function delete_article($article_id){
		$this->db->delete($this->article_table,array('id'=>$article_id));
	}

    /**
     * 查询每个类别对应的点击
     *
     * @return 查询结果
     */
	function query_articles(){
        
		$this->db->select('id,title,COUNT(id) as count, SUM(click_count) as sum');
		$where = "catid=cid";
		$this->db->join($this->cat_table,$where);
		$this->db->order_by('count DESC');
		$this->db->group_by('cid');
		$query = $this->db->get($this->article_table);
		return $query;
	}

	/**
	 * 获取某类别点击总数
	 *
	 * @param integer cid 类别的id
	 * @return integer 类别点击总数
	 */
	function click_count_by_cid($cid=0){
                $article_table = $this->article_table;
		if($cid == 0){
			$this->db->select('SUM(click_count) as sum');
			$query = $this->db->get($article_table);
			$row = $query->row();
			  return $row->sum;
		}else {
			$this->db->where('cid='.$cid);
			$this->db->select('SUM(click_count) as sum');
			$query = $this->db->get($item_table);
			if ($query->num_rows() > 0)
			{
				$row = $query->row();
				  return $row->sum;
			}
		}
	}
	
	function clear_article_by_cid($cid){
		
		$this->db->where("cid",$cid);
		
		$result = $this->db->delete($this->item_table);
		
		return $result;
	}

}
