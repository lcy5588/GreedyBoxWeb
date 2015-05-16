<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<title><?php
	 if(!empty($cat_name)){echo $cat_name.' | ';}
	 else if(!empty($article)){echo $article->title.' | ';}
	 echo $site_name;
	 ?></title>
	<meta name="keywords" content="<?php 
		echo $site_keyword; ?>">
	<meta name="description" content="<?php echo $site_description; ?>">

	<link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="<?php echo base_url()?>assets/docs.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/blockshow.css" />
	<link rel="stylesheet" href="<?php echo base_url()?>assets/gifplayer.css" />
	<link rel="stylesheet" href="<?php echo base_url()?>assets/sideimg.css" />
	<link rel="stylesheet" href="<?php echo base_url()?>assets/salvattore.css" />
</head>
<body >
<header class="navbar navbar-default navbar-fixed-top" role="banner" >
<div class="container">
<div class="row">
		<div class="col-md-10 col-md-offset-1">
		<div class="navbar-header">
			 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
				<a class="navbar-brand" href="<?php echo site_url()?>">Brand</a>
		</div>
			<nav class="collapse navbar-collapse bs-navbar-collapse" id="bs-example-navbar-collapse-2">
			  <ul class="nav navbar-nav">
				  <?php
					   foreach($cat->result() as $row){
							$is_current = '';
							if(!empty($slug) && $row->slug == $slug){
								$is_current = 'active';
							}
						   echo '<li role="presentation" class="'.$is_current.'"><a href="'.site_url('cat/'.rawurlencode($row->slug)).'">'.$row->name.'</a></li>';
						}
					 ?>
			  </ul>
			  <form class="navbar-form navbar-right" role="search" action="<?php echo site_url('home/search')?>">
				<div class="form-group">
				  <input type="text" class="form-control" placeholder="Search" id="keyword" name="keyword" value="">
				</div>
				<button type="submit" class="btn btn-default">搜索</button>
			  </form>
			</nav>

		</div>
		</div>
		
</div>
</header>
