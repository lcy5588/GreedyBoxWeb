<?php

class M_label extends CI_Model{

        var $label_table = '';
		var $cat_table = '';

	function __construct()
	{
		parent::__construct();
                $this->label_table = $this->db->dbprefix('label');
				$this->cat_table = $this->db->dbprefix('cat');
	}


	function add_label($label)
	{
		$data = array(
					   'title' =>$label['title'],
					   'slug'=>$label['slug'],
					   'cid' => $label['cid']
					);
		return $this->db->insert($this->label_table, $data);
    }


	function update_label($label){

			$data = array(
					   'title' =>$label['title'],
					   'slug'=>$label['slug'],
					   'cid' => $label['cid']
					);

			$this->db->where('id', $label['id']);
			return $this->db->update($this->label_table, $data);
	}
	
	function count_label($cid=''){
	
		if(empty($cid)){
			return $this->db->count_all_results($this->label_table);			
		}else{
			$this->db->select('count(id) as count');
			$this->db->where('cid',$cid);
			$query = $this->db->get($this->label_table);
			if ($query->num_rows() > 0)
				{
				   $row = $query->row();
				   return $row->count;
				}else{
					return 0;
				}
		}
	}

	function delete_label($label_id){
		return $this->db->delete($this->label_table,array('id'=>$label_id));
	}

    /**
     * 查询对应的点击
     *
     * @return 查询结果
     */
	function query_labels(){
        
		$this->db->select('title,click_count');
		$this->db->order_by('click_count DESC');
		$query = $this->db->get($this->item_table);
		return $query;
	}

	/**
	 * 获取某标签点击总数
	 *
	 * @param integer cid 标签的id
	 * @return integer 标签点击总数
	 */
	function click_count_by_id($id=0){
        $this->db->select('click_count as clickcount');
		$this->db->where('id',$id);
		$query = $this->db->get($this->item_table);
		if($query->num_rows()>0){
		$row = $query->row();
		return $row->clickcount;
	   }
	   
	   return 0;
	}
	
	/**
	*获取某标签总数
	*/
	
	function get_all_label($limit='9',$offset='0',$cat='')
	{

		if(!empty($cat)){
			$where = "cid=cat.id AND cat.slug='".$cat."'";
			$this->db->join($this->cat_table,$where);
			$this->db->order_by('click_count DESC');
			$query = $this->db->get($this->label_table,$limit,$offset);
			}
		else{
			$this->db->order_by("click_count", "desc");
			$query = $this->db->get($this->label_table,$limit,$offset);
		}

		return $query;
	}
	
	function get_all_label_by_cid($limit='9',$offset='0',$cat= -1)
	{

		if($cat >= 0){
			$this->db->where('cid',$cat);
			$this->db->order_by('click_count DESC');
			$query = $this->db->get($this->label_table,$limit,$offset);
			}
		else{
			$this->db->order_by("click_count", "desc");
			$query = $this->db->get($this->label_table,$limit,$offset);
		}

		return $query;
	}
	
	function get_label_by_id($id){
         $data = array(
                'id' => $id
             );
         $query = $this->db->get_where($this->label_table, $data);
         if($query->num_rows()>0){
         	$result = $query->result();
         	return $result[0];
         }else return null;
    }
	
	function get_labelid_by_slug($slug){
         $data = array(
                'slug' => $slug
             );
         $query = $this->db->get_where($this->label_table, $data);
         if($query->num_rows()>0){
         	$result = $query->result();
         	return $result[0]->id;
         }else return '';
    }
	
	function add_click_count($labelid){
		$this->db->set('click_count', 'click_count+1', FALSE);
		$this->db->where('id', $labelid);
		$this->db->update($this->label_table); 
		return $labelid;
	}
	
	// function get_label_clickurl($labelid){
		// $this->db->select('click_url');
		// $this->db->where('id',$labelid);
		// $query = $this->db->get($this->label_table);
		
		// if($query->num_rows() > 0){
			// $row = $query->row();
			// return $row->click_url;			
		// }
		
		// return null;
	// }
}
