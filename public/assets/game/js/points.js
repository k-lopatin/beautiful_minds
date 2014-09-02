$(function() {

    function Points(p_number, p_word, p_test, p_order, p_map ) {
        this.p_number = p_number;
        this.p_word = p_word;
        this.p_test = p_test;
        this.p_order = p_order;
        this.p_map = p_map;
    }

    var P = new Points(4,4,5,1,2);

    P.find_mistake = function(rightWord, checkingWord) {
        var res=0;
        if(rightWord != checkingWord)
        {
            rightWord = rightWord.toLowerCase();
            checkingWord = checkingWord.toLowerCase();
            rightWord = rightWord.replace("ё","е");
            checkingWord = checkingWord.replace("ё","е");
            var lengthRightWord = rightWord.length;
            var lengthCheckingWord = checkingWord.length;
            var j = 0;
            var b = Math.max(lengthCheckingWord, lengthRightWord)
            //alert(rightWord);
            //alert(checkingWord);
            //alert(lengthCheckingWord +" " + lengthRightWord);
            for(var i = 0; i < b; i++)
            {
                if(rightWord[i] != checkingWord[j])
                {
                    //alert(rightWord[i] + checkingWord[j] + res);
                    var is1=false;
                    var ii=i;
                    var jj=j;
                    //alert(rightWord[ii] + checkingWord[j] + res );
                    if(lengthRightWord>lengthCheckingWord)
                    {
                        for(ii=i; i < lengthRightWord; ii++)
                        {
                            for(jj=j; jj<ii+1; jj++)
                            {
                                //alert(rightWord[ii] + checkingWord[jj] + res );
                                if(rightWord[ii] == checkingWord[jj])
                                {
                                    res+=Math.max(jj-j,ii-i);
                                    i=ii;
                                    j=jj;
                                    is1 = true;
                                    break;
                                }
                            }
                            if(is1)
                                break;
                        }
                        if(!is1)
                        {
                            res+=Math.max(jj-j,ii-i);
                            i=ii;
                            j=jj;
                            is1 = true;
                        }
                    }
                    else
                    {
                        for(jj=j; j < lengthCheckingWord; jj++)
                        {
                            for(ii=i; ii<jj+1; ii++)
                            {
                                //alert(rightWord[ii] + checkingWord[jj] + res );
                                if(rightWord[ii] == checkingWord[jj])
                                {
                                    res+=Math.max(jj-j,ii-i);
                                    i=ii;
                                    j=jj;
                                    is1 = true;
                                    break;
                                }
                            }
                            if(is1)
                                break;
                        }
                        if(!is1)
                        {
                            res+=Math.max(jj-j,ii-i);
                            i=ii;
                            j=jj;
                            is1 = true;
                        }
                    }
                }
                j++;
            }
        }
        return res;
        //alert(c1);
        //alert(c2);
    }

    P.check_number = function(correctAnswer, answer){
        var error;
        var tmp = Math.min(Math.abs(correctAnswer), Math.abs(answer));
        if(tmp<=10){
            error = 1;
        }
        else if(tmp>10 && tmp<=100){
            error = 10;
        }
        else if(tmp>100 && tmp<=1000){
            error = 50;
        }
        else if(tmp>1000 && tmp<=10000){
            error = 200;
        }
        else{
            error = 500;
        }

        if(Math.abs(correctAnswer) - Math.abs(answer) <= error)
            return 0;
        else
            return -1;
    }

    P.setTime = function (T, t) {
        if(t==0)
            t=1;
        return (t/T).toFixed(2);
    }

    P.getPoints = function(type, population, allTime, curTime, correctAnswer, answer, isTrue)
    {
        answer = answer || null;
        correctAnswer = correctAnswer || null;
        var curPoint = population/(P.p_number+ P.p_word + P.p_test);
        var res = 0;
            switch (type) {
                case 'test':
                    if(isTrue){
                        res = 0.5 + 0.5*P.setTime(allTime, curTime);
                    }
                    break;
                case 'number':
                    if(!isTrue){
                        res = 0.5 + 0.5*P.setTime(allTime, curTime);
                        if(P.check_number(correctAnswer,answer) == 0) {
                            res-=0.25;
                        }
                        else {
                            res=0;
                        }
                    }
                    else
                        res = 0.5 + 0.5*P.setTime(allTime, curTime);
                    break;
                case 'word':
                    if(!isTrue){
                        res = 0.5 + 0.5*P.setTime(allTime, curTime);
                        if(P.find_mistake(correctAnswer,answer) == 1) {
                            res-=0.25;
                        }
                        else if(P.find_mistake(correctAnswer,answer) == 2) {
                            res-=0.35;
                        }
                        else {
                            res = 0;
                        }
                    }
                    else {
                        res = 0.5 + 0.5*P.setTime(allTime, curTime);
                    }
                    break;
            }
        return res*curPoint;
    }
});
