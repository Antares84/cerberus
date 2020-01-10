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