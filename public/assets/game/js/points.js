var Points = new Object();

Points.setQNumber = function(p_test, p_number, p_word, p_order, p_map) {
    this.p_number = p_number;
    this.p_word = p_word;
    this.p_test = p_test;
    this.p_order = p_order;
    this.p_map = p_map;
}

Points.find_mistake = function(rightWord, checkingWord) {
    var res = 0;
    if (rightWord != checkingWord)
    {
        rightWord = rightWord.toLowerCase();
        checkingWord = checkingWord.toLowerCase();
        rightWord = rightWord.replace("ё", "е");
        checkingWord = checkingWord.replace("ё", "е");
        var lengthRightWord = rightWord.length;
        var lengthCheckingWord = checkingWord.length;
        var j = 0;
        var b = Math.max(lengthCheckingWord, lengthRightWord)
        for (var i = 0; i < b; i++)
        {
            if (rightWord[i] != checkingWord[j])
            {
                var is1 = false;
                var ii = i;
                var jj = j;
                if (lengthRightWord > lengthCheckingWord)
                {
                    for (ii = i; i < lengthRightWord; ii++)
                    {
                        for (jj = j; jj < ii + 1; jj++)
                        {
                            if (rightWord[ii] == checkingWord[jj])
                            {
                                res += Math.max(jj - j, ii - i);
                                i = ii;
                                j = jj;
                                is1 = true;
                                break;
                            }
                        }
                        if (is1)
                            break;
                    }
                    if (!is1)
                    {
                        res += Math.max(jj - j, ii - i);
                        i = ii;
                        j = jj;
                        is1 = true;
                    }
                }
                else
                {
                    for (jj = j; j < lengthCheckingWord; jj++)
                    {
                        for (ii = i; ii < jj + 1; ii++)
                        {
                            if (rightWord[ii] == checkingWord[jj])
                            {
                                res += Math.max(jj - j, ii - i);
                                i = ii;
                                j = jj;
                                is1 = true;
                                break;
                            }
                        }
                        if (is1)
                            break;
                    }
                    if (!is1)
                    {
                        res += Math.max(jj - j, ii - i);
                        i = ii;
                        j = jj;
                        is1 = true;
                    }
                }
            }
            j++;
        }
    }
    return res;
}

Points.check_number = function(correctAnswer, answer) {
    var error;
    var tmp = Math.min(Math.abs(correctAnswer), Math.abs(answer));
    if (tmp <= 10) {
        error = 1;
    }
    else if (tmp > 10 && tmp <= 100) {
        error = 10;
    }
    else if (tmp > 100 && tmp <= 1000) {
        error = 50;
    }
    else if (tmp > 1000 && tmp <= 10000) {
        error = 200;
    }
    else {
        error = 500;
    }
    if (Math.abs(correctAnswer - answer) <= error)
        return 0;
    else
        return -1;
}

Points.setTime = function(T, t) {
    var res = 0;
    if (t == 0)
        t = 1;
    if (t > 0.5 * T)
        res = 1;
    else
        res = (t / T).toFixed(2);
    return res;
}

Points.getPoints = function(type, population, allTime, curTime, isTrue, correctAnswer, answer)
{
    answer = answer || null;
    correctAnswer = correctAnswer || null;
    console.log(Points.check_number(correctAnswer, answer));
    var curPoint = population / (Points.p_number + Points.p_word + Points.p_test);
    var res = 0;
    switch (type) {
        case 'test':
            if (isTrue) {
                res = 0.5 + 0.5 * Points.setTime(allTime, curTime);
            }
            break;
        case 'number':
            if (!isTrue) {
                res = 0.5 + 0.5 * Points.setTime(allTime, curTime);
                if (Points.check_number(correctAnswer, answer) == 0) {
                    res -= 0.25;
                }
                else {
                    res = 0;
                }
            }
            else
                res = 0.5 + 0.5 * Points.setTime(allTime, curTime);
            break;
        case 'word':
            if (!isTrue) {
                res = 0.5 + 0.5 * Points.setTime(allTime, curTime);
                console.log(correctAnswer);
                console.log(answer);
                var mistakes = Points.find_mistake(correctAnswer, answer);
                if (mistakes == 1) {
                    res -= 0.25;
                }
                else if (mistakes == 2) {
                    res -= 0.35;
                }
                else {
                    res = 0;
                }
            }
            else {
                res = 0.5 + 0.5 * Points.setTime(allTime, curTime);
            }
            break;
    }
    return parseInt(res * curPoint);
}