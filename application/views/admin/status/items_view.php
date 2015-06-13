<div id="page-items">
	
			
    
    <div class="pull-right"><a href="<?php echo site_url('admin/clear_expire') ?>" class="btn btn-danger">删除所有下架商品</a></div>
	<div class="pull-right" style="margin-right:10px;"><a href="javascript:void(0);" class="btn btn-danger" onclick="deleteall();">删除所有商品</a></div>
	<ul class="nav nav-pills">
      <li class="active"><a href="<?php echo site_url('admin/status/items')?>">按条目</a></li>
      <li class=""><a href="<?php echo site_url('admin/status/shops')?>">按店铺</a></li>
      <li class=""><a href="<?php echo site_url('admin/status/cats')?>">按类别</a></li>
    </ul>
	<table class="table table-bordered table-striped" style="margin-top:10px;">
			<thead>
			  <tr>
				<th>逾期时间</th>
				<th>条目</th>
				<th>点击</th>
				<th>点击/条目</th>
				<th>操作</th>
			  </tr>
			</thead>
			<tbody>
			<?php
			 foreach ($itemsstatus as $itemstatus):
				//条目开始
					?>
				<tr>
					<th><?php echo $itemstatus['overdays'].'<= - <'.$itemstatus['enddays'] ?></th>
					<th><?php echo $itemstatus['count'] ?></th>
					<th><?php echo $itemstatus['sum'] ?></th>
					<th><?php if($itemstatus['count'] != 0){ echo $itemstatus['sum']/$itemstatus['count'];} ?></th>
					<th>
						<a href="javascript:void(0);" onclick="deleteoverdays('<?php echo $itemstatus['overdays'] ?>')">删除<a>
						<a href="javascript:void(0);" onclick="disableoverdays('<?php echo $itemstatus['overdays'] ?>')">禁用<a>
					</th>
			    </tr>
				<?php
        //条目结束
        endforeach;?>
			</tbody>
		  </table>
	<?php if($query->num_rows()>0){ ?>
	<table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>名称</th>
        <th>缩略图</th>
        <th>点击</th>
        <th>卖家</th>
        <th>价格</th>
        <th>链接</th>
        <th>删除</th>
      </tr>
    </thead>
    <tbody>
	<?php
	 foreach ($query->result() as $array):
	//条目开始
		?>
	<tr>
        <th><?php echo $array->title ?></th>
        <td><img src="<?php echo $array->img_url ?>" class="thumbnail" alt="" title=""></td>
        <td><?php echo $array->click_count;?></td>
        <td><?php echo $array->sellernick ?></td>
        <td><strong><?php echo $array->price ?></strong></td>
        <td><?php echo site_url('home/redirect').'/'.$array->id ?></td>
        <td><a href="##" title="删除此条" class="btn_delete" data-itemid="<?php echo $array->id; ?>">删除</a></td>
      </tr>
	<?php
    //条目结束
    endforeach;?>
		</tbody>
  </table>
	<nav class="col-md-12">
	  <ul class="pagination">
		<?php echo $pagination;?>
	  </ul>
	</nav>
	<?php } ?>
</div>

<script type='text/javascript' src='<?php echo base_url()?>assets/js/jquery.js'></script>
<script>
	(function($){
		$('.btn_delete').click(function(){
			//event.preventDefault();
			var r=confirm("你真的真的要删除吗？无法恢复！");
				if (r==true)
				{
					var that = $(this);
					var delete_item_id = $(this).data('itemid');

					$.post('<?php echo site_url("admin/delete_item/")?>',
						{
							item_id: delete_item_id
						},function(data){
								if(data){ //如果删除成功
									that.parents('tr').fadeToggle();
								}
							});
				} else
				{
				}
		});
	})(jQuery);
	
	function deleteoverdays(days){
		var r=confirm("你真的真的要删除吗？无法恢复！");
			if(r == true){
				$.post('<?php echo site_url("admin/delete_overdays/")?>',
						{
							days: days
						},function(data){
								if(data){ //如果删除成功
									alert("删除成功");
									location.reload();
								}
							});
			}
	}
	
	function disableoverdays(days){
		var r=confirm("你真的真的要删除吗？无法恢复！");
			if(r == true){
				// $.post('<?php echo site_url("admin/disable_overdays/")?>',
						// {
							// days: days
						// },function(data){
								// if(data){ //如果删除成功
									// alert("禁用成功");
									// location.reload();
								// }
							// });
			}
	}
	
	function deleteall(){
		var r=confirm("你真的真的要删除吗？无法恢复！");
			if(r == true){
				$.post('<?php echo site_url("admin/delete_all_item")?>',{},function(data){
								if(data){ //如果删除成功
									alert("全部删除成功");
									location.reload();
								}
							});
			}
	}
</script>

</body>
</html>