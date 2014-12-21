<?php

class M_banner extends CI_Model{

        var $banner_table = '';
		var $cat_table = '';

	function __construct()
	{
		parent::__construct();
                $this->banner_table = $this->db->dbprefix('banner');
				$this->cat_table = $this->db->dbprefix('cat');
	}


	
	function add_banner($data_decode)
	{
            
		return $this->db->insert($this->banner_table, $data_decode);
    }

	
	function update_banner($data_decode){
	

		$this->db->where('id', $data_decode['id']);
		return $this->db->update($this->banner_table, $data_decode);
       
	}

	function get_banner_by_id($banner_id){
		$data = array(
                'id' => $banner_id
             );
         $query = $this->db->get_where($this->banner_table, $data);
         if($query->num_rows()>0){
         	$result = $query->result();
         	return $result[0];
         }else return null;
	}
	
	function delete_banner($banner_id){
		return $this->db->delete($this->banner_table,array('id'=>$banner_id));
	}

    
	
	/**
	*获取全部横幅图片
	*/
	
	function get_all_banner($limit='50',$offset='0')
	{
		$this->db->order_by("id", "desc");
		$query = $this->db->get($this->banner_table,$limit,$offset);
	
		return $query;
	}

}