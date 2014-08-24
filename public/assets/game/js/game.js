$(function() {

    var Game = new Object();

    Game.questions = [];
    Game.testsOrder = [];

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

    Game.showQuestion = function(type, n)
    {
        console.log(this.questions);
        $('#statement').html(this.questions[type][n]['statement']);

        tests = JSON.parse(this.questions[type][n]['tests']);

        /*
         * Генерирует порядок вариантов ответов в разброс. Первый ответ верный.
         */

        Game.testsOrder = this.genTestsOrder(Object.keys(tests).length);
        for (var i in Game.testsOrder) {
            $('#tests').prepend('<div class="test" n="' + i + '">' + tests[ Game.testsOrder[i] ] + '</div>');
        }
    }

    Game.checkTest = function(selected)
    {
        var n = selected.attr('n');
        if (Game.testsOrder[n] == 1) {
            selected.removeClass('selected').addClass('true');
        } else {
            selected.removeClass('selected').addClass('false');
        }
    }

    Game.clickTest = function()
    {
        var selected = $(this);
        selected.addClass('selected');
        var i = 3;
        var blink = setInterval(function() {

            selected.toggleClass('selected');

            if (i-- == 0) {
                clearInterval(blink);
                Game.checkTest(selected);
            }
        }, 300);
    }

    Game.start = function()
    {
        $.getJSON("/getgamejson", function(data) {
            Game.questions = data;
            Game.showQuestion('tests', 0);
        });
    }

    Game.start();

    $('#tests').on('click', '.test', Game.clickTest);

});
