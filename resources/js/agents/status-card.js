function shortForm(num){
    let shortNum = 0 ;
    if(num > 1000000){
        shortNum = (num/1000000).toFixed(2);
        shortNum = `${shortNum}M`;
    }
    else if(num > 100000){
        shortNum = (num/100000).toFixed(2);
        shortNum = `${shortNum}K`;
    }else{
        shortNum = num;
    }

    return shortNum;
}