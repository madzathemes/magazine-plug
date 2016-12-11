jQuery(document).ready(function() {
  'use strict';
jQuery('.post-carousel').slick({
			 slidesToShow: 4,
			 variableWidth: true,
			 lazyLoad: 'ondemand',
			 autoplay: $autoplay,
			 autoplayTimeout:5000,
			 speed:450,
			 rtl: $rtl,
			 prevArrow: '<div class="poster-prev mt-radius"></div>',
			 nextArrow: '<div class="poster-next mt-radius"></div>',
			 responsive: [
		    {
		      breakpoint: 600,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1,
						variableWidth: false,
						autoplay: false,
		      }
		    }]
		});

    jQuery('.post-gallery').slick({
     arrows: false,
     lazyLoad: 'ondemand',
     asNavFor: '.post-gallery-nav',
     adaptiveHeight: true,
     rtl: $rtl,
  });
  jQuery('.post-gallery-nav').slick({
     slidesToShow: 5,
     asNavFor: '.post-gallery',
     centerPadding: '20px',
     focusOnSelect: true,
     rtl: $rtl,
     prevArrow: '<div class="slick-prev mt-radius-b"></div>',
     nextArrow: '<div class="slick-next mt-radius-b"></div>',
     responsive: [
      {
        breakpoint: 600,
        settings: {
        centerPadding: '0px',
        }
      }]
  });


});
