jQuery.noConflict();
jQuery(document).ready(function($){

  /**
   * 
   * Components 
   *
   **/

  // Navbar Sticky
  var navPosition = '';
  var navHeight = '';
  var lastScrollPos = 0;
  var siteNoticeHeight = ( $('.top-bar').length > 0 ? $('.top-bar').outerHeight() : '0');
  var navStyle = ( $('.site-header > .navbar').hasClass('navbar-dark') ? 'navbar-dark' : 'navbar-light');
  var navStyleSwitch =  'navbar-light';
  if( $('.navbar-fixed').length > 0 ) {
    navPosition = $('.navbar-fixed').offset().top;
    navHeight = $('.navbar-fixed').outerHeight();

    if( $('.site-header').hasClass('floating-header') ) {
      stickyHeaderFloating();
      $('.floating-header').css({'top': siteNoticeHeight + 'px'})
    } else {
      stickyHeaderStandard();
    }
  }

  // Floating Header
  function stickyHeaderFloating() {
    $('.page-header').prepend('<div class="navbar-spacer" style="height:' + navHeight + 'px"></div>');
    $(window).on('scroll', function() {
      if( $(window).scrollTop() > navPosition ) {
        $('.navbar-fixed').removeClass(navStyle).addClass('position-fixed top-0 start-0 end-0 bg-white ' + navStyleSwitch);
      } else {
        $('.navbar-fixed').removeClass('position-fixed top-0 start-0 end-0 bg-white ' + navStyleSwitch).addClass(navStyle);
      }
      // Showing on scroll up only
      if( $('.navbar-fixed').hasClass('scrollable') ) {
        var scrollingPos = $(this).scrollTop();
        if( ($(window).scrollTop() > navHeight) && (scrollingPos > lastScrollPos) ) {
          $('.navbar-fixed').css({ 'transform': 'translateY( -' + navHeight + 'px ) '});
        } else {
          $('.navbar-fixed').css({ 'transform': 'translateY( 0px ) '});
        }
        lastScrollPos = scrollingPos;
      }
    });
  }

  // Standard Header
  function stickyHeaderStandard() {
    $('.site-header').append('<div class="navbar-spacer"></div>');
    $(window).on('scroll', function() {
      if( $(window).scrollTop() > navPosition ) {
        $('.navbar-fixed').addClass('position-fixed top-0 start-0 end-0');
        $('.navbar-spacer').css({ 'height' : navHeight + 'px' });
      } else {
        $('.navbar-fixed').removeClass('position-fixed top-0 start-0 end-0');
        $('.navbar-spacer').css({ 'height' : '0px' });
      }
      // Showing on scroll up only
      if( $('.navbar-fixed').hasClass('scrollable') ) {
        var scrollingPos = $(this).scrollTop();
        if( ($(window).scrollTop() > navHeight) && (scrollingPos > lastScrollPos) ) {
          $('.navbar-fixed').css({ 'transform': 'translateY( -' + navHeight + 'px ) '});
        } else {
          $('.navbar-fixed').css({ 'transform': 'translateY( 0px ) '});
        }
        lastScrollPos = scrollingPos;
      }
    });
  }

  // Mobile Menu
  $('.navbar-mobile .dropdown-toggle, .navbar-mobile .navbar-dropdown-toggle-mobile').on('click', function(e) {
    var link = $(this).attr('href');
    if( link == '#' || ! link ) {
      e.preventDefault();
      $(this).parent().toggleClass('show');
      $(this).parent().find('.dropdown-menu').slideToggle();
    }
  });

  // Fix CF7 Floating Labels
  $('.form-floating .wpcf7-form-control').on('focus blur', function() {
    if( $(this).val() == '' ) {
      $(this).parents('.form-floating').find('label').toggleClass('focused');
    }
  });

  // GDPR Modal Animation
  $('#moove_gdpr_cookie_info_bar').on('click', function(event) {
    if (event.target !== this) return;
    const gdprContainer = $(this).find('.moove-gdpr-info-bar-container');

    gdprContainer.addClass('animate');

    gdprContainer.one('animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd', function() {
      gdprContainer.removeClass('animate');
    });
  });

  /**
   * 
   * Blocks 
   *
   **/

  // Marquee
  if( $('.block-marquee .marquee').length > 0 ) {
    $('.block-marquee .marquee').each( function() {
      var marquee = $(this);
      var track = marquee.find('.marquee-track');
      var itemWidth = 0;
      track.find('.item').each( function() {
        var width = $(this).outerWidth();
        itemWidth += width;
      });
      var trackWidth = itemWidth;
      if( ( trackWidth / 2 ) < marquee.outerWidth() ) {
        track.addClass('static').css( 'animation', 'unset' );
        track.find('.clone').hide();
      } else {
        track.outerWidth(trackWidth + 'px');
      }
    });
  }

  /**
   * 
   * Slick 
   *
   **/

  $('.block-cards').each( function() {
    const carousel = $(this).find('.cards-carousel');
    var carouselState = carousel.data('unslick');
    var slickSettings = {
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      appendArrows: $(this).find('.controls'), // alternatively use .controls
      prevArrow: '<i class="slick-prev fa-light fa-arrow-left fs-5"></i>',
      nextArrow: '<i class="slick-next fa-light fa-arrow-right fs-5"></i>',
      swipeToSlide: true,
      touchThreshold: 10,
      responsive: [],
      mobileFirst: true,
    };

    // Desktop breakpoint
    slickSettings.responsive.push({
      breakpoint: 1200,
      settings: ( carouselState == 'unslick-desktop' || carouselState == 'unslick' ) ? "unslick" : {
        slidesToShow: 3,
      }
    });

    // Mobile breakpoint
    slickSettings.responsive.push({
      breakpoint: 767,
      settings: ( carouselState == 'unslick-mobile' || carouselState == 'unslick' ) ? "unslick" : {
        slidesToShow: 2,
      }
    });
    carousel.slick(slickSettings);
  });
  $('.block-posts_feed, .block-case_studies').each( function() {
    const carousel = $(this).find('.posts-carousel');
    carousel.slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      appendArrows: $(this).find('.controls'), // alternatively use .controls
      prevArrow: '<i class="slick-prev fa-light fa-arrow-left fs-5"></i>',
      nextArrow: '<i class="slick-next fa-light fa-arrow-right fs-5"></i>',
      swipeToSlide: true,
      touchThreshold: 10,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
          }
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: true
          }
        }
      ]
    });
  });
  $('.block-posts_feed').each( function() {
    const carousel = $(this).find('.posts-list-carousel');
      carousel.slick({
      infinite: false,
      slidesToShow: 3,
      slidesToScroll: 3,
      vertical: true,
      arrows: false,
      dots: true,
      verticalSwiping: true,
      swipeToSlide: true,
    });
  });
  $('.block-case_studies').each( function() {
    const carousel = $(this).find('.posts-carousel-full');
    carousel.slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      appendArrows: $(this).find('.carousel-container'), // alternatively use .controls
      prevArrow: '<i class="slick-prev fa-light fa-arrow-left fs-5"></i>',
      nextArrow: '<i class="slick-next fa-light fa-arrow-right fs-5"></i>',
      swipeToSlide: true,
      touchThreshold: 10,
    });
  });
  $('.block-usp').each( function() {
    const carousel = $(this).find('.usp-carousel');
    carousel.slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      arrows: false,
      dots: false,
      autoplay: true,
      swipeToSlide: true,
      touchThreshold: 10,
      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1,
          }
        }
      ]
    });
  });

  /**
   * 
   * WooCommerce 
   *
   **/

  // Trim Cat Description
  if ( $('.term-description').length > 0 && $('.term-description').html().length > 270 ) {
    var originalText = $('.term-description').html();
    var text = $('.term-description').text();
    text = text.substr(0,270) + '... <a href="#" class="read-more text-primary text-decoration-underline ms-2" style="cursor: pointer;">Read more</a>';
    $('.term-description').html(text);
    
      $('.read-more').on('click', function(e) {
      e.preventDefault();
      $(this).hide();
      $('.term-description').html(originalText);
    });
    
  }

  // Product -/+ Buttons
  $('body').on( 'click', '.quantity-input-group button.plus, .quantity-input-group button.minus', function() {
   var qty = $( this ).parent().find( '.qty' );
   var val = parseFloat(qty.val());
   var max = parseFloat(qty.attr( 'max' ));
   var min = parseFloat(qty.attr( 'min' ));
   var step = parseFloat(qty.attr( 'step' ));
   if ( $( this ).is( '.plus' ) ) {
    if ( max && ( max <= val ) ) {
     qty.val( max );
    } else {
     qty.val( val + step );
     if( $('button[name="update_cart"][aria-disabled="true"]').length == 1 ) {
       $('button[name="update_cart"]').attr('aria-disabled', false).prop('disabled', false);
     }
    }
   } else {
    if ( min && ( min >= val ) ) {
     qty.val( min );
    } else if ( val > 1 ) {
     qty.val( val - step );
     if( $('button[name="update_cart"][aria-disabled="true"]').length == 1 ) {
       $('button[name="update_cart"]').attr('aria-disabled', false).prop('disabled', false);
     }
    }
   }
   qty.change();
  });

  // Mini Cart
  $('.mini-cart-icon > a').on('click', function(e) {
    e.preventDefault();
    $('.navbar-mini-cart').toggle();
  });
  $('.mini-cart-icon, .navbar-mini-cart').on('mouseenter', function(e) {
    $('.navbar-mini-cart').show();
  });
  $('.mini-cart, .navbar').on('mouseleave', function(e) {
    $('.navbar-mini-cart').hide();
  });

  // Sticky Order Review
  var navHeight = $('.navbar-fixed').length > 0 ? $('.navbar-fixed').outerHeight() : 0;
  var table = $('.order-review-table').length > 0 ? $('.order-review-table') : '' ;
  var containerTopPos = $('.order-review-table').length > 0 ? $('form.woocommerce-checkout').offset().top : '';
  if( $('.order-review-table').length > 0 && $(window).outerWidth() > 991 ) {
    $(window).on('scroll load', function(e) {
      var scrollPos = e.currentTarget.pageYOffset;
      var scrollPosOffset = scrollPos + navHeight + 16;
      var stickTopPos = scrollPosOffset - containerTopPos;
      var containerPosBottom = containerTopPos + $('form.woocommerce-checkout').outerHeight();
      var tableTopPos = table.offset().top;
      var tableBottomPos = tableTopPos + table.outerHeight();

      if( (scrollPosOffset >= containerTopPos) && (tableBottomPos < containerPosBottom) )  {
        table.css({ 'top' : stickTopPos + 'px' });
      } else if( (tableBottomPos >= containerPosBottom) && (scrollPosOffset > tableTopPos ) ) {
        table.css({ 'top' : 'unset', 'bottom' : '-16px' });
      } else {
        table.css({ 'top' : '0px', 'bottom' : 'unset' });
      }
    });
  }

});

