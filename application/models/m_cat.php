<?php

class M_cat extends CI_Model{

        var $cat_table = '';
        var $item_table = '';


	function __construct()
	{
		parent::__construct();
                $this->cat_table = $this->db->dbprefix('cat');
                $this->item_table = $this->db->dbprefix('item');
	}


	function add_cat()
	{
        $data_decode = json_decode($_POST['data']);
        foreach($data_decode as $cat){
            $data = array(
                           'id' => $cat -> id ,
                           'name' =>$cat -> name,
                           'slug' =>$cat -> slug
                        );
            $this->db->insert($this->cat_table, $data);
        }
    }
	
	function add_cat_by($cat)
	{
            $data = array(
                           'id' => $cat['id'] ,
                           'name' =>$cat['name'],
                           'slug' =>$cat['slug'],
						   'typeid' => $cat['typeid']
                        );
            return $this->db->insert($this->cat_table, $data);
    }

    function get_cat_name($cat_slug = ''){
    	if(!empty($cat_slug)){
    		$result = $this->db->get_where($this->cat_table, array('slug'=>$cat_slug))->result();
    		return $result[0]->cat_name;
    	}else {
    		return '';
    	}
    }
	
	function get_cat_by_slug($cat_slug = ''){
    	if(!empty($cat_slug)){
    		$result = $this->db->get_where($this->cat_table, array('slug'=>$cat_slug))->result();
    		return $result[0];
    	}else {
    		return null;
    	}
    }
	
	function is_exist_by_slug($cat_slug = ''){
    	if(!empty($cat_slug)){
    		$result = $this->db->get_where($this->cat_table, array('slug'=>$cat_slug))->result();
			
			if(empty($result[0]))
    		return false;
			
			return true;
    	}else {
    		return false;
    	}
    }
	
	function get_all_cat()
	{
		$query = $this->db->get($this->cat_table);
		return $query;
	}

	function update_cat(){
		 $data_decode = json_decode($_POST['data']);
		foreach($data_decode as $cat){
			$data = array(
               'name' => $cat -> name,
               'slug' => $cat -> slug,
               'typeid' => $cat -> typeid,
            );

			$this->db->where('id', $cat -> id);
			$this->db->update($this->cat_table, $data);
        }
		
		return true;
	}

	function delete_cat($cat_id){
		return $this->db->delete($this->cat_table,array('id'=>$cat_id));
	}

    /**
     * 查询每个类别对应的点击
     *
     * @return 查询结果
     */
	function query_cats(){
        
		$this->db->select('item.id,name,COUNT(item.id) as count, SUM(click_count) as sum');
		$where = "cid=cat.id";
		$this->db->join($this->cat_table,$where);
		$this->db->order_by('count DESC');
		$this->db->group_by('cid');
		$query = $this->db->get($this->item_table);
		return $query;
	}

	/**
	 * 获取某类别点击总数
	 *
	 * @param integer cid 类别的id
	 * @return integer 类别点击总数
	 */
	function click_count_by_cid($cid=0){
                $cat_table = $this->cat_table;
                $item_table = $this->item_table;
		if($cid == 0){
			$this->db->select('SUM(click_count) as sum');
			$query = $this->db->get($item_table);
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
	
	function clear_cat_by_cid($cid){
		
		$this->db->where("cid",$cid);
		
		$result = $this->db->delete($this->item_table);
		
		return $result;
	}
	
	function get_all_cat_by_typeid($typeid)
	{
		$this->db->where("typeid",$typeid);
		
		$result = $this->db->get($this->cat_table);
		
		return $result;
	}

}
