<?php

class M_user extends CI_Model{

        var $user_table = '';
        var $cat_table = '';


	function __construct()
	{
		parent::__construct();
                $this->user_table = $this->db->dbprefix('user');
                $this->cat_table = $this->db->dbprefix('cat');
				
		date_default_timezone_set('prc');
	}


	function add_user()
	{
        $data_decode = json_decode($_POST['data']);
        foreach($data_decode as $user){
            $data = array(                                          
                           'name' =>$user -> name,
                           'email' =>$user -> email,
                           'avatar_url' =>$user -> avatar_url,
                           'open_id' =>$user -> open_id,
                           'access_token' => $user -> access_token,
                           'adddatetime' => date('YmdHis',time())
                        );
            $this->db->insert($this->user_table, $data);
        }
    }
	
	function add_user_by($user)
	{
            $data = array(
                           'name' =>$user['name'],
                           'email' =>$user['email'],
                           'avatar_url' =>$user['avatar_url'],
                           'open_id' =>$user['open_id'],
                           'access_token' =>$user['access_token'],
						   'adddatetime' => date('YmdHis',time())
                        );
            return $this->db->insert($this->user_table, $data);
    }

	
	function get_user_by_id($id = ''){
    	if(!empty($id)){
    		$result = $this->db->get_where($this->user_table, array('id'=>$id))->result();
			if(!empty($result))
				return $result[0];
			else
				return null;
    	}else {
    		return null;
    	}
    }
	
	function get_all_users($limit='40',$offset='0',$userid='',$keyword='',$sort = "adddatetime desc")
	{
		
		$where = '1=1';
		
		if(!empty($userid)){
			$where = $where." AND id = '".$userid."'";
			
		}
		
		if(!empty($keyword)){
			$where = $where." AND name like '%".$keyword."%'";
		}
		
		$this->db->where($where,NULL,FALSE);
		
		$this->db->order_by($sort);
		
		$query = $this->db->get($this->user_table,$limit,$offset);
		
		return $query;
	}

	function update_user($id){
		$data = array(
               'name' =>$_POST['name'],
			   'email' =>$_POST['email'],
			   'avatar_url' =>$_POST['avatar_url'],
			   'open_id' =>$_POST['open_id'],
			   'access_token' =>$_POST['access_token']
            );
		
		$this->db->where('id',$id);
		
		return $this->db->update('user',$data);
	}

	function update_user_by($user){
		$data = array(
                           'name' =>$user['name'],
                           'email' =>$user['email'],
                           'avatar_url' =>$user['avatar_url'],
                           'open_id' =>$user['open_id'],
                           'access_token' =>$user['access_token']
            );
            
        $this->db->where('id', $user['user_id']);
		return $this->db->update($this->user_table, $data);
	}
	
	function delete_user($user_id){
		return $this->db->delete($this->user_table,array('id'=>$user_id));
	}
	

	function count_users($userid="",$keyword=""){
			
		$this->db->select('COUNT(id) AS count');
		
		$where = '1=1';
		
		if(!empty($userid)){
			$where = $where." AND id ='".$userid."'";
		}
		
		if(!empty($keyword)){
			$where = $where." AND name like '%".$keyword."%'";
		}
		
		$this->db->where($where,NULL,FALSE);
		
		$query = $this->db->get($this->user_table);

		if ($query->num_rows() > 0)
		{
		   $row = $query->row();
		   return $row->count;
		}else{
			return 0;
		}
		
	}
}
