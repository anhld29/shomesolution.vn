/*js icon menu bar*/
function myFunction(x) {
    x.classList.toggle("change");
}

// ?jquery mobile
 (function($) {
          var $main_nav = $('#main-nav');
          var $toggle = $('.toggle');

          var defaultData = {
            maxWidth: false,
            customToggle: $toggle,
            // navTitle: 'All Categories',
            levelTitles: true,
            pushContent: '#container'
          };

          // add new items to original nav
          $main_nav.find('li.add').children('a').on('click', function() {
            var $this = $(this);
            var $li = $this.parent();
            var items = eval('(' + $this.attr('data-add') + ')');

            $li.before('<li class="new"><a>'+items[0]+'</a></li>');

            items.shift();

            if (!items.length) {
              $li.remove();
            }
            else {
              $this.attr('data-add', JSON.stringify(items));
            }

            Nav.update(true);
          });

          // call our plugin
          var Nav = $main_nav.hcOffcanvasNav(defaultData);

          // demo settings update

          const update = (settings) => {
            if (Nav.isOpen()) {
              Nav.on('close.once', function() {
                Nav.update(settings);
                Nav.open();
              });

              Nav.close();
            }
            else {
              Nav.update(settings);
            }
          };

          $('.actions').find('a').on('click', function(e) {
            e.preventDefault();

            var $this = $(this).addClass('active');
            var $siblings = $this.parent().siblings().children('a').removeClass('active');
            var settings = eval('(' + $this.data('demo') + ')');

            update(settings);
          });

          $('.actions').find('input').on('change', function() {
            var $this = $(this);
            var settings = eval('(' + $this.data('demo') + ')');

            if ($this.is(':checked')) {
              update(settings);
            }
            else {
              var removeData = {};
              $.each(settings, function(index, value) {
                removeData[index] = false;
              });

              update(removeData);
            }
          });
        })(jQuery);


        // end mobile
   $(".click-search").click(function (e) {
        e.preventDefault();
        $(this).parent().find('.nav-search').toggleClass('open');
     });

  
/*js home slider banner*/
$('#slider-home').owlCarousel({
    loop:true,
    margin:0,
    dots:false,
    nav:true,
    autoplay:true,
    autoplayTimeout:5000,
    autoplaySpeed:1500,
      navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});



/*  $('.slider-large').owlCarousel({
        items:1,
        loop:false,
        center:false,
        margin:10,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        nav:false,

    });
   $('.slider-small').owlCarousel({
        items:3,
        loop:true,
        center:false,
        margin:10,
         nav:false,
        URLhashListener:true,
        autoplayHoverPause:true,
        startPosition: 'URLHash',

    });
*/
$('.slide-product').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
     items:1,
     dots:true
});
$('.slider-product-selling').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
     items:1,
     dots:true
});


   $(document).ready(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() != 0) {
                $('#scrollUp').fadeIn();
            }
            else {
                $('#scrollUp').fadeOut();
            }
        });
        $('#scrollUp').click(function () {
            $('body,html').animate({scrollTop: 0}, 800);
        })
    });
   

   $('.slider-other').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
     items:2,
    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
   
});
   //On click Plus button
$('.add').click(function () {
    if ($(this).prev().val() < 3) {
      $(this).prev().val(+$(this).prev().val() + 1);
    }
});
$('.sub').click(function () {
    if ($(this).next().val() > 1) {
      if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
    }
});

  $('.slider-large1').owlCarousel({
        items:1,
        loop:true,
        center:false,
        margin:10,
        nav:true,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
       
    });
   $('.slider-small1').owlCarousel({
        items:3,
        loop:true,
        center:false,
        margin:10,
         nav:false,
        URLhashListener:true,
        autoplayHoverPause:true,
        startPosition: 'URLHash',
         responsive:{
            0:{
                items:3
            },
            600:{
                items:3
            },
            1000:{
                items:3
            }
        }
    });
$(document).ready(function() {
    $('a[href*=#].navigation__link').bind('click', function(e) {
        e.preventDefault(); // prevent hard jump, the default behavior

        var target = $(this).attr("href"); // Set the target as variable

        // perform animated scrolling by getting top-position of target-element and set it as scroll target
        $('html, body').stop().animate({
            scrollTop: $(target).offset().top
        }, 600, function() {
            location.hash = target; //attach the hash (#jumptarget) to the pageurl
        });

        return false;
    });
});

$(window).scroll(function() {
    var scrollDistance = $(window).scrollTop();

    // Show/hide menu on scroll
    //if (scrollDistance >= 850) {
    //    $('nav').fadeIn("fast");
    //} else {
    //    $('nav').fadeOut("fast");
    //}
  
    // Assign active class to nav links while scolling
    $('.page-section').each(function(i) {
        if ($(this).position().top <= scrollDistance) {
            $('.navigation a.active').removeClass('active');
            $('.navigation a').eq(i).addClass('active');
        }
    });
}).scroll();


$('.other-product').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
     items:2,
     navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],

});

var mainslider = new Swiper('.slider-main', {
    pagination: {
      el: '.swiper-pagination',
      type: 'progressbar',
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });

  var counter = $('.fraction');
  var currentCount = $('<span class="count">1<span/>');
  counter.append(currentCount);

  mainslider.on('transitionStart', function () {
    var index = this.activeIndex + 1,
      $current = $('.photo-slide').eq(index),
      $c_cur = $('#count_cur'),
      $c_next = $('#count_next'),
      dur = 0.8;

    var prevCount = $('.count');
    currentCount = $('<span class="count next">' + index + '<span/>');
    counter.html(currentCount);
  });



$('.slider-new').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    items:1,
    dots:true
   
})
