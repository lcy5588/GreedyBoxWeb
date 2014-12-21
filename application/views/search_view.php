<!DOCTYPE html>
<html dir="ltr" lang="zh-CN">
<head>
<meta charset="UTF-8" />
	<title><?php echo $site_name;?></title>
	<meta name="keywords" content="<?php 
	if(!empty($keyword)){
		echo $keyword.',';
	}
		echo $site_keyword; ?>">
	<meta name="description" content="<?php echo $site_description; ?>">
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/index.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/blockshow.css" />
	<!--[if lt IE 9]>
	<script src="<?php echo base_url()?>assets/js/html5shiv.js"></script>
	<![endif]-->
</head>
<body>

<header id="branding" role="banner">
    <div id="site-title">
        <h1>
            <a href="<?php echo site_url();?>" title="<?php echo $site_name;?>" rel="home" class="logo"><?php echo $site_name;?></a>
        </h1>
		<div id="site-op">
			
			<form class="form-horizontal"  role="form" action="<?php echo site_url('home/search');?>">
			 <div class="form-group form-group-lg">				
				<div class="col-sm-10">
				  <input class="form-control" type="text" placeholder="" name="keyword" value="<?php echo $keyword?>"/>
				</div>
				<button type="submit" class="col-sm-2 btn btn-primary btn-lg">搜索</button>
			  </div>
			</form>
		</div>
		<div id="site-op-reg">
		
		</div>
    </div>

</header>
<div class="container">  
<div class="row">
	<div class="col-md-12 col-md-offset-1">  
       <!--Body content-->
	<div id="wrapper">
<?php 
if(empty($itemcat)){
	//http://s8.taobao.com/search?cat=xx&sort=coefp&q=关键词&pid=mm_11111111_0_0&style=grid 

	//cat                   类目号（后面加上该关键词相对应的类目编号，具体对应代码见附表）  
	//sort=coefp    人气宝贝（加上这个内容使出现的搜索结果都是人气宝贝）  
	//q                      关键词（后面直接添加上你想要搜的关键词中文）  
	//style=grid      大图（加上这个代码可以使搜索的结果保证以大图展示）  
		echo '你搜索的“'.$keyword.'”没有找到本站条目。<a href="http://s8.taobao.com/search?cat=&sort=coefp&q='.
		$keyword.'&pid=mm_'.$pid.'_0_0&style=grid " target="_blank">在淘宝搜索更多'.$keyword.'。</a>';
	}else{ ?>
	

<div class="middlebannerpic">
<a href="<?php $bannerpic = $itemcat['bannerpic'];if(!empty($bannerpic)){ echo site_url('home/bannerpic/'.$bannerpic->id)?>" target="_blank">
	<img src="<?php echo $bannerpic->imgurl;?>" alt="<?php echo $bannerpic->name;}?>"/>
</a>
</div>
	
<div class="floor-content">
<div class="floor-banner-container">
<?php $items = $itemcat['item'];if($items->num_rows()>0){ ?>
<?php foreach ($items->result() as $array):?>

<div class="grid-col-235 grid-row-330 good-list">
	<div class="grid-good">
		<a class="grid-row-330 floor-banner" href="<?php echo site_url('home/redirect').'/'.$array->id ?>" target="_blank">
		<img src="<?php echo $array->img_url ?>" class="grid-col-235 grid-row-250" alt="<?php echo $array->title ?>" title="<?php echo $array->title ?>">		
		<div class="good-info">
			<div class="good-title">
				<?php echo $array->title ?>
			</div>
		</div>
		</a>
		<div class="good-info-price">
			<span class="price">￥<?php echo $array->price ?></span>
			<span class="oldprice">￥<?php echo $array->oldprice?></span>
			<span class="discount"><?php echo $array->discount?>折</span>
		</div>
	</div>
</div>
<?php endforeach;}?>
</div>
	
</div>
<?php
			echo '<div style="text-align:center;padding-top:20px;">没有找到满意的结果？<a href="http://s8.taobao.com/search?cat=&sort=coefp&q='.
		$keyword.'&pid=mm_'.$pid.'_0_0&style=grid " target="_blank">在淘宝搜索更多"'.$keyword.'"。</a></div>';
    	 } ?>

		</div> 
       </div> 
	  </div>
     </div> 
	
    	
</div>

<footer id="ft" class="main-footer" role="contentinfo">
		<p><a href="<?php echo site_url();?>" title="<?php echo $site_name;?>" target="_blank"><?php echo $site_name;?></a> ©   • Powered by <a href="https://github.com/yuguo/33pu" title="Powered by 33号铺, 一个开源的购物推荐系统">33号铺</a></p>
</footer>



</body>
<html>
