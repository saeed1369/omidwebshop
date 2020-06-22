$(document).ready(function () {
    $(".slider").slick({
        speed: 300,
        dots: true,
        infinite: true,
        autoplay: true,
        slidesToScroll: 1,
        slidesToShow: 1,
        arrows: false,
        pauseOnHover: false,
    });
    $(".product-slider").slick({
        rtl: true,
        centerMode: true,
        centerPadding: '60px',
        slidesToShow: 4,
        arrows: false,
        autoplay: true,
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 900,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
    });
    var prevScrollPos = window.pageYOffset;
    window.onscroll = function () {
        var currentScrollPos = window.pageYOffset;
        if (currentScrollPos > prevScrollPos) {
            document.getElementById("top").style.display = "none";
        } else {
            document.getElementById("top").style.display = "initial";
        }
        prevScrollPos = currentScrollPos;
    };


    $('.megamenu .dropdown').hover(function () {
        if ($(window).width() >= 768) {
            $(this).parent().children(0).addClass('hovered');
        }
    }, function () {
        if ($(window).width() >= 768) {
            $(this).parent().children(0).removeClass('hovered');
        }
    });
    $(".megamenu").hover(function () {
        $(".overlay").stop();
        $(".overlay").fadeIn(400);
    }, function () {
        $(".overlay").stop();   
        $(".overlay").fadeOut(400);
    });
    $('.bazaar .card').hover(function () {
            $(this).children().last().children().last().children().last().children().last().animate({width: "160px"}, 400);
            $(this).children().last().children().last().children().last().children().last().children().last().show(400);
    }, function () {
            $(this).children().last().children().last().children().last().children().last().animate({width: "40px"}, 400);
            $(this).children().last().children().last().children().last().children().last().children().last().hide(400);
    })

});