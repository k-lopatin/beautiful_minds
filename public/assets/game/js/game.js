$(function() {

    var Game = new Object();

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

        order = this.genTestsOrder(Object.keys(tests).length);
        for (var i in order) {
            $('#tests').prepend('<div class="test">' + tests[ order[i] ] + '</div>');
        }
    }

    Game.start = function()
    {
        $.getJSON("/getgamejson", function(data) {
            Game.questions = data;
            Game.showQuestion('tests', 0);
        });
    }

    Game.start();

});
