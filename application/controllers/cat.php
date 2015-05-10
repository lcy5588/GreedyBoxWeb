<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cat extends CI_Controller {

	/**
	 * 类目类的构造函数
	 *
	 * pagination库用来翻页
	 * M_item用来查询条目
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_item');
		$this->load->model('M_cat');
		$this->load->model('M_keyword');
		$this->load->library('pagination');
		$this->load->model('M_brand');
		$this->load->model('M_banner');
		$this->load->model('M_label');
		$this->load->model('M_pagetype');
		$this->load->model('M_article');
		$this->load->model('M_bannerpic');
		$this->load->model('M_joke');
		$this->load->model('M_level');
	}

	/**
	 * 类目页
	 *
	 * @cat_slug string 类目slug，比如pants
	 *@offset integer 数据库偏移，如果是40则从40开始读取数据
	 *
	 */
	public function index($cat_slug,$label='all',$page = 1)
	{
       //$this->output->cache(10);
	   // todo 修改为页码数
	   $label_decode = rawurldecode($label);
	   
		$this->config->load('site_info');

		$limit=20;
		//每页显示数目
		$cat_slug_decode = rawurldecode($cat_slug);

		$config['base_url'] = site_url('/cat/'.$cat_slug.'/'.$label_decode.'/');
		//site_url可以防止换域名代码错误。
		
		//分类标题
		$cat = $this->M_cat->get_cat_by_slug($cat_slug_decode);
		
		$pagetypeid = $cat->typeid;
		
		$identification = $this->M_pagetype->get_pagetype_identification($pagetypeid);
		
		if($label_decode == 'all'){
			$label_decode = '';
		}
		
		$labelid = $this->M_label->get_labelid_by_slug($label_decode);
		
		$data['labelid'] = $labelid;
		
		if($identification == 'article'){
			$config['total_rows'] = $this->M_article->count_articles($cat->id,$labelid);
		}else if($identification == 'item'){
			$config['total_rows'] = $this->M_item->count_items($cat_slug_decode);
		}else if($identification == 'joke'){
			$config['total_rows'] = $this->M_joke->count_jokes($cat->id,$labelid);
		}
		
		
		//这是模型里面的方法，获得总数。

		$config['per_page'] = $limit;
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['num_links']=10;
		$config['uri_segment'] = 4;
		$config['cur_page'] = $page;
		$config['use_page_numbers'] = TRUE;
		//上面是自定义文字以及左右的连接数

		$this->pagination->initialize($config);
		//初始化配置

		$data['pagination']=$this->pagination->create_links();
		//通过数组传递参数

		//关键词列表，这个在后台配置
		$data['keyword_list'] = $this->M_keyword->get_all_keyword(5);

		
		
		if(!empty($cat))
		$data['cat_name'] = $cat->name;
		else $data['cat_name'] = '';
		
		$cats = $this->M_cat->get_all_cat();
		$data['cat'] = $cats;
		$data['slug'] = $cat_slug_decode;

		
		//站点信息
		$data['site_name'] = $this->config->item('site_name');

		//keysords和description
		$data['site_keyword'] = $this->config->item('site_keyword');
		$data['site_description'] = $this->config->item('site_description');
		
		$labels = $this->M_label->get_all_label_by_cid(8,0,$cat->id);
		$data['labels'] = $labels;
		
		if($identification == 'article'){
			$articles = $this->M_article->get_all_articles($limit,($page-1)*$limit,$cat->id,$labelid);
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
			
			$cat_zd = array();
			
			if($cats->num_rows()>0){
				foreach($cats->result() as $lx){
					$cat_zd[$lx->id] = $lx->typeid;
				}
			}
			
			$data['cat_zd'] = $cat_zd;
			
			$pagetypequery = $this->M_pagetype->get_all_pagetype();
			
			
			$pagetype_zd = array();
			
			if($pagetypequery->num_rows()>0){
				foreach($pagetypequery->result() as $lx){
					$pagetype_zd[$lx->id] = $lx->identification;
				}
			}
			
			$data['pagetype_zd'] = $pagetype_zd;
			
		}else if($identification == 'item'){
			
			$itemlabels = $this->M_label->get_all_label_by_cid(8,0,$cat->id);
			$items = array();
			foreach($itemlabels->result() as $label){
			
				$item = array();
			
				if(!empty($label)){
					$item['item'] = $this->M_item->get_all_item($limit,($page-1)*$limit,$cat_slug_decode,$label->id);
					//$item['brand'] = $this->M_brand->get_all_brand(10,0,$cat_slug_decode);
					//$itemcat['label'] = $this->M_label->get_all_label(8,0,$cat_slug_decode);
					$item['bannerpic'] = $this->M_bannerpic->get_bannerpic_loop_by_type(1,'4');
					//$item['cat'] = $cat;
					$item['label'] = $label;
					$item['catid'] = $cat->id;
					
					$items[] = $item;
				}
			}
			$data['items'] = $items;
			$data['itemlabels'] = $itemlabels;
		}else if($identification == 'joke'){
			$jokes = $this->M_joke->get_all_jokes($limit,($page-1)*$limit,$cat->id,$labelid);
			$data['jokes'] = $jokes;
		}
		
		$listview = $this->M_pagetype->get_pagetype_listview($pagetypeid);
		
		$this->load->view('include_header',$data);
		$this->load->view($listview);

	}

	/**
	 * url转移
	 *
	 * 把/cat/pants/50这样的url转到index($cat_slug,$offset = 0)来处理
	 * 好处是只用创建一个function index就可以处理所有的类别/shirts或者/pants等等
	 *
	 * @slug String 类别slug，比如pants
	 * @params array 其他后续参数
	 */
	public function _remap($slug, $params = array())
	{
		if(!$this->M_cat->is_exist_by_slug($slug)){
			return call_user_func_array(array('Cat', $slug), $params);
		}
		//把$slug插入到$param后面，然后$param作为一个整体传递给index()调用
		array_unshift($params,$slug);

		return call_user_func_array(array('Cat', 'index'), $params);
	}

	public function getitemalldata(){
		$catid = $this->input->post('catid');
		$sort = $this->input->post('sort');
		
		if($sort =='click_count')
			$sort .= ' desc';
		else if($sort == 'price')
			$sort .= ' asc';
		else if($sort == 'adddatetime')
			$sort .= ' desc';
		else echo false;
		
		
		$itemsinfo = $this->M_item->get_all_item_by_cid('120','0',$catid,$sort);
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

	public function clearcat()
	{
		$cid = $this->input->post("cid");
		
		$result = $this->M_cat->clear_cat_by_cid($cid);
		
		if ($result > 0){
			echo true;
		}
		else echo false;
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
