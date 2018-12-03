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
	// Journal
	$( "#isJournalCreate" ).click(function(e){
		e.preventDefault();
		$(".row .hide").not("#isJournalCreating").slideUp();
		$( "#isJournalCreating" ).fadeToggle(250, function(){
			
		});
	});
	$( "#isJournalOpen" ).click(function(e){
		e.preventDefault();
		$(".row .hide").not("#isJournalOpened").slideUp();
		$( "#isJournalOpened" ).fadeToggle(250, function(){
			
		});
	});
});