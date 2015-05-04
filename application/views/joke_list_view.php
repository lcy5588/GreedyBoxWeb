<div class="container bs-docs-container"  style="padding-top:80px;"  id="top" >

      <div class="row">
		<div class="col-md-7 col-md-offset-1" role="main">
  

<?php foreach($jokes->result() as $joke):?>
<div class="media bs-callout-right bs-callout-info-right">
      <div class="media-left">
        <a href="#">
			<img class="media-object" data-src="holder.js/64x64" alt="Generic placeholder image">
        </a>
      </div>
      <div class="media-body gifcontrol">
        <h4 class="media-heading"></h4>
        <?php echo $joke->html;?>
      </div>
</div>

<?php endforeach;?>

<nav>
  <ul class="pagination">
    <?php echo $pagination;?>
  </ul>
</nav>

</div>




<div class="col-md-3 hidden-print hidden-xs hidden-sm" >
	<div>
		<ul class="list-unstyled">
			<li>
					<a href="#">
					  <img class="media-object" data-src="holder.js/180x180" alt="Generic placeholder image">
					</a>
			</li>
         </ul>
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
		
		<p> Copyright ©2014&nbsp;&nbsp;<a href="<?php echo site_url();?>" title="<?php echo $site_name;?>"><?php echo $site_name;?></a>&nbsp;&nbsp;<a href="#">友情链接</a>&nbsp;&nbsp;<a href="#">网站地图</a></p>
					 
		</div>
		</div><!--end of row-->
	 </div>
	</div>
</footer>

<script src="<?php echo base_url()?>assets/js/jquery/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/bootstrap/js/doc.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.gifplayer.js"></script>
<script type="text/javascript" charset="utf-8">
  $(function() {
	   $(".gifcontrol").each(function(){
			 var img = $(this).find("img");
			
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
		});
  });
  </script>
</body>
</html>
