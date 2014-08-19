$(function(){  //shorthand for $(document).ready()

    var width = $('#slidesContainer div').width();  // get the width of our div

    function slide(){

        $('#slidesContainer').delay(1000).animate({right: '+=' + width},1000, function(){
            // move the entire track right using the width of our div
            // use delay so that the animation has a pause in between
            // after the animation, we run a callback function

            var first = $('#slidesContainer div:first-child');
            // get the first div

            first.remove();
            // delete the first div

            $(this).append(first);
            // add the first div to the end of the track

            $(this).css({right: '-=' + width});
            // reposition the track

            slide();
            // start the animation again
        });

    }

    slide();
    // run our animation the very first time
});