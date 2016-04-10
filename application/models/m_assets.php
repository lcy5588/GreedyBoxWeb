<?php

class M_assets extends CI_Model{

        var $assets_table = '';

	function __construct()
	{
		parent::__construct();
                $this->assets_table = $this->db->dbprefix('assets');
              
		date_default_timezone_set('prc');
	}


	function add_asset()
	{
        $data_decode = json_decode($_POST['data']);
        foreach($data_decode as $asset){
            $data = array(                     
                           'name' => $asset -> asset_name,
                           'totalnum' => $asset -> asset_totalnum,
                           'unitprice' =>$asset -> asset_unitprice,
                           'income' =>$asset -> asset_income,
                           'adddatetime' =>$asset -> asset_adddatetime,
                           'deldatetime' =>$asset -> asset_deldatetime,
                           'caldatetime' =>$asset -> asset_caldatetime,
                           'isauto' =>$asset -> asset_isauto
                        );
            $this->db->insert($this->assets_table, $data);
        }
    }
	
	function add_asset_by($asset)
	{
            $data = array(
                           'name' =>$asset['asset_name'],
                           'totalnum' =>$asset['asset_totalnum'],
                           'unitprice' =>$asset['asset_unitprice'],
                           'income' =>$asset['asset_income'],
                           'adddatetime' =>$asset['asset_adddatetime'],
                           'deldatetime' =>$asset['asset_deldatetime'],
                           'caldatetime' =>$asset['asset_caldatetime'],
                           'isauto' =>$asset['asset_isauto']
                        );
            return $this->db->insert($this->assets_table, $data);
    }

	
	function get_asset_by_id($id = ''){
    	if(!empty($id)){
			$this->db->select('name,totalnum,unitprice,income,adddatetime,deldatetime,caldatetime,isauto');
    		$result = $this->db->get_where($this->assets_table, array('assetid'=>$id))->result();
			
			return $result[0];
			
    	}else {
    		return null;
    	}
    }
	
	function get_all_assets($limit='40',$offset='0',$sort = "adddatetime desc")
	{
		$this->db->order_by($sort);
		
		$query = $this->db->get($this->assets_table,$limit,$offset);
		
		return $query;
	}

	function update_asset(){
		 $data_decode = json_decode($_POST['data']);
		foreach($data_decode as $asset){
			 $data = array(                     
                           'name' => $asset -> asset_name,
                           'totalnum' => $asset -> asset_totalnum,
                           'unitprice' =>$asset -> asset_unitprice,
                           'income' =>$asset -> asset_income,
                           'adddatetime' =>$asset -> asset_adddatetime,
                           'deldatetime' =>$asset -> asset_deldatetime,
                           'caldatetime' =>$asset -> asset_caldatetime,
                           'isauto' =>$asset -> asset_isauto
                        );
			$this->db->where('assetid', $asset -> asset_id);
			$this->db->update($this->assets_table, $data);
        }
	}

	function update_asset_by($asset){
		$data = array(
                           'name' =>$asset['asset_name'],
                           'totalnum' =>$asset['asset_totalnum'],
                           'unitprice' =>$asset['asset_unitprice'],
                           'income' =>$asset['asset_income'],
                           'adddatetime' =>$asset['asset_adddatetime'],
                           'deldatetime' =>$asset['asset_deldatetime'],
                           'caldatetime' =>$asset['asset_caldatetime'],
                           'isauto' =>$asset['asset_isauto']
                        );
						
        $this->db->where('assetid', $asset['asset_id']);
		return $this->db->update($this->assets_table, $data);
	}
	
	function delete_asset($asset_id){
		return $this->db->delete($this->assets_table,array('assetid'=>$asset_id));
	}

	function count_assets(){
			
		$this->db->select('COUNT(id) AS count');
		
		$query = $this->db->get($this->assets_table);

		if ($query->num_rows() > 0)
		{
		   $row = $query->row();
		   return $row->count;
		}else{
			return 0;
		}
		
	}
}
