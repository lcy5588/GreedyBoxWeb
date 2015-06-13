<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
<meta charset="UTF-8" />

	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap-datetimepicker.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/backend.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/index.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/gifplayer.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/jquery.validity.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/salvattoremax.css" />
	<link rel="stylesheet" href="<?php echo base_url()?>assets/sideimg.css" />
	<script type='text/javascript' src='<?php echo base_url()?>assets/js/jquery/jquery-1.11.1.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url()?>assets/bootstrap/js/bootstrap-datetimepicker.zh-CN.js'></script>
	<script type='text/javascript' src='<?php echo base_url()?>assets/js/jquery.validity.min.js'></script>
	<script type='text/javascript' src="<?php echo base_url()?>assets/ckeditor/ckeditor.js"></script>
	<script type='text/javascript' src="<?php echo base_url()?>assets/js/jquery.gifplayer.js" ></script>
</head>
<body style="padding-top:60px;">

<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">          
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">基础设置<span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
				  <li class="">
					<a href="<?php echo site_url('admin/managepagetype')?>">1.页面类型管理</a>
				  </li>
				  <li class="">
					<a href="<?php echo site_url('admin/managelevel')?>">2.级别管理</a>
				  </li>
				  <li class="">
					<a href="<?php echo site_url('admin/cat')?>">3.类别管理</a>
				  </li>
				   <li class="">
					<a href="<?php echo site_url('admin/managelabel')?>">4.标签管理</a>
				  </li>
				  <li class="">
					<a href="<?php echo site_url('admin/keyword')?>">搜索关键词管理</a>
				  </li>
				</ul>
			</li>
			 <li class="">
                <a href="<?php echo site_url('admin/managearticle')?>">文章项管理</a>
              </li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">商品项管理<span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
				  <li class="">
					 <a href="<?php echo site_url('admin/manageitem')?>">商品管理</a>
				  </li>
				  <li class="">
					 <a href="<?php echo site_url('admin/managebanner')?>">专题/活动管理</a>
					</li>
				  <li class="">
					<a href="<?php echo site_url('admin/managebrand')?>">品牌管理</a>
				  </li>
				  <li class="">
					 <a href="<?php echo site_url('admin')?>">搜索添加商品</a>
				  </li>
				</ul>
			</li>
			  
			   <li class="">
                <a href="<?php echo site_url('admin/managejoke')?>">笑点项管理</a>
              </li>
			  <li class="">
                <a href="<?php echo site_url('admin/managefriendlink')?>">友链管理</a>
              </li>
			  <li class="">
                 <a href="<?php echo site_url('admin/manageuser')?>">用户管理</a>
              </li>
              <li class="">
                <a href="<?php echo site_url('admin/status/items')?>">统计</a>
              </li>
              <li class="">
                <a href="<?php echo site_url('admin/logout')?>">登出</a>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li><a class="brand" href="<?php echo site_url()?>">首页</a></li>
            </ul>
        </div>
      </div>
    </div>
