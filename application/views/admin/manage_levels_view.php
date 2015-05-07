<div class="container">
<div class="modal fade" id="addlevel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header">
      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      			<h4 class="modal-title" id="addlevel_modal-title">新增分类</h4>
    		</div>
        <div class="modal-body">
          <form role="form" id="addlevelform" name="addlevelform" method="post" action="<?php echo site_url('admin/addlevel')?>">
              <div class="form-group">
                <label for="id" class="control-label">级别ID:</label>
				<input type="text" class="form-control" id="id" name="id" placeholder="级别名称">                
              </div>
              <div class="form-group">
                <label for="name" class="control-label">级别名称</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="级别名称">
              </div>  
				<div class="form-group">
                <label for="color" class="control-label">级别颜色</label>
                <input type="text" class="form-control" id="color" name="color" placeholder="级别颜色">
              </div> 			          			 
             
		
          </form>
        </div>
        <div class="modal-footer">
			 <button type="button" class="btn btn-default submitaddlevel" id="submitaddlevel" name="submitaddlevel">保存</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        </div>
          </div>
          </div>
 </div><!--end <div class="modal fade" id="additem"-->   
 
    
	
    <table class="table">
        <thead>
      <tr>
        <th>
          级别ID
        </th>
        <th>
          级别名称
        </th>
        <th>
          级别颜色
        </th>
        <th>
          删除
        </th>
      </tr>
    </thead>
    <tbody>
    <?php
        
		   foreach($level->result() as $row){ ?>
                <tr class="level_row">
                <td><input type="text" class="level_id input-small"  value="<?php echo $row->id ?>"></td>
                <td><input type="text" class="level_name input-small"  value="<?php echo $row->name ?>"></td>
                <td><input type="text" class="level_color input-small" value="<?php echo $row->color ?>"></td>           
                <td>
					<a href="#" title="删除此条" class="btn_delete"  data-levelid="<?php echo $row->id; ?>">删除</a>
                </tr>
                <?php 
                
			}
		 ?>
    </tbody>
  </table>
 <div class="pull-right">
		<button class="btn btn-primary" onclick="resetleveldefaultdata();" style="float:right;">重置默认值</button>
	</div>
	<ul class="nav nav-pills">
		<li class=""><button class="btn btn-primary" title="" class="btn btn-primary" id="btn-save">保存</button></li>
		<li class=""><button class="btn btn-primary" data-toggle="modal" data-target="#addlevel">新增</button></li>
	</ul>
	
</div>
 
<script>
	(function($){
		$.validity.setup({ outputMode:'boostrap' });
		
		$('#submitaddlevel').click(function () {
			var url = "<?php echo site_url('admin/addlevel')?>";
			if (validateMyAjaxInputs()) {
				$.post(url,$('#addlevelform').serialize(),function(data){
					if(data){
						$('#addlevel').modal('hide');
						location.reload();
					}
				});
			}
		});
		$('#btn-save').click(function(){
            var data = new Array();
            $('.level_row').each(function(index){
                data[index] = {
					id : $(this).find('.level_id').val(),
					 name : $(this).find('.level_name').val(),
					 color : $(this).find('.level_color').val()}
				 
            });
			
			$.post('<?php echo site_url("admin/updatalevel")?>',
				{data:JSON.stringify(data)},function(result){
						
						if(result != null){
							alert('保存成功');
							location.reload();
						}else{
							alert('更新失败');
						}
					});						                  
        });
        
        $('.btn_delete').click(function(){
			var r=confirm("你真的真的要删除吗？无法恢复！");
				if (r==true)
				{
					var that = $(this);
					var delete_article_id = $(this).data('levelid');
					
					$.post('<?php echo site_url("admin/deletelevel/")?>',
						{
							id: delete_article_id
						},function(data){
								if(data){ //如果删除成功
									that.parents('tr').fadeToggle();
								}
							});
				} else
				{
				}
		
		});
		
		$('#addlevel').on('hide.bs.modal', function (e){
			$('#id').val("");
			$('#name').val("");
			$('#color').val("");
			

			$('#modal-title').text('增加级别类型条目');
		});
	})(jQuery);
	
	function resetleveldefaultdata(){
		var r=confirm("你真的需要重置为默认数据？");
				if (r==true)
				{
					$.post('<?php echo site_url("admin/resetleveldefaultdata/")?>',function(data){
								
								if(data){ 
									location.reload();
								}
							});
				} 
	}
	
	function validateMyAjaxInputs() {

			// Start validation:
			$.validity.start();
			
			// Validator methods go here:
			
			// For instance:
			$("#id").require();
			$("#name").require();
			$("#color").require();
			
			// etc.
			
			// All of the validator methods have been called:
			// End the validation session:
			var result = $.validity.end();
			
			// Return whether it's okay to proceed with the Ajax:
			return result.valid;
	}
</script>
</body>
<html>
