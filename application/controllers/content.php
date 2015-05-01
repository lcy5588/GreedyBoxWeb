<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller {

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
	}

	/**
	 * 类目页
	 *
	 * 
	 *@offset integer 数据库偏移，如果是40则从40开始读取数据
	 *
	 */
	public function index($identification,$id)
	{

		//$this->output->cache(10);
	   // todo 修改为页码数
		
		$data['cat']=$this->M_cat->get_all_cat();
		
		$this->config->load('site_info');
				
		//关键词列表，这个在后台配置
		$data['keyword_list'] = $this->M_keyword->get_all_keyword(5);

		
		//站点信息
		$data['site_name'] = $this->config->item('site_name');

		//keysords和description
		$data['site_keyword'] = $this->config->item('site_keyword');
		$data['site_description'] = $this->config->item('site_description');
		
		
		if($identification == 'article'){
			$article = $this->M_article->get_article_by_id($id);
			$data['article'] = $article;
		}else if($identification == 'item'){
			// $itemcat = array();
		
			// if(!empty($cat)){
				// $itemcat['item'] = $this->M_item->get_all_item($limit,($page-1)*$limit,$cat_slug_decode);
				// $itemcat['brand'] = $this->M_brand->get_all_brand(10,0,$cat_slug_decode);
				// $itemcat['label'] = $this->M_label->get_all_label(8,0,$cat_slug_decode);
				// $itemcat['bannerpic'] = $this->M_bannerpic->get_bannerpic_loop_by_type(1,'4');
				// $itemcat['cat'] = $cat;
			// }
			
			// $data['itemcat'] = $itemcat;
		}else if($identification == 'joke'){
			//$config['total_rows'] = $this->M_article->count_articles($cat->id);
		}
		
		$contentview = $this->M_pagetype->get_pagetype_contentview_by_identification($identification);
		
		$this->load->view('include_header',$data);
		$this->load->view($contentview);

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
	public function _remap($identification, $params = array())
	{
		if(!$this->M_pagetype->is_exist_by_identification($identification)){
			return call_user_func_array(array('Content', $identification), $params);
		}
		//把$slug插入到$param后面，然后$param作为一个整体传递给index()调用
		array_unshift($params,$identification);

		return call_user_func_array(array('Content', 'index'), $params);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */