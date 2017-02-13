(function($) {

    // Owl Carousel
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel({
            loop: true,
            responsiveClass: true,
            nav: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 2,
                    nav: false
                },
                1000: {
                    items: 4,
                    nav: true,
                    loop: false
                }
            },
            transitionStyle: "fade",
            navText: [
                "<span class='fa fa-chevron-circle-left'></span>",
                "<span class='fa fa-chevron-circle-right'></span>"
            ],
        });

        // Tabs
        $("#tabs a").click(function(e) {
            if (!$(this).hasClass("active")) {
                var tabNum = $(this).index();
                var nthChild = tabNum + 1;
                $("#tabs a.active").removeClass("active");
                $(this).addClass("active");
                $("#tab-content #tab.active").removeClass("active");
                $("#tab-content #tab:nth-child(" + nthChild + ")").addClass("active");
            }
        });

        // Tooltip
        $('[data-toggle="tooltip"]').tooltip()

        // Sticky Menu
        $('#site-navigation').affix({
        offset: {
        top: $('header').height()
        }
        }); 

        // Imagelightbox
        $( '#imagelightbox' ).imageLightbox();      

    });
})(jQuery);
