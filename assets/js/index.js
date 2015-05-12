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
				
                html.push( "<div class='col-xs-6 col-sm-4 col-md-4 item'><div class='thumbnail'><div class='caption'><p><div class='gifcontrol'><a href='"
							+val.redirect_url+"' target='_blank'><img src='"
							+val.img_url+"' alt='' title='"
							+val.title+"'></a></div></p><div style='border-top:2px solid #337AB7;'><p><h5><b>"
							+val.title+"</b></h5></p><p>--"
							+val.comment+"</p><p>品牌:"
							+val.sellernick+"</p><p>￥"
							+val.price+"&nbsp;<s>￥"
							+val.oldprice+"</s>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
							+val.discount+"折</p><p style='text-align:left;'><a href='javascript:void(0);' class='vote' data-itemid='"
							+val.id+"' data-votevalue='good'><span class='glyphicon glyphicon-heart' aria-hidden='true'></a>"
							+val.good+"</p></div></div></div></div>");
			}
			
			$("#"+id).append(html.join(''));
		}
	},"json");
}
