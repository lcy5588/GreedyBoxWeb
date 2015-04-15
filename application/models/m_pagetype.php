<?php

class M_pagetype extends CI_Model{

     var $pagetype_table = '';	


	function __construct()
	{
		parent::__construct();
                $this->pagetype_table = $this->db->dbprefix('pagetype');           
	}


	function add_pagetype()
	{
        $data_decode = json_decode($_POST['data']);
        foreach($data_decode as $pagetype){
            $data = array(
                           'id' => $pagetype -> id ,
                           'name' =>$pagetype -> name,
                           'listview' =>$pagetype -> listview,
                           'contentview' => $pagetype -> contentview,
						   'identification' => $pagetype -> identification
                        );
            $this->db->insert($this->pagetype_table, $data);
        }
    }
	
	function add_pagetype_by($pagetype)
	{
            $data = array(
                           'id' => $pagetype['id'] ,
                           'name' =>$pagetype['name'],
                           'listview' =>$pagetype['listview'],
                           'contentview' => $pagetype['contentview'],
						   'identification' => $pagetype['identification']
                        );
            return $this->db->insert($this->pagetype_table, $data);
    }

	function get_pagetype($pagetype_id = ''){
    	if(!empty($pagetype_id)){
    		$result = $this->db->get_where($this->pagetype_table, array('id'=>$pagetype_id))->result();
    		return $result[0];
    	}else {
    		return null;
    	}
    }
	
    function get_pagetype_name($pagetype_id = ''){
    	if(!empty($pagetype_id)){
    		$result = $this->db->get_where($this->pagetype_table, array('id'=>$pagetype_id))->result();
    		return $result[0]->name;
    	}else {
    		return '';
    	}
    }
	
	function get_pagetype_listview($pagetype_id = ''){
    	if(!empty($pagetype_id)){
    		$result = $this->db->get_where($this->pagetype_table, array('id'=>$pagetype_id))->result();
    		return $result[0]->listview;
    	}else {
    		return '';
    	}
    }
	
	function get_pagetype_contentview($pagetype_id = ''){
    	if(!empty($pagetype_id)){
    		$result = $this->db->get_where($this->pagetype_table, array('id'=>$pagetype_id))->result();
    		return $result[0]->contentview;
    	}else {
    		return '';
    	}
    }
	
	function get_pagetype_identification($pagetype_id = ''){
    	if(!empty($pagetype_id)){
    		$result = $this->db->get_where($this->pagetype_table, array('id'=>$pagetype_id))->result();
    		return $result[0]->identification;
    	}else {
    		return '';
    	}
    }
	
	function get_all_pagetype()
	{
		$query = $this->db->get($this->pagetype_table);
		return $query;
	}

	function update_pagetype(){
		 $data_decode = json_decode($_POST['data']);
		foreach($data_decode as $pagetype){
			$data = array(
               'name' => $pagetype -> name,
               'listview' => $pagetype -> listview,
			   'contentview' => $pagetype -> contentview,
			   'identification' => $pagetype -> identification
            );

			$this->db->where('id', $pagetype -> id);
			$this->db->update($this->pagetype_table, $data);
        }
		
		return '1';
	}

	function delete_pagetype($pagetype_id){
		return $this->db->delete($this->pagetype_table,array('id'=>$pagetype_id));
	}

}
