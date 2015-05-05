
<div class="container bs-docs-container"  style="padding-top:80px;"  id="top" >

<div class="row">
	<div class="col-md-7 col-md-offset-1" role="main">
  
	<h4>分类</h4>
		<table>
			<?php $rowNum=10; $numrows=$cat->num_rows();if($numrows > 0){$result = $cat->result();for($i = 0;$i < $numrows;$i = $i + $rowNum){?>
			<tr style="width:100%;">
				<?php for($j = 0;$j < $rowNum && $i+$j < $numrows;$j++){?>
				<td style="width:<?php echo 1/$rowNum * 100;?>%">
					<h5><a href="<?php echo site_url('cat/'.$result[$j + $i]->slug);?>" target="_blank"><?php echo $result[$j+$i]->name;?></a></h5>
				</td>
				<?php }?>
			</tr>
			<?php }}?>
		</table>

	<h4>其他</h4>
		<table >
			<tr>
				<td style="width:20%">
					<h5><a href="<?php echo site_url('home/friendlinks');?>" target="_blank">友情链接</a></h5>
				</td>
			</tr>
			
		</table>
	</div>
	<div class="col-md-3 hidden-print hidden-xs hidden-sm" id="sidepannel">
	
	<div>
		<ul class="list-unstyled">
			
         </ul>
	</div>
	
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

<script src="<?php echo base_url()?>assets/js/jquery/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/bootstrap/js/doc.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery.gifplayer.js"></script>
</body>
</html>
