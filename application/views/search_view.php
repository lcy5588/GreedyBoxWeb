
<div class="container bs-docs-container"  style="padding-top:80px;"  id="top" >

      <div class="row">
		<div class="col-md-7 col-md-offset-1" role="main">
  

<?php foreach($articles->result() as $article):?>
<div  style="background:white;box-shadow:0px 1px 2px rgba(0, 0, 0, 0.075);" class="media bs-callout-right bs-callout-level-<?php echo $level_zd[$article->levelid]?>">
      <div class="media-left">
        <a href="<?php $clickurl = site_url('content/'.$pagetype_zd[$cat_zd[$article->cid]].'/'.$article->id);echo $clickurl;?>">
			
			<img class="media-object" src="<?php echo $article->imgurl?>" style="width:165px;height:130px;" alt="Generic placeholder image">
			
        </a>
      </div>
      <div class="media-body" style="padding-top:10px;padding-bottom:10px;padding-right:10px;">
        <div style="height:90px;">
        <h4 class="media-heading"><a href="<?php echo $clickurl;?>"><?php echo $article->title;?></a></h4>
        <?php echo mb_substr($article->content,0,100,'utf-8').'....';?>
		</div>
		<div style="height:10px;">
			<div class="pull-right">
				<span class="glyphicon glyphicon-eye-open"><?php echo $article->click_count;?></span>
				<span class="glyphicon glyphicon-thumbs-up"><?php echo $article->good;?></span>
			</div>
		</div>
      </div>
</div>

<?php endforeach;?>

<nav>
  <ul class="pagination">
    <?php echo $pagination;?>
  </ul>
</nav>

</div>




<div class="col-md-3 hidden-print hidden-xs hidden-sm" id="sidepannel">
	<div role="Info">
		<div class="panel panel-default">
		  <div class="panel-body">
			Basic panel example
		  </div>
		</div>
	</div>
	<div role="Advertisement">
         
    </div>
	<div class="row">
	<?php foreach($jokes->result() as $joke):?>

	  <div class="col-md-12">
		<div class="thumbnail">
		  <?php if(!empty($joke->img_url)){?>
		  <div class="gifcontrol">
			<img src="<?php echo $joke->img_url?>">
		  </div>
		 <?php }?>
		  <div class="caption">
			
			<div class="gifcontrol">
				<?php echo $joke->html;?>
				<div class="disabled" style="padding-top:5px;border-top:2px solid #337AB7;">
				
				<button  href="javascript:void(0);" style="padding:0px;" class="vote btn btn-link" data-jokeid="<?php echo $joke->id; ?>" data-votevalue="good">
								<span style="font-size:16px;" class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
							</button><span id="jokeid<?php echo $joke->id; ?>"><?php echo $joke->good;?></span>
				</div>
			</div>
			
		  </div>
		</div>
	  </div>
	<?php endforeach;?>
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
<input type="hidden" id="search-keyword" name="search-keyword" value="<?php echo $keyword;?>"/>

<script src="<?php echo base_url()?>assets/js/jquery/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/bootstrap/js/doc.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.gifplayer.js"></script>
<script type="text/javascript" charset="utf-8">
  $(function() {
	   $(".gifcontrol").each(function(){
			 var img = $(this).find("img");
			 if(img.length > 0){
				 var src = img.attr('src');
				 
				 img.addClass('img-responsive');
				 
				 if(src.search('.gif$') > 0){
					 
					var startpos = src.indexOf('/',7);
					var endpos = src.indexOf('/',startpos+1);
					var staticsrc = src.substr(0,startpos+1) + "thumbnail" + src.substr(endpos);
					
					img.attr('src',staticsrc);
					img.attr('data-gif',src);
					img.attr('data-wait','true');
					img.gifplayer();
				}
			}
		});
		
		$(".vote").click(function(){
		var id = $(this).data('jokeid');
		var value = $(this).data('votevalue');
		
		var button = $(this);
		
		$.post('<?php echo site_url("home/vote/")?>',
						{
							identification: 'joke',
							id : id,
							value : value
						},function(data){
							
								if(data){
									button.attr("disabled","disabled");
									var oldnum = $('span#jokeid'+id).text();
									$('span#jokeid'+id).text(parseInt(oldnum)+1);
								}
			});
		});
  });
  
  </script>
</body>
</html>
