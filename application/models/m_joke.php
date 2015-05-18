<?php

class M_joke extends CI_Model{

        var $joke_table = '';
        var $cat_table = '';


	function __construct()
	{
		parent::__construct();
                $this->joke_table = $this->db->dbprefix('joke');
                $this->cat_table = $this->db->dbprefix('cat');
	}


	function add_joke()
	{
        $data_decode = json_decode($_POST['data']);
        foreach($data_decode as $joke){
            $data = array(                     
                           'cid' => $joke -> joke_cid ,
                           'labelid' => $joke -> joke_labelid ,
                           'img_url' => $joke-> joke_imgurl,
                           'html' =>$joke -> joke_html,
                           'authorid' =>$joke -> joke_authorid,
                           'levelid' => $joke -> joke_levelid,
						   'adddatetime' => date('YmdHis',time())
                           
                        );
            $this->db->insert($this->joke_table, $data);
        }
    }
	
	function add_joke_by($joke)
	{
            $data = array(
                           'cid' =>$joke['joke_cid'],
                           'labelid' =>$joke['joke_labelid'],
                           'html' =>$joke['joke_html'],
                           'img_url' => $joke['joke_imgurl'],
                           'authorid' =>$joke['joke_authorid'],
                           'levelid' => $joke['joke_levelid'],
						   'adddatetime' => date('YmdHis',time())
                        );
            return $this->db->insert($this->joke_table, $data);
    }

	
	function get_joke_by_id($id = ''){
    	if(!empty($id)){
    		$result = $this->db->get_where($this->joke_table, array('id'=>$id))->result();
			
			return $result[0];
			
    	}else {
    		return null;
    	}
    }
	
	function get_all_jokes($limit='40',$offset='0',$cid='',$labelid='',$sort = "adddatetime desc")
	{
		//如果是分类页
		if(!empty($cid)){
			$this->db->where('cid',$cid);
			
			if(!empty($labelid)){
				$this->db->where('labelid',$labelid);
			}
			
			
			$this->db->order_by($sort);
			$query = $this->db->get($this->joke_table,$limit,$offset);
			}
		//如果是主页
		else{
			$this->db->order_by($sort);
			$query = $this->db->get($this->joke_table,$limit,$offset);
		}

		return $query;
	}

	function update_joke(){
		 $data_decode = json_decode($_POST['data']);
		foreach($data_decode as $joke){
			$data = array(
                           'cid' => $joke -> joke_cid ,
                           'labelid' => $joke -> joke_labelid ,
                           'html' =>$joke -> joke_html,
                           'img_url' => $joke-> joke_imgurl,
                           'authorid' =>$joke -> joke_authorid,
                           'levelid' => $joke -> joke_levelid,
            );

			$this->db->where('id', $joke -> joke_id);
			$this->db->update($this->joke_table, $data);
        }
	}

	function update_joke_by($joke){
		$data = array(
                           'cid' =>$joke['joke_cid'],
                           'labelid' =>$joke['joke_labelid'],
                           'img_url' => $joke['joke_imgurl'],
                           'html' =>$joke['joke_html'],
                           'authorid' =>$joke['joke_authorid'],
                           'levelid' => $joke['joke_levelid']
            );
            
        $this->db->where('id', $joke['joke_id']);
		return $this->db->update($this->joke_table, $data);
	}
	
	function delete_joke($joke_id){
		return $this->db->delete($this->joke_table,array('id'=>$joke_id));
	}

    /**
     * 查询每个类别对应的点击
     *
     * @return 查询结果
     */
	function query_jokes(){
        
		$this->db->select('id,COUNT(id) as count, SUM(click_count) as sum');
		$where = "catid=cid";
		$this->db->join($this->cat_table,$where);
		$this->db->order_by('count DESC');
		$this->db->group_by('cid');
		$query = $this->db->get($this->joke_table);
		return $query;
	}

	/**
	 * 获取某类别点击总数
	 *
	 * @param integer cid 类别的id
	 * @return integer 类别点击总数
	 */
	function click_count_by_cid($cid=0){
                $joke_table = $this->joke_table;
		if($cid == 0){
			$this->db->select('SUM(click_count) as sum');
			$query = $this->db->get($joke_table);
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
	
	function clear_joke_by_cid($cid){
		
		$this->db->where("cid",$cid);
		
		$result = $this->db->delete($this->joke_table);
		
		return $result;
	}

	function count_jokes($cid="",$labelid=""){
			if(empty($cid)&&empty($labelid)){
			return $this->db->count_all_results($this->joke_table);
		}else{

			$this->db->select('COUNT(id) AS count');
			$this->db->where('cid',$cid);
			
			if(!empty($labelid)){
				$this->db->where('labelid',$labelid);
			}
			
			$query = $this->db->get($this->joke_table);

			if ($query->num_rows() > 0)
			{
			   $row = $query->row();
			   return $row->count;
			}else{
				return 0;
			}
		}
	}
	
	function vote_good($id){
		$this->db->where('id',$id);
		
		$this->db->set('good',"good + 1", FALSE);
		
		$this->db->update($this->joke_table);
		
		return $id;
	}
	
	function vote_unlike($id){
		$this->db->where('id',$id);
		
		$this->db->set('unlike',"unlike + 1", FALSE);
		
		$this->db->update($this->joke_table);
		
		return $id;
	}
}
