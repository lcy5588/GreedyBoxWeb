<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_article');
		$this->load->model('M_keyword');
		$this->load->library('pagination');
		$this->load->model('M_cat');
		$this->load->model('M_brand');
		$this->load->model('M_bannerpic');
		$this->load->model('M_banner');
		$this->load->model('M_label');
		$this->load->model('M_level');
		$this->load->model('M_pagetype');
		$this->load->model('M_joke');
		$this->load->model('M_item');
	}

    /**
     * 首页控制器
     *
     */
    public function index(){
        $this->page(1);
    }

    /**
     * 翻页控制器
     *
     * @param integer $page 第几页
     */
	public function page($page)
	{

		$limit= 20;
		$config['base_url'] = base_url()."/index.php/home/page/";
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
		
		
		//关键词列表，这个在后台配置
		$data['keyword_list'] = $this->M_keyword->get_all_keyword(5);

		//类别
		$cats = $this->M_cat->get_all_cat();
		$data['cat'] = $cats;
		
		$cat_zd = array();
			
			if($cats->num_rows()>0){
				foreach($cats->result() as $lx){
					$cat_zd[$lx->id] = $lx->typeid;
				}
			}
			
		$data['cat_zd'] = $cat_zd;
		
		$articles = $this->M_article->get_all_articles($limit,($page-1)*$limit);
		$data['articles'] = $articles;
		
		$levelquery = $this->M_level->get_all_level();

		$data['levelquery'] = $levelquery;
		
		$level_zd = array();
		
		if($levelquery->num_rows()>0){
			foreach($levelquery->result() as $lx){
				$level_zd[$lx->id] = $lx->color;
			}
		}
			
		$data['level_zd'] = $level_zd;
		
		$pagetypequery = $this->M_pagetype->get_all_pagetype();
			
			
		$pagetype_zd = array();
		
		if($pagetypequery->num_rows()>0){
			foreach($pagetypequery->result() as $lx){
				$pagetype_zd[$lx->id] = $lx->identification;
			}
		}
		
		$data['pagetype_zd'] = $pagetype_zd;
		
		$jokes = $this->M_joke->get_all_jokes();
		
		$data['jokes'] = $jokes;
		
		$this->load->model('M_friendlink');
		
		$data['friendlinks'] = $this->M_friendlink->get_all_friendlink_by_type('100','0');
		
		//站点信息
		$data['site_name'] = $this->config->item('site_name');

		//keysords和description
		$data['site_keyword'] = $this->config->item('site_keyword');
		$data['site_description'] = $this->config->item('site_description');
		
		$this->load->view('include_header',$data);
		$this->load->view('home_view');
	}

	/**
	 * 跳转函数，同时记录点击数量
	 *
	 * 点击记数要排除机器访问
	 */
	function redirect($item_id){

        $this->load->library('user_agent');
        if(!$this->agent->is_robot()){
            $this->M_item->add_click_count($item_id);
        }

		Header("HTTP/1.1 303 See Other");
		Header("Location: ".$this->M_item->get_item_clickurl($item_id));
		exit;
	}
	
	function bannerpic($bannerpic_id){
		
		$this->load->library('user_agent');
        if(!$this->agent->is_robot()){
            $this->M_bannerpic->add_click_count($bannerpic_id);
        }

		Header("HTTP/1.1 303 See Other");
		Header("Location: ".$this->M_bannerpic->get_bannerpic_clickurl($bannerpic_id));
		exit;
	}
	
	function brand($brand_id){
		
		$this->load->library('user_agent');
        if(!$this->agent->is_robot()){
            $this->M_brand->add_click_count($brand_id);
        }

		Header("HTTP/1.1 303 See Other");
		Header("Location: ".$this->M_brand->get_brand_clickurl($brand_id));
		exit;
	}
	
	function label($label_id){
		
		$this->load->library('user_agent');
        if(!$this->agent->is_robot()){
            $this->M_label->add_click_count($label_id);
        }

		Header("HTTP/1.1 303 See Other");
		Header("Location: ".$this->M_label->get_label_clickurl($label_id));
		exit;
	}
	/**
	 * 搜索结果页
	 *
	 */
	public function search(){
        //$this->load->model('M_taobaoapi');
        $data['cat'] = $this->M_cat->get_all_cat();

         //获取搜索关键词+过滤
        $data['keyword'] = trim($this->input->get('keyword', TRUE),"'\"><");

        $this->M_keyword->add_keyword_if_not_exist($data['keyword']);

		//关键词列表，这个在后台配置
		$data['keyword_list'] = $this->M_keyword->get_all_keyword(5);
		
		$this->load->model('M_bannerpic');

		//搜索条目的结果
		$itemcat = array(					
					'item' => $this->M_item->searchItem($data['keyword']),
					'bannerpic' => $this->M_bannerpic->get_bannerpic_loop_by_type(1,'4')
		);
		
		$data['itemcat'] = $itemcat;
        
		//站点信息
		$data['site_name'] = $this->config->item('site_name');
		//keysords和description
		$data['site_keyword'] = $this->config->item('site_keyword');
		$data['site_description'] = $this->config->item('site_description');
		$data['pid'] = '12345678';
		
		$this->load->view('search_view',$data);
	}
	
	
	public function getitemdataonlocal(){
		$catid = $this->input->post('catid');
		$sort = $this->input->post('sort');
		
		if($sort =='click_count')
			$sort .= ' desc';
		else if($sort == 'price')
			$sort .= ' asc';
		else if($sort == 'adddatetime')
			$sort .= ' desc';
		else echo false;
		
		$itemsinfo = $this->M_item->get_all_item_by_cid('24','0',$catid,$sort);
		$itemsresult = array();
		if(!empty($itemsinfo)){
		if ($itemsinfo->num_rows >0){
			$result = $itemsinfo->result();
			foreach($result as $iteminfo){
			$item_info_array = array();
			
			$item_info_array['id'] = $iteminfo->id;
			$item_info_array['title']=$iteminfo->title;
			$item_info_array['cid']=$iteminfo->cid;
			$item_info_array['click_url']=$iteminfo->click_url;
			$item_info_array['img_url']=$iteminfo->img_url;
			$item_info_array['price']=$iteminfo->price;
			$item_info_array['sellernick']=$iteminfo->sellernick;
			$item_info_array['num_iid']=$iteminfo->num_iid;
			$item_info_array['oldprice']=$iteminfo->oldprice;
			$item_info_array['discount']=$iteminfo->discount;
			
			$itemsresult[] = $item_info_array;
			}
		}}
		
		echo json_encode($itemsresult);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
