<div class="container bs-docs-container"  style="padding-top:80px;"  id="top" >

      <div class="row">
		<div class="col-md-7 col-md-offset-1" role="main" style="background:white;box-shadow:0px 1px 2px rgba(0, 0, 0, 0.075);">
		 <div style="text-align:center;">
			<h1><?php echo $article->title?></h1>
		 </div>
		 <div style="text-align:center;margin-bottom:20px;">
			<span><?php echo $article->adddatetime?></span>
			<span style="margin-left:8px;"><?php echo $authorname;?></span>
			<span class="glyphicon glyphicon-tag"><?php if(!empty($cat)){echo $cat->name;}?></span>
			<span class="glyphicon glyphicon-tag"><?php if(!empty($label)){echo $label->title;}?></span>
			<span class="glyphicon glyphicon-eye-open"><?php echo $article->click_count+1;?></span>
		 </div>
		<?php echo $article->html;?>
		<div style="width:100%;height:25px;">
			<div class="pull-right" style="margin-right:10px;">
				<button href="javascript:void(0);" style="padding:0px;" class="vote btn btn-link" data-articleid="<?php echo $article->id; ?>" data-votevalue="good">
				<span class="glyphicon glyphicon-thumbs-up"></span>
				</button><span id="articleid<?php echo $article->id; ?>"><?php echo $article->good;?></span>
			</div>
		</div>
	</div>




<div class="col-md-3 hidden-print hidden-xs hidden-sm" >
	<div role="Info">
		<div class="panel panel-default">
		  <div class="panel-body">
			Basic panel example
		  </div>
		</div>
	</div>
	<div role="Advertisement">
         
    </div>
</div>
</div>
</div>
<footer class="bs-docs-footer" role="contentinfo">
	<div class="container">
	<div class="row">   
		<div class="col-md-12">
		
		<p> Copyright ©2014&nbsp;&nbsp;<a href="<?php echo site_url();?>" title="<?php echo $site_name;?>"><?php echo $site_name;?></a>&nbsp;&nbsp;<a href="<?php echo site_url('home/friendlinks')?>" target="_blank">友情链接</a>&nbsp;&nbsp;<a href="<?php echo site_url('home/webmap')?>" target="_blank">网站地图</a></p>
		
		</div>
		</div><!--end of row-->
	 </div>
	</div>
</footer>

<script src="<?php echo base_url()?>assets/js/jquery/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/bootstrap/js/doc.js"></script>
<script type="text/javascript" charset="utf-8">
  $(function() {
		$.post('<?php echo site_url("home/countarticle/").'/'.$article->id?>');
		
		$(".vote").click(function(){
		var id = $(this).data('articleid');
		var value = $(this).data('votevalue');
		var button = $(this);
		
		$.post('<?php echo site_url("home/vote/")?>',
						{
							identification: 'article',
							id : id,
							value : value
						},function(data){
								if(data){
									button.attr("disabled","disabled");
									var oldnum = $('span#articleid'+id).text();
									$('span#articleid'+id).text(parseInt(oldnum)+1);
								}
			});
		});
  });
</script>
</body>
</html>
