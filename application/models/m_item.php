<?php

class M_item extends CI_Model{

        var $cat_table = '';
        var $item_table = '';
		var $label_table = '';
		var $pagetype_table = '';

	function __construct()
	{
		parent::__construct();
        $this->cat_table = $this->db->dbprefix('cat');
        $this->item_table = $this->db->dbprefix('item');
		$this->label_table = $this->db->dbprefix('label');
		$this->pagetype_table = $this->db->dbprefix('pagetype');
		
		date_default_timezone_set('prc');
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
			   'comment' => $_POST['comment'],
			   'excitablelevel' => $_POST['excitablelevel'],
			   'comfortablelevel' => $_POST['comfortablelevel'],
			   'sexlevel' => $_POST['sexlevel']
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
			   'comment' => $_POST['comment'],
			   'excitablelevel' => $_POST['excitablelevel'],
			   'comfortablelevel' => $_POST['comfortablelevel'],
			   'sexlevel' => $_POST['sexlevel']
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
	function get_all_item($limit='40',$offset='0',$cid='',$labelid='',$keyword='',$sort='adddatetime desc')
	{
		$where = '1=1';
		
		if(!empty($cid)){
			$where = $where." AND cid= '".$cid."'";
		}
		
		if(!empty($labelid)){
			$where = $where." AND item.labelid = '".$labelid."'";
			
		}
		
		if(!empty($keyword)){
			$where = $where." AND item.title like '%".$keyword."%'";
		}
		
		$this->db->where($where,NULL,FALSE);
		
		$this->db->order_by($sort);
		
		$query = $this->db->get($this->item_table,$limit,$offset);

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
	 * @param string cid 类别的cid
	 * @return integer 类别的数目
	 */
	function count_items($cid='',$labelid="",$keyword=""){
		
			$this->db->select('COUNT(item.id) AS count');
			
			$where = '1=1';
			
			if(!empty($cid)){
				$where = $where." AND cid= '".$cid."'";
			}
			
			if(!empty($labelid)){
				$where = $where." AND item.labelid = ".$labelid;
			}
			
			if(!empty($keyword)){
				$where = $where." AND item.title like '%".$keyword."%'";
			}
			
			$this->db->where($where,NULL,FALSE);
			
			$query = $this->db->get($this->item_table);

			if ($query->num_rows() > 0)
			{
			   $row = $query->row();
			   return $row->count;
			}else{
				return 0;
			}
		
	}
	
	/**
	 * 获取某类别点击总数
	 *
	 * @param integer cid 类别的id
	 * @return integer 类别点击总数
	 */
	function click_count_by_cid($cid=0){
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
     * 查询每个类别对应的点击
     *
     * @return 查询结果
     */
	function query_items(){
        
		$this->db->select('cat.id,cat.name,labelid,label.title as title,COUNT(item.id) as count, SUM(item.click_count) as sum');
		
		$where = "cat.id=item.cid";
		$this->db->join($this->cat_table,$where,'right');
		
		$where = "pagetype.id=cat.typeid and pagetype.identification='item'";
		$this->db->join($this->pagetype_table,$where,'right');
		
		$where = "labelid=label.id";
		$this->db->join($this->label_table,$where,'left');
		
		$this->db->order_by('item.cid DESC');
		$this->db->group_by(array('item.cid','labelid'));
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

	function get_item_status($startdays,$enddays){
		$startday = mktime(date("h"), date("i"), date("s"), date("m"), date("d") - $startdays, date("Y"));
		$endday = mktime(date("h"), date("i"), date("s"), date("m"), date("d") - $enddays, date("Y"));
		
		$this->db->select("count(id) as count,sum(click_count) as sum");
		
		$this->db->where("adddatetime <= ",date('YmdHis',$startday));
		$this->db->where("adddatetime > ",date('YmdHis',$endday));
		
		$query = $this->db->get($this->item_table);
		
		if($query->num_rows()>0){
			$result = $query->result();
			return $result[0];        
		}else 
			return null;
	}
	
	function delete_overdays($startdays,$enddays){
		$startday = mktime(date("h"), date("i"), date("s"), date("m"), date("d") - $startdays, date("Y"));
		$endday = mktime(date("h"), date("i"), date("s"), date("m"), date("d") - $enddays, date("Y"));
		
		$this->db->where("adddatetime <= ",date('YmdHis',$startday));
		$this->db->where("adddatetime > ",date('YmdHis',$endday));
		
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
	
	function grade_excitablenum($id){
		$this->db->where('id',$id);
		
		$this->db->set('excitablenum',"excitablenum + 1", FALSE);
		
		$this->db->update($this->item_table);
		
		return $id;
	}
	
	function grade_comfortablenum($id){
		$this->db->where('id',$id);
		
		$this->db->set('comfortablenum',"comfortablenum + 1", FALSE);
		
		$this->db->update($this->item_table);
		
		return $id;
	}
	
	function grade_sexnum($id){
		$this->db->where('id',$id);
		
		$this->db->set('sexnum',"sexnum + 1", FALSE);
		
		$this->db->update($this->item_table);
		
		return $id;
	}
	
	function get_excitablenum($id){
		$this->db->select('excitablenum');
		$this->db->where('id',$id);
		
		$query = $this->db->get_where($this->item_table);
		
		if($query->num_rows()>0){
			foreach($query->result() as $array){
				$excitablenum = $array->excitablenum;
				return $excitablenum;
			}
		}else return 0;
	}
	
	function get_comfortablenum($id){
		$this->db->select('comfortablenum');
		$this->db->where('id',$id);
		
		$query = $this->db->get_where($this->item_table);
		
		if($query->num_rows()>0){
			foreach($query->result() as $array){
				$comfortablenum = $array->comfortablenum;
				return $comfortablenum;
			}
		}else return 0;
	}
	
	function get_sexnum($id){
		$this->db->select('sexnum');
		$this->db->where('id',$id);
		
		$query = $this->db->get_where($this->item_table);
		
		if($query->num_rows()>0){
			foreach($query->result() as $array){
				$sexnum = $array->sexnum;
				return $sexnum;
			}
		}else return 0;
	}
	
	function get_excitablelevel($id){
		$this->db->select('excitablelevel');
		$this->db->where('id',$id);
		
		$query = $this->db->get_where($this->item_table);
		
		if($query->num_rows()>0){
			foreach($query->result() as $array){
				$excitablelevel = $array->excitablelevel;
				return $excitablelevel;
			}
		}else return 0;
	}
	
	function get_comfortablelevel($id){
		$this->db->select('comfortablelevel');
		$this->db->where('id',$id);
		
		$query = $this->db->get_where($this->item_table);
		
		if($query->num_rows()>0){
			foreach($query->result() as $array){
				$comfortablelevel = $array->comfortablelevel;
				return $comfortablelevel;
			}
		}else return 0;
	}
	
	function get_sexlevel($id){
		$this->db->select('sexlevel');
		$this->db->where('id',$id);
		
		$query = $this->db->get_where($this->item_table);
		
		if($query->num_rows()>0){
			foreach($query->result() as $array){
				$sexlevel = $array->sexlevel;
				return $sexlevel;
			}
		}else return 0;
	}
	
	function grade_excitablelevel($id,$score){
		$this->grade_excitablenum($id);
		
		$newnum = $this->get_excitablenum($id);
		
		$this->db->where('id',$id);
		$str = "(excitablelevel * ".strval($newnum-1)."+".strval($score).")/".strval($newnum);
		
		$this->db->set('excitablelevel',$str, FALSE);
		
		$this->db->update($this->item_table);
		
		return $id;
		
	}
	
	function grade_comfortablelevel($id,$score){
		$this->grade_comfortablenum($id);
		
		$newnum = $this->get_comfortablenum($id);
		
		$this->db->where('id',$id);
		
		$str = "(comfortablelevel * ".strval($newnum-1)."+".strval($score).")/".strval($newnum);
		
		$this->db->set('comfortablelevel',$str, FALSE);
		
		
		$this->db->update($this->item_table);
		
		return $id;
	}
	
	function grade_sexlevel($id,$score){
		$this->grade_sexnum($id);
		
		$newnum = $this->get_sexnum($id);
		
		$this->db->where('id',$id);
		
		$str = "(sexlevel * ".strval($newnum-1)."+".strval($score).")/".strval($newnum);
		
		$this->db->set('sexlevel',$str, FALSE);
		
		$this->db->update($this->item_table);
		
		return $id;
	}
	
	function avg_gradelevel($id){
		$sexscore = $this->get_sexlevel($id);
		$excitablelescore = $this->get_excitablelevel($id);
		$comfortablescore = $this->get_comfortablelevel($id);
		
		return (floatval($sexscore) + floatval($excitablelescore) + floatval($comfortablelevel)) / 3;
	}
	
	
}
