jQuery(function ($) {
$(document).ready(function(){  

	$('#featured.upzslider') 
	.cycle({ 
		fx:     fx,
		timeout: timeout, 
		speed: transitionspeed,
		pager:  '#nav-featured.upzslider' 
	});
			
})
});