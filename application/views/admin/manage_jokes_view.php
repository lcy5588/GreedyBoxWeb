	<div id="page-items">
	
        <div class="container" style="display:none;" id="addjokediv" name="addjokediv">
		<form role="form" class="form-horizontal" id="jokemodelform" name="jokemodelform" method="post" action="<?php echo site_url('admin/addorupdataitem')?>">
		  
		  <input type="hidden" id="joke_id" name="joke_id" value=""/>
				 <div class="form-group">
					<label for="joke_imgurl" class="col-sm-1 control-label">图片地址</label>
					<div class="col-sm-11">
						<input type="text" class="form-control" id="joke_imgurl" name="joke_imgurl" placeholder="图片地址">
					</div>
				 </div>
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
						  <option value="<?php echo $labelarray->id;?>" class="label-cid label-cid-<?php echo $labelarray->cid;?>"><?php echo $labelarray->title;?></option>
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
	
	<div class="row" style="margin-top:10px;">
	<?php foreach($query->result() as $array):?>

	  <div class="col-sm-3 col-md-2 joke">
		<div class="thumbnail">
		  <?php if(!empty($array->img_url)){?>
		  <div class="gifcontrol">
			<img src="<?php echo $array->img_url?>">
		  </div>
		  <?php }?>
		  <div class="caption">
			<p>
				<div>
					<?php echo $array->html;?>
				</div>
			</p>
			<div style="border-top:2px solid #337AB7;">
				<p>ID: <?php echo $array->id ?></p>
				<p>类别:<?php echo $lx_zd[$array->cid]?></p>
				<p>标签:<?php echo $label_zd[$array->labelid]; ?></p>
				<p>级别:<?php echo $level_zd[$array->levelid]; ?></p>
				<p>作者:<?php echo $array->authorid;?></p>
				<p>时间:<?php echo $array->adddatetime;?></p>
				<p>
					<a href="#" title="修改此条" role="button" class="btn_update btn btn-primary" data-jokeid="<?php echo $array->id; ?>">修改</a>
					<a href="#" title="删除此条" class="btn_delete btn btn-primary"  data-jokeid="<?php echo $array->id; ?>">删除</a>
				</p>
			</div>
		  </div>
		</div>
	  </div>
	<?php endforeach;?>
	</div>

	<nav>
	  <ul class="pagination">
		<?php echo $pagination;?>
	  </ul>
	</nav>

	
	
    </div>
 
<script src="<?php echo base_url()?>assets/js/jquery.gifplayer.js"></script>
<script>
	(function($){
		$.validity.setup({ outputMode:'boostrap' });
		
		 $(".gifcontrol").each(function(){
			 var img = $(this).find("img");
			 if(img.length > 0){
				 var src = img.attr('src');
				 
				 if(src.search('.gif$') > 0){
					 
					var startpos = src.indexOf('/',7);
					var endpos = src.indexOf('/',startpos+1);
					var staticsrc = src.substr(0,startpos+1) + "thumbnail" + src.substr(endpos);
					
					img.attr('src',staticsrc);
					img.attr('data-gif',src);
					img.attr('data-wait','true');
					img.gifplayer();
				}
			}
		});
		
		
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
									that.parents('.joke').fadeToggle();
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
									
									showlabel();
									
									$('#joke_levelid').val(data['levelid']);
									$('#joke_authorid').val(data['authorid']);
									$('#joke_labelid').val(data['labelid']);
									$('#joke_imgurl').val(data['imgurl']);
									
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
			
			if (validateMyAjaxInputs()) {
				$.post(url, $("#jokemodelform").serialize(),function(data){
					if(data){
						location.reload();
						hidediv();
					}
				});
		 }
		});
				
		$('#jokemodelbtn').click(function(){
			var cid = $('#jokemodelcid').val();
			$('#joke_cid').val(cid);
			showlabel();
			$('#addjokediv').show();
		});
		
		$('#joke_cid').change(function(){
			showlabel();
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
		$('#joke_imgurl').val("");
		
		CKEDITOR.instances.editor.setData("");
		
		$('#modal-title').text('增加文章');
		
		$('#addjokediv').hide();
	}
	
	function showlabel(){
		var cid = $('#joke_cid').val();
		$('.label-cid').hide();
		$('.label-cid-'+ cid).show();
		$('#joke_labelid').val('');
	}
	
	function validateMyAjaxInputs() {

			// Start validation:
			$.validity.start();
			
			// Validator methods go here:
			
			// For instance:
			$("#joke_cid").require();
			$("#joke_levelid").require();
			$("#joke_authorid").require();
			$("#joke_labelid").require();
			
			
			// All of the validator methods have been called:
			// End the validation session:
			var result = $.validity.end();
			
			// Return whether it's okay to proceed with the Ajax:
			return result.valid;
	}
</script>
</body>
</html>
