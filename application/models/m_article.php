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
                           'cid' => $article -> article_cid ,
                           'labelid' => $article -> article_labelid ,
                           'title' =>$article -> article_title,
                           'content' =>$article -> article_content,
                           'html' =>$article -> article_html,
                           'authorid' =>$article -> article_authorid,
                           'levelid' => $article -> article_levelid,
						   'imgurl' => $article -> imgurl,
                           'adddatetime' => date('YmdHis',time())
                        );
            $this->db->insert($this->article_table, $data);
        }
    }
	
	function add_article_by($article)
	{
            $data = array(
                           'cid' =>$article['article_cid'],
                           'labelid' =>$article['article_labelid'],
                           'title' =>$article['article_title'],
                           'content' =>$article['article_content'],
                           'html' =>$article['article_html'],
                           'authorid' =>$article['article_authorid'],
                           'levelid' => $article['article_levelid'],
						   'imgurl' => $article['imgurl'],
						   'adddatetime' => date('YmdHis',time())
                        );
            return $this->db->insert($this->article_table, $data);
    }

	
	function get_article_by_id($id = ''){
    	if(!empty($id)){
			$this->db->select('id,cid,labelid,title,html,authorid,levelid,adddatetime,imgurl');
    		$result = $this->db->get_where($this->article_table, array('id'=>$id))->result();
			
			return $result[0];
			
    	}else {
    		return null;
    	}
    }
	
	function get_all_articles($limit='40',$offset='0',$cid='',$labelid='',$sort = "adddatetime desc")
	{
		//如果是分类页
		if(!empty($cid)){
			$where = "cid = ".$cid;
			
			if(!empty($labelid)){
				$where = $where." AND labelid=".$labelid;
			}
			
			$this->db->where($where);
			$this->db->order_by($sort);
			$query = $this->db->get($this->article_table,$limit,$offset);
			}
		//如果是主页
		else{
			$this->db->order_by($sort);
			$query = $this->db->get($this->article_table,$limit,$offset);
		}

		return $query;
	}

	function update_article(){
		 $data_decode = json_decode($_POST['data']);
		foreach($data_decode as $article){
			$data = array(
                           'cid' => $article -> article_cid ,
                           'labelid' => $article -> article_labelid ,
                           'title' =>$article -> article_title,
                           'content' =>$article -> article_content,
                           'html' =>$article -> article_html,
                           'authorid' =>$article -> article_authorid,
                           'levelid' => $article -> article_levelid,
						   'imgurl' => $article -> article_imgurl
            );

			$this->db->where('id', $article -> article_id);
			$this->db->update($this->article_table, $data);
        }
	}

	function update_article_by($article){
		$data = array(
                           'cid' =>$article['article_cid'],
                           'labelid' =>$article['article_labelid'],
                           'title' =>$article['article_title'],
                           'content' =>$article['article_content'],
                           'html' =>$article['article_html'],
                           'authorid' =>$article['article_authorid'],
                           'levelid' => $article['article_levelid'],
						   'imgurl' => $article['article_imgurl']
            );
            
        $this->db->where('id', $article['article_id']);
		return $this->db->update($this->article_table, $data);
	}
	
	function delete_article($article_id){
		return $this->db->delete($this->article_table,array('id'=>$article_id));
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
		
		$result = $this->db->delete($this->article_table);
		
		return $result;
	}

	function count_articles($cid="",$labelid=""){
			if(empty($cid)&&empty($labelid)){
			return $this->db->count_all_results($this->article_table);
		}else{

			$this->db->select('COUNT(id) AS count');
			
			if(!empty($cid)){
				$this->db->where('cid',$cid);
			}
			
			if(!empty($labelid)){
				$this->db->where('labelid',$labelid);
			}
			
			$query = $this->db->get($this->article_table);

			if ($query->num_rows() > 0)
			{
			   $row = $query->row();
			   return $row->count;
			}else{
				return 0;
			}
		}
	}
	
	function count_articles_by_keyword($keyword){
		
		$this->db->select('COUNT(id) AS count');
		$this->db->like('title',$keyword);
		$query = $this->db->get($this->article_table);

		if ($query->num_rows() > 0)
		{
		   $row = $query->row();
		   return $row->count;
		}else{
			return 0;
		}
	}
	
	function get_articles_by_keyword($keyword,$limit=40,$offset=0)
	{
		$this->db->like('title',$keyword);
		$query = $this->db->get($this->article_table,$limit,$offset);
		return $query;
	}
	
	function vote_good($id){
		$this->db->where('id',$id);
		
		$this->db->set('good',"good + 1", FALSE);
		
		$this->db->update($this->article_table);
		
		return $id;
	}
	
	function vote_unlike($id){
		$this->db->where('id',$id);
		
		$this->db->set('unlike',"unlike + 1", FALSE);
		
		$this->db->update($this->article_table);
		
		return $id;
	}
}
