$(function(){  //shorthand for $(document).ready()

    var width = $('#slidesContainer div').width();  // get the width of our div
    var divarr = $('div.slide');

    var ii = 0;
    setInterval(function(){
        for(var i = 0; i < 4; i++)
            $(divarr[ii]).opacity=0;
        $(divarr[ii]).fadeIn(500);
        if(ii!=0)
            $(divarr[ii-1]).fadeOut(500);
        ii++;
        if(ii==divarr.length)
            ii=0;
        //slide();
    }, 2000);
    // run our animation the very first time
});