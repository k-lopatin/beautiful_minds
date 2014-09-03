$(function() {

    var Game = new Object();

    Game.questions = [];
    Game.testsOrder = [];
    Game.curQuestion = 0;
    Game.curType = 'tests';
    Game.curRightAnswer = 0;

    Game.curTime = 0;

    Game.Points = 0;

    Game.game_test_n = 0;
    Game.game_number_n = 0;

    Game.genTestsOrder = function(n)
    {
        var used = [];
        var res = [];
        var c = 0;
        while (c != n)
        {
            var tmp = Math.floor(Math.random() * (n + 1));
            if (typeof used[tmp] == 'undefined' && tmp != 0)
            {
                used[tmp] = 1;
                res[c] = tmp;
                c++;
            }
        }
        return res;
    }

    Game.next = function()
    {
        switch (Game.curType) {
            case 'tests':
                if (++Game.curQuestion <= Game.game_test_n) {
                    Game.showTestQuestion();
                } else {
                    Game.curType = 'numbers';
                    Game.curQuestion = 0;
                    Game.showNumberType();
                    Game.next();
                }
                break;
            case 'numbers':
                if (++Game.curQuestion <= Game.game_number_n) {
                    Game.showNumberQuestion();
                }
                break;
        }

    }

    Game.showTestQuestion = function()
    {
        $('#testQ .statement').html(this.questions[Game.curType][Game.curQuestion]['statement']);

        tests = JSON.parse(this.questions[Game.curType][Game.curQuestion]['tests']);

        /*
         * Генерирует порядок вариантов ответов в разброс. Первый ответ верный.
         */

        Game.testsOrder = this.genTestsOrder(Object.keys(tests).length);
        $('.tests').html('<div class="clear"></div>');
        for (var i in Game.testsOrder) {
            if (Game.testsOrder[i] == 1)
                Game.curRightAnswer = i;
            $('.tests').prepend('<div class="test" n="' + i + '">' + tests[ Game.testsOrder[i] ] + '</div>');
        }
        $('.tests').off('click', '.test', Game.clickTest);
        $('.tests').on('click', '.test', Game.clickTest);

        Timer.start(10, Game.TestTimeout);
    }

    Game.showNumberType = function() {
        $('#testQ').hide();
        $('#numberQ').show();
    }
    Game.showNumberQuestion = function()
    {
        $('.inputAnsw input').val('').removeClass('true').removeClass('false').removeClass('selected');
        $('#numberQ .statement').html(this.questions[Game.curType][Game.curQuestion]['statement']);

        Game.curRightAnswer = this.questions[Game.curType][Game.curQuestion]['answer'];

        $('.inputAnsw').on('keypress', 'input', function(e) {
            if (e.which == 13) {
                Game.enterNumber();
            }
        })

       Timer.start(10, Game.NumberTimeout);
    }

    Game.TestTimeout = function() {
        console.log('timeout');

        var right = $('.test[n=' + Game.curRightAnswer + ']');
        right.addClass('true');
        var i = 5;
        var blink = setInterval(function() {
            right.toggleClass('true');
            if (i-- == 0) {
                clearInterval(blink);
                Game.next();
            }
        }, 300);

    }

    Game.NumberTimeout = function()
    {
        $('.inputAnsw input').removeClass('false').removeClass('selected').addClass('true');
        $('.inputAnsw input').val(Game.curRightAnswer);
        setTimeout(Game.next, 1500);
    }

    Game.addPoints = function(p)
    {
        Game.Points += p;
        $('#city #points').html(Game.Points);
    }

    Game.checkTest = function(selected)
    {

        var n = selected.attr('n');
        if (n == Game.curRightAnswer) {
            selected.removeClass('selected').addClass('true');
            var p = Points.getPoints('test', 1000000, 10, Game.curTime, true);
            Game.addPoints( p );
        } else {
            selected.removeClass('selected').addClass('false');
            $('.test[n=' + Game.curRightAnswer + ']').addClass('true');
        }
        setTimeout(Game.next, 1200);
    }

    Game.clickTest = function()
    {
        console.log('click');
        Game.curTime = Timer.stop();

        $('#tests').off('click', '.test');
        var selected = $(this);
        selected.addClass('selected');
        var i = 3;
        //console.log(i);
        var blink = setInterval(function() {
            //console.log('test');
            selected.toggleClass('selected');

            if (i-- == 0) {
                clearInterval(blink);
                Game.checkTest(selected);
            }
        }, 300);
    }

    Game.enterNumber = function()
    {
        Timer.stop();
        $('.inputAnsw input').addClass('selected');
        setTimeout(function() {
            Game.checkNumber();
        }, 500);
    }

    Game.checkNumber = function()
    {
        if ($('.inputAnsw input').val() == Game.curRightAnswer) {
            $('.inputAnsw input').removeClass('selected').addClass('true');
            setTimeout(Game.start, 1500);
        } else {
            $('.inputAnsw input').removeClass('selected').addClass('false');
            var i = 5;
            var blink = setInterval(function() {
                $('.inputAnsw input').toggleClass('false');
                if (i-- == 0) {
                    clearInterval(blink);
                    $('.inputAnsw input').removeClass('false').addClass('true');
                    $('.inputAnsw input').val(Game.curRightAnswer);
                    setTimeout(Game.next, 1500);
                }
            }, 400);
        }


    }

    Game.start = function()
    {
        $.getJSON("/getgamejson", function(data) {
            Game.questions = data;
            Game.game_test_n = Game.questions['game_test_n'];
            //Game.game_test_n = 2;
            Game.game_number_n = Game.questions['game_number_n'];
            Game.next();
        });
    }

    Game.start();
});
