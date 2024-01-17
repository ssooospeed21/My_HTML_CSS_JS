"use strict"
$(document).ready(function(){
    $('.review-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        dots: false,
        fade: true,
    });
    $('.team-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        infinite: true,
        autoplaySpeed: 2000,
        arrows: false,
        dots: false,
        variableWidth: true,
        centerMode: true,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    autoplay: true,
                    infinite: true,
                    autoplaySpeed: 2000,
                    arrows: false,
                    dots: false,
                }
            },
            {
                breakpoint: 860,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });
    $('.licenses-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: false,
        infinite: true,
        variableWidth: true,
        centerMode: true,
    });
});
