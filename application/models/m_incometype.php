<?php

class M_incometype extends CI_Model{

     var $incometype_table = '';	


	function __construct()
	{
		parent::__construct();
                $this->incometype_table = $this->db->dbprefix('incometype');           
	}


	function add_incometype()
	{
        $data_decode = json_decode($_POST['data']);
        foreach($data_decode as $incometype){
            $data = array(
                           'name' =>$incometype -> name,
						   'icon' =>$incometype -> icon
                        );
            $this->db->insert($this->incometype_table, $data);
        }
    }
	
	function add_incometype_by($incometype)
	{
            $data = array(
                           'name' =>$incometype['name'],
						   'icon' =>$incometype['icon']
                        );
            return $this->db->insert($this->incometype_table, $data);
    }

	function get_incometype($incometype_id = ''){
    	if(!empty($incometype_id)){
    		$result = $this->db->get_where($this->incometype_table, array('typeid'=>$incometype_id))->result();
    		return $result[0];
    	}else {
    		return null;
    	}
    }
	
    function get_incometype_name($incometype_id = ''){
    	if(!empty($incometype_id)){
    		$result = $this->db->get_where($this->incometype_table, array('typeid'=>$incometype_id))->result();
    		return $result[0]->name;
    	}else {
    		return '';
    	}
    }
	
	function get_all_incometype()
	{
		$query = $this->db->get($this->incometype_table);
		return $query;
	}

	function update_incometype(){
		 $data_decode = json_decode($_POST['data']);
		foreach($data_decode as $incometype){
			$data = array(
               'name' => $incometype -> name,
			   'icon' => $incometype -> icon
            );

			$this->db->where('typeid', $incometype -> typeid);
			$this->db->update($this->incometype_table, $data);
        }
		
		return '1';
	}

	function delete_incometype($incometype_id){
		return $this->db->delete($this->incometype_table,array('typeid'=>$incometype_id));
	}
}
