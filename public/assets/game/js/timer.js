/**
 *
 * Timer object.
 */
var Timer = new Object();

Timer.s = 0;
Timer.f;
Timer.clock;

Timer.startTimer = function() {
    var s = Timer.s;
    if (Timer.s < 10)
        s = "0" + Timer.s;
    $('#my_timer').html(s);

    if (Timer.s == 0) {
        clearInterval(Timer.clock);
        Timer.f();
        return;
    }
    Timer.s--;
};

Timer.start = function(seconds, f) {
    Timer.s = seconds;
    Timer.startTimer();
    Timer.f = f;
    $('#bg2').height(0);
    $('#bg2').animate({height: '100%'}, seconds * 1000, 'linear');
    Timer.clock = setInterval(function() {
        Timer.startTimer();
    }, 1000);
};


Timer.stop = function() {
    clearInterval(Timer.clock);
    $('#bg2').stop();
};
