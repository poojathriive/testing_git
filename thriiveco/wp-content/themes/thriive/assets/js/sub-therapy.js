var therapy_detail =[];
$(document).ready(function(){	
	var therapy_id =  $("#sub_therapies_list_loadmore").data('parent');
	sub_therapy_load("therapy",therapy_id,0);
	
});

$("#sub_therapies_list_loadmore").on("click", function(e){
	e.preventDefault();
	//console.log("Hi");return;
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
				if (!therapy_detail[i])
					{
					$("#sub_therapies_list_loadmore").hide();
					break;
					}
				else{
					tempArr.push(therapy_detail[i]);
				}
		}
		//console.log(tempArr);
		$.Mustache.addFromDom();
		$('.sub_therapies_list').mustache('sub_therapies_list', tempArr, { method: 'append' });
		//$(".th-listing-wrapper").addClass('transition_fade_In');
		jQuery(this).data('page',(jQuery(this).data('page')+1));	
});

function sub_therapy_load(taxonomy,term_id,page){	
	var promise = $.ajax({
       	url: ajax_object.ajax_url,
	   	type: 'POST',
	   	data: {'action': 'getSubTherapy_load', 'taxonomy': taxonomy, 'term_id': term_id},
	   	dataType:'json'});
	   	
	   	return promise.done(function(data){
		   	if(data){
			   	//console.log(data);
			   	var list = data;
			   	list.map(function(item,index,arr){
				   	therapy_detail.push(item);
			   	});
			  	//console.log(therapy_detail);
			   	return true;
        	}else{
	        	$("#sub_therapies_list_loadmore").hide();
	        	return false;
        	}
		});	
}





