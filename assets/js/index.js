//局部刷新item数据
function getitemdata(obj,url,id,catid,labelid,sort){
	
	var that = $(obj);
	that.parent('li').siblings('li').children('.sortactive').removeClass('sortactive');
	that.addClass('sortactive');
	
	var html=[];
	$.post(url,{catid: catid,labelid:labelid,sort:sort},function(data){
		
		if(data){
			
			$("#"+id).empty();
			for(var i= 0,len = data.length;i < len; i++){
                var val = data[i];
				
                html.push( "<div class='col-xs-12 col-sm-4 col-md-4 item'><div class='thumbnail'><div class='gifcontrol'>"
							+"<a href='"+ val.redirect_url +"' target='_blank'><img src='"+ val.img_url +"' alt='' title='"+val.title+"'></a>"
							+"</div><div class='caption'><div style='border-top:2px solid #337AB7;'><h5 style='margin-bottom: 5px;'>"
							+"<b>"+val.title+"</b></h5><p style='margin-bottom: 5px;'>--"+ val.comment +"</p>"
							+"<p style='margin-bottom: 5px;'><span style='font-size:18px;' id='level_item_"+ val.id +"'>"+val.gradelevel+"<input disabled='disabled' type='number'  name='score' id='score' value='"
							+parseInt((parseFloat(val.excitablelevel) + parseFloat(val.comfortablelevel)+parseFloat(val.sexlevel))/3/20)+"' class='rating'/></span></p>"
							+"<p>刺激度:<input type='number' data-id='"+ val.id +"' name='excitablelevel' id='excitablelevel_item_"+ val.id+"' value='"+parseInt(parseFloat(val.excitablelevel)/20)+"' class='rating'/>"
							+"<span>"+ parseFloat(val.excitablelevel).toFixed(1) +"</span></p>"
							+"<p>舒适度:<input type='number' data-id='"+ val.id+"' name='comfortablelevel' id='comfortablelevel_item_"+ val.id +"' value='"+parseInt(parseFloat(val.comfortablelevel)/20)+"' class='rating'/>"
							+"<span>"+ parseFloat(val.comfortablelevel).toFixed(1) +"</span></p>"
							+"<p>性感度:<input type='number' data-id='"+val.id +"' name='sexlevel' id='sexlevel_item_"+ val.id+"' value='"+parseInt(parseFloat(val.sexlevel)/20)+"' class='rating'/><span>"+ parseFloat(val.sexlevel).toFixed(1) +"</span></p>"
							+"<p style='text-align:left;margin-bottom: 0px;'><button href='javascript:void(0);' style='padding:0px;' class='vote btn btn-link' data-itemid='"+ val.id +"' data-votevalue='good'>"
							+"<span style='font-size:16px;' class='glyphicon glyphicon-heart' aria-hidden='true'></span>"
							+"</button><span id='itemid"+val.id +"'>"+ val.good +"</span>"
							+"<button href='javascript:void(0);' style='padding:0px;' class='btn btn-link' data-itemid='"+ val.id +"' data-votevalue='good'>"
							+"<span style='font-size:16px;' class='glyphicon glyphicon-star' aria-hidden='true'></span>"
							+"</button><span id='itemid"+val.id +"'>"+ val.good +"</span>"
							+"</p></div></div></div></div>");
			}
			
			$("#"+id).append(html.join(''));
			
			$("#"+id+' input.rating[type=number]').each(function() {
			$(this).rating();
    });
		}
	},"json");
}
