<div class="container bs-docs-container"  style="padding-top:80px;"  id="top" >

      <div class="row">
		<div class="col-md-8 col-md-offset-1" role="main">
		<div id="wrapper">
<?php foreach($items as $item){?>
<div class="floor-content row" id="label_<?php echo $item['label']->slug;?>">
<div class="floor-show col-md-12 col-xs-12 col-sm-12 floor-<?php echo $item['label']->slug;?>"   style="margin-bottom: 10px;">
<div class="floor-show-left floor-title grid-row-90 col-md-3">
</div>
<div class="floor-show-middle floor-brand-slide col-md-4">
<div class="brand-slide-content brand-slide-row">
<p class="brand-slide-pannel">

</p>
</div>
</div>
<div class="floor-show-right col-md-4">
<ul class="floor-label-list">

</ul>
</div>

<div class="floor-show-sort col-md-1">
<ul>
	<li class="new"><a href="javascript:void(0);" class="sortactive" onclick="getitemdata(this,'<?php echo site_url('home/getitemdataonlocal/');?>','label--<?php echo $item['label']->slug;?>','<?php echo $item['catid'];?>','<?php echo $item['label']->id;?>','adddatetime')">最新</a></li>
	<li class="hot"><a href="javascript:void(0);" onclick="getitemdata(this,'<?php echo site_url('home/getitemdataonlocal/');?>','label--<?php echo $item['label']->slug;?>','<?php echo $item['catid'];?>','<?php echo $item['label']->id;?>','click_count')">最热</a></li>
	<li class="low"><a href="javascript:void(0);" onclick="getitemdata(this,'<?php echo site_url('home/getitemdataonlocal/');?>','label--<?php echo $item['label']->slug;?>','<?php echo $item['catid'];?>','<?php echo $item['label']->id;?>','price')">最低</a></li>
</ul>
</div>
</div>

<div id="label--<?php echo $item['label']->slug;?>">

<?php $labelitem = $item['item'];if($labelitem->num_rows()>0){ ?>
<?php foreach ($labelitem->result() as $array):?>
 <div class="col-xs-12 col-sm-4 col-md-4 item">
		<div class="thumbnail">
		  <div class="gifcontrol">
				<a href="<?php echo site_url('home/redirect').'/'.$array->id ?>" target="_blank">
					<img src="<?php echo $array->img_url; ?>" alt="" title="">
				</a>
			</div>
		  <div class="caption">
			
			<div style="border-top:2px solid #337AB7;">
				<p><h5><b><?php echo $array->title ?></b></h5></p>
				<p>--<?php echo $array->comment ?></p>
				<p>品牌:<?php echo $array->sellernick; ?></p>
				<p>￥<?php echo $array->price; ?>&nbsp;<s>￥<?php echo $array->oldprice; ?></s>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $array->discount?>折</p>
				
				<p style="text-align:left;">
					<a href="javascript:void(0);" class="vote" data-itemid="<?php echo $array->id; ?>" data-votevalue="good">
						<span class="glyphicon glyphicon-heart" aria-hidden="true">
					</a><?php echo $array->good;?></p>
			</div>
		  </div>
		</div>
	  </div>
	<?php endforeach;?>
<?php }?>
	</div>
</div>
	
<div class="middlebannerpic row">
		<a href="<?php $bannerpic=$item['bannerpic'];if($bannerpic != null){ echo site_url('home/bannerpic/'.$bannerpic->id)?>" target="_blank">
		<img class="lazy" data-original="<?php echo $bannerpic->imgurl;?>" alt="<?php echo $bannerpic->name;}?>">
		</a>
</div>
<?php } ?>
	


</div>

</div>




<div class="col-md-2" role="complementary">
          <nav class="bs-docs-sidebar hidden-print hidden-xs hidden-sm">
            <ul class="nav bs-docs-sidenav">
              <?php foreach($itemlabels->result() as $label){?>
                <li>
				  <a href="#label_<?php echo $label->slug?>"><?php echo $label->title?></a>
			    </li>
			  <?php } ?>
            </ul>
            <a class="back-to-top" href="#top">
              返回顶部
            </a> 
          </nav>
        </div>
</div>
</div>
<footer class="bs-docs-footer" role="contentinfo">
	<div class="container">
	<div class="row">   
		 <div class="col-md-12">
		
		<p> Copyright ©2014&nbsp;&nbsp;<a href="<?php echo site_url();?>" title="<?php echo $site_name;?>"><?php echo $site_name;?></a>&nbsp;&nbsp;<a href="#">友情链接</a>&nbsp;&nbsp;<a href="#">网站地图</a></p>
					 
		</div>
		</div><!--end of row-->
	 </div>
	</div>
</footer>

<script src="<?php echo base_url()?>assets/js/jquery/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/bootstrap/js/doc.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.lazyload.min.js"></script>
<script type='text/javascript' src='<?php echo base_url()?>assets/js/index.js'></script>
<script type="text/javascript" charset="utf-8">
  $(function() {
     $("img.lazy").lazyload();
     
     $(".vote").click(function(){
		var id = $(this).data('itemid');
		var value = $(this).data('votevalue');
		
		$.post('<?php echo site_url("home/vote/")?>',
						{
							identification: 'item',
							id : id,
							value : value
						},function(data){
								if(data){
									
								}
			});
		});
  });
  
   
  </script>
</body>
</html>
