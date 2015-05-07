	<div id="page-items">
	
         <!--增加修改modal--> 
          <div class="modal fade" id="addbanner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" style="width:1000px;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="banner-modal-title">添加横幅</h4>
					</div>
				<div class="modal-body">
		  <form id="addbannerform" action="<?php site_url('admin/addbanner/')?>">
		  <input type="hidden" id="bannerid" name="bannerid" value=""/>
		  <div style="width:540px;float: left; overflow: hidden;display: block;">
			<a href="javascript(0);">
				<img id="addprimaryimgurl" src="" style="height:320px;" alt="">
				<input type="hidden" id="bannerprimaryimgid" name="bannerprimaryimgid" value=""/>
				<input type="hidden" id="bannerprimaryimgurl" name="bannerprimaryimgurl" value=""/>
			</a>
			
		  </div>
		  <div style="width:410px;height:320px;float: left; overflow: hidden;display: block;margin-left:10px;">
			<div style="width:200px;overflow: hidden;display: block;float:left;">
				<a href="javascript(0);" style="height:240px;width:200px;overflow: hidden;display: block;">
					<img id="addpic1imgurl" src="" style="width:200px;">
					<input type="hidden" id="bannerpic1imgid" name="bannerpic1imgid" value=""/>
					<input type="hidden" id="bannerpic1imgurl" name="bannerpic1imgurl" value=""/>
				</a>	
				<a href="javascript(0);" style="height:80px;width:200px;overflow: hidden;display: block;">
					<img id="addpic2imgurl" src="" style="width:200px;">
					<input type="hidden" id="bannerpic2imgid" name="bannerpic2imgid" value=""/>
					<input type="hidden" id="bannerpic2imgurl"  name="bannerpic2imgurl" value=""/>
				</a>		
			</div>
			<div style="width:200px;overflow: hidden;display: block;float:left;margin-left:10px;">
				<a href="javascript(0);" style="height:240px;width:200px;overflow: hidden;display: block;">
					<img id="addpic3imgurl" src="" style="width:200px;">
					<input type="hidden" id="bannerpic3imgid" name="bannerpic3imgid" value=""/>
					<input type="hidden" id="bannerpic3imgurl" name="bannerpic3imgurl" value=""/>
				</a>
				<a href="javascript(0);" style="height:80px;width:200px;overflow: hidden;display: block;">
					<img id="addpic4imgurl" src="" style="width:200px;">
					<input type="hidden" id="bannerpic4imgid" name="bannerpic4imgid" value=""/>
					<input type="hidden" id="bannerpic4imgurl" name="bannerpic4imgurl" value=""/>
				</a>
			</div>
			
		</div>
		</form>
		<div>
		<div style="float:left;">
			主横幅：<select class="addbanner-control" id="primaryimg">
				<option>全部</option>
			<?php if($bannerpic_primary->num_rows()>0){?>
			<?php foreach($bannerpic_primary->result() as $primaryimg):?>
			
			  <option value="<?php echo $primaryimg->id?>" data-imgurl="<?php echo $primaryimg->imgurl?>"><?php echo $primaryimg->name?></option>
			<?php endforeach;}?>
			</select>
		</div>
		<div style="float:left;">
			<div>
				横幅1
				<select class="addbanner-control" id="pic1img">
				<option>全部</option>
				<?php if($bannerpic_second->num_rows()>0){?>
			<?php foreach($bannerpic_second->result() as $bannerpicimg):?>			
			  <option value="<?php echo $bannerpicimg->id?>" data-imgurl="<?php echo $bannerpicimg->imgurl?>"><?php echo $bannerpicimg->name?></option>
			<?php endforeach;}?>
				 </select>
			</div>
			<div>
				横幅2
				<select class="addbanner-control" id="pic2img">
				<option>全部</option>
				  <?php if($bannerpic_last->num_rows()>0){?>
			<?php foreach($bannerpic_last->result() as $bannerpicimg):?>
			
			  <option value="<?php echo $bannerpicimg->id?>" data-imgurl="<?php echo $bannerpicimg->imgurl?>"><?php echo $bannerpicimg->name?></option>
			<?php endforeach;}?>
				</select>
			</div>
		</div>
		<div style="float:left;">
			<div>
				横幅3
				<select class="addbanner-control" id="pic3img">
				<option>全部</option>
				  <?php if($bannerpic_second->num_rows()>0){?>
			<?php foreach($bannerpic_second->result() as $bannerpicimg):?>			
			  <option value="<?php echo $bannerpicimg->id?>" data-imgurl="<?php echo $bannerpicimg->imgurl?>"><?php echo $bannerpicimg->name?></option>
			<?php endforeach;}?>
				</select>
			</div>
			<div>
				横幅4
				<select class="addbanner-control" id="pic4img">
				<option>全部</option>
				   <?php if($bannerpic_last->num_rows()>0){?>
			<?php foreach($bannerpic_last->result() as $bannerpicimg):?>			
			  <option value="<?php echo $bannerpicimg->id?>" data-imgurl="<?php echo $bannerpicimg->imgurl?>"><?php echo $bannerpicimg->name?></option>
			<?php endforeach;}?>
				</select>
			</div>
		</div>
		</div>
		  </div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" id="submitaddbanner">保存</button>
				  <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
		  </div>
		  </div>
		</div>
		  
		<div class="modal fade" id="showbanner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" style="width:1000px;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="modal-title">横幅预览</h4>
					</div>
				<div class="modal-body">
		  
		  <div style="width:540px;float: left; overflow: hidden;display: block;">
			<a href="javascript(0);">
				<img id="primaryimgurl" src="" style="height:320px;" alt="">
			</a>
			
		  </div>
		  <div style="width:410px;height:320px;float: left; overflow: hidden;display: block;margin-left:10px;">
			<div style="width:200px;overflow: hidden;display: block;float:left;">
				<a href="javascript(0);" style="height:240px;width:200px;overflow: hidden;display: block;">
					<img id="pic1imgurl" src="" style="width:200px;">
				</a>	
				<a href="javascript(0);" style="height:80px;width:200px;overflow: hidden;display: block;">
					<img id="pic2imgurl" src="" style="width:200px;">
				</a>		
			</div>
			<div style="width:200px;overflow: hidden;display: block;float:left;margin-left:10px;">
				<a href="javascript(0);" style="height:240px;width:200px;overflow: hidden;display: block;">
					<img id="pic3imgurl" src="" style="width:200px;">
				</a>
				<a href="javascript(0);" style="height:80px;width:200px;overflow: hidden;display: block;">
					<img id="pic4imgurl" src="" style="width:200px;">
				</a>
			</div>
			
		</div>
		  </div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
		  </div>
		  </div>
		</div><!--end <div class="modal fade" id="showbanner"-->
         
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
		  <li class=""><button class="btn btn-primary" data-toggle="modal" data-target="#addbanner">添加</button></li>
		</ul>
		
	<?php if($banners->num_rows()>0){ ?>

	<table class="table table-bordered table-striped" >
    <thead>
      <tr>
        <th>序号</th>
        <th>主图片</th>
        <th>图片1</th>       
        <th>图片2</th>
        <th>图片3</th>
        <th>图片4</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
	<?php
	 foreach ($banners->result() as $banner):
	//条目开始
		?>
	<tr >
    	<th><?php echo $banner->id ?></th>
        <td><img src="<?php echo $banner->bannerpic_primary_imgurl; ?>" class="thumbnail" alt="" title=""></td>
        <td><img src="<?php echo $banner->bannerpic1_imgurl; ?>" class="thumbnail" alt="" title=""></td>
		<td><img src="<?php echo $banner->bannerpic2_imgurl; ?>" class="thumbnail" alt="" title=""></td>
		<td><img src="<?php echo $banner->bannerpic3_imgurl; ?>" class="thumbnail" alt="" title=""></td>
		<td><img src="<?php echo $banner->bannerpic4_imgurl; ?>" class="thumbnail" alt="" title=""></td>
        <td>
        	<a href="#" title="修改此条" class="btn_banner_update" data-bannerid="<?php echo $banner->id; ?>">修改</a>&nbsp;&nbsp;
        	<a href="#" title="预览此条" class="btn_show"  data-bannerid="<?php echo $banner->id; ?>">预览</a>&nbsp;&nbsp;
        	<a href="#" title="删除此条" class="btn_delete"  data-bannerid="<?php echo $banner->id; ?>">删除</a>
        </td>
      </tr>
	<?php
    //条目结束
    endforeach;}?>
	</tbody>
  </table>

  </div>
 
 	<div id="page-items">
	
         <!--增加修改modal--> 
          <div class="modal fade" id="addbannerpic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    	<div class="modal-content">
    		<div class="modal-header">
      			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      			<h4 class="modal-title" id="addbannerpic-modal-title">新增横幅图片</h4>
    		</div>
        <div class="modal-body">
          <form role="form" id="addbannerpicform" class="form-horizontal" name="addbannerpicform" method="post" action="<?php echo site_url('admin/addbannerpic')?>">
		  <input type="hidden" id="bannerpicid" name="bannerpicid" value=""/>
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">标题</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="name" name="name" placeholder="标题">
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
                <label for="type" class="col-sm-2 control-label">类型</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="type" name="type" placeholder="类型">
				</div>
                <label for="isDisable" class="col-sm-2 control-label">是否禁用</label>
				<div class="col-sm-4">
					<select id="isDisable" name="isDisable">
						<option value="0">否</option>
						<option value="1">是</option>
					</select>
				</div>
              </div>
			  <div class="form-group">
                <label  class="col-sm-2 control-label">开始时间</label>
				<div class="col-sm-4">
					
					<div class="input-group date form_date" data-date="2011-2-2" data-date-format="yyyy-mm-dd" data-link-field="startdatetime" data-link-format="yyyy-mm-dd">
						<input class="form-control" size="16" type="text" name="startdatetime" value="" readonly>
						
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						<input type="hidden" id="startdatetime" value="" />
					</div>
				</div>
                <label class="col-sm-2 control-label">结束时间</label>
				<div class="col-sm-4">
					
					<div class="input-group date form_date" data-date="2011-2-2" data-date-format="yyyy-mm-dd" data-link-field="enddatetime" data-link-format="yyyy-mm-dd">
						<input class="form-control" size="16" type="text"  name="enddatetime" value="" readonly>
						
						<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
					</div>
					<input type="hidden" id="enddatetime" value="" />
				</div>
			  </div>
              
          </form>
        </div>
        <div class="modal-footer">
		  <button type="button" class="btn btn-default" id="submitaddbannerpic">保存</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        </div>
          </div>
          </div>
          </div><!--end <div class="modal fade" id="addbannerpic"-->
         
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
		  <li class=""><button class="btn btn-primary" data-toggle="modal" data-target="#addbannerpic">添加</button></li>
		</ul>
		
	<?php if($bannerpics->num_rows()>0){ ?>

	<table class="table table-bordered table-striped" style="table-layout:fixed;word-break:break-all;overflow:hidden;">
    <thead>
      <tr>
        <th style="width:5%;">序号</th>
        <th style="width:10%;">图片</th>
        <th style="width:10%;">名称</th>       
        <th style="width:30%;">点击地址</th>
        <th style="width:5%;">类别</th>
        <th style="width:5%;">点击次数</th>
		<th style="width:10%;">开始时间</th>
        <th style="width:10%;">结束时间</th>
		<th style="width:5%;">是否禁用</th>
        <th style="width:10%;">操作</th>
      </tr>
    </thead>
    <tbody>
	<?php
	 foreach ($bannerpics->result() as $bannerpic):
	//条目开始
		?>
	<tr>
    	<th><?php echo $bannerpic->id ?></th>
        <td><img src="<?php echo $bannerpic->img_url; ?>" class="thumbnail" alt="" title=""></td>
        <td><?php echo $bannerpic->name ?></td>        
        <td><?php echo $bannerpic->click_url; ?></td>                
        <td><?php echo $bannerpic->type ?></td>
        <td><?php echo $bannerpic->click_count;?></td>
		<td><?php echo $bannerpic->startdatetime; ?></td>
        <td><strong><?php echo $bannerpic->enddatetime; ?></strong></td>
		<td><?php echo $bannerpic->isDisable; ?></td>
        <td>
        	<a href="#" title="修改此条" class="btn_bannerpic_update" data-bannerpicid="<?php echo $bannerpic->id; ?>">修改</a>&nbsp;&nbsp;
        	<a href="#" title="删除此条" class="btn_delete"  data-bannerpicid="<?php echo $bannerpic->id; ?>">删除</a>
        </td>
      </tr>
	<?php
    //条目结束
    endforeach;?>
	</tbody>
  </table>
	<div class="pagenav">
		<?php echo $bannerpicpagination;?>
	</div>
	<?php } ?>
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
					var id = $(this).data('bannerid');
					var url = '<?php echo site_url("admin/delete_banner/")?>';
					
					if(typeof(id) =='undefined'|| id==''){
						id =$(this).data('bannerpicid');
						url = '<?php echo site_url("admin/delete_bannerpic/")?>';
					}
					
					alert(id+url);
					$.post(url,
						{
							id: id
						},function(data){
								if(data){ //如果删除成功
									that.parents('tr').fadeToggle();
								}
							});
				} else
				{
				}
		});
		
		$('.btn_banner_update').click(function(){
			var that = $(this);
			var bannerid = $(this).data('bannerid');
			$.post('<?php echo site_url("admin/getbannerbyid")?>',
						{
							bannerid: bannerid
						},function(data){
								if(data != null){
									$('#bannerid').val(data['id']);
									$('#addprimaryimgurl').attr('src',data['primaryimgurl']);
									$('#bannerprimaryimgid').val(data['primaryimgid']);
									$('#bannerprimaryimgurl').val(data['primaryimgurl']);
									$('#addpic1imgurl').attr('src',data['pic1imgurl']);
									$('#bannerpic1imgid').val(data['pic1imgid']);
									$('#bannerpic1imgurl').val(data['pic1imgurl']);
									$('#addpic2imgurl').attr('src',data['pic2imgurl']);
									$('#bannerpic2imgid').val(data['pic2imgid']);
									$('#bannerpic2imgurl').val(data['pic2imgurl']);
									$('#addpic3imgurl').attr('src',data['pic3imgurl']);
									$('#bannerpic3imgid').val(data['pic3imgid']);
									$('#bannerpic3imgurl').val(data['pic3imgurl']);
									$('#addpic4imgurl').attr('src',data['pic4imgurl']);
									$('#bannerpic4imgid').val(data['pic4imgid']);
									$('#bannerpic4imgurl').val(data['pic4imgurl']);
									$('#primaryimg').val(data['primaryimgid']);
									$('#pic1img').val(data['pic1imgid']);
									$('#pic2img').val(data['pic2imgid']);
									$('#pic3img').val(data['pic3imgid']);
									$('#pic4img').val(data['pic4imgid']);
									
									$('#banner-modal-title').text('修改横幅');
									$('#addbanner').modal('show');
								}else{
									alert(修改失败);
								}
							},"json");
			
		});
		
		$('.btn_bannerpic_update').click(function(){
			var that = $(this);
			var bannerpicid = $(this).data('bannerpicid');
			$.post('<?php echo site_url("admin/getbannerpicbyid")?>',
						{
							id: bannerpicid
						},function(data){
								//alert(data);
								if(data != null){
									$('#bannerpicid').val(data['id']);
									$('#name').val(data['name']);
									$('#type').val(data['type']);
									$('#click_url').val(data['click_url']);
									$('#img_url').val(data['img_url']);
									$('#isDisable').val(data['isDisable']);
									$('#startdatetime').val(data['startdatetime']);
									$('#enddatetime').val(data['enddatetime']);
									
									$('#addbannerpic-modal-title').text('修改横幅图片');
									$('#addbannerpic').modal('show');
								}else{
									alert(修改失败);
								}
							},"json");
			
		});
		
		$('.btn_show').click(function(){
			var that = $(this);
			var bannerid = $(this).data('bannerid');
			$.post('<?php echo site_url("admin/getbannerbyid")?>',
						{
							bannerid: bannerid
						},function(data){

								if(data != null){
									$('#banner_id').attr('src',data['id']);
									$('#primaryimgurl').attr('src',data['primaryimgurl']);
									$('#pic1imgurl').attr('src',data['pic1imgurl']);
									$('#pic2imgurl').attr('src',data['pic2imgurl']);
									$('#pic3imgurl').attr('src',data['pic3imgurl']);
									$('#pic4imgurl').attr('src',data['pic4imgurl']);
								
									$('#showbanner').modal('show');
								}else{
									alert(预览失败);
								}
							},"json");
			
		});
		
		$('#submitaddbannerpic').click(function(){
			
			var url = "<?php echo site_url('admin/addbannerpic/')?>";
			
			if (validateMyAjaxInputs()) {
			
			$.post(url, $("#addbannerpicform").serialize(),function(data){
				if(data){
					$('#addbannerpic').modal('hide');
					location.reload();
				}
			});
		  }
		});
		
		$('#submitaddbanner').click(function(){
			var url="<?php echo site_url('admin/addbanner/')?>";
			
			 $.post(url, $("#addbannerform").serialize(),function(data){
					if(data){
						$('#addbanner').modal('hide');
						location.reload();
					}
			});
		})
		
		
		$('.addbanner-control').on('change',function(e){
			 var id = $(this).attr('id');
			var imgurl = $(this).find('option:selected').data('imgurl');
			var value = $(this).val();
			$('#add'+id+'url').attr('src',imgurl);
			$("#banner"+id+"id").val(value); 
			$("#banner"+id+"url").val(imgurl); 			
			
		});
		
		$('#addbanner').on('hidden.bs.modal',function(e){
			$('#bannerid').val("");
			$('#addprimaryimgurl').attr('src','');
			$('#bannerprimaryimgid').val("");
			$('#bannerprimaryimgurl').val("");
			$('#addpic1imgurl').attr('src','');
			$('#bannerpic1imgid').val("");
			$('#bannerpic1imgurl').val("");
			$('#addpic2imgurl').attr('src','');
			$('#bannerpic2imgid').val("");
			$('#bannerpic2imgurl').val("");
			$('#addpic3imgurl').attr('src','');
			$('#bannerpic3imgid').val("");
			$('#bannerpic3imgurl').val("");
			$('#addpic4imgurl').attr('src','');
			$('#bannerpic4imgid').val("");
			$('#bannerpic4imgurl').val("");
			$('#primaryimg').val('');
			$('#pic1img').val('');
			$('#pic2img').val('');
			$('#pic3img').val('');
			$('#pic4img').val('');
			
			$('#banner-modal-title').text('添加横幅');
		});
		
		$('#addbannerpic').on('hidden.bs.modal',function(e){
				$('#bannerpicid').val('');
				$('#name').val('');
				$('#type').val('');
				$('#click_url').val('');
				$('#img_url').val('');
				$('#isDisable').val('');
				$('#startdatetime').val('');
				$('#enddatetime').val('');
				
				$('#addbannerpic-modal-title').text('新增横幅图片');
		
		});
	})(jQuery);
	
	$('.form_date').datetimepicker({
         language:  'zh-CN',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	
	function validateMyAjaxInputs() {

			// Start validation:
			$.validity.start();
			
			// Validator methods go here:
			
			// For instance:
			$("#name").require();
			$("#type").require();
			$("#click_url").require();
			$("#img_url").require();
			$("#isDisable").require();
			
			// All of the validator methods have been called:
			// End the validation session:
			var result = $.validity.end();
			
			// Return whether it's okay to proceed with the Ajax:
			return result.valid;
	}
</script>
</body>
</html>
