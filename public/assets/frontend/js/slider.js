$(function() {

    var divarr = $('#slideshow .slide');
    var i = 0;
    $('#slideshow div').height($(window).height());

    $(window).resize(function() {
        $('#slideshow div').height($(window).height());
    });

    setInterval(function() {

        $(divarr[i]).fadeIn(3000);

        if (i != 0) {
            $(divarr[i - 1]).fadeOut(3000);
        } else {
            $(divarr[ divarr.length - 1 ]).fadeOut(3000);
        }

        i++;
        if (i == divarr.length)
            i = 0;
    }, 6000);
});