<?php

class M_friendlink extends CI_Model{

        var $friendlink_table = '';

	function __construct()
	{
		parent::__construct();
                $this->friendlink_table = $this->db->dbprefix('friendlink');
	}


	function add_friendlink($friendlink)
	{
		$data = array(
					   'name' =>$friendlink['name'],
					   'click_url'=>$friendlink['click_url'],
					   'type' => $friendlink['type'],
					   'img_url' => $friendlink['img_url']
					);
		return $this->db->insert($this->friendlink_table, $data);
    }


	function update_friendlink($friendlink){

			$data = array(
					   'name' =>$friendlink['name'],
					   'click_url'=>$friendlink['click_url'],
					   'img_url' => $friendlink['img_url'],
					   'type' => $friendlink['type']
					);

			$this->db->where('id', $friendlink['id']);
			return $this->db->update($this->friendlink_table, $data);
	}
	
	function count_friendlink($type=''){
	
		if(empty($type)){
			return $this->db->count_all_results($this->friendlink_table);			
		}else{
			$this->db->select('count(id) as count');
			$this->db->where('type',$type);
			$query = $this->db->get($this->friendlink_table);
			if ($query->num_rows() > 0)
				{
				   $row = $query->row();
				   return $row->count;
				}else{
					return 0;
				}
		}
	}

	function delete_friendlink($friendlink_id){
		return $this->db->delete($this->friendlink_table,array('id'=>$friendlink_id));
	}


	
	/**
	*获取某标签总数
	*/
		
	function get_all_friendlink_by_type($limit='9',$offset='0',$type= '')
	{

		if(!empty($type)){
			$this->db->where('type',$type);
			$this->db->order_by('id asc');
			$query = $this->db->get($this->friendlink_table,$limit,$offset);
			}
		else{
			$this->db->order_by("id", "asc");
			$query = $this->db->get($this->friendlink_table,$limit,$offset);
		}

		return $query;
	}
	
	function get_friendlink_by_id($id){
         $data = array(
                'id' => $id
             );
         $query = $this->db->get_where($this->friendlink_table, $data);
         if($query->num_rows()>0){
         	$result = $query->result();
         	return $result[0];
         }else return null;
    }

	
	function get_friendlink_clickurl($friendlinkid){
		$this->db->select('click_url');
		$this->db->where('id',$friendlinkid);
		$query = $this->db->get($this->friendlink_table);
		
		if($query->num_rows() > 0){
			$row = $query->row();
			return $row->click_url;			
		}
		
		return null;
	}
}