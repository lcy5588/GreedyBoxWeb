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
                <input type="text" class="form-control" id="cat_id" name="cat_id" placeholder="淘宝类别ID">
              </div>
              <div class="form-group">
                <label for="cat_name">分类名称</label>
                <input type="text" class="form-control" id="cat_name" name="cat_name" placeholder="分类名称">
              </div>  
				<div class="form-group">
                <label for="cat_slug">英文缩写（slug）</label>
                <input type="text" class="form-control" id="cat_slug" name="cat_slug" placeholder="英文缩写（slug）">
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
		   foreach($cat->result() as $row){
                echo '<tr class="cat_row">';
                echo '<td>'.$index.'</td>';
                echo '<td><input type="text" class="input-small cat_name" value="'.$row->cat_name.'"></td>';
                echo '<td><input type="text" class="input-small cat_slug" value="'.$row->cat_slug.'"></td>';
                echo '<td class="cid" value="'.$row->cat_id.'">'.$row->cat_id.'</td>';
                echo '<td><a href="'.site_url('admin/catdelete/'.$row->cat_id).'">×</a></td>';
                echo '</tr>';
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
                data[index] = {id : $(this).find('.cid').attr('value'), name : $(this).find('.cat_name').attr('value'),slug : $(this).find('.cat_slug').attr('value')}
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