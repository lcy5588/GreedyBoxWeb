	<div id="page-items">
	
        <div class="container" style="display:none;" id="addjokediv" name="addjokediv">
		<form role="form" class="form-horizontal" id="jokemodelform" name="jokemodelform" method="post" action="<?php echo site_url('admin/addorupdataitem')?>">
		  
		  <input type="hidden" id="joke_id" name="joke_id" value=""/>
				  <div class="form-group">
					  <label for="joke_cid" class="col-sm-1 control-label">类型</label>
				  <div class="col-sm-5">
					  <?php if($lxquery && $lxquery->num_rows()>0){?>
						<select class="form-control" id="joke_cid" name="joke_cid">
						  
						  <?php foreach($lxquery->result() as $lxarray):?>
						  <option value="<?php echo $lxarray->id;?>"><?php echo $lxarray->name;?></option>
						  <?php 
						  //结束类型
						  endforeach;?>
						</select>
						<?php } ?>
					</div>
					<label for="joke_labelid" class="col-sm-1 control-label">标签</label>
					<div class="col-sm-5">
						
						<?php if($labelquery && $labelquery->num_rows()>0){?>
						<select class="form-control" id="joke_labelid" name="joke_labelid">
						  
						  <?php foreach($labelquery->result() as $labelarray):?>
						  <option value="<?php echo $labelarray->id;?>"><?php echo $labelarray->title;?></option>
						  <?php 
						  //结束类型
						  endforeach;?>
						</select>
						<?php } ?>
					</div>
					 
				  </div>

					
					<div class="form-group">
					<label for="joke_levelid" class="col-sm-1 control-label">级别</label>
					<div class="col-sm-5">
						<?php if($levelquery && $levelquery->num_rows()>0){?>
						<select class="form-control" id="joke_levelid" name="joke_levelid">
						  
						  <?php foreach($levelquery->result() as $levelarray):?>
						  <option value="<?php echo $levelarray->id;?>"><?php echo $levelarray->name;?></option>
						  <?php 
						  //结束类型
						  endforeach;?>
						</select>
						<?php } ?>
						
					</div>
					<label for="joke_authorid" class="col-sm-1 control-label">作者</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="joke_authorid" name="joke_authorid" placeholder="作者">
					</div>
				  </div>				
				<input type="hidden"  id="joke_html" name="joke_html" value="">
							  				  	  
          </form>
          <div>
			<textarea name="editor" id="editor"></textarea>
					<script>
						CKEDITOR.replace( 'editor' );
					</script>
		 </div>
          
        
        <div class="modal-footer">
			 <button type="button" class="btn btn-default"  id="submitaddjoke" name="submitaddjoke">保存</button>
			 <button type="button" class="btn btn-default">清空</button>
			 <button type="button" class="btn btn-default" onclick="hidediv();">取消</button>
        </div>
          </div>
         
         
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
		  <li class=""><button class="btn btn-primary" id="jokemodelbtn">添加</button></li>
		  <li><?php if($lxquery && $lxquery->num_rows()>0){?>
						<select class="form-control" id="jokemodelcid" name="jokemodelcid">
						  
						  <?php foreach($lxquery->result() as $lxarray):?>
						  <option value="<?php echo $lxarray->id;?>"><?php echo $lxarray->name;?></option>
						  <?php 
						  //结束类型
						  endforeach;?>
						</select>
						<?php } ?>
			</li>
		</ul>
		
	<?php if($query->num_rows()>0){ ?>

	<table class="table table-bordered table-striped" style="table-layout:fixed;word-break:break-all;overflow:hidden;" width="960px">
    <thead>
      <tr>
        <th style="width:5%;">序号</th>
        <th style="width:5%;">类别</th>       
        <th style="width:10%;">标签</th>
        <th style="width:5%;">级别</th>
        <th style="width:25%;">内容</th>
        <th style="width:10%;">添加时间</th>
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
        <td style="width:5%;"><?php echo $lx_zd[$array->cid]?></td>        
        <td style="width:10%;"><?php echo $label_zd[$array->labelid]; ?></td>        
        <td style="width:5%;"><?php echo $level_zd[$array->levelid]; ?></td>
        <td style="width:25%;"><?php echo $array->html; ?></td>
        <td style="width:10%;"><?php echo $array->adddatetime;?></td>
        <td style="width:10%;">
        	<a href="#" title="修改此条" class="btn_update" data-jokeid="<?php echo $array->id; ?>">修改</a>&nbsp;&nbsp;
        	<a href="#" title="删除此条" class="btn_delete"  data-jokeid="<?php echo $array->id; ?>">删除</a>
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
		$('.btn_delete').click(function(){
			//event.preventDefault();
			var r=confirm("你真的真的要删除吗？无法恢复！");
				if (r==true)
				{
					var that = $(this);
					var delete_joke_id = $(this).data('jokeid');

					$.post('<?php echo site_url("admin/delete_joke/")?>',
						{
							joke_id: delete_joke_id
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
			var jokeid = $(this).data('jokeid');
			
			setContent();
			
			$.post('<?php echo site_url("admin/getjokebyid")?>',
						{
							joke_id: jokeid
						},function(data){

								if(data != null){
									
									$('#joke_id').val(data['id']);
									$('#joke_cid').val(data['cid']);
									$('#joke_levelid').val(data['levelid']);
									$('#joke_authorid').val(data['authorid']);
									$('#joke_labelid').val(data['labelid']);
									
									CKEDITOR.instances.editor.setData(data['html']);
									
									$('#modal-title').text('修改文章');
									$('#addjokediv').show();
								}else{
									alert('获取信息失败');
								}
							},"json");
			
		});
		
		$('#submitaddjoke').click(function(){
			
			setContent();
			
			var url = "<?php echo site_url('admin/setjoke/')?>";
			if ($('#joke_id').val() != ""){
				url = "<?php echo site_url('admin/updatajoke/')?>";
			}
			
			$.post(url, $("#jokemodelform").serialize(),function(data){
				if(data){
					location.reload();
					hidediv();
				}
			});
		});
				
		$('#jokemodelbtn').click(function(){
			var cid = $('#jokemodelcid').val();
			$('#joke_cid').val(cid);
			
			$('#addjokediv').show();
		});
	})(jQuery);
	
	function setContent(){
			var stem = CKEDITOR.instances.editor.getData();
		
			$('#joke_html').val(stem);
	}
	
	function hidediv()
	{
		$('#joke_id').val("");
		$('#joke_cid').val("");
		$('#joke_levelid').val("");
		$('#joke_authorid').val("");
		$('#joke_labelid').val("");
		$('#joke_html').val("");
		
		CKEDITOR.instances.editor.setData("");
		
		$('#modal-title').text('增加文章');
		
		$('#addjokediv').hide();
	}
</script>
</body>
</html>
