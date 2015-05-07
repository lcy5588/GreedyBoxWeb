	<div id="page-items">
	
         <!--增加修改modal--> 
          <div class="modal fade" id="addbrand" tabindex="-1" role="dialog" aria-brandledby="myModalbrand" aria-hidden="true">
    <div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header">
      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      			<h4 class="modal-title" id="addbrand_modal-title">新增品牌</h4>
    		</div>
        <div class="modal-body">
          <form role="form" id="addbrandform" name="addbrandform" method="post" action="<?php echo site_url('admin/addbrand')?>">
		  <input type="hidden" id="brandid" name="brandid" value=""/>
              <div class="form-group">
                <label for="name" class="control-label">标题</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="标题">
              </div>
			  <div class="form-group">
                <label for="img_url" class="control-label">图片地址</label>
                <input type="text" class="form-control" id="img_url" name="img_url" placeholder="图片地址">
              </div>
              <div class="form-group">
                <label for="click_url" class="control-label">点击地址</label>
                <input type="text" class="form-control" id="click_url" name="click_url" placeholder="点击地址">
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
			<button type="button" class="btn btn-default" id="submitaddbrand">保存</button>
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
            <label for="inputkeyword" class="sr-only">关键词</brand>
            <input type="text" class="form-control" id="inputkeyword">
          	</div>
          	<button type="submit" class="btn btn-default">搜索</button>
          </form>
         </div>
		 
		<ul class="nav nav-pills">
		  <li class=""><button class="btn btn-primary" data-toggle="modal" data-target="#addbrand">添加</button></li>
		</ul>
		
	<?php if($brands->num_rows()>0){ ?>

	<table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>序号</th>
        <th>名称</th>
		<th>图片</th>
        <th>点击地址</th>
        <th>类别</th>
        <th>点击次数</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
	<?php
	 foreach ($brands->result() as $brand):
	//条目开始
		?>
	<tr>
    	<th><?php echo $brand->id ?></th>
        <td><?php echo $brand->name ?></td>
		<td><img  class="thumbnail" src="<?php echo $brand->img_url?>"></img></td>
        <td style="max-width:400px;overflow:hidden;"><?php echo $brand->click_url; ?></td>        
        <td><?php echo $lx_zd[$brand->cid] ?></td>
        <td><?php echo $brand->click_count;?></td>
        <td>
        	<a href="#" title="修改此条" class="btn_update" data-brandid="<?php echo $brand->id; ?>">修改</a>&nbsp;&nbsp;
        	<a href="#" title="删除此条" class="btn_delete"  data-brandid="<?php echo $brand->id; ?>">删除</a>
        </td>
      </tr>
	<?php
    //条目结束
    endforeach;?>
	</tbody>
  </table>
	<nav>
	  <ul class="pagination">
		<?php echo $pagination;?>
	  </ul>
	</nav>
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
					var brandid = $(this).data('brandid');

					$.post('<?php echo site_url("admin/deletebrand/")?>',
						{
							brandid: brandid
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
			var brandid = $(this).data('brandid');
			$.post('<?php echo site_url("admin/getbrandbyid")?>',
						{
							brandid: brandid
						},function(data){

								if(data != null){
									$('#brandid').val(data['id']);
									$('#name').val(data['name']);
									$('#cid').val(data['cid']);
									$('#img_url').val(data['img_url']);
									$('#click_url').val(data['click_url']);																	
									$('#addbrand_modal-title').text('修改品牌');
									$('#addbrand').modal('show');
								}else{
									alert(修改失败);
								}
							},"json");
			
		});
		
		$('#submitaddbrand').click(function(){
			var url = "<?php echo site_url('admin/addbrand')?>";
			
			if (validateMyAjaxInputs()) {
			$.post(url, $("#addbrandform").serialize(),function(data){
				if(data){					
					$('#addbrand').modal('hide');
					location.reload();
				}
			});
		  }
		});
		
		$('#addbrand').on('hide.bs.modal', function (e) {
			$('#brandid').val("");
			$('#name').val("");
			$('#img_url').val("");
			$('#cid').val("");
			$('#click_url').val("");		
			$('#modal-title').text('新增品牌');
		})
	})(jQuery);
	
	function validateMyAjaxInputs() {

			// Start validation:
			$.validity.start();
			
			// Validator methods go here:
			
			// For instance:
			$("#name").require();
			$("#img_url").require();
			$("#cid").require();
			$("#click_url").require();
			
			
			// All of the validator methods have been called:
			// End the validation session:
			var result = $.validity.end();
			
			// Return whether it's okay to proceed with the Ajax:
			return result.valid;
	}
</script>
</body>
</html>
