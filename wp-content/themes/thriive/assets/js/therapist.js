//var therapist_list=[];
/*
	var filter = new URL(location.href).searchParams;
	if(filter != ''){
		if (therapist_list.length === 0) {
	    	$("#therapist_load_more").hide();
		}	
		var fval = filter.get('therapy') + ',' + filter.get('location') + ',' + filter.get('language');
		therapiest_pageload("therapy","therapist",0,12,fval);
	} else {
		therapiest_pageload("therapy","therapist",0,12,'all,all,all');
	}
*/			
	
	//var i = 3;
	//called function in comman js file 
/*
	jQuery(".container").on('click','.load-more-data',function(e){
		e.preventDefault();
		var url      = window.location.href;
		var link = jQuery(this).attr('href');
		var $this = jQuery(this);
		jQuery(this).text('Loading');
		var next_page_view = jQuery(this).attr('data-next-page-view');
		var per_page_view = jQuery(this).attr('data-current-page-view');
		var page_title = jQuery(this).attr('data-page-title');
		var next_page = parseInt(next_page_view)+parseInt(per_page_view);
		
		jQuery(".load-more-data").attr("href", "");
		jQuery(".load-more-data").attr("href", url+'/page/'+next_page);
		var range = parseInt(jQuery(this).attr('data-total-page'));
			if (next_page <= range) {
			$this.attr('data-next-page-view',next_page);
			jQuery.ajax({
		        url: "/page/"+next_page,
		        data: {
		            page: next_page,
		            url: window.location.pathname.toString()
		        }
		    })
		    .done(function (response) {
			    var cloanElm = jQuery('.section-loop-wrapper').children().clone().attr('class');
			    cloanElm = cloanElm.replace('section','');		   
		        jQuery('.section-loop-wrapper').append(jQuery('<div class="'+cloanElm+'">').load(link+' .wrapper-listing',function(){
					jQuery('.therapiest_list').fadeIn(500);
					$this.text('LOAD MORE '+page_title+'');
				}));
				;
		    })
		    .fail(function () {
		        console.log("error");
		    });
			if(next_page == range) {
	        	jQuery('.load-more-data').hide();
	        }
	    }
	    
	});

	
});

*/
/*
$("#therapist_load_more").on("click",function (e) {
	e.preventDefault();
	var $this = $(this);
	var tempArr = [];
	var start_count = (jQuery(this).data('page')*jQuery(this).data('numposts'));//3
	var end_count = ((jQuery(this).data('page')+1)*jQuery(this).data('numposts')) -1;//7
	var spage = jQuery(this).data('spage');
	//console.log(start_count,end_count);
		for (var i = start_count; i<=end_count; i++){
				if (!therapist_list[i])
					{
					$("#therapist_load_more").hide();
					break;
					}
				else{
					tempArr.push(therapist_list[i]);
				}
		}
// 		console.log(tempArr);
		$.Mustache.addFromDom();
		$('.therapiest_list').mustache('therapiest_list', tempArr, { method: 'append' });
		$(".th-listing-wrapper").addClass('transition_fade_In');
		jQuery(this).data('page',(jQuery(this).data('page')+1));
});



function therapiest_pageload(taxonomy,parent,page,numposts,filter){
	var promise = $.ajax({
       	url: ajax_object.ajax_url,
	   	type: 'POST',
	   	data: {'action': 'getTherapistData', 'taxonomy': taxonomy, 'post_type': parent, 'page': page, 'numposts':numposts, 'filter':filter},
	   	dataType:'json'});
	   	
	   	return promise.done(function(data){
		   	if(data){
			   	var list = data;
			   	list.map(function(item,index,arr){
				   	therapist_list.push(item);
			   	});
			   	return true;
        	}else{
	        	$("#therapies_list_load_more").hide();
	        	return false;
        	}
		});
}

function render_therapies(start_index,end_index){
	
}
*/