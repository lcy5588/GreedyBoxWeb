	<div id="page-items">
	
         <!--增加修改modal--> 
          <div class="modal fade" id="addfriendlink" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header">
      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      			<h4 class="modal-title" id="addfriendlink_modal-title">新增标签</h4>
    		</div>
        <div class="modal-body">
          <form role="form" id="addfriendlinkform" name="addfriendlinkform" method="post" action="<?php echo site_url('admin/addfriendlink')?>">
		  <input type="hidden" id="friendlinkid" name="friendlinkid" value=""/>
              <div class="form-group">
                <label for="name" class="control-label">标题</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="name">
              </div>
              <div class="form-group">
                <label for="click_url" class="control-label">点击地址</label>
                <input type="text" class="form-control" id="click_url" name="click_url" placeholder="点击地址">
              </div>  
				<div class="form-group" >
                <label for="img_url" class="control-label">图片地址</label>
                <input type="text" class="form-control" id="img_url" name="img_url" placeholder="图片地址">
              </div> 			  
             <div class="form-group" >
              <label for="type" class="control-label">类型</label>
             
                <select class="form-control" id="type" name="type">
                  
                 
                  <option value="0">0</option>
                  
                </select>
               
              </div>             			 
              
          </form>
        </div>
        <div class="modal-footer">
			<button type="button" class="btn btn-default" id="submitaddfriendlink">保存</button>
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
              <option value="">类型</option>
             </select>
            <label for="inputkeyword" class="sr-only">关键词</label>
            <input type="text" class="form-control" id="inputkeyword">
          	</div>
          	<button type="submit" class="btn btn-default">搜索</button>
          </form>
         </div>
		 
		<ul class="nav nav-pills">
		  <li class=""><button class="btn btn-primary" data-toggle="modal" data-target="#addfriendlink">添加</button></li>
		</ul>
		
	<?php if($friendlinks->num_rows()>0){ ?>

	<table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>序号</th>
        <th>名称</th>    
		<th>图片地址</th>
        <th>点击地址</th>
        <th>类别</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
	<?php
	 foreach ($friendlinks->result() as $friendlink):
	//条目开始
		?>
	<tr>
    	<th><?php echo $friendlink->id ?></th>
        <td><?php echo $friendlink->name ?></td>
		<td><img src="<?php echo $friendlink->img_url ?>" class="thumbnail" alt="" title=""></td>        
        <td style="max-width:400px;overflow:hidden;"><?php echo $friendlink->click_url; ?></td>        
        <td><?php echo $friendlink->type ?></td>
        
        <td>
        	<a href="#" title="修改此条" class="btn_update" data-friendlinkid="<?php echo $friendlink->id; ?>">修改</a>&nbsp;&nbsp;
        	<a href="#" title="删除此条" class="btn_delete"  data-friendlinkid="<?php echo $friendlink->id; ?>">删除</a>
        </td>
      </tr>
	<?php
    //条目结束
    endforeach;?>
	</tbody>
  </table>
	<div class="pagenav">
		<?php $pagination;?>
	</div>
	<?php } ?>
    </div>
 
<script>
	(function($){
        $.validity.setup({ outputMode:'boostrap' });
		
		$('.btn_delete').click(function(){
			//event.preventDefault();
			var r=confirm("你真的真的要删除吗？无法恢复！");
				if (r==true)
				{
					var that = $(this);
					var friendlinkid = $(this).data('friendlinkid');

					$.post('<?php echo site_url("admin/deletefriendlink/")?>',
						{
							friendlinkid: friendlinkid
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
			var friendlinkid = $(this).data('friendlinkid');
			$.post('<?php echo site_url("admin/getfriendlinkbyid")?>',
						{
							friendlinkid: friendlinkid
						},function(data){
								
								if(data != null){
									$('#friendlinkid').val(data['id']);
									$('#name').val(data['name']);
									$('#type').val(data['type']);
									$('#img_url').val(data['img_url']);
									$('#click_url').val(data['click_url']);																	
									$('#addfriendlink_modal-title').text('修改友链条目');
									$('#addfriendlink').modal('show');
								}else{
									alert(修改失败);
								}
							},"json");
			
		});
		
		$('#submitaddfriendlink').click(function(){
			var url = "<?php echo site_url('admin/addfriendlink')?>";
			
			if (validateMyAjaxInputs()) {
				$.post(url, $("#addfriendlinkform").serialize(),function(data){
					if(data){
						
						$('#addfriendlink').modal('hide');
						location.reload();
					}
				});
			}
		});
		
		$('#addfriendlink').on('hide.bs.modal', function (e) {
			$('#friendlinkid').val("");
			$('#name').val("");
			$('#type').val("");
			$('#img_url').val("");
			$('#click_url').val("");		
			$('#modal-title').text('新增友链');
		})
	})(jQuery);
	
	function validateMyAjaxInputs() {

			// Start validation:
			$.validity.start();
			
			// Validator methods go here:
			
			// For instance:
			$("#name").require();
			
			$("#click_url").require();
			// etc.
			
			// All of the validator methods have been called:
			// End the validation session:
			var result = $.validity.end();
			
			// Return whether it's okay to proceed with the Ajax:
			return result.valid;
	}

</script>
</body>
</html>
