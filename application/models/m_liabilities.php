<?php

class M_liabilities extends CI_Model{

        var $liabilities_table = '';

	function __construct()
	{
		parent::__construct();
                $this->liabilities_table = $this->db->dbprefix('liabilities');
              
		date_default_timezone_set('prc');
	}


	function add_liabilitie()
	{
        $data_decode = json_decode($_POST['data']);
        foreach($data_decode as $liabilitie){
            $data = array(                     
                           'name' => $liabilitie -> liabilitie_name,
                           'totalcost' => $liabilitie -> liabilitie_totalcost,
                           'unitexpenditure' =>$liabilitie -> liabilitie_unitexpenditure,
                           'adddatetime' =>$liabilitie -> liabilitie_adddatetime,
                           'deldatetime' =>$liabilitie -> liabilitie_deldatetime,
                           'caldatetime' =>$liabilitie -> liabilitie_caldatetime,
                           'isauto' =>$liabilitie -> liabilitie_isauto
                        );
            $this->db->insert($this->liabilities_table, $data);
        }
    }
	
	function add_liabilitie_by($liabilitie)
	{
            $data = array(
                           'name' =>$liabilitie['liabilitie_name'],
                           'totalcost' =>$liabilitie['liabilitie_totalcost'],
                           'unitexpenditure' =>$liabilitie['liabilitie_unitexpenditure'],
                           'adddatetime' =>$liabilitie['liabilitie_adddatetime'],
                           'deldatetime' =>$liabilitie['liabilitie_deldatetime'],
                           'caldatetime' =>$liabilitie['liabilitie_caldatetime'],
                           'isauto' =>$liabilitie['liabilitie_isauto']
                        );
            return $this->db->insert($this->liabilities_table, $data);
    }

	
	function get_liabilitie_by_id($id = ''){
    	if(!empty($id)){
			$this->db->select('name,totalcost,unitexpenditure,adddatetime,deldatetime,caldatetime,isauto');
    		$result = $this->db->get_where($this->liabilities_table, array('liabilitieid'=>$id))->result();
			
			return $result[0];
			
    	}else {
    		return null;
    	}
    }
	
	function get_all_liabilities($limit='40',$offset='0',$sort = "adddatetime desc")
	{
		$this->db->order_by($sort);
		
		$query = $this->db->get($this->liabilities_table,$limit,$offset);
		
		return $query;
	}

	function update_liabilitie(){
		 $data_decode = json_decode($_POST['data']);
		foreach($data_decode as $liabilitie){
			 $data = array(                     
                           'name' => $liabilitie -> liabilitie_name,
                           'totalcost' => $liabilitie -> liabilitie_totalcost,
                           'unitexpenditure' =>$liabilitie -> liabilitie_unitexpenditure,
                           'adddatetime' =>$liabilitie -> liabilitie_adddatetime,
                           'deldatetime' =>$liabilitie -> liabilitie_deldatetime,
                           'caldatetime' =>$liabilitie -> liabilitie_caldatetime,
                           'isauto' =>$liabilitie -> liabilitie_isauto
                        );
			$this->db->where('liabilitieid', $liabilitie -> liabilitie_id);
			$this->db->update($this->liabilities_table, $data);
        }
	}

	function update_liabilitie_by($liabilitie){
		$data = array(
                           'name' =>$liabilitie['liabilitie_name'],
                           'totalcost' =>$liabilitie['liabilitie_totalcost'],
                           'unitexpenditure' =>$liabilitie['liabilitie_unitexpenditure'],
                           'adddatetime' =>$liabilitie['liabilitie_adddatetime'],
                           'deldatetime' =>$liabilitie['liabilitie_deldatetime'],
                           'caldatetime' =>$liabilitie['liabilitie_caldatetime'],
                           'isauto' =>$liabilitie['liabilitie_isauto']
                        );
						
        $this->db->where('liabilitieid', $liabilitie['liabilitie_id']);
		return $this->db->update($this->liabilities_table, $data);
	}
	
	function delete_liabilitie($liabilitie_id){
		return $this->db->delete($this->liabilities_table,array('liabilitieid'=>$liabilitie_id));
	}

	function count_liabilities(){
			
		$this->db->select('COUNT(id) AS count');
		
		$query = $this->db->get($this->liabilities_table);

		if ($query->num_rows() > 0)
		{
		   $row = $query->row();
		   return $row->count;
		}else{
			return 0;
		}
		
	}
}
