$(function() {

    var divarr = $('#slideshow .slide');
    var i = 0;
    var h = $(window).height() > $(document).height() ? $(window).height() : $(document).height();
    var w = $(window).width() > $(document).width() ? $(window).width() : $(document).width();
    $('#slideshow div').height(h);
    $('#slideshow div').width(w);

    $(window).resize(function() {
        var h = $(window).height() > $(document).height() ? $(window).height() : $(document).height();
        var w = $(window).width() > $(document).width() ? $(window).width() : $(document).width();
        $('#slideshow div').height(h);
        $('#slideshow div').width(w);
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