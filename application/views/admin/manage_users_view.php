	<div class="container">
		<div class="row"><h3>用户管理</h3></div>
        <div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header">
      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      			<h4 class="modal-title" id="modal-title">新增用户</h4>
    		</div>
        <div class="modal-body">
		
          <form role="form" class="form-horizontal" id="adduserform" name="adduserform" method="post" action="<?php echo site_url('admin/addorupdatauser')?>">
		  
		  <input type="hidden" id="user_id" name="user_id" value=""/>
			  
			  <div class="form-group">
				<label for="name" class="col-sm-2 control-label">姓名</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="name" name="name" placeholder="姓名">
				</div>
			  </div>
			  <div class="form-group">
				<label for="email" class="col-sm-2 control-label">EMail</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="email" name="email" placeholder="EMail">
				</div>
			  </div>
			  <div class="form-group">
				<label for="avatar_url" class="col-sm-2 control-label">头像地址</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="avatar_url" name="avatar_url" placeholder="头像地址">
				</div>
			  </div>
	
			  <div class="form-group">
				<label for="access_token" class="col-sm-2 control-label">权限</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="access_token" name="access_token" placeholder="权限">
				</div>
				 <label for="open_id" class="col-sm-2 control-label">OpenID</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="open_id" name="open_id" placeholder="OpenID">
				</div>
			  </div>	  
          </form>
        </div>
        <div class="modal-footer">
		  <button type="button" class="btn btn-default" id="submitadduser">保存</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        </div>
          </div>
          </div>
          </div><!--end <div class="modal fade" id="adduser"-->
         
         <div class="row">
        <div class="col-md-4  hidden-xs hidden-sm pull-right">
          <form class="form-inline" role="form" action="" method="get" id="search">
          	<div class="form-group">
            <select class="form-control" id="searchtype">
              <option value="1" <?php if(!empty($searchtype) && $searchtype=='1') echo 'selected';?>>ID</option>
              <option value="2" <?php if(!empty($searchtype) && $searchtype=='2') echo 'selected';?>>名称</option>
             </select>
            <input type="text" class="form-control" value="<?php if(!empty($inputkeyword)) echo $inputkeyword;?>" id="inputkeyword">
          	</div>
          	<button type="button" onclick="search();" class="btn btn-default">搜索</button>
          </form>
         </div>
		 
		<ul class="col-md-2 nav nav-pills">
		  <li class=""><button class="btn btn-primary" id="usermodelbtn">添加</button></li>
		</ul>
		</div>
	<div class="row" style="margin-top:10px;">
	<?php if($query->num_rows()>0){ ?>
	
	<table class="table table-bordered table-striped" style="table-layout:fixed;word-break:break-all;overflow:hidden;" width="960px">
    <thead>
      <tr>
        <th style="width:10%;">序号</th>
        <th style="width:20%;">名称</th>
		<th style="width:10">头像</th>
        <th style="width:20%;">EMail</th>       
        <th style="width:10%;">OpenID</th>
        <th style="width:10%;">权限</th>
        <th style="width:10%;">注册时间</th>
        <th style="width:10%;">操作</th>
      </tr>
    </thead>
    <tbody>
	<?php
	 foreach ($query->result() as $array):
	//条目开始
		?>
	<tr>
    	<th style="width:10%;"><?php echo $array->id ?></th>
        <td style="width:20%;"><?php echo $array->name; ?></td>
		<td style="width:10%;">
		  <div  class="thumbnail" >
			<img src="<?php echo $array->avatar_url; ?>" alt="" title="">
		  </div>
		</td>
        <td style="width:20%;"><?php echo $array->email;?></td>        
        <td style="width:10%;"><?php echo $array->open_id; ?></td>        
        <td style="width:10%;"><?php echo $array->access_token; ?></td>
        <td style="width:10%;"><?php echo $array->adddatetime;?></td>
        <td style="width:10%;">
        	<a href="#" title="修改此条" class="btn_update" data-userid="<?php echo $array->id; ?>">修改</a>&nbsp;&nbsp;
        	<a href="#" title="删除此条" class="btn_delete"  data-userid="<?php echo $array->id; ?>">删除</a>
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
	

	<?php }?>
	
    </div>
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
					var delete_user_id = $(this).data('userid');

					$.post('<?php echo site_url("admin/deleteuser/")?>',
						{
							user_id: delete_user_id
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
			var userid = $(this).data('userid');
			$.post('<?php echo site_url("admin/getuserbyid")?>',
						{
							user_id: userid
						},function(data){

								if(data != null){
									$('#user_id').val(data['id']);
									$('#name').val(data['name']);
									$('#email').val(data['email']);
									$('#avatar_url').val(data['avatar_url']);
									$('#open_id').val(data['open_id']);
									$('#access_token').val(data['access_token']);
							
									
									$('#modal-title').text('修改用户');
									$('#adduser').modal('show');
								}else{
									alert(修改失败);
								}
							},"json");
			
		});
		
		$('#submitadduser').click(function(){
			var url = "<?php echo site_url('admin/setuser/')?>";
			if ($('#user_id').val() != ""){
				url = "<?php echo site_url('admin/updatauser/')?>";
			}
			
			if (validateMyAjaxInputs()) {
				$.post(url, $("#adduserform").serialize(),function(data){
					if(data){
						
						location.reload();
						$('#adduser').modal('hide');
					}
				});
		  }
		});
		
		$('#adduser').on('hide.bs.modal', function (e){
			$('#user_id').val("");
			$('#name').val("");
			$('#email').val("");
			$('#avatar_url').val("");
			$('#open_id').val("");
			$('#access_token').val("");
			
			$('#modal-title').text('增加商品条目');
		});
		
		
		
		$('#usermodelbtn').click(function(){
			
			$('#adduser').modal('show');
		});
		
	})(jQuery);
	
	function validateMyAjaxInputs(){
			// Start validation:
			$.validity.start();
			
			// Validator methods go here:
			
			// For instance:
			$("#name").require();
			$("#email").require();
			
			// All of the validator methods have been called:
			// End the validation session:
			var result = $.validity.end();
			
			// Return whether it's okay to proceed with the Ajax:
			return result.valid;
	}
	
	function search(){
		var keyword = $('#inputkeyword').val();
		var searchtype = $('#searchtype').val();
		var url = '<?php echo site_url('admin/manageuser/1')?>';
		
		if(searchtype == '1'){
			url = url +'/'+ keyword;
		}else{
			url = url + '/0/' + keyword;
		}
		
		location.href = url;
	}
</script>
</body>
</html>
