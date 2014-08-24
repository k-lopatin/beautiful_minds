$(function() {

    var Timer = new Object();

    var s;

    Timer.startTimer = function() {
        if (s == 0) {
            return;
        }
        s--;
        if (s < 10) s = "0" + s;
        document.getElementById("my_timer").innerHTML = s;
        setTimeout(Timer.startTimer, 1000);
    }

    Timer.init = function(_s) {
        s = _s;
    }

    Timer.move = function(elem, seconds) {
        var top = 0;
        var Timer_slider_bg = document.getElementById("bg1");
        var bg_height = getComputedStyle(Timer_slider_bg,null).getPropertyValue("height");
        console.log(bg_height);
        var t =((parseInt(bg_height)/(seconds-1))*0.01).toFixed(6);
        console.log(t);
        function frame_bottom() {
            top+=parseFloat(t);
            console.log(top);
            top.toFixed(6);
            elem.style.height = top.toFixed(6) + 'px';
            if (top>parseInt(bg_height)-0.6 && top <= parseInt(bg_height)) {
                clearInterval(timer);
            }
        }
        var timer = setInterval(frame_bottom, 8);
    }

    Timer.start = function(seconds){
        seconds++;
        var Timer_slider = document.getElementById("bg2");
        Timer.init(seconds);
        Timer.move(Timer_slider, seconds);
        Timer.startTimer();
    }

    Timer.start(10);

});
