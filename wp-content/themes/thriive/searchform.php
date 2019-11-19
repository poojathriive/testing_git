<form class="seachform-section form-element-section" role="search" method="get" action="./" autocomplete="off">
	<div class="form-group d-flex">
		 <input type="search" name="s" placeholder="Search …" value="<?php the_search_query();?>" class="form-control" auto>
	</div>
	<ul class="autocomplete-result"></ul>
</form>

<style>
	.autocomplete-result 
	{
	    background: #fff;
	    list-style: none;
	    padding: 0 5px;
	    position: absolute;
	    width: 100%;
	    z-index: 1;
	    margin-top: -1rem;
	}
	.autocomplete-result li 
	{
	    cursor: pointer;
	}
</style>