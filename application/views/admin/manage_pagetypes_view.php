<div class="container">
<div class="modal fade" id="addpagetype" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header">
      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      			<h4 class="modal-title" id="addpagetype_modal-title">新增分类</h4>
    		</div>
        <div class="modal-body">
          <form role="form" id="addpagetypeform" name="addpagetypeform" method="post" action="<?php echo site_url('admin/addpagetype')?>">
              <div class="form-group">
                <label class="control-label">页面类型ID:</label>
				<input type="text" class="form-control" id="id" name="id" placeholder="级别名称">                
              </div>
			  
			  <div class="form-group">
                <label for="identification" class="control-label">页面类型标识</label>
                <input type="text" class="form-control" id="identification" name="identification" placeholder="页面类型标识">
              </div>
              <div class="form-group">
                <label for="name" class="control-label">页面类型名称</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="级别名称">
              </div>  
				<div class="form-group">
                <label for="color" class="control-label">对应浏览页面名</label>
                <input type="text" class="form-control" id="contentview" name="contentview" placeholder="对应浏览页面名">
              </div> 			          			 
             <div class="form-group">
                <label for="color" class="control-label">对应列表页面名</label>
                <input type="text" class="form-control" id="listview" name="listview" placeholder="对应列表页面名">
              </div> 
		
          </form>
        </div>
        <div class="modal-footer">
			 <button type="button" class="btn btn-default submitaddpagetype" id="submitaddpagetype" name="submitaddpagetype">保存</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        </div>
          </div>
          </div>
 </div><!--end <div class="modal fade" id="additem"-->   
    <table class="table">
        <thead>
      <tr>
        <th>
          页面类型ID
        </th>
		<th>
          页面类型标识
        </th>
        <th>
          页面类型名称
        </th>
        <th>
          对应浏览页面名
        </th>
		 <th>
          对应列表页面名
        </th>
        <th>
          删除
        </th>
      </tr>
    </thead>
    <tbody>
    <?php
         
		   foreach($pagetype->result() as $row){ ?>
                <tr class="pagetype_row">
				<td><input type="text" class="pagetype_id input-small"  value="<?php echo $row->id ?>"></td>
                <td><input type="text" class="pagetype_identification input-small"  value="<?php echo $row->identification ?>"></td>
                <td><input type="text" class="pagetype_name input-small"  value="<?php echo $row->name ?>"></td>
				<td><input type="text" class="pagetype_contentview input-small" value="<?php echo $row->contentview ?>"></td>
                <td><input type="text" class="pagetype_listview input-small" value="<?php echo $row->listview ?>"></td>           
                <td>
					<a href="#" title="删除此条" class="btn_delete"  data-pagetypeid="<?php echo $row->id; ?>">删除</a>
                </tr>
                <?php 
                
			}
		 ?>
    </tbody>
  </table>
    <a href="javascript:void(0);" title="" class="btn btn-primary" id="btn-save">保存</a>
	<button class="btn btn-primary" data-toggle="modal" data-target="#addpagetype">新增</button>
	<button class="btn btn-primary" onclick="resetpagetypedefaultdata();" style="float:right;">重置默认值</button>

</div>
 
<script>
	(function($){
		$.validity.setup({ outputMode:'boostrap' });
		
		$('#submitaddpagetype').click(function () {
			var url = "<?php echo site_url('admin/addpagetype')?>";
			if (validateMyAjaxInputs()) {
				$.post(url,$('#addpagetypeform').serialize(),function(data){
					if(data){
						$('#addpagetype').modal('hide');
						location.reload();
					}
				});
			}
		});
		$('#btn-save').click(function(){
			
            var data = new Array();
            $('.pagetype_row').each(function(index){
                data[index] = {
					id : $(this).find('.pagetype_id').val(),
					 name : $(this).find('.pagetype_name').val(),
					 listview : $(this).find('.pagetype_listview').val(),
					 contentview : $(this).find('.pagetype_contentview').val(),
					 identification : $(this).find('.pagetype_identification').val()};
				
            });
			
			
			$.post('<?php echo site_url("admin/updatapagetype/")?>',
			{data:JSON.stringify(data)},function(result){
						
						if(result != null){
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
					var delete_pagetype_id = $(this).data('pagetypeid');
					
					$.post('<?php echo site_url("admin/deletepagetype/")?>',
						{
							id: delete_pagetype_id
						},function(data){
								if(data){ //如果删除成功
									that.parents('tr').fadeToggle();
								}
							});
				} else
				{
				}
		
		});
		
		$('#addpagetype').on('hide.bs.modal', function (e){
			$('#id').val("");
			$('#name').val("");
			$('#listview').val("");
			$('#contentview').val("");
			$("#identification").val("");
			
			$('#modal-title').text('增加页面类型条目');
		});
	})(jQuery);
	
	function resetpagetypedefaultdata(){
		var r=confirm("你真的需要重置为默认数据？");
				if (r==true)
				{
					$.post('<?php echo site_url("admin/resetpagetypedefaultdata/")?>',function(data){
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
			$("#listview").require();
			$("#contentview").require();
			$("#identification").require();
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
