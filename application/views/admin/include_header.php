<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
<meta charset="UTF-8" />

	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/backend.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/index.css?d=20120705" />
	<script type='text/javascript' src='<?php echo base_url()?>assets/js/jquery/jquery-1.11.1.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js'></script>
</head>
<body style="padding-top:60px;">

<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">          
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="">
                 <a href="<?php echo site_url('admin')?>">搜索添加商品</a>
              </li>
              <li class="">
                 <a href="<?php echo site_url('admin/manageitem')?>">商品管理</a>
              </li>
			  <li class="">
                 <a href="<?php echo site_url('admin/managebanner')?>">专题/活动管理</a>
              </li>
              <li class="">
                <a href="<?php echo site_url('admin/cat')?>">类别管理</a>
              </li>
			  <li class="">
                <a href="<?php echo site_url('admin/managebrand')?>">品牌管理</a>
              </li>
              <li class="">
                <a href="<?php echo site_url('admin/keyword')?>">搜索关键词管理</a>
              </li>
			  <li class="">
                <a href="<?php echo site_url('admin/managelabel')?>">标签管理</a>
              </li>
			  <li class="">
                <a href="<?php echo site_url('admin/managefriendlink')?>">友链管理</a>
              </li>
			  <li class="">
                 <a href="<?php echo site_url('admin/manageitem')?>">用户管理</a>
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