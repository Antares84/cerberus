// jQuery Functions For Ticket System
(function ($) {
	$('.openable').on("click", function (event) {
		event.preventDefault();
		$(this).parent().next().slideDown();
		$(this).parent().find('a:first').addClass("opened");
		$(this).addClass('closable').removeClass('openable');
	});
	$('.closable').on("click", function (event) {
		event.preventDefault();
		$(this).parent().next().slideUp();
		$(this).parent().find('a:first').removeClass("opened");
		$(this).addClass('openable').removeClass('closable');
	});
	$('.state').on("change", function (event) {
		event.preventDefault();
		$(this).parent().submit();
	});
})(jQuery);
//	$('.ViewTicket').click(function(event){
//		event.preventDefault();
//		if($(this).hasClass("opened")){
//			$(this).parent().next().slideDown();
//			$(this).parent().find('a:first').addClass("opened");
//			$(this).addClass('closable').removeClass('openable');
//		}else{
//			$(this).parent().next().slideUp();
//			$(this).parent().find('a:first').removeClass("opened");
//			$(this).addClass('openable').removeClass('closable');
//		}
//	});
$(document).ready(function( e ) {
	$(".description .ViewTicket").click(function(){
		if(!$(this).hasClass("show")){
			$(this).addClass("show",function(){ 
				$(this).parent().next(".details").slideDown(250);
			});
		}else{
			$(this).parent().next(".details").slideUp(250,function(){
				$(this).prev(".description").find(".show").removeClass("show");
				//removeClass("show");
			});
		}
	});
});
// Ticket System
$(document).ready(function( e ) {
	$("button .isCreate").click(function(){
		if(!$(this).hasClass("show")){
			$(this).addClass("show",function(){
				$(this).parent().next(".isMessage").removeClass("hide");
				$(this).parent().next(".isMessage").slideDown(250);
			});
		}else{
			$(this).next(".isMessage").slideUp(250,function(){
				$(this).prev(".isCreate").removeClass("show");
			});
		}
	});
});
/*
$(document).ready(function( e ) {
	$("#input-id").fileinput();
});
*/
$(document).on('click', '.browse', function(){
  var file = $(this).parent().parent().parent().find('.file');
  file.trigger('click');
});
$(document).on('change', '.file', function(){
  $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
});