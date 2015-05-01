<div class="container bs-docs-container"  style="padding-top:80px;"  id="top" >

      <div class="row">
		<div class="col-md-7 col-md-offset-1" role="main">
 <p><h1><?php echo $article->title?><h1></p>

<?php echo $article->html;?>

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

<script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/bootstrap/js/doc.js"></script>

</body>
</html>
