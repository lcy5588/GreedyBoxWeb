<?php

class M_accounttype extends CI_Model{

     var $accounttype_table = '';	


	function __construct()
	{
		parent::__construct();
                $this->accounttype_table = $this->db->dbprefix('accounttype');           
	}


	function add_accounttype()
	{
        $data_decode = json_decode($_POST['data']);
        foreach($data_decode as $accounttype){
            $data = array(
                           'name' =>$accounttype -> name
                        );
            $this->db->insert($this->accounttype_table, $data);
        }
    }
	
	function add_accounttype_by($accounttype)
	{
            $data = array(
                           'name' =>$accounttype['name']
                        );
            return $this->db->insert($this->accounttype_table, $data);
    }

	function get_accounttype($accounttype_id = ''){
    	if(!empty($accounttype_id)){
    		$result = $this->db->get_where($this->accounttype_table, array('typeid'=>$accounttype_id))->result();
    		return $result[0];
    	}else {
    		return null;
    	}
    }
	
    function get_accounttype_name($accounttype_id = ''){
    	if(!empty($accounttype_id)){
    		$result = $this->db->get_where($this->accounttype_table, array('typeid'=>$accounttype_id))->result();
    		return $result[0]->name;
    	}else {
    		return '';
    	}
    }
	
	function get_all_accounttype()
	{
		$query = $this->db->get($this->accounttype_table);
		return $query;
	}

	function update_accounttype(){
		 $data_decode = json_decode($_POST['data']);
		foreach($data_decode as $accounttype){
			$data = array(
               'name' => $accounttype -> name
            );

			$this->db->where('typeid', $accounttype -> typeid);
			$this->db->update($this->accounttype_table, $data);
        }
		
		return '1';
	}

	function delete_accounttype($accounttype_id){
		return $this->db->delete($this->accounttype_table,array('typeid'=>$accounttype_id));
	}
}
