	<div id="page-items">
	
         <!--增加修改modal--> 
          <div class="modal fade" id="additem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header">
      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      			<h4 class="modal-title" id="modal-title">新增商品条目</h4>
    		</div>
        <div class="modal-body">
		
          <form role="form" class="form-horizontal" id="additemform" name="additemform" method="post" action="<?php echo site_url('admin/addorupdataitem')?>">
		  
		  <input type="hidden" id="item_id" name="item_id" value=""/>
			  
			  <div class="form-group">
				<label for="title" class="col-sm-2 control-label">标题</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="title" name="title" placeholder="标题">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="click_url" class="col-sm-2 control-label">点击地址</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="click_url" name="click_url" placeholder="点击地址">
				</div>
			  </div>
			 
			  <div class="form-group">
				<label for="img_url" class="col-sm-2 control-label">图片地址</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="img_url" name="img_url" placeholder="图片地址">
				</div>
			  </div>
			  
				  <div class="form-group">
					<label for="sellernick" class="col-sm-2 control-label">卖家</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="sellernick" name="sellernick" placeholder="卖家">
					</div>
					 <label for="cid" class="col-sm-2 control-label">类型</label>
				  <div class="col-sm-4">
					  <?php if($lxquery && $lxquery->num_rows()>0){?>
						<select class="form-control" id="cid" name="cid">
						  
						  <?php foreach($lxquery->result() as $lxarray):?>
						  <option value="<?php echo $lxarray->cat_id;?>"><?php echo $lxarray->cat_name;?></option>
						  <?php 
						  //结束类型
						  endforeach;?>
						</select>
						<? } ?>
					</div>
				  </div>

				  <div class="form-group">
					<label for="price" class="col-sm-2 control-label">价格</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="price" name="price" placeholder="价格">
					</div>
					<label for="oldprice" class="col-sm-2 control-label">旧价格</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="oldprice" name="oldprice" placeholder="oldprice">
					</div>
				  </div>			  
				  <div class="form-group">
					<label for="discount" class="col-sm-2 control-label">折扣</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="discount" name="discount" placeholder="discount">
					</div>
					<label for="num_iid" class="col-sm-2 control-label">num_iid</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="num_iid" name="num_iid" placeholder="num_iid">
					</div>
				  </div>		  
          </form>
        </div>
        <div class="modal-footer">
		  <button type="button" class="btn btn-default" id="submitadditem">保存</button>
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
		  <li class=""><button class="btn btn-primary" id="additembtn">添加</button></li>
		  <li><?php if($lxquery && $lxquery->num_rows()>0){?>
						<select class="form-control" id="additemcid" name="additemcid">
						  
						  <?php foreach($lxquery->result() as $lxarray):?>
						  <option value="<?php echo $lxarray->cat_id;?>"><?php echo $lxarray->cat_name;?></option>
						  <?php 
						  //结束类型
						  endforeach;?>
						</select>
						<? } ?>
			</li>
		</ul>
		
	<? if($query->num_rows()>0){ ?>

	<table class="table table-bordered table-striped" style="table-layout:fixed;word-break:break-all;overflow:hidden;" width="960px">
    <thead>
      <tr>
        <th style="width:5%;">序号</th>
        <th style="width:10%;">图片</th>
        <th style="width:20%;">名称</th>       
        <th style="width:25%;">点击地址</th>
        <th style="width:15%;">卖家</th>
        <th style="width:5%;">价格</th>
        <th style="width:5%;">类别</th>
        <th style="width:5%;">点击次数</th>
        <th style="width:10%;">操作</th>
      </tr>
    </thead>
    <tbody>
	<?php
	 foreach ($query->result() as $array):
	//条目开始
		?>
	<tr>
    	<th style="width:5%;"><?php echo $array->id ?></th>
        <td style="width:10%;"><img src="<?php echo $array->img_url; ?>" class="thumbnail" alt="" title=""></td>
        <td style="width:20%;"><?php echo $array->title ?></td>        
        <td style="width:25%;"><?php echo $array->click_url; ?></td>        
        <td style="width:15%;"><?php echo $array->sellernick; ?></td>
        <td style="width:5%;"><strong><?php echo $array->price; ?></strong></td>
        <td style="width:5%;"><?php echo $array->cid ?></td>
        <td style="width:5%;"><?php echo $array->click_count;?></td>
        <td style="width:10%;">
        	<a href="#" title="修改此条" class="btn_update" data-itemid="<?php echo $array->id; ?>">修改</a>&nbsp;&nbsp;
        	<a href="#" title="删除此条" class="btn_delete"  data-itemid="<?php echo $array->id; ?>">删除</a>
        </td>
      </tr>
	<?php
    //条目结束
    endforeach;?>
	</tbody>
  </table>
	<div class="pagenav">
		<?=$pagination;?>
	</div>
	<? } ?>
    </div>
 
