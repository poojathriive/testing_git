var ailment_therapy_detail =[];
$(document).ready(function(){	
	var therapy_id =  $("#therapy_detail_ailment_list_loadmore").data('parent');
	therapy_load_ailment("ailment",therapy_id,0);
	
});

$("#therapy_detail_ailment_list_loadmore").on("click", function(e){
	e.preventDefault();
	var taxonomy = jQuery(this).data('taxonomy');
	var parent = jQuery(this).data('parent');
	var page = jQuery(this).data('page');
	
	var $this = $(this);
	var tempArr = [];
	var start_count = (jQuery(this).data('page')*jQuery(this).data('numposts'));//3
	var end_count = ((jQuery(this).data('page')+1)*jQuery(this).data('numposts')) -1;//7
	var spage = jQuery(this).data('spage');
	//console.log(start_count,end_count);
		for (var i = start_count; i<=end_count; i++){
				if (!ailment_therapy_detail[i])
					{
					$("#therapy_detail_ailment_list_loadmore").hide();
					break;
					}
				else{
					tempArr.push(ailment_therapy_detail[i]);
				}
		}
		//console.log(tempArr);
		$.Mustache.addFromDom();
		$('.ailment_list').mustache('ailment_list', tempArr, { method: 'append' });
		//$(".th-listing-wrapper").addClass('transition_fade_In');
		jQuery(this).data('page',(jQuery(this).data('page')+1));	
});

function therapy_load_ailment(taxonomy,parent,page){	
	var promise = $.ajax({
       	url: ajax_object.ajax_url,
	   	type: 'POST',
	   	data: {'action': 'getTherapyDetailAilment', 'taxonomy': taxonomy, 'parent': parent, 'page': page},
	   	dataType:'json'});
	   	
	   	return promise.done(function(data){
		   	if(data){
			   	//console.log(data);
			   	var list = data;
			   	list.map(function(item,index,arr){
				   	ailment_therapy_detail.push(item);
			   	});
			  	//console.log(ailment_therapy_detail);
			   	return true;
        	}else{
	        	$("#therapy_detail_ailment_list_loadmore").hide();
	        	return false;
        	}
		});	
}





