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
	public function search($page=1){
        //$this->load->model('M_taobaoapi');

         //获取搜索关键词+过滤
        $data['keyword'] = trim($this->input->get('keyword', TRUE),"'\"><");

        $this->M_keyword->add_keyword_if_not_exist($data['keyword']);

		//关键词列表，这个在后台配置
		$data['keyword_list'] = $this->M_keyword->get_all_keyword(5);
		
		$limit= 20;
		$config['base_url'] = base_url()."/index.php/home/page/";
		$config['total_rows'] = $this->M_article->count_articles_by_keyword($data['keyword']);
		$config['per_page'] = $limit;
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['num_links']=10;
		$config['uri_segment'] = 3;
		$config['cur_page'] = $page;
		$config['use_page_numbers'] = TRUE;
		
		$this->pagination->initialize($config);
		$data['pagination']=$this->pagination->create_links();

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
		
		$articles = $this->M_article->get_articles_by_keyword($data['keyword'],$limit,($page-1)*$limit);
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
		$this->load->view('search_view');
	}
	
	public function friendlinks(){
		$cats = $this->M_cat->get_all_cat();
		$data['cat'] = $cats;
		
		$this->load->model('M_friendlink');
		
		$data['friendlinks'] = $this->M_friendlink->get_all_friendlink_by_type('100','0');
		
		//站点信息
		$data['site_name'] = $this->config->item('site_name');

		//keysords和description
		$data['site_keyword'] = $this->config->item('site_keyword');
		$data['site_description'] = $this->config->item('site_description');
		
		$this->load->view('include_header',$data);
		$this->load->view('friendlinks_view');
		
	}
	
	public function webmap(){
		$cats = $this->M_cat->get_all_cat();
		$data['cat'] = $cats;
		
		
		
		//站点信息
		$data['site_name'] = $this->config->item('site_name');

		//keysords和description
		$data['site_keyword'] = $this->config->item('site_keyword');
		$data['site_description'] = $this->config->item('site_description');
		
		$this->load->view('include_header',$data);
		$this->load->view('webmap_view');
	}
	
	public function getitemdataonlocal(){
		$catid = $this->input->post('catid');
		$labelid = $this->input->post('labelid');
		$sort = $this->input->post('sort');
		
		if($sort =='click_count')
			$sort .= ' desc';
		else if($sort == 'price')
			$sort .= ' asc';
		else if($sort == 'adddatetime')
			$sort .= ' desc';
		else echo false;
		
		$itemsinfo = $this->M_item->get_all_item_by_cid('24','0',$catid,$labelid,$sort);
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
			$item_info_array['redirect_url']= site_url('home/redirect').'/'.$iteminfo->id;
			$item_info_array['img_url']=$iteminfo->img_url;
			$item_info_array['price']=$iteminfo->price;
			$item_info_array['sellernick']=$iteminfo->sellernick;
			$item_info_array['comment']=$iteminfo->comment;
			$item_info_array['oldprice']=$iteminfo->oldprice;
			$item_info_array['discount']=$iteminfo->discount;
			$item_info_array['click_count']=$iteminfo->click_count;
			$item_info_array['good']=$iteminfo->good;
			$item_info_array['unlike']=$iteminfo->unlike;
			
			$itemsresult[] = $item_info_array;
			}
		}}
		
		echo json_encode($itemsresult);
	}
	
	public function vote(){
		$identification = $this->input->post('identification');
		$id = $this->input->post('id');
		$value = $this->input->post('value');
		
		if($identification == 'article'){
			if('good' == $value){
				$this->M_article->vote_good($id);
			}else if('unlike' == $value){
				$this->M_article->vote_unlike($id);
			}
		}else if($identification == 'joke'){
			if('good' == $value){
				$this->M_joke->vote_good($id);
			}else if('unlike' == $value){
				$this->M_joke->vote_unlike($id);
			}
		}
		 else if($identification == 'item'){
			if('good' == $value){
				$this->M_item->vote_good($id);
			}else if('unlike' == $value){
				$this->M_item->vote_unlike($id);
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