</div>

<script>
	(function($){
		$('.btn_delete').click(function(){
			//event.preventDefault();
			var r=confirm("你真的真的要删除吗？无法恢复！");
				if (r==true)
				{
					var that = $(this);
					var delete_item_id = $(this).data('itemid');

					$.post('<?php echo site_url("admin/delete_item/")?>',
						{
							item_id: delete_item_id
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
			var itemid = $(this).data('itemid');
			$.post('<?php echo site_url("admin/getitembyid")?>',
						{
							item_id: itemid
						},function(data){

								if(data != null){
									$('#item_id').val(data['id']);
									$('#title').val(data['title']);
									$('#cid').val(data['cid']);
									$('#click_url').val(data['click_url']);
									$('#img_url').val(data['img_url']);
									$('#price').val(data['price']);
									$('#sellernick').val(data['sellernick']);
									$('#oldprice').val(data['oldprice']);
									$('#discount').val(data['discount']);
									$('#num_iid').val(data['num_iid']);
									
									$('#modal-title').text('修改商品条目');
									$('#additem').modal('show');
								}else{
									alert(修改失败);
								}
							},"json");
			
		});
		
		$('#submitadditem').click(function(){
			var url = "<?php echo site_url('admin/setitem/')?>";
			if ($('#item_id').val() != ""){
				url = "<?php echo site_url('admin/updataitem/')?>";
			}
			$.post(url, $("#additemform").serialize(),function(data){
				if(data){
				
					/* if($('#item_id').val() == ""){
						
						$('tbody').prepend('<tr><th>'+data+'</th><td><img src="'+$('#img_url').val()+'" class="thumbnail" alt="" title=""></td>'
						+'<td>'+$('#title').val()+'</td><td>'+$('#click_url').val()+'</td><td>'+$('#sellernick').val()+'</td>'
						+'<td><strong>'+$('#price').val()+'</strong></td><td>'+$('#cid').val()+'</td><td>0</td>'
						+'<td><a href="#" title="修改此条" class="btn_update" data-itemid="'+data+'">修改</a>&nbsp;&nbsp;'
						+'<a href="#" title="删除此条" class="btn_delete"  data-itemid="'+data+'">删除</a> </td></tr>').fadeIn();
					} */
					
					location.reload();
					$('#additem').modal('hide');
				}
			});
		});
		
		$('#additem').on('hide.bs.modal', function (e){
			$('#item_id').val("");
			$('#title').val("");
			$('#cid').val("");
			$('#click_url').val("");
			$('#img_url').val("");
			$('#price').val("");
			$('#sellernick').val("");
			$('#oldprice').val("");
			$('#discount').val("");
			$('#num_iid').val("");
			$('#modal-title').text('增加商品条目');
		});
		
		$('#oldprice').change(function(){
			var price = $('#price').val();
			if(price != ""){
				var oldprice = $('#oldprice').val();
				var discount = (price / oldprice) * 10;
				discount = discount.toFixed(1);
				$('#discount').val(discount);
			}
		});
		
		$('#additembtn').click(function(){
			var cid = $('#additemcid').val();
			$('#cid').val(cid);
			$('#num_iid').val("0");
			
			$('#additem').modal('show');
		});
	})(jQuery);
</script>
</body>
</html>