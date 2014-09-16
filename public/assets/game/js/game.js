$(function() {

    var Game = new Object();

    Game.questions = [];
    Game.testsOrder = [];
    Game.curQuestion = -1;
    Game.curType = 'tests';
    Game.curRightAnswer = 0;

    Game.curTime = 0;

    Game.Points = 0;

    Game.game_test_n = 0;
    Game.game_number_n = 0;
    Game.game_word_n = 0;

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
                if (++Game.curQuestion < Game.game_test_n) {
                    Game.showTestQuestion();
                } else {
                    Game.curType = 'numbers';
                    Game.curQuestion = -1;
                    Game.showNumberType();
                    Game.next();
                }
                break;
            case 'numbers':
                if (++Game.curQuestion < Game.game_number_n) {
                    Game.showNumberQuestion();
                } else {
                    Game.curType = 'words';
                    Game.curQuestion = -1;
                    Game.showWordType();
                    Game.next();
                }
                break;
            case 'words':
                if (++Game.curQuestion < Game.game_word_n) {
                    Game.showWordQuestion();
                } else {
                    if(Game.Points>=0.85*1000000 && Game.curQuestion > Game.game_word_n)
                        setTimeout(location.href='/registration',3000);
                    else
                        setTimeout(location.href='/',3000);;

                }
                break;
        }

    }


    Game.showTestQuestion = function()
    {
        $('#city #plus').html('+0');
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
        // $('.tests').off('click', '.test', Game.clickTest);
        $('.tests').on('click', '.test', Game.clickTest);

        Timer.start(10, Game.TestTimeout);
    }

    Game.showNumberType = function() {
        $('#testQ').hide();
        $('#numberQ').show();
    }
    Game.showWordType = function() {
        $('#numberQ').hide();
        $('#wordQ').show();
    }
    Game.showNumberQuestion = function()
    {
        $('#city #plus').html('+0');
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
    Game.showWordQuestion = function()
    {
        $('#city #plus').html('+0');
        $('.inputAnsw input').val('').removeClass('true').removeClass('false').removeClass('selected');
        $('#wordQ .statement').html(this.questions[Game.curType][Game.curQuestion]['statement']);

        Game.curRightAnswer = this.questions[Game.curType][Game.curQuestion]['answer'];

        $('.inputAnsw').on('keypress', 'input', function(e) {
            if (e.which == 13) {
                Game.enterWord();
            }
        })
        Timer.start(10, Game.WordTimeout);
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
    Game.WordTimeout = function()
    {
        $('.inputAnsw input').removeClass('false').removeClass('selected').addClass('true');
        $('.inputAnsw input').val(Game.curRightAnswer);
        setTimeout(Game.next, 1500);
    }

    Game.addPoints = function(p)
    {
        Game.Points += p;
        $('#city #points').html(Game.Points);
        $('#city #plus').html('+' + p);
    }

    Game.checkTest = function(selected)
    {

        var n = selected.attr('n');
        if (n == Game.curRightAnswer) {
            selected.removeClass('selected').addClass('true');
            var p = Points.getPoints('test', 1000000, 10, Game.curTime, true);
            Game.addPoints(p);
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

        $('.tests').off('click', '.test');
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
        Game.curTime = Timer.stop();
        $('.inputAnsw input').addClass('selected');
        setTimeout(function() {
            Game.checkNumber();
        }, 500);
    }

    Game.enterWord = function()
    {
        Game.curTime = Timer.stop();
        $('.inputAnsw input').addClass('selected');
        setTimeout(function() {
            Game.checkWord();
        }, 500);
    }

    Game.checkNumber = function()
    {
        if ($('.inputAnsw input').val() == Game.curRightAnswer) {
            $('.inputAnsw input').removeClass('selected').addClass('true');
            var p = Points.getPoints('number', 1000000, 10, Game.curTime, true);
            Game.addPoints(p);
            setTimeout(Game.next, 1500);
        } else {
            $('.inputAnsw input').removeClass('selected').addClass('false');
            var p = Points.getPoints('number', 1000000, 10, Game.curTime, false, Game.curRightAnswer, $('.inputAnsw input').val());
            Game.addPoints(p);
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

    Game.checkWord = function()
    {
        var curAnswInput = $('#wordQ .inputAnsw input');
        if (curAnswInput.val().toLowerCase() == Game.curRightAnswer.toLowerCase()) {
            curAnswInput.removeClass('selected').addClass('true');
            var p = Points.getPoints('word', 1000000, 10, Game.curTime, true);
            Game.addPoints(p);
            setTimeout(Game.next, 1500);
        } else {
            curAnswInput.removeClass('selected').addClass('false');
            console.log('t' + curAnswInput.val());
            var p = Points.getPoints('word', 1000000, 10, Game.curTime, false, Game.curRightAnswer, curAnswInput.val());
            Game.addPoints(p);
            var i = 5;
            var blink = setInterval(function() {
                curAnswInput.toggleClass('false');
                if (i-- == 0) {
                    clearInterval(blink);
                    curAnswInput.removeClass('false').addClass('true');
                    curAnswInput.val(Game.curRightAnswer);
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
            //Game.game_test_n = 0;
            Game.game_number_n = Game.questions['game_number_n'];
            //Game.game_number_n = 0;
            Game.game_word_n = Game.questions['game_word_n'];
            Game.next();
        });
    }

    Game.start();
});
