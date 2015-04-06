<?php

class M_level extends CI_Model{

     var $level_table = '';	


	function __construct()
	{
		parent::__construct();
                $this->level_table = $this->db->dbprefix('level');           
	}


	function add_level()
	{
        $data_decode = json_decode($_POST['data']);
        foreach($data_decode as $level){
            $data = array(
                           'id' => $level -> id ,
                           'name' =>$level -> name,
                           'color' =>$level -> color
                        );
            $this->db->insert($this->level_table, $data);
        }
    }
	
	function add_level_by($level)
	{
            $data = array(
							'id' =>$level['id'],
                           'name' =>$level['name'],
                           'color' =>$level['color']
                        );
            return $this->db->insert($this->level_table, $data);
    }

    function get_level_name($level_id = ''){
    	if(!empty($level_id)){
    		$result = $this->db->get_where($this->level_table, array('id'=>$level_id))->result();
    		return $result[0]->name;
    	}else {
    		return '';
    	}
    }
	
	function get_level_color($level_id = ''){
    	if(!empty($level_id)){
    		$result = $this->db->get_where($this->level_table, array('id'=>$level_id))->result();
    		return $result[0]->color;
    	}else {
    		return '';
    	}
    }
	
	
	function get_all_level()
	{
		$query = $this->db->get($this->level_table);
		return $query;
	}

	function update_level(){
		 $data_decode = json_decode($_POST['data']);
		foreach($data_decode as $level){
			$data = array(
			   'id'  => $level->id,
               'name' => $level -> name,
               'color' => $level -> color
            );

			$this->db->where('id', $level -> id);
		    $this->db->update($this->level_table, $data);
        }
		
		return 1;
	}

	function delete_level($level_id){
		return $this->db->delete($this->level_table,array('id'=>$level_id));
	}

}
