jQuery(function($) {

	"use strict";

	$('.from-the-blog.swiper-container').each(function() {

		var myPostsSwiper = new Swiper($(this), {
			slidesPerView: 1,
			loop: true,
			breakpoints: {
				1024: {
					slidesPerView: 3,
				},
				640: {
					slidesPerView: 2,
				},
				480: {
					slidesPerView: 1,
				},
			},
			pagination: {
			    el: $(this).find('.swiper-pagination'),
			},
		});
	});

});
