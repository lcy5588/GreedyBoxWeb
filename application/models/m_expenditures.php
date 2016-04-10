<?php

class M_expenditures extends CI_Model{

        var $expenditures_table = '';

	function __construct()
	{
		parent::__construct();
                $this->expenditures_table = $this->db->dbprefix('expenditures');
              
		date_default_timezone_set('prc');
	}


	function add_expenditure()
	{
        $data_decode = json_decode($_POST['data']);
        foreach($data_decode as $expenditure){
            $data = array(                     
                           'accountid' => $expenditure -> expenditure_accountid,
                           'money' => $expenditure -> expenditure_money,
                           'typeid' =>$expenditure -> expenditure_typeid,
                           'person' =>$expenditure -> expenditure_person,
                           'datetime' =>$expenditure -> expenditure_datetime,
                           'remark' =>$expenditure -> expenditure_remark
                        );
            $this->db->insert($this->expenditures_table, $data);
        }
    }
	
	function add_expenditure_by($expenditure)
	{
            $data = array(
                           'accountid' =>$expenditure['expenditure_accountid'],
                           'money' =>$expenditure['expenditure_money'],
                           'typeid' =>$expenditure['expenditure_typeid'],
                           'person' =>$expenditure['expenditure_person'],
                           'datetime' =>$expenditure['expenditure_datetime'],
                           'remark' =>$expenditure['expenditure_remark']
                        );
            return $this->db->insert($this->expenditures_table, $data);
    }

	
	function get_expenditure_by_id($id = ''){
    	if(!empty($id)){
			$this->db->select('expenditureid,accountid,money,typeid,person,datetime,remark');
    		$result = $this->db->get_where($this->expenditures_table, array('expenditureid'=>$id))->result();
			
			return $result[0];
			
    	}else {
    		return null;
    	}
    }
	
	function get_all_expenditures($limit='40',$offset='0',$accountid='',$typeid='',$sort = "datetime desc")
	{
		
		$where = '1=1';
		
		if(!empty($accountid)){
			$where = $where." AND accountid = '".$accountid."'";
			
		}
		
		if(!empty($typeid)){
			$where = $where." AND typeid = '".$typeid."'";
			
		}
		
		$this->db->where($where,NULL,FALSE);
		
		$this->db->order_by($sort);
		
		$query = $this->db->get($this->expenditures_table,$limit,$offset);
		
		return $query;
	}

	function update_expenditure(){
		 $data_decode = json_decode($_POST['data']);
		foreach($data_decode as $expenditure){
			 $data = array(                     
                           'accountid' => $expenditure -> expenditure_accountid,
                           'money' => $expenditure -> expenditure_money,
                           'typeid' =>$expenditure -> expenditure_typeid,
                           'person' =>$expenditure -> expenditure_person,
                           'datetime' =>$expenditure -> expenditure_datetime,
                           'remark' =>$expenditure -> expenditure_remark
                        );

			$this->db->where('expenditureid', $expenditure -> expenditure_id);
			$this->db->update($this->expenditures_table, $data);
        }
	}

	function update_expenditure_by($expenditure){
		$data = array(
					   'accountid' =>$expenditure['expenditure_accountid'],
					   'money' =>$expenditure['expenditure_money'],
					   'typeid' =>$expenditure['expenditure_typeid'],
					   'person' =>$expenditure['expenditure_person'],
					   'datetime' =>$expenditure['expenditure_datetime'],
					   'remark' =>$expenditure['expenditure_remark']
                        );
            
        $this->db->where('expenditureid', $expenditure['expenditure_id']);
		return $this->db->update($this->expenditures_table, $data);
	}
	
	function delete_expenditure($expenditure_id){
		return $this->db->delete($this->expenditures_table,array('expenditureid'=>$expenditure_id));
	}

    /**
     * 查询每个类别对应的点击
     *
     * @return 查询结果
     */
	function query_expenditures(){
        
		$this->db->select('cat.id,cat.name,labelid,label.title as title,COUNT(expenditure.id) as count, SUM(expenditure.click_count) as sum');
		
		$where = "cat.id=expenditure.cid";
		$this->db->join($this->cat_table,$where,'right');
		
		$where = "pagetype.id=cat.typeid and pagetype.identification='expenditure'";
		$this->db->join($this->pagetype_table,$where,'right');
		
		$where = "labelid=label.id";
		$this->db->join($this->label_table,$where,'left');
		
		$this->db->order_by('expenditure.cid DESC');
		$this->db->group_by(array('expenditure.cid','labelid'));
		$query = $this->db->get($this->expenditure_table);
		
		return $query;
	}

	function count_expenditures($accountid="",$typeid=""){
			
		$this->db->select('COUNT(id) AS count');
		
		$where = '1=1';
		
		if(!empty($accountid)){
			$where = $where." AND accountid ='".$accountid."'";
		}
		
		if(!empty($typeid)){
			$where = $where." AND typeid ='".$typeid."'";
		}
		
		$this->db->where($where,NULL,FALSE);
		
		$query = $this->db->get($this->expenditures_table);

		if ($query->num_rows() > 0)
		{
		   $row = $query->row();
		   return $row->count;
		}else{
			return 0;
		}
		
	}
}
