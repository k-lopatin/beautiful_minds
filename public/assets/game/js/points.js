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
            alert(rightWord);
            alert(checkingWord);
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

    P.getPoints = function(type, population, time, answer, correct_answer, isTrue)
    {
        answer = answer || null;
        correct_answer = correct_answer || null;
        var curPoint = population/(P.p_number+ P.p_word + P.p_test);
        var res = 0;
            switch (type) {
                case 'test':
                    if(isTrue){
                        if(time>5){
                            res = curPoint;
                        }
                        else if(time <=5 && time >1) {
                            res = 0,75*curPoint;
                        }
                        else {
                            res = 0,6*curPoint;
                        }
                    }
                    break;
                case 'word':
                    if(isTrue){
                        if(time>5) {
                            res = curPoint;
                        }
                        else if(time <=5 && time >1) {
                            res = 0,75*curPoint;
                        }
                        else {
                            res = 0,6*curPoint;
                        }
                    }
                    break;
                case 'number':
                    if(!isTrue){
                        if(time>5) {
                            res = 0.5*curPoint;
                        }
                        else if(time <=5 && time >1) {
                            res = 0,25*curPoint;
                        }
                        else {
                            res = 0.15*curPoint;
                        }

                        if(P.find_mistake(correct_answer,answer) == 1) {
                            res+=0,25*curPoint;
                        }
                        else if(P.find_mistake(correct_answer,answer) == 2) {
                            res+=0,15*curPoint;
                        }
                        else {
                            res = 0;
                        }
                    }
                    else {
                        if(time>5) {
                            res = curPoint;
                        }
                        else if(time <=5 && time >1) {
                            res = 0,75*curPoint;
                        }
                        else {
                            res = 0,6*curPoint;
                        }
                    }
                    break;
            }
        return res;
    }
});
