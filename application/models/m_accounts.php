<?php

class M_accounts extends CI_Model{

        var $accounts_table = '';
		var $accounttype_table = '';
		
	function __construct()
	{
		parent::__construct();
                $this->accountbooks_table = $this->db->dbprefix('accountbooks');
                $this->accounts_table = $this->db->dbprefix('accounts');
				$this->accounttype_table = $this->db->dbprefix('accounttype');
				
		date_default_timezone_set('prc');
	}


	function add_account()
	{
        $data_decode = json_decode($_POST['data']);
        foreach($data_decode as $account){
            $data = array(                     
                           'bookid' => $account -> book_id ,
                           'name' =>$account -> name,
                           'typeid' =>$account -> type_id,
                           'initmoney' =>$account -> init_money,
                           'remark' =>$account -> remark,
                           'color' => $account -> color
                        );
            $this->db->insert($this->accounts_table, $data);
        }
    }
	
	function add_article_by($account)
	{
            $data = array(
                           'bookid' =>$account['book_id'],
                           'name' =>$account['name'],
                           'typeid' =>$account['type_id'],
                           'initmoney' =>$account['init_money'],
                           'remark' =>$account['remark'],
                           'color' =>$account['color']
                        );
            return $this->db->insert($this->accounts_table, $data);
    }

	
	function get_account_by_id($id = ''){
    	if(!empty($id)){
			$this->db->select('accountid,bookid,name,typeid,initmoney,remark,color');
    		$result = $this->db->get_where($this->accounts_table, array('accountid'=>$id))->result();
			
			return $result[0];
			
    	}else {
    		return null;
    	}
    }
	
	function get_all_accounts($limit='40',$offset='0',$bookid='',$typeid='',$sort = "accountid desc")
	{
		
		$where = '1=1';
		
		if(!empty($bookid)){
			$where = $where." AND bookid = '".$bookid."'";
			
		}
		
		if(!empty($typeid)){
			$where = $where." AND typeid = '".$typeid."'";
			
		}
		
		$this->db->where($where,NULL,FALSE);
		
		$this->db->order_by($sort);
		
		$query = $this->db->get($this->accounts_table,$limit,$offset);
		
		return $query;
	}

	function update_account(){
		 $data_decode = json_decode($_POST['data']);
		foreach($data_decode as $account){
			$data = array(                     
                           'bookid' => $account -> book_id ,
                           'name' =>$account -> name,
                           'typeid' =>$account -> type_id,
                           'initmoney' =>$account -> init_money,
                           'remark' =>$account -> remark,
                           'color' => $account -> color
                        );

			$this->db->where('accountid', $account -> account_id);
			$this->db->update($this->accounts_table, $data);
        }
	}

	function update_account_by($account){
		$data = array(
                           'bookid' =>$account['book_id'],
                           'name' =>$account['name'],
                           'typeid' =>$account['type_id'],
                           'initmoney' =>$account['init_money'],
                           'remark' =>$account['remark'],
                           'color' =>$account['color']
                        );
            
        $this->db->where('accountid', $account['account_id']);
		return $this->db->update($this->accounts_table, $data);
	}
	
	function delete_account($account_id){
		return $this->db->delete($this->accounts_table,array('accountid'=>$account_id));
	}

	
	function clear_account_by_bookid($bookid){
		
		$this->db->where("bookid",$bookid);
		
		$result = $this->db->delete($this->accounts_table);
		
		return $result;
	}

	function count_accounts($bookid="",$typeid=""){
			
		$this->db->select('COUNT(accountid) AS count');
		
		$where = '1=1';
		
		if(!empty($bookid)){
			$where = $where." AND bookid ='".$bookid."'";
		}
		
		if(!empty($typeid)){
			$where = $where." AND typeid ='".$typeid."'";
		}
		
		
		$this->db->where($where,NULL,FALSE);
		
		$query = $this->db->get($this->accounts_table);

		if ($query->num_rows() > 0)
		{
		   $row = $query->row();
		   return $row->count;
		}else{
			return 0;
		}
		
	}
}
