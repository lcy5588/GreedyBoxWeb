<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * 后台Admin class的构造器
	 *
	 * 载入条目、话题、类别模型
	 * inclue_login 载入session判断视图
	 * include_header 载入顶部统一视图
	 */
	function __construct()
		{
			parent::__construct();
			$this->load->library('pagination');
			$this->load->model('M_item');
			$this->load->model('M_cat');
			$this->load->model('M_banner');
			$this->load->model('M_label');
			$this->load->model('M_brand');
			$this->load->model('M_pagetype');
			$this->load->model('M_article');
			$this->load->model('M_joke');
			$this->load->model('M_level');
			
			$this->load->view('admin/include_login'); //检查cookie
		}

	/**
	 * 后台首页
	 *
	 */
	public function index()
	{
		$this->load->view('admin/include_header');
		$this->load->view('admin/index_view');
	}

	/**
	 * 登出
	 *
	 */
	public function logout()
	{
        $this->input->set_cookie('user_email','',0);
        $this->input->set_cookie('user_password','',0);
		//跳转
		Header("HTTP/1.1 303 See Other");
		Header("Location: ".site_url('login'));
		exit;
	}

	/**
	 * 搜索结果页
	 *
	 */
	public function search(){
        $this->load->model('M_taobaoapi');
        $data['cat'] = $this->M_cat->get_all_cat();

         //获取搜索关键词
        $keyword = trim($this->input->get('keyword', TRUE),"'\"");

        /* cid是类别id */
        $cid = '0';

        $data['resp'] = $this->M_taobaoapi->searchItem($keyword, $cid);
        $data['keyword'] =  $keyword;

		$this->load->view('admin/include_header');
		$this->load->view('admin/search_view',$data);
	}

	/**
	 * 关键词配置页
	 *
	 *
	 */
	public function keyword($operation = ''){
		$this->load->model('M_keyword');

		//新增关键词	
		if(!empty($operation) && $operation == 'add'){
			$keyword = $this->input->post('keyword');
			$this->M_keyword->add_new_keyword($keyword);
			$data['alert_info'] = '增加关键词成功！';

		}
		//删除关键词
		else if(!empty($operation) && $operation == 'delete'){
			$keyword = $this->input->post('keyword');
			$this->M_keyword->delete_keyword($keyword);
			$data['alert_info'] = '删除关键词'.$keyword.'成功！';
		}
		$data['keyword_list'] = $this->M_keyword->get_all_keyword();
		$this->load->view('admin/include_header');
		$this->load->view('admin/keyword_view',$data);
	}

	/**
	 * 统计页
	 *
	 * @param string stattype 可以是items/shops/cats
	 * @param integer offset 数据库偏移量
	 *
	 */
	public function status($stattype,$page = 1){
		//按条目
		if($stattype == 'items'){
			$limit = 9;
			$offset = ($page-1)*$limit;
			$this->load->library('pagination');

			$config['base_url'] = site_url('/admin/status/items');
			//site_url可以防止换域名代码错误。

	        $config['use_page_numbers'] = TRUE;
	        $config['first_url'] = site_url('/admin/status/items');

			$config['total_rows'] = $this->M_item->count_items();
			//这是模型里面的方法，获得总数。

			$config['per_page'] = $limit;
			$config['first_link'] = '首页';
			$config['last_link'] = '尾页';
			$config['num_links']=10;
			$config['uri_segment'] = 4;
			//上面是自定义文字以及左右的连接数

			$this->pagination->initialize($config);
			//初始化配置

			$data['pagination']=$this->pagination->create_links();
			//通过数组传递参数
			//以上是重点

			$data['query'] = $this->M_item->get_all_item($limit,$offset);
			$data['cat'] = $this->M_cat->get_all_cat();
			
			$itemsstatus = array();
			
			 for($i = 30; $i >= 0; $i -= 10){
				
				$result = $this->M_item->get_item_status($i);
				if($result != null){
					$itemst = array();
					$itemst["overdays"] = $i; 
					$itemst["count"] = $result->count; 
					$itemst["sum"] = $result->sum; 
					
					$itemsstatus[] = $itemst;
				 }
			 }
			
			$data["itemsstatus"] = $itemsstatus;
			
			$this->load->view('admin/include_header');
			$this->load->view('admin/status/items_view',$data);
		}

		//如果是按店铺查看
		else if($stattype == 'shops'){
         	$data['query'] = $this->M_item->query_shops();
            $data['click_count_sum'] = $this->M_cat->click_count_by_cid();
            $data['item_count_sum'] = $this->M_item->count_items();
			$this->load->view('admin/include_header');
			$this->load->view('admin/status/shops_view',$data);
		}

		//如果是按类别查看
		else if($stattype == 'cats'){
			$data['query'] = $this->M_cat->query_cats();
			$data['click_count_sum'] = $this->M_cat->click_count_by_cid();
            $data['item_count_sum'] = $this->M_item->count_items();
            $this->load->view('admin/include_header');
			$this->load->view('admin/status/cats_view',$data);
		}
	}


	/**
	 * 管理类目
	 */
	public function cat(){
		$data['cat'] = $this->M_cat->get_all_cat();
		$data['pagetype'] = $this->M_pagetype->get_all_pagetype();
		
		$this->load->view('admin/include_header');
		$this->load->view('admin/cat_view',$data);
	}

    /**
     * 增加类目
     *
     * @param string $parentid 可选的参数
     */
	public function catadd($parentid = '0'){
        $this->load->model('M_taobaoapi');
        $data['resp'] = $this->M_taobaoapi->getCats($parentid);
		$this->load->view('admin/include_header');
		$this->load->view('admin/catadd_view',$data);
	}
	
	/*手动添加类目*/
	public function addcat(){
		$data=array(
				'id' => $this->input->post('id'),
				'name' => $this->input->post('name'),
				'slug' => $this->input->post('slug'),
				'typeid' => $this->input->post('pagetypeid')
		);
		
		echo $this->M_cat->add_cat_by($data);
	}
	
	public function catupdate_op(){
		return $this->M_cat->update_cat();
	}


	public function catadd_op(){
        $this->M_cat->add_cat();
        $data['cat'] = $this->M_cat->get_all_cat();
		$data['cat_saved'] = false;
        $this->load->view('admin/include_header');
        $this->load->view('admin/cat_view',$data);
	}

	/**
	 * 删除商品类目
	 *
	 */
	public function catdelete(){
		$cat_id = $this->input->post("id");
		
		echo $this->M_cat->delete_cat($cat_id);
	}

	/**
	 * 删除商品条目
	 */
	public function delete_item(){
		$item_id = $_POST['item_id'];
		$this->M_item->delete_item($item_id);
	}

	/**
	 * 删除所有过期商品条目
	 */
	public function clear_expire(){

		$query = $this->M_item->get_all_item(99999, 0);
		$return_string = '成功删除下架商品：';
		foreach ($query->result() as $item) {
			$this->load->model('M_taobaoapi');
			$taobao_id = '';
	        if($item->num_iid){
	        	$taobao_id = $item->num_iid;
	        }
	        $item_id = $item->id;
	        $resp = $this->M_taobaoapi->getiteminfo($taobao_id);
	        if($resp && $resp->code){
	        	$this->M_item->delete_item($item_id);
	        	$return_string = $return_string.$item_id;
	        }
	        //$return_string = $resp;
		}
		$return_string = $return_string.'<a href="'.site_url('admin/status/items').'">返回</a>';
		print_r($return_string);
	}

    /**
     * 获得条目信息
     *
     * @return string $resp json字符串，包含所有的相关图片
     */
	public function getiteminfo(){
        $this->load->model('M_taobaoapi');
        $item_id = $_GET['item_id'];
        $resp = $this->M_taobaoapi->getiteminfo($item_id);

        $img_url_array =array();

        if($resp->item->item_imgs){
            foreach($resp->item->item_imgs->item_img as $item_img){
                array_push($img_url_array,(string)$item_img->url);
            }
        }

        if($resp->item->prop_imgs){
            foreach($resp->item->prop_imgs->prop_img as $prop_img){
                array_push($img_url_array,(string)$prop_img->url);
            }
        }

        $item_info_array = array();
        $item_info_array['imgs'] = $img_url_array;

        echo json_encode($item_info_array);
	}

	/**
	 * 设置条目信息
	 *
	 */
	public function setitem(){
		echo $this->M_item->set_item();
	}
	
	/**
	 *手动设置条目信息
	 *
	 */
	 public function manageitem($page = 1){
		    $limit = 20;
			$offset = ($page-1)*$limit;
			$this->load->library('pagination');

			$config['base_url'] = site_url('/admin/manageitem/');
			//site_url可以防止换域名代码错误。

	        $config['use_page_numbers'] = TRUE;
	        $config['first_url'] = site_url('/admin/manageitem/');

			$config['total_rows'] = $this->M_item->count_items();
			//这是模型里面的方法，获得总数。

			$config['per_page'] = $limit;
			$config['first_link'] = '首页';
			$config['last_link'] = '尾页';
			$config['num_links']=10;
			$config['uri_segment'] = 3;
			$config['cur_page'] = $page;
			//上面是自定义文字以及左右的连接数

			$this->pagination->initialize($config);
			//初始化配置

			$data['pagination']=$this->pagination->create_links();
			//通过数组传递参数
			//以上是重点

			$data['query'] = $this->M_item->get_all_item($limit,$offset);
            
			$typeid = $this->M_pagetype->get_pagetypeid_by_identification('item');
			$lxquery = $this->M_cat->get_all_cat_by_typeid($typeid);
			
			$data['lxquery'] = $lxquery;
			
			$lx_zd = array();
			
			if($lxquery->num_rows()>0){
				foreach($lxquery->result() as $lx){
					$lx_zd[$lx->id] = $lx->name;
				}
			}
			
			$data['lx_zd'] = $lx_zd;
			
			$labelquery = $this->M_label->get_all_label();
			$data['labelquery'] = $labelquery;
			
			$label_zd = array();
			
			if($labelquery->num_rows()>0){
				foreach($labelquery->result() as $lx){
					$label_zd[$lx->id] = $lx->title;
				}
			}
			
			$data['label_zd'] = $label_zd;
			
			$this->load->view('admin/include_header');
			$this->load->view('admin/manage_items_view',$data);
	}

	/**
	 *增加或修改item
	 *
	 */
	
	public function updataitem(){
		$id = $this->input->post('item_id');
		
		if (!empty($id)){
			echo $this->M_item->update_item($id);
		}else{
			echo false;
		}
	}
	
	/**
	*获取条目信息
	*/
	
	public function getitembyid(){
		$id = $this->input->post('item_id');
		$iteminfo = $this->M_item->getItemById($id);
		
		if ($iteminfo != null){
			$item_info_array = array();
			
			$item_info_array['id'] = $iteminfo->id;
			$item_info_array['title']=$iteminfo->title;
			$item_info_array['cid']=$iteminfo->cid;
			$item_info_array['click_url']=$iteminfo->click_url;
			$item_info_array['img_url']=$iteminfo->img_url;
			$item_info_array['price']=$iteminfo->price;
			$item_info_array['sellernick']=$iteminfo->sellernick;
			$item_info_array['oldprice']=$iteminfo->oldprice;
			$item_info_array['discount']=$iteminfo->discount;
			$item_info_array['labelid']=$iteminfo->labelid;
			$item_info_array['comment']=$iteminfo->comment;
			
			echo json_encode($item_info_array);
		}else{
			echo false;
		}
	}
	
	/**
	 *设置横幅、活动、专题信息
	 *
	 */
	 public function managebanner($page = 1){
			$this->load->model('M_bannerpic');
			
		    $limit = 15;
			$offset = ($page-1)*$limit;
			
			$config['base_url'] = site_url('/admin/managebanner/');
			//site_url可以防止换域名代码错误。

	        $config['use_page_numbers'] = TRUE;
	        $config['first_url'] = site_url('/admin/managebanner/');

			$config['total_rows'] = $this->M_bannerpic->count_bannerpic();
			//这是模型里面的方法，获得总数。

			$config['per_page'] = $limit;
			$config['first_link'] = '首页';
			$config['last_link'] = '尾页';
			$config['num_links']=10;
			$config['uri_segment'] = 3;
			$config['cur_page'] = $page;
			//上面是自定义文字以及左右的连接数

			$this->pagination->initialize($config);
			//初始化配置

			$data['bannerpicpagination']=$this->pagination->create_links();
			//通过数组传递参数
			//以上是重点

			$data['banners'] = $this->M_banner->get_all_banner();
            
			
			
			$data['bannerpics'] =  $this->M_bannerpic->get_all_bannerpic($limit,$offset);
			$data['bannerpic_primary'] = $this->M_bannerpic->get_all_bannerpic_by_type('1');
			$data['bannerpic_second'] = $this->M_bannerpic->get_all_bannerpic_by_type('2');
			$data['bannerpic_last'] = $this->M_bannerpic->get_all_bannerpic_by_type('3');
			
			$this->load->view('admin/include_header');
			$this->load->view('admin/manage_activities_view',$data);
	}
	
	/**
	*获取横幅、活动、专题信息
	*/
	
	public function getbannerbyid(){
		$id = $this->input->post('bannerid');
		$bannerinfo = $this->M_banner->get_banner_by_id($id);
		
		if ($bannerinfo != null){
			$bannerinfo_array = array();
			
			$bannerinfo_array['id'] = $bannerinfo->id;
			$bannerinfo_array['primaryimgurl']=$bannerinfo->bannerpic_primary_imgurl;
			$bannerinfo_array['primaryimgid']=$bannerinfo->bannerpic_primary_id;
			$bannerinfo_array['pic1imgurl']=$bannerinfo->bannerpic1_imgurl;
			$bannerinfo_array['pic1imgid']=$bannerinfo->bannerpic1_id;
			$bannerinfo_array['pic2imgurl']=$bannerinfo->bannerpic2_imgurl;
			$bannerinfo_array['pic2imgid']=$bannerinfo->bannerpic2_id;
			$bannerinfo_array['pic3imgurl']=$bannerinfo->bannerpic3_imgurl;
			$bannerinfo_array['pic3imgid']=$bannerinfo->bannerpic3_id;
			$bannerinfo_array['pic4imgurl']=$bannerinfo->bannerpic4_imgurl;
			$bannerinfo_array['pic4imgid']=$bannerinfo->bannerpic4_id;
			
			echo json_encode($bannerinfo_array);
		}else{
			echo false;
		}
	}
	
	/**
	 * 删除横幅
	 */
	public function delete_banner(){
		$banner_id = $_POST['id'];
		echo $this->M_banner->delete_banner($banner_id);
	}
	
	/**
	 * 删除横幅图片
	 */
	public function delete_bannerpic(){
		$this->load->model('M_bannerpic');
		$bannerpic_id = $_POST['id'];
		echo $this->M_bannerpic->delete_bannerpic($bannerpic_id);
	}
	
	public function addbanner(){		
		$bannerid = $this->input->post('bannerid');

		$data = array(
			   'id'=>$bannerid,
			   'bannerpic_primary_id' =>$this->input->post('bannerprimaryimgid'),
			   'bannerpic_primary_imgurl' =>$this->input->post('bannerprimaryimgurl'),
			   'bannerpic1_id' =>$this->input->post('bannerpic1imgid'),
			   'bannerpic1_imgurl' =>$this->input->post('bannerpic1imgurl'),
			   'bannerpic2_id' =>$this->input->post('bannerpic2imgid'),
			   'bannerpic2_imgurl' =>$this->input->post('bannerpic2imgurl'),
			   'bannerpic3_id' =>$this->input->post('bannerpic3imgid'),
			   'bannerpic3_imgurl' =>$this->input->post('bannerpic3imgurl'),
			   'bannerpic4_id' =>$this->input->post('bannerpic4imgid'),
			   'bannerpic4_imgurl' =>$this->input->post('bannerpic4imgurl')
		); 
		
		
		//echo var_dump($data);
		if(empty($bannerid)){
			echo $this->M_banner->add_banner($data);
		}else{
			echo $this->M_banner->update_banner($data);
		}
	}
	
	public function addbannerpic(){		
		$bannerpicid = $this->input->post('bannerpicid');

		$data = array(
				'id' => $bannerpicid,
			   'name' => $this->input->post('name'),
               'img_url' => $this->input->post('img_url'),
               'type' => $this->input->post('type'),
               'click_url' =>  $this->input->post('click_url'),
               'isDisable' => $this->input->post('isDisable'),
               'startdatetime' => $this->input->post('startdatetime'),
			   'enddatetime' => $this->input->post('enddatetime')
		); 
		
		
		//echo var_dump($data);
		$this->load->model('M_bannerpic');
		
		if(empty($bannerpicid)){
			echo $this->M_bannerpic->add_bannerpic($data);
		}else{
			echo $this->M_bannerpic->update_bannerpic($data);
		}
	}
	
	public function getbannerpicbyid(){
		$id = $this->input->post('id');
		$this->load->model('M_bannerpic');
		$bannerpic = $this->M_bannerpic->get_bannerpic_by_id($id);
		
		if($bannerpic !=null){
			$data = array(
						'id' =>$bannerpic->id,
						'name' =>$bannerpic->name,
					   'img_url' =>$bannerpic->img_url,
					   'click_url'=>$bannerpic->click_url,
					   'type' => $bannerpic->type,
					   'isDisable' => $bannerpic->isDisable,						
					   'startdatetime' => $bannerpic->startdatetime,
					   'enddatetime' => $bannerpic->enddatetime
			);
			
		echo json_encode($data);
		}else echo false;
	}
	
	/**
	 *设置标签信息
	 *
	 */
	 public function managelabel($page = 1){
		    $limit = 15;
			$offset = ($page-1)*$limit;
			
			$config['base_url'] = site_url('/admin/managelabel/');
			//site_url可以防止换域名代码错误。

	        $config['use_page_numbers'] = TRUE;
	        $config['first_url'] = site_url('/admin/managelabel/');

			$config['total_rows'] = $this->M_label->count_label();
			//这是模型里面的方法，获得总数。

			$config['per_page'] = $limit;
			$config['first_link'] = '首页';
			$config['last_link'] = '尾页';
			$config['num_links']=10;
			$config['uri_segment'] = 3;
			$config['cur_page'] = $page;
			//上面是自定义文字以及左右的连接数

			$this->pagination->initialize($config);
			//初始化配置

			$data['pagination']=$this->pagination->create_links();
			//通过数组传递参数
			//以上是重点

			$data['labels'] = $this->M_label->get_all_label();
			
			$lxquery = $this->M_cat->get_all_cat();
			$data['lxquery'] = $lxquery;
			
			$lx_zd = array();
			
			if($lxquery->num_rows()>0){
				foreach($lxquery->result() as $lx){
					$lx_zd[$lx->id] = $lx->name;
				}
			}
			
			$data['lx_zd'] = $lx_zd;
			
			$this->load->view('admin/include_header');
			$this->load->view('admin/manage_labels_view',$data);
	}
	
	/**
	 * 删除标签
	 */
	public function deletelabel(){
		$labelid = $_POST['labelid'];
		echo $this->M_label->delete_label($labelid);
	}
	
	public function getlabelbyid(){
		$id = $this->input->post('labelid');
		$label = $this->M_label->get_label_by_id($id);
		
		if($label !=null){
			$data = array(
						'id' =>$label->id,
						'title' =>$label->title,
						'slug' =>$label->slug,
					   'cid' => $label->cid
			);
			
		echo json_encode($data);
		}else echo false;
	}
	
	public function addlabel(){		
		$labelid = $this->input->post('labelid');

		$data = array(
			   'title' => $this->input->post('title'),
               'cid' => $this->input->post('cid'),
			   'slug' =>  $this->input->post('slug')
		); 
		
		
		if(empty($labelid)){
			echo $this->M_label->add_label($data);
		}else{
			$data['id'] = $labelid;
			echo $this->M_label->update_label($data);
		}
	}
	
	/**
	 *设置品牌信息
	 *
	 */
	 public function managebrand($page = 1){
		    $limit = 15;
			$offset = ($page-1)*$limit;
			
			$config['base_url'] = site_url('/admin/managebrand/');
			//site_url可以防止换域名代码错误。

	        $config['use_page_numbers'] = TRUE;
	        $config['first_url'] = site_url('/admin/managebrand/');

			$config['total_rows'] = $this->M_brand->count_brand();
			//这是模型里面的方法，获得总数。

			$config['per_page'] = $limit;
			$config['first_link'] = '首页';
			$config['last_link'] = '尾页';
			$config['num_links']=10;
			$config['uri_segment'] = 3;
			$config['cur_page'] = $page;
			//上面是自定义文字以及左右的连接数

			$this->pagination->initialize($config);
			//初始化配置

			$data['pagination']=$this->pagination->create_links();
			//通过数组传递参数
			//以上是重点

			$data['brands'] = $this->M_brand->get_all_brand($limit,$offset);
			$lxquery=  $this->M_cat->get_all_cat();
            $data['lxquery'] = $lxquery;
			
			$lx_zd = array();
			
			if($lxquery->num_rows()>0){
				foreach($lxquery->result() as $lx){
					$lx_zd[$lx->id] = $lx->name;
				}
			}
			
			$data['lx_zd'] = $lx_zd;
			
			$this->load->view('admin/include_header');
			$this->load->view('admin/manage_brands_view',$data);
	}
	/**
	 * 删除品牌
	 */
	public function deletebrand(){
		$brandid = $_POST['brandid'];
		echo $this->M_brand->delete_brand($brandid);
	}
	
	public function getbrandbyid(){
		$id = $this->input->post('brandid');
		$brand = $this->M_brand->get_brand_by_id($id);
		
		if($brand !=null){
			$data = array(
						'id' =>$brand->id,
						'name' =>$brand->name,
					   'click_url'=>$brand->click_url,
					   'img_url'=>$brand->img_url,
					   'cid' => $brand->cid
			);
			
		echo json_encode($data);
		}else echo false;
	}
	
	public function addbrand(){		
		$brandid = $this->input->post('brandid');

		$data = array(
			   'name' =>$this->input->post('name'),
			   'click_url'=>$this->input->post('click_url'),
			   'img_url'=>$this->input->post('img_url'),
			   'cid' => $this->input->post('cid')
		); 
		
		
		if(empty($brandid)){
			echo $this->M_brand->add_brand($data);
		}else{
			$data['id'] = $brandid;
			echo $this->M_brand->update_brand($data);
		}
	}
	
	/**
	 * 删除友链
	 */
	public function deletefriendlink(){
		$this->load->model('M_friendlink');
		$labelid = $_POST['friendlinkid'];
		echo $this->M_friendlink->delete_friendlink($friendlinkid);
	}
	
	public function getfriendlinkbyid(){
		$this->load->model('M_friendlink');
		$id = $this->input->post('friendlinkid');
		$friendlink = $this->M_friendlink->get_friendlink_by_id($id);
		
		if($friendlink !=null){
			$data = array(
						'id' =>$friendlink->id,
						'name' =>$friendlink->name,
					   'click_url'=>$friendlink->click_url,
					   'type' => $friendlink->type,
					   'img_url' => $friendlink->img_url
			);
			
		echo json_encode($data);
		}else echo false;
	}
	
	public function addfriendlink(){
		$this->load->model('M_friendlink');
		$friendlinkid = $this->input->post('friendlinkid');

		$data = array(
			   'name' => $this->input->post('name'),
               'type' => $this->input->post('type'),
               'click_url' =>  $this->input->post('click_url'),
			   'img_url' =>  $this->input->post('img_url')
		); 
		
		
		if(empty($friendlinkid)){
			echo $this->M_friendlink->add_friendlink($data);
		}else{
			$data['id'] = $friendlinkid;
			echo $this->M_friendlink->update_friendlink($data);
		}
	}
	
	/**
	 *设置标签信息
	 *
	 */
	 public function managefriendlink($page = 1){
		    $limit = 15;
			$offset = ($page-1)*$limit;
			$this->load->model('M_friendlink');
			$config['base_url'] = site_url('/admin/managefriendlink/');
			//site_url可以防止换域名代码错误。

	        $config['use_page_numbers'] = TRUE;
	        $config['first_url'] = site_url('/admin/managefriendlink/');

			$config['total_rows'] = $this->M_friendlink->count_friendlink();
			//这是模型里面的方法，获得总数。

			$config['per_page'] = $limit;
			$config['first_link'] = '首页';
			$config['last_link'] = '尾页';
			$config['num_links']=10;
			$config['uri_segment'] = 3;
			$config['cur_page'] = $page;
			//上面是自定义文字以及左右的连接数

			$this->pagination->initialize($config);
			//初始化配置

			$data['pagination']=$this->pagination->create_links();
			//通过数组传递参数
			//以上是重点

			$data['friendlinks'] = $this->M_friendlink->get_all_friendlink_by_type($limit,$offset);
            
			
			
			$this->load->view('admin/include_header');
			$this->load->view('admin/manage_friendlinks_view',$data);
	}
	
	function delete_overdays(){
		$days = $post->input["days"];
		if($this->M_item->delete_overdays($days))
		{
			echo true;
		}
		else{
			echo false;
		}
		
	}
	
	function delete_all_item(){
		if($this->M_item->delete_all_item())
		{
			echo true;
		}
		else{
			echo false;
		}
	}
	
	/**
	 *手动设置文章条目信息
	 *
	 */
	 public function managearticle($page = 1){
		    $limit= 20;
		    $offset = $limit * ($page - 1);
			$config['base_url'] = base_url()."/admin/managearticle/";
			$config['total_rows'] = $this->M_article->count_articles();
			$config['per_page'] = $limit;
			$config['first_link'] = '首页';
			$config['last_link'] = '尾页';
			$config['num_links']=10;
			$config['uri_segment'] = 3;
			$config['cur_page'] = $page;
			$config['use_page_numbers'] = TRUE;
			
			$this->pagination->initialize($config);
			$data['pagination']=$this->pagination->create_links();
			//通过数组传递参数
			//以上是重点

			$data['query'] = $this->M_article->get_all_articles($limit,$offset);
            $typeid = $this->M_pagetype->get_pagetypeid_by_identification('article');
			$lxquery = $this->M_cat->get_all_cat_by_typeid($typeid);
			$data['lxquery'] = $lxquery;
			
			$lx_zd = array();
			
			if($lxquery->num_rows()>0){
				foreach($lxquery->result() as $lx){
					$lx_zd[$lx->id] = $lx->name;
				}
			}
			
			$data['lx_zd'] = $lx_zd;
			
			$levelquery = $this->M_level->get_all_level();
			$data['levelquery'] = $levelquery;
			
			$level_zd = array();
			
			if($levelquery->num_rows()>0){
				foreach($levelquery->result() as $lx){
					$level_zd[$lx->id] = $lx->name;
				}
			}
			
			$data['level_zd'] = $level_zd;
			
			
			$labelquery = $this->M_label->get_all_label();
			$data['labelquery'] = $labelquery;
			
			$label_zd = array();
			
			if($labelquery->num_rows()>0){
				foreach($labelquery->result() as $lx){
					$label_zd[$lx->id] = $lx->title;
				}
			}
			
			$data['label_zd'] = $label_zd;
			
			
			$this->load->view('admin/include_header');
			$this->load->view('admin/manage_articles_view',$data);
	}
	
	/**
	 * 手动设置文章条目信息
	 *
	 */
	public function setarticle(){
		$data = array(                     
                           'article_cid' =>$_POST['article_cid'],
                           'article_labelid' =>$_POST['article_labelid'],
                           'article_title' =>$_POST['article_title'],
                           'article_content' =>$_POST['article_content'],
                           'article_html' =>$_POST['article_html'],
                           'article_authorid' =>$_POST['article_authorid'],
                           'article_levelid' => $_POST['article_levelid'],
						   'article_imgurl' => $_POST['article_imgurl']
                        );
		
		echo $this->M_article->add_article_by($data);
	}
	
	/**
	 * 删除文章
	 */
	public function delete_article(){
		$articleid = $_POST['article_id'];
		echo $this->M_article->delete_article($articleid);
	}
	
	public function getarticlebyid(){
		$articleid = $_POST['article_id'];
		
		$article = $this->M_article->get_article_by_id($articleid);
		
		if($article !=null){
			$data = array(
						 'id' => $article -> id ,
                           'cid' => $article -> cid ,
                           'labelid' => $article -> labelid ,
                           'title' =>$article -> title,
                           'html' =>$article -> html,
                           'authorid' =>$article -> authorid,
                           'levelid' => $article -> levelid,
						   'imgurl' => $article -> imgurl
			);
			
		echo json_encode($data);
		}else echo false; 
	}

	public function updataarticle(){	
		$data = array( 
							'article_id' =>$_POST['article_id'],
                           'article_cid' =>$_POST['article_cid'],
                           'article_labelid' =>$_POST['article_labelid'],
                           'article_title' =>$_POST['article_title'],
                           'article_content' =>$_POST['article_content'],
                           'article_html' =>$_POST['article_html'],
                           'article_authorid' =>$_POST['article_authorid'],
                           'article_levelid' => $_POST['article_levelid'],
						   'article_imgurl' => $_POST['article_imgurl']
                        );
		echo $this->M_article->update_article_by($data);
	}
	
	/**
	 *手动设置文章条目信息
	 *
	 */
	 public function managejoke($page = 1){
		    $limit = 20;
			$offset = ($page-1)*$limit;
			$this->load->library('pagination');

			$config['base_url'] = site_url('/admin/managejoke/');
			//site_url可以防止换域名代码错误。

	        $config['use_page_numbers'] = TRUE;
	        //$config['first_url'] = site_url('/admin/managearticle');

			$config['total_rows'] = $this->M_joke->count_jokes();
			//这是模型里面的方法，获得总数。

			$config['per_page'] = $limit;
			$config['first_link'] = '首页';
			$config['last_link'] = '尾页';
			$config['num_links']=10;
			$config['uri_segment'] = 3;
			$config['cur_page'] = $page;
			//上面是自定义文字以及左右的连接数

			$this->pagination->initialize($config);
			//初始化配置

			$data['pagination']=$this->pagination->create_links();
			//通过数组传递参数
			//以上是重点

			$data['query'] = $this->M_joke->get_all_jokes($limit,$offset);
            $typeid = $this->M_pagetype->get_pagetypeid_by_identification('joke');
			$lxquery = $this->M_cat->get_all_cat_by_typeid($typeid);
			$data['lxquery'] = $lxquery;
			
			$lx_zd = array();
			
			if($lxquery->num_rows()>0){
				foreach($lxquery->result() as $lx){
					$lx_zd[$lx->id] = $lx->name;
				}
			}
			
			$data['lx_zd'] = $lx_zd;
            
			
			$levelquery = $this->M_level->get_all_level();
			$data['levelquery'] = $levelquery;
			
			$level_zd = array();
			
			if($levelquery->num_rows()>0){
				foreach($levelquery->result() as $lx){
					$level_zd[$lx->id] = $lx->name;
				}
			}
			
			$data['level_zd'] = $level_zd;
			
			$labelquery = $this->M_label->get_all_label();
			$data['labelquery'] = $labelquery;
			
			$label_zd = array();
			
			if($labelquery->num_rows()>0){
				foreach($labelquery->result() as $lx){
					$label_zd[$lx->id] = $lx->title;
				}
			}
			
			$data['label_zd'] = $label_zd;
			
			
			$this->load->view('admin/include_header');
			$this->load->view('admin/manage_jokes_view',$data);
	}
	
	/**
	 * 手动设置文章条目信息
	 *
	 */
	public function setjoke(){
		$data = array(                     
                           'joke_cid' =>$_POST['joke_cid'],
                           'joke_labelid' =>$_POST['joke_labelid'],
                           'joke_html' =>$_POST['joke_html'],
                           'joke_imgurl' => $_POST['joke_imgurl'],
                           'joke_authorid' =>$_POST['joke_authorid'],
                           'joke_levelid' => $_POST['joke_levelid']
                        );
		
		echo $this->M_joke->add_joke_by($data);
	}
	
	/**
	 * 删除文章
	 */
	public function delete_joke(){
		$jokeid = $_POST['joke_id'];
		echo $this->M_joke->delete_joke($jokeid);
	}
	
	public function getjokebyid(){
		$jokeid = $_POST['joke_id'];
		
		$joke = $this->M_joke->get_joke_by_id($jokeid);
		
		if($joke !=null){
			$data = array(
						 'id' => $joke -> id ,
                           'cid' => $joke -> cid ,
                           'labelid' => $joke -> labelid,
                           'imgurl' => $joke->img_url,
                           'html' =>$joke -> html,
                           'authorid' =>$joke -> authorid,
                           'levelid' => $joke -> levelid,
			);
			
		echo json_encode($data);
		}else echo false; 
	}

	public function updatajoke(){	
		$data = array( 
							'joke_id' =>$_POST['joke_id'],
                           'joke_cid' =>$_POST['joke_cid'],
                           'joke_labelid' =>$_POST['joke_labelid'],
                           'joke_imgurl' =>$_POST['joke_imgurl'],
                           'joke_html' =>$_POST['joke_html'],
                           'joke_authorid' =>$_POST['joke_authorid'],
                           'joke_levelid' => $_POST['joke_levelid'],
                        );
		echo $this->M_joke->update_joke_by($data);
	}
	
	/**
	 * 管理级别
	 */
	public function managelevel(){
		
		$data['level'] = $this->M_level->get_all_level();
		
		$this->load->view('admin/include_header');
		$this->load->view('admin/manage_levels_view',$data);
	}
	
	/*手动添加级别*/
	public function addlevel(){
		
		$data=array(
				'id' => $this->input->post('id'),
				'name' => $this->input->post('name'),
				'color' => $this->input->post('color')
		);
		
		echo $this->M_level->add_level_by($data);
	}
	
	public function deletelevel(){
		
		$id = $this->input->post('id');
		
		echo $this->M_level->delete_level($id);
	}
	
	public function updatalevel(){
		
		
		echo $this->M_level->update_level();
	}
	
	public function resetleveldefaultdata(){
		
		echo $this->M_level->reset_level_default_data();
	}
	
	/*页面类型*/
	public function managepagetype(){
		
		$data['pagetype'] = $this->M_pagetype->get_all_pagetype();
		
		$this->load->view('admin/include_header');
		$this->load->view('admin/manage_pagetypes_view',$data);
	}
	
	public function addpagetype(){
		
		$data=array(
				'id' => $this->input->post('id'),
				'name' => $this->input->post('name'),
				'listview' => $this->input->post('listview'),
				'contentview' => $this->input->post('contentview'),
				'identification' => $this->input->post('identification')
		);
		
		echo $this->M_pagetype->add_pagetype_by($data);
	}
	
	public function deletepagetype(){
		
		$id = $this->input->post('id');
		
		echo $this->M_pagetype->delete_pagetype($id);
	}
	
	public function updatapagetype(){
		
		
		echo $this->M_pagetype->update_pagetype();
	}
	
	public function resetpagetypedefaultdata(){
		echo $this->M_pagetype->reset_pagetype_default_data();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
