<?php

class M_item extends CI_Model{

        var $cat_table = '';
        var $item_table = '';

	function __construct()
	{
		parent::__construct();
        $this->cat_table = $this->db->dbprefix('cat');
        $this->item_table = $this->db->dbprefix('item');
	}


	//通过POST传递过来的参数，可以存入到数据库中，然后返回一个“添加成功！”
	function set_item(){
		$data = array(
               'title' => $_POST['title'],
               'img_url' => $_POST['img_url'],
               'cid' => $_POST['cid'],
               'click_url' =>  $_POST['click_url'],
               'price' => $_POST['price'],
               'sellernick' => $_POST['sellernick'],
			   'oldprice' => $_POST['oldprice'],
			   'discount' => $_POST['discount'],
			   'adddatetime' => date('YmdHis',time()),
			   'labelid' => $_POST['labelid'],
			   'comment' => $_POST['comment']
            );
		
		return $this->db->insert($this->item_table, $data);
	}

	function delete_item($item_id){
		$data = array(
               'id' => $item_id
            );
		$this->db->delete('item', $data);
		echo '1';
	}
	
	function update_item($item_id){
		$data = array(
               'title' => $_POST['title'],
               'img_url' => $_POST['img_url'],
               'cid' => $_POST['cid'],
               'click_url' =>  $_POST['click_url'],
               'price' => $_POST['price'],
               'sellernick' => $_POST['sellernick'],
			   'oldprice' => $_POST['oldprice'],
			   'discount' => $_POST['discount'],
			   'labelid' => $_POST['labelid'],
			   'comment' => $_POST['comment']
            );
		
		$this->db->where('id',$item_id);
		
		return $this->db->update('item',$data);
	}
	
	/*
	  * 通过条目ID获得点击url
	   */
	function get_item_clickurl($item_id){
		$this->db->select('click_url');
		$data = array(
               'id' => $item_id
            );
		$query = $this->db->get_where('item', $data);
		if($query->num_rows()>0){
			foreach($query->result() as $array){
				$return_clickurl = $array->click_url;
				return $return_clickurl;
			}
		}else return 0;
	}

	/*
	 * 增加条目click_count
	 *  */
	function add_click_count($item_id)	{
		$this->db->set('click_count', 'click_count+1', FALSE);
		$this->db->where('id', $item_id);
		$this->db->update($this->item_table); 
		return $item_id;
	}

	//获得所有条目
	//$limit为每页书目，必填
	//$offset为偏移，必填
	function get_all_item($limit='40',$offset='0',$cat='',$labelid='',$sort='adddatetime desc')
	{

		//如果是分类页
		if(!empty($cat)){
			$this->db->select('item.id id,img_url,click_count,price,oldprice,discount,cid,slug,item.title title,sellernick,comment,good,unlike');
			
			$where = "cid= cat.id AND slug='".$cat."'";
			
			if(!empty($labelid)){
				$where = $where." AND labelid=".$labelid;
			}
			
			$this->db->join($this->cat_table,$where);
			$this->db->order_by($sort);
			$query = $this->db->get($this->item_table,$limit,$offset);
			}
		//如果是主页
		else{
			if(!empty($labelid)){
				$this->db->where("labelid",$labelid);
			}
			
			$this->db->order_by($sort);
			$query = $this->db->get($this->item_table,$limit,$offset);
		}

		return $query;
	}
	
	//获得所有条目
	//$limit为每页书目，必填
	//$offset为偏移，必填
	function get_all_item_by_cid($limit='40',$offset='0',$cat=-1,$labelid=-1,$sort='adddatetime desc')
	{

		//如果是分类页
		if($cat >= 0){
			$this->db->where('cid',$cat);
			
			if($labelid > 0){
				$this->db->where('labelid',$labelid);
			}
			
			$this->db->order_by($sort);
			$query = $this->db->get($this->item_table,$limit,$offset);
			}
		//如果是主页
		else{
			$this->db->order_by($sort);
			$query = $this->db->get($this->item_table,$limit,$offset);
		}

		return $query;
	}

	/**
	 * 获得某类别条目总数
	 *
	 * @param string cat_slug 类别的slug
	 * @return integer 类别的数目
	 */
	function count_items($cat_slug='',$labelid=""){
		if(empty($cat_slug) && empty($labelid)){
			return $this->db->count_all_results($this->item_table);
		}else{

			$this->db->select('COUNT(item.id) AS count');
			$where = "cid= cat.id AND slug='".$cat_slug."'";
			
			if(!empty($labelid)){
				$where = $where." AND item.labelid = ".$labelid;
			}
			
			$this->db->join($this->cat_table,$where);
			$this->db->order_by('item.id DESC');
			$query = $this->db->get($this->item_table);

			if ($query->num_rows() > 0)
			{
			   $row = $query->row();
			   return $row->count;
			}else{
				return 0;
			}
		}

	}

    /**
     * 根据id查找条目
     *
     * @param integer $item_id 条目ID
     * @return
     */
    function getItemById($item_id){
         $data = array(
                'id' => $item_id
             );
         $query = $this->db->get_where($this->item_table, $data);
         if($query->num_rows()>0){
         	$result = $query->result();
         	return $result[0];
         }else return null;
    }

    /**
     * 根据关键词搜索条目
     *
     * @param string $keyword 搜索关键词
     * @return
     */
    function searchItem($keyword){
		$this->db->like('title',$keyword);
		$query = $this->db->get($this->item_table);
		return $query;
    }

    /**
     * 查询每个店铺对应的点击
     *
     * @return 查询结果
     */
	function query_shops(){
		$this->db->select("sellernick,count(sellernick) as count,SUM(click_count) as sum");
		$this->db->group_by('sellernick')->order_by('count DESC');
		$query = $this->db->get($this->item_table);
		return $query;
	}

	function get_item_status($days){
		$overday = mktime(date("h"), date("i"), date("s"), date("m"), date("d") - $days, date("Y"));
		
		$this->db->select("count(id) as count,sum(click_count) as sum");
		$this->db->where("adddatetime <= ",date('y-m-d h:i:s',$overday));
		
		$query = $this->db->get($this->item_table);
		
		if($query->num_rows()>0){
			$result = $query->result();
			return $result[0];        
		}else 
			return null;
	}
	
	function delete_overdays($days){
		$overday = mktime(date("h"), date("i"), date("s"), date("m"), date("d") - $days, date("Y"));
		
		$this->db->where("adddatetime <= ",date('y-m-d h:i:s',$overday));
		
		$result = $this->db->delete($this->item_table);
		
		return $result;
	}
	
	function delete_all_item(){		
		
		$result = $this->db->empty_table($this->item_table);
		
		return $result;
	}
	
    /**
     * 判断条目是否已经存在
     *
     * @param integer $item_id 条目ID
     * @return boolean 是否存在
     */
    // function itemExist($item_id){
    //     $data = array(
    //                   'id' => $item_id
    //                );
    //            $query = $this->db->get_where($this->item_table, $data);
    //     if($query->num_rows() > 0){
    //         return true;
    //     }else {
    //         return false;
    //     }
    // }

    function vote_good($id){
		$this->db->where('id',$id);
		
		$this->db->set('good',"good + 1", FALSE);
		
		$this->db->update($this->item_table);
		
		return $id;
	}
	
	function vote_unlike($id){
		$this->db->where('id',$id);
		
		$this->db->set('unlike',"unlike + 1", FALSE);
		
		$this->db->update($this->item_table);
		
		return $id;
	}

}
