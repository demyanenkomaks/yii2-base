$(function() {
    $('.img-popup').each(function() { // the containers for all your galleries
        $(this).magnificPopup({
            type: 'image',
            closeOnContentClick: !1,
            closeBtnInside: !1,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: !0, titleSrc: function (e) {
                    return e.el.attr('title');
                }
            },
            gallery: {enabled: !0},
            zoom: {
                enabled: !0, duration: 300, opener: function (e) {
                    return e.find('img');
                }
            }
        });
    });
});