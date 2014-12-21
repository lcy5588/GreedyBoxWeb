<?php

class M_brand extends CI_Model{

        var $brand_table = '';
		var $cat_table = '';

	function __construct()
	{
		parent::__construct();
                $this->brand_table = $this->db->dbprefix('brand');
				$this->cat_table = $this->db->dbprefix('cat');
	}


	function add_brand($brand)
	{

            $data = array(
                           'name' =>$brand['name'],
                           'img_url' =>$brand['img_url'],
						   'click_url'=>$brand['click_url'],
						   'cid' => $brand['cid']
                        );
            return $this->db->insert($this->brand_table, $data);
    }


	function update_brand($brand){

			$data = array(
						'name' =>$brand['name'],
					    'img_url' =>$brand['img_url'],
					    'click_url'=>$brand['click_url'],
						'cid' => $brand['cid']
            );
			$this->db->where('id', $brand['id']);
			return $this->db->update($this->brand_table, $data);
	}

	function delete_brand($brand_id){
		return $this->db->delete($this->brand_table,array('id'=>$brand_id));
	}

    /**
     * 查询对应的点击
     *
     * @return 查询结果
     */
	function query_brands(){
        
		$this->db->select('name,click_count');
		$this->db->order_by('click_count DESC');
		$query = $this->db->get($this->item_table);
		return $query;
	}

	/**
	 * 获取某品牌点击总数
	 *
	 * @param integer cid 品牌的id
	 * @return integer 品牌点击总数
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
	*获取某品牌总数
	*/
	
	function get_all_brand($limit='9',$offset='0',$cat='')
	{

		//如果是分类页
		if(!empty($cat)){
			$where = "cid=cat_id AND cat_slug='".$cat."'";
			$this->db->join($this->cat_table,$where);
			$this->db->order_by('click_count DESC');
			$query = $this->db->get($this->brand_table,$limit,$offset);
			}
		//如果是主页
		else{
			$this->db->order_by("click_count", "desc");
			$query = $this->db->get($this->brand_table,$limit,$offset);
		}

		return $query;
	}
	
	/**
	*获取某品牌总数
	*/
	
	function get_all_brand_by_cid($limit='9',$offset='0',$cat=-1)
	{

		//如果是分类页
		if($cat >= 0){
			$this->db->where('cid',$cat);
			$this->db->order_by('click_count DESC');
			$query = $this->db->get($this->brand_table,$limit,$offset);
			}
		//如果是主页
		else{
			$this->db->order_by("click_count", "desc");
			$query = $this->db->get($this->brand_table,$limit,$offset);
		}

		return $query;
	}
	
	/**
	*获取某品牌
	*/
	
	function get_brand_by_id($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get($this->brand_table);
		
		if($query->num_rows()>0){
			$result = $query->result();
			return $result[0];
		}
		else{
		return null;
		}
	}
	
	function count_brand($cid=''){
		if(empty($cid)){
			return $this->db->count_all_results($this->brand_table);
		}else{
			$this->db->select('count(id) as count');
			$this->db->where('cid',$cid);
			$query = $this->db->get($this->brand_table);
			
			if($query->num_rows() > 0){
				$row = $query->row();
				return $row->count;
			}else{
				return 0;
			}
		}
	}
	
	function add_click_count($brandid){
		$this->db->set('click_count', 'click_count+1', FALSE);
		$this->db->where('id', $brandid);
		$this->db->update($this->brand_table); 
		return $brandid;
	}
	
	function get_brand_clickurl($brandid){
		$this->db->select('click_url');
		$this->db->where('id',$brandid);
		$query = $this->db->get($this->brand_table);
		
		if($query->num_rows() > 0){
			$row = $query->row();
			return $row->click_url;			
		}
		
		return null;
	}
}