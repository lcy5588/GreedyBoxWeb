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
				
                html.push( "<div class='col-xs-6 col-sm-4 col-md-3 item'><div class='thumbnail'><div class='caption'><p><div class='gifcontrol'><a href='"+val.redirect_url+"' target='_blank'><img src='"+val.img_url+"' alt='' title='"+val.title+"'></a></div></p><div style='border-top:2px solid #337AB7;'><p>名称:"+val.title+"</p>	<p>卖家:</p>				<p>价格:￥"+val.price+"&nbsp;旧价格:￥"+val.oldprice+"</p><p>"+val.discount+"折</p><p>点击次数:"+val.click_count+"</p></div></div></div></div>");
			}
			$("#"+id).append(html.join(''));
		}
	},"json");
}
