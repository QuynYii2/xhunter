jQuery(document).ready(function( $ ){
    var swiper = new Swiper('.product-carousel', {
          spaceBetween: 30,
           slidesPerView: 2,
           autoplay:true,
          breakpoints: {
            640: {
              slidesPerView: 1,
              spaceBetween: 20,
            },
            768: {
              slidesPerView: 1,
              spaceBetween: 40,
            },
            1024: {
              slidesPerView: 4,
              spaceBetween: 50,
            },
          },
      
        
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          },
          navigation: {
            nextEl: '.webmediavietnam-thumbail-ctegory-product-carousel-next',
            prevEl: '.webmediavietnam-thumbail-ctegory-product-carousel-prev',
          },
    
        });
	var galleryThumbs = new Swiper('.gallery-thumbs', {
      spaceBetween: 10,
      slidesPerView: 4,
      freeMode: true,
      watchSlidesVisibility: true,
      watchSlidesProgress: true,
    });
    var galleryTop = new Swiper('.gallery-top', {
      spaceBetween: 10,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      thumbs: {
        swiper: galleryThumbs
      }
    });
	var swiper = new Swiper('.hero-slides', {
      spaceBetween: 30,
	  //autoplay:true,
      effect: 'fade',
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
	var swiper = new Swiper('.slide-post-thumbail', {
      slidesPerView: 4,
      spaceBetween: 20,
	  //autoplay:true,
	  breakpoints: {
			320: {
              slidesPerView: 2,
              spaceBetween: 20,
            },
			480: {
              slidesPerView: 2,
              spaceBetween: 20,
            },
            640: {
              slidesPerView: 2,
              spaceBetween: 20,
            },
            768: {
              slidesPerView: 2,
              spaceBetween: 40,
            },
            1024: {
              slidesPerView: 4,
              spaceBetween: 20,
            },
          },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
});