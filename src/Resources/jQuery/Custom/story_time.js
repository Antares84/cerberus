$(document).ready(function( e ) {
	$( "#isSearch" ).click(function(e){
		e.preventDefault();
		$(".row .hide").not("#isSearchable").slideUp();
		$( "#isSearchable" ).fadeToggle(250, function(){
			
		});
	});
	$( "#isStory" ).click(function(e){
		e.preventDefault();
		$(".row .hide").not("#isStoryCreate").slideUp();
		$( "#isStoryCreate" ).fadeToggle(250, function(){
			
		});
	});
});