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
                <label for="cat_id">淘宝类别ID</label>
                <input type="text" class="form-control" id="id" name="id" placeholder="淘宝类别ID">
              </div>
              <div class="form-group">
                <label for="cat_name">分类名称</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="分类名称">
              </div>  
				<div class="form-group">
                <label for="cat_slug">英文缩写（slug）</label>
                <input type="text" class="form-control" id="slug" name="slug" placeholder="英文缩写（slug）">
              </div> 			          			 
              <button type="button" class="btn btn-default submitaddcat" id="submitaddcat" name="submitaddcat">Submit</button>
			  <button type="submit" class="btn btn-default">go</button>
          </form>
        </div>
        <div class="modal-footer">
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
                <td><a href="<?php echo site_url('admin/catdelete/'.$row->id);?>">×</a></td>
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
		$('#submitaddcat').click(function () {
			var url = "<?php echo site_url('admin/addcat')?>";
			
			$.post(url,$('#addcatform').serialize(),function(data){
				if(data){
					$('#addcat').modal('hide');
					location.reload();
				}
			});
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
           
                 data = JSON.stringify(data);
				
                    // The rest of this code assumes you are not using a library.
                    // It can be made less wordy if you use one.
                    var form = document.createElement("form");
                    form.setAttribute("method", 'POST');
                    form.setAttribute("action", "<?php echo site_url('admin/catupdate_op');?>");

                    var hiddenField = document.createElement("input");
                    hiddenField.setAttribute("type", "hidden");
                    hiddenField.setAttribute("name", 'data');
                    hiddenField.setAttribute("value", data);
                    
                    form.appendChild(hiddenField);

                    document.body.appendChild(form);
                    form.submit();
        });
	})(jQuery);
</script>
</body>
<html>
