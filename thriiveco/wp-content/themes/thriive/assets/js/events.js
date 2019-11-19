var similar_events_list = [];
$(document).ready(function(){
	event_pageload(event_post_id,"therapy","event",12);
});


$("#similar_events_view_all").on("click",function (e) {
	e.preventDefault();
	var $this = $(this);
	var tempArr = [];
	var start_count = (jQuery(this).data('page')*jQuery(this).data('numposts'));//3
	var end_count = ((jQuery(this).data('page')+1)*jQuery(this).data('numposts')) -1;//7
	var spage = jQuery(this).data('spage');
	
	//console.log(start_count,end_count,similar_events_list);
	for (var i = start_count; i<=end_count; i++){
		if (!similar_events_list[i]) {
			$("#similar_events_view_all").hide();
			break;
		}
		else{
			tempArr.push(similar_events_list[i]);
		}
	}
	//	console.log(tempArr,"tempArr");
	$.Mustache.addFromDom();
	$('.therapy-detail-event-section').mustache('similar_events_list', tempArr, { method: 'append' });
	//$(".th-listing-wrapper").addClass('transition_fade_In');
	jQuery(this).data('page',(jQuery(this).data('page')+1));
});


function event_pageload(event_post_id,taxonomy,page,numposts){
	var promise = $.ajax({
       url: ajax_object.ajax_url,
	   type: 'POST',
	   data: {'action': 'getSimilarEvents','event_post_id' : event_post_id, 'taxonomy': taxonomy, 'page': page, 'numposts':numposts},
	   dataType:'json',
	});
	return promise.done(function(data){
		if(data){
			var list = data;
			list.map(function(item,index,arr){
				similar_events_list.push(item);
				if(similar_events_list.length <=1){
					$("#similar_events_view_all").hide();
				}
			});
			return true;
        }else{
	        $("#similar_events_view_all").hide();
	        return false;
        }
	});
}