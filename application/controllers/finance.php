<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Finance extends CI_Controller {

	/**
	 * 类目类的构造函数
	 *
	 * pagination库用来翻页
	 * M_item用来查询条目
	 */
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('M_accountbooks');
		$this->load->model('M_accounts');
		$this->load->model('M_accounttype');
		$this->load->model('M_assets');
		$this->load->model('M_expenditures');
		$this->load->model('M_expendituretype');
		$this->load->model('M_incomes');
		$this->load->model('M_incometype');
		$this->load->model('M_liabilities');
		
		$this->load->library('pagination');
	}

	/**
	 * 类目页
	 *
	 * 
	 *@offset integer 数据库偏移，如果是40则从40开始读取数据
	 *
	 */
	public function index()
	{
		
	}
	
	public function accountbook()
	{
		$data['accountbooks']=$this->M_accountbooks->get_all_accountbooks();
		
		$this->config->load('site_info');
				
		//站点信息
		$data['site_name'] = $this->config->item('site_name');

		//keysords和description
		$data['site_keyword'] = $this->config->item('site_keyword');
		$data['site_description'] = $this->config->item('site_description');
		
		$this->load->view('admin/include_header',$data);
		$this->load->view('admin/finance/manage_accountbooks_view');
	}
	
	public function account()
	{
		$data['accounts']=$this->M_accounts->get_all_accounts();
		
		$this->config->load('site_info');
				
		//站点信息
		$data['site_name'] = $this->config->item('site_name');

		//keysords和description
		$data['site_keyword'] = $this->config->item('site_keyword');
		$data['site_description'] = $this->config->item('site_description');
		
		$this->load->view('admin/include_header',$data);
		$this->load->view('admin/finance/manage_accounts_view');
	}
	
	public function expenditure()
	{
		$data['expenditures']=$this->M_expenditures->get_all_expenditures();
		
		$this->config->load('site_info');
				
		//站点信息
		$data['site_name'] = $this->config->item('site_name');

		//keysords和description
		$data['site_keyword'] = $this->config->item('site_keyword');
		$data['site_description'] = $this->config->item('site_description');
		
		$this->load->view('admin/include_header',$data);
		$this->load->view('admin/finance/manage_expenditures_view');
	}
	
	public function income()
	{
		$data['incomes']=$this->M_incomes->get_all_incomes();
		
		$this->config->load('site_info');
				
		//站点信息
		$data['site_name'] = $this->config->item('site_name');

		//keysords和description
		$data['site_keyword'] = $this->config->item('site_keyword');
		$data['site_description'] = $this->config->item('site_description');
		
		$this->load->view('admin/include_header',$data);
		$this->load->view('admin/finance/manage_incomes_view');
	}
	
	public function asset()
	{
		$data['assets']=$this->M_assets->get_all_assets();
		
		$this->config->load('site_info');
				
		//站点信息
		$data['site_name'] = $this->config->item('site_name');

		//keysords和description
		$data['site_keyword'] = $this->config->item('site_keyword');
		$data['site_description'] = $this->config->item('site_description');
		
		$this->load->view('admin/include_header',$data);
		$this->load->view('admin/finance/manage_assets_view');
	}
	
	public function liabilities()
	{
		$data['liabilities']=$this->M_liabilities->get_all_liabilities();
		
		$this->config->load('site_info');
				
		//站点信息
		$data['site_name'] = $this->config->item('site_name');

		//keysords和description
		$data['site_keyword'] = $this->config->item('site_keyword');
		$data['site_description'] = $this->config->item('site_description');
		
		$this->load->view('admin/include_header',$data);
		$this->load->view('admin/finance/manage_liabilities_view');
	}
	
	public function accounttype()
	{
		$data['accounttype']=$this->M_accounttype->get_all_accounttype();
		
		$this->config->load('site_info');
				
		//站点信息
		$data['site_name'] = $this->config->item('site_name');

		//keysords和description
		$data['site_keyword'] = $this->config->item('site_keyword');
		$data['site_description'] = $this->config->item('site_description');
		
		$this->load->view('admin/include_header',$data);
		$this->load->view('admin/finance/manage_accounttype_view');
	}
	
	public function incometype()
	{
		$data['incometype']=$this->M_incometype->get_all_incometype();
		
		$this->config->load('site_info');
				
		//站点信息
		$data['site_name'] = $this->config->item('site_name');

		//keysords和description
		$data['site_keyword'] = $this->config->item('site_keyword');
		$data['site_description'] = $this->config->item('site_description');
		
		$this->load->view('admin/include_header',$data);
		$this->load->view('admin/finance/manage_incometype_view');
	}
	
	public function expendituretype()
	{
		$data['expendituretype']=$this->M_expendituretype->get_all_expendituretype();
		
		$this->config->load('site_info');
				
		//站点信息
		$data['site_name'] = $this->config->item('site_name');

		//keysords和description
		$data['site_keyword'] = $this->config->item('site_keyword');
		$data['site_description'] = $this->config->item('site_description');
		
		$this->load->view('admin/include_header',$data);
		$this->load->view('admin/finance/manage_expendituretype_view');
	}
	
	public function status()
	{
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */