	<div class="container">
		<div class="row"><div class="col-md-12"><h3>商品管理</h3></div></div>
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
				<label for="comment" class="col-sm-2 control-label">点评</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="comment" name="comment" placeholder="点评">
				</div>
			  </div>
			  <div class="form-group">
					
					 <label for="cid" class="col-sm-2 control-label">类型</label>
				  <div class="col-sm-4">
					  
						<select class="form-control" id="cid" name="cid">
						  
						  <?php foreach($lxquery->result() as $lxarray):?>
						  <option value="<?php echo $lxarray->id;?>"><?php echo $lxarray->name;?></option>
						  <?php 
						  //结束类型
						  endforeach;?>
						</select>
						
					</div>
					<label for="labelid" class="col-sm-2 control-label">标签</label>
					<div class="col-sm-4">
						<select class="form-control" id="labelid" name="labelid">
						   <?php foreach($labelquery->result() as $labelarray):?>
						  <option value="<?php echo $labelarray->id;?>" class="label-cid label-cid-<?php echo $labelarray->cid?>"><?php echo $labelarray->title;?></option>
						  <?php 
						  //结束类型
						  endforeach;?>
						</select>
					</div>
				  </div>
				  <div class="form-group">
					<label for="sellernick" class="col-sm-2 control-label">卖家</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="sellernick" name="sellernick" placeholder="卖家">
					</div>
					 <label for="price" class="col-sm-2 control-label">价格</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="price" name="price" placeholder="价格">
					</div>
				  </div>

				  <div class="form-group">
					
					<label for="oldprice" class="col-sm-2 control-label">旧价格</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="oldprice" name="oldprice" placeholder="oldprice">
					</div>
					
					<label for="discount" class="col-sm-2 control-label">折扣</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="discount" name="discount" placeholder="discount">
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
        <div class="row">
        <div class="col-md-6  hidden-xs hidden-sm pull-right">
          <form class="form-inline" role="form" action="<?php echo site_url('admin/manageitem')?>" method="get" id="search">
		  <div class="form-group">
				<label for="cattype">类型</label>
				<select class="form-control" id="searchcatid">
				  <option value="0" <?php if(!empty($searchcatid) && $searchcatid=='0') echo 'selected';?>>全部</option>
				   <?php if($lxquery && $lxquery->num_rows()>0){?>
						  <?php foreach($lxquery->result() as $lxarray):?>
						  <option value="<?php echo $lxarray->id;?>" <?php if(!empty($searchcatid) && $searchcatid==$lxarray->id) echo 'selected';?>><?php echo $lxarray->name;?></option>
						  <?php 
						  //结束类型
						  endforeach;?>
					<?php } ?>
				 </select>
			 </div>
			 <div class="form-group">
				<label for="cattype">标签</label>
				<select class="form-control" id="searchlabelid">
				  <option value="0" <?php if(!empty($searchlabelid) && $searchlabelid=='0') echo 'selected';?>>全部</option>
				  <?php if($labelquery && $labelquery->num_rows()>0){?>
						  <?php foreach($labelquery->result() as $labelarray):?>
						  <option value="<?php echo $labelarray->id;?>"  <?php if(!empty($searchlabelid) && $searchlabelid==$labelarray->id) echo 'selected';?>><?php echo $labelarray->title;?></option>
						  <?php 
						  //结束类型
						  endforeach;?>
					<?php } ?>
				 </select>
			 </div>
          	<div class="form-group">
            <label for="inputkeyword">关键词</label>
            <input type="text" class="form-control" value="<?php if(!empty($inputkeyword)) echo $inputkeyword;?>" id="inputkeyword">
          	</div>
          	<button type="button" onclick="search();" class="btn btn-default">搜索</button>
          </form>
         </div>
		<div class="col-md-2">
		<ul class="nav nav-pills">
		  <li class=""><button class="btn btn-primary" id="additembtn">添加</button></li>
		  <li><?php if($lxquery && $lxquery->num_rows()>0){?>
						<select class="form-control" id="additemcid" name="additemcid">
						  
						  <?php foreach($lxquery->result() as $lxarray):?>
						  <option value="<?php echo $lxarray->id;?>"><?php echo $lxarray->name;?></option>
						  <?php 
						  //结束类型
						  endforeach;?>
						</select>
						<?php } ?>
			</li>
		</ul>
		</div>
	   </div>
	<div class="row" style="margin-top:10px;">
	<?php foreach($query->result() as $array):?>

	  <div class="col-sm-3 col-md-3 item">
		<div class="thumbnail">
		  <div class="gifcontrol">
				
				<img src="<?php echo $array->img_url; ?>" alt="" title="">
				
			</div>
		  <div class="caption">
			<div style="border-top:2px solid #337AB7;">
				<p>ID: <?php echo $array->id ?></p>
				<p>名称:<?php echo $array->title ?></p>
				<p>点评:<?php echo $array->comment ?></p>
				<p>类别:<?php echo $lx_zd[$array->cid]?></p>
				<p>标签:<?php echo $label_zd[$array->labelid]; ?></p>
				<p>卖家:<?php echo $array->sellernick; ?></p>
				<p>价格:<?php echo $array->price; ?>&nbsp;旧价格:<?php echo $array->oldprice; ?></p>
				<p>点击次数:<?php echo $array->click_count;?></p>
				<p style="margin-bottom: 5px;">
					<span style="font-size:18px;" id="level_item_<?php echo $array->id?>"><?php $avg_gradelevel = intval((floatval($array->excitablelevel) + floatval($array->excitablelevel) + floatval($array->comfortablelevel)) / 3); echo $levelscore_zd[intval($avg_gradelevel/10)]; ?><input disabled="disabled" type="number"  name="score" id="score" value="<?php echo intval($avg_gradelevel/20);?>" class="rating"/></span>
					</p>
				<p>刺激度:<input type="number" disabled="disabled" data-id="<?php echo $array->id?>" name="excitablelevel" id="excitablelevel_item_<?php echo $array->id?>" value="<?php echo intval($array->excitablelevel/20);?>" class="rating"/>
				<span><?php echo sprintf("%.1f",$array->excitablelevel) ?></span></p>
				<p>舒适度:<input type="number" disabled="disabled" data-id="<?php echo $array->id?>" name="comfortablelevel" id="comfortablelevel_item_<?php echo $array->id?>" value="<?php echo intval($array->comfortablelevel/20);?>" class="rating"/>
				<span><?php echo sprintf("%.1f",$array->comfortablelevel); ?></span>
				</p>
				<p>性感度:<input type="number" disabled="disabled" data-id="<?php echo $array->id?>" name="sexlevel" id="sexlevel_item_<?php echo $array->id?>" value="<?php echo intval($array->sexlevel/20);?>" class="rating"/>
				<span><?php echo sprintf("%.1f",$array->sexlevel)?></span></p>
				<p>点击地址:<a href="#" title="<?php echo $array->click_url; ?>">查看</a></p>
				<p>
					<a href="#" title="修改此条" class="btn_update btn btn-primary" data-itemid="<?php echo $array->id; ?>">修改</a>
					<a href="#" title="删除此条" class="btn_delete btn btn-primary"  data-itemid="<?php echo $array->id; ?>">删除</a>
				</p>
			</div>
		  </div>
		</div>
	  </div>
	<?php endforeach;?>
	<nav class="col-md-12">
	  <ul class="pagination">
		<?php echo $pagination;?>
	  </ul>
	</nav>
	</div>
    </div>
 
