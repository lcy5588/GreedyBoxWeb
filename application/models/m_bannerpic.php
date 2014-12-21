<?php

class M_bannerpic extends CI_Model{

        var $bannerpic_table = '';
		var $cat_table = '';

	function __construct()
	{
		parent::__construct();
                $this->bannerpic_table = $this->db->dbprefix('bannerpic');
				$this->cat_table = $this->db->dbprefix('cat');
	}


	function add_bannerpic($bannerpic)
	{
            $data = array(
                           'name' =>$bannerpic['name'],
                           'img_url' =>$bannerpic['img_url'],
						   'click_url'=>$bannerpic['click_url'],
						   'type' => $bannerpic['type'],
						   'isDisable' => $bannerpic['isDisable'],						  
						   'startdatetime' => $bannerpic['startdatetime'],
						   'enddatetime' => $bannerpic['enddatetime']
                        );
            return $this->db->insert($this->bannerpic_table, $data);
    }


	function update_bannerpic($bannerpic){
		
			$data = array(
						'name' =>$bannerpic['name'],
                           'img_url' =>$bannerpic['img_url'],
						   'click_url'=>$bannerpic['click_url'],
						   'type' => $bannerpic['type'],
						   'isDisable' => $bannerpic['isDisable'],						
						   'startdatetime' => $bannerpic['startdatetime'],
						   'enddatetime' => $bannerpic['enddatetime']
            );

			$this->db->where('id', $bannerpic['id']);
			return $this->db->update($this->bannerpic_table, $data);
	}

	function delete_bannerpic($bannerpic_id){
		return $this->db->delete($this->bannerpic_table,array('id'=>$bannerpic_id));
	}

    /**
     * 查询对应的点击
     *
     * @return 查询结果
     */
	function query_bannerpics(){
        
		$this->db->select('name,click_count');
		$this->db->order_by('click_count DESC');
		$query = $this->db->get($this->bannerpic_table);
		return $query;
	}

	/**
	 * 获取某横幅图片点击总数
	 *
	 * @param integer cid 横幅图片的id
	 * @return integer 横幅图片点击总数
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
	*获取正在使用的横幅图片
	*/
	
	function get_all_undisable_bannerpic($limit='9',$offset='0')
	{

		$this->db->where("isDisable","0");
		$this->db->order_by("type", "asc");
		$query = $this->db->get($this->bannerpic_table,$limit,$offset);
	
		return $query;
	}
	
		/**
	*获取全部横幅图片
	*/
	
	function get_all_bannerpic($limit='50',$offset='0')
	{
		$this->db->order_by("type", "asc");
		$this->db->order_by("isDisable", "asc");
		$query = $this->db->get($this->bannerpic_table,$limit,$offset);
	
		return $query;
	}
	
	function count_bannerpic($type=''){
		if(empty($type)){
			return $this->db->count_all_results($this->bannerpic_table);
		}else{

			$this->db->select('COUNT(id) AS count');
			$this->db->where('type',$type);
			$this->db->order_by('enddatetime DESC');
			$query = $this->db->get($this->bannerpic_table);

			if ($query->num_rows() > 0)
			{
			   $row = $query->row();
			   return $row->count;
			}else{
				return 0;
			}
		}
	}
	
	function get_all_bannerpic_by_type($type){
		$this->db->select('id,name,img_url as imgurl');
		$this->db->where('type',$type);
		$this->db->where('isDisable','0');
		$this->db->order_by('enddatetime DESC');
		return $this->db->get($this->bannerpic_table);
	}
	
	function get_bannerpic_by_id($id){
		$this->db->where('id',$id);
		$query = $this->db->get($this->bannerpic_table);
		
		if($query->num_rows()>0){
			$result = $query->result();
			return $result[0];
		}else{
		return null;
		}
	}
	
	/*循环获取横幅图片*/
	function get_bannerpic_loop_by_type($index,$type){		
		$this->db->select('id,name,img_url as imgurl');
		$this->db->where('type',$type);
		$this->db->where('isDisable','0');
		$this->db->order_by('enddatetime DESC');
		$query = $this->db->get($this->bannerpic_table);
		
		if($query->num_rows() > 0){
			$row = $query->num_rows();
			
			$realindex = $row % $index;
			
			if($realindex == 0){
				$realindex = $row;
			}
			
			return $query->row($realindex);
		}
		 
		return null;
	}
	
		
	function add_click_count($bannerpicid){
		$this->db->set('click_count', 'click_count+1', FALSE);
		$this->db->where('id', $bannerpicid);
		$this->db->update($this->bannerpic_table); 
		return $bannerpicid;
	}
	
	function get_bannerpic_clickurl($bannerpicid){
		$this->db->select('click_url');
		$this->db->where('id',$bannerpicid);
		$query = $this->db->get($this->bannerpic_table);
		
		if($query->num_rows() > 0){
			$row = $query->row();
			return $row->click_url;			
		}
		
		return null;
	}
}