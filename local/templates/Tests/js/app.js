jQuery(document).ready(function($) {
	$('.courses .courses__item:nth-child(2)').hover(function() {
		$('.courses .courses__item:nth-child(1)').css('border-right', '1px solid #23AEA3');
		$('.courses .courses__item:nth-child(3)').css('border-left', '1px solid #23AEA3');
	}, function() {
		$('.courses .courses__item:nth-child(1)').css('border-right', '1px solid #dedede');
		$('.courses .courses__item:nth-child(3)').css('border-left', '1px solid #dedede');
	});
});


