<div class="container bs-docs-container"  style="padding-top:80px;"  id="top" >

      <div class="row">
		<div class="col-md-7 col-md-offset-1" role="main">
  

<?php foreach($articles->result() as $article):?>
<div style="background:white;box-shadow:0px 1px 2px rgba(0, 0, 0, 0.075);" class="media bs-callout-right bs-callout-level-<?php echo $level_zd[$article->levelid]?>">
      <div class="media-left">
        <a href="<?php $clickurl = site_url('content/'.$pagetype_zd[$cat_zd[$article->cid]].'/'.$article->id);echo $clickurl;?>">
			<img class="media-object" src="<?php echo $article->imgurl?>" style="width:165px;height:130px;" alt="Generic placeholder image">
        </a>
      </div>
      <div class="media-body" style="padding-top:10px;padding-bottom:10px;">
		<div style="height:90px;">
        <h4 class="media-heading"><a href="<?php echo $clickurl;?>"><?php echo $article->title;?></a></h4>
        <?php echo $article->content;?>
		</div>
		<div style="height:10px;">
			<div class="pull-right" style="margin-right:10px;">
				<span class="glyphicon glyphicon-eye-open">1000</span>
				<span class="glyphicon glyphicon-thumbs-up">1000</span>
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
		  <a class="list-group-item <?php if($labelid == $label->id){echo "active";}?>" href="<?php echo site_url('cat/'.$slug.'/'.$label->slug)?>"><?php echo $label->title?><div class="pull-right"><span class="glyphicon glyphicon-tag"></span></div></a>
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
</body>
</html>
