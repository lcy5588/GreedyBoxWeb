	<div id="page-items">
	
         <!--增加修改modal--> 
          <div class="modal fade" id="addlabel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header">
      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      			<h4 class="modal-title" id="addlabel_modal-title">新增标签</h4>
    		</div>
        <div class="modal-body">
          <form role="form" id="addlabelform" name="addlabelform" method="post" action="<?php echo site_url('admin/addlabel')?>">
		  <input type="hidden" id="labelid" name="labelid" value=""/>
              <div class="form-group">
                <label for="title">标题</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="标题">
              </div>
              <div class="form-group">
                <label for="click_url">点击地址</label>
                <input type="text" class="form-control" id="click_url" name="click_url" placeholder="点击地址">
              </div>                       
             <div class="form-group">
              <label for="cid">类型</label>
              <?php if($lxquery && $lxquery->num_rows()>0){?>
                <select class="form-control" id="cid" name="cid">
                  
                  <?php foreach($lxquery->result() as $lxarray):?>
                  <option value="<?php echo $lxarray->id;?>"><?php echo $lxarray->name;?></option>
                  <?php 
				  //结束类型
				  endforeach;?>
                </select>
                <?php } ?>
              </div>             			 
              <button type="button" class="btn btn-default" id="submitaddlabel">Submit</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        </div>
          </div>
          </div>
          </div><!--end <div class="modal fade" id="additem"-->
         
        <div class="pull-right">
          <form class="form-inline" role="form" action="" method="get" id="search">
          	<div class="form-group">
            <select class="form-control" id="ssdyx">
              <option value="">名称</option>
              <option value="">店铺</option>
              <option value="">类型</option>
             </select>
            <label for="inputkeyword" class="sr-only">关键词</label>
            <input type="text" class="form-control" id="inputkeyword">
          	</div>
          	<button type="submit" class="btn btn-default">搜索</button>
          </form>
         </div>
		 
		<ul class="nav nav-pills">
		  <li class=""><button class="btn btn-primary" data-toggle="modal" data-target="#addlabel">添加</button></li>
		</ul>
		
	<?php if($labels->num_rows()>0){ ?>

	<table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>序号</th>
        <th>名称</th>       
        <th>点击地址</th>
        <th>类别</th>
        <th>点击次数</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
	<?php
	 foreach ($labels->result() as $label):
	//条目开始
		?>
	<tr>
    	<th><?php echo $label->id ?></th>
        <td><?php echo $label->title ?></td>        
        <td style="max-width:400px;overflow:hidden;"><?php echo $label->click_url; ?></td>        
        <td><?php echo $label->cid ?></td>
        <td><?php echo $label->click_count;?></td>
        <td>
        	<a href="#" title="修改此条" class="btn_update" data-labelid="<?php echo $label->id; ?>">修改</a>&nbsp;&nbsp;
        	<a href="#" title="删除此条" class="btn_delete"  data-labelid="<?php echo $label->id; ?>">删除</a>
        </td>
      </tr>
	<?php
    //条目结束
    endforeach;?>
	</tbody>
  </table>
	<div class="pagenav">
		<?php echo $pagination;?>
	</div>
	<?php } ?>
    </div>
 
<script>
	(function($){
		$('.btn_delete').click(function(){
			//event.preventDefault();
			var r=confirm("你真的真的要删除吗？无法恢复！");
				if (r==true)
				{
					var that = $(this);
					var labelid = $(this).data('labelid');

					$.post('<?php echo site_url("admin/deletelabel/")?>',
						{
							labelid: labelid
						},function(data){
								if(data){ //如果删除成功
									that.parents('tr').fadeToggle();
								}
							});
				} else
				{
				}
		});
		
		$('.btn_update').click(function(){
			var that = $(this);
			var labelid = $(this).data('labelid');
			$.post('<?php echo site_url("admin/getlabelbyid")?>',
						{
							labelid: labelid
						},function(data){

								if(data != null){
									$('#labelid').val(data['id']);
									$('#title').val(data['title']);
									$('#cid').val(data['cid']);
									$('#click_url').val(data['click_url']);																	
									$('#addlabel_modal-title').text('修改商品条目');
									$('#addlabel').modal('show');
								}else{
									alert(修改失败);
								}
							},"json");
			
		});
		
		$('#submitaddlabel').click(function(){
			var url = "<?php echo site_url('admin/addlabel')?>";

			$.post(url, $("#addlabelform").serialize(),function(data){
				if(data){					
					$('#addlabel').modal('hide');
					location.reload();
				}
			});
		});
		
		$('#addlabel').on('hide.bs.modal', function (e) {
			$('#labelid').val("");
			$('#title').val("");
			$('#cid').val("");
			$('#click_url').val("");		
			$('#modal-title').text('新增标签');
		})
	})(jQuery);
</script>
</body>
</html>
