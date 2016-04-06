<?php

class M_accountbooks extends CI_Model{

        var $accountbooks_table = '';
		
	function __construct()
	{
		parent::__construct();
                $this->accountbooks_table = $this->db->dbprefix('accountbooks');
                
		date_default_timezone_set('prc');
	}


	function add_accountbook()
	{
        $data_decode = json_decode($_POST['data']);
        foreach($data_decode as $book){
            $data = array(                     
                           'name' => $book -> name 
                        );
            $this->db->insert($this->accountbooks_table, $data);
        }
    }
	
	function add_article_by($book)
	{
            $data = array(
                           'name' =>$book['name']
                        );
            return $this->db->insert($this->accountbooks_table, $data);
    }

	
	function get_accountbook_by_id($id = ''){
    	if(!empty($id)){
			$this->db->select('bookid,name');
    		$result = $this->db->get_where($this->accountbooks_table, array('bookid'=>$id))->result();
			
			return $result[0];
			
    	}else {
    		return null;
    	}
    }
	
	function get_all_accountbooks()
	{
		$query = $this->db->get($this->accountbooks_table);
		
		return $query;
	}

	function update_accountbook(){
		 $data_decode = json_decode($_POST['data']);
		foreach($data_decode as $book){
			$data = array(
                           'name' => $book -> name 
            );

			$this->db->where('bookid', $book -> book_id);
			$this->db->update($this->accountbooks_table, $data);
        }
	}

	function update_article_by($book){
		$data = array(
                           'name' =>$book['name']
            );
            
        $this->db->where('bookid', $book['book_id']);
		return $this->db->update($this->accountbooks_table, $data);
	}
	
	function delete_accountbook($book_id){
		return $this->db->delete($this->accountbooks_table,array('bookid'=>$book_id));
	}

	function count_accountbooks(){
			
		$this->db->select('COUNT(bookid) AS count');
		
		$query = $this->db->get($this->accountbooks_table);

		if ($query->num_rows() > 0)
		{
		   $row = $query->row();
		   return $row->count;
		}else{
			return 0;
		}
		
	}
}
