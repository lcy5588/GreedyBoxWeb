	<div id="page-items">
	
        <div class="container" style="display:none;" id="addarticlediv" name="addarticlediv">
		<form role="form" class="form-horizontal" id="articlemodelform" name="articlemodelform" method="post" action="<?php echo site_url('admin/addorupdataitem')?>">
		  
		  <input type="hidden" id="article_id" name="article_id" value=""/>
			  
			  <div class="form-group">
				<label for="article_title" class="col-sm-1 control-label">标题</label>
				<div class="col-sm-11">
					<input type="text" class="form-control" id="article_title" name="article_title" placeholder="标题">
				</div>
			  </div>
			   <div class="form-group">
				<label for="article_imgurl" class="col-sm-1 control-label">图片地址</label>
				<div class="col-sm-11">
					<input type="text" class="form-control" id="article_imgurl" name="article_imgurl" placeholder="图片地址">
				</div>
			  </div>
				  <div class="form-group">
					  <label for="article_cid" class="col-sm-1 control-label">类型</label>
				  <div class="col-sm-5">
					  <?php if($lxquery && $lxquery->num_rows()>0){?>
						<select class="form-control" id="article_cid" name="article_cid">
						  
						  <?php foreach($lxquery->result() as $lxarray):?>
						  <option value="<?php echo $lxarray->id;?>"><?php echo $lxarray->name;?></option>
						  <?php 
						  //结束类型
						  endforeach;?>
						</select>
						<?php } ?>
					</div>
					<label for="article_labelid" class="col-sm-1 control-label">标签</label>
					<div class="col-sm-5">
						
						<?php if($labelquery && $labelquery->num_rows()>0){?>
						<select class="form-control" id="article_labelid" name="article_labelid">
						  
						  <?php foreach($labelquery->result() as $labelarray):?>
						  <option value="<?php echo $labelarray->id;?>" class="label-cid label-cid-<?php echo $labelarray->cid;?>"><?php echo $labelarray->title;?></option>
						  <?php 
						  //结束类型
						  endforeach;?>
						</select>
						<?php } ?>
					</div>
					 
				  </div>

					
					<div class="form-group">
					<label for="article_levelid" class="col-sm-1 control-label">级别</label>
					<div class="col-sm-5">
						<?php if($levelquery && $levelquery->num_rows()>0){?>
						<select class="form-control" id="article_levelid" name="article_levelid">
						  
						  <?php foreach($levelquery->result() as $levelarray):?>
						  <option value="<?php echo $levelarray->id;?>"><?php echo $levelarray->name;?></option>
						  <?php 
						  //结束类型
						  endforeach;?>
						</select>
						<?php } ?>
						
					</div>
					<label for="article_authorid" class="col-sm-1 control-label">作者</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="article_authorid" name="article_authorid" placeholder="作者">
					</div>
				  </div>	
				  
				  
				<input type="hidden"  id="article_content" name="article_content" value="">
			
				<input type="hidden"  id="article_html" name="article_html" value="">
							  				  	  
          </form>
          <div>
			<textarea name="editor" id="editor"></textarea>
					<script>
						CKEDITOR.replace( 'editor' );
					</script>
		 </div>
          
        
        <div class="modal-footer">
			 <button type="button" class="btn btn-default"  id="submitaddarticle" name="submitaddarticle">保存</button>
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
		  <li class=""><button class="btn btn-primary" id="articlemodelbtn">添加</button></li>
		  <li><?php if($lxquery && $lxquery->num_rows()>0){?>
						<select class="form-control" id="articlemodelcid" name="articlemodelcid">
						  
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
        <th style="width:15%;">标题</th>
		<th style="width:10">图片</th>
        <th style="width:5%;">类别</th>       
        <th style="width:10%;">标签</th>
        <th style="width:5%;">级别</th>
        <th style="width:25%;">内容简要</th>
        <th style="width:5%;">点击次数</th>
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
        <td style="width:15%;"><?php echo $array->title; ?></td>
		<td style="width:10%;">
			<img src="<?php echo $array->imgurl; ?>" class="thumbnail" alt="" title="">
		</td>
        <td style="width:5%;"><?php echo $lx_zd[$array->cid]?></td>        
        <td style="width:10%;"><?php echo $label_zd[$array->labelid]; ?></td>        
        <td style="width:5%;"><?php echo $level_zd[$array->levelid]; ?></td>
        <td style="width:25%;"><?php echo $array->content; ?></td>
        <td style="width:5%;"><?php echo $array->click_count ?></td>
        <td style="width:10%;"><?php echo $array->adddatetime;?></td>
        <td style="width:10%;">
        	<a href="#" title="修改此条" class="btn_update" data-articleid="<?php echo $array->id; ?>">修改</a>&nbsp;&nbsp;
        	<a href="#" title="删除此条" class="btn_delete"  data-articleid="<?php echo $array->id; ?>">删除</a>
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
					var delete_article_id = $(this).data('articleid');

					$.post('<?php echo site_url("admin/delete_article/")?>',
						{
							article_id: delete_article_id
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
			var articleid = $(this).data('articleid');
			
			setContent();
			
			$.post('<?php echo site_url("admin/getarticlebyid")?>',
						{
							article_id: articleid
						},function(data){

								if(data != null){
									
									$('#article_id').val(data['id']);
									$('#article_title').val(data['title']);
									$('#article_cid').val(data['cid']);
									
									showlabel();
									
									$('#article_levelid').val(data['levelid']);
									$('#article_authorid').val(data['authorid']);
									$('#article_labelid').val(data['labelid']);
									$('#article_imgurl').val(data['imgurl']);
									
									CKEDITOR.instances.editor.setData(data['html']);
									
									
									$('#modal-title').text('修改文章');
									$('#addarticlediv').show();
								}else{
									alert('获取信息失败');
								}
							},"json");
			
		});
		
		$('#submitaddarticle').click(function(){
			
			setContent();
			
			
			var url = "<?php echo site_url('admin/setarticle/')?>";
			if ($('#article_id').val() != ""){
				url = "<?php echo site_url('admin/updataarticle/')?>";
			}
			if (validateMyAjaxInputs()) {
				$.post(url, $("#articlemodelform").serialize(),function(data){
					if(data){
						location.reload();
						hidediv();
					}
				});
			}
		});
				
		$('#articlemodelbtn').click(function(){
			var cid = $('#articlemodelcid').val();
			$('#article_cid').val(cid);
			showlabel();
			
			$('#addarticlediv').show();
		});
		
		$('#article_cid').change(function(){
			showlabel();
		});
	})(jQuery);
	
	function setContent(){
			var stem = CKEDITOR.instances.editor.getData();
			var stemTxt=CKEDITOR.instances.editor.document.getBody().getText();
			
			$('#article_content').val(stemTxt);
			
			$('#article_html').val(stem);
	}
	
	function hidediv()
	{
		$('#article_id').val("");
		$('#article_title').val("");
		$('#article_cid').val("");
		$('#article_levelid').val("");
		$('#article_authorid').val("");
		$('#article_labelid').val("");
		$('#article_content').val("");
		$('#article_html').val("");
		$('#article_imgurl').val("");
		
		CKEDITOR.instances.editor.setData("");
		
		$('#modal-title').text('增加文章');
		
		$('#addarticlediv').hide();
	}
	
	function showlabel(){
		var cid = $('#article_cid').val();
		$('.label-cid').hide();
		$('.label-cid-'+ cid).show();
		$('#article_labelid').val('');
	}
	
	function validateMyAjaxInputs() {

			// Start validation:
			$.validity.start();
			
			// Validator methods go here:
			
			// For instance:
			$("#article_title").require();
			$("#article_cid").require();
			$("#article_levelid").require();
			$("#article_authorid").require();
			//$("#editor").require();
			$("#article_imgurl").require();
			$("#article_labelid").require();
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
