	<div class="container">
		<div class="row"><h3>收入类型管理</h3></div>
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
                <label for="title" class="control-label">标题</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="标题">
              </div>
			   <div class="form-group">
                <label for="slug" class="control-label">标识</label>
                <input type="text" class="form-control" id="slug" name="slug" placeholder="标识">
              </div>
              
			 			  
             <div class="form-group">
              <label for="cid" class="control-label">类型</label>
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
			   
              
          </form>
        </div>
        <div class="modal-footer">
		<button type="button" class="btn btn-default" id="submitaddlabel">保存</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        </div>
          </div>
          </div>
          </div><!--end <div class="modal fade" id="additem"-->
         <div class="row">
        <div class="col-md-4  hidden-xs hidden-sm pull-right">
          <form class="form-inline" role="form" action="" method="get" id="search">
          	<div class="form-group">
            <select class="form-control" id="ssdyx">
              <option value="">名称</option>
             </select>
            <label for="inputkeyword" class="sr-only">关键词</label>
            <input type="text" class="form-control" id="inputkeyword">
          	</div>
          	<button type="submit" class="btn btn-default">搜索</button>
          </form>
         </div>
		 
		<ul class="col-md-2 nav nav-pills">
		  <li class=""><button class="btn btn-primary" data-toggle="modal" data-target="#addlabel">添加</button></li>
		</ul>
		</div>
	<?php if($incometype->num_rows()>0){ ?>
  <div class="row" style="margin-top:10px;">
	<table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>序号</th>
        <th>图标</th>
		<th>名称</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
	<?php
	 foreach ($incometype->result() as $type):
	//条目开始
		?>
	<tr>
    	<td><?php echo $type->typeid ?></td>
		<td><?php echo $type->icon ?></td>
        <td><?php echo $type->name ?></td>
        <td>
        	<a href="#" title="修改此条" class="btn_update" data-typeid="<?php echo $type->typeid; ?>">修改</a>&nbsp;&nbsp;
        	<a href="#" title="删除此条" class="btn_delete"  data-typeid="<?php echo $type->typeid; ?>">删除</a>
        </td>
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
	</div>
	<?php }?>
    
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
									$('#slug').val(data['slug']);
									$('#cid').val(data['cid']);
																										
									$('#addlabel_modal-title').text('修改商品条目');
									$('#addlabel').modal('show');
								}else{
									alert(修改失败);
								}
							},"json");
			
		});
		
		$('#addlabel').on('hide.bs.modal', function (e) {
			$('#labelid').val("");
			$('#title').val("");
			$('#cid').val("");
			$('#slug').val("");
			
			$(".has-error").each(function(){
				$(this).removeClass("has-error");
			});
			
			$('#modal-title').text('新增标签');
		});
		
		
            
		$('#submitaddlabel').click(function(){
			var url = "<?php echo site_url('admin/addlabel')?>";
			
			
			 if (validateMyAjaxInputs()) {
    
				// Do ajax:
				$.post(url, $("#addlabelform").serialize(),function(data){
					if(data){					
						$('#addlabel').modal('hide');
						location.reload();
					}
				});
					
			}
			
			
		});
		
		
	})(jQuery);
	
	function validateMyAjaxInputs() {

			// Start validation:
			$.validity.start();
			
			// Validator methods go here:
			
			// For instance:
			$("#title").require();
			$("#slug").require();
			$("#cid").require();
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
