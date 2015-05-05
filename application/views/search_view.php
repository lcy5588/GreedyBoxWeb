
<div class="container bs-docs-container"  style="padding-top:80px;"  id="top" >

      <div class="row">
		<div class="col-md-7 col-md-offset-1" role="main">
  

<?php foreach($articles->result() as $article):?>
<div class="media bs-callout-right bs-callout-level-<?php echo $level_zd[$article->levelid]?>">
      <div class="media-left">
        <a href="<?php $clickurl = site_url('content/'.$pagetype_zd[$cat_zd[$article->cid]].'/'.$article->id);echo $clickurl;?>">
			
			<img class="lazy media-object" data-original="<?php echo $article->imgurl?>" style="width:150px;height:96px;" alt="Generic placeholder image">
			
        </a>
      </div>
      <div class="media-body">
        <h4 class="media-heading"><a href="<?php echo $clickurl;?>"><?php echo $article->title;?></a></h4>
        <?php echo $article->content;?>
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
	<?php if($jokes->num_rows() > 0){?>
	<div>
		<ul class="list-unstyled">
			<?php foreach($jokes->result() as $joke){?>
			<li class="gifcontrol">
					<a href="#" >
					  <?php echo $joke->html;?>
					</a>
			</li>
			<?php } ?>
         </ul>
	</div>
	<?php } ?>
	<div role="Advertisement">
          <ul class="list-unstyled">
			<li>
					<a href="#">
					  <img class="media-object" data-src="holder.js/250x64" alt="Generic placeholder image">
					</a>
			</li>
          </ul>
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
<script src="<?php echo base_url()?>assets/js/jquery.lazyload.min.js"></script>
<script type="text/javascript" charset="utf-8">
  $(function() {
	   $(".gifcontrol").each(function(){
			 var img = $(this).find("img");
			// img.onload = null;
			  var src = img.attr('src');
			
			 if(src.search('.gif$') > 0){
				 img.removeAttr("src")
				 img.attr('data-original',src);
				 img.addClass("lazy");
			}
		});
		
		 $(window).load(function(){
				$("img.lazy").lazyload();
			 });
			 
		$('#keyword').val($('#search-keyword').val());
  });
  
  </script>
</body>
</html>
