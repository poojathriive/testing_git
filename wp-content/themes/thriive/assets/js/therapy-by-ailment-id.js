var ailments_sub_theraies_list =[];
$(document).ready(function(){	
	sub_ailment_therapy_id =  $("#sub_ailment_therapy").val();
	sub_therapy_load_ailments("therapy",sub_ailment_therapy_id,0);
	
});


//console.log(ailments_sub_theraies_list);

//Faiz
$("#therapyByAilment_list_loadmore").on("click", function(e){
	e.preventDefault();
/*
	var taxonomy = jQuery(this).data('taxonomy');
	var parent = jQuery(this).data('parent');
	var page = jQuery(this).data('page');
*/
	
	var $this = $(this);
	var tempArr = [];
	var start_count = (jQuery(this).data('page')*jQuery(this).data('numposts'));//3
	var end_count = ((jQuery(this).data('page')+1)*jQuery(this).data('numposts')) -1;//7
	var spage = jQuery(this).data('spage');
	var lastchild_elm = ailments_sub_theraies_list.length-1;
	if(end_count==lastchild_elm){
		$("#therapyByAilment_list_loadmore").hide();
	}
		for (var i = start_count; i<=end_count; i++){
				if (!ailments_sub_theraies_list[i])
					{
					$("#therapyByAilment_list_loadmore").hide();
					break;
					}
				else{
					tempArr.push(ailments_sub_theraies_list[i]);
				}
		}
		//console.log(tempArr);
		$.Mustache.addFromDom();
		$('.ailmentTherapies_list').mustache('ailmentTherapies_list', tempArr, { method: 'append' });
		//$(".th-listing-wrapper").addClass('transition_fade_In');
		jQuery(this).data('page',(jQuery(this).data('page')+1));	
});

function sub_therapy_load_ailments(taxonomy,parent,page){	
	var promise = $.ajax({
       	url: ajax_object.ajax_url,
	   	type: 'POST',
	   	data: {'action': 'getTherapyByAilmentTerm', 'taxonomy': taxonomy, 'parent': parent, 'page': page},
	   	dataType:'json'});
	   	
	   	return promise.done(function(data){
		   	if(data){
			   	//console.log(data);
			   	var list = data;
			   	list.map(function(item,index,arr){
				   	ailments_sub_theraies_list.push(item);
			   	});
			  	//console.log(ailments_sub_theraies_list);
/*
			  	if(data.length <=1 ){
				   	$("#therapyByAilment_list_loadmore").hide();
			   	}
*/
			   	return true;
        	}else{
	        	$("#therapyByAilment_list_loadmore").hide();
	        	return false;
        	}
		});	
}




