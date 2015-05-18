<div class="container bs-docs-container"  style="padding-top:80px;"  id="top" >

      <div class="row">
		<div class="col-md-7 col-md-offset-1" role="main">
  
<div class="row" id="timeline" data-columns="3">
<?php foreach($jokes->result() as $joke):?>

  <div class="item">
    <div class="thumbnail">
      <?php if(!empty($joke->img_url)){?>
		  <div class="gifcontrol">
			<img src="<?php echo $joke->img_url?>">
		  </div>
	<?php }?>
      <div class="caption">
        
        <div>
			<?php echo $joke->html;?>
        </div>
        
      </div>
    </div>
  </div>
<?php endforeach;?>
</div>
<nav>
  <ul class="pagination">
    <?php echo $pagination;?>
  </ul>
</nav>

</div>




<div class="col-md-3 hidden-print hidden-xs hidden-sm" >
		<div role="Info">
		<div class="panel panel-default">
		  <div class="panel-body">
			Basic panel example
		  </div>
		</div>
	</div>
	<div role="Info">
         <div class="list-group">
		  <?php foreach($labels->result() as $label){?>
		  <a class="list-group-item <?php if($labelid == $label->id){echo "active";}?>" href="<?php echo site_url('cat/'.$slug.'/'.$label->slug)?>"><?php echo $label->title?></a>
		<?php }?>
		</div>
    </div>
	
	<div role="Advertisement">
          <ul class="list-unstyled">
			<li>
					<a href="#">
					  <img class="media-object" data-src="holder.js/64x64" alt="Generic placeholder image">
					</a>
			</li>
			<li>
					<a href="#">
					  <img class="media-object" data-src="holder.js/64x64" alt="Generic placeholder image">
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

<script src="<?php echo base_url()?>assets/js/jquery/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/bootstrap/js/doc.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.gifplayer.js"></script>
<script src="<?php echo base_url()?>assets/js/salvattore.min.js"></script>
<script type="text/javascript" charset="utf-8">
  $(function() {
	   $(".gifcontrol").each(function(){
			 var img = $(this).find("img");
			 if(img.length > 0){
				  var src = img.attr('src');

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
  });
  </script>
</body>
</html>
