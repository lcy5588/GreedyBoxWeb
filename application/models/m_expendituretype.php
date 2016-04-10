<?php

class M_expendituretype extends CI_Model{

     var $expendituretype_table = '';	


	function __construct()
	{
		parent::__construct();
                $this->expendituretype_table = $this->db->dbprefix('expendituretype');           
	}


	function add_expendituretype()
	{
        $data_decode = json_decode($_POST['data']);
        foreach($data_decode as $expendituretype){
            $data = array(
                           'name' =>$expendituretype -> name,
						   'icon' =>$expendituretype -> icon
                        );
            $this->db->insert($this->expendituretype_table, $data);
        }
    }
	
	function add_expendituretype_by($expendituretype)
	{
            $data = array(
                           'name' =>$expendituretype['name'],
						   'icon' =>$expendituretype['icon']
                        );
            return $this->db->insert($this->expendituretype_table, $data);
    }

	function get_expendituretype($expendituretype_id = ''){
    	if(!empty($expendituretype_id)){
    		$result = $this->db->get_where($this->expendituretype_table, array('typeid'=>$expendituretype_id))->result();
    		return $result[0];
    	}else {
    		return null;
    	}
    }
	
    function get_expendituretype_name($expendituretype_id = ''){
    	if(!empty($expendituretype_id)){
    		$result = $this->db->get_where($this->expendituretype_table, array('typeid'=>$expendituretype_id))->result();
    		return $result[0]->name;
    	}else {
    		return '';
    	}
    }
	
	function get_all_expendituretype()
	{
		$query = $this->db->get($this->expendituretype_table);
		return $query;
	}

	function update_expendituretype(){
		 $data_decode = json_decode($_POST['data']);
		foreach($data_decode as $expendituretype){
			$data = array(
               'name' => $expendituretype -> name,
			   'icon' => $expendituretype -> icon
            );

			$this->db->where('typeid', $expendituretype -> typeid);
			$this->db->update($this->expendituretype_table, $data);
        }
		
		return '1';
	}

	function delete_expendituretype($expendituretype_id){
		return $this->db->delete($this->expendituretype_table,array('typeid'=>$expendituretype_id));
	}
}
