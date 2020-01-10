// Journal
$(document).ready(function(e){
	$(" #isJournalCreate").click(function(e){
		e.preventDefault();
		$(".hide").not("#isJournalCreating").slideUp();
		$("#isJournalCreating").fadeToggle(250, function(){});
	});
	$( "#isJournalOpen" ).click(function(e){
		e.preventDefault();
		$(".hide").not("#isJournalOpened").slideUp();
		$( "#isJournalOpened" ).fadeToggle(250, function(){});
	});
});