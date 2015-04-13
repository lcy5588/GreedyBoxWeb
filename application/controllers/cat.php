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
	}

	/**
	 * 类目页
	 *
	 * @cat_slug string 类目slug，比如pants
	 *@offset integer 数据库偏移，如果是40则从40开始读取数据
	 *
	 */
	public function index($cat_slug,$page = 1)
	{
       //$this->output->cache(10);
	   // todo 修改为页码数

		$this->config->load('site_info');

		$limit=40;
		//每页显示数目
		$cat_slug_decode = rawurldecode($cat_slug);

		$config['base_url'] = site_url('/cat/'.$cat_slug);
		//site_url可以防止换域名代码错误。
		
		//分类标题
		$cat = $this->M_cat->get_cat_by_slug($cat_slug_decode);
		
		$pagetypeid = $cat->typeid;
		
		$identification = $this->M_pagetype->get_pagetype_identification($pagetypeid);
		
		if($identification == 'article'){
			$config['total_rows'] = $this->M_article->count_articles($cat->id);
		}else if($identification == 'item'){
			$config['total_rows'] = $this->M_item->count_items($cat_slug_decode);
		}else if($identification == 'joke'){
			//$config['total_rows'] = $this->M_article->count_articles($cat->id);
		}
		
		
		//这是模型里面的方法，获得总数。

		$config['per_page'] = $limit;
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['num_links']=10;
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
		
		$data['cat']=$this->M_cat->get_all_cat();

		$data['cat_slug'] = $cat_slug_decode;

		//所有条目数据
		//$data['items']=$this->M_item->get_all_item($limit,($page-1)*$limit,$cat_slug_decode);
		
		
		
		//$this->load->model('M_bannerpic');
		
		
		
		
		
		//站点信息
		$data['site_name'] = $this->config->item('site_name');

		//keysords和description
		$data['site_keyword'] = $this->config->item('site_keyword');
		$data['site_description'] = $this->config->item('site_description');
		
		
		if($identification == 'article'){
			$articles = $this->M_article->get_all_articles();
			$data['articles'] = $articles;
		}else if($identification == 'item'){
			$itemcat = array();
		
			if(!empty($cat)){
				$itemcat['item'] = $this->M_item->get_all_item($limit,($page-1)*$limit,$cat_slug_decode);
				$itemcat['brand'] = $this->M_brand->get_all_brand(10,0,$cat_slug_decode);
				$itemcat['label'] = $this->M_label->get_all_label(8,0,$cat_slug_decode);
				//$itemcat['bannerpic'] = $this->M_bannerpic->get_bannerpic_loop_by_type(1,'4');
				$itemcat['cat'] = $cat;
			}
			
			$data['itemcat'] = $itemcat;
		}else if($identification == 'joke'){
			//$config['total_rows'] = $this->M_article->count_articles($cat->id);
		}
		
		$listview = $this->M_pagetype->get_pagetype_listview($pagetypeid);
		
		$this->load->view($listview,$data);

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