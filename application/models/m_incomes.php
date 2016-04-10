<?php

class M_incomes extends CI_Model{

        var $incomes_table = '';

	function __construct()
	{
		parent::__construct();
                $this->incomes_table = $this->db->dbprefix('incomes');
              
		date_default_timezone_set('prc');
	}


	function add_income()
	{
        $data_decode = json_decode($_POST['data']);
        foreach($data_decode as $income){
            $data = array(                     
                           'accountid' => $income -> income_accountid,
                           'money' => $income -> income_money,
                           'typeid' =>$income -> income_typeid,
                           'person' =>$income -> income_person,
                           'datetime' =>$income -> income_datetime,
                           'remark' =>$income -> income_remark
                        );
            $this->db->insert($this->incomes_table, $data);
        }
    }
	
	function add_income_by($income)
	{
            $data = array(
                           'accountid' =>$income['income_accountid'],
                           'money' =>$income['income_money'],
                           'typeid' =>$income['income_typeid'],
                           'person' =>$income['income_person'],
                           'datetime' =>$income['income_datetime'],
                           'remark' =>$income['income_remark']
                        );
            return $this->db->insert($this->incomes_table, $data);
    }

	
	function get_income_by_id($id = ''){
    	if(!empty($id)){
			$this->db->select('incomeid,accountid,money,typeid,person,datetime,remark');
    		$result = $this->db->get_where($this->incomes_table, array('incomeid'=>$id))->result();
			
			return $result[0];
			
    	}else {
    		return null;
    	}
    }
	
	function get_all_incomes($limit='40',$offset='0',$accountid='',$typeid='',$sort = "datetime desc")
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
		
		$query = $this->db->get($this->incomes_table,$limit,$offset);
		
		return $query;
	}

	function update_income(){
		 $data_decode = json_decode($_POST['data']);
		foreach($data_decode as $income){
			 $data = array(                     
                           'accountid' => $income -> income_accountid,
                           'money' => $income -> income_money,
                           'typeid' =>$income -> income_typeid,
                           'person' =>$income -> income_person,
                           'datetime' =>$income -> income_datetime,
                           'remark' =>$income -> income_remark
                        );

			$this->db->where('incomeid', $income -> income_id);
			$this->db->update($this->incomes_table, $data);
        }
	}

	function update_income_by($income){
		$data = array(
					   'accountid' =>$income['income_accountid'],
					   'money' =>$income['income_money'],
					   'typeid' =>$income['income_typeid'],
					   'person' =>$income['income_person'],
					   'datetime' =>$income['income_datetime'],
					   'remark' =>$income['income_remark']
                        );
            
        $this->db->where('incomeid', $income['income_id']);
		return $this->db->update($this->incomes_table, $data);
	}
	
	function delete_income($income_id){
		return $this->db->delete($this->incomes_table,array('incomeid'=>$income_id));
	}

    /**
     * 查询每个类别对应的点击
     *
     * @return 查询结果
     */
	function query_incomes(){
        
		$this->db->select('cat.id,cat.name,labelid,label.title as title,COUNT(income.id) as count, SUM(income.click_count) as sum');
		
		$where = "cat.id=income.cid";
		$this->db->join($this->cat_table,$where,'right');
		
		$where = "pagetype.id=cat.typeid and pagetype.identification='income'";
		$this->db->join($this->pagetype_table,$where,'right');
		
		$where = "labelid=label.id";
		$this->db->join($this->label_table,$where,'left');
		
		$this->db->order_by('income.cid DESC');
		$this->db->group_by(array('income.cid','labelid'));
		$query = $this->db->get($this->income_table);
		
		return $query;
	}

	function count_incomes($accountid="",$typeid=""){
			
		$this->db->select('COUNT(id) AS count');
		
		$where = '1=1';
		
		if(!empty($accountid)){
			$where = $where." AND accountid ='".$accountid."'";
		}
		
		if(!empty($typeid)){
			$where = $where." AND typeid ='".$typeid."'";
		}
		
		$this->db->where($where,NULL,FALSE);
		
		$query = $this->db->get($this->incomes_table);

		if ($query->num_rows() > 0)
		{
		   $row = $query->row();
		   return $row->count;
		}else{
			return 0;
		}
		
	}
}
