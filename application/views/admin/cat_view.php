<div class="container">
<div class="modal fade" id="addcat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header">
      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      			<h4 class="modal-title" id="addcat_modal-title">新增分类</h4>
    		</div>
        <div class="modal-body">
          <form role="form" id="addcatform" name="addcatform" method="post" action="<?php echo site_url('admin/addcat')?>">
              <div class="form-group">
                <label for="cat_id" class="control-label">淘宝类别ID</label>
                <input type="text" class="form-control" id="id" name="id" placeholder="淘宝类别ID">
              </div>
              <div class="form-group">
                <label for="cat_name" class="control-label">分类名称</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="分类名称">
              </div>  
			  <div class="form-group">
                <label for="cat_slug" class="control-label">英文缩写（slug）</label>
                <input type="text" class="form-control" id="slug" name="slug" placeholder="英文缩写（slug）">
              </div> 
			  <div class="form-group">
                <label for="cat_pagetype" class="control-label">页面类型</label>
                <select class="form-control" id="pagetypeid" name="pagetypeid" value="">
                <?php
                foreach($pagetype->result() as $type){echo '<option value ="'.$type->id.'">';
					
					echo $type->name.'</option>';
					}
				?>
                </select>
              </div>			  
             
			  
          </form>
        </div>
        <div class="modal-footer">
		  <button type="button" class="btn btn-default submitaddcat" id="submitaddcat" name="submitaddcat">保存</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        </div>
          </div>
          </div>
 </div><!--end <div class="modal fade" id="additem"-->   
    <table class="table">
        <thead>
      <tr>
        <th>
          序号
        </th>
        <th>
          分类名称
        </th>
        <th>
          英文缩写（slug）
        </th>
        <th>
          页面类型
        </th>
        <th>
          淘宝ID
        </th>
        <th>
          删除
        </th>
      </tr>
    </thead>
    <tbody>
    <?php
        $index = 1;
		   foreach($cat->result() as $row){ ?>
                <tr class="cat_row">
                <td><?php echo $index?></td>
                <td><input type="text" class="cat_name input-small"  value="<?php echo $row->name?>"></td>
                <td><input type="text" class="cat_slug input-small" value="<?php echo $row->slug?>"></td>
                <td><select class="cat_typeid form-control" value="<?php echo $row->typeid?>">
                <?php
                foreach($pagetype->result() as $type){echo '<option value ="'.$type->id.'"';
					if($type->id == $row->typeid){echo 'selected="selected"';}
					echo '>'.$type->name.'</option>';
					}
				?>
                </select></td>
                <td class="cat_id" value="<?php echo $row->id;?>"><?php echo $row->id?></td>
                <td><a href="#" title="删除此条" class="btn_delete"  data-catid="<?php echo $row->id; ?>">删除</a></td>
                </tr>
                <?php 
                $index++;
			}
		 ?>
    </tbody>
  </table>
    <a href="#" title="" class="btn btn-primary" id="btn-save">保存</a>
	<button class="btn btn-primary" data-toggle="modal" data-target="#addcat">手动新增</button>
    <a href="<?php echo site_url('admin/catadd')?>" title="">新增类别</a>	
</div>
 
<script>
	(function($){
		$.validity.setup({ outputMode:'boostrap' });
		
		$('#submitaddcat').click(function () {
			var url = "<?php echo site_url('admin/addcat')?>";
			
			if (validateMyAjaxInputs()) {
				$.post(url,$('#addcatform').serialize(),function(data){
					if(data){
						$('#addcat').modal('hide');
						location.reload();
					}
				});
			}
		});
		$('#btn-save').click(function(){
            var data = new Array();
            $('.cat_row').each(function(index){
                data[index] = {
					id : $(this).find('.cat_id').attr('value'),
					 name : $(this).find('.cat_name').val(),
					 slug : $(this).find('.cat_slug').val(),
					 typeid : $(this).find('.cat_typeid').val()}
				 //var catname = $(this).find('.cat_name');
				 //alert($(this).find('.cat_typeid').val());
            });
           
             
			$.post('<?php echo site_url("admin/catupdate_op/")?>',
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
					var delete_cat_id = $(this).data('catid');
					
					$.post('<?php echo site_url("admin/catdelete/")?>',
						{
							id: delete_cat_id
						},function(data){
								if(data){ //如果删除成功
									that.parents('tr').fadeToggle();
								}
							});
				} else
				{
				}
		
		});
		
		$('#addcat').on('hide.bs.modal', function (e){
			$('#id').val("");
			$('#name').val("");
			$('#slug').val("");
			$("#pagetypeid").val("");

			$('#modal-title').text('增加类型条目');
		});
	})(jQuery);
	
	
	function validateMyAjaxInputs() {

			// Start validation:
			$.validity.start();
			
			// Validator methods go here:
			
			// For instance:
			$("#id").require();
			$("#name").require();
			$("#slug").require();
			$("#pagetypeid").require();
			
			// All of the validator methods have been called:
			// End the validation session:
			var result = $.validity.end();
			
			// Return whether it's okay to proceed with the Ajax:
			return result.valid;
	}
</script>
</body>
<html>
