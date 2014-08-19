$(function(){  //shorthand for $(document).ready()

    var width = $('#slidesContainer div').width();  // get the width of our div

    function slide(){
        var divarr = $('div.slide');
        divarr[0].fadeOut();
        divarr[1].fadeIn();
        /*for(var i=0; i<divarr.length; i++){
            divarr[i].fadeOut();
        }
        var i = 0;
        while(true)
        {
            divarr[i].fadeIn(1000);
            if(i!=0)
                divarr[i-1].fadeOut(1000);
            i++;
            if(i==4)
                i=0;
        }*/
       // }
        slide();
    }

    slide();
    // run our animation the very first time
});