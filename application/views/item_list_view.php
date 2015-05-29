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
				<h5 style="margin-bottom: 5px;"><b><?php echo $array->title ?></b></h5>
				<p style="margin-bottom: 5px;">--<?php echo $array->comment ?></p>
				<p style="margin-bottom: 5px;">
					<span style="font-size:18px;" id="level_item_<?php echo $array->id?>"><?php $avg_gradelevel = intval((floatval($array->excitablelevel) + floatval($array->excitablelevel) + floatval($array->comfortablelevel)) / 3); echo $levelscore_zd[intval($avg_gradelevel/10)]; ?><input disabled="disabled" type="number"  name="score" id="score" value="<?php echo intval($avg_gradelevel/20);?>" class="rating"/></span>
					</p>
				<p>刺激度:<input type="number" data-id="<?php echo $array->id?>" name="excitablelevel" id="excitablelevel_item_<?php echo $array->id?>" value="<?php echo intval($array->excitablelevel/20);?>" class="rating"/>
				<span><?php echo sprintf("%.1f",$array->excitablelevel) ?></span></p>
				<p>舒适度:<input type="number" data-id="<?php echo $array->id?>" name="comfortablelevel" id="comfortablelevel_item_<?php echo $array->id?>" value="<?php echo intval($array->comfortablelevel/20);?>" class="rating"/>
				<span><?php echo sprintf("%.1f",$array->comfortablelevel); ?></span>
				</p>
				<p>性感度:<input type="number" data-id="<?php echo $array->id?>" name="sexlevel" id="sexlevel_item_<?php echo $array->id?>" value="<?php echo intval($array->sexlevel/20);?>" class="rating"/>
				<span><?php echo sprintf("%.1f",$array->sexlevel)?></span></p>
				<p style="text-align:left;margin-bottom: 0px;">
					<button href="javascript:void(0);" style="padding:0px;" class="vote btn btn-link" data-itemid="<?php echo $array->id; ?>" data-votevalue="good">
						<span style="font-size:16px;" class="glyphicon glyphicon-heart" aria-hidden="true"></span>
					</button><span id="itemid<?php echo $array->id; ?>"><?php echo $array->good;?></span>
					
					<button href="javascript:void(0);" style="padding:0px;" class="btn btn-link" data-itemid="<?php echo $array->id; ?>" data-votevalue="good">
						<span style="font-size:16px;" class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button><span id="itemid<?php echo $array->id; ?>"><?php echo $array->good;?></span>
				</p>
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
<script type='text/javascript' src='<?php echo base_url()?>assets/js/bootstrap-rating-input.js'></script>
<script type="text/javascript" charset="utf-8">
  $(function() {
     $("img.lazy").lazyload();
     
     $(".vote").click(function(){
		var id = $(this).data('itemid');
		var value = $(this).data('votevalue');
		var button = $(this);
		$.post('<?php echo site_url("home/vote/")?>',
						{
							identification: 'item',
							id : id,
							value : value
						},function(data){
								if(data){
									button.attr("disabled","disabled");
									var oldnum = $('span#itemid'+id).text();
									$('span#itemid'+id).text(parseInt(oldnum)+1);
								}
			});
		});
		
	$('input.rating').on('change', function(){
		  var input = $(this);
		  var id = input.data("id");
		  var name = input.attr("name");
		  var score = input.val() * 20;
		  input.next("span").text(score);
		  
		  $.post('<?php echo site_url("home/rate/")?>',
						{
							name: name,
							id : id,
							score : score
						},function(data){
								
								if(data){
									input.prev('.rating-input').off();
									input.attr('disabled','disabled');
								}
			});
     });
  });
  
   
  </script>
</body>
</html>
