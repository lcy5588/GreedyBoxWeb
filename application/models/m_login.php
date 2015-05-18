<?php

class M_login extends CI_Model{

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * 初始化函数
	 *
	 * 在已经创建数据库的情况下，初始化数据库表信息
	 * 之后接受输入管理员邮箱密码，保存到数据库
	 */
	function init()
	{
		$this->load->dbutil();
		$this->load->dbforge();
		$this->load->database();
		$data['text'] = '';


		$fields_item = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '128',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
			),
			'title' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  ),
			'cid' => array(
				 'type' => 'INT',
				 'constraint' => '128',
		  ),
			'labelid' => array(
				 'type' => 'INT',
				 'constraint' => '128',
		  ),
			'click_count' => array(
				 'type' => 'INT',
				 'constraint' => '128',
				 'default' => 0
		  ),
			'click_url' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '512',
		  ),
			'img_url' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  ),
		  'comment' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '200',
		  ),
			'price' => array(
				 'type' => 'FLOAT'
		  ),
		  'oldprice' => array(
				 'type' => 'FLOAT'
		  ),
		  'discount' => array(
				 'type' => 'FLOAT'
		  ),
			'sellernick' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  ),
		  'adddatetime' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '14',
		  ),
		  'good' => array(
				 'type' => 'INT',
				 'constraint' => '32',
				 'default' => 0
		  ),
		  'unlike' => array(
				  'type' => 'INT',
				 'constraint' => '32',
				 'default' => 0
		  )
		);

		$this->dbforge->add_field($fields_item);
		$this->dbforge->add_key('id');

		//创建表item，如果不存在
	   if($this->dbforge->create_table('item', TRUE))
	   {
		   $data['text'] .=  '<p>表item创建成功!</p>';
	   }
	   //创建brand,如果不存在
	   $fields_brand = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '128',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
			),
			'name' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  ),
			'cid' => array(
				 'type' => 'INT',
				 'constraint' => '128',
		  ),
			'click_count' => array(
				 'type' => 'INT',
				 'constraint' => '128',
				 'default' => 0
		  ),
			'click_url' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '512',
		  ),
			'img_url' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  )
		);

		$this->dbforge->add_field($fields_brand);
		$this->dbforge->add_key('id');
		
	   if($this->dbforge->create_table('brand', TRUE))
	   {
		   $data['text'] .=  '<p>表brand创建成功!</p>';
	   }
		
		//创建bannerpic
		$fields_bannerpic = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '128',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
			),
			'name' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  ),
			'click_count' => array(
				 'type' => 'INT',
				 'constraint' => '128',
				 'default' => 0
		  ),
			'click_url' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '512',
		  ),
			'img_url' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  ),
		  'type' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '2',
				 'null' => TRUE,
		  ),
		  'isDisable' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '1',
				 'null' => TRUE,
		  ),
		  'startdatetime' => array(
				  'type' => 'VARCHAR',
				 'constraint' => '14',
		  )
		  ,
		  'enddatetime' => array(
				  'type' => 'VARCHAR',
				 'constraint' => '14',
		  )
		);

		$this->dbforge->add_field($fields_bannerpic);
		$this->dbforge->add_key('id');
		

	   if($this->dbforge->create_table('bannerpic', TRUE))
	   {
		   $data['text'] .=  '<p>表bannerpic创建成功!</p>';
	   }
	   
	   
	   //创建banner
		$fields_banner = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '128',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
			),
			'bannerpic_primary_id' => array(
				 'type' => 'INT',
				 'constraint' => '128',
		  ),
			'bannerpic_primary_imgurl' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  ),
		  'bannerpic1_id' => array(
				 'type' => 'INT',
				 'constraint' => '128',
				 'null' => TRUE
		  ),
			'bannerpic1_imgurl' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
				 'null' => TRUE
		  ),
		  'bannerpic2_id' => array(
				 'type' => 'INT',
				 'constraint' => '128',
				 'null' => TRUE
		  ),
			'bannerpic2_imgurl' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
				 'null' => TRUE
		  ),
		  'bannerpic3_id' => array(
				 'type' => 'INT',
				 'constraint' => '128',
				 'null' => TRUE
		  ),
			'bannerpic3_imgurl' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
				 'null' => TRUE
		  ),
		  'bannerpic4_id' => array(
				 'type' => 'INT',
				 'constraint' => '128',
				 'null' => TRUE
		  ),
			'bannerpic4_imgurl' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
				 'null' => TRUE
		  ),
		);

		$this->dbforge->add_field($fields_banner);
		$this->dbforge->add_key('id');
		

	   if($this->dbforge->create_table('banner', TRUE))
	   {
		   $data['text'] .=  '<p>表banner创建成功!</p>';
	   }
		//创建label
		$fields_label = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '128',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
			),
			'title' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  ),
			'cid' => array(
				 'type' => 'INT',
				 'constraint' => '128',
		  ),
			'slug' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  ),
			'click_count' => array(
				 'type' => 'INT',
				 'constraint' => '128',
				 'default' => 0
		  )
		);

		$this->dbforge->add_field($fields_label);
		$this->dbforge->add_key('id');

		//创建表item，如果不存在
	   if($this->dbforge->create_table('label', TRUE))
	   {
		   $data['text'] .=  '<p>表label创建成功!</p>';
	   }
	   
	   //创建friendlink
		$fields_friendlink = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '128',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
			),
			'name' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  ),
			'click_url' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '512',
		  ),
		  'img_url' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
				 'null' => TRUE
		  ),
			'type' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '2',
				 'null' => TRUE
		  )
		);

		$this->dbforge->add_field($fields_friendlink);
		$this->dbforge->add_key('id');

	
	   if($this->dbforge->create_table('friendlink', TRUE))
	   {
		   $data['text'] .=  '<p>表friendlink创建成功!</p>';
	   }
	   
	   //创建user
		$fields_user = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '128',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
			),
			'nick' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  ),
			'avatar_url' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '512',
		  ),
			'email' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  ),
			'open_id' => array(
				 'type' => 'FLOAT'
		  ),
			'access_token' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  ),
		);

		$this->dbforge->add_field($fields_user);
		$this->dbforge->add_key('id');

		//创建表user，如果不存在
	   if($this->dbforge->create_table('user', TRUE))
	   {
		   $data['text'] .=  '<p>表user创建成功!</p>';
	   }



		$fields_cat = array(
			'id' => array(
				 'type' => 'INT',
				 'constraint' => '128',
		  ),
			'name' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  ),
			'slug' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  ),
			'typeid' => array(
				 'type' => 'INT',
				 'constraint' => '32',
		  )
		);

		$this->dbforge->add_field($fields_cat);
		$this->dbforge->add_key('id',TRUE);

		//创建表cat，如果不存在
	   if($this->dbforge->create_table('cat', TRUE))
	   {
		   $data['text'] .=  '<p>表cat创建成功!</p>';
	   }



		$fields_keyword = array(
			'id' => array(
				 'type' => 'INT',
				 'constraint' => '128',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
		  ),
			'keyword_name' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  ),
			'keyword_click' => array(
				 'type' => 'INT',
				 'constraint' => '128',
		  )
		);

		$this->dbforge->add_field($fields_keyword);
		$this->dbforge->add_key('id',TRUE);

		//创建表cat，如果不存在
	   if($this->dbforge->create_table('keyword', TRUE))
	   {
		   $data['text'] .=  '<p>表keyword创建成功!</p>';
	   }


		
		
		//创建article
		$fields_article = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '128',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
			),
			'cid' => array(
				 'type' => 'INT',
				 'constraint' => '128',
				 'unsigned' => TRUE,
		  ),
			'labelid' => array(
				 'type' => 'INT',
				 'constraint' => '128',
				 'unsigned' => TRUE,
		  ),
			'title' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '100',
		  ),
			'content' => array(
				 'type' => 'TEXT'
		  ),
			'html' => array(
				 'type' => 'TEXT'
		  ),
			'authorid' => array(
				 'type' => 'INT',
				 'constraint' => '128',
				 'unsigned' => TRUE,
		  ),
			'levelid' => array(
				 'type' => 'INT',
				 'constraint' => '128',
				 'unsigned' => TRUE,				 
		  ),
			'imgurl' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '200',
				 'null' => TRUE			 
		  ),
			'click_count' => array(
				 'type' => 'INT',
				 'constraint' => '32',
				 'unsigned' => TRUE,
				 'default' => 0				 
		  ),'good' => array(
				 'type' => 'INT',
				 'constraint' => '32',
				 'unsigned' => TRUE,
				 'default' => 0				 
		  ),'unlike' => array(
				 'type' => 'INT',
				 'constraint' => '32',
				 'unsigned' => TRUE,
				 'default' => 0				 
		  ),
		  'adddatetime' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '14'
		  )
		);

		$this->dbforge->add_field($fields_article);
		$this->dbforge->add_key('id');

		//创建表user，如果不存在
	   if($this->dbforge->create_table('article', TRUE))
	   {
		   $data['text'] .=  '<p>表article创建成功!</p>';
	   }
	   
	   //创建joke
		$fields_joke = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '128',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
			),
			'cid' => array(
				 'type' => 'INT',
				 'constraint' => '128',
				 'unsigned' => TRUE,
		  ),
			'labelid' => array(
				 'type' => 'INT',
				 'constraint' => '128',
				 'unsigned' => TRUE,
				 'null' => TRUE
		  ),
			'img_url' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '500',
				 'null' => TRUE
		  ),
			'html' => array(
				 'type' => 'TEXT'
		  ),
			'authorid' => array(
				 'type' => 'INT',
				 'constraint' => '128',
				 'unsigned' => TRUE,
		  ),
			'levelid' => array(
				 'type' => 'INT',
				 'constraint' => '128',
				 'unsigned' => TRUE,				 
		  ),'good' => array(
				 'type' => 'INT',
				 'constraint' => '32',
				 'unsigned' => TRUE,
				 'default' => 0,
		  ),'unlike' => array(
				 'type' => 'INT',
				 'constraint' => '32',
				 'unsigned' => TRUE,
				 'default' => 0				 
		  ),
		  'adddatetime' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '14'
		  )
		);

		$this->dbforge->add_field($fields_joke);
		$this->dbforge->add_key('id');

		//创建表joke，如果不存在
	   if($this->dbforge->create_table('joke', TRUE))
	   {
		   $data['text'] .=  '<p>表joke创建成功!</p>';
	   }
	   
	   //创建level
		$fields_level = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '128',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
			),			
			'name' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '32',
		  ),			
			'color' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '32',
		  )
		);

		$this->dbforge->add_field($fields_level);
		$this->dbforge->add_key('id');
		
		//创建表level，如果不存在
	   if($this->dbforge->create_table('level', TRUE))
	   {
		   $data['text'] .=  '<p>表level创建成功!</p>';
		   
	   }
	   
	   
		 //创建level
		$fields_pagetype = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '128',
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
			),			
			'name' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '64',
		  ),			
			'listview' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  ),			
			'contentview' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  ),
		    'identification' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '32',
		  )
		);

		$this->dbforge->add_field($fields_pagetype);
		$this->dbforge->add_key('id');

		//创建表pagetype，如果不存在
	   if($this->dbforge->create_table('pagetype', TRUE))
	   {
		   $data['text'] .=  '<p>表pagetype创建成功!</p>';
		   
	   }
	   
	   $fields_admin = array(
			'user_email' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  ),
			'user_password' => array(
				 'type' => 'VARCHAR',
				 'constraint' => '128',
		  )
		);

		$this->dbforge->add_field($fields_admin);
		$this->dbforge->add_key('user_email',TRUE);

		//创建表admin，如果不存在
	   if($this->dbforge->create_table('admin', TRUE))
	   {
		   $data['text'] .=  '<p>表admin创建成功!</p>';
		   $data['text'] .=  '<p>请输入管理员帐号信息!</p>';
	   }
	   
		//检查是否已经存在一个admin
		$data['is_installed'] = $this->db->get('admin')->num_rows();

		return $data;

	}
}
