<div id="page-items">

	<ul class="nav nav-pills">
      <li class=""><a href="<?php echo site_url('admin/status/items')?>">按条目</a></li>
      <li class=""><a href="<?php echo site_url('admin/status/shops')?>">按店铺</a></li>
      <li class="active"><a href="<?php echo site_url('admin/status/cats')?>">按类别</a></li>
    </ul>

	<?php if($query->num_rows()>0){ ?>
	<table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>类别名称</th>
        <th>条目</th>
        <th>点击</th>
        <th>点击/条目</th>
		<th>操作</th>
      </tr>
    </thead>
    <tbody>
	<?php
	 foreach ($query->result() as $array):
	//条目开始
		?>
	<tr>
        <th><?php echo $array->cat_name ?></th>
        <th><?php echo $array->count ?></th>
        <td><?php echo $array->sum ?></td>
        <td><?php echo $array->sum/$array->count ?></td>
		<td><a href="javascript:void(0);" onclick="clearcat('<?php echo $array->cat_id ?>')">清空</a></td>
      </tr>
	<?php
    //条目结束
    endforeach;?>
        <tr>
            <th>总计</th>
            <th><?php echo $item_count_sum; ?></th>
            <th><?php echo $click_count_sum; ?></th>
            <td><?php echo $click_count_sum/$item_count_sum; ?></td>
			<td></td>
          </tr>
		</tbody>
  </table>

	<?php } ?>
</div>

</div>
<script type='text/javascript' src='<?php echo base_url()?>assets/js/jquery.js'></script>
<script>
function clearcat(catid){
		var r=confirm("你真的真的要删除吗？无法恢复！"+ catid);
			if(r == true){
				$.post('<?php echo site_url("cat/clearcat/")?>',
						{
							cid: catid
						},function(data){
								if(data){ //如果删除成功
									alert(data);
									location.reload();
								}
							});
			}
	}
</script>
</body>
</html>