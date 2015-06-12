(function($,Contao){$(function(){
	if(typeof $('.sondersendung')[0] != 'undefined') {
		$('.sondersendung h4').click(function() {
			if(typeof $('body > .lightbox-wrapper')[0] != 'undefined')
				$('body > .lightbox-wrapper').remove();

			$(this).next('div').clone().appendTo('body').click(function(e){
					$(this).remove();
					e.preventDefault();
				}).find('.lightbox-content').click(function(e){
					return false;
					e.preventDefault();
				}).find('.lightbox-close').click(function(e){
					$(this).parents('.lightbox-wrapper').remove();
					e.preventDefault();
				});
		});
	}
});})(jQuery,Contao);