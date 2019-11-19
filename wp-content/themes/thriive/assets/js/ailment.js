var ailments_list = [];
$(document).ready(function(){
	var filter = window.location.search.substring(1);
	if(filter){
		var filter_val = filter.split('=');
		ailment_pageload("ailment",0,0,12,filter_val[1]);
	} else {
		ailment_pageload("ailment",0,0,12,'all');
	}
	
});


$("#ailment_load_more").on("click",function (e) {
	//console.log("ailment_load_more");
	e.preventDefault();
	var $this = $(this);
	var tempArr = [];
	var start_count = (jQuery(this).data('page')*jQuery(this).data('numposts'));//3
	var end_count = ((jQuery(this).data('page')+1)*jQuery(this).data('numposts')) -1;//7
	var spage = jQuery(this).data('spage');
	
	for (var i = start_count; i<=end_count; i++){
		if (!ailments_list[i]) {
			$("#ailment_load_more").hide();
			break;
		}
		else{
			tempArr.push(ailments_list[i]);
		}
	}
	$.Mustache.addFromDom();
	$('.therapies_list').mustache('ailment_list', tempArr, { method: 'append' });
	jQuery(this).data('page',(jQuery(this).data('page')+1));
	//console.log(tempArr);
});


function ailment_pageload(taxonomy,parent,page,numposts,filter){
	var promise = $.ajax({
       url: ajax_object.ajax_url,
	   type: 'POST',
	   data: {'action': 'getAilmentsData', 'taxonomy': taxonomy, 'page': page, 'numposts' : numposts, 'filter': filter},
	   dataType:'json',
	});
	return promise.done(function(data){
		//console.log(data);
	   	if(data){
		   	var list = data;
		   	list.map(function(item,index,arr){
			   	ailments_list.push(item);
		   	});
		   	if(data.length <= 3){
			   	$("#ailment_load_more").hide();
		   	}
		   	return true;
    	}else{
        	$("#ailment_load_more").hide();
        	return false;
    	}
	});
}