// Video Modal
jQuery(document).on('shown.bs.modal','.video-modal', function () {
  var video = jQuery(this).find('video');
  video[0].play();
  if( video.parents('.modal').find('.fa-play').length > 0 ) {
    video.parents('.modal').find('.fa-play').attr('class', 'fa-solid fa-pause')
  }
  video.on('timeupdate', function() {
    var percentage = ( video[0].currentTime / video[0].duration ) * 100;
    jQuery(".video-seeker span").css("width", percentage+"%");
  });
});
jQuery(document).on('hide.bs.modal','.video-modal', function () {
  jQuery(this).find('video')[0].pause();
});
jQuery('.video-button.play-pause, .video-modal video').on('click', videoPlayPause);
jQuery('.video-button.mute').on('click', videoMute);
function videoPlayPause() {
  var video = jQuery(this).parent().find('video').get(0);
  if( video.paused ) {
    video.play();
    jQuery(this).parents('.modal').find('.fa-play').attr('class', 'fa-solid fa-pause');
  } else {
    video.pause();
    jQuery(this).parents('.modal').find('.fa-pause').attr('class', 'fa-solid fa-play');
  }
}
function videoMute() {
  var video = jQuery(this).parent().find('video');
  if( ! video.prop('muted') ) {
    video.prop('muted', true);
    jQuery(this).find('i').attr('class', 'fa-solid fa-volume-slash');
  } else {
    video.prop('muted', false);
    jQuery(this).find('i').attr('class', 'fa-solid fa-volume');
  }
}
// Only load video if its new
jQuery('[data-video]').on('click', function() {
  var modal = jQuery('.video-modal');
  var videoUrl = jQuery(this).data('video');
  var currentVideoUrl = modal.find('video source').attr('src');

  // Check if video matches
  if( videoUrl != currentVideoUrl ) {
    modal.find('.video').addClass('d-none');
    modal.find('.video-loader').show();

    modal.find('video source').attr('src', videoUrl).load();
    modal.find('video')[0].load();

    modal.find('video').on('loadeddata', function() {
      modal.find('.video').removeClass('d-none');
      modal.find('.video-loader').hide();
    });
  }
});
// Video Seeker
jQuery(".video-seeker").on("click", function(e){
  var video = jQuery(this).parent().find('.video').find('video')[0];
  console.log(video);
  var offset = jQuery(this).offset();
  var left = (e.pageX - offset.left);
  var totalWidth = jQuery(".video-seeker").width();
  var percentage = ( left / totalWidth );
  var vidTime = video.duration * percentage;
  video.currentTime = vidTime;
});


// Dropdown Menu Hover Event
jQuery(window).on('load resize', function() {
  if( jQuery(window).outerWidth() > 991 ){
    jQuery('.dropdown-toggle').on('mouseenter', function() {
      jQuery(this).addClass('show');
      jQuery(this).parent().find('.dropdown-menu').addClass('show');
    });
    jQuery('.nav-item.dropdown').on('mouseleave', function() {
      jQuery(this).find('.dropdown-toggle.show').removeClass('show');
      jQuery(this).find('.dropdown-menu.show').removeClass('show');
    });
  }
});

// Animate in on scroll / load
jQuery(window).on('scroll load', function(){
  jQuery('.animate-in').each( function(i){
    const element = jQuery(this).offset().top + 250;
    const viewport = jQuery(window).scrollTop() + jQuery(window).height();
    const delay = jQuery(this).data('delay');

    if ( viewport > (element - 50) ){
      jQuery(this).css({'opacity': '1', 'transform': 'translate(0px)', 'transition-delay': delay + 'ms'});
    }
  });
});