<script type='text/javascript' src='<?php echo base_url()?>assets/js/bootstrap-rating-input.js'></script>
<script>
	(function($){
		$.validity.setup({ outputMode:'boostrap' });
		
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
									that.parents('.item').fadeToggle();
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
									$('#comment').val(data['comment']);
									
									showlabel();
									
									$('#labelid').val(data['labelid']);
									
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
			
			if (validateMyAjaxInputs()) {
				$.post(url, $("#additemform").serialize(),function(data){
					if(data){
						location.reload();
						$('#additem').modal('hide');
					}
				});
		  }
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
			$('#labelid').val("");
			$('#comment').val("");
			
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
			showlabel();
			
			$('#additem').modal('show');
		});
		
		$('#cid').change(function(){
			showlabel();
		});
	})(jQuery);
	
	function showlabel(){
		var cid = $('#cid').val();
		$('.label-cid').hide();
		$('.label-cid-'+ cid).show();
		$('#labelid').val('');
	}
	
	function validateMyAjaxInputs() {

			// Start validation:
			$.validity.start();
			
			// Validator methods go here:
			
			// For instance:
			$("#title").require();
			$("#cid").require();
			$("#click_url").require();
			$("#img_url").require();
			$("#price").require();
			$("#sellernick").require();
			$("#oldprice").require();
			$("#discount").require();
			$("#labelid").require();
			$("#comment").require();
			// All of the validator methods have been called:
			// End the validation session:
			var result = $.validity.end();
			
			// Return whether it's okay to proceed with the Ajax:
			return result.valid;
	}
	
	function search(){
		var keyword = $('#inputkeyword').val();
		var catid = $('#searchcatid').val();
		var labelid = $('#searchlabelid').val();
		
		var url = '<?php echo site_url('admin/manageitem/1')?>'+'/'+catid+'/'+labelid+'/'+ keyword;
		location.href = url;
	}
</script>
</body>
</html>
