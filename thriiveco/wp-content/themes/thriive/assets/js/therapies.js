var therapies_list=[];
var sub_theraies_lis =[];
$(document).ready(function(){
	var filter = new URL(location.href).searchParams;
	if(filter != ""){
		if(filter.get('filter_ailment') != 'all'){
			pageload("therapy",0,0,12,filter.get('filter_ailment'));
		} else {
			pageload("therapy",0,0,12,'all');
		}
	} else {
		pageload("therapy",0,0,12,'all');
	}
	
			
	
	var therapy_id = $("#therapyId").val();
	sub_therapy_load("therapy",therapy_id,0,12);
	
});

$("#therapies_list_load_more").on("click",function (e) {
	e.preventDefault();
	var $this = $(this);
	var tempArr = [];
	var start_count = (jQuery(this).data('page')*jQuery(this).data('numposts'));//3
	var end_count = ((jQuery(this).data('page')+1)*jQuery(this).data('numposts')) -1;//7
	var spage = jQuery(this).data('spage');
	//console.log(start_count,end_count);
		for (var i = start_count; i<=end_count; i++){
				if (!therapies_list[i])
					{
					$("#therapies_list_load_more").hide();
					break;
					}
				else{
					tempArr.push(therapies_list[i]);
				}
		}
		//console.log(tempArr);
		$.Mustache.addFromDom();
		$('.therapies_list').mustache('therapies_list', tempArr, { method: 'append' });
		$(".th-listing-wrapper").addClass('transition_fade_In');
		jQuery(this).data('page',(jQuery(this).data('page')+1));
});




/*
jQuery("#sub_therapies_list_loadmore").click(function (e) {
	e.preventDefault();
	
	var $this = $(this);
	var tempArr = [];
	var start_count = (jQuery(this).data('page')*jQuery(this).data('numposts'));//3
	var end_count = ((jQuery(this).data('page')+1)*jQuery(this).data('numposts')) -1;//7
	var spage = jQuery(this).data('spage');
	//console.log(start_count,end_count);
		for (var i = start_count; i<=end_count; i++){
				if (!sub_theraies_lis[i])
					{
					$("#sub_therapies_list_loadmore").hide();
					break;
					}
				else{
					tempArr.push(sub_theraies_lis[i]);
				}
		}
		//console.log(tempArr,"test");
		$.Mustache.addFromDom();
		$('.sub_therapies_list').mustache('sub_therapies_list', tempArr, { method: 'append' });
		$(".th-listing-wrapper").addClass('transition_fade_In');
		jQuery(this).data('page',(jQuery(this).data('page')+1));
	
});
*/


function sub_therapy_load(taxonomy,parent,page,numposts){	
	var therapy_parent = $(this).data('parent');
	var promise = $.ajax({
       	url: ajax_object.ajax_url,
	   	type: 'POST',
	   	data: {'action': 'getMainTaxonomyDetails', 'taxonomy': taxonomy, 'parent': parent, 'page': page, 'numposts':numposts},
	   	dataType:'json'});
	   	
	   	return promise.done(function(data){
		   	console.log(data,"data");
		   	if(data){
			   	var list = data;
			   	list.map(function(item,index,arr){
				   	sub_theraies_lis.push(item);
			   	});
			 //  	console.log(sub_theraies_lis);
			   	return true;
        	}else{
	        	$("#therapies_list_load_more").hide();
	        	return false;
        	}
		});	
}

function pageload(taxonomy,parent,page,numposts,filter){
	var promise = $.ajax({
       	url: ajax_object.ajax_url,
	   	type: 'POST',
	   	data: {'action': 'getMainTaxonomyDetails', 'taxonomy': taxonomy, 'parent': parent, 'page': page, 'numposts':numposts, 'filter':filter},
	   	dataType:'json'});
	   	
	   	return promise.done(function(data){
		   	//console.log(data,"data");
		   	if(data){
			   	var list = data;
			   	list.map(function(item,index,arr){
				   	therapies_list.push(item);
			   	});
			   	if(data.length <= 3){
				   	$("#therapies_list_load_more").hide();
			   	}
			   	return true;
        	}else{
	        	$("#therapies_list_load_more").hide();
	        	return false;
        	}
		});
}

