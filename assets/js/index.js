//局部刷新item数据
function getitemdata(obj,url,id,catid,sort){
	var that = $(obj);
	that.parent('li').siblings('li').children('.sortactive').removeClass('sortactive');
	that.addClass('sortactive');
	
	var html=[];
	$.post(url,{catid: catid,sort:sort},function(data){
		if(data){
			$("#"+id).empty();
			for(var i= 0,len = data.length;i < len; i++){
                var val = data[i];
				
                html.push("<div class='grid-col-235 grid-row-330 good-list'><div class='grid-good'><a class='grid-row-330 floor-banner' href='"+val.click_url+"' target='_blank'><img src='"+val.img_url+"' class='grid-col-235 grid-row-250' alt='"+val.title+"'><div class='good-info'><div class='good-title'>"+val.title+"</div></div></a><div class='good-info-price'><span class='price'>￥"+val.price+"</span><span class='oldprice'>￥"+val.oldprice+"</span><span class='discount'>"+val.discount+"折</span></div></div></div>");
			}
			$("#"+id).append(html.join(''));
		}
	},"json");
}
