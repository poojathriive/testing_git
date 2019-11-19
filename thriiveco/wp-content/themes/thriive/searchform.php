<form class="seachform-section form-element-section" role="search" method="get" action="./" autocomplete="off" id="searchform">
	<div class="form-group d-flex speech">
		 <input type="search" name="s" placeholder="Search …" value="<?php the_search_query();?>" class="form-control" id="transcript" auto>
		 <img onclick="startDictation()" src="//i.imgur.com/cHidSVu.gif" />
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
	.speech {border: 1px solid #4f0475; width: 100%; padding: 0; margin: 0; border-radius: .25rem;}
  	.speech input {border: 0;}
  	.speech img {float: right; width: 40px }
</style>
<script>
  function startDictation() {

    if (window.hasOwnProperty('webkitSpeechRecognition')) {

      var recognition = new webkitSpeechRecognition();

      recognition.continuous = false;
      recognition.interimResults = false;

      recognition.lang = "en-US";
      recognition.start();

      recognition.onresult = function(e) {
        document.getElementById('transcript').value
                                 = e.results[0][0].transcript;
        recognition.stop();
        document.getElementById('searchform').submit();
      };

      recognition.onerror = function(e) {
        recognition.stop();
      }

    }
  }
</script>