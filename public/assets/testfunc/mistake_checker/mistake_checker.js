function find_mistake(rightWord, checkingWord) {
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
function out() {
    var rightWord = prompt("Введите правильынй вариант слова", '');
    var checkingWord = prompt("Введите слово для проверки", '');
    alert("У вас" +" " + find_mistake(rightWord, checkingWord)+" " + "опечаток");
}
