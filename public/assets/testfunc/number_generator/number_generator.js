function generate( n ) {
    n++;
    var used = [];
    var res = [];
    var c = 0;
    while( c != (n-1) )
    {
        var tmp = Math.floor(Math.random() * n);
        if( typeof used[tmp] == 'undefined' && tmp!=0)
        {
            used[tmp]=1;
            res[c]=tmp;
            c++;
        }
    }
    return res;
    //alert(c1);
    //alert(c2);
}
function out() {
    var n = prompt("Введите число, ска");
    alert(generate(n));
}
