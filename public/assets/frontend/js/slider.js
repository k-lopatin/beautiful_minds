$(function() {

    var divarr = $('#slideshow .slide');
    var i = 0;
    $('#slideshow div').height( $(window).height() );
    setInterval(function() {

        $(divarr[i]).fadeIn(1500);

        if (i != 0) {
            $(divarr[i - 1]).fadeOut(1500);
        } else {
            $(divarr[ divarr.length - 1 ]).fadeOut(1500);
        }

        i++;
        if (i == divarr.length)
            i = 0;
    }, 3000);
});