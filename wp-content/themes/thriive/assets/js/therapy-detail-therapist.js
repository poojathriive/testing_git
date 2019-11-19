var therapist_therapy_detail =[];
$(document).ready(function(){	
	var therapy_id =  $("#therapy_detail_therapist_list_loadmore").data('parent');
	therapy_load_therapist("therapist",therapy_id,0);
	
});

$("#therapy_detail_therapist_list_loadmore").on("click", function(e){
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
				if (!therapist_therapy_detail[i])
					{
					$("#therapy_detail_therapist_list_loadmore").hide();
					break;
					}
				else{
					tempArr.push(therapist_therapy_detail[i]);
				}
		}
		//console.log(tempArr);
		$.Mustache.addFromDom();
		$('.therapists_list').mustache('therapists_list', tempArr, { method: 'append' });
		//$(".th-listing-wrapper").addClass('transition_fade_In');
		jQuery(this).data('page',(jQuery(this).data('page')+1));	
});

function therapy_load_therapist(therapist,parent,page){	
	var promise = $.ajax({
       	url: ajax_object.ajax_url,
	   	type: 'POST',
	   	data: {'action': 'getTherapyDetailTherapist', 'therapist': therapist, 'parent': parent, 'page': page},
	   	dataType:'json'});
	   	
	   	return promise.done(function(data){
		   	if(data){
			   	//console.log(data);
			   	var list = data;
			   	list.map(function(item,index,arr){
				   	therapist_therapy_detail.push(item);
			   	});
			  	if(data.length <= 3){
				   	$("#therapy_detail_therapist_list_loadmore").hide();
			   	}
			   	return true;
			   	i
        	}else{
	        	$("#therapy_detail_therapist_list_loadmore").hide();
	        	return false;
        	}
		});	
}





