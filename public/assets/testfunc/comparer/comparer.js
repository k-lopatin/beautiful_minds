var res = 0;
var c = -1;
var n = 0;
function compare(item, i, ar) {
    if(ar[i]>ar[i+1])
    {
        res++;
        c = i;
    }
    n++;
}
function sort( ar ) {
    var check = 0;
    for(var i = 0; i < n; i++)
    {
        if(i == c)
            i++;
        for(var j = i; j < n; j++)
        {
            if(j == c)
                j++;
            if(ar[i] > ar[j])
                check++;
        }
        //alert(check);
    }
    return check;
}
function out() {
    var n = prompt("Введите число");
    var ar = [];
    for(var i = 0; i < n; i++)
        ar[i] = prompt("Введите порядок №" + (i+1));
    ar.forEach(compare);
   // alert(res + ' ' + c + ' ' + sort());
    if(res == 1 && sort(ar) == 0)
        alert("1");
    else
    {
        if(res <=1 && c!=-1)
        {
            if(sort(ar)!=0)
                alert("ERROR");
            else
                alert("OK");
        }
        else
        {
            if(res>1)
                alert("ERROR");
            else
                alert("OK");
        }
    }
}
