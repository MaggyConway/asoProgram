jQuery(document).ready(function($) {
	$('#courses .courses__item:nth-child(2)').hover(function() {
		$('#courses .courses__item:nth-child(1)').css('border-right', '1px solid #23AEA3');
		$('#courses .courses__item:nth-child(3)').css('border-left', '1px solid #23AEA3');
		console.log('done');
	}, function() {
		$('#courses .courses__item:nth-child(1)').css('border-right', '1px solid #dedede');
		$('#courses .courses__item:nth-child(3)').css('border-left', '1px solid #dedede');
	});

	var myHash = location.hash; //получаем значение хеша
	location.hash = ''; //очищаем хеш
	if(myHash[1] != undefined){ //проверяем, есть ли в хеше какое-то значение

	if (myHash) {
		$('html, body').animate(
		{scrollTop: $(myHash).offset().top - 30}
		, 1000); //скроллим за полсекунды
		location.hash = myHash; //возвращаем хеш
		};
	}
});

//СКРОЛЛИНГ-МЕНЮ
$(function(){
	$('a[href^="#"]').on('click', function(event) {  
	    var src = $(this).attr("href"),
	    sectionPosition = $(src).offset().top - 30;
	    $('html, body').animate({scrollTop: sectionPosition}, 1000);
	    $('.small_menu').removeClass('opened');
	});
});
function smoothToBlock() {
	//event.preventDefault();
	var src = '#' + $(event.target).attr("href").split('#')[1];
	console.log(src);
	var sectionPos = $(src).offset().top - 30;
	$('html, body').animate({scrollTop: sectionPos}, 1000);
	$('.small_menu').removeClass('opened');
}


//МОБИЛЬНОЕ МЕНЮ
$('.small_menu_btn').click(function() {
	$('.small_menu').addClass('opened');
});
$('.small_menu_btn--close').click(function() {
	$('.small_menu').removeClass('opened');
});