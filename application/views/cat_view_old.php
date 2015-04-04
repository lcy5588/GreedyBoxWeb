<!DOCTYPE html>
<html dir="ltr" lang="zh-CN">
<head>
<meta charset="UTF-8" />
	<title><?php
	if(!empty($cat_name)){
		echo $cat_name.' - ';
	}
	 echo $site_name;
	 ?></title>
	<meta name="keywords" content="<?php 
	if(!empty($cat_name)){
		echo $cat_name.',';
	}
		echo $site_keyword; ?>">
	<meta name="description" content="<?php echo $site_description; ?>">
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/index.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/blockshow.css" />
	<script type='text/javascript' src='<?php echo base_url()?>assets/js/jquery/jquery-1.11.1.min.js'></script>
	<script type='text/javascript' src='<?php echo base_url()?>assets/bootstrap/js/bootstrap.js'></script>
	<script type='text/javascript' src='<?php echo base_url()?>assets/js/index.js'></script>
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
					  <input class="form-control" type="text" placeholder="" name="keyword">
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
 <div class="col-md-1">      
 <!--Sidebar content--> 
 <ul class="nav nav-pills nav-stacked" role="tablist">
      <?php
						$is_home = '';
						if(empty($cat_slug)){
							$is_home = 'active';
						}
						?>
					<li role="presentation" class="<?php echo $is_home;?>"><a href="<?php echo site_url()?>">全部</a></li>
					<?php
					   foreach($cat->result() as $row){
							$is_current = '';
							if(!empty($cat_slug) && $row->cat_slug == $cat_slug){
								$is_current = 'active';
							}
						   echo '<li role="presentation" class="'.$is_current.'"><a href="'.site_url('cat/'.rawurlencode($row->cat_slug)).'">'.$row->cat_name.'</a></li>';
						}
					 ?>
 </ul>
  </div>   
   <div class="col-md-11">  
       <!--Body content-->
	<div id="wrapper">
	
<?php if(!empty($itemcat)){?>
<div class="middlebannerpic">
<a href="<?php $bannerpic = $itemcat['bannerpic'];if(!empty($bannerpic)){ echo site_url('home/bannerpic/'.$bannerpic->id);?>" target="_blank">
	<img src="<?php echo $bannerpic->imgurl;?>" alt="<?php echo $bannerpic->name;}?>">
</a>
</div>

<div class="floor-content">
<div class="floor-show  floor-<?php echo $cat_slug;?>">
<div class="floor-show-left floor-title grid-row-90">
</div>
<div class="floor-show-middle floor-brand-slide">
<div class="brand-slide-content brand-slide-row">
<p class="brand-slide-pannel">
<?php $brands = $itemcat['brand'];if($brands->num_rows()>0){ ?>
<?php foreach ($brands->result() as $brand):?>
<a href="<?php echo site_url('home/brand/'.$brand->id)?>" target="_blank"><img src="<?php echo $brand->img_url?>" width="90" height="45" alt="<?php echo $brand->name?>"></a>
<?php endforeach;}?>
</p>
</div>
</div>
<div class="floor-show-right">
<ul class="floor-label-list">
<?php $labels = $itemcat['label'];if($labels->num_rows()>0){ ?>
<?php foreach ($labels->result() as $label):?>
<li>
<a href="<?php echo site_url('home/label/'.$label->id)?>" target="_blank"><?php echo $label->title?></a>
</li>
<?php endforeach;}?>
</ul>
</div>

<div class="floor-show-sort">
<ul>
	<li class="new"><a href="javascript:void(0);" class="sortactive" onclick="getitemdata(this,'<?php echo site_url('cat/getitemalldata/');?>','<?php echo $itemcat['cat']->cat_slug;?>','<?php echo $itemcat['cat']->cat_id;?>','adddatetime')">最新</a></li>
	<li class="hot"><a href="javascript:void(0);" onclick="getitemdata(this,'<?php echo site_url('cat/getitemalldata/');?>','<?php echo $itemcat['cat']->cat_slug;?>','<?php echo $itemcat['cat']->cat_id;?>','click_count')">最热</a></li>
	<li class="low"><a href="javascript:void(0);" onclick="getitemdata(this,'<?php echo site_url('cat/getitemalldata/');?>','<?php echo $itemcat['cat']->cat_slug;?>','<?php echo $itemcat['cat']->cat_id;?>','price')">最低</a></li>
</ul>
</div>
</div>

<div class="floor-banner-container" id="<?php echo $itemcat['cat']->cat_slug;?>">
<?php $items = $itemcat['item'];if($items->num_rows()>0){ ?>
<?php foreach ($items->result() as $array):?>

<div class="grid-col-235 grid-row-330 good-list">
	<div class="grid-good">
		<a class="grid-row-330 floor-banner" href="<?php echo site_url('home/redirect').'/'.$array->id ?>" target="_blank">
		<img src="<?php echo $array->img_url ?>" class="grid-col-235 grid-row-250" alt="<?php echo $array->title ?>" title="<?php echo $array->title ?>">		
		<div class="good-info">
			<div class="good-title"><?php echo $array->title ?></div>
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
	<div class="pagenav">
		<?=$pagination;?>
	</div>
</div>
<?php }?>

	


		</div>
 
       </div> 
       
		
		
       </div>   
     </div>




<div class="container">  
	<div class="row">   
		 <div class="col-md-11 col-md-offset-1"> 
			<footer id="ft" class="main-footer" role="contentinfo">
					<div class="panel panel-default">
					  <div class="panel-body">
						<p> Copyright ©2014&nbsp;<a href="<?php echo site_url();?>" title="<?php echo $site_name;?>"><?php echo $site_name;?></a></p>
					  </div>
					</div>
					
			</footer>
		</div>
	</div>
</div>


<script type="text/javascript">
//PUT YOUR Baidu or Google analytics code
</script>

</body>
</html>
