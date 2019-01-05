//	CMS | Fade All Content Aftar Header Click
$(".cNavbar").click(function(){
	$(".container").fadeToggle(1500);
});
$(".f_Title").click(function(){
	$(".f_Content").fadeToggle(1500);
});
//	News | Hide News Article After Title Click
$(document).ready(function( e ) {
	$('.nTitle').each(function(index, element) {
		$(element).click(function( e ) {
			$(element).next('.nContent').slideToggle(750);
			$(element).next('.nContent2').slideToggle(750);
		});
	});
});
// Patch Notes | Hide Patch Info After Title Click
$(document).ready(function( e ) {

	$(".pTitle").click(function(ptitle){
		if(!$(this).hasClass("show")){
			$(this).addClass("show",function(){ 
				$(this).siblings(".pContent").slideDown(500);
			});
		}else{
			$(this).siblings(".pContent").slideUp(500,function(){
				$(this).prev(".pTitle").removeClass("show");
			});
		}
	});
});
//	Sidebar | Hide Sidebar Info After Title Click
$(document).ready(function( e ) {
	$('.sTitle').each(function(index, element) {
		$(element).click(function( e ) {
			$(element).next('.sContent').slideToggle(750);
		});
	});
});
