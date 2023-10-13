jQuery(document).ready(function($) {
    var BookSlider = function($scope, $) {
        var activeBookCarousel = jQuery('.book-slider-activate').not('.slick-initialized');
        activeBookCarousel.each(function(index) {
            var lScreen = jQuery(this).data('lscreen');
            var mScreen = jQuery(this).data('mscreen');
            var sScreen = jQuery(this).data('sscreen');
            var $slider = jQuery(this);
            if ($slider.hasClass('slick-initialized')) {
                $slider.slick('unslick');
            }
            $slider.slick({
                infinite: true,
                margin: 30,
                dots: false,
                arrows: true,
                slidesToShow: lScreen,
                slidesToScroll: 1,
                rows: 0,
                cssEase: 'ease-out',
                useTransform: true,
                responsive: [{
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: lScreen,
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: mScreen,
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: sScreen,
                        }
                    },
                    {
                        breakpoint: sScreen,
                        settings: {
                            slidesToShow: 1,
                            adaptiveHeight: true
                        }
                    }
                ],
                nextArrow: '<div class="slick-next"><i class="fa-solid fa-arrow-right"></i></div>',
                prevArrow: '<div class="slick-prev"><i class="fa-solid fa-arrow-left"></i></div>',
                smartSpeed: 450
            });
        });
    };
    if (typeof elementorFrontend !== 'undefined' && typeof elementor !== 'undefined') {
        elementorFrontend.hooks.addAction('frontend/element_ready/awt_book_slider.default', BookSlider);
    } else if (window.acf) {
        window.acf.addAction('render_block_preview/type=rswp-book-slider', BookSlider);
    } else {
        var $scope = jQuery('.book-slider-activate');
        BookSlider($scope, jQuery);
    }
